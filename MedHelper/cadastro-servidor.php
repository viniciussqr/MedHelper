<?php

if(isset($_POST['submit'])){

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
      echo "Inserção realizada com sucesso.";
  }else{
      echo "Error: (" . mysqli_error($mysqli) . ")";
  }
  
  header('Location: login.html');
  exit();
  
}
