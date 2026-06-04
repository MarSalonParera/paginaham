<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $destinatario = "tucorreo@ejemplo.com";

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $comentario = $_POST['comentario'];

    $asunto = "Nuevo formulario de contacto";

    $mensaje = "
Nombre: $nombre

Correo: $email

Teléfono: $telefono

Comentario:
$comentario
";

    $headers = "From: $email";

    if(mail($destinatario, $asunto, $mensaje, $headers)){
        $resultado = "Mensaje enviado correctamente.";
    } else {
        $resultado = "Error al enviar el mensaje.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
</head>
<body>

<h1>Formulario de contacto</h1>

<?php
if(isset($resultado)){
    echo "<p>$resultado</p>";
}
?>

<form method="POST" action="">
    <label>Nombre</label>
    <input type="text" name="nombre" required>

    <label>Correo electrónico</label>
    <input type="email" name="email" required>

    <label>Teléfono</label>
    <input type="tel" name="telefono">

    <label>Comentario</label>
    <textarea name="comentario" required></textarea>

    <button type="submit">Enviar</button>
</form>

</body>
</html>