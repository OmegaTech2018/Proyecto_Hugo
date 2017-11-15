<header><h1><?php echo $nombre_pasante; ?><br><br>Expediente del Paciente: <?php echo $nombre_paciente; ?></h1></header>
		<div class="tab">
			<ul>
				<li><button class="tablinks" onclick="openCity(event, 'datos_personales')"><span class="icon icon-newspaper"></span>Datos Personales</button></li>
				<li><button class="tablinks" onclick="openCity(event, 'notas')"><span class="icon icon-newspaper"></span>Notas</button></li>
  				<li><button class="tablinks" onclick="openCity(event, 'historia_clinica')"><span class="icon icon-file-text2"></span>Historia Clinica</button></li>
  				<li><button class="tablinks" onclick="openCity(event, 'laboratorio')"><span class="icon icon-file-text2"></span>Laboratorios</button></li>
  				<li><button class="tablinks" onclick="openCity(event, 'gabinete')"><span class="icon icon-file-text2"></span>Gabinete</button></li>
  				<li><button class="tablinks" onclick="openCity(event, 'cita')"><span class="icon icon-clock"></span>Cita</button></li>
			</ul>
		</div>
		<div id="datos_personales" class="tabcontent">
			<?php  include_once("datos_personales.php"); ?>
		</div>
		<div id="notas" class="tabcontent">
			<?php  include_once("Nota/expediente_notas.php"); ?>
		</div>
		<div id="historia_clinica" class="tabcontent">
  			<?php  include_once("Historia_Clinica/expediente_historia_clinica.php"); ?> 
		</div>
		<div id="laboratorio" class="tabcontent">
  			<?php  include_once("Laboratorio/expediente_laboratorio.php"); ?>
		</div>
		<div id="gabinete" class="tabcontent">
  			<?php  include_once("Gabinete/expediente_gabinete.php"); ?>
		</div>
		<div id="cita" class="tabcontent">
  			<?php  include_once("Cita/expediente_cita.php"); ?>
		</div>