<?php
	require_once("../../sesion.php");
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
    $Nombre_paciente=$_GET['nombre_paciente'];
    if(!isset($sistema)){
        require_once("../../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }

    $sql_lista_hc=sprintf("SELECT  historia_clinica_id,fecha_historia_clinica  FROM historia_clinica_historico WHERE paciente_id=$paciente_id;");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista de Historias Clínicas</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../demo-files/demo.css">
	<link rel="stylesheet" href="../../../Interfaces/css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<header>
            <h1>Bienvenido <?php echo $nombre_pasante; ?></h1>
            <h2>Historiales del paciente: <?php echo $Nombre_paciente; ?></h2>
        </header>
        <?php
        	if($result_lista_hc=$sistema->enlaceBD->query($sql_lista_hc)){
            while($row_lista_hc=$result_lista_hc->fetch_object()){
                $hc_id=$row_lista_hc->historia_clinica_id;
                $fecha_hc=$row_lista_hc->fecha_historia_clinica;
                echo "<a href=\"hc_seleccionada.php?paciente_id=$paciente_id&nombre_paciente=$Nombre_paciente&hc_id=$hc_id&fecha_hc=$fecha_hc\">
                Fecha historia clínica: ".date('d-m-Y',strtotime($fecha_hc))." Número de expediene: $hc_id</a><br>";  
            }
          }else{echo "No se encontraron historicos";}
        ?>
	</section>
</body>
</html>