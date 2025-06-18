<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - DreamFlix</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #0e0e0e;
      color: #fff;
    }

    nav {
      background-color: #a3c9f1;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .logo {
      font-size: 1.5rem;
      font-weight: bold;
      color: #0e0e0e;
    }

    .nav-links {
      display: flex;
      gap: 1.5rem;
      align-items: center;
    }

    .nav-links a {
      text-decoration: none;
      color: #0e0e0e;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #3a4f66;
    }

    .search-box {
      display: flex;
      align-items: center;
      background-color: #fff;
      border-radius: 8px;
      padding: 0.2rem 0.6rem;
    }

    .search-box input {
      border: none;
      outline: none;
      padding: 0.3rem;
      font-size: 1rem;
      background-color: transparent;
    }

    .search-box button {
      background-color: transparent;
      border: none;
      cursor: pointer;
      font-size: 1.1rem;
      color: #0e0e0e;
    }

    main {
      padding: 2rem;
    }
    .content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }
    .dashboard-box {
      background-color: #1a1a1a;
      border-radius: 12px;
      padding: 2rem;
      width: 100%;
      max-width: 500px;
      text-align: center;
      box-shadow: 0 0 20px rgba(163, 201, 241, 0.3);
    }

    .dashboard-box h2 {
      color: #a3c9f1;
      margin-bottom: 1rem;
    }

    .dashboard-box p {
      color: #ccc;
    }
    .logo-dropdown {
  position: relative;
}

.dropdown-menu {
  display: none;
  position: absolute;
  top: 2.5rem;
  left: 0;
  background-color: #a3c9f1;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  z-index: 10;
  min-width: 160px;
  overflow: hidden;
}

.dropdown-menu a {
  display: block;
  padding: 0.75rem 1rem;
  color: #0e0e0e;
  text-decoration: none;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.dropdown-menu a:hover {
  background-color: #cde4ff;
}

.logo {
  cursor: pointer;
  user-select: none;
}

  </style>
</head>
<body>

<nav>
  <div class="logo-dropdown">
    <div class="logo" onclick="toggleDropdown()">🎬 DreamFlix ⌄</div>
    <div class="dropdown-menu" id="dropdownMenu">
      <a href="#">👤 Perfil</a>
      <a href="#">⚙️ Configurações</a>
      <a href="#">🎨 Preferências</a>
      <a href="../login/logout.php">🚪 Logout</a>
    </div>
  </div>
  <div class="nav-links">
    <a href="#">Filmes</a>
    <a href="#">Séries</a>
    <a href="#">Plataformas</a>
    <a href="#">Já assistidos ✅</a>
    <div class="search-box">
      <input type="text" placeholder="Buscar...">
      <button>🔍</button>
    </div>
  </div>
</nav>

<main>
 <div class="content">
    <div class="dashboard-box">
      <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
      <p>Você está logado com sucesso no DreamFlix.</p>
    </div>
  </div>

</main>

<script>
  function toggleDropdown() {
    const menu = document.getElementById('dropdownMenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
  }

  // Esconde o menu ao clicar fora js
  document.addEventListener('click', function (e) {
    const menu = document.getElementById('dropdownMenu');
    const logo = document.querySelector('.logo');
    if (!logo.contains(e.target) && !menu.contains(e.target)) {
      menu.style.display = 'none';
    }
  });
</script>

</body>
</html>
