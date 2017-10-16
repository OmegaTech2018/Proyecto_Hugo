<?php
	require_once("../sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
    $Nombre_paciente=$_GET['Nombre_paciente'];
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
	<title>Ver Gabinete</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
    <section id="contenedor">
        <header>
            <h1>Bienvenido <?php echo $nombre_pasante; ?></h1>
        </header>
        <?php
            switch ($gabinete) {
                /*ELECTROCARDIOGRAMAS*/
                case 1:
                    echo "<h2>Electrocardiograma del paciente: ".$Nombre_paciente."</h2>";
                    $electro_id=$_GET['electro_id'];
                    require_once("conexion.php");
                    $conect = new Conexion();
                    $listaElectro = $conect->listarElectro($electro_id);
                    foreach ($listaElectro as $r) {
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['gelectro1'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['gelectro2'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['gelectro3'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['gelectro4'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['gelectro5'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['gelectro6'])."' alt='...' width='50' height='50'/><br>";
                    }
                break;
                /*PAPANICOLAOU*/
                case 2:
                    echo "<h2>Papanicolaou del paciente: ".$Nombre_paciente."</h2>";
                    $papanicolaou_id=$_GET['papanicolaou_id'];
                    $sql_papanicolaou=sprintf("SELECT papanicolaou_descripcion FROM gabinete_papanicolaou 
                                               WHERE gabinete_papanicolaou_id=$papanicolaou_id;");
                    echo "Descripci&oacute;n del Papanicolaou:<br><br>".$descripcion=$sistema->getBD($sql_papanicolaou,"papanicolaou_descripcion")."<br>";
                break;
                /*ULTRASONIDOS*/
                case 3:
                    echo "<h2>Ultrasonido del paciente: ".$Nombre_paciente."</h2>";
                    $ultrasonidos_id=$_GET['ultrasonidos_id'];
                    $sql_ultrasonido=sprintf("SELECT ultrasonido_descripcion FROM gabinete_ultrasonidos 
                                              WHERE gabinete_ultrasonidos_id=$ultrasonidos_id;");
                    echo "Descripci&oacute;n del Ultrasonido:<br><br>".$descripcion=$sistema->getBD($sql_ultrasonido,"ultrasonido_descripcion")."<br>";
                break;
                /*RAYOS X*/
                case 4:
                    echo "<h2>Rayos X del paciente: ".$Nombre_paciente."</h2>";
                    $rayosx_id=$_GET['rayosx_id'];
                    require_once("conexion.php");
                    $conect = new Conexion();
                    $listaRayosx = $conect->listarRayosX($rayosx_id);
                    foreach ($listaRayosx as $r) {
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_1'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_2'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_3'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_4'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_5'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_6'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_7'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_8'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_9'])."' alt='...' width='50' height='50'/><br>";
                        echo "<img src='data:image/jpg;base64,".base64_encode($r['rayosxi_10'])."' alt='...' width='50' height='50'/><br>";
                    }
                break;
            }
        ?>
    </section>   
</body>
</html>