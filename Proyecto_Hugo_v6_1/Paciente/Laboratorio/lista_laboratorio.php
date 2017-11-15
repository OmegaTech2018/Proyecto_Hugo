<?php
	require_once("../../sesion.php");
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
    $Nombre_paciente=$_GET['nombre_paciente'];
    $laboratorio=$_GET['laboratorio'];
	if(!isset($sistema)){
        require_once("../../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista Laboratorios</title>
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
				switch ($laboratorio) {
					/*BH*/
					case 1:
						echo "<h2>Lista de los BH del paciente: ".$Nombre_paciente."</h2>";
						$sql_num_bh=sprintf("SELECT count(lbh.laboratorio_bh_id) AS num_bh
												  FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
												  INNER JOIN laboratorio_bh lbh ON n.nota_id=lbh.nota_id
												  WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND lbh.bandera=1;");
						$num_bh=$sistema->getBD($sql_num_bh,"num_bh");
						if($num_bh>0){
							//echo $num_paciente."<br>";
    						$sql_datos_bh="SELECT n.nota_id,n.fecha_nota,lbh.laboratorio_bh_id 
												FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
												INNER JOIN laboratorio_bh lbh ON n.nota_id=lbh.nota_id
												WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND lbh.bandera=1;";
    						if($result_datos_bh=$sistema->enlaceBD->query($sql_datos_bh)){
    							while($row_datos_bh=$result_datos_bh->fetch_object()){
    								$nota_id=$row_datos_bh->nota_id;
    								$bh_id=$row_datos_bh->laboratorio_bh_id;
    								$fecha_nota=$row_datos_bh->fecha_nota;
    								echo "<a href=\"abrir_laboratorio.php?bh_id=$bh_id&Nombre_paciente=$Nombre_paciente&paciente_id=$paciente_id&laboratorio=$laboratorio&nota_id=$nota_id\">
    								ID bh: $bh_id ID nota: $nota_id Fecha Nota: $fecha_nota</a><br>";
    							}
    						}
    					}else{
    						echo "No se encontraron BH";
    					}
					break;
					/*QS*/
					case 2:
						echo "<h2>Lista de los QS del paciente: ".$Nombre_paciente."</h2>";
						$sql_num_qs=sprintf("SELECT count(lqs.laboratorio_qs_id) AS num_qs
													   FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
													   INNER JOIN laboratorio_qs lqs ON n.nota_id=lqs.nota_id
													   WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND lqs.bandera=1;");
						$num_qs=$sistema->getBD($sql_num_qs,"num_qs");
						if($num_qs>0){
							//echo $num_paciente."<br>";
    						$sql_datos_qs="SELECT n.nota_id,n.fecha_nota,lqs.laboratorio_qs_id 
													 FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
													 INNER JOIN laboratorio_qs lqs ON n.nota_id=lqs.nota_id
													 WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND lqs.bandera=1;";
    						if($result_datos_qs=$sistema->enlaceBD->query($sql_datos_qs)){
    							while($row_datos_qs=$result_datos_qs->fetch_object()){
    								$nota_id=$row_datos_qs->nota_id;
    								$fecha_nota=$row_datos_qs->fecha_nota;
    								$qs_id=$row_datos_qs->laboratorio_qs_id;
    								echo "<a href=\"abrir_laboratorio.php?qs_id=$qs_id&Nombre_paciente=$Nombre_paciente&paciente_id=$paciente_id&laboratorio=$laboratorio&nota_id=$nota_id\">
    								ID qs: $qs_id ID nota: $nota_id Fecha Nota: $fecha_nota</a><br>";
    							}
    						}
    					}else{
    						echo "No se encontraron QS";
    					}
					break;
					/*EGO*/
					case 3:
						echo "<h2>Lista de los ego del paciente: ".$Nombre_paciente."</h2>";
						$sql_num_ego=sprintf("SELECT count(le.laboratorio_ego_id) AS num_ego
													   FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
													   INNER JOIN laboratorio_ego le ON n.nota_id=le.nota_id
													   WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND le.bandera=1;");
						$num_ego=$sistema->getBD($sql_num_ego,"num_ego");
						if($num_ego>0){
							//echo $num_paciente."<br>";
    						$sql_datos_ego="SELECT n.nota_id,n.fecha_nota,le.laboratorio_ego_id
													FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
													INNER JOIN laboratorio_ego le ON n.nota_id=le.nota_id
													WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND le.bandera=1;";
    						if($result_datos_ultrasonido=$sistema->enlaceBD->query($sql_datos_ego)){
    							while($row_datos_ultrasonido=$result_datos_ultrasonido->fetch_object()){
    								$nota_id=$row_datos_ego->nota_id;
    								$fecha_nota=$row_datos_ego->fecha_nota;
    								$ego_id=$row_datos_ego->laboratorio_ego_id;
    								echo "<a href=\"abrir_laboratorio.php?ego_id=$ego_id&Nombre_paciente=$Nombre_paciente&paciente_id=$paciente_id&laboratorio=$laboratorio&nota_id=$nota_id\">
    								ID ego: $ego_id ID Nota: $nota_id Fecha Nota: $fecha_nota</a><br>";
    							}
    						}
    					}else{
    						echo "No se encontraron EGO";
    					}
					break;
					/*Cultivos*/
					case 4:
						echo "<h2>Lista de los Cultivos del paciente: ".$Nombre_paciente."</h2>";
						$sql_num_cultivos=sprintf("SELECT count(lc.laboratorio_cultivos_id) AS num_cultivos
												 FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
												 INNER JOIN laboratorio_cultivos lc ON n.nota_id=lc.nota_id
												 WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND lc.bandera=1;");
						$num_cultivos=$sistema->getBD($sql_num_cultivos,"num_cultivos");
						if($num_cultivos>0){
							//echo $num_paciente."<br>";
    						$sql_datos_cultivos="SELECT n.nota_id,n.fecha_nota,lc.laboratorio_cultivos_id
											   FROM paciente p INNER JOIN nota n ON p.paciente_id=n.paciente_id
											   INNER JOIN laboratorio_cultivos lc ON n.nota_id=gr.nota_id
											   WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1 AND gr.bandera=1;";
    						if($result_datos_cultivos=$sistema->enlaceBD->query($sql_datos_cultivos)){
    							while($row_datos_cultivos=$result_datos_cultivos->fetch_object()){
    								$nota_id=$row_datos_cultivos->nota_id;
    								$fecha_nota=$row_datos_cultivos->fecha_nota;
    								$cultivos_id=$row_datos_cultivos->laboratorio_cultivos_id;
    								echo "<a href=\"abrir_laboratorio.php?cultivos_id=$cultivos_id&Nombre_paciente=$Nombre_paciente&paciente_id=$paciente_id&laboratorio=$laboratorio&nota_id=$nota_id\">
    								ID Cultivos: $cultivos_id ID Nota: $nota_id Fecha Nota: $fecha_nota</a><br>";
    							}
    						}
    					}else{
    						echo "No se encontraron Cultivos";
    					}
					break;
				}
			?>
		</section>
	</section>
</body>
</html>