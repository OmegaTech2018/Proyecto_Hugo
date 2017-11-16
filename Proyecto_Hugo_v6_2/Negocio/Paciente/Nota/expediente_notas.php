<?php
	echo "
  			<p>
  				<a href=\"Nota/ver_nota.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id\" target=\"_blank\">Última nota</a><br>
  				<a href=\"Nota/todas_notas.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&opcion_nota=1\" target=\"_blank\">Todas las nota</a><br>
      			<a href=\"registro_paciente.php?paciente_id=$paciente_id&opcion_nota=3\">Nueva nota</a>
  			</p>";
?>