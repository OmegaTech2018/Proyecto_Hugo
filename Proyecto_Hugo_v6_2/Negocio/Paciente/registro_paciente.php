<?php
	require_once("../sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if (!isset($sistema)) {
		require_once("../coneccion.php");
		$sistema=new sistema();
		$sistema->conectar();
	}
	$opcion_nota=$_GET["opcion_nota"];
	//echo $usuario." ".$nombre;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro Paciente</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel = "stylesheet" href = "../../Interfaces/css/main.css">
	<script src="../js/div.js"></script>
    <script src="../js/funcion.js"></script><!--CONTIENE LA FUNCION PARA QUE LA PESTAÑA AL DARLE CLICK MUESTRE LO INDICADO-->
    <script src="../js/ocultar.js"></script><!--CONTIENE LA FUNCION PARA OCULTAR CAMPOS-->
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
						<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='../bienvenido.php'">
							<span class="glyphicon glyphicon-home"></span> Inicio
						</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='../../index.php'">Cerrar sesión</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Contenido -->
		<div id = "contenido" align = "center">
			<div class = "container-fluid" >
				<h1>Registro de nuevo paciente en el sistema de Expediente Médico Digital</h1>
				<p>Favor de proporcionar la siguiente información</p>
			</div><br>
			<div class = "container">
				<div class = "row">
					<!-- Formulario de registro -->
					<form class="form-horizontal" action="guardar_paciente.php" name="fcontacto" method="POST">
					
						<input type="hidden" name="formulario" id="formulario" value="1">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<input type="hidden" name="nombre_pasante" id="nombre_pasante" value="<?php echo  $nombre_pasante; ?>">
						<input type="hidden" name="opcion_nota" id="opcion_nota" value="<?php echo  $opcion_nota; ?>">
			
						<h1><strong>Formulario de Registro de Paciente</strong><br><br>Datos personales del paciente</h1>
						<?php 
							/*SE AGREGA UNA NUEVA NOTA DE UN PACIENTE NUEVO*/
							if ($opcion_nota==4) {
								require_once("Nota/nota_nueva_paciente_nuevo.html");
							}
							/*SE AGREGA UNA NUEVA NOTA DE UN PACIENTE YA EXISTENTE*/
							if ($opcion_nota==3) {
								require_once("Nota/nota_nueva_paciente_existente.php");
							}
						?>
						<p><input class="btn btn-primary" type="submit" value="Guardar Paciente"></p>
					</form>
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