<?php require_once __DIR__ . '/auth.php'; require_role('Treballador'); require_once __DIR__ . '/config.php'; // Protege la página y carga DB ?>
<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <title>Modificar Producte</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>✏️ Modificar Producte</h1>
    <div>
      <a href="/worker.php">← Tornar al Dashboard</a>
    </div>
  </header>

  <main>
    <div class="card">
      <?php
      $msg = null;
      $db = get_db();
      if ($_SERVER['REQUEST_METHOD']==='POST') {
        $stmt = $db->prepare('UPDATE Productes SET nom=?, preu=?, stock=? WHERE id=?');
        $stmt->bind_param('sdii', $_POST['nom'], $_POST['preu'], $_POST['stock'], $_POST['id']);
        $msg = $stmt->execute() ? 'Producte actualitzat correctament' : 'Error en actualitzar el producte';
      }
      $row = null;
      if (!empty($_GET['id'])) {
        $stmt = $db->prepare('SELECT * FROM Productes WHERE id=?');
        $stmt->bind_param('i', $_GET['id']);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
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
          <label for="id">ID del Producte *</label>
          <input id="id" name="id" type="number" placeholder="Escriu l'ID" required value="<?php echo htmlspecialchars($row['id'] ?? ''); ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="nom">Nom del Producte *</label>
          <input id="nom" name="nom" type="text" placeholder="Nom" required value="<?php echo htmlspecialchars($row['nom'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label for="preu">Preu (€) *</label>
          <input id="preu" name="preu" type="number" step="0.01" placeholder="0.00" required value="<?php echo htmlspecialchars($row['preu'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label for="stock">Stock (unitats) *</label>
          <input id="stock" name="stock" type="number" min="0" placeholder="0" required value="<?php echo htmlspecialchars($row['stock'] ?? ''); ?>">
        </div>
        <button type="submit" class="btn btn-primary">✓ Desar Canvis</button>
        <a href="/worker.php" class="btn btn-secondary">Cancel·lar</a>
      </form>
    </div>
  </main>

  <footer>
    <p>Empresa - Sistema de Gestió | &copy; 2025</p>
  </footer>
</body>
</html>