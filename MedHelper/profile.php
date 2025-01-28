<?php
session_start();

if (!isset($_SESSION['codSiape'])) {
    unset($_SESSION['codSiape']);
    echo "Erro: Usuário não autenticado!";
    header('Location: login.html');
    exit;
}

$siape = $_SESSION['codSiape'];
$Servidor = null;
$Medico = null;

include_once('connection.php');

if (!$mysqli) {
    echo "Erro: Não foi possível conectar ao banco de dados.";
    exit;
}

if ($_SESSION['codSiape']) {
    $query = $mysqli->prepare("SELECT * FROM servidores WHERE siape = ?");
    $query->bind_param("s", $siape);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $Servidor = $result->fetch_assoc();
    } else {
        $query = $mysqli->prepare("SELECT * FROM medicos WHERE siape = ?");
        $query->bind_param("s", $siape);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $Medico = $result->fetch_assoc();
        }
    }

}

?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="styles/profile.css">
    <link rel="shortcut icon" href="images/logo-icon.ico" type="image/x-icon">
    <title>MedHelper | Perfil</title>
</head>

<body>
    <div class="container text-center form-container">
        <div class="form-content">
            <img src="images/logo.png" alt="Logo" class="img-fluid logo-image">
            <h2 class="text-center header-text mb-4">Perfil</h2>

            <?php if ($Servidor): ?>
                <a href="home-server.html" id="btn-back" class="btn btn-primary btn-back"><i class="bi bi-arrow-left"></i>
                    Voltar</a>

                <button id="btn-logout" class="btn btn-outline-danger btn-logout"><i class="bi bi-box-arrow-right"></i>
                    Sair</button>
                <div class="text-center mb-3">
                    <label for="codSiape" class="form-label">Código do Siape: </label>
                    <span name="codSiapeDesc" id="codSiapeDesc"><?= htmlspecialchars($Servidor['siape']) ?></span>
                </div>
                <form id="profile-form">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control form-control-locked" id="name" name="name"
                                value="<?= htmlspecialchars($Servidor['nome']) ?>" required disabled>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control form-control-locked" id="email" name="email"
                                value="<?= htmlspecialchars($Servidor['email']) ?>" required disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control form-control-locked" id="phone" name="phone"
                                value="<?= htmlspecialchars($Servidor['telefone']) ?>" required disabled>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-locked" id="password"
                                    name="password" value="<?= htmlspecialchars($Servidor['senha']) ?>" required disabled>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center btn-container">
                        <button type="button" class="btn btn-danger btn-lg" id="edit-btn"><i class="bi bi-pencil"></i>
                            Editar</button>
                        <button type="submit" class="btn btn-primary btn-lg" id="save-btn" disabled>Salvar</button>
                    </div>
                </form>
            <?php elseif ($Medico): ?>
                <a href="index.html" id="btn-back" class="btn btn-primary btn-back"><i class="bi bi-arrow-left"></i>
                    Voltar</a>

                <button id="btn-logout" class="btn btn-outline-danger btn-logout"><i class="bi bi-box-arrow-right"></i>
                    Sair</button>

                <div class="text-center mb-3">
                    <label for="area" class="form-label">Área de Atuação: </label>
                    <span id="areaDesc"><?= htmlspecialchars($Medico['especializacao']) ?></span>
                </div>

                <div class="text-center mb-3">
                    <label for="codSiape" class="form-label">Código do Siape: </label>
                    <span name="codSiapeDesc" id="codSiapeDesc"><?= htmlspecialchars($Medico['siape']) ?></span>
                </div>
                <form id="profile-form">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control form-control-locked"
                                value="<?= htmlspecialchars($Medico['nome']) ?>" id="name" name="name" required disabled>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control form-control-locked"
                                value="<?= htmlspecialchars($Medico['email']) ?>" id="email" name="email" required disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control form-control-locked"
                                value="<?= htmlspecialchars($Medico['telefone']) ?>" id="phone" name="phone" required
                                disabled>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <div class="input-group">
                                <input type="password" value="<?= htmlspecialchars($Medico['senha']) ?>"
                                    class="form-control form-control-locked" id="password" name="password" required
                                    disabled>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center btn-container">
                        <button type="button" class="btn btn-danger btn-lg" id="edit-btn"><i class="bi bi-pencil"></i>
                            Editar</button>
                        <button type="submit" class="btn btn-primary btn-lg" id="save-btn" disabled>Salvar</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"></script>
    <script src="scripts/profile-script.js"></script>
</body>

</html>