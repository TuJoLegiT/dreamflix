<?php
// db.php
$host = 'localhost';
$port = '5432';
$dbname = 'dreamflix';
$user = 'postgres';
$password = 'le1123';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar com o banco de dados, seu burro: " . $e->getMessage());
}
?>