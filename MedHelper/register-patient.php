<?php
// Verificar se o método é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include_once('connection.php');
    header('Content-Type: application/json');

    $patientName = trim($_POST['patientName'] ?? '');
    $patientMatricula = trim($_POST['patientMatricula'] ?? '');
    $patientGender = trim($_POST['patientGender'] ?? '');
    $patientAge = trim($_POST['patientAge'] ?? '');

    // Validar campos
    if (empty($patientName) || empty($patientMatricula) || empty($patientGender) || empty($patientAge)) {
        echo json_encode([
            "error" => true,
            "message" => "Dados inválidos ou incompletos."
        ]);
        exit;
    }

    // Validar conexão com o banco
    if (!$mysqli) {
        echo json_encode([
            "error" => true,
            "message" => "Erro na conexão com o banco de dados: " . mysqli_connect_error()
        ]);
        exit;
    }

    // Verificar se a matrícula já existe
    $stmtSiape = $mysqli->prepare("SELECT matricula FROM pacientes WHERE matricula = ?");
    $stmtSiape->bind_param("s", $patientMatricula);
    $stmtSiape->execute();
    $stmtSiape->store_result();

    if ($stmtSiape->num_rows > 0) {
        echo json_encode([
            'error' => true,
            'message' => 'Essa matrícula já está cadastrada.'
        ]);
        $stmtSiape->close();
        exit;
    }
    $stmtSiape->close();

    // Usar prepared statements para maior segurança
    $stmt = $mysqli->prepare("INSERT INTO pacientes (nome, matricula, genero, idade) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $patientName, $patientMatricula, $patientGender, $patientAge);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "Paciente cadastrado com sucesso!"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Erro ao cadastrar paciente: " . $stmt->error
        ]);
    }

    $stmt->close();
    $mysqli->close();
}
