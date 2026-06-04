<!DOCTYPE html>
<html>
<head>
    <title>Electronica</title>

    <style>
        .producto{
            width: 300px;
            border: 1px solid black;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        .producto img{
            width: 250px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<?php
$consulta = mysqli_query($conexion, "SELECT * FROM mobiliaria");

while($fila = mysqli_fetch_assoc($consulta)){
?>
    <div class="producto">

        <h2><?php echo $fila['nombre']; ?></h2>

        <img src="<?php echo $fila['imagen1']; ?>" width="250" height="200">

        <img src="<?php echo $fila['imagen2']; ?>" width="250" height="200">

        <img src="<?php echo $fila['imagen3']; ?>" width="250" height="200">

        <p><?php echo $fila['descripcion']; ?></p>

        <p><?php echo $fila['precio']; ?> €</p>

    </div>

<?php
}
?>

</body>
</html>