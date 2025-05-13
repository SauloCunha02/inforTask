
<?php
require_once '../includes/db.php';
include '../includes/auth.php';
verificar_permissao("admin");
//inserir professores
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['nome'])){
$stmt = $pdo->prepare("Insert into professor (nome, usuario, senha, status)
values (?, ?, ?, ?)
");
$stmt->execute([
    $_POST['nome'],
    $_POST['usuario'],
    password_hash($_POST['senha'], PASSWORD_DEFAULT),
    $_POST['status']
]);
header("location: professor.php");
exit;
}
//Excluir professor
if(isset($_GET['excluir'])){
    $stmt = $pdo->prepare("DELETE FROM professor where idProfessor = ?");
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
    <title>Gerenciar Professores</title>
</head>
<body>

    <h2>Gerenciar Professores</h2>

    <!-- Formulário de cadastro -->
    <form method="POST">
        <h4>Adicionar Novo Professor</h4>
        <div>
            <input type="text" name="nome" placeholder="Nome" required>
        </div>
        <div>
            <input type="text" name="usuario" placeholder="Usuário" required>
        </div>
        <div>
            <input type="password" name="senha" placeholder="Senha" required>
        </div>
        <div>
            <select name="status" required>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>
        <div>
            <button type="submit">Cadastrar</button>
        </div>
    </form>

    <!-- Lista de professores -->
    <h4>Professores Cadastrados</h4>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Usuário</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($professores as $prof): ?>
                <tr>
                    <td><?= htmlspecialchars($prof['nome']) ?></td>
                    <td><?= htmlspecialchars($prof['usuario']) ?></td>
                    <td><?= htmlspecialchars($prof['status']) ?></td>
                    <td>
<a href="editar_professor.php?id=<?= $prof['idProfessor'] ?>">Editar</a>
<a href="professor.php?excluir=<?= $prof['idProfessor'] ?>" onclick="return confirm('Excluir este professor?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>
</html>
