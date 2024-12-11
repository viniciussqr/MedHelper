<?php

if(isset($_POST['submit'])){

  include_once('Conexao.php');

  $nome = $_POST['nome'] ?? '';
  $crm = $_POST['crm'] ?? '';
  $email = $_POST['email'] ?? '';
  $siape = $_POST['siape'] ?? '';
  $senha = $_POST['senha'] ?? '';
  $telefone = $_POST['telefone'] ?? '';
  $usuario = $_POST['usuario'] ?? '';
  
  $sql = "INSERT INTO medicos (SIAPE, CRM, Nome, Email, Login, Senha, Telefone, Codigo_Especializacao) 
          VALUES ('$siape', '$crm', $nome', '$email', '$usuario', '$senha', '$telefone', NULL)";
  

  if(mysqli_query($mysqli, $sql)){
      echo "Inserção realizada com sucesso.";
      header('Location: Login.php');
  }else{
      echo "Error: (" . mysqli_error($mysqli) . ")";
  }
  
  exit();
  
}

?>

<!-- 
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="Estilo.css" />
    <title>Cadastro</title>
  </head>

  <body>
    <div class="ContainerLogo2">
      <img
        src="C:\Users\moyse\Downloads\logoMedHelper (1)_updated.png"
        alt="logo"
        class="img"
      />
    </div>
    <div class="ContainerCad center">
        <div>
          <h1 class="h1-CriarConta">Criar conta</h1>
        </div>

        <div class="IrLogin center">
          <h5>Ja possui uma conta?</h5>
          <a href="Login.html">Fazer login. </a>
        </div>

        <form action="Cadastro_Medico.php" method="POST">
          <div id="StepForm">
            <h5>Você está cadastrando-se <br />como Médico!</h5>
          </div>

          <div class="two-columns">
            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
              <legend class="legend">Nome</legend>
              <input
                class="input input-cadastro"
                type="text"
                name="nome"
                id="nome"
              />
            </fieldset>

            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
              <legend class="legend">Email</legend>
              <input
                class="input input-cadastro"
                type="text"
                name="email"
                id="email"
              />
            </fieldset>

            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
              <legend class="legend">CRM</legend>
              <input
                class="input input-cadastro"
                type="text"
                name="crm"
                id="crm"
              />
            </fieldset>


            
            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
              <legend class="legend">Usuário</legend>
              <input
                class="input input-cadastro"
                type="text"
                name="usuario"
                id="usuario"
              />
            </fieldset>

            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
              <legend class="legend">Telefone</legend>
              <input
                class="input input-cadastro"
                type="text"
                name="telefone"
                id="telefone"
              />
            </fieldset>
          </div>

          <div class="center">
            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
                <legend class="legend">Cód. Siape</legend>
                <input
                  class="input input-cadastro"
                  type="text"
                  name="siape"
                  id="siape"
                />
              </fieldset>
          </div>

          <div class="center">
            <div class="line"></div>
          </div>

          <div class="two-columns fieldsetEspacoBottom fieldsetEspacoTop2">
            

            <fieldset class="fieldset-Cadastro" >
                <legend class="legend">Senha</legend>
                <input
                  class="input input-cadastro"
                  type="text"
                  name="senha"
                  id="senha"
                />
              </fieldset>

            <fieldset class="fieldset-Cadastro">
                <legend class="legend">Confirmar senha</legend>
                <input
                  class="input input-cadastro"
                  type="text"
                  name="confirma-senha"
                  id="confirma-senha"
                />
              </fieldset>
          </div>

          <div class="center" id="escolher">
              <button class="btn Voltar" name="submit" type="submit" id="submit">
                Criar conta
              </button>
          </div>
        </form>
      </div>

  </body>
</html> -->

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="Estilo.css" />
    <title>Cadastro Medico</title>
  </head>

  <body>
    <div class="ContainerLogo2">
      <img
        src="images\logoMedHelperBranco.png"
        alt="logo"
        class="img"
      />
    </div>
    <div class="ContainerCad center">
        <div>
          <h1 class="h1-CriarConta">Criar conta</h1>
        </div>

        <div class="IrLogin center">
          <h5>Ja possui uma conta?</h5>
          <a href="Login.html">Fazer login. </a>
        </div>

        <form action="Cadastro_Medico.php" method="POST" id="StepForm">
          <div id="h5">
            <h5>Você está cadastrando-se <br />como médico!</h5>
          </div>

          <div class="two-columns">
            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
              <legend class="legend">Nome</legend>
              <input
                class="input input-cadastro"
                type="text"
                name="nome"
                id="nome"
              />
            </fieldset>

            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
              <legend class="legend">Email</legend>
              <input
                class="input input-cadastro"
                type="text"
                name="email"
                id="email"
              />
            </fieldset>


            
            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
              <legend class="legend">Usuário</legend>
              <input
                class="input input-cadastro"
                type="text"
                name="usuario"
                id="usuario"
              />
            </fieldset>

            <fieldset class="fieldset-Cadastro fieldsetEspacoBottom2">
              <legend class="legend">Telefone</legend>
              <input
                class="input input-cadastro"
                type="text"
                name="telefone"
                id="telefone"
              />
            </fieldset>
          </div>

          <div class="two-columns">
            <fieldset class="fieldset-Cadastro2 fieldsetEspacoBottom2">
                <legend class="legend">Cód. Siape</legend>
                <input
                  class="input input-cadastro2"
                  type="text"
                  name="siape"
                  id="siape"
                />
              </fieldset>

              <fieldset class="fieldset-Cadastro2 fieldsetEspacoBottom2">
                <legend class="legend">CRM</legend>
                <input
                  class="input input-cadastro2"
                  type="text"
                  name="crm"
                  id="crm"
                />
              </fieldset>

          </div>

          <div class="center">
            <div class="line"></div>
          </div>

          <div class="two-columns fieldsetEspacoBottom fieldsetEspacoTop2">
            

            <fieldset class="fieldset-Cadastro" >
                <legend class="legend">Senha</legend>
                <input
                  class="input input-cadastro"
                  type="text"
                  name="senha"
                  id="senha"
                />
              </fieldset>

            <fieldset class="fieldset-Cadastro">
                <legend class="legend">Confirmar senha</legend>
                <input
                  class="input input-cadastro"
                  type="text"
                  name="confirma-senha"
                  id="confirma-senha"
                />
              </fieldset>
          </div>

          <div class="center" id="escolher">
              <button class="btn Voltar" name="submit" type="submit" id="submit">
                Criar conta
              </button>
          </div>
        </form>
      </div>

  </body>
</html>
