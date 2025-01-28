<?php
session_start();

if (!isset($_SESSION['codSiape'])) {
    unset($_SESSION['codSiape']);
    header("Location: login.html");
    echo json_encode(['error' => true, 'message' => 'Usuário não autenticado!']);
    exit;
}

$siape = $_SESSION['codSiape'];

include_once('connection.php');

if (!$mysqli) {
    echo json_encode(['error' => true, 'message' => 'Erro ao conectar ao banco de dados.']);
    exit;
}

$query = $mysqli->prepare("SELECT * FROM servidores WHERE siape = ?");
$query->bind_param("s", $siape);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $userServidor = $result->fetch_assoc();
    $nome = isset($_POST['name']) && !empty(trim($_POST['name'])) ? trim($_POST['name']) : $userServidor['nome'];
    $email = isset($_POST['email']) && !empty(trim($_POST['email'])) ? trim($_POST['email']) : $userServidor['email'];
    $telefone = isset($_POST['phone']) && !empty(trim($_POST['phone'])) ? trim($_POST['phone']) : $userServidor['telefone'];
    $senha = isset($_POST['password']) && !empty(trim($_POST['password'])) ? trim($_POST['password']) : $userServidor['senha'];

    if ($userServidor) {
        $sql = "UPDATE servidores SET nome = ?, email = ?, senha = ?, telefone = ? WHERE siape = ?";
        $query = $mysqli->prepare($sql);
        $query->bind_param("sssss", $nome, $email, $senha, $telefone, $siape);
        if ($query->execute()) {
            echo json_encode(['success' => true, 'message' => 'Perfil atualizado com sucesso!']);
        } else {
            echo json_encode(['error' => true, 'message' => 'Erro ao atualizar o perfil.']);
        }
    }
} else {

    $query = $mysqli->prepare("SELECT * FROM medicos WHERE siape = ?");
    $query->bind_param("s", $siape);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $userMedico = $result->fetch_assoc();
        $nome = isset($_POST['name']) && !empty(trim($_POST['name'])) ? trim($_POST['name']) : $userMedico['nome'];
        $email = isset($_POST['email']) && !empty(trim($_POST['email'])) ? trim($_POST['email']) : $userMedico['email'];
        $telefone = isset($_POST['phone']) && !empty(trim($_POST['phone'])) ? trim($_POST['phone']) : $userMedico['telefone'];
        $senha = isset($_POST['password']) && !empty(trim($_POST['password'])) ? trim($_POST['password']) : $userMedico['senha'];

        if ($userMedico) {
            $sql = "UPDATE medicos SET nome = ?, email = ?, senha = ?, telefone = ? WHERE siape = ?";
            $query = $mysqli->prepare($sql);
            $query->bind_param("sssss", $nome, $email, $senha, $telefone, $siape);
            if ($query->execute()) {
                echo json_encode(['success' => true, 'message' => 'Perfil atualizado com sucesso!']);
            } else {
                echo json_encode(['error' => true, 'message' => 'Erro ao atualizar o perfil.']);
            }
        }


    } else {
        echo json_encode(['error' => true, 'message' => 'Usuário não encontrado.']);
        exit;
    }
}

$query->close();
$mysqli->close();