<?php require_once __DIR__ . '/auth.php'; require_role('Treballador'); require_once __DIR__ . '/config.php'; // Protege la página y carga DB ?>
<!doctype html> <!-- Documento HTML5 -->
<html lang="ca"> <!-- Idioma catalán -->
<head> <!-- Cabecera -->
  <meta charset="utf-8"> <!-- Codificación -->
  <title>Esborrar producte</title> <!-- Título -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive -->
  <style>body{font-family:system-ui,sans-serif;max-width:600px;margin:40px auto}form{display:grid;gap:8px}</style> <!-- Estilos compactos -->
</head> <!-- Fin cabecera -->
<body> <!-- Cuerpo -->
  <h1>Esborrar producte</h1> <!-- Título -->
  <?php
  $msg = null; // Mensaje de feedback
  if ($_SERVER['REQUEST_METHOD']==='POST') { // Si se envió el formulario
    $db = get_db(); // Conexión DB
    $stmt = $db->prepare('DELETE FROM Productes WHERE id=?'); // Prepara DELETE por ID
    $stmt->bind_param('i', $_POST['id']); // Bindea ID (entero)
    $msg = $stmt->execute() ? 'Esborrat correctament' : 'Error en esborrar'; // Ejecuta y setea mensaje
  }
  ?> <!-- Fin bloque PHP -->
  <?php if ($msg): ?><p><?php echo htmlspecialchars($msg); ?></p><?php endif; ?> <!-- Muestra mensaje si existe -->
  <form method="post"> <!-- Formulario POST -->
    <input name="id" type="number" placeholder="ID" required> <!-- ID del producto a borrar -->
    <button type="submit">Esborrar</button> <!-- Botón borrar -->
  </form> <!-- Fin formulario -->
  <p><a href="/worker.php">Tornar al Dashboard</a></p> <!-- Enlace de regreso -->
</body> <!-- Fin cuerpo -->
</html> <!-- Fin documento -->