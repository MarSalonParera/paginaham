<?php require_once __DIR__ . '/auth.php'; require_role('Administrador'); require_once __DIR__ . '/config.php'; $u = current_user(); ?>
<!doctype html>
<html lang="ca">
<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <title>Dashboard Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Dashboard Administrador</h1>
    <div>
      <span>Usuari: <strong><?php echo htmlspecialchars($u['nom_usuari']); ?></strong> | Tipus: <strong><?php echo htmlspecialchars($u['tipus']); ?></strong></span>
      <a href="/logout.php">Tancar Sessió</a>
    </div>
  </header>

  <main>
    <div class="card">
      <h2>👥 Gestio de Treballadors</h2>
      <ul class="list-group">
        <li><a href="/worker_view.php">Consulta d'un treballador</a></li>
        <li><a href="/worker_list.php">Llistat de treballadors</a></li>
        <li><a href="/worker_create.php">Crear treballador nou</a></li>
        <li><a href="/worker_edit.php">Modificar treballador</a></li>
        <li><a href="/worker_delete.php">Esborrar treballador</a></li>
      </ul>
      <a href="/export-pdf.php?type=workers" class="btn btn-success mt-20">Descarregar PDF - Treballadors</a>
    </div>

    <div class="card">
      <h2>📕 Gestio de Productes</h2>
      <ul class="list-group">
        <li><a href="/product_view.php">Consulta d'un producte</a></li>
        <li><a href="/product_list.php">Llistat de productes</a></li>
        <li><a href="/product_create.php">Crear producte nou</a></li>
        <li><a href="/product_edit.php">Modificar producte</a></li>
        <li><a href="/product_delete.php">Esborrar producte</a></li>
      </ul>
      <a href="/export-pdf.php?type=products" class="btn btn-success mt-20">Descarregar PDF - Productes</a>
    </div>

    <div class="card text-center mt-20">
      <a href="/index.php" class="btn btn-secondary">← Tornar a la presentació</a>
    </div>
  </main>

  <footer>
    <p>Empresa - Sistema de Gestió | &copy; 2025</p>
  </footer>
</body>
</html>
</html>