<?php
require_once("../../sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
    $Nombre_paciente=$_GET['nombre_paciente'];
    $opcion_nota=$_GET['opcion_nota'];
	if(!isset($sistema)){
        require_once("../../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
    //echo $nombre_pasante." ".$paciente_id;

    $sql_lista_notas="SELECT nota_id,fecha_nota,d.diagnostico_id,descripcion_diagnostico FROM nota n 
                      INNER JOIN paciente p ON n.paciente_id=p.paciente_id
                      INNER JOIN diagnostico d ON n.diagnostico_id=d.diagnostico_id
                      WHERE p.paciente_id=$paciente_id AND p.paciente_activo=1;";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Todas las notas</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../demo-files/demo.css">
	<link rel="stylesheet" href="../../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
        <header>
            <h1>Bienvenido <?php echo $nombre_pasante; ?></h1>
            <h2>Todas las notas del paciente: <?php echo $Nombre_paciente; ?></h2>
        </header>
        <?php
          if($result_notas_paciente=$sistema->enlaceBD->query($sql_lista_notas)){
            while($row_notas_paciente=$result_notas_paciente->fetch_object()){
                $nota_id=$row_notas_paciente->nota_id;
                $fecha=$row_notas_paciente->fecha_nota;
                $diagnostico_id=$row_notas_paciente->diagnostico_id;
                $descripcion_diagnostico=$row_notas_paciente->descripcion_diagnostico;
                //echo $paciente_id." ".$nombre_paciente."<br>";
                echo "<a href=\"nota_seleccionada.php?paciente_id=$paciente_id&nombre_paciente=$Nombre_paciente&nota_id=$nota_id&fecha=$fecha&diagnostico_id=$diagnostico_id\">
                Fecha nota: ".date('d-m-Y',strtotime($fecha))." Diagnostico: $descripcion_diagnostico</a><br>";  
            }
          }else{echo "No se encontraron notas del paciente";}  
        ?>
    </section>
</body>
</html>