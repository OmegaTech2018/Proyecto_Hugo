<?php
	//echo $sexo;
	if ($sexo=="M") {
		echo "
  			<p>
  				<a href=\"Gabinete/lista_gabinete.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&gabinete=1\" target=\"_blank\">Electrocardiograma</a><br>
  				<a href=\"Gabinete/lista_gabinete.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&gabinete=3\" target=\"_blank\">Ultrasonidos</a><br>
  				<a href=\"Gabinete/lista_gabinete.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&gabinete=4\" target=\"_blank\">Rayos X</a><br>
  			</p>";
	}else{
		echo "
  			<p>
  				<a href=\"Gabinete/lista_gabinete.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&gabinete=1\" target=\"_blank\">Electrocardiograma</a><br>
  				<a href=\"Gabinete/lista_gabinete.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&gabinete=2\" target=\"_blank\">Papanicolaou</a><br>
  				<a href=\"Gabinete/lista_gabinete.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&gabinete=3\" target=\"_blank\">Ultrasonidos</a><br>
  				<a href=\"Gabinete/lista_gabinete.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&gabinete=4\" target=\"_blank\">Rayos X</a><br>
  			</p>";
	}
?>