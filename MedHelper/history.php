<?php
session_start();
include_once('connection.php');
header('Content-Type: application/json');

// Configurações de CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

// Validação dos dados
$nome = trim($_POST['patient-name'] ?? '');
$matricula = trim($_POST['matricula'] ?? '');
$gender = trim($_POST['gender'] ?? '');
$age = trim($_POST['age'] ?? '');
$medicamentoSelect = trim($_POST['medicamentoSelect'] ?? '');
$inputNumber = trim($_POST['inputNumber'] ?? '');
$situacao = trim($_POST['situacao'] ?? '');
$dataFinalizacao = trim($_POST['data'] ?? date('d-m-Y H:i:s')); // Define data atual se não fornecida

if (!$mysqli) {
    echo json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]);
    exit;
}

// Verifica se matrícula existe antes de inserir
$queryCheck = "SELECT * FROM pacientes WHERE matricula = ?";
$stmtCheck = $mysqli->prepare($queryCheck);
$stmtCheck->bind_param("s", $matricula);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    // Remove o paciente da tabela original
    $queryDelete = "DELETE FROM pacientes WHERE matricula = ?";
    $stmtDelete = $mysqli->prepare($queryDelete);
    $stmtDelete->bind_param("s", $matricula);
    if ($stmtDelete->execute()) {
        $queryInsert = "INSERT INTO pacientes_finalizados (nome, matricula, genero, idade, situacao, medicamento, qtd_medicamento, data) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtInsert = $mysqli->prepare($queryInsert);

        $stmtInsert->bind_param("ssssssss", $nome, $matricula, $gender, $age, $situacao, $medicamentoSelect, $inputNumber, $dataFinalizacao);
        $stmtInsert->execute();
        $stmtInsert->close();

        // Recupera os dados atualizados da tabela `pacientes_finalizados`
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao remover o paciente na tabela original."]);
    }
    $stmtDelete->close();

}

$query = "SELECT * FROM pacientes_finalizados";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
}

$pacientes = [];
while ($row = $result->fetch_assoc()) {
    $pacientes[] = $row;
}

echo json_encode(["success" => true, "pacientes" => $pacientes]);

$stmtCheck->close();
$mysqli->close();
