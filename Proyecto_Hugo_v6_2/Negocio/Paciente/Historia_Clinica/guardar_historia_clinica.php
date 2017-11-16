<?php

	require_once("../../coneccion.php");
	  $sistema = new sistema();
    $sistema->conectar();
    $opcion=$_POST["opcion"];
    $usuario=$sistema->recuperaPOST("usuario","Por favor inice sesión");
    $nombre_pasante=$sistema->recuperaPOST("nombre_pasante","Por favor inice sesión");
    $paciente_id=$sistema->recuperaPOST("paciente_id","El ID del paciente es necesario");
    $num_exp=$sistema->recuperaPOST("num_exp","Número de expediente es necesario");
    $fecha_hc=$sistema->recuperaPOST("fecha_hc","Fecha de la historia clinica es necesaria");
    $edad=$sistema->recuperaPOST("edad","Edad es necesaria");
    $ocupacion=$sistema->recuperaPOST("ocupacion","Ocupacion del paciente es necesaria");
    $estado_civil=$sistema->recuperaPOST("estado_civil","Estado civil del paciente es necesario");
    $domicilio=$sistema->recuperaPOST("domicilio","Domicilio del paciente es necesario");
    $escolaridad=$sistema->recuperaPOST("escolaridad","Escolaridad del paciente es necesaria");
    $religion=$sistema->recuperaPOST("religion","Religion del paciente es necesaria");
  	$interrogatorio=$sistema->recuperaPOST("interrogatorio","El tipo de interrogatorio es necesario");
    $responsable=$_POST["responsable"];
  	$parentesco=$_POST["parentesco"];
  	
    $a_heredofamiliares=$sistema->recuperaPOST("a_heredofamiliares","Los antecedentes heredofamiliares son necesarios");
  	$a_no_patologicos=$sistema->recuperaPOST("a_no_patologicos","Los antecedentes no patologios son necesarios");
  	$a_gineco=$sistema->recuperaPOST("a_gineco","Los antecedentes gineco obstetricos son necesarios");
    $a_patologicos=$sistema->recuperaPOST("a_patologicos","Los antecedentes patologios son necesario");
  	$padecimiento_actual=$sistema->recuperaPOST("padecimiento_actual","El padecimiento actual es necesario");

  	$s_cardiovascular=$sistema->recuperaPOST("s_cardiovascular","El sistema cardiovascular es necesario");
  	$s_respiratorio=$sistema->recuperaPOST("s_respiratorio","El sistema respiratorio es necesario");
  	$s_gastro=$sistema->recuperaPOST("s_gastro","El sistema gastrointestinal es necesario");
    $s_urinario=$sistema->recuperaPOST("s_urinario","El sistema genitourinario es necesario");
    $s_linfohematico=$sistema->recuperaPOST("s_linfohematico","El sistema hematico y linfatico es necesario");
    $s_endocrino=$sistema->recuperaPOST("s_endocrino","El sistema endocrino es necesario");
  	$s_nervioso=$sistema->recuperaPOST("s_nervioso","El sistema nervioso es necesario");
  	$s_esqueletico=$sistema->recuperaPOST("s_esqueletico","El sistema esqueletico es necesario");
  	$s_pma=$sistema->recuperaPOST("s_pma","Piel, Mucosa y Anexos son necesarios");
  	
  	$fc=$sistema->recuperaPOST("fc","La frecuencia cardiaca es necesaria");
  	$fr=$sistema->recuperaPOST("fr","La frecuencia respiratoria es necesaria");
  	$pa=$sistema->recuperaPOST("pa","La presion arterial es necesaria");
  	$temp=$sistema->recuperaPOST("temp","La temperatura es necesario");
  	$pe=$sistema->recuperaPOST("pe","El peso es necesario");
  	$talla=$sistema->recuperaPOST("talla","La tallla es necesaria");
  	
    $exp_fisica=$sistema->recuperaPOST("exp_fisica","Habitus exterior es necesario");
  	$cabeza=$sistema->recuperaPOST("cabeza","Cabeza es necesaria");
    $cuello=$sistema->recuperaPOST("cuello","Cuello es necesario");
    $torax=$sistema->recuperaPOST("torax","Torax es necesario");
    $abdomen=$sistema->recuperaPOST("abdomen","Abdomen es necesario");
    $genitales=$sistema->recuperaPOST("genitales","Genitales son necesarios");
    $extremidades=$sistema->recuperaPOST("extremidades","Extremidades son necesarias");
    $piel=$sistema->recuperaPOST("piel","Piel es necesaria");


    $r_lab_gab=$sistema->recuperaPOST("r_lab_gab","Los resultados de laboratorio y gabinetes son necesarios");
    $acciones=$sistema->recuperaPOST("acciones","Paquete garantizado acciones es necesario");
    $text_diagnostico=$sistema->recuperaPOST("text_diagnostico","El diagnostico es necesario");
  	$t_utilizada=$sistema->recuperaPOST("t_utilizada","La terapeutica utilizada es necesario");
  	$pronostico=$sistema->recuperaPOST("pronostico","El pronostico es necesario");

    switch ($opcion) {
      case 1:
        $fecha_nacimiento=$sistema->recuperaPOST("fecha_nacimiento","Fecha nacimiento es necesaria");
        $sql_guarda_historia_clinica=sprintf("INSERT INTO historia_clinica (historia_clinica_id,paciente_id,fecha_historia_clinica,
        edad_historia_clinica_paciente, fecha_nacimiento,ocupacion,estado_civil,domicilio,escolaridad,religion,tipo_interrogatorio,
        nombre_responsable,parentesco,hora_historia_clinica,
        antecedentes_heredofamiliares,antecedentes_personales_no_patologicos,antecedentes_gineco_obstetricos,
        antecedentes_personales_patologicos,padecimiento_actual,
        sistema_cardiovascular,sistema_respiratorio,sistema_gastrointestinal,sistema_urinario,sistema_linfohematico,sistema_endocrino,
        sistema_nervioso,sistema_esqueletico,sistema_pma,
        frecuencia_cardiaca,frecuencia_respiratoria,presion_arterial,temperatura,peso,talla,
        exploracion_fisica,cabeza,cuello,torax,abdomen,genitales,extremidades,piel,
        resultados_laboratorio_gabinete,paquete_garantizado_acciones,diagnostico_texto,terapeutica_utilizada,pronostico,nombre_pasante) 
        VALUES ('$num_exp',$paciente_id,'$fecha_hc',$edad,'$fecha_nacimiento','$ocupacion','$estado_civil','$domicilio','$escolaridad',
        '$religion','$interrogatorio','$responsable','$parentesco',CURTIME(),
        '$a_heredofamiliares','$a_no_patologicos','$a_gineco','$a_patologicos','$padecimiento_actual',
        '$s_cardiovascular','$s_respiratorio','$s_gastro','$s_urinario','$s_linfohematico','$s_endocrino','$s_nervioso','$s_esqueletico',
        '$s_pma',
        '$fc','$fr','$pa',$temp,$pe,$talla,
        '$exp_fisica','$cabeza','$cuello','$torax','$abdomen','$genitales','$extremidades','$piel',
        '$r_lab_gab','$acciones','$text_diagnostico','$t_utilizada','$pronostico','$nombre_pasante');");
        if ($sistema->enlaceBD->query($sql_guarda_historia_clinica)) {
          echo "<center><strong>Los datos de la historia clinica se han guardado con éxito.</strong>
                <form action=\"../guardar_paciente.php\" method=\"post\">
                    <input type=\"hidden\" name=\"usuario\" id=\"usuario\" value=".$usuario.">
                    <input type=\"hidden\" name=\"nombre_pasante\" id=\"nombre_pasante\" value=".$nombre_pasante.">
                    <input type=\"hidden\" name=\"paciente_id\" id=\"paciente_id\" value=".$paciente_id.">
                    <input type=\"hidden\" name=\"formulario\" id=\"formulario\" value=\"2\">
                    <br><br>
                    <input type=\"submit\" value=\"Salir\">
                  </form>
          </center>";
        }else{
          echo "<center><strong>Error al guardar la nota<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
        }$sistema->desconectar();  
      break;
      case 2:
        $sql_historial_hc=sprintf("INSERT INTO historia_clinica_historico (historia_clinica_id,paciente_id,fecha_historia_clinica,
        edad_historia_clinica_paciente, fecha_nacimiento,ocupacion,estado_civil,domicilio,escolaridad,religion,tipo_interrogatorio,
        nombre_responsable,parentesco,hora_historia_clinica,
        antecedentes_heredofamiliares,antecedentes_personales_no_patologicos,antecedentes_gineco_obstetricos,
        antecedentes_personales_patologicos,padecimiento_actual,
        sistema_cardiovascular,sistema_respiratorio,sistema_gastrointestinal,sistema_urinario,sistema_linfohematico,sistema_endocrino,
        sistema_nervioso,sistema_esqueletico,sistema_pma,
        frecuencia_cardiaca,frecuencia_respiratoria,presion_arterial,temperatura,peso,talla,
        exploracion_fisica,cabeza,cuello,torax,abdomen,genitales,extremidades,piel,
        resultados_laboratorio_gabinete,paquete_garantizado_acciones,diagnostico_texto,terapeutica_utilizada,pronostico,nombre_pasante)
        SELECT  historia_clinica_id,paciente_id,fecha_historia_clinica,edad_historia_clinica_paciente,fecha_nacimiento,
        ocupacion,estado_civil,domicilio,escolaridad,religion,tipo_interrogatorio,nombre_responsable,parentesco,hora_historia_clinica,
        antecedentes_heredofamiliares,antecedentes_personales_no_patologicos,antecedentes_gineco_obstetricos,antecedentes_personales_patologicos,
        padecimiento_actual,sistema_cardiovascular,sistema_respiratorio,sistema_gastrointestinal,sistema_urinario,sistema_linfohematico,
        sistema_endocrino,sistema_nervioso,sistema_esqueletico,sistema_pma,frecuencia_cardiaca,frecuencia_respiratoria,presion_arterial,
        temperatura,peso,talla,exploracion_fisica,cabeza,cuello,torax,abdomen,genitales,extremidades,piel,resultados_laboratorio_gabinete,
        paquete_garantizado_acciones,diagnostico_texto,terapeutica_utilizada,pronostico,nombre_pasante 
        FROM historia_clinica WHERE paciente_id=$paciente_id;");
        if ($sistema->enlaceBD->query($sql_historial_hc)) {
          $sql_actualiza_historia_clinica=sprintf("UPDATE  historia_clinica SET historia_clinica_id='$num_exp',
          paciente_id=$paciente_id,fecha_historia_clinica='$fecha_hc',
          edad_historia_clinica_paciente=$edad,
          ocupacion='$ocupacion',estado_civil='$estado_civil',domicilio='$domicilio',
          escolaridad='$escolaridad',religion='$religion',tipo_interrogatorio='$interrogatorio',
          nombre_responsable='$responsable',parentesco='$parentesco',hora_historia_clinica=CURTIME(),
          antecedentes_heredofamiliares='$a_heredofamiliares',antecedentes_personales_no_patologicos='$a_no_patologicos',
          antecedentes_gineco_obstetricos='$a_gineco',antecedentes_personales_patologicos='$a_patologicos',
          padecimiento_actual='$padecimiento_actual',
          sistema_cardiovascular='$s_cardiovascular',sistema_respiratorio='$s_respiratorio',
          sistema_gastrointestinal='$s_gastro',sistema_urinario='$s_urinario',
          sistema_linfohematico='$s_linfohematico',sistema_endocrino='$s_endocrino',
          sistema_nervioso='$s_nervioso',sistema_esqueletico='$s_esqueletico',sistema_pma='$s_pma',
          frecuencia_cardiaca='$fc',frecuencia_respiratoria='$fr',presion_arterial='$pa',
          temperatura=$temp,peso=$pe,talla=$talla,
          exploracion_fisica='$exp_fisica',cabeza='$cabeza',cuello='$cuello',
          torax='$torax',abdomen='$abdomen',genitales='$genitales',extremidades='$extremidades',piel='$piel',
          resultados_laboratorio_gabinete='$r_lab_gab',paquete_garantizado_acciones='$acciones',
          diagnostico_texto='$text_diagnostico',
          terapeutica_utilizada='$t_utilizada',pronostico='$pronostico',nombre_pasante='$nombre_pasante'
          WHERE paciente_id=$paciente_id;");
          if ($sistema->enlaceBD->query($sql_actualiza_historia_clinica)) {
            echo "<center><strong>Se ha actualizado la historia clinica con éxito.</strong>
                    <form action=\"../guardar_paciente.php\" method=\"post\">
                    <input type=\"hidden\" name=\"usuario\" id=\"usuario\" value=".$usuario.">
                    <input type=\"hidden\" name=\"nombre_pasante\" id=\"nombre_pasante\" value=".$nombre_pasante.">
                    <input type=\"hidden\" name=\"paciente_id\" id=\"paciente_id\" value=".$paciente_id.">
                    <input type=\"hidden\" name=\"formulario\" id=\"formulario\" value=\"2\">
                    <br><br>
                    <input type=\"submit\" value=\"Salir\">
                  </form>
                </center>";
          }else{
            echo "<center><strong>Error al actualizar la historia clinica<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
          }/*TERMINA EL IF QUE ACTUALIZA LA HISTORIA CLINICA DEL PACIENTE*/
        }else{
          echo "<center><strong>A ocurrido un error.<br>Verifique la fecha de la historia clínica.</strong></center>";
        }/*TERMINA IF QUE GUARDA EL HISTORIAL DE LAS HISTORIAS CLINICAS*/
        $sistema->desconectar();
      break;
    }
?>