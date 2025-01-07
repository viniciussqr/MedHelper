<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  include_once('conexao.php');

  $nome = $_POST['nome'] ?? '';
  $email = $_POST['email'] ?? '';
  $siape = $_POST['siape'] ?? '';
  $senha = $_POST['senha'] ?? '';
  $telefone = $_POST['telefone'] ?? '';
  $usuario = $_POST['usuario'] ?? '';
  
  $sql = "INSERT INTO servidores (siape, nome, email, usuario, senha, telefone) 
          VALUES ('$siape', '$nome', '$email', '$usuario', '$senha', '$telefone')";
  

  if(mysqli_query($mysqli, $sql)){
      echo json_encode(['status' => 'sucesso', 'message' => 'Cadastro realizado com sucesso.']);
  }else{
      echo json_encode(['status' => 'erro', 'message' => 'Erro ao realizar cadastro: '. mysqli_error($mysqli)]);
  }
  
  mysqli_close($mysqli);
  exit();
  
}
