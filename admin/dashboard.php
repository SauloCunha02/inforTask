<?php
include '../includes/auth.php';
verificar_permissao("admin");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">InforTask - Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <span class="nav-link active">Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../includes/logout.php">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Fim da Navbar -->

<div class="container text-center mt-5">
    <h1 class="mb-4">Painel do Administrador</h1>

    <div class="row justify-content-center">
        <div class="col-md-4 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Professores</h5>
                    <p class="card-text">Adicione, edite ou remova professores.</p>
                    <a href="professor.php" class="btn btn-primary w-100">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Turmas</h5>
                    <p class="card-text">Crie, edite, arquive turmas e gerencie alunos.</p>
                    <a href="turmas.php" class="btn btn-primary w-100">Acessar</a>
                </div>
            </div>
        </div>
    </div>
      <div class="row justify-content-center">
        <div class="col-md-4 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Habilidades</h5>
                    <p class="card-text">Adicione, edite ou remova habilidades de alunos individualmente.</p>
                    <a href="habilidades.php" class="btn btn-primary w-100">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">...</h5>
                    <p class="card-text">......</p>
                    <a href="turmas.php" class="btn btn-primary w-100">Acessar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (necessário para o funcionamento do botão mobile) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
