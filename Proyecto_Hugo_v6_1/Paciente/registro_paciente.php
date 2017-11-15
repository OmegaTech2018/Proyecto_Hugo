<?php
	require_once("../sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if (!isset($sistema)) {
		require_once("../coneccion.php");
		$sistema=new sistema();
		$sistema->conectar();
	}
	$opcion_nota=$_GET["opcion_nota"];
	//echo $usuario." ".$nombre;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro Paciente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../demo-files/demo.css">
	<link rel="stylesheet" href="../css/estilo_registro_paciente.css" type="text/css">
	<script src="../js/div.js"></script>
    <script src="../js/funcion.js"></script><!--CONTIENE LA FUNCION PARA QUE LA PESTAÑA AL DARLE CLICK MUESTRE LO INDICADO-->
    <script src="../js/ocultar.js"></script><!--CONTIENE LA FUNCION PARA OCULTAR CAMPOS-->
</head>
<body>
<section id="contenedor">
	<header><h1><?php echo $nombre_pasante; ?><br></h1></header>
	<section id="formulario_paciente">	
		<form action="guardar_paciente.php" name="fcontacto" method="post">
			<input type="hidden" name="formulario" id="formulario" value="1">
			<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
			<input type="hidden" name="nombre_pasante" id="nombre_pasante" value="<?php echo  $nombre_pasante; ?>">
			<input type="hidden" name="opcion_nota" id="opcion_nota" value="<?php echo  $opcion_nota; ?>">
			
			<h1><strong>Formulario de Registro de Paciente</strong><br><br>Datos personales del paciente</h1>
			<?php 
				/*SE AGREGA UNA NUEVA NOTA DE UN PACIENTE NUEVO*/
				if ($opcion_nota==4) {
					require_once("Nota/nota_nueva_paciente_nuevo.html");
				}
				/*SE AGREGA UNA NUEVA NOTA DE UN PACIENTE YA EXISTENTE*/
				if ($opcion_nota==3) {
					require_once("Nota/nota_nueva_paciente_existente.php");
				}
			?>
			<input type="submit" value="Guardar Paciente">
		</form>
		<!--<iframe name="guarda_paciente" id="guarda_paciente" src="vacia.html" width="100%" height="60" frameborder="0"></iframe>-->	
</section>
</body>
</html>