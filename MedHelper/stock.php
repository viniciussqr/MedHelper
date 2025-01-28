<?php
include_once('connection.php');
header('Content-Type: application/json');

if (!$mysqli) {
    echo json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]);
    exit;
}

try {
    // Termo de busca e filtro de tipo
    $searchTerm = isset($_GET['search']) ? '%' . $mysqli->real_escape_string($_GET['search']) . '%' : '%';
    $filterType = isset($_GET['filter']) && $_GET['filter'] !== 'all' ? $mysqli->real_escape_string($_GET['filter']) : null;

    // Consulta dinâmica baseada nos parâmetros
    $query = "SELECT nome, qtd_atual, tipo_produto FROM produtos WHERE nome LIKE ?";
    if ($filterType) {
        $query .= " AND tipo_produto = ?";
    }

    $stmt = $mysqli->prepare($query);

    if ($filterType) {
        $stmt->bind_param("ss", $searchTerm, $filterType);
    } else {
        $stmt->bind_param("s", $searchTerm);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $produtos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
        echo json_encode(["success" => true, "produtos" => $produtos]);
    } else {
        echo json_encode(["success" => false, "message" => "Nenhum produto encontrado."]);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Erro ao consultar os produtos: " . $e->getMessage()]);
}

$mysqli->close();