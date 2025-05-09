<?php
require_once 'db.php';

try {
    // Inserir turma
    $stmt = $pdo->prepare("INSERT INTO turmas (nome, descricao, status) VALUES (?, ?, ?)");
    $stmt->execute(['ingorg9', 'Turma de inglês organização G9', 'ativo']);
    $idTurma = $pdo->lastInsertId();

   // Inserir admin
$stmt = $pdo->prepare("INSERT INTO admin (usuario, senha, status) VALUES (?, ?, ?)");
$stmt->execute(['Admin', password_hash('admin', PASSWORD_DEFAULT), 'ativo']);

// Inserir professores
$stmtProf = $pdo->prepare("INSERT INTO professor (nome, usuario, senha, status) VALUES (?, ?, ?, ?)");
$stmtProf->execute(['Saulo', 'saulo', password_hash('saulo', PASSWORD_DEFAULT), 'ativo']);
$stmtProf->execute(['Henrique', 'henrique', password_hash('henrique', PASSWORD_DEFAULT), 'ativo']);


    // Inserir 3 alunos de teste
    $stmtAluno = $pdo->prepare("INSERT INTO alunos (idTurma, matricula, nome, usuario, senha, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmtAluno->execute([$idTurma, '2023001', 'Aluno Teste 1', 'teste1', password_hash('senha', PASSWORD_DEFAULT), 'ativo']);
    $stmtAluno->execute([$idTurma, '2023002', 'Aluno Teste 2', 'teste2', password_hash('senha', PASSWORD_DEFAULT), 'ativo']);
    $stmtAluno->execute([$idTurma, '2023003', 'Aluno Teste 3', 'teste3', password_hash('senha', PASSWORD_DEFAULT), 'ativo']);

    echo "Dados inseridos com sucesso.";
} catch (PDOException $e) {
    echo "Erro ao inserir dados: " . $e->getMessage();
}
?>
