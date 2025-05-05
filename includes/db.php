<?php
// bd.php — Conexão com o banco de dados "infortask"
$host = 'localhost';       // Ou o IP do servidor MySQL
$db   = 'infortask';       // Nome do banco
$user = 'root';            // Usuário do MySQL
$pass = '';                // Senha do MySQL
$charset = 'utf8mb4';      // Charset recomendado
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em erros
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna arrays associativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa prepared statements reais
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    exit;
}
?>
