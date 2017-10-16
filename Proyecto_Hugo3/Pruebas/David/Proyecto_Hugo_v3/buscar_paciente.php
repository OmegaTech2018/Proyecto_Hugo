<?php
	require_once("sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if(!isset($sistema)){
        require_once("coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }

    //echo $usuario." ".$nombre_pasante;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buscar Paciente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="demo-files/demo.css">
	<link rel="stylesheet" href="css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<nav>
			<ul>
				<li><a href="bienvenido.php"><span class="icon icon-home2"></span>Inicio</a></li>
				<li><a href="registro_paciente.php"><span class="icon icon-file-text"></span>Registro paciente</a></li>
				<li><a href="#"><span class="icon icon-newspaper"></span>Reportes</a></li>
				<li><a href="#"><span class="icon icon-file-text2"></span>Estad&iacute;sticas</a></li>
				<li><a href="index.php"><span class="icon icon-clock"></span>Cerrar Sesi&oacute;n</a></li>
			</ul>
		</nav>
		<header><h1><?php echo $nombre_pasante; ?><br><br>Formulario de Busqueda de Paciente</h1></header>
		<section id="cuerpo">
			<form action="abrir_expediente.php" method="post">
				<p>
					Ingrese el apellido paterno del paciente: <input type="text" id="busca_paciente" name="busca_paciente" required="required">
				</p>
				<br><br>
            	<input type="submit" value="Buscar Paciente">
			</form>
		</section>
	</section>
</body>
</html>