<?php
	require_once("../sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if(!isset($sistema)){
        require_once("../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
    $sistema->conectar();
    $busca_paciente=$sistema->recuperaPOST("busca_paciente","Apellido paterno es requerido para buscar al paciente");
    //echo $usuario." ".$nombre_pasante." Apellido Paterno paciente: ".$busca_paciente;
    /*QUERY CON LA QUE BUSCO AL PACIENTE EN LA BASE DE DATOS*/
    $sql_busca_paciente="SELECT count(paciente_id) AS num_paciente FROM paciente WHERE apellido_paterno LIKE '%$busca_paciente%' AND paciente_activo=1;";
    $num_paciente=$sistema->getBD($sql_busca_paciente,"num_paciente");
    //echo $num_paciente;
    $opcion=$_POST['opcion'];
    //echo $opcion."<br>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Buscar paciente</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../Interfaces/css/main.css" type="text/css">
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
						<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='../../bienvenido.php'">
							<span class="glyphicon glyphicon-home"></span> Inicio
						</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='../../../index.php'">Cerrar sesión
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Contenido -->
		<div id = "contenido" align = "center">
			<div class = "container-fluid" >
				<header>
					<!--<h1>Bienvenido <?php echo $nombre_pasante; ?></h1><br>-->
					<h1>Resultados de la búsqueda de pacientes</h1>
				</header>
				<hr>
			</div><br>
			<div class = "container">
				<div class = "row">
					<div class = "panel panel-default">
						<div class = "panel-heading"><h3>Lista de pacientes</h3></div>
						<div class = "panel-body">
							<p>Listado de pacientes con apellido paterno "<?php echo $busca_paciente; ?>".</p>
						</div>
						<!-- Tabla de nombres de pacientes -->
						<table class = "table table-hover table-condensed text-center">
							<tr>
								<td><strong>Nombre(s)</strong></td>
								<td><strong>Apellido paterno</strong></td>
								<td><strong>Apellido materno</strong></td>
								<td><strong>Opciones</strong></td>
							</tr>
							<tbody>
							<?php 
							if($num_paciente>0){
    							$sql_datos_paciente="SELECT paciente_id, 
    							CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) AS nombre_paciente,sexo,
    							apellido_paterno,apellido_materno,nombre 
    							FROM paciente WHERE apellido_paterno LIKE '%$busca_paciente%' AND paciente_activo=1;";
    							if($result_datos_paciente=$sistema->enlaceBD->query($sql_datos_paciente)){
    								while($row_datos_paciente=$result_datos_paciente->fetch_object()){
    									$paciente_id=$row_datos_paciente->paciente_id;
    									$nombre_paciente=$row_datos_paciente->nombre_paciente;
    									$apellido_paterno=$row_datos_paciente->apellido_paterno;
    									$apellido_materno=$row_datos_paciente->apellido_paterno;
    									$nombre=$row_datos_paciente->nombre;
    									$sexo=$row_datos_paciente->sexo;
    									//echo $paciente_id." ".$nombre_paciente."<br>";
    									echo "
    										<tr>
    											<td>$nombre</td>
    											<td>$apellido_paterno</td>
    											<td>$apellido_materno</td>
    											<td>
    												<button type=\"button\" class=\"btn btn-primary btn-md\" 
    													onclick=\"window.location.href='buscar.php?paciente_id=$paciente_id&nombre_paciente=$nombre_paciente&opcion=$opcion&sexo=$sexo'\">
														<span class=\"fa fa-folder-open-o\"></span> Ver
													</button>
    												<button type=\"button\" class=\"btn btn-warning btn-md\"
    													onclick=\"window.location.href='modificar.php?paciente_id=$paciente_id&nombre_paciente=$nombre_paciente&opcion=$opcion&sexo=$sexo'\">
														<span class=\"fa fa-edit\"></span> Editar
													</button>
													<button type=\"button\" class=\"btn btn-danger btn-md\">
														<span class=\"fa fa-close\"></span> Eliminar
													</button>
    											</td>
    										</tr>
    										";
    								}
    							}
    						}else{
    							echo "No se encontraron pacientes con ese apellido";
    						}
						?>
						</tbody>
						</table>
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
	<section id="contenedor">
		<nav>
			<ul>
				<li><a href="../bienvenido.php"><span class="icon icon-home2"></span>Inicio</a></li>
				<li><a href="registro_paciente.php?opcion_nota=4"><span class="icon icon-file-text"></span>Registro paciente</a></li>
				<li><a href="buscar_paciente.php?opcion=buscar"><span class="icon icon-profile"></span>Buscar paciente</a></li>
				<li><a href="buscar_paciente.php?opcion=baja"><span class="icon icon-profile"></span>Baja paciente</a></li>
				<li><a href="buscar_paciente.php?opcion=modificar"><span class="icon icon-profile"></span>Modificaci&oacute;n paciente</a></li>
				<li><a href="../../index.php"><span class="icon icon-clock"></span>Cerrar Sesi&oacute;n</a></li>
			</ul>
		</nav>
	</section>
</body>
</html>