<?php
	require_once("sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if(!isset($sistema)){
        require_once("coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Bienvenido</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="demo-files/demo.css">
	<link rel="stylesheet" href="css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<header><h1>Bienvenido <?php echo $nombre_pasante; ?></h1></header>
		<nav>
			<ul>
				<li><a href="registro_paciente.php"><span class="icon icon-file-text"></span>Registro paciente</a></li>
				<li><a href="buscar_paciente.php"><span class="icon icon-profile"></span>Buscar paciente</a></li>
				<li><a href="#"><span class="icon icon-newspaper"></span>Reportes</a></li>
				<li><a href="#"><span class="icon icon-file-text2"></span>Estad&iacute;sticas</a></li>
				<li><a href="index.php"><span class="icon icon-clock"></span>Cerrar Sesi&oacute;n</a></li>
			</ul>
		</nav>
		<section id="cuerpo">
		</section>
	</section>
</body>
</html>