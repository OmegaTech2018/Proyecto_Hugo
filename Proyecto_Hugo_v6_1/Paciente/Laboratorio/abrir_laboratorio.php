<?php
	require_once("../../sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	$paciente_id=$_GET['paciente_id'];
    $Nombre_paciente=$_GET['Nombre_paciente'];
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
	<title>Ver Laboratorio</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
    <section id="contenedor">
        <header>
            <h1>Bienvenido <?php echo $nombre_pasante; ?></h1>
        </header>
        <?php
            switch ($laboratorio) {
             
                /*BH*/
                case 1:
                    echo "<h2>BH del paciente: ".$Nombre_paciente."</h2>";
                    $bh_id=$_GET['bh_id'];
                    
                    $sql_bh=sprintf("SELECT eritrocitos, hemoglobina, hematocrito, plaquetas, leucocitos, volumen_corpuscular_medio, neutrofilos, eosinofilos FROM laboratorio_bh 
                                               WHERE laboratorio_bh_id=$bh_id;");
                    echo "Eritrocitos:<br><br>".$descripcion=$sistema->getBD($sql_bh,"eritrocitos")."<br>";
                    echo "Hemoglobina:<br><br>".$descripcion=$sistema->getBD($sql_bh,"hemoglobina")."<br>";
                    echo "Hematocrito:<br><br>".$descripcion=$sistema->getBD($sql_bh,"hematocrito")."<br>";
                    echo "Plaquetas:<br><br>".$descripcion=$sistema->getBD($sql_bh,"plaquetas")."<br>";
                    echo "Leucocitos:<br><br>".$descripcion=$sistema->getBD($sql_bh,"leucocitos")."<br>";
                    echo "Volumen Corpuscular Medio:<br><br>".$descripcion=$sistema->getBD($sql_bh,"volumen_corpuscular_medio")."<br>";
                    echo "neutrofilos:<br><br>".$descripcion=$sistema->getBD($sql_bh,"neutrofilos")."<br>";
                    echo "Eosinofilos:<br><br>".$descripcion=$sistema->getBD($sql_bh,"eosinofilos")."<br>";
                   
                break;
                /*QS*/
                case 2:
                    echo "<h2>QS del paciente: ".$Nombre_paciente."</h2>";
                    $qs_id=$_GET['qs_id'];
                    $sql_qs=sprintf("SELECT glucosa, urea, creatinina, acido_urico, colesterol, trigliceridos, B_total, B_directa, B_indirecta, TGO, TGP, amilasa, lipasa FROM laboratorio_qs 
                                               WHERE laboratorio_qs_id=$qs_id;");
                    echo "Glucosa:<br><br>".$descripcion=$sistema->getBD($sql_qs,"glucosa")."<br>";
                    echo "Urea:<br><br>".$descripcion=$sistema->getBD($sql_qs,"urea")."<br>";
                    echo "Creatinina:<br><br>".$descripcion=$sistema->getBD($sql_qs,"creatinina")."<br>";
                    echo "Acido Urico:<br><br>".$descripcion=$sistema->getBD($sql_qs,"acido_urico")."<br>";
                    echo "Colesterol:<br><br>".$descripcion=$sistema->getBD($sql_qs,"colesterol")."<br>";
                    echo "Trigliceridos:<br><br>".$descripcion=$sistema->getBD($sql_qs,"trigliceridos")."<br>";
                    echo "B total:<br><br>".$descripcion=$sistema->getBD($sql_qs,"B_total")."<br>";
                    echo "B directa:<br><br>".$descripcion=$sistema->getBD($sql_qs,"B_directa")."<br>";
                    echo "B indirecta:<br><br>".$descripcion=$sistema->getBD($sql_qs,"B_indirecta")."<br>";
                    echo "TGO:<br><br>".$descripcion=$sistema->getBD($sql_qs,"TGO")."<br>";
                    echo "TGP:<br><br>".$descripcion=$sistema->getBD($sql_qs,"TGP")."<br>";
                    echo "Amilasa:<br><br>".$descripcion=$sistema->getBD($sql_qs,"amilasa")."<br>";
                    echo "Lipasa:<br><br>".$descripcion=$sistema->getBD($sql_qs,"lipasa")."<br>";
                   
                break;
                /*EGO*/
                case 3:
                    echo "<h2>EGO del paciente: ".$Nombre_paciente."<br> Diagnostico: ".$descripcion_diagnostico."</h2>";
                    $ego_id=$_GET['ego_id'];
                    $sql_ego=sprintf("SELECT densidad, PH, celulas_epiteliales, cristales, leucocitos, eritrocitos, glucosa, bacterias FROM laboratorio_ego
                                               WHERE laboratorio_ego_id=$ego_id;");
                    echo "Densidad:<br><br>".$descripcion=$sistema->getBD($sql_ego,"densidad")."<br>";
                    echo "PH:<br><br>".$descripcion=$sistema->getBD($sql_ego,"PH")."<br>";
                    echo "Celulas Epiteliales:<br><br>".$descripcion=$sistema->getBD($sql_ego,"celulas_epiteliales")."<br>";
                    echo "Cristales:<br><br>".$descripcion=$sistema->getBD($sql_ego,"cristales")."<br>";
                    echo "Leucocitos:<br><br>".$descripcion=$sistema->getBD($sql_ego,"leucocitos")."<br>";
                    echo "Eritrocitos:<br><br>".$descripcion=$sistema->getBD($sql_ego,"eritrocitos")."<br>";
                    echo "Glucosa:<br><br>".$descripcion=$sistema->getBD($sql_ego,"glucosa")."<br>";
                    echo "Bacterias:<br><br>".$descripcion=$sistema->getBD($sql_ego,"bacterias")."<br>";
                   
                break;
                /*Cultivos*/

                case 4:
                    echo "<h2>Cultivos del paciente: ".$Nombre_paciente."<br> Diagnostico: ".$descripcion_diagnostico."</h2>";
                    $cultivos_id=$_GET['cultivos_id'];
                    $sql_cultivos=sprintf("SELECT texto_cultivo FROM laboratorio_cultivos
                                               WHERE laboratorio_cultivos_id=$cultivos_id;");
                    echo "Cultivos:<br><br>".$descripcion=$sistema->getBD($sql_ego,"texto_cultivo")."<br>";
                   
                   
                break;
                
            }
        ?>
    </section>   
</body>
</html>