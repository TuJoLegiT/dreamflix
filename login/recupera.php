<?php
require '../vendor/autoload.php'; // Ajuste conforme seu caminho
session_start();
require '../config/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// $pdo = new PDO("pgsql:host=localhost;dbname=dreamflix", "", "");

$mensagem = '';
$showEmailForm = false;
$showResetForm = false;

// Etapa 1: Solicitando o email
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', time() + 3600); // 1h de validade

        $pdo->prepare("UPDATE usuarios SET token_recuperacao = :token, token_expira_em = :expira WHERE id = :id")
            ->execute([':token' => $token, ':expira' => $expira, ':id' => $usuario['id']]);

        // Envia o e-mail
        $link = "http://localhost/dreamflix/login/recupera.php?token=$token";
        $linkk = "http://localhost/dreamflix/login/login.php";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'guimaraespsn1@gmail.com';
            $mail->Password = 'dbau dbfq xhxy frcu';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('guimaraespsn1@gmail.com', 'DreamFlix');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Recuperação de Senha - DreamFlix';
            $mail->Body    = "Clique no link para redefinir sua senha:<br><a href=\"$link\">$link</a>";

            $mail->send();
            $mensagem = 'Link de recuperação enviado para seu e-mail.';
        } catch (Exception $e) {
            $mensagem = 'Erro ao enviar e-mail: ' . $mail->ErrorInfo;
        }
    } else {
        $mensagem = 'E-mail não encontrado.';
    }

    $showEmailForm = true;
}
// Etapa 2: Acessando o link com token
elseif (isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE token_recuperacao = :token AND token_expira_em > NOW()");
    $stmt->execute([':token' => $token]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $showResetForm = true;

        // Etapa 3: Redefinindo a senha
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['senha'], $_POST['senha2'])) {
            $senha = $_POST['senha'];
            $senha2 = $_POST['senha2'];

            if ($senha !== $senha2) {
                $mensagem = 'As senhas não coincidem.';
            } else {
                $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
                $pdo->prepare("UPDATE usuarios SET senha = :senha, token_recuperacao = NULL, token_expira_em = NULL WHERE id = :id")
                    ->execute([':senha' => $senhaHash, ':id' => $usuario['id']]);
                $mensagem = 'Senha alterada com sucesso. Você já pode entrar</a>.';
                $showResetForm = false;
            }
        }
    } else {
        $mensagem = 'Token inválido ou expirado.';
    }
} else {
    $showEmailForm = true;
}
?>
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Recuperação de Senha - DreamFlix</title>
  <style>
    * {box-sizing:border-box;margin:0;padding:0;font-family:'Segoe UI',sans-serif;}
    body {background-color:#0e0e0e;min-height:100vh;display:flex;align-items:center;justify-content:center;}
    .container {background-color:#a3c9f1;padding:2rem;border-radius:16px;box-shadow:0 0 20px rgba(163,201,241,0.3);width:100%;max-width:400px;text-align:center;position:relative;}
    .container::before,.container::after{content:'';position:absolute;width:40px;height:10px;background:#000;border-radius:5px;}
    .container::before{top:-10px;left:20px;} .container::after{bottom:-10px;right:20px;}
    .title {font-size:1.8rem;margin-bottom:1rem;color:#000;letter-spacing:1px;border-bottom:2px solid #000;display:inline-block;padding-bottom:5px;}
    form {display:flex;flex-direction:column;gap:1rem;margin-top:1rem;}
    input[type="email"], input[type="password"], input[type="submit"] {
      padding:0.75rem;border:none;border-radius:8px;font-size:1rem;
    }
    input[type="submit"] {
      background-color:#0e0e0e;color:#a3c9f1;cursor:pointer;transition:background-color .3s;
    }
    input[type="submit"]:hover{background-color:#1a1a1a;}
    .message{text-align:center;margin-top:1rem;color:#d00;font-weight:bold;}
    .footer{margin-top:1rem;font-size:0.9rem;color:#333;}
    a {color:#0e0e0e;font-weight:bold;text-decoration:none;}
    a:hover{color:#3a4f66;}
  </style>
</head>
<body>

<div class="container">
  <div class="title">
    <?php if ($showEmailForm): ?>
      📧 Recuperar Senha
    <?php elseif ($showResetForm): ?>
      🔑 Redefinir Senha
    <?php else: ?>
      🔒 Senha Alterada com sucesso!
    <?php endif; ?>
  </div>

  <?php if ($showEmailForm): ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Seu e‑mail cadastrado" required>
      <input type="submit" value="Enviar link de recuperação">
    </form>
  <?php elseif ($showResetForm): ?>
    <form method="POST">
      <input type="password" name="senha"  placeholder="Nova senha"        required>
      <input type="password" name="senha2" placeholder="Repita a nova senha" required>
      <input type="submit" value="Alterar senha">
    </form>
  <?php else: ?>
    <p class="message">Para acessar agora, clique <a href="index.php">aqui!</a>.</p>
  <?php endif; ?>

  <?php if ($mensagem): ?>
    <div class="message"><?= htmlspecialchars($mensagem) ?></div>
  <?php endif; ?>

  <div class="footer">DreamFlix – Seu mundo cinematográfico 🎟️</div>
</div>

</body>
</html>