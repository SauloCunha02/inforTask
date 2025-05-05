<?php
session_start();
require_once 'db.php';
// Obtendo os dados do formulário
$usuario = $_POST['usuario'];
$senha   = $_POST['senha'];
$tipo    = $_POST['tipo']; // pode ser admin, professor, aluno

$tabela = $tipo; // admin, aluno, professor
$campoId = ($tipo === 'admin') ? 'idAdm' : "id{$tipo}";
// Prepara a consulta para verificar o usuário no banco
$stmt = $pdo->prepare("SELECT $campoId AS id, usuario, senha, status FROM $tabela WHERE usuario = ? LIMIT 1");
$stmt->execute([$usuario]);
$usuarioDb = $stmt->fetch();

if($usuarioDb){
    // Verifica a senha
    if(password_verify($senha, $usuarioDb['senha'])){
        // Verifica se o usuário está ativo (somente para aluno e professor)
        if(($tipo == 'aluno' || $tipo == 'professor') && $usuarioDb['status'] !== 'ativo'){
            // Se não estiver ativo, exibe a mensagem e redireciona para o login
            $_SESSION['erro'] = 'Usuário não está ativo.';
            header('Location:/index.php');
            exit;
        }
        // Se estiver ativo, cria a sessão do usuário
        $_SESSION['id'] = $usuarioDb['id'];
        $_SESSION['usuario'] = $usuarioDb['usuario'];
        $_SESSION['tipo'] = $tipo;
        // Redireciona conforme o tipo de usuário
        if($tipo == 'admin'){
            header("Location: ../admin/dashboard.php");
        }elseif($tipo == 'professor'){
            header("Location: ../professor/dashboard.php");
        }elseif($tipo == 'aluno'){
            header("Location: ../aluno/dashboard.php");
        }
        exit;
    }else{
        // Se a senha estiver errada
        $_SESSION['erro'] = 'Senha inválidos.';
        header('Location: ../');
        exit;
    }
}else{
    // Se o usuário não for encontrado no banco
    $_SESSION['erro'] = 'Usuário ou senha inválidos.';
    header('Location: ../');
    exit;
}
