<?php
// Página de error de acceso denegado
require_once __DIR__ . '/auth.php';
?>
<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <title>Accés denegat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body { font-family: system-ui, sans-serif; max-width: 600px; margin: 50px auto; text-align: center; }
    .error-box { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 20px; border-radius: 5px; }
    h1 { color: #721c24; margin-top: 0; }
    .button { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
  </style>
</head>
<body>
  <div class="error-box">
    <h1>⚠️ Accés denegat</h1>
    <p>No tens permís per accedir a aquesta pàgina.</p>
    <p><?php 
    if (is_logged_in()) {
      echo 'Si necessites accés, contacta amb l\'administrador.';
    } else {
      echo 'Necessites iniciar sessió per accedir.';
    }
    ?></p>
    
    <a href="<?php echo is_logged_in() ? '/worker.php' : '/login.php'; ?>" class="button">
      <?php echo is_logged_in() ? 'Tornar al Dashboard' : 'Ir al Login'; ?>
    </a>
    
    <?php if (is_logged_in()): ?>
      <p style="margin-top: 20px;">
        <a href="/logout.php" style="color: #007bff;">Logout</a>
      </p>
    <?php endif; ?>
  </div>
</body>
</html>