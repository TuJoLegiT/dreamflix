<?php
session_start();
$mensagem = $_SESSION['mensagem'] ?? '';
unset($_SESSION['mensagem']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Login - CinePainel</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: url('assets/fundo-filmes.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: rgba(0, 0, 0, 0.85);
      padding: 2.5rem;
      border-radius: 15px;
      box-shadow: 0 0 15px #a3c9f1;
      text-align: center;
      color: #a3c9f1;
      width: 320px;
    }

    .login-container h2 {
      margin-bottom: 1.5rem;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 0.75rem;
      margin-bottom: 1rem;
      border: none;
      border-radius: 8px;
      background-color: #1f1f1f;
      color: #fff;
    }

    .login-container input[type="submit"] {
      width: 100%;
      padding: 0.75rem;
      background-color: #a3c9f1;
      color: #000;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }

    .login-container .login-links {
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .login-container .login-links a {
      color: #a3c9f1;
      text-decoration: none;
      margin: 0 5px;
    }

    .login-container .login-links a:hover {
      text-decoration: underline;
    }

    .mensagem {
      margin-top: 1rem;
      color: #ff8080;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Login CinePainel</h2>

    <form action="login.php" method="POST">
      <input type="text" name="usuario" placeholder="Usuário" required />
      <input type="password" name="senha" placeholder="Senha" required />
      <input type="submit" value="Entrar" />
    </form>

    <div class="login-links">
      <a href="registro.php">Criar conta</a> |
      <a href="#">Esqueci minha senha</a>
    </div>

    <?php if (!empty($mensagem)): ?>
      <div class="mensagem"><?php echo htmlspecialchars($mensagem); ?></div>
    <?php endif; ?>
  </div>

</body>
</html>