<?php
    $paciente_id=$_GET['paciente_id'];
    $sql_busca_paciente=sprintf("SELECT CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) AS nombre_paciente,
    apellido_paterno,apellido_materno,nombre,telefono,sexo,edad_paciente FROM paciente WHERE paciente_id=$paciente_id;");
    $Nombre_paciente=$sistema->getBD($sql_busca_paciente,"nombre_paciente");
    $apellido_paterno=$sistema->getBD($sql_busca_paciente,"apellido_paterno");
    $apellido_materno=$sistema->getBD($sql_busca_paciente,"apellido_materno");
    $nombre=$sistema->getBD($sql_busca_paciente,"nombre");
    $Telefono=$sistema->getBD($sql_busca_paciente,"telefono");
    $Sexo=$sistema->getBD($sql_busca_paciente,"sexo");
    $Edad_paciente=$sistema->getBD($sql_busca_paciente,"edad_paciente");
?>
<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
<input type="hidden" name="telefono" id="telefono" value="<?php echo  $Telefono; ?>">
<input type="hidden" name="nombre_paciente" id="nombre_paciente" value="<?php echo  $Nombre_paciente; ?>">
<input type="hidden" name="ap_paterno" id="ap_paterno" value="<?php echo  $apellido_paterno; ?>">
<input type="hidden" name="ap_materno" id="ap_materno" value="<?php echo  $apellido_materno; ?>">
<input type="hidden" name="nombre" id="nombre" value="<?php echo  $nombre; ?>">
<p>
	Nombre: <?php echo $Nombre_paciente; ?>
</p>
<p>Edad: <input type="number" id="edad" name="edad" value="<?php echo $Edad_paciente; ?>" required="required"></p>
<?php
    if ($Sexo=="F") {
?>
        <input type="hidden" name="sexo" id="sexo" value="<?php echo $Sexo; ?>">
        <p>Embarazo:
            <div class="select">
                <select name="embarazo" id="embarazo" required="required">
                    <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
        Primera cita del embarazo:
            <div class="select">
                <select name="cita_embarazo" id="cita_embarazo" >
                    <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
</p>
<?php
    }else{
?>
<input type="hidden" name="embarazo" id="embarazo" value="No">
<input type="hidden" name="cita_embarazo" id="cita_embarazo" value="No">
<input type="hidden" name="sexo" id="sexo" value="M">
<p>Tel&eacute;fono: <input type="text" id="telefono" name="telefono" value="<?php echo $Telefono; ?>"></p>
<?php } ?>