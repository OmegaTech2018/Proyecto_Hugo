<header><h1><?php echo $nombre_pasante; ?><br><br>Datos del Paciente: <?php echo $nombre_paciente; ?></h1></header>
<?php
	//echo $paciente_id;
	/*QUERY CON LA QUE BUSCO AL PACIENTE EN LA BASE DE DATOS*/
   	$sql_busca_paciente=sprintf("SELECT nombre, apellido_paterno,apellido_materno,edad_paciente,embarazo,recien_nacido,domicilio,telefono FROM paciente WHERE paciente_id=$paciente_id AND paciente_activo=1;");
   	$Nombre=$sistema->getBD($sql_busca_paciente,"nombre");
   	$Ap_Paterno=$sistema->getBD($sql_busca_paciente,"apellido_paterno");
   	$Ap_Materno=$sistema->getBD($sql_busca_paciente,"apellido_materno");
   	$Edad_Paciente=$sistema->getBD($sql_busca_paciente,"edad_paciente");
   	$Domicilio=$sistema->getBD($sql_busca_paciente,"domicilio");
   	$Embarazo=$sistema->getBD($sql_busca_paciente,"embarazo");
   	$Recien_nacido=$sistema->getBD($sql_busca_paciente,"recien_nacido");
   	$Telefono=$sistema->getBD($sql_busca_paciente,"telefono");
?>

<form action="modificar_paciente.php" method="Post" target="modificar_paciente">
<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo $paciente_id; ?>">
    <p>
    	Nombre(s): <input type="text" id="nombre" name="nombre" value="<?php echo $Nombre; ?>" required="required">
    	Apellido Paterno: <input type="text" id="ap_paterno" name="ap_paterno" value="<?php echo $Ap_Paterno; ?>" required="required">
    	Apellido Materno: <input type="text" id="ap_materno" name="ap_materno" value="<?php echo $Ap_Materno; ?>" required="required">
    </p>
    <p>Edad: <input type="number" id="edad" name="edad" value="<?php echo $Edad_Paciente; ?>" required="required"></p>
    <p>Domicilio: <input type="text" id="domicilio" name="domicilio" value="<?php  echo $Domicilio; ?>" required="required"></p>
    <p>Embarazo: <?php echo $Embarazo; ?>
    	<div class="select">
            <select name="embarazo" id="embarazo" required="">
                <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
        </div>
    Recien nacido: <?php echo $Recien_nacido; ?>
    	<div class="select">
            <select name="recien_nacido" id="recien_nacido" required="">
                <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
        </div>
    </p>
    <p>Tel&eacute;fono: <input type="text" id="telefono" name="telefono" value="<?php echo $Telefono; ?>"></p>
    <br><br>
    <input type="submit" value="Modificar paciente">
</form>
<iframe name="modificar_paciente" id="modificar_paciente" src="vacia.html" width="100%" height="200" frameborder="0"></iframe>