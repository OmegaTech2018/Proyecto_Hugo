<?php
	require_once("sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
	$nota_id=$_GET['nota_id'];
	$fecha=$_GET['fecha'];
	$opcion_nota=$_GET['opcion_nota'];
	if(!isset($sistema)){
        require_once("coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
    //echo $usuario." ".$nombre_pasante."<br>";
    $sql_lista_notas="SELECT frecuencia_cardiaca,frecuencia_respiratoria,presion_arterial,temperatura,peso,talla,
                                       indice_masa_corporal,DxTx,texto_nota,laboratorio_id,gabinete_id,imagen_id,
                                       CONCAT(p.apellido_paterno,' ',p.apellido_materno,' ',p.nombre) AS Nombre_paciente 
                                       FROM consulta c INNER JOIN nota n ON c.nota_id=n.nota_id INNER JOIN paciente p ON c.paciente_id=p.paciente_id
                                       WHERE pasante_id='$usuario' AND p.paciente_id=$paciente_id AND n.nota_id=$nota_id AND n.nota_activa=1;";
    $Nombre_paciente=$sistema->getBD($sql_lista_notas,"Nombre_paciente");
    //echo $nota_id." ".$paciente_id." ".$fecha."<br>";
    $frecuencia_cardiaca=$sistema->getBD($sql_lista_notas,"frecuencia_cardiaca");
    $frecuencia_respiratoria=$sistema->getBD($sql_lista_notas,"frecuencia_respiratoria");
    $presion_arterial=$sistema->getBD($sql_lista_notas,"presion_arterial");
    $temperatura=$sistema->getBD($sql_lista_notas,"temperatura");
    $peso=$sistema->getBD($sql_lista_notas,"peso");
    $talla=$sistema->getBD($sql_lista_notas,"talla");
    $indice_masa_corporal=$sistema->getBD($sql_lista_notas,"indice_masa_corporal");
    $DxTx=$sistema->getBD($sql_lista_notas,"DxTx");
    $texto_nota=$sistema->getBD($sql_lista_notas,"texto_nota");
    $mensaje_lab;
    $mensaje_gab;
    $mensaje_imag;
    $laboratorio_id=$sistema->getBD($sql_lista_notas,"laboratorio_id");
    if ($laboratorio_id=="") {
        $mensaje_lab="No aplica";
    }
    $gabinete_id=$sistema->getBD($sql_lista_notas,"gabinete_id");
    if ($gabinete_id=="") {
        $mensaje_gab="No aplica";
    }
    $imagen_id=$sistema->getBD($sql_lista_notas,"imagen_id");
    if ($imagen_id=="") {
        $mensaje_imag="No aplica";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nota Seleccionada</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
		<header>
				<h1>Bienvenido <?php echo $nombre_pasante; ?></h1><br>
				<h2>
					Número de registro de nota: <?php  echo $nota_id; ?><br>
					Fecha de la nota: <?php echo $fecha; ?><br>
					Nombre del paciente: <?php echo $Nombre_paciente; ?>
				</h2>
			</header>
			<hr>
			<h2>Datos de la nota</h2>
			<?php
                if ($opcion_nota==1) {
                    echo "frecuencia cardiaca: ".$frecuencia_cardiaca."<br>";
                    echo "frecuencia respiratoria: ".$frecuencia_respiratoria."<br>";
                    echo "presion arterial: ".$presion_arterial."<br>";
                    echo "temperatura: ".$temperatura."<br>";
                    echo "peso: ".$peso."<br>";
                    echo "talla: ".$talla."<br>";
                    echo "indice masa corporal: ".$indice_masa_corporal."<br>";
                    echo "DxTx: ".$DxTx."<br>";
                    echo "Texto de la nota: ".$texto_nota."<br>";
                    echo "Laboratorio: ".$mensaje_lab."<br>";
                    echo "Gabinete: ".$mensaje_gab."<br>";
                    echo "Imagen: ".$mensaje_imag."<br>";
                }
            	if ($opcion_nota==2) {
			?>
					<form action="eliminar_nota.php" method="Post" target="eliminar_nota">
					<input type="hidden" name="nota_id" id="nota_id" value="<?php echo $nota_id; ?>">
                        <?php
                            echo "frecuencia cardiaca: ".$frecuencia_cardiaca."<br>";
                            echo "frecuencia respiratoria: ".$frecuencia_respiratoria."<br>";
                            echo "presion arterial: ".$presion_arterial."<br>";
                            echo "temperatura: ".$temperatura."<br>";
                            echo "peso: ".$peso."<br>";
                            echo "talla: ".$talla."<br>";
                            echo "indice masa corporal: ".$indice_masa_corporal."<br>";
                            echo "DxTx: ".$DxTx."<br>";
                            echo "Texto de la nota: ".$texto_nota."<br>";
                            echo "Laboratorio: ".$mensaje_lab."<br>";
                            echo "Gabinete: ".$mensaje_gab."<br>";
                            echo "Imagen: ".$mensaje_imag."<br>";
                        ?>
						<br><br>
						<input type="submit" value="Eliminar Nota">
					</form>
					<iframe name="eliminar_nota" id="eliminar_nota" src="vacia.html" width="100%" height="200" frameborder="0"></iframe>
			<?php
				}
                if ($opcion_nota==3) {
                    echo "
                    <form action=\"guardar_nota.php\" method=\"post\" target=\"guarda_nota\">
                        frecuencia cardiaca: <input type=\"text\" id=\"fc\" name=\"fc\" required=\"required\" value=\"$frecuencia_cardiaca\"><br>
                        frecuencia respiratoria: <input type=\"text\" id=\"fr\" name=\"fr\" required=\"required\" value=\"$frecuencia_respiratoria\"><br>
                        presion arterial: <input type=\"text\" id=\"pa\" name=\"pa\" required=\"required\" value=\"$presion_arterial\"><br>
                        temperatura: <input type=\"text\" id=\"temp\" name=\"temp\" required=\"required\" value=\"$temperatura\"><br>
                        peso: <input type=\"text\" id=\"pe\" name=\"pe\" required=\"required\" value=\"$peso\"><br>
                        talla: <input type=\"text\" id=\"talla\" name=\"talla\" required=\"required\" value=\"$talla\"><br>
                        indice masa corporal: <input type=\"text\" id=\"imc\" name=\"imc\" required=\"required\" value=\"$indice_masa_corporal\"><br>
                        DxTx: <input type=\"text\" id=\"dxtx\" name=\"dxtx\" required=\"required\" value=\"$DxTx\"><br>
                        Texto de la nota: $texto_nota<br> 
                          <textarea rows=\"20\" cols=\"150\" id=\"texto_nota\" name=\"texto_nota\" required=\"required\" value=\"$texto_nota\"></textarea><br>
                        Laboratorio: ".$mensaje_lab."<br>
                        Gabinete: ".$mensaje_gab."<br>
                        Imagen: ".$mensaje_imag."<br>
                        <br>
                        <input type=\"submit\" value=\"Guardar nota\">
                    </form>
                    <iframe name=\"guarda_nota\" id=\"guarda_nota\" src=\"vacia.html\" width=\"100%\" height=\"200\" frameborder=\"0\"></iframe>";
                }
			?>
	</section>
</body>
</html>