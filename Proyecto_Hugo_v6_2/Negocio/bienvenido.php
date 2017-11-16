<?php
	require_once("sesion.php");
	
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if(!isset($sistema)){
        require_once("coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel = "stylesheet" href = "../Interfaces/css/main.css">
<script>
	var path = ['../Interfaces/imag/main1.jpg', '../Interfaces/imag/main2.jpg', '../Interfaces/imag/main3.jpg'];
	var i = 0;
	$(document).ready(function(){
	
		$('#mainImage').append('<h3><img id = "imagenMain" src= "../Interfaces/imag/main1.jpg" height = "400" width = "400"></img></h3>');
		
		/*function loopImages(i){
			if(i == 3){
				i = 0;
			}
			$('#imagenMain').attr('src', path[i]);
			$('#imagenMain').fadeIn(3000, loopImages(i + 1));
		}
		loopImages(0);*/
	});
</script>
<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
<title>Expediente Médico</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div id = "wrapper">
		<!-- Cabecera -->
		<div class="container-fluid navbar-fixed-top" id = "cabecera">
			<div class = "row">
				<div class = "col-md-1">
					<img src= "../Interfaces/imag/neuros.jpg" height = "80" width = "100"></img>
				</div>
				<div class = "col-md-4">
					<h2>Expediente Médico Digital</h2>
					<h4>Centro de Salud San Francisco Mihualtepec</h4>
				</div>
				<div class = "col-md-7" style="position: absolute; bottom: 10px; right:15px;" align = "right">
					<div class = "row">
						<form class="form-inline" action="Paciente/lista_paciente.php" method="post">
							Buscar paciente: <input class="form-control input-sm" type="text" id="busca_paciente" name="busca_paciente" 
								required="required" placeholder="Apellido Paterno">
							<input class="btn btn-danger btn-sm" type="submit" value="Buscar">
						</form>
					</div><br>
					<div class = "row">
						<button type="button" class="btn btn-danger btn-sm" 
							onclick="window.location.href='Paciente/registro_paciente.php?opcion_nota=4'">Registrar paciente
						</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='../index.php'">Cerrar sesión</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Contenido -->
		<div id = "contenido" align = "center">
			<div class = "container-fluid" >
				<h1>Bienvenido:<br> <?php echo $nombre_pasante; ?> al sistema de Expediente Médico Digital</h1>
				<h2>Centro de salud San Francisco Mihualtepec</h2>
			</div><br>
			<div class = "container">
				<div class = "row">
					<div class = "col-md-5" align = "left">
						<h3>El sistema de Expediente Médico Digital permite:</h3>
						<div class = "panel panel-default">
							<div class = "panel-heading"><strong><i class="fa fa-sticky-note-o" style="font-size:30px"></i> Notas</strong></div>
							<div class = "panel-body">
								Guardar notas por consulta<br>
								Consultar historial de notas de cada paciente
							</div>
						</div>
						<div class = "panel panel-default">
							<div class = "panel-heading"><strong><i class="fa fa-address-book-o" style="font-size:30px"></i> Pacientes</strong></div>
							<div class = "panel-body">
								Dar de alta a pacientes<br>
								Dar de baja pacientes<br>
								Guardar y consultar datos personales de pacientes
							</div>
						</div>
						<div class = "panel panel-default">
							<div class = "panel-heading"><strong><i class="fa fa-flask" style="font-size:30px"></i> Laboratorios</strong></div>
							<div class = "panel-body">
								Guardar y consular resultados de laboratorios.
							</div>
						</div>
						<div class = "panel panel-default">
							<div class = "panel-heading"><strong><i class="fa fa-clock-o" style="font-size:30px"></i> Citas</strong></div>
							<div class = "panel-body">
								Agendar próximas citas.
							</div>
						</div>
					</div>
					<div class = "col-md-7" align = "rigth" id = "mainImage">
						<!-- <h3><img id = "imagenMain" src= srcImageMain height = "400" width = "400"></img></h3> -->
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
					<img src="../Interfaces/imag/logoOmegaTech_v2.jpg" height = "80px" width = "80px"></img><br>
					OmegaTech
				</div>
			</div>
		</div>
	</div>
</body>
</html>