<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';

verificar_permissao("admin");

// Verifica se os parâmetros foram passados corretamente
if (!isset($_GET['idAluno']) || !isset($_GET['idTurma'])) {
    header('Location: turmas.php');
    exit;
}

$idAluno = intval($_GET['idAluno']);
$idTurma = intval($_GET['idTurma']);

// Verifica se o aluno existe
$stmt = $pdo->prepare("SELECT * FROM alunos WHERE idAluno = ?");
$stmt->execute([$idAluno]);
$aluno = $stmt->fetch();

if (!$aluno) {
    echo "Aluno não encontrado.";
    exit;
}

// Executa a exclusão
$stmt = $pdo->prepare("DELETE FROM alunos WHERE idAluno = ?");
$stmt->execute([$idAluno]);

// Redireciona de volta para a página da turma
header("Location: adicionar_alunos.php?idTurma=$idTurma");
exit;
?>
