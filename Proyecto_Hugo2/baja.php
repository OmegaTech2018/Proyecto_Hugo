<header><h1><?php echo $nombre_pasante; ?><br><br>Baja del Paciente: <?php echo $nombre_paciente; ?><br></h1>
Estos son los datos del paciente<br>
</header>
<form action="baja_paciente.php" method="Post" target="baja_paciente">
<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo $paciente_id; ?>">
	<?php
		//echo $paciente_id;
		/*QUERY CON LA QUE BUSCO AL PACIENTE EN LA BASE DE DATOS*/
    	$sql_busca_paciente=sprintf("SELECT nombre, apellido_paterno,apellido_materno,edad_paciente,domicilio,telefono FROM paciente WHERE paciente_id=$paciente_id;");
    	echo "Paciente id: ".$paciente_id."<br>";
    	echo "Nombre: ".$Nombre=$sistema->getBD($sql_busca_paciente,"nombre")."<br>";
    	echo "Apellido Paterno: ".$Ap_Paterno=$sistema->getBD($sql_busca_paciente,"apellido_paterno")."<br>";
    	echo "Apellido Materno: ".$Ap_Materno=$sistema->getBD($sql_busca_paciente,"apellido_materno")."<br>";
    	echo "Edad: ".$Edad_Paciente=$sistema->getBD($sql_busca_paciente,"edad_paciente")."<br>";
    	echo "Domicilio: ".$Domicilio=$sistema->getBD($sql_busca_paciente,"domicilio")."<br>";
    	echo "Telefono: ".$Telefono=$sistema->getBD($sql_busca_paciente,"telefono");
	?>
	<br><br>
	<input type="submit" value="Baja paciente">
</form>
<iframe name="baja_paciente" id="baja_paciente" src="vacia.html" width="100%" height="200" frameborder="0"></iframe>