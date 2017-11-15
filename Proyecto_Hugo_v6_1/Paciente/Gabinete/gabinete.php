<?php
	require_once("sesion.php");
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
    $Nombre_paciente=$_GET['nombre_paciente'];
    $opcion_nota=$_GET['opcion_nota'];
	if(!isset($sistema)){
        require_once("coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gabinetes</title>
</head>
<body>
	
</body>
</html>