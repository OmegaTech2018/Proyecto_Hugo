<?php
	require_once("../../sesion.php");
	$paciente_id=$_POST['paciente_id'];
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if(!isset($sistema)){
        require_once("../../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
    $sql_paciente_id=sprintf("SELECT CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) AS nombre_paciente FROM paciente 
    						  WHERE paciente_id='$paciente_id' AND paciente_activo=1;");
    $nombre=$sistema->getBD($sql_paciente_id,"nombre_paciente");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cita</title>
	<link rel="stylesheet" href="../css/estilo_registro_paciente.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<header><h1><?php  echo $nombre_pasante; ?><br><br>Agendar Cita</h1></header>
		<h1>Próxima cita del paciente: <?php echo $nombre; ?></h1>
		<section id="formulario_paciente">
			<form method="post" action="../guardar_paciente.php" target="alta_cita">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
				<input type="hidden" name="nombre_pasante" id="nombre_pasante" value="<?php echo  $nombre_pasante; ?>">
				<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
				<input type="hidden" name="formulario" id="formulario" value="3">
				Ingrese la fecha de la pr&oacute;xima cita:
        		<input type="date" id="fecha_cita" name="fecha_cita" step="1" requiered="required">
     			<br><br>
     			<input type="submit" value="Guardar Cita">
			</form>
			<iframe name="alta_cita" id="alta_cita" src="../../vacia.html" width="100%" height="80" frameborder="0"></iframe>	
		</section>
	</section>
</body>
</html>