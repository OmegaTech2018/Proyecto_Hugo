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
<html lang="es">
<head>
	<title>Expediente Médico del Paciente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="demo-files/demo.css">
	<link rel="stylesheet" href="css/estilo_expediente.css" type="text/css">
	<script src="js/div.js"></script>
    <script src="js/funcion.js"></script><!--CONTIENE LA FUNCION PARA QUE LA PESTAÑA AL DARLE CLICK MUESTRE LO INDICADO-->
</head>
<body>
	<section id="contenedor2">
		<header><h1><?php echo $nombre_pasante; ?><br><br>Expediente del Paciente</h1></header>
		<div class="tab">
			<ul>
				<li><a href="bienvenido.php"><span class="icon icon-home2"></span>Inicio</a></li>
				<li><button class="tablinks" onclick="openCity(event, 'notas')"><span class="icon icon-newspaper"></span>Notas</button></li>
  				<li><button class="tablinks" onclick="openCity(event, 'historia_clinica')"><span class="icon icon-file-text2"></span>Historia Clinica</button></li>
  				<li><button class="tablinks" onclick="openCity(event, 'laboratorio')"><span class="icon icon-file-text2"></span>Laboratorios</button></li>
  				<li><button class="tablinks" onclick="openCity(event, 'gabinete')"><span class="icon icon-file-text2"></span>Gabinete</button></li>
  				<li><button class="tablinks" onclick="openCity(event, 'cita')"><span class="icon icon-clock"></span>Cita</button></li>
  				<li><a href="index.php"><span class="icon icon-clock"></span>Cerrar Sesi&oacute;n</a></li>
			</ul>
		</div>
		<div id="notas" class="tabcontent">
			<?php  include_once("expediente_notas.php"); ?>
		</div>
		<div id="historia_clinica" class="tabcontent">
  			<?php  include_once("expediente_historia_clinica.php"); ?> 
		</div>
		<div id="laboratorio" class="tabcontent">
  			<?php  include_once("expediente_laboratorio.php"); ?>
		</div>
		<div id="gabinete" class="tabcontent">
  			<?php  include_once("expediente_gabinete.php"); ?>
		</div>
		<div id="cita" class="tabcontent">
  			<?php  include_once("expediente_cita.php"); ?>
		</div>
	</section>
</body>
</html>