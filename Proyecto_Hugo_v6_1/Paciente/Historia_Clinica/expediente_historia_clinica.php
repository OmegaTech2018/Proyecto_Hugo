<?php
	$sql_existe_hc=sprintf("SELECT COUNT(paciente_id) AS existe FROM historia_clinica WHERE paciente_id=$paciente_id;");
    $sistema->conectar();/*ACCEDO AL METODO conectar DE LA CLASE SISTEMA PARA COMPROBAR SI EL USUARIO EXISTE*/
    $existe=$sistema->getBD($sql_existe_hc,"existe");/*CON EL METODO getBD DE LA CLASE SISTEMA, EJECUTO LA QUERY Y OBTENGO EL NÚMERO*/

    if ($existe==1) {
    	echo "<a href=\"Historia_Clinica/ver_historial_historia_clinica.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id\" target=\"_blank\">Historial de historias clínica</a><br>
            <a href=\"Historia_Clinica/ver_historia_clinica.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id\" target=\"_blank\">Historia clínica actual</a><br>
    		<a href=\"Historia_Clinica/modificar_historia_clinica.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id\" target=\"_blank\">Modificar historia clinica</a>
    		";
    }else{ echo "No tiene historia clinica<br>
    			 <a href=\"Historia_Clinica/historia_clinica.php?paciente_id=$paciente_id\" >Crear historia clinica</a>";}
    $sistema->desconectar();
?>