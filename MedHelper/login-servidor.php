<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once('conexao.php');

    $siape = $_POST['siape'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $sql = "SELECT * FROM servidores WHERE siape = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao preparar consulta.']);
        exit();
    }

    $stmt->bind_param('s', $siape);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($senha === $user['senha']) { 
            $_SESSION['siape'] = $user['siape'];
            $_SESSION['senha'] = $user['senha'];

            echo json_encode(['status' => 'sucesso', 'message' => 'Login realizado com sucesso!']);
        } else {
            echo json_encode(['status' => 'erro', 'message' => 'Senha incorreta.']);
        }
    } else {
        echo json_encode(['status' => 'erro', 'message' => 'Usuário não encontrado.']);
    }

   /* $stmt->close();
    $mysqli->close();*/
    exit();
}
/*
// Bloqueia acessos diretos
echo json_encode(['status' => 'erro', 'mensagem' => 'Requisição inválida.']);
exit();
*/