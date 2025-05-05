<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - InforTask</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Login</h2>
    <?php
    // Exibe a mensagem de erro, se existir
    session_start();
    if(isset($_SESSION['erro'])){
        echo '<div class="alert alert-danger">'.$_SESSION['erro'].'</div>';
        unset($_SESSION['erro']); // Limpa a mensagem após exibição
    }
    ?>

    <form action="includes/autenticar.php" method="post">
        <div class="mb-3">
            <label>Usuário</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipo de Usuário</label>
            <select name="tipo" class="form-control" required>
                <option value="admin">Administrador</option>
                <option value="professor">Professor</option>
                <option value="aluno">Aluno</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</body>
</html>
