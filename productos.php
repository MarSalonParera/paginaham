<?php
$conexion = mysqli_connect("localhost", "root", "", "tradedigital");

if (!$conexion) {
    die("Error de conexión");
}

$resultado = mysqli_query($conexion, "SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>

<h1>Nuestros Productos</h1>

<?php while($producto = mysqli_fetch_assoc($resultado)) { ?>
    <div>
        <h3><?php echo $producto['nombre']; ?></h3>
        <p><?php echo $producto['precio']; ?> €</p>
    </div>
<?php } ?>

</body>
</html>