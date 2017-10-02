<?php
	echo "<h3>notas</h3>
  			<p>
  				<a href=\"ver_nota.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id\" target=\"_blank\">Última nota</a><br>
  				<a href=\"todas_notas.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&opcion_nota=1\" target=\"_blank\">Todas las nota</a><br>
  				<a href=\"todas_notas.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&opcion_nota=2\" target=\"_blank\">Eliminar nota</a><br>
  				<a href=\"todas_notas.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id&opcion_nota=3\" target=\"_blank\">Modificar nota</a><br>
      			<a href=\"registro_paciente.php\">Nueva nota</a>
  			</p>";
?>