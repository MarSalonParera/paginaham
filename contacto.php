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
            <li><a href="cuenta.html">Solicitud de alta</a></li>
             <li><a href="inicarsesion.html">Iniciar sesión</a></li>
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
            if(isset($resultado)){
                echo "<div class='alert alert-info'>$resultado</div>";
            }
            ?>

            <form method="POST">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" name="telefono" class="form-control">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Comentario</label>
                        <textarea
                            name="comentario"
                            rows="5"
                            class="form-control"
                            required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-trade">
                            Enviar mensaje
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>