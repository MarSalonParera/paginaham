<?php
// Requiere HTTPS excepto en localhost
if (strpos($_SERVER['HTTP_HOST'], 'localhost') === false && 
    strpos($_SERVER['HTTP_HOST'], '127.0.0.1') === false &&
    empty($_SERVER['HTTPS'])) {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit;
}

$DB_HOST = 'sMysql';          // Nombre del servicio MySQL en Docker Compose
$DB_USER = 'ham';
$DB_PASS = 'ClotFje26@';
$DB_NAME = 'TRADE DIGITAL';
$DB_PORT = 3306;

function get_db() {
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT;
    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
    if ($mysqli->connect_errno) {
        die('Error de conexión a la base de datos: '.$mysqli->connect_error);
    }
    $mysqli->set_charset('utf8mb4');
    return $mysqli;
}
?>