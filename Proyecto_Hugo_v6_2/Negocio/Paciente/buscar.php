<?php
	require_once("../sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
	$nombre_paciente=$_GET['nombre_paciente'];
	$sexo=$_GET['sexo'];
	if(!isset($sistema)){
        require_once("../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Datos del paciene</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel = "stylesheet" href = "../../Interfaces/css/main.css">
	<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div id = "wrapper">
		<!-- Cabecera -->
		<div class="container-fluid navbar-fixed-top" id = "cabecera">
			<div class = "row">
				<div class = "col-md-1">
					<img src= "../../Interfaces/imag/neuros.jpg" height = "80" width = "100"></img>
				</div>
				<div class = "col-md-4">
					<h2>Expediente Médico Digital</h2>
					<h4>Centro de Salud San Francisco Mihualtepec</h4>
				</div>
				<div class = "col-md-7" style="position: absolute; bottom: 10px; right:15px;" align = "right">
					<div class = "row">
						<form class="form-inline" action="lista_paciente.php" method="post">
							Buscar paciente: <input class="form-control input-sm" type="text" id="busca_paciente" name="busca_paciente" 
								required="required" placeholder="Apellido Paterno">
							<input class="btn btn-danger btn-sm" type="submit" value="Buscar">
						</form>
					</div><br>
					<div class = "row">
						<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='indexUser.html'">
							<span class="glyphicon glyphicon-home"></span> Inicio
						</button>
						<button type="button" class="btn btn-danger btn-sm" 
							onclick="window.location.href='Paciente/registro_paciente.php?opcion_nota=4'">Registrar paciente</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='index.php'">Cerrar sesión</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Contenido -->
		<div id = "contenido" align = "center">
			<div class = "container-fluid" >
				<?php //echo $nombre_pasante; ?>
				<h1>Expediente del paciente</h1>
				<h3>Paciente: <?php echo $nombre_paciente; ?></h3>
			</div><br>
			<div class = "container">
				<ul class = "nav nav-tabs h4">
					<li class = "active"><a data-toggle = "tab" href = "#datosPersonales"><span class="fa fa-address-card-o"></span> Datos personales</a></li>
					<li><a data-toggle = "tab" href = "#notas"><span class="fa fa-sticky-note-o"></span> Notas</a></li>
					<li><a data-toggle = "tab" href = "#historia"><span class="fa fa-clipboard"></span> Historia Clínica</a></li>
					<li><a data-toggle = "tab" href = "#labs"><span class="fa fa-flask"></span> Laboratorios</a></li>
					<li><a data-toggle = "tab" href = "#gabinete"><span class="fa fa-list-alt"></span> Gabinete</a></li>
					<li><a data-toggle = "tab" href = "#cita"><span class="fa fa-clock-o"></span> Cita</a></li>
				</ul>
				<div class = "tab-content">
					<div id = "datosPersonales" class = "tab-pane fade in active">
						<h3>Datos personales</h3>
						<?php  include_once("datos_personales.php"); ?>
					</div>
					<div id = "notas" class = "tab-pane fade">
						<h3>Notas</h3>
						<?php  include_once("Nota/expediente_notas.php"); ?>
					</div>
					<div id = "historia" class = "tab-pane fade">
						<h3>Historia Clínica</h3>
						<?php  include_once("Historia_Clinica/expediente_historia_clinica.php"); ?>
					</div>
					<div id = "labs" class = "tab-pane fade">
						<h3>Laboratorios</h3>
						<?php  include_once("expediente_laboratorio.php"); ?>
					</div>
					<div id = "gabinete" class = "tab-pane fade">
						<h3>Gabinete</h3>
						<?php  include_once("Gabinete/expediente_gabinete.php"); ?>
					</div>
					<div id = "cita" class = "tab-pane fade">
						<h3>Cita</h3>
						<?php  include_once("Cita/expediente_cita.php"); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- Pie de página -->
		<div id = "pie">
			<div class = "container-fluid text-muted">
				<div class = "col-md-3">
					<span>
						&copy; 2017 Expediente Médico Digital<br>
						Centro de salud: San Francisco Mihualtepec<br>
						<a href = "#">Aviso de privacidad</a><br>
						Última actualización: 28 de octubre de 2017
					</span>
				</div>
				<div class = "col-md-6" align = "center">
					<span>
						<strong>Grupo de desarrollo: OmegaTech</strong><br><br>
						<ul align = "left">
						<li>Víctor Arturo Morales Díaz | <span class="glyphicon glyphicon-earphone"></span> +52 1 55 3100 0803 | <span class="glyphicon glyphicon-envelope"></span> ar2days@gmail.com</li>
						<li>David Antúnez Montoya | <span class="glyphicon glyphicon-earphone"></span> +52 1 464 100 9135 | <span class="glyphicon glyphicon-envelope"></span> xps.3000cc@gmail.com</li>
						<li>Miqueas Esli Aldama Sánchez | <span class="glyphicon glyphicon-earphone"></span> +52 1 55 6481 6752 | <span class="glyphicon glyphicon-envelope"></span> mikefantas2@gmail.com</li>
						<li>David Sánchez Nolasco | <span class="glyphicon glyphicon-earphone"></span> +52 1 55 9139 2527 | <span class="glyphicon glyphicon-envelope"></span> lci.david.sanchez.unam@gmail.com</li>
						</ul>
					</span>
				</div>
				<div class = "col-md-3" align = "center">
					<img src="../../Interfaces/imag/logoOmegaTech_v2.jpg" height = "80px" width = "80px"></img><br>
					OmegaTech
				</div>
			</div>
		</div>
	</div>
</body>
</html>
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
  			<?php  include_once("expediente_laboratorio.php"); ?>
		</div>
		<div id="gabinete" class="tabcontent">
  			<?php  include_once("Gabinete/expediente_gabinete.php"); ?>
		</div>
		<div id="cita" class="tabcontent">
  			<?php  include_once("Cita/expediente_cita.php"); ?>
		</div>