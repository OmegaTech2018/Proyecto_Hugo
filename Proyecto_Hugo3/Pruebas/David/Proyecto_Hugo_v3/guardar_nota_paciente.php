<!DOCTYPE html>
<html lang="es">
<head>
	<title>Guarda Nota Paciente</title>
</head>
<body>
    <?php
        require_once("coneccion.php");

        $sistema = new sistema();
        $sistema->conectar();
        /*DATOS PERSONALES DEL PACIENTE*/
        $ap_paterno=$sistema->recuperaPOST("ap_paterno","Apellido paterno es requerido");
        $ap_materno=$sistema->recuperaPOST("ap_materno","Apellido materno es requerido");
        $nombre=$sistema->recuperaPOST("nombre","Nombre es requerido");
        $edad=$sistema->recuperaPOST("edad","La edad del paciente es requerida");
        $domicilio=$sistema->recuperaPOST("domicilio","El domicilio es requerido");
        $embarazo=$sistema->recuperaPOST("embarazo","Es necesario saber si el paciente esta embarazada ");
        $recien_nacido=$sistema->recuperaPOST("recien_nacido","Es necesario saber si el paciente es recien nacido");
        /***********************************************************************************************************/
        /*SIGNOS VITALES*/
        $fc=$sistema->recuperaPOST("fc","La frecuecnia cardiaca es requerida");
        $fr=$sistema->recuperaPOST("fr","La frecuencia respiratoria es requerida");
        $pa=$sistema->recuperaPOST("pa","La presión arterial es requerida");
        $temp=$sistema->recuperaPOST("temp","La temperatura es requerida");
        $pe=$sistema->recuperaPOST("pe","El peso es requerid");
        $talla=$sistema->recuperaPOST("talla","La talla es requerida");
        $imc=$sistema->recuperaPOST("imc","El indice de masa corporal es requerido");
        $dxtx=$sistema->recuperaPOST("dxtx","El DxTx es requerida");
        $comentarios_nota=$sistema->recuperaPOST("comentarios_nota","Los comentarios de la nota son requeridos");
        /****************************************************************************/
        /*LABORATORIOS*/
        /*BH*/
        $Eritrocitos_bh=$_POST["Eritrocitos_bh"];
        $Hemoglobina=$_POST["Hemoglobina"];
        $Hematocrito=$_POST["Hematocrito"];
        $Leucocitos_bh=$_POST["Leucocitos_bh"];
        $Neutrofilos=$_POST["Neutrofilos"];
        $Eosinofilos=$_POST["Eosinofilos"];
        /*******************************************/
        /*QS*/
        $Glucosa_QS=$_POST["Glucosa_QS"];
        $Urea=$_POST["Urea"];
        $Creatinina=$_POST["Creatinina"];
        $Colesterol=$_POST["Colesterol"];
        $Trigliceridos=$_POST["Trigliceridos"];
        $B_total=$_POST["B_total"];
        $B_directa=$_POST["B_directa"];
        $B_indirecta=$_POST["B_indirecta"];
        $TGO=$_POST["TGO"];
        $TGP=$_POST["TGP"];
        $Amilasa=$_POST["Amilasa"];
        $Lipasa=$_POST["Lipasa"];
        /******************************************/
        /*EGO*/
        $Densidad=$_POST["Densidad"];
        $Celulas_Epiteliales=$_POST["Celulas_Epiteliales"];
        $Cristales=$_POST["Cristales"];
        $Leucocitos_EGO=$_POST["Leucocitos_EGO"];
        $Eritrocitos_EGO=$_POST["Eritrocitos_EGO"];
        $Glucosa_EGO=$_POST["Glucosa_EGO"];
        $Bacterias=$_POST["Bacterias"];
        /******************************************/
        /*CULTIVOS*/
        $lab_cultivos=$_POST["lab_cultivos"];
        /*TERMINAN LABORATORIOS*/
        /******************************************/
        /*GABINETE*/
        /*Papanicolaou*/
        $papanicolaou=$_POST["papanicolaou"];
        /*Ultrasonidos*/
        $ultrasonidos=$_POST["ultrasonidos"];
        /******************************************/
        echo $ap_paterno.",".$ap_materno.",".$nombre.",".$edad.",".$domicilio.",".$embarazo.",".$recien_nacido.",".$fc.",".$fr.",".$pa.",".$temp.",".$pe.",".$temp.",".$pe.",".$talla.",".$imc.",".$dxtx."<br>comentarios de la nota".$comentarios_nota."<br>";
        echo "Laboratorios<br>";
        echo "BH<br>".$Eritrocitos_bh.",".$Hemoglobina.",".$Hematocrito.",".$Leucocitos_bh.",".$Neutrofilos.",".$Eosinofilos."<br>";
        echo "QS<br>".$Glucosa_QS.",".$Urea.",".$Creatinina.",".$Colesterol.",".$Trigliceridos.",".$B_total.",".$B_directa.",".$B_indirecta.",".$TGO.",".$TGP.",".$Amilasa.",".$Lipasa."<br>";
        echo "EGO<br>".$Densidad.",".$Celulas_Epiteliales.",".$Cristales.",".$Leucocitos_EGO.",".$Eritrocitos_EGO.",".$Glucosa_EGO.",".$Bacterias."<br>";
        echo "Cultivos<br>".$lab_cultivos."<br>";
        echo "GABINETE<br>";
        echo "Papanicolaou<br>".$papanicolaou."<br>";
        echo "Ultrasonidos<br>".$ultrasonidos;
        
    ?><!--
	<h1>Los datos se han guardado con exito</h1>
        <center>
            <form action="bienvenido.php" method="post" name="regresar" target="_top">
                <input  style="font-size:24px" type="submit" value="Cerrar expediente" /><br />
                <input type="hidden" name="numcta" id="numcta" value="<?php //echo $numcta;?>" >
            </form>
			<form action="agendar_cita.php" method="post" name="agendar_cita" target="_top">
                <input  style="font-size:24px" type="submit" value="Agendar Cita" /><br />
                <input type="hidden" name="numcta" id="numcta" value="<?php //echo $numcta;?>" >
            </form>
        </center>-->
</body>
</html>