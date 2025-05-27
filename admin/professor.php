<?php
require_once '../includes/db.php';
include '../includes/auth.php';
verificar_permissao("admin");

// Inserir professores
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['nome'])) {
    $stmt = $pdo->prepare("INSERT INTO professor (nome, usuario, senha, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nome'],
        $_POST['usuario'],
        password_hash($_POST['senha'], PASSWORD_DEFAULT),
        $_POST['status']
    ]);
    header("location: professor.php");
    exit;
}

// Excluir professor
if (isset($_GET['excluir'])) {
    $stmt = $pdo->prepare("DELETE FROM professor WHERE idProfessor = ?");
    $stmt->execute([$_GET['excluir']]);
    header("location: professor.php");
    exit;
}

// Listar professores
$stmt = $pdo->query("SELECT * FROM professor ORDER BY nome ASC");
$professores = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Professores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">  <a href="dashboard.php" class="btn btn-secondary">Voltar</a> Gerenciar Professores</h2>

    <!-- Formulário de cadastro -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Adicionar Novo Professor
        </div>
        <div class="card-body">
            <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Usuário</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Usuário" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de professores -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Professores Cadastrados
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Status</th>
                        <th style="width: 180px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($professores) > 0): ?>
                        <?php foreach ($professores as $prof): ?>
                            <tr>
                                <td><?= htmlspecialchars($prof['nome']) ?></td>
                                <td><?= htmlspecialchars($prof['usuario']) ?></td>
                                <td>
                                    <span class="badge <?= $prof['status'] == 'ativo' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= htmlspecialchars($prof['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="editar_professor.php?id=<?= $prof['idProfessor'] ?>" class="btn btn-sm btn-warning">
                                        Editar
                                    </a>
                                    <a href="professor.php?excluir=<?= $prof['idProfessor'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Tem certeza que deseja excluir este professor?')">
                                        Excluir
                                    </a>
                                </td>
                                
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhum professor cadastrado.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
