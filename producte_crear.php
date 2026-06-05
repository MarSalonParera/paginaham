<?php require_once __DIR__ . '/auth.php'; require_role('Treballador'); require_once __DIR__ . '/config.php'; // Protege la página y carga DB ?>
<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <title>Crear Producte</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>📦 Crear Producte</h1>
    <div>
      <a href="/worker.php">← Tornar al Dashboard</a>
    </div>
  </header>

  <main>
    <div class="card">
      <?php
      $msg = null;
      if ($_SERVER['REQUEST_METHOD']==='POST') {
        $db = get_db();
        $stmt = $db->prepare('INSERT INTO Productes (nom, preu, stock) VALUES (?,?,?)');
        $stmt->bind_param('sdi', $_POST['nom'], $_POST['preu'], $_POST['stock']);
        $msg = $stmt->execute() ? 'Producte creat correctament' : 'Error en crear el producte';
      }
      ?>
      <?php if ($msg): ?>
        <div class="alert <?php echo (strpos($msg, 'Error') === false ? 'alert-success' : 'alert-danger'); ?>">
          <?php echo htmlspecialchars($msg); ?>
        </div>
      <?php endif; ?>

      <h2>Dades del Producte</h2>
      <form method="post">
        <div class="form-group">
          <label for="nom">Nom del Producte *</label>
          <input id="nom" name="nom" type="text" placeholder="Escriu el nom del producte" required autofocus>
        </div>
        <div class="form-group">
          <label for="preu">Preu (€) *</label>
          <input id="preu" name="preu" type="number" step="0.01" placeholder="0.00" required>
        </div>
        <div class="form-group">
          <label for="stock">Stock (unitats) *</label>
          <input id="stock" name="stock" type="number" min="0" value="0" placeholder="0" required>
        </div>
        <button type="submit" class="btn btn-primary">✓ Crear Producte</button>
        <a href="/worker.php" class="btn btn-secondary">Cancel·lar</a>
      </form>
    </div>
  </main>

  <footer>
    <p>Empresa - Sistema de Gestió | &copy; 2025</p>
  </footer>
</body>
</html>