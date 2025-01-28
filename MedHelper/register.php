<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Verificando a conexão antes de qualquer outra coisa
include_once('connection.php');
if (!$mysqli) {
    echo json_encode([
        'error' => true,
        'message' => 'Erro na conexão com o banco de dados: ' . mysqli_connect_error()
    ]);
    exit;
}

header('Content-Type: application/json');

// Obtendo dados do formulário
$nome = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$siape = trim($_POST['codSiape'] ?? '');
$senha = trim($_POST['password'] ?? '');
$telefone = trim($_POST['phone'] ?? '');
$usuario = trim($_POST['userType'] ?? '');
$crm = trim($_POST['crm'] ?? '');
$especializacao = trim($_POST['specialization'] ?? '');

// Verificando se o e-mail já está cadastrado
$stmtEmail = $mysqli->prepare("SELECT email FROM servidores WHERE email = ? UNION SELECT email FROM medicos WHERE email = ?");
$stmtEmail->bind_param("ss", $email, $email);
$stmtEmail->execute();
$stmtEmail->store_result();

if ($stmtEmail->num_rows > 0) {
    echo json_encode([
        'error' => true,
        'message' => 'Este e-mail já está cadastrado.'
    ]);
    $stmtEmail->close();
    exit;
}

// Verificando se o SIAPE já está cadastrado
$stmtSiape = $mysqli->prepare("SELECT siape FROM servidores WHERE siape = ? UNION SELECT siape FROM medicos WHERE siape = ?");
$stmtSiape->bind_param("ss", $siape, $siape);
$stmtSiape->execute();
$stmtSiape->store_result();

if ($stmtSiape->num_rows > 0) {
    echo json_encode([
        'error' => true,
        'message' => 'Este código SIAPE já está cadastrado.'
    ]);
    $stmtSiape->close();
    exit;
}

// Inserção segura com Prepared Statements
if ($usuario === "medico") {
    $stmt = $mysqli->prepare("INSERT INTO medicos (siape, crm, nome, email, senha, telefone, especializacao) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $siape, $crm, $nome, $email, $senha, $telefone, $especializacao);
} else if ($usuario === "servidor") {
    $stmt = $mysqli->prepare("INSERT INTO servidores (siape, nome, email, senha, telefone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $siape, $nome, $email, $senha, $telefone);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'Tipo de usuário inválido.'
    ]);
    exit();
}

// Verificar se o statement foi preparado corretamente
if (!$stmt) {
    echo json_encode([
        'error' => true,
        'message' => 'Erro ao preparar o statement: ' . $mysqli->error
    ]);
    exit;
}

// Executando o statement e retornando resposta
if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Cadastro realizado com sucesso.'
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'Erro ao realizar o cadastro: ' . $stmt->error
    ]);
}

// Fechando o statement e a conexão
$stmt->close();
$stmtEmail->close();
$stmtSiape->close();
$mysqli->close();
}
