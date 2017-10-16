<?php
	require_once("../sesion.php");
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
    $Nombre_paciente=$_GET['nombre_paciente'];
    $gabinete=$_GET['gabinete'];
	if(!isset($sistema)){
        require_once("coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista Gabinetes</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<section id="cuerpo">
			<header>
				<h1>Bienvenido <?php echo $nombre_pasante; ?></h1><br>
			</header>
			<?php 
				switch ($gabinete) {
					/*ELECTROCARDIOGRAMAS*/
					case 1:
						echo "<h2>Lista de los electrocardiogramas del paciente: ".$Nombre_paciente."</h2>";
						$sql_num_electro=sprintf("SELECT count(ge.gabinete_electrocardiogramas_id) AS num_electro
												  FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
												  INNER JOIN gabinete_electrocardiogramas ge ON n.nota_id=ge.nota_id
												  WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND ge.bandera=1;");
						$num_electro=$sistema->getBD($sql_num_electro,"num_electro");
						if($num_electro>0){
							//echo $num_paciente."<br>";
    						$sql_datos_electro="SELECT n.nota_id,n.fecha_nota,ge.gabinete_electrocardiogramas_id 
												FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
												INNER JOIN gabinete_electrocardiogramas ge ON n.nota_id=ge.nota_id
												WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND ge.bandera=1;";
    						if($result_datos_electro=$sistema->enlaceBD->query($sql_datos_electro)){
    							while($row_datos_electro=$result_datos_electro->fetch_object()){
    								$nota_id=$row_datos_electro->nota_id;
    								$electro_id=$row_datos_electro->gabinete_electrocardiogramas_id;
    								$fecha_nota=$row_datos_electro->fecha_nota;
    								echo "<a href=\"abrir_gabinete.php?electro_id=$electro_id&Nombre_paciente=$Nombre_paciente&paciente_id=$paciente_id&gabinete=$gabinete&nota_id=$nota_id\">
    								ID Electrocardiograma: $electro_id ID nota: $nota_id Fecha Nota: $fecha_nota</a><br>";
    							}
    						}
    					}else{
    						echo "No se encontraron Electrocardiogramas";
    					}
					break;
					/*PAPANICOLAOU*/
					case 2:
						echo "<h2>Lista de los Papanicolaou del paciente: ".$Nombre_paciente."</h2>";
						$sql_num_papanicolaou=sprintf("SELECT count(gp.gabinete_papanicolaou_id) AS num_papanicolaou
													   FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
													   INNER JOIN gabinete_papanicolaou gp ON n.nota_id=gp.nota_id
													   WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND gp.bandera=1;");
						$num_papanicolaou=$sistema->getBD($sql_num_papanicolaou,"num_papanicolaou");
						if($num_papanicolaou>0){
							//echo $num_paciente."<br>";
    						$sql_datos_papanicolaou="SELECT n.nota_id,n.fecha_nota,gp.gabinete_papanicolaou_id 
													 FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
													 INNER JOIN gabinete_papanicolaou gp ON n.nota_id=gp.nota_id
													 WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND gp.bandera=1;";
    						if($result_datos_papanicolaou=$sistema->enlaceBD->query($sql_datos_papanicolaou)){
    							while($row_datos_papanicolaou=$result_datos_papanicolaou->fetch_object()){
    								$nota_id=$row_datos_papanicolaou->nota_id;
    								$fecha_nota=$row_datos_papanicolaou->fecha_nota;
    								$papanicolaou_id=$row_datos_papanicolaou->gabinete_papanicolaou_id;
    								echo "<a href=\"abrir_gabinete.php?papanicolaou_id=$papanicolaou_id&Nombre_paciente=$Nombre_paciente&paciente_id=$paciente_id&gabinete=$gabinete&nota_id=$nota_id\">
    								ID Papanicolaou: $papanicolaou_id ID nota: $nota_id Fecha Nota: $fecha_nota</a><br>";
    							}
    						}
    					}else{
    						echo "No se encontraron Papanicolaou";
    					}
					break;
					/*ULTRASONIDOS*/
					case 3:
						echo "<h2>Lista de los Ultrasonidos del paciente: ".$Nombre_paciente."</h2>";
						$sql_num_ultrasonidos=sprintf("SELECT count(gu.gabinete_ultrasonidos_id) AS num_ultrasonidos
													   FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
													   INNER JOIN gabinete_ultrasonidos gu ON n.nota_id=gu.nota_id
													   WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND gu.bandera=1;");
						$num_ultrasonidos=$sistema->getBD($sql_num_ultrasonidos,"num_ultrasonidos");
						if($num_ultrasonidos>0){
							//echo $num_paciente."<br>";
    						$sql_datos_ultrasonido="SELECT n.nota_id,n.fecha_nota,gu.gabinete_ultrasonidos_id
													FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
													INNER JOIN gabinete_ultrasonidos gu ON n.nota_id=gu.nota_id
													WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND gu.bandera=1;";
    						if($result_datos_ultrasonido=$sistema->enlaceBD->query($sql_datos_ultrasonido)){
    							while($row_datos_ultrasonido=$result_datos_ultrasonido->fetch_object()){
    								$nota_id=$row_datos_ultrasonido->nota_id;
    								$fecha_nota=$row_datos_ultrasonido->fecha_nota;
    								$ultrasonidos_id=$row_datos_ultrasonido->gabinete_ultrasonidos_id;
    								echo "<a href=\"abrir_gabinete.php?ultrasonidos_id=$ultrasonidos_id&Nombre_paciente=$Nombre_paciente&paciente_id=$paciente_id&gabinete=$gabinete&nota_id=$nota_id\">
    								ID Ultrasonido: $ultrasonidos_id ID Nota: $nota_id Fecha Nota: $fecha_nota</a><br>";
    							}
    						}
    					}else{
    						echo "No se encontraron Ultrasonidos";
    					}
					break;
					/*RAYOS X*/
					case 4:
						echo "<h2>Lista de los rayos x del paciente: ".$Nombre_paciente."</h2>";
						$sql_num_rayosx=sprintf("SELECT count(gr.gabinete_rayosx_id) AS num_rayosx
												 FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
												 INNER JOIN gabinete_rayosx gr ON n.nota_id=gr.nota_id
												 WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND gr.bandera=1;");
						$num_rayosx=$sistema->getBD($sql_num_rayosx,"num_rayosx");
						if($num_rayosx>0){
							//echo $num_paciente."<br>";
    						$sql_datos_rayosx="SELECT n.nota_id,n.fecha_nota,gr.gabinete_rayosx_id
											   FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
											   INNER JOIN gabinete_rayosx gr ON n.nota_id=gr.nota_id
											   WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND gr.bandera=1;";
    						if($result_datos_rayosx=$sistema->enlaceBD->query($sql_datos_rayosx)){
    							while($row_datos_rayosx=$result_datos_rayosx->fetch_object()){
    								$nota_id=$row_datos_rayosx->nota_id;
    								$fecha_nota=$row_datos_rayosx->fecha_nota;
    								$rayosx_id=$row_datos_rayosx->gabinete_rayosx_id;
    								echo "<a href=\"abrir_gabinete.php?rayosx_id=$rayosx_id&Nombre_paciente=$Nombre_paciente&paciente_id=$paciente_id&gabinete=$gabinete&nota_id=$nota_id\">
    								ID Rayos X: $rayosx_id ID Nota: $nota_id Fecha Nota: $fecha_nota</a><br>";
    							}
    						}
    					}else{
    						echo "No se encontraron Rayos X";
    					}
					break;
				}
			?>
		</section>
	</section>
</body>
</html>