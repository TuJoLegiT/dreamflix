<?php
require '../config/db.php';

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $email = $_POST['email'] ??'';

    if (!$usuario || !$senha) {
        $mensagem = "Preencha todos os campos.";
    } else {
        // Verifica se já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :usuario");
        $stmt->execute([':usuario' => $usuario]);

        if ($stmt->fetch()) {
            $mensagem = "Usuário já existe.";
        } else {
    // Cria o hash da senha com algoritmo forte
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO usuarios (usuario, senha, email)
        VALUES (:usuario, :senha, :email)
    ");

    $stmt->execute([
        ':usuario' => $usuario,
        ':senha'   => $senha_hash,
        ':email'   => $email
    ]);

    $mensagem = "Usuário cadastrado com sucesso!";
}
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuário</title>
  <style>
    body {
      background-color: #0e0e0e;
      color: #a3c9f1;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      font-family: sans-serif;
    }
    /* Fundo com imagem desfocada */
  body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: url('assets/bilheteria.jpg') no-repeat center center/cover;
    filter: blur(4px) brightness(0.3);
    z-index: -1;
  }
    .form-box {
      background-color: #1a1a1a;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 15px #a3c9f1;
      width: 300px;
    }
    
    input {
      width: 100%;
      padding: 0.6rem;
      margin-bottom: 1rem;
      border: none;
      border-radius: 6px;
    }
    button {
      width: 100%;
      padding: 0.6rem;
      background-color: #a3c9f1;
      border: none;
      border-radius: 6px;
      color: #0e0e0e;
      font-weight: bold;
      cursor: pointer;
    }
    .mensagem {
      margin-top: 1rem;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Registrar Novo Usuário</h2>
  <form method="POST">
    <input type="text" name="usuario" placeholder="Usuário" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Registrar</button>
  </form>
  <?php if ($mensagem): ?>
    <div class="mensagem"><?php echo htmlspecialchars($mensagem); ?></div>
  <?php endif; ?>
</div>

</body>
</html>
