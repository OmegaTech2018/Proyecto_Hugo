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
<html>
<head>
	<title>Buscar paciente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../demo-files/demo.css">
	<link rel="stylesheet" href="../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<nav>
			<ul>
				<li><a href="../bienvenido.php"><span class="icon icon-home2"></span>Inicio</a></li>
				<li><a href="registro_paciente.php?opcion_nota=4"><span class="icon icon-file-text"></span>Registro paciente</a></li>
				<li><a href="buscar_paciente.php?opcion=buscar"><span class="icon icon-profile"></span>Buscar paciente</a></li>
				<li><a href="buscar_paciente.php?opcion=baja"><span class="icon icon-profile"></span>Baja paciente</a></li>
				<li><a href="buscar_paciente.php?opcion=modificar"><span class="icon icon-profile"></span>Modificaci&oacute;n paciente</a></li>
				<li><a href="../index.php"><span class="icon icon-clock"></span>Cerrar Sesi&oacute;n</a></li>
			</ul>
		</nav>
		<hr>
		<section id="cuerpo">
			<header>
				<h1>Bienvenido <?php echo $nombre_pasante; ?></h1><br>
				<h2>Lista de pacientes encontrados con el apellido paterno: <?php  echo $busca_paciente; ?></h2>
			</header>
			<?php 
				if($num_paciente>0){
					//echo $num_paciente."<br>";
    				$sql_datos_paciente="SELECT paciente_id, CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) AS nombre_paciente,sexo 
    									 FROM paciente WHERE apellido_paterno LIKE '%$busca_paciente%' AND paciente_activo=1;";
    				if($result_datos_paciente=$sistema->enlaceBD->query($sql_datos_paciente)){
    					while($row_datos_paciente=$result_datos_paciente->fetch_object()){
    						$paciente_id=$row_datos_paciente->paciente_id;
    						$nombre_paciente=$row_datos_paciente->nombre_paciente;
    						$sexo=$row_datos_paciente->sexo;
    						//echo $paciente_id." ".$nombre_paciente."<br>";
    						echo "<a href=\"abrir_expediente.php?paciente_id=$paciente_id&nombre_paciente=$nombre_paciente&opcion=$opcion&sexo=$sexo\">$nombre_paciente</a><br>";
    					}
    				}
    			}else{
    				echo "No se encontraron pacientes con ese apellido";
    			}
			?>
		</section>
	</section>
</body>
</html>