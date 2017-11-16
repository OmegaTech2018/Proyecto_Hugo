<?php
	//echo $nombre_paciente." ".$paciente_id;
	$sql_busca_paciente=sprintf("SELECT nombre, apellido_paterno,apellido_materno,edad_paciente,embarazo,recien_nacido,telefono,sexo 
                               FROM paciente WHERE paciente_id=$paciente_id;");
    echo "Paciente id: ".$paciente_id."<br>";
   	echo "Nombre: ".$Nombre=$sistema->getBD($sql_busca_paciente,"nombre")."<br>";
   	echo "Apellido Paterno: ".$Ap_Paterno=$sistema->getBD($sql_busca_paciente,"apellido_paterno")."<br>";
   	echo "Apellido Materno: ".$Ap_Materno=$sistema->getBD($sql_busca_paciente,"apellido_materno")."<br>";
   	echo "Edad: ".$Edad_Paciente=$sistema->getBD($sql_busca_paciente,"edad_paciente")."<br>";
    echo "Sexo: ".$Sexo=$sistema->getBD($sql_busca_paciente,"sexo")."<br>";
    echo "Embarazo: ".$Edad_Paciente=$sistema->getBD($sql_busca_paciente,"embarazo")."<br>";
    echo "Recien nacido: ".$Edad_Paciente=$sistema->getBD($sql_busca_paciente,"recien_nacido")."<br>";
   	echo "Telefono: ".$Telefono=$sistema->getBD($sql_busca_paciente,"telefono");
?>