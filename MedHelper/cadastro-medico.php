<?php

if(isset($_POST['submit'])){

  include_once('conexao.php');

  $nome = $_POST['nome'] ?? '';
  $crm = $_POST['crm'] ?? '';
  $email = $_POST['email'] ?? '';
  $siape = $_POST['siape'] ?? '';
  $senha = $_POST['senha'] ?? '';
  $telefone = $_POST['telefone'] ?? '';
  $usuario = $_POST['usuario'] ?? '';
  $especial = $_POST['especializacao'] ?? '';
  
  $sql = "INSERT INTO medicos (siape, crm, nome, email, usuario, senha, telefone, especializacao) 
          VALUES ('$siape', '$crm', '$nome', '$email', '$usuario', '$senha', '$telefone', '$especial')";
  

  if(mysqli_query($mysqli, $sql)){
      echo "Inserção realizada com sucesso.";
      header('Location: login.html');
  }else{
      echo "Error: (" . mysqli_error($mysqli) . ")";
  }
  
  exit();
  
}
