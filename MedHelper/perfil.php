<?php
session_start();

include_once('conexao.php');

if ((!isset($_SESSION['siape']) == true) and (!isset($_SESSION['senha']) == true)) {
  unset($_POST['siape']);
  unset($_POST['senha']);
  header("Location: login.html");
  exit();
}

$siape = $_SESSION['siape'];
$medico = null; // Inicializando as variáveis
$servidor = null;


$sql_medicos = "SELECT * FROM medicos WHERE siape = ?";
$stmt_medicos = $mysqli->prepare($sql_medicos);
if ($stmt_medicos) {
  $stmt_medicos->bind_param('s', $siape);
  $stmt_medicos->execute();
  $result_medicos = $stmt_medicos->get_result();
  if ($result_medicos->num_rows > 0) {
    $medico = $result_medicos->fetch_assoc();
  }
}

if (!isset($medico)) {
  $sql_servidores = "SELECT * FROM servidores WHERE siape = ?";
  $stmt_servidores = $mysqli->prepare($sql_servidores);
  if ($stmt_servidores) {
    $stmt_servidores->bind_param('s', $siape);
    $stmt_servidores->execute();
    $result_servidores = $stmt_servidores->get_result();
    if ($result_servidores->num_rows > 0) {
      $servidor = $result_servidores->fetch_assoc();
    }
  }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="Assets/CSS/estilo.css" />
  <title>Perfil</title>
</head>

<body class="background">
  <div class="sombra">
    <header class="header center">
      <div class="header-left">
        <img src="Assets/Images/logo.png" alt="" class="logo" />
      </div>

      <ul class="row" id="ul">
        <li>
          <a href="" class="button-nav">Perfil</a>
        </li>

        <li>
          <a href="" class="button-nav">Estoque</a>
        </li>

        <li>
          <a href="home.html" class="button-nav">Home</a>
        </li>

        <li>
          <a href="" class="button-nav">Atendimentos</a>
        </li>

        <li>
          <a href="" class="button-nav">Notificações</a>
        </li>
      </ul>
    </header>

    <main>
      <div class="row center">
        <section class="section">
          <div class="esquerda container-foto">

          </div>
        </section>

        <section>
          <div class="direita container-informaçoes center">


            <button type="button" class="botao3 ">
              <img src="Assets/Images/icon-editar.png" alt="" class="imgBotao3" />
            </button>

            <?php if ($medico): ?>
              <div class="two-columns ">
                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Nome</legend>
                  <input class="input input-cadastro" type="text" name="nome" id="nome"
                    value="<?= htmlspecialchars($medico['nome']) ?>" readonly />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Usuário</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($medico['usuario']) ?>" />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Especialização</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($medico['especializacao']) ?>" />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Siape</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($medico['siape']) ?>" />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Email</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($medico['email']) ?>" />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Telefone</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($medico['telefone']) ?>" />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Senha</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($medico['senha']) ?>" />
                </fieldset>

              </div>

            <?php elseif ($servidor): ?>

              <div class="two-columns ">
                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Nome</legend>
                  <input class="input input-cadastro" type="text" name="nome" id="nome"
                    value="<?= htmlspecialchars($servidor['nome']) ?>" readonly />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Usuário</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($servidor['usuario']) ?>" />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Siape</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($servidor['siape']) ?>" />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Email</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($servidor['email']) ?>" />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Telefone</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($servidor['telefone']) ?>" />
                </fieldset>

                <fieldset class="fieldset-Cadastro">
                  <legend class="legend">Senha</legend>
                  <input class="input input-cadastro" type="text" name="confirma-senha" id="confirma-senha"
                    value="<?= htmlspecialchars($servidor['senha']) ?>" />
                </fieldset>

              </div>

            <?php endif; ?>

            <div class="center">
              <label for="" class="btnLabel">Sair da conta</label>
              <button type="button" class="botao4">
                <img src="Assets/Images/sair.png" alt="" class="imgBotao4" />
              </button>
            </div>
          </div>
        </section>

    </main>
  </div>

  </div>

  <script src="Assets/JS/perfil.js"></script>
</body>

</html>