<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel = "stylesheet" href = "Interfaces/css/main.css">
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
					<img src= "Interfaces/imag/neuros.jpg" height = "80" width = "100"></img>
				</div>
				<div class = "col-md-4">
					<h2>Expediente Médico Digital</h2>
					<h4>Centro de Salud San Francisco Mihualtepec</h4>
				</div>
			</div>
		</div>
		<!-- Contenido -->
		<div id = "contenido" align = "center">
			<div class = "container-fluid" >
				<h1>Inicio de sesión en el sistema de Expediente Médico Digital</h1>
				<p>Favor de proporcionar la siguiente información</p>
			</div><br>
			<div class = "container">
				<div class = "row">
					<!-- Formulario de inicio de sesión -->
					<form class = "form-horizontal" action="Negocio/autentificacion.php" method="POST">
						<!-- Correo electrónico: -->
						 <div class="form-group">
							<label for="inputName" class="col-md-4 control-label">Correo electrónico:</label>
							<div class="col-md-4">
							  <input type="email" class="form-control" id="email" name="email" placeholder="correo@mail.com" required="required">
							</div>
						 </div>
						 <!-- Contraseña: -->
						 <div class="form-group">
							<label for="inputName" class="col-md-4 control-label">Contraseña:</label>
							<div class="col-md-4">
							  <input type="password" class="form-control" id="password" name="password" required="required">
							</div>
						 </div>
						 <!-- Envío -->
						 <p>
							<input class="btn btn-primary" type="submit" value="Iniciar sesión">
						 </p>
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
					<img src="Interfaces/imag/logoOmegaTech_v2.jpg" height = "80px" width = "80px"></img><br>
					OmegaTech
				</div>
			</div>
		</div>
	</div>
</body>
</html>