<?php
	require_once("../sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
	$nombre_paciente=$_GET['nombre_paciente'];
	$sexo=$_GET['sexo'];
	if(!isset($sistema)){
        require_once("../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
    $opcion=$_GET['opcion'];
    //echo $opcion."<br>";
    //echo $usuario." ".$nombre_pasante." ".$paciente_id." ".$nombre_paciente;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Expediente Médico del Paciente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../demo-files/demo.css">
	<link rel="stylesheet" href="../css/estilo_bienvenido.css" type="text/css">
	<link rel="stylesheet" href="../css/estilo_expediente.css" type="text/css">
	<script src="../js/div.js"></script>
    <script src="../js/funcion.js"></script><!--CONTIENE LA FUNCION PARA QUE LA PESTAÑA AL DARLE CLICK MUESTRE LO INDICADO-->
</head>
<body>
	<section id="contenedor">
		<nav>
			<ul>
				<li><a href="../bienvenido.php"><span class="icon icon-home2"></span>Inicio</a></li>
				<li><a href="registro_paciente.php?opcion_nota=4"><span class="icon icon-file-text"></span>Registro paciente</a></li>
				<li><a href="buscar_paciente.php?opcion=buscar"><span class="icon icon-profile"></span>Buscar paciente</a></li>
				<li><a href="buscar_paciente.php?opcion=baja"><span class="icon icon-profile"></span>Baja paciente</a></li>
				<li><a href="buscar_paciente.php?opcion=modificar"><span class="icon icon-profile"></span>Modificaci&oacute;n paciente</a></li>
				<li><a href="../index.php"><span class="icon icon-clock"></span>Cerrar Sesi&oacute;n</a></li>
			</ul>
		</nav>
		<hr>
		<section id="contenedor2">
			<?php 
				switch ($opcion) {
					case 'buscar':
						include_once("buscar.php");
					break;
				
					case 'baja':
						include_once("baja.php");
					break;

					case 'modificar':
						include_once("modificar.php");
					break;
				}
			?>
		</section>
	</section>
</body>
</html>