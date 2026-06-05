<?php require_once __DIR__ . '/auth.php'; require_role('Treballador'); require_once __DIR__ . '/config.php'; // Protege la página y carga DB ?>
<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <title>Llistat de Productes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Llistat de Productes</h1>
    <div>
      <a href="/worker.php">← Tornar al Dashboard</a>
    </div>
  </header>
  
  <main>
    <div class="card">
      <?php
        $db = get_db();
        $res = $db->query('SELECT id, nom, preu, stock FROM Productes ORDER BY nom');
        $count = 0;
        echo '<table>';
        echo '<thead><tr><th>ID</th><th>Nom Producte</th><th>Preu (€)</th><th>Stock</th></tr></thead>';
        echo '<tbody>';
        while ($row = $res->fetch_assoc()) {
          $count++;
          echo '<tr>';
          echo '<td>' . htmlspecialchars((string)$row['id']) . '</td>';
          echo '<td>' . htmlspecialchars((string)$row['nom']) . '</td>';
          echo '<td>' . htmlspecialchars((string)$row['preu']) . '€</td>';
          echo '<td><span style="' . ($row['stock'] < 10 ? 'color: #e74c3c; font-weight: bold;' : '') . '">' . htmlspecialchars((string)$row['stock']) . '</span></td>';
          echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<p style="margin-top: 20px; text-align: center; color: #7f8c8d;">Total: <strong>' . $count . '</strong> productos</p>';
      ?>
    </div>
  </main>

  <footer>
    <p>Empresa - Sistema de Gestió | &copy; 2025</p>
  </footer>
</body>
</html>