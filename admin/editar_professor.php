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
    <title>Editar Professor</title>
</head>
<body>
    <h2>Editar Professor</h2>

    <form method="POST">
        <div>
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($professor['nome']) ?>" required>
        </div>
        <div>
            <label>Usuário:</label>
            <input type="text" name="usuario" value="<?= htmlspecialchars($professor['usuario']) ?>" required>
        </div>
        <div>
            <label>Nova Senha (deixe em branco para manter a atual):</label>
            <input type="password" name="senha">
        </div>
        <div>
            <label>Status:</label>
            <select name="status" required>
                <option value="ativo" <?= $professor['status'] === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                <option value="inativo" <?= $professor['status'] === 'inativo' ? 'selected' : '' ?>>Inativo</option>
            </select>
        </div>
        <div>
            <button type="submit">Salvar Alterações</button>
            <a href="professor.php">Cancelar</a>
        </div>
    </form>
</body>
</html>
