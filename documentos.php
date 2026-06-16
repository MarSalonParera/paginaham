<?php

session_start();

$usuario = "masapa";
$contrasena = "MiClave2026";

if(isset($_POST["usuario"]) && isset($_POST["contrasena"])){

    if(
        $_POST["usuario"] === $usuario &&
        $_POST["contrasena"] === $contrasena
    ){
        $_SESSION["autorizado"] = true;
    }else{
        $error = "Usuario o contraseña incorrectos";
    }
}

if(!isset($_SESSION["autorizado"])){
?>

<!DOCTYPE html>

<html lang="es">
<head>
<meta charset="UTF-8">
<title>Acceso privado</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card mx-auto" style="max-width:400px;">
<div class="card-body">

<h3 class="text-center mb-4">Acceso privado</h3>

<?php if(isset($error)){ ?>

<div class="alert alert-danger">
<?php echo $error; ?>
</div>
<?php } ?>

<form method="post">

<div class="mb-3">
<label>Usuario</label>
<input type="text" name="usuario" class="form-control" required>
</div>

<div class="mb-3">
<label>Contraseña</label>
<input type="password" name="contrasena" class="form-control" required>
</div>

<button type="submit" class="btn btn-primary w-100">
Entrar
</button>

</form>

</div>
</div>

</div>

</body>
</html>

<?php
exit;
}

include("config.php");

$resultado = $conexion->query("
SELECT *
FROM solicitudes
ORDER BY fecha DESC
");

?>

<!DOCTYPE html>

<html lang="es">
<head>
<meta charset="UTF-8">
<title>Solicitudes recibidas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h1 class="mb-4">Solicitudes recibidas</h1>

<?php

if($resultado->num_rows == 0){
    echo "<div class='alert alert-warning'>No hay solicitudes registradas.</div>";
}

while($fila = $resultado->fetch_assoc()){

?>

<div class="card mb-3">
    <div class="card-body">


    <h4><?php echo $fila["empresa"]; ?></h4>

    <p><strong>Nombre:</strong>
    <?php echo $fila["nombre"] . " " . $fila["apellidos"]; ?></p>

    <p><strong>Email:</strong>
    <?php echo $fila["email"]; ?></p>

    <p><strong>Teléfono:</strong>
    <?php echo $fila["telefono"]; ?></p>

    <p><strong>CIF:</strong>
    <?php echo $fila["cif"]; ?></p>

    <p><strong>Fecha:</strong>
    <?php echo $fila["fecha"]; ?></p>

    <?php if(!empty($fila["iae"])){ ?>
        <a href="documentos/<?php echo $fila["iae"]; ?>"
           target="_blank"
           class="btn btn-primary">
           Ver IAE
        </a>
    <?php } ?>

    <?php if(!empty($fila["certificado"])){ ?>
        <a href="documentos/<?php echo $fila["certificado"]; ?>"
           target="_blank"
           class="btn btn-success">
           Ver Certificado
        </a>
    <?php } ?>

</div>


</div>

<?php
}
?>

</div>

</body>
</html>
