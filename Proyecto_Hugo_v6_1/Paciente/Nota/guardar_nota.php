<?php
	require_once("../../coneccion.php");
	$sistema = new sistema();
    $sistema->conectar();
    $usuario=$sistema->recuperaPOST("usuario","Por favor inice sesión");
    $paciente_id=$sistema->recuperaPOST("paciente_id","El ID del paciente es necesario");
    $fecha=date("Y-m-d");
	$fc=$sistema->recuperaPOST("fc","La frecuecnia cardiaca es requerida");
    $fr=$sistema->recuperaPOST("fr","La frecuencia respiratoria es requerida");
    $pa=$sistema->recuperaPOST("pa","La presión arterial es requerida");
    $temp=$sistema->recuperaPOST("temp","La temperatura es requerida");
    $pe=$sistema->recuperaPOST("pe","El peso es requerida");
    $talla=$sistema->recuperaPOST("talla","La talla es requerida");
    $imc=$sistema->recuperaPOST("imc","El indice de masa corporal es requerido");
    $dxtx=$_POST['dxtx'];
    $texto_nota=$sistema->recuperaPOST("texto_nota","Los comentarios de la nota son requeridos");
    $diagnostico=$sistema->recuperaPOST("diagnostico","El diagnostico es requerido");

    $sql_guarda_nota=sprintf("UPDATE nota SET fecha_nota='$fecha',frecuencia_cardiaca='$fc',frecuencia_respiratoria='$fr',
    						  presion_arterial='$pa',temperatura=$temp,peso=$pe,talla=$talla,indice_masa_corporal=$imc,
    						  DxTx=$dxtx,texto_nota='$texto_nota',diagnostico_id=$diagnostico 
                              WHERE email='$usuario' AND paciente_id=$paciente_id AND texto_nota=0;");
                    if ($sistema->enlaceBD->query($sql_guarda_nota)) {
                        echo "<center><strong>Datos de la nota guardados con éxito.</strong></center>";
                    }else{
                        if(substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")){
                            echo "<center><strong>La nota ya se ha guardado.</strong></center>";
                        }else{
                            echo "<center><strong>Error al guardar la nota<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
                        }
                    }$sistema->desconectar();
?>