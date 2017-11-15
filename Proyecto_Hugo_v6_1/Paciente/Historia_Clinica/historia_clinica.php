<?php
	require_once("../../sesion.php");
	$paciente_id=$_GET["paciente_id"];
	//$nombre_paciente=$_GET["nombre_paciente"];
	//$sexo=$_GET["sexo"];
	//$telefono=$_GET["telefono"];
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if(!isset($sistema)){
        require_once("../../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
    $sql_datos_paciente=sprintf("SELECT CONCAT(apellido_paterno,' ' ,apellido_materno,' ',nombre) AS nombre_paciente,edad_paciente,sexo 
                                 FROM paciente WHERE paciente_id=$paciente_id;");
    $nombre_paciente=$sistema->getBD($sql_datos_paciente,"nombre_paciente");
    $edad_paciente=$sistema->getBD($sql_datos_paciente,"edad_paciente");
    $sexo=$sistema->getBD($sql_datos_paciente,"sexo");

    $sql_diagnostico=sprintf("SELECT diagnostico_id,descripcion_diagnostico FROM diagnostico;");
    $resultado_diagnostico=$sistema->enlaceBD->query($sql_diagnostico);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Historia Clinica</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../demo-files/demo.css">
	<link rel="stylesheet" href="../../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<header><h1><?php echo $nombre_pasante; ?></h1></header>
		<strong>Historia Clinica General</strong><br>
		
    <hr size="2px" color="black">

		<form action="guardar_historia_clinica.php" method="post" target="guarda_historia_clinica">
			<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
			<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
      <input type="hidden" name="nombre_pasante" id="nombre_pasante" value="<?php echo  $nombre_pasante; ?>">
      <input type="hidden" name="opcion" id="opcion" value="1">
        <br><strong>FICHA DE IDENTIFICACI&Oacute;N</strong><br><br>
        Nombre del paciente: <strong><?php echo $nombre_paciente; ?></strong><br><br>
        N&uacute;mero de Expediente: <input type="text" id="num_exp" name="num_exp" maxlength="5" required="required"><br><br>
        Fecha de la historia clinica: <input type="date" id="fecha_hc" name="fecha_hc" step="1" requiered="required"><br><br>
			  Edad del paciente: <input type="number" id="edad" name="edad" value="<?php echo $edad_paciente; ?>" required="required"><br><br>
  			Fecha nacimiento: <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" step="1" requiered="required"><br><br>
  			Sexo: <?php if ($sexo=="M") {echo "Masculino";} else{ echo "Femenino";} ?><br><br>
        Ocupación: <input type="text" id="ocupacion" name="ocupacion" required="required"><br><br>
        Estado Civil: <input type="text" id="estado_civil" name="estado_civil" required="required"><br><br>
        Domicilio: <input type="text" id="domicilio" name="domicilio" size="100" required="requiered"><br><br>
        Escolaridad: <input type="text" id="escolaridad" name="escolaridad" required="required"><br><br>
        Religion: <select id="religion" name="religion" required="required"> 
                  <option></option><option value="católica">Católica</option><option value="cristiano">Cristiano</option>
                  <option value="Testigos de Jehová">Testigos de Jehová</option><option value="Otro">Otro</option>
                  </select>
        <br><br>
        Tipo interrogatorio: <input type="text" id="interrogatorio" name="interrogatorio" required="requiered"><br><br>
        NOMBRE DEL PADRE O TUTOR (EN CASO DE SER MENOR DE EDAD O CON DISCAPACIDAD)<br><br>
  			Nombre responsable: <input type="text" id="responsable" name="responsable" size="60"><br><br>  
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
  			<input type="submit" value="Guardar Historia Clinica">
		</form>
		<iframe name="guarda_historia_clinica" id="guarda_historia_clinica" src="../../vacia.html" width="100%" height="100" frameborder="0"></iframe>		
	</section>
</body>
</html>