<?php
	require_once("../sesion.php");
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
    $Nombre_paciente=$_GET['nombre_paciente'];
    if(!isset($sistema)){
        require_once("../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }

    $sql_muestra_hc=sprintf("SELECT  historia_clinica_id,paciente_id,fecha_historia_clinica,edad_historia_clinica_paciente,fecha_nacimiento,
    ocupacion,estado_civil,domicilio,escolaridad,religion,tipo_interrogatorio,nombre_responsable,parentesco,hora_historia_clinica,
    antecedentes_heredofamiliares,antecedentes_personales_no_patologicos,antecedentes_gineco_obstetricos,antecedentes_personales_patologicos,
    padecimiento_actual,sistema_cardiovascular,sistema_respiratorio,sistema_gastrointestinal,sistema_urinario,sistema_linfohematico,
    sistema_endocrino,sistema_nervioso,sistema_esqueletico,sistema_pma,frecuencia_cardiaca,frecuencia_respiratoria,presion_arterial,
    temperatura,peso,talla,exploracion_fisica,cabeza,cuello,torax,abdomen,genitales,extremidades,piel,resultados_laboratorio_gabinete,
    paquete_garantizado_acciones,diagnostico_texto,terapeutica_utilizada,pronostico 
    FROM historia_clinica WHERE paciente_id=$paciente_id;");

      $exp=$sistema->getBD($sql_muestra_hc,"historia_clinica_id");
      $fhc=$sistema->getBD($sql_muestra_hc,"fecha_historia_clinica");
      $ehcp=$sistema->getBD($sql_muestra_hc,"edad_historia_clinica_paciente");
      $fn=$sistema->getBD($sql_muestra_hc,"fecha_nacimiento");
      $oc=$sistema->getBD($sql_muestra_hc,"ocupacion");
      $edo_civil=$sistema->getBD($sql_muestra_hc,"estado_civil");
      $dom=$sistema->getBD($sql_muestra_hc,"domicilio");
      $esc=$sistema->getBD($sql_muestra_hc,"escolaridad");
      $reg=$sistema->getBD($sql_muestra_hc,"religion");
      $ti=$sistema->getBD($sql_muestra_hc,"tipo_interrogatorio");
      $nr=$sistema->getBD($sql_muestra_hc,"nombre_responsable");
      $p=$sistema->getBD($sql_muestra_hc,"parentesco");
      $hhc=$sistema->getBD($sql_muestra_hc,"hora_historia_clinica");
      
      $ah=$sistema->getBD($sql_muestra_hc,"antecedentes_heredofamiliares");
      $apnp=$sistema->getBD($sql_muestra_hc,"antecedentes_personales_no_patologicos");
      $ago=$sistema->getBD($sql_muestra_hc,"antecedentes_gineco_obstetricos");
      $app=$sistema->getBD($sql_muestra_hc,"antecedentes_personales_patologicos");
      $pa=$sistema->getBD($sql_muestra_hc,"padecimiento_actual");

      $sc=$sistema->getBD($sql_muestra_hc,"sistema_cardiovascular");
      $sr=$sistema->getBD($sql_muestra_hc,"sistema_respiratorio");
      $sg=$sistema->getBD($sql_muestra_hc,"sistema_gastrointestinal");
      $su=$sistema->getBD($sql_muestra_hc,"sistema_urinario");
      $sl=$sistema->getBD($sql_muestra_hc,"sistema_linfohematico");
      $se=$sistema->getBD($sql_muestra_hc,"sistema_endocrino");
      $sn=$sistema->getBD($sql_muestra_hc,"sistema_nervioso");
      $se=$sistema->getBD($sql_muestra_hc,"sistema_esqueletico");
      $spma=$sistema->getBD($sql_muestra_hc,"sistema_pma");
      
      $fc=$sistema->getBD($sql_muestra_hc,"frecuencia_cardiaca");
      $fr=$sistema->getBD($sql_muestra_hc,"frecuencia_respiratoria");
      $pa=$sistema->getBD($sql_muestra_hc,"presion_arterial");
      $t=$sistema->getBD($sql_muestra_hc,"temperatura");
      $p=$sistema->getBD($sql_muestra_hc,"peso");
      $t=$sistema->getBD($sql_muestra_hc,"talla");

      $ef=$sistema->getBD($sql_muestra_hc,"exploracion_fisica");
      $ca=$sistema->getBD($sql_muestra_hc,"cabeza");
      $cu=$sistema->getBD($sql_muestra_hc,"cuello");
      $to=$sistema->getBD($sql_muestra_hc,"torax");
      $ab=$sistema->getBD($sql_muestra_hc,"abdomen");
      $ge=$sistema->getBD($sql_muestra_hc,"genitales");
      $ex=$sistema->getBD($sql_muestra_hc,"extremidades");
      $ef=$sistema->getBD($sql_muestra_hc,"piel");

      $rlg=$sistema->getBD($sql_muestra_hc,"resultados_laboratorio_gabinete");
      $acc=$sistema->getBD($sql_muestra_hc,"paquete_garantizado_acciones");
      //$diagnostico_desc.$diagnostico_texto;
      $tu=$sistema->getBD($sql_muestra_hc,"terapeutica_utilizada");
      $pr=$sistema->getBD($sql_muestra_hc,"pronostico");    	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Historia Clinica</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<header><h1><?php echo $nombre_pasante; ?></h1></header>
		<h2>Historia Clinica del paciente: <?php echo $Nombre_paciente; ?></h2>
		<h2>Fecha de nacimiento: <?php echo date('d-m-Y',strtotime($fn)); ?></h2><br>
		<form action="guardar_historia_clinica.php" method="post" target="guarda_historia_clinica">
			<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
			<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
      <input type="hidden" name="nombre_pasante" id="nombre_pasante" value="<?php echo  $nombre_pasante; ?>">
      <input type="hidden" name="opcion" id="opcion" value="2">
      	N&uacute;mero de Expediente: 
        <input type="text" id="num_exp" name="num_exp" maxlength="5" value="<?php  echo $exp; ?>" readonly="readonly" ><br><br>
        Fecha de la historia clinica: 
        <input type="date" id="fecha_hc" name="fecha_hc" step="1" requiered="required"><br><br>
        Edad del paciente: 
        <input type="number" id="edad" name="edad" required="required"><br><br>
        Ocupación: 
        <input type="text" id="ocupacion" name="ocupacion" value="<?php  echo $oc; ?>" required="required"><br><br>
        Estado Civil: 
        <input type="text" id="estado_civil" name="estado_civil" value="<?php  echo $edo_civil; ?>" required="required"><br><br>
        Domicilio: 
        <input type="text" id="domicilio" name="domicilio" value="<?php  echo $dom; ?>" size="100" required="requiered"><br><br>
        Escolaridad: 
        <input type="text" id="escolaridad" name="escolaridad" value="<?php  echo $esc ;?>" required="required"><br><br>
        Religion: <select id="religion" name="religion" required="required"> 
                  <option></option><option value="católica">Católica</option><option value="cristiano">Cristiano</option>
                  <option value="Testigos de Jehová">Testigos de Jehová</option><option value="Otro">Otro</option>
                  </select>
        <br><br>
        Tipo interrogatorio: 
        <input type="text" id="interrogatorio" name="interrogatorio" value="<?php  echo $ti; ?>" required="requiered"><br><br>
        NOMBRE DEL PADRE O TUTOR (EN CASO DE SER MENOR DE EDAD O CON DISCAPACIDAD)<br><br>
        Nombre responsable: <input type="text" id="responsable" name="responsable" size="60" ><br><br>  
        Parentesco: <input type="text" id="parentesco" name="parentesco"><br><br>

        <hr size="2px" color="black"><br>

        <strong>ANTECEDENTES</strong><br><br>
        Antecedentes heredofamiliares: <br>
        <textarea rows="10" cols="80" id="a_heredofamiliares" name="a_heredofamiliares" required="requiered"></textarea><br><br>
        Antecedentes personales no patologicos: <br>
        <textarea rows="10" cols="80" id="a_no_patologicos" name="a_no_patologicos" required="requiered"></textarea><br><br> 
        Antecedentes ginecologicos: <br>
        <textarea rows="10" cols="80" id="a_gineco" name="a_gineco" required="requiered"></textarea><br><br>
        Antecedentes personales patologicos: <br>
        <textarea rows="10" cols="80" id="a_patologicos" name="a_patologicos" required="requiered"></textarea><br><br>
        Padecimiento actual: <br>
        <textarea rows="10" cols="80" id="padecimiento_actual" name="padecimiento_actual" required="requiered"></textarea><br><br>

        <hr size="2px" color="black"><br>        

        <strong>INTERROGATORIO POR APARATOS Y SISTEMAS</strong><br><br>
        Cardiovascular: <br> 
        <textarea rows="5" cols="100" id="s_cardiovascular" name="s_cardiovascular" required="requiered"></textarea><br><br>
        Respiratorio: <br>
        <textarea rows="5" cols="100" id="s_respiratorio" name="s_respiratorio" required="requiered"></textarea><br><br>
        Gastrointestinal: <br>
        <textarea rows="5" cols="100" id="s_gastro" name="s_gastro" required="requiered"></textarea><br><br>
        Genitourinario: <br>
        <textarea rows="5" cols="100" id="s_urinario" name="s_urinario" required="requiered"></textarea><br><br>
        Hematico y Linfatico: <br>
        <textarea rows="5" cols="100" id="s_linfohematico" name="s_linfohematico" required="requiered"></textarea><br><br>
        Endocrino: <br>
        <textarea rows="5" cols="100" id="s_endocrino" name="s_endocrino" required="requiered"></textarea><br><br>
        Nervioso: <br>
        <textarea rows="5" cols="100" id="s_nervioso" name="s_nervioso" required="requiered"></textarea><br><br>
        Esqueletico: <br>
        <textarea rows="5" cols="100" id="s_esqueletico" name="s_esqueletico" required="requiered"></textarea><br><br>
        Piel, Mucosa y Anexos: <br>
        <textarea rows="5" cols="100" id="s_pma" name="s_pma" required="requiered"></textarea><br><br>
        
        <hr size="2px" color="black"><br>

        <strong>SIGNOS VIATLES</strong><br><br>
        Frecuencia Cardiaca: <input type="text" id="fc" name="fc" required="required"><br><br>  
        Frecuencia Respiratoria: <input type="text" id="fr" name="fr" required="required"><br><br> 
        Presi&oacute;n Arterial: <input type="text" id="pa" name="pa" required="required"><br><br>
        Temperatura: <input type="text" id="temp" name="temp" required="required"><br><br>
        Peso: <input type="text" id="pe" name="pe" required="required"><br><br>
        Talla: <input type="text" id="talla" name="talla" required="required"><br><br> 

        <hr size="2px" color="black"><br>

        <strong>EXPLORACI&Oacute;N F&Iacute;SICA</strong><br><br>
        Habitus Exterior: <br>
        <textarea rows="4" cols="100" id="exp_fisica" name="exp_fisica" required="requiered"></textarea><br><br>
        Cabeza: <br>
        <textarea rows="4" cols="100" id="cabeza" name="cabeza" required="requiered"></textarea><br><br>
        Cuello: <br>
        <textarea rows="4" cols="100" id="cuello" name="cuello" required="requiered"></textarea><br><br>
        T&oacute;rax: <br>
        <textarea rows="4" cols="100" id="torax" name="torax" required="requiered"></textarea><br><br>
        Abdomen: <br>
        <textarea rows="4" cols="100" id="abdomen" name="abdomen" required="requiered"></textarea><br><br>
        Genitales: <br>
        <textarea rows="4" cols="100" id="genitales" name="genitales" required="requiered"></textarea><br><br>
        Extremidades: <br>
        <textarea rows="4" cols="100" id="extremidades" name="extremidades" required="requiered"></textarea><br><br>
        Piel: <br>
        <textarea rows="4" cols="100" id="piel" name="piel" required="requiered"></textarea><br><br>

        <hr size="2px" color="black"><br>

        <strong>RESULTADOS PREVIOS Y ACTUALES DE LABORATORIO, GABINETE Y OTROS</strong><br><br>
        <textarea rows="5" cols="80" id="r_lab_gab" name="r_lab_gab" required="requiered"></textarea><br><br>
        Paquete garantizado acciones que se realizan: <br>
        <textarea rows="5" cols="80" id="acciones" name="acciones" required="requiered"></textarea><br><br>
        Diagnostico: <br>
        <textarea rows="3" cols="80" id="text_diagnostico" name="text_diagnostico" required="requiered"></textarea><br><br>

        Terapeutica se da hoja de referencia a Hospital de Valle para valoraci&oacute;n obstetrica: <br>
        <textarea rows="10" cols="80" id="t_utilizada" name="t_utilizada" required="requiered"></textarea><br><br>
        Pronostico: <br>
        <textarea rows="3" cols="80" id="pronostico" name="pronostico" required="requiered"></textarea><br><br>

        <center>
          M&eacute;dico Pasante del Servicio Social <?php echo $nombre_pasante; ?><br>
          Nombre y firma del medico
        </center>
      		<br><br>
  			<input type="submit" value="Actualizar Historia Clinica">
      	</form>
      	<iframe name="guarda_historia_clinica" id="guarda_historia_clinica" src="../vacia.html" width="100%" height="100" frameborder="0"></iframe>
	</section>
</body>
</html>