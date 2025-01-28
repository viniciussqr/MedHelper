<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include_once('connection.php');
    header('Content-Type: application/json');
    $nome = trim($_POST['medName'] ?? '');
    $qtd_atual = trim($_POST['medQuantity'] ?? '');
    $tipo_produto = trim($_POST['medType'] ?? '');

    if (empty($nome) || empty($qtd_atual) || empty($tipo_produto)) {
        echo json_encode([
            "error" => true,
            "message" => "Dados inválidos ou incompletos."
        ]);
        exit;
    }


    if (!$mysqli) {
        echo json_encode([
            "error" => true,
            "message" => "Erro na conexão com o banco de dados: " . mysqli_connect_error()
        ]);
        exit;
    }

    $stmtNome = $mysqli->prepare("SELECT nome, qtd_atual FROM produtos WHERE nome = ?");
    $stmtNome->bind_param("s", $nome);
    if ($stmtNome->execute()) {
        $result = $stmtNome->get_result();
        if ($result->num_rows > 0) {
            $produto = $result->fetch_assoc();
            $qtd_banco = intval($produto['qtd_atual']);

            $qtd_banco += intval($qtd_atual);

            $stmtUpdate = $mysqli->prepare("UPDATE produtos SET qtd_atual = ? WHERE nome LIKE ?");
            $nomeLike = '%' . $nome . '%';
            $stmtUpdate->bind_param("is", $qtd_banco, $nomeLike);

            if ($stmtUpdate->execute()) {
                echo json_encode([
                    "success" => true,
                    "message" => "Produto já existente! Quantidade atualizada."
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Erro ao atualizar a quantidade do produto."
                ]);
                exit;
            }
            $stmtUpdate->close();
        } else {
            $stmt = $mysqli->prepare("INSERT INTO produtos (nome, qtd_atual, tipo_produto) VALUES (?,?,?)");

            $stmt->bind_param("sis", $nome, $qtd_atual, $tipo_produto);

            if ($stmt->execute()) {
                echo json_encode([
                    "success" => true,
                    "message" => "Produto inserido com sucesso!"
                ]);
            } else {
                echo json_encode([
                    "error" => true,
                    "message" => "Erro ao inserir o produto: " . mysqli_error($mysqli)
                ]);
            }

            $stmt->close();
        }

        $stmtNome->close();
    }



    
    $mysqli->close();

}


