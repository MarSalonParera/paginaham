<?php

$mensajeExito = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $empresa = $_POST["empresa"];
    $cif = $_POST["cif"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $ciudad = $_POST["ciudad"];
    $codigoPostal = $_POST["codigoPostal"];
    $provincia = $_POST["provincia"];

    $carpeta = "documentos/";

    if(!is_dir($carpeta)){
        mkdir($carpeta, 0777, true);
    }

    $archivoIAE = "";
    $archivoCertificado = "";

    if(isset($_FILES["iae"]) && $_FILES["iae"]["error"] == 0){

        $archivoIAE = time() . "_" . basename($_FILES["iae"]["name"]);

        move_uploaded_file(
            $_FILES["iae"]["tmp_name"],
            $carpeta . $archivoIAE
        );
    }

    if(isset($_FILES["certificado_revendedor"]) &&
       $_FILES["certificado_revendedor"]["error"] == 0){

        $archivoCertificado = time() . "_" . basename($_FILES["certificado_revendedor"]["name"]);

        move_uploaded_file(
            $_FILES["certificado_revendedor"]["tmp_name"],
            $carpeta . $archivoCertificado
        );
    }

    $mensajeExito = "Solicitud enviada correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de alta</title>

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
            <li><a href="contacto.php">Contacto</a></li>
        </ul>

    </nav>
</header>

<?php if(!empty($mensajeExito)): ?>

<div class="container mt-4">
    <div class="alert alert-success">
        <?php echo $mensajeExito; ?>
    </div>
</div>

<?php endif; ?>

<form
    id="formulario"
    class="container mt-5 mb-5"
    method="POST"
    enctype="multipart/form-data">

    <div class="card p-4">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Nombre *</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Apellidos *</label>
                <input type="text" name="apellidos" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Empresa *</label>
                <input type="text" name="empresa" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">CIF / NIF *</label>
                <input type="text" name="cif" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Teléfono *</label>
                <input type="tel" name="telefono" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Correo electrónico *</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Dirección *</label>
                <input type="text" name="direccion" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Ciudad *</label>
                <input type="text" name="ciudad" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Código Postal *</label>
                <input type="text" name="codigoPostal" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Provincia *</label>

                <select name="provincia" class="form-select" required>
                    <option value="">Seleccionar</option>
                    <option>Madrid</option>
                    <option>Barcelona</option>
                    <option>Valencia</option>
                    <option>Sevilla</option>
                    <option>Zaragoza</option>
                </select>

            </div>

            <div class="col-12 mb-4">
                <label class="form-label">Subir IAE *</label>

                <input
                    type="file"
                    name="iae"
                    class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png,.gif"
                    required>

                <small class="text-muted">
                    Formatos admitidos: pdf, jpg, png, gif
                </small>
            </div>

            <div class="col-12 mb-4">
                <label class="form-label">Subir Certificado revendedor</label>

                <input
                    type="file"
                    name="certificado_revendedor"
                    class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png,.gif">

                <small class="text-muted">
                    Formatos admitidos: pdf, jpg, png, gif
                </small>
            </div>

            <div class="col-12 mb-4">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="condiciones"
                        required>

                    <label class="form-check-label" for="condiciones">
                        He leído y acepto las condiciones generales y la política de privacidad
                    </label>

                </div>

            </div>

            <div class="col-12">

                <button type="submit" class="btn btn-primary">
                    Enviar solicitud
                </button>

            </div>

        </div>

    </div>
</form>
</body>
</html>