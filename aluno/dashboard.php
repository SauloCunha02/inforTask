<?php

include '../includes/auth.php';
verificar_permissao("alunos");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
</head>
<body>
    <h1> Página do  Aluno</h1><p>Seja bem-vindo <?php echo $_SESSION['nome']; ?> </p>
</body>
</html>