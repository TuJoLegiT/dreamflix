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
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('imagem-fundo.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      backdrop-filter: blur(10px);
      background-color: rgba(0, 0, 0, 0.6);
      z-index: -1;
    }

    nav {
      background-color: rgba(163, 201, 241, 0.95);
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
      cursor: pointer;
      user-select: none;
    }

    .nav-links {
      display: flex;
      gap: 1.5rem;
      align-items: center;
      position: relative;
    }

    .nav-links a {
      text-decoration: none;
      color: #0e0e0e;
      font-weight: bold;
      position: relative;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #3a4f66;
    }

    .menu-item {
      position: relative;
    }

    .submenu {
      display: none;
      position: absolute;
      top: 2.5rem;
      left: 0;
      background-color: rgba(163, 201, 241, 0.9);
      border-radius: 8px;
      padding: 0.5rem 0;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(6px);
      min-width: 160px;
    }

    .submenu a {
      display: block;
      padding: 0.5rem 1rem;
      color: #0e0e0e;
      text-decoration: none;
      font-weight: normal;
    }

    .submenu a:hover {
      background-color: #cde4ff;
    }

    .menu-item:hover .submenu {
      display: block;
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
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 2rem;
    }

    .dashboard-box {
      background-color: rgba(26, 26, 26, 0.9);
      border-radius: 12px;
      padding: 2rem;
      max-width: 500px;
      width: 100%;
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

    .dashboard-section {
      width: 100%;
      max-width: 1000px;
    }

    .dashboard-section h3 {
      color: #a3c9f1;
      margin-bottom: 1rem;
      text-align: center;
    }

    .tickets {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
    }

    .ticket-card {
      background-color: rgba(34, 34, 34, 0.9);
      padding: 1rem;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(163, 201, 241, 0.2);
      width: 250px;
      transition: transform 0.3s ease;
      text-align: center;
    }

    .ticket-card:hover {
      transform: scale(1.03);
    }

    .ticket-card h4 {
      color: #a3c9f1;
    }

    .ticket-card p {
      color: #ccc;
      margin: 0.5rem 0;
    }

    .ticket-card button {
      margin-top: 0.5rem;
      background-color: #a3c9f1;
      color: #000;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .ticket-card button:hover {
      background-color: #cde4ff;
    }

    /* Dropdown menu já existente */
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
    }

    .dropdown-menu a {
      display: block;
      padding: 0.75rem 1rem;
      color: #0e0e0e;
      text-decoration: none;
      font-weight: bold;
    }

    .dropdown-menu a:hover {
      background-color: #cde4ff;
    }

    .logo-dropdown:hover .dropdown-menu {
      display: block;
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
      <a href="logout.php">🚪 Logout</a>
    </div>
  </div>
  <div class="nav-links">
    <div class="menu-item">
      <a href="#">Filmes</a>
      <div class="submenu">
        <a href="#">Lançamentos</a>
        <a href="#">Em Cartaz</a>
        <a href="#">Favoritos</a>
      </div>
    </div>
    <div class="menu-item">
      <a href="#">Séries</a>
      <div class="submenu">
        <a href="#">Novas Temporadas</a>
        <a href="#">Mais Votadas</a>
      </div>
    </div>
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

    <section class="dashboard-section">
      <h3>🎟️ Bilheteria de Hoje</h3>
      <div class="tickets">
        <div class="ticket-card">
          <h4>Filme: Vingança Cósmica</h4>
          <p>Ingressos vendidos: <strong>Loading...</strong></p>
          <button onclick="alert('Reservado!')">Reservar Ingresso</button>
        </div>
        <div class="ticket-card">
          <h4>Filme: A Última Dimensão</h4>
          <p>Ingressos vendidos: <strong>Loading...</strong></p>
          <button onclick="alert('Reservado!')">Reservar Ingresso</button>
        </div>
      </div>
    </section>
  </div>
</main>

<script>
  function toggleDropdown() {
    const menu = document.getElementById('dropdownMenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
  }

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
