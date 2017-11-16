<?php
	require_once("../sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
	$hc_id=$_GET['hc_id'];
	$fecha_hc=$_GET['fecha_hc'];
	$Nombre_paciente=$_GET['nombre_paciente'];
	if(!isset($sistema)){
        require_once("../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
    $sql_muestra_hc=sprintf("SELECT historia_clinica_id,paciente_id,fecha_historia_clinica,edad_historia_clinica_paciente,fecha_nacimiento,
    ocupacion,estado_civil,domicilio,escolaridad,religion,tipo_interrogatorio,nombre_responsable,parentesco,hora_historia_clinica,
    antecedentes_heredofamiliares,antecedentes_personales_no_patologicos,antecedentes_gineco_obstetricos,antecedentes_personales_patologicos,
    padecimiento_actual,sistema_cardiovascular,sistema_respiratorio,sistema_gastrointestinal,sistema_urinario,sistema_linfohematico,
    sistema_endocrino,sistema_nervioso,sistema_esqueletico,sistema_pma,frecuencia_cardiaca,frecuencia_respiratoria,presion_arterial,
    temperatura,peso,talla,exploracion_fisica,cabeza,cuello,torax,abdomen,genitales,extremidades,piel,resultados_laboratorio_gabinete,
    paquete_garantizado_acciones,diagnostico_texto,terapeutica_utilizada,pronostico,nombre_pasante 
    FROM historia_clinica_historico WHERE paciente_id=$paciente_id AND fecha_historia_clinica='$fecha_hc';");
    $fn=$sistema->getBD($sql_muestra_hc,"fecha_nacimiento");
    $fhc=$sistema->getBD($sql_muestra_hc,"fecha_historia_clinica");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Historial Historia Clínica</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
  <section id="contenedor">
    <h1><?php echo $nombre_pasante; ?></h1><br>
    <h2>Historia Clinica del paciente: <?php echo $Nombre_paciente; ?></h2><br><br>
    <?php
      echo "Número de expediente: ".$exp=$sistema->getBD($sql_muestra_hc,"historia_clinica_id")."<br>";
      echo "Fecha de la historia clinica: ".date('d-m-Y',strtotime($fhc))."<br>";
      echo "Edad: ".$ehcp=$sistema->getBD($sql_muestra_hc,"edad_historia_clinica_paciente")."<br>";
      echo "Fecha de nacimiento del paciente: ".date('d-m-Y',strtotime($fn))."<br>";
      echo "Ocupación: ".$oc=$sistema->getBD($sql_muestra_hc,"ocupacion")."<br>";
      echo "Estado civil: ".$edo_civil=$sistema->getBD($sql_muestra_hc,"estado_civil")."<br>";
      echo "Domicilio: ".$dom=$sistema->getBD($sql_muestra_hc,"domicilio")."<br>";
      echo "Escolaridad: ".$esc=$sistema->getBD($sql_muestra_hc,"escolaridad")."<br>";
      echo "Religion: ".$reg=$sistema->getBD($sql_muestra_hc,"religion")."<br>";
      echo "Tipo interrogatorio: ".$ti=$sistema->getBD($sql_muestra_hc,"tipo_interrogatorio")."<br>";
      echo "Nombre responsable: ".$nr=$sistema->getBD($sql_muestra_hc,"nombre_responsable")."<br>";
      echo "Parentesco: ".$p=$sistema->getBD($sql_muestra_hc,"parentesco")."<br>";
      echo "Hora: ".$hhc=$sistema->getBD($sql_muestra_hc,"hora_historia_clinica")."<br><br>";
      
      echo "<strong>ANTECEDENTES</strong><br><br>";
      echo "Antecedentes heredofamiliares: ".$ah=$sistema->getBD($sql_muestra_hc,"antecedentes_heredofamiliares")."<br>";
      echo "Antecedentes personales no patologicos: ".$apnp=$sistema->getBD($sql_muestra_hc,"antecedentes_personales_no_patologicos")."<br>";
      echo "Antecedentes gineco obstetricos: ".$ago=$sistema->getBD($sql_muestra_hc,"antecedentes_gineco_obstetricos")."<br>";
      echo "Antecedentes personales patologicos: ".$app=$sistema->getBD($sql_muestra_hc,"antecedentes_personales_patologicos")."<br>";
      echo "Padecimiento actual: ".$pa=$sistema->getBD($sql_muestra_hc,"padecimiento_actual")."<br><br>";

      echo "<strong>INTERROGATORIO POR APARATOS Y SISTEMAS</strong><br><br>";
      echo "Sistema cardiovascular: ".$sc=$sistema->getBD($sql_muestra_hc,"sistema_cardiovascular")."<br>";
      echo "Sistema respiratorio: ".$sr=$sistema->getBD($sql_muestra_hc,"sistema_respiratorio")."<br>";
      echo "Sistema gastrointestinal: ".$sg=$sistema->getBD($sql_muestra_hc,"sistema_gastrointestinal")."<br>";
      echo "Sistema urinario: ".$su=$sistema->getBD($sql_muestra_hc,"sistema_urinario")."<br>";
      echo "Sistema linfohematico: ".$sl=$sistema->getBD($sql_muestra_hc,"sistema_linfohematico")."<br>";
      echo "Sistema endocrino: ".$se=$sistema->getBD($sql_muestra_hc,"sistema_endocrino")."<br>";
      echo "Sistema nervioso: ".$sn=$sistema->getBD($sql_muestra_hc,"sistema_nervioso")."<br>";
      echo "Sistema esqueletico: ".$se=$sistema->getBD($sql_muestra_hc,"sistema_esqueletico")."<br>";
      echo "Piel, Mucosa y Anexos : ".$spma=$sistema->getBD($sql_muestra_hc,"sistema_pma")."<br><br>";
      
      echo "<strong>SIGNOS VIATLES</strong><br><br>";
      echo "Frecuencia cardiaca: ".$fc=$sistema->getBD($sql_muestra_hc,"frecuencia_cardiaca")."<br>";
      echo "Frecuencia respiratoria: ".$fr=$sistema->getBD($sql_muestra_hc,"frecuencia_respiratoria")."<br>";
      echo "Presion arterial: ".$pa=$sistema->getBD($sql_muestra_hc,"presion_arterial")."<br>";
      echo "Temperatura: ".$t=$sistema->getBD($sql_muestra_hc,"temperatura")."<br>";
      echo "Peso: ".$p=$sistema->getBD($sql_muestra_hc,"peso")."<br>";
      echo "Talla: ".$t=$sistema->getBD($sql_muestra_hc,"talla")."<br><br>";

      echo "<strong>EXPLORACIÓN FÍSICA</strong><br><br>";
      echo "Habitus Exterior: ".$ef=$sistema->getBD($sql_muestra_hc,"exploracion_fisica")."<br>";
      echo "Cabeza: ".$ca=$sistema->getBD($sql_muestra_hc,"cabeza")."<br>";
      echo "Cuello: ".$cu=$sistema->getBD($sql_muestra_hc,"cuello")."<br>";
      echo "Tórax: ".$to=$sistema->getBD($sql_muestra_hc,"torax")."<br>";
      echo "Abdomen: ".$ab=$sistema->getBD($sql_muestra_hc,"abdomen")."<br>";
      echo "Genitales: ".$ge=$sistema->getBD($sql_muestra_hc,"genitales")."<br>";
      echo "Extremidades: ".$ex=$sistema->getBD($sql_muestra_hc,"extremidades")."<br>";
      echo "Piel: ".$ef=$sistema->getBD($sql_muestra_hc,"piel")."<br><br>";

      echo "<strong>RESULTADOS PREVIOS Y ACTUALES DE LABORATORIO, GABINETE Y OTROS</strong><br><br>";
      echo "Resultados laboraotrio y gabinete : ".$rlg=$sistema->getBD($sql_muestra_hc,"resultados_laboratorio_gabinete")."<br>";
      echo "Paquete garantizado acciones que se realizan : ".$acc=$sistema->getBD($sql_muestra_hc,"paquete_garantizado_acciones")."<br>";
      echo "Diagnostico: ".$diagnostico_texto=$sistema->getBD($sql_muestra_hc,"diagnostico_texto")."<br>";
      echo "Terapeutica utilizada: ".$tu=$sistema->getBD($sql_muestra_hc,"terapeutica_utilizada")."<br>";
      echo "Pronostico: ".$pr=$sistema->getBD($sql_muestra_hc,"pronostico")."<br><br>";
      echo "M&eacute;dico Pasante del Servicio Social ".$nombre_pasante_hc=$sistema->getBD($sql_muestra_hc,"nombre_pasante")."<br>
                Nombre y firma del medico<br><br>";
    ?>
  </section>
</body>
</html>