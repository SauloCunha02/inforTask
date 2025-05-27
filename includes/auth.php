<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

function verificar_permissao($tipo) {
    if ($_SESSION['tipo'] !== $tipo) {
        header("Location: ../index.php");
        exit;
    }
}
?>
