<?php
session_start();

// Destroi a sessão
session_unset();
session_destroy();

// Retorna uma resposta em JSON
echo json_encode(['status' => 'sucesso', 'message' => 'Sessão encerrada com sucesso!']);
exit();
?>
