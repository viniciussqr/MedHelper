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


$siape = $_POST['siape'] ?? '';
$senha = $_POST['senha'] ?? '';
$usuario = $_POST['usuario'] ?? '';


// Consulta preparada para evitar SQL Injection
$sql = "SELECT *FROM servidores (SIAPE, Login, Senha) 
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt) {
    // Substituir '?' pelos valores
    $telefone = ''; // Ajuste se necessário
    $stmt->bind_param("ssssss", $siape, $usuario, $senha);

    if ($stmt->execute()) {
        echo "Busca realizada com sucesso.";
    } else {
        echo "Erro ao realizar busca: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erro na preparação da consulta: " . $conn->error;
}

$conn->close();
?>