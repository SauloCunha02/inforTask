<?php
require_once '../includes/db.php';
include '../includes/auth.php';
verificar_permissao("admin");

if (!isset($_GET['id'])) {
    echo "ID do professor não informado.";
    exit;
}

$id = (int) $_GET['id'];

// Buscar dados atuais do professor
$stmt = $pdo->prepare("SELECT * FROM professor WHERE idProfessor = ?");
$stmt->execute([$id]);
$professor = $stmt->fetch();

if (!$professor) {
    echo "Professor não encontrado.";
    exit;
}

// Atualizar dados se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $status = $_POST['status'];

    // Verifica se uma nova senha foi enviada
    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE professor SET nome = ?, usuario = ?, senha = ?, status = ? WHERE idProfessor = ?");
        $stmt->execute([$nome, $usuario, $senha, $status, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE professor SET nome = ?, usuario = ?, status = ? WHERE idProfessor = ?");
        $stmt->execute([$nome, $usuario, $status, $id]);
    }

    header("Location: professor.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Editar Professor</h4>
        </div>
        <div class="card-body">
            <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nome:</label>
                    <input type="text" name="nome" class="form-control" 
                           value="<?= htmlspecialchars($professor['nome']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Usuário:</label>
                    <input type="text" name="usuario" class="form-control" 
                           value="<?= htmlspecialchars($professor['usuario']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nova Senha (opcional):</label>
                    <input type="password" name="senha" class="form-control" placeholder="Deixe em branco para manter a atual">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status:</label>
                    <select name="status" class="form-select" required>
                        <option value="ativo" <?= $professor['status'] === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo" <?= $professor['status'] === 'inativo' ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="professor.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</div>

</body>
</html>
