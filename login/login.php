<?php
session_start();
require '../config/db.php';

$usuario = trim($_POST['usuario'] ?? '');
$senha   = trim($_POST['senha']   ?? '');

// Procurar pelo usuário no banco
$stmt = $pdo->prepare("SELECT id, usuario, senha FROM usuarios WHERE usuario = :usuario");
$stmt->execute([':usuario' => $usuario]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Verifica se a senha bate com o hash armazenado
    if (password_verify($senha, $user['senha'])) {
        // Se verdadeiro, login bem-sucedido
        $_SESSION['usuario'] = $user['usuario'];
        header('Location: ../dreamdash/dashboard.php');
        exit;
    } else {
        // Senha incorreta
        echo "<script>alert('Senha incorreta!'); window.location.href='index.php';</script>";
    }
} else {
    // Usuário não encontrado
    echo "<script>alert('Usuário não existe!'); window.location.href='index.php';</script>";
}