<?php
	require_once("../../sesion.php");
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
    $Nombre_paciente=$_GET['nombre_paciente'];
    $fecha_cita=$_GET['fecha_cita'];
	if(!isset($sistema)){
        require_once("../../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Citas</title>
	<link rel="stylesheet" href="../../css/estilo_calendario.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<header><h1><?php  echo $nombre_pasante; ?></h1></header>
		<h1>La cita del paciente: <?php echo $Nombre_paciente; ?> con fecha: <?php echo date('d-m-Y',strtotime($fecha_cita)); ?> </h1>
		<section id="formulario_paciente">
			<form method="post" action="../guardar_paciente.php" target="alta_cita">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
				<input type="hidden" name="nombre_pasante" id="nombre_pasante" value="<?php echo  $nombre_pasante; ?>">
				<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
				<input type="hidden" name="formulario" id="formulario" value="4">
				<input type="hidden" name="fecha_cita" id="fecha_cita" value="<?php echo $fecha_cita; ?>">
				<p>Anotaciones de la cita:</p>
        		<textarea rows="10" cols="50" id="texto_cita" name="texto_cita" ></textarea>
        		<br><br>
        		<input type="submit" value="Guardar Cita">
			</form>
			<iframe name="alta_cita" id="alta_cita" src="../../vacia.html" width="100%" height="80" frameborder="0"></iframe>	
		</section>
	</section>
</body>
</html>