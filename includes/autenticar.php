<?php
session_start();
require_once 'db.php';

// Obtendo os dados do formulário
$usuario = $_POST['usuario'];
$senha   = $_POST['senha'];
$tipo    = $_POST['tipo']; // valores esperados: admin, professor, alunos

// Corrigindo nome da tabela e coluna do ID conforme o tipo
switch ($tipo) {
    case 'admin':
        $tabela = 'admin';
        $campoId = 'idAdm';
        $verificaStatus = false;
        break;
    case 'professor':
        $tabela = 'professor';
        $campoId = 'idProfessor';
        $verificaStatus = true;
        break;
    case 'alunos': // valor vindo do formulário
        $tabela = 'alunos'; // nome real da tabela no banco
        $campoId = 'idAluno';
        $verificaStatus = true;
        break;
    default:
        $_SESSION['erro'] = 'Tipo de usuário inválido.';
        header('Location: ../index.php');
        exit;
}

// Prepara a consulta
$query = "SELECT $campoId AS $campoId, usuario, nome, senha";
$query .= $verificaStatus ? ", status" : "";
$query .= " FROM $tabela WHERE usuario = ? LIMIT 1";
$stmt = $pdo->prepare($query);
$stmt->execute([$usuario]);
$usuarioDb = $stmt->fetch();

if ($usuarioDb) {
    // Verifica a senha
    if (password_verify($senha, $usuarioDb['senha'])) {

        // Verifica se está ativo (aluno ou professor)
        if($verificaStatus && $usuarioDb['status'] !== 'ativo'){
            $_SESSION['erro'] = 'Usuário não está ativo.';
            header('Location: ../index.php');
            exit;
        }

        // Login bem-sucedido: cria sessão
        $_SESSION['id'] = $usuarioDb['id'];
        $_SESSION['usuario'] = $usuarioDb['usuario'];
        $_SESSION['nome'] = $usuarioDb['nome'];
        $_SESSION['tipo'] = $tipo;

        // Redireciona para a área correta
        if ($tipo === 'admin') {
            header("Location: ../admin/dashboard.php");
        } elseif ($tipo === 'professor') {
            header("Location: ../professor/dashboard.php");
        } elseif ($tipo === 'alunos') {
            $_SESSION['tipo'] = 'alunos'; // exato como você está testando no dashboard

            header("Location: ../aluno/dashboard.php");
        }
        exit;

    } else {
        $_SESSION['erro'] = 'Senha inválida.';
       header('Location: ../index.php');
       exit;
    }
}else{
    $_SESSION['erro'] = 'Usuário ou senha inválidos.';
    header('Location: ../index.php');
    exit;
}
?>
