<?php 

$servidor = 'localhost:3307';
$usuario_db = 'root';
$senha_db = '';
$banco = 'medhelper';

// Conexão ao banco
$conn = new mysqli($servidor, $usuario_db, $senha_db, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtendo os dados do formulário
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$siape = $_POST['siape'] ?? '';
$senha = $_POST['senha'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$usuario = $_POST['usuario'] ?? '';

// Validação básica
if ($senha !== $confirma_senha) {
    die("As senhas não coincidem.");
}

// Consulta preparada para evitar SQL Injection
$sql = "INSERT INTO servidores (SIAPE, Nome, Email, Login, Senha, Telefone) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt) {
    // Substituir '?' pelos valores
    $telefone = ''; // Ajuste se necessário
    $stmt->bind_param("ssssss", $siape, $nome, $email, $usuario, $senha, $telefone);

    if ($stmt->execute()) {
        echo "Registro inserido com sucesso.";
    } else {
        echo "Erro ao inserir registro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erro na preparação da consulta: " . $conn->error;
}

$conn->close();
?>