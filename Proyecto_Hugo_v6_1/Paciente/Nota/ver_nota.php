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
    //echo $nombre_pasante." ".$paciente_id;
    $sql_ultima_nota_paciente=sprintf("SELECT nota_id,fecha_nota,frecuencia_cardiaca,frecuencia_respiratoria,presion_arterial,
                                       temperatura,peso,talla,indice_masa_corporal,DxTx,texto_nota,descripcion_diagnostico 
                                       FROM nota n INNER JOIN diagnostico d ON n.diagnostico_id=d.diagnostico_id
                                       WHERE n.nota_id=(SELECT MAX(nota_id) FROM nota WHERE paciente_id=$paciente_id);");
    $fecha_nota=$sistema->getBD($sql_ultima_nota_paciente,"fecha_nota");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ver nota</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../demo-files/demo.css">
	<link rel="stylesheet" href="../../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
    <section id="contenedor">
        <header>
            <h1>Bienvenido <?php echo $nombre_pasante; ?></h1>
            <h2>Última nota del paciente: <?php echo $Nombre_paciente; ?></h2>
        </header>
        <?php
            if ($fecha_nota==NULL) {
                echo "El paciente todavía no tiene notas";
            }else{
                echo "Diagnostico: ".$diagnostico=$sistema->getBD($sql_ultima_nota_paciente,"descripcion_diagnostico")."<br>";
                echo "Fecha de la nota: ".date('d-m-Y',strtotime($fecha_nota))."<br>";
                echo "Frecuencia Cardiaca: ".$frecuencia_cardiaca=$sistema->getBD($sql_ultima_nota_paciente,"frecuencia_cardiaca")."<br>";
                echo "Frecuencia Respiratoria: ".$frecuencia_respiratoria=$sistema->getBD($sql_ultima_nota_paciente,"frecuencia_respiratoria")."<br>";
                echo "Presion Arterial: ".$presion_arterial=$sistema->getBD($sql_ultima_nota_paciente,"presion_arterial")."<br>";
                echo "Temperatura: ".$temperatura=$sistema->getBD($sql_ultima_nota_paciente,"temperatura")."<br>";
                echo "Peso: ".$peso=$sistema->getBD($sql_ultima_nota_paciente,"peso")."<br>";
                echo "Talla: ".$talla=$sistema->getBD($sql_ultima_nota_paciente,"talla")."<br>";
                echo "Indice Masa Corporal: ".$indice_masa_corporal=$sistema->getBD($sql_ultima_nota_paciente,"indice_masa_corporal")."<br>";
                echo "DxTx: ".$DxTx=$sistema->getBD($sql_ultima_nota_paciente,"DxTx")."<br>";
                echo "Texto de la nota: ".$texto_nota=$sistema->getBD($sql_ultima_nota_paciente,"texto_nota")."<br>";
                $ultima_nota_id=$sistema->getBD($sql_ultima_nota_paciente,"nota_id");
                /*QUERY PARA SABER SI LA NOTA TIENE IMÁGENES*/
                $sql_nota_imagen="SELECT imagen_id,bandera FROM nota n INNER JOIN imagen i ON n.nota_id=i.nota_id 
                                  WHERE paciente_id=$paciente_id AND n.nota_id=$ultima_nota_id;";
                $imagen_id=$sistema->getBD($sql_nota_imagen,"imagen_id");
                $bandera=$sistema->getBD($sql_nota_imagen,"bandera");
                if ($bandera==1) {
                    require_once("../Imagen/conexion.php");
                    $conect = new Conexion();
                    $listaImagen = $conect->listarImagen($imagen_id);
                    foreach ($listaImagen as $r) {
                        echo  "<h1>Imágenes de la nota<h1><br><center>".
                              "<img src='data:image/jpg;base64,".base64_encode($r['imagen_1'])."' alt='...' width='1210' height='450'/><br>".
                             "<img src='data:image/jpg;base64,".base64_encode($r['imagen_2'])."' alt='...' width='1210' height='450'/><br>".
                             "<img src='data:image/jpg;base64,".base64_encode($r['imagen_3'])."' alt='...' width='1210' height='450'/><br>".
                             "<img src='data:image/jpg;base64,".base64_encode($r['imagen_4'])."' alt='...' width='1210' height='450'/><br>".
                             "<img src='data:image/jpg;base64,".base64_encode($r['imagen_5'])."' alt='...' width='1210' height='450'/><br></center>";
                    }
                }else{
                    echo "Esta nota no cuenta con imágenes";
                }
            }
        ?>
    </section>   
</body>
</html>