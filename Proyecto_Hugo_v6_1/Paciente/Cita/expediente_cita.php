<?php
  $sistema->conectar();

  $sql_cantidad_citas=sprintf("SELECT COUNT(fecha_cita) AS cantidad_cita FROM cita WHERE paciente_id=1;");
  $cantidad_cita=$sistema->getBD($sql_cantidad_citas,"cantidad_cita");
if ($cantidad_cita==0) {
  	echo "El paciente aún no tiene ninguna cita";
  }else{
  	$sql_listar_citas=sprintf("SELECT fecha_cita FROM cita WHERE paciente_id=$paciente_id;");
  	if ($result_citas_paciente=$sistema->enlaceBD->query($sql_listar_citas)) {
    	while ($row_citas_paciente=$result_citas_paciente->fetch_object()) {
      		$fecha_cita=$row_citas_paciente->fecha_cita;
      		echo "<a href=\"Cita/abrir_cita.php?paciente_id=$paciente_id&nombre_paciente=$nombre_paciente&fecha_cita=$fecha_cita\">".
      		date('d-m-Y',strtotime($fecha_cita))."</a><br>";
    	}
  	}else{echo "<center><strong>Por el momento no se pueden visualizar las citas del paciente</strong></center>";}
  	$sistema->desconectar();
  }
  $sistema->desconectar();
?>