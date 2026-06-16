<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - Trade Digital</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./css/style.css">
</head>
<body>
 <header>
    <nav>

    <div class="logo-container">
        <img src="img/logo.png" alt="Trade Digital" class="logo-img">
        <h1 class="logo-text">TRADE DIGITAL</h1>
    </div>
    <ul class="menu">
           <li><a href="index.html">Inicio</a></li>
            <li><a href="servicios.html">Servicios</a></li>
            <li><a href="cuenta.php">Solicitud de alta</a></li>
    </ul>


</nav>
</header>
<div class="container py-5">

    <div class="card contacto-card">

        <div class="card-body p-5">

            <h1 class="titulo-contacto text-center mb-4">
                Contacta con Trade Digital
            </h1>


<?php

include("config.php");

$mensaje = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $comentario = $_POST["comentario"];

    $stmt = $conexion->prepare(
        "INSERT INTO contactos (nombre,email,telefono,comentario)
         VALUES (?,?,?,?)"
    );

    if(!$stmt){
        die("Error SQL: " . $conexion->error);
    }

    $stmt->bind_param(
        "ssss",
        $nombre,
        $email,
        $telefono,
        $comentario
    );

    if($stmt->execute()){
        $mensaje = "<div class='alert alert-success'>
                        Mensaje enviado correctamente.
                    </div>";
    }else{
        $mensaje = "<div class='alert alert-danger'>
                        Error: ".$stmt->error."
                    </div>";
    }

    $stmt->close();
}

?>
<form method="POST">

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Correo electrónico</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input type="tel" name="telefono" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Comentario</label>
        <textarea name="comentario" rows="5" class="form-control" required></textarea>
    </div>

    <div class="text-center">   
        <button type="submit" class="btn btn-primary btn-trade">
            Enviar mensaje
        </button>
    </div>

</form>

        </div>

    </div>

</div>

</body>
</html>