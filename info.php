<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Portal d'Alimentació - Grup8</title>
		<link rel="stylesheet" href="../../../css/style.css" />
	</head>
	<body>
		<h2><b>Informació sobre el Portal de Nutrició</b></h2>
        <p>Aquesta aplicació gestiona les dades de:</p>
        <label>--Plans Nutricionals Individuals (Dietes)</label><br>
        <label>--Registre i Seguiment de Clients</label><br>
        <label>--Base de Dades d'Aliments i Receptes</label><br>
        <p>Per poder accedir a la plataforma heu de tenir un compte d'usuari i una contrasenya d'accés.</p>
        <p><a href="index.php">Torna a la pàgina inicial</a></p>
        <label class="diahora"> 
        <?php
			date_default_timezone_set('Europe/Andorra');
			echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";
        ?>
        </label>
	</body>
</html>