<?php

$conexion = new mysqli(
    "sql305.infinityfree.com",
    "if0_42186931",
    "y79ROCTBc3mAprw",
    "if0_42186931_tradedigital"
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>