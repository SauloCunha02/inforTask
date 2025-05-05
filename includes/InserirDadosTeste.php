<?php
// Conectar ao banco de dados
require_once 'db.php';

// Inserir um Admin
$usuarioAdmin = 'admin_teste';
$senhaAdmin = password_hash('senha_admin', PASSWORD_DEFAULT); // Senha segura com hash
$stmtAdmin = $pdo->prepare("INSERT INTO admin (usuario, senha) VALUES (?, ?)");
$stmtAdmin->execute([$usuarioAdmin, $senhaAdmin]);

// Inserir um Professor
$nomeProfessor = 'Professor Teste';
$usuarioProfessor = 'professor_teste';
$senhaProfessor = password_hash('senha_professor', PASSWORD_DEFAULT); // Senha segura com hash
$statusProfessor = 'ativo'; // Status do professor
$stmtProfessor = $pdo->prepare("INSERT INTO professor (nome, usuario, senha, status) VALUES (?, ?, ?, ?)");
$stmtProfessor->execute([$nomeProfessor, $usuarioProfessor, $senhaProfessor, $statusProfessor]);

// Inserir uma Turma (necessária para o Aluno)
$nomeTurma = 'Turma de Teste';
$descricaoTurma = 'Turma de teste para inclusão de alunos';
$statusTurma = 'ativo'; // Status da turma
$stmtTurma = $pdo->prepare("INSERT INTO turma (nome, descricao, status) VALUES (?, ?, ?)");
$stmtTurma->execute([$nomeTurma, $descricaoTurma, $statusTurma]);

// Obter o ID da última turma inserida
$idTurma = $pdo->lastInsertId();

// Inserir um Aluno
$nomeAluno = 'Aluno Teste';
$usuarioAluno = 'aluno_teste';
$senhaAluno = password_hash('senha_aluno', PASSWORD_DEFAULT); // Senha segura com hash
$matriculaAluno = '2021001'; // Matrícula do aluno
$statusAluno = 'ativo'; // Status do aluno
$stmtAluno = $pdo->prepare("INSERT INTO aluno (idTurma, matricula, nome, usuario, senha, status) VALUES (?, ?, ?, ?, ?, ?)");
$stmtAluno->execute([$idTurma, $matriculaAluno, $nomeAluno, $usuarioAluno, $senhaAluno, $statusAluno]);

// Exibir sucesso
echo "Dados de teste inseridos com sucesso!";

?>
