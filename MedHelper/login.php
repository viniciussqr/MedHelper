<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once('connection.php');
    header('Content-Type: application/json');

    $siape = trim($_POST['codSiape'] ?? '');
    $senha = trim($_POST['password'] ?? '');

    if (!$mysqli) {
        echo json_encode([
            'error' => true,
            'message' => 'Não foi possível realizar uma conexão ao banco de dados.'
        ]);

        exit;
    }

    $SiapeServidor = $mysqli->prepare("SELECT siape, senha FROM servidores WHERE siape = ? and senha = ?");
    $SiapeServidor->bind_param("ss", $siape, $senha);
    $SiapeServidor->execute();
    $result = $SiapeServidor->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($siape === $user['siape'] && $senha === $user['senha']) {
            $_SESSION['codSiape'] = $user['siape'];
            $_SESSION['password'] = $user['senha'];

            echo json_encode([
                'success' => true,
                'message' => 'Olá Servidor, seu login foi realizado com sucesso!',
                'tipo' => 'Servidor'
            ]);
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Senha incorreta.'
            ]);
        }
    } else if($result !== true){

        $SiapeMedico = $mysqli->prepare("SELECT siape, senha FROM medicos WHERE siape = ? and senha = ?");
        $SiapeMedico->bind_param("ss", $siape, $senha);
        $SiapeMedico->execute();
        $result = $SiapeMedico->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($siape === $user['siape'] && $senha === $user['senha']) {
                $_SESSION['codSiape'] = $user['siape'];
                $_SESSION['password'] = $user['senha'];

                echo json_encode([
                    'success' => true,
                    'message' => 'Olá Médico, seu login foi realizado com sucesso!',
                    'tipo' => 'Medico'
                ]);
            } else {
                echo json_encode([
                    'error' => true,
                    'message' => 'Senha incorreta.'
                ]);
            }
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Usuário não encontrado.'
            ]);
        }
        $SiapeMedico->close();

    }



    $SiapeServidor->close();

    $mysqli->close();
    exit();
}