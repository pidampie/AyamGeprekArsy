<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
  <nav class="navbar">
    <div class="logo">
      <img src="asset/logo.png" alt="Logo Ayam Geprek Arsy">
      <h1>Ayam Geprek Arsy</h1>
    </div>

    <ul class="nav-links">
      <li><a href="index.php#beranda">Beranda</a></li>
      <li><a href="index.php#menu">Menu</a></li>
      <li><a href="index.php#galeri">Galeri</a></li>
      <li><a href="index.php#info">Info</a></li>

      <?php if (isset($_SESSION['Email']) && !empty($_SESSION['Email'])): ?>
        
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
          <li><a href="dashboard.php" style= color: #fff; padding: 5px 10px; border-radius: 5px; font-weight: bold;">Dashboard</a></li>
      <?php endif; ?>

        <li class="logout-item"><a href="logout.php" style="color: red;">Logout (<?= explode('@', $_SESSION['Email'])[0] ?>)</a></li>

      <?php else: ?>
        
        <li class="login-item"><a href="login-page.php">Login</a></li>
        
      <?php endif; ?>
    </ul>

    <div class="menu-toggle" id="menu-toggle">&#9776;</div>
  </nav>
</header>