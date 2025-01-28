<?php
include_once('connection.php');
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

if (!$mysqli) {
    echo json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]);
    exit;
}

try {
    // Pegando parâmetros da URL
    $searchTerm = isset($_GET['search']) ? '%' . $mysqli->real_escape_string($_GET['search']) . '%' : '%';
    $filterType = isset($_GET['filter']) && $_GET['filter'] !== 'all' ? $mysqli->real_escape_string($_GET['filter']) : null;

    // Consulta de pacientes
    $query = "SELECT nome, matricula, genero, idade FROM pacientes WHERE nome LIKE ?";
    if ($filterType) {
        if ($filterType === 'Masculino' || $filterType === 'Feminino') {
            $query .= " AND genero = ?";
        } elseif ($filterType === 'Jovem') {
            $query .= " AND idade < 18";
        } elseif ($filterType === 'Adulto') {
            $query .= " AND idade >= 18 AND idade < 60";
        } elseif ($filterType === 'Idoso') {
            $query .= " AND idade >= 60";
        }
    }

    $stmt = $mysqli->prepare($query);
    if ($filterType && ($filterType === 'Masculino' || $filterType === 'Feminino')) {
        $stmt->bind_param("ss", $searchTerm, $filterType);
    } else {
        $stmt->bind_param("s", $searchTerm);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $pacientes = [];
    while ($row = $result->fetch_assoc()) {
        $pacientes[] = [
            "nome" => $row['nome'],
            "matricula" => $row['matricula'],
            "genero" => $row['genero'],
            "idade" => $row['idade'],
        ];
    }

    // Consulta de produtos
    $queryProdutos = "SELECT nome, qtd_atual FROM produtos";
    $resultProdutos = $mysqli->query($queryProdutos);
    $produtos = [];
    while ($row = $resultProdutos->fetch_assoc()) {
        $produtos[] = [
            "nome" => $row['nome'],
            "qtd_atual" => $row['qtd_atual'],
        ];
    }

    echo json_encode(["success" => true, "pacientes" => $pacientes, "produtos" => $produtos]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Erro ao consultar os dados: " . $e->getMessage()]);
}

$mysqli->close();
