<?php

$hostname = "localhost:3307";
$bancodedados = "medhelper";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if($mysqli -> connect_errno){
    echo "Falha ao conectar: (" . $mysqli -> connect_errno . ") " . $mysqli -> connect_errno;
    exit();
}


/* 
$hostname = "localhost";
$bancodedados = "medhelper";
$usuario = "root";
$senha = "";


$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if(!$bancodedados){
  echo "Falha ao conectar";
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
  
  $nome = $_POST["nome"];
  $email = $_POST["email"] ;
  $siape = $_POST["siape"] ;
  $senha = $_POST["senha"] ;
  $confirmarsenha = $_POST["confirmarSenha"] ;
  $telefone = $_POST["telefone"] ;
  $usuario = $_POST["usuario"] ;

  if($senha === $confirmarSenha){
    $sql = "SELECT * FROM servidores WHERE usuario = '$usuario'"
    $retorno = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($retorno)

    if($row){
      echo "Usuário já esxiste";
    }else{
      $hashsenha = password_hash($senha, PASSWORD_BCRYPT);
      $sql = "INSERT INTO servidores (nome, email, siape, senha, confirmarsenha, telefone, usuario) values('$usuario', $hashsenha)";
      $retorno = mysqli_query($mysqli, $sql);

      if($retorno === true){
      echo "Cadastro realizado!";
    } else {
      echo"ERRO AO CADASTRAR USUARIO". $mysqli->error;
    }
  }
} else{
  echo"As senhas estao diferentes";
  }
}

$mysqli->close(); */



