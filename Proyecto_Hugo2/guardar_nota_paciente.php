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
        $usuario=$sistema->recuperaPOST("usuario","Por favor inice sesión");
        //$nombre_pasante=$_SESSION["nombre_pasante"];
        /*DATOS PERSONALES DEL PACIENTE*/
        $fecha=date("Y-m-d");
        $ap_paterno=$sistema->recuperaPOST("ap_paterno","Apellido paterno es requerido");
        $ap_materno=$sistema->recuperaPOST("ap_materno","Apellido materno es requerido");
        $nombre=$sistema->recuperaPOST("nombre","Nombre es requerido");
        $edad=$sistema->recuperaPOST("edad","La edad del paciente es requerida");
        $domicilio=$sistema->recuperaPOST("domicilio","El domicilio es requerido");
        $embarazo=$sistema->recuperaPOST("embarazo","Es necesario saber si el paciente esta embarazada ");
        $recien_nacido=$sistema->recuperaPOST("recien_nacido","Es necesario saber si el paciente es recien nacido");
        $telefono=$_POST["telefono"];
        /***********************************************************************************************************/
        /*SIGNOS VITALES*/
        $fc=$sistema->recuperaPOST("fc","La frecuecnia cardiaca es requerida");
        $fr=$sistema->recuperaPOST("fr","La frecuencia respiratoria es requerida");
        $pa=$sistema->recuperaPOST("pa","La presión arterial es requerida");
        $temp=$sistema->recuperaPOST("temp","La temperatura es requerida");
        $pe=$sistema->recuperaPOST("pe","El peso es requerid");
        $talla=$sistema->recuperaPOST("talla","La talla es requerida");
        $imc=$sistema->recuperaPOST("imc","El indice de masa corporal es requerido");
        $dxtx=$_POST['dxtx'];
        $texto_nota=$sistema->recuperaPOST("texto_nota","Los comentarios de la nota son requeridos");
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
        /*echo $fecha.",".$ap_paterno.",".$ap_materno.",".$nombre.",".$edad.",".$domicilio.",".$embarazo.",".$recien_nacido.",".$telefono.",".$fc.",".$fr.",".$pa.",".$temp.",".$pe.",".$talla.",".$imc.",".$dxtx."<br>Texto nota".$texto_nota."<br>";
        echo "Laboratorios<br>";
        echo "BH<br>".$Eritrocitos_bh.",".$Hemoglobina.",".$Hematocrito.",".$Leucocitos_bh.",".$Neutrofilos.",".$Eosinofilos."<br>";
        echo "QS<br>".$Glucosa_QS.",".$Urea.",".$Creatinina.",".$Colesterol.",".$Trigliceridos.",".$B_total.",".$B_directa.",".$B_indirecta.",".$TGO.",".$TGP.",".$Amilasa.",".$Lipasa."<br>";
        echo "EGO<br>".$Densidad.",".$Celulas_Epiteliales.",".$Cristales.",".$Leucocitos_EGO.",".$Eritrocitos_EGO.",".$Glucosa_EGO.",".$Bacterias."<br>";
        echo "Cultivos<br>".$lab_cultivos."<br>";
        echo "GABINETE<br>";
        echo "Papanicolaou<br>".$papanicolaou."<br>";
        echo "Ultrasonidos<br>".$ultrasonidos;*/

        /*GUARDAMOS LOS DATOS DEL PACIENTE*/
        $sql_guarda_paciente=sprintf("INSERT INTO paciente (apellido_paterno,apellido_materno,nombre,edad_paciente,embarazo,recien_nacido,domicilio,telefono,paciente_activo)
                                      VALUES('$ap_paterno','$ap_materno','$nombre',$edad,'$embarazo','$recien_nacido','$domicilio','$telefono',1);");
        if ($sistema->enlaceBD->query($sql_guarda_paciente)) {
            echo "<center><strong>Datos del paciente guardados con éxito.</strong></center>";
            $sql_paciente_id=sprintf("SELECT MAX(paciente_id) AS paciente_id_maximo FROM paciente;");
            $max_paciente_id=$sistema->getBD($sql_paciente_id,"paciente_id_maximo");
            //echo $max_paciente_id."<br>";
        }else{
            if (substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")) {
                echo "<center><strong>El paciente ya se ha guardado.</strong></center>";
            }else{
                echo "<center><strong>Error al guardar<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
            }
        }

        /*GUARDAMOS LA NOTA DEL PACIENTE*/
        $sql_guarda_nota=sprintf("INSERT INTO nota (fecha_hora_nota,frecuencia_cardiaca,frecuencia_respiratoria,presion_arterial,temperatura,peso,talla,indice_masa_corporal,DxTx,texto_nota,nota_activa)
                                  VALUES('$fecha','$fc','$fr','$pa',$temp,$pe,$talla,$imc,$dxtx,'$texto_nota',1);");
        if ($sistema->enlaceBD->query($sql_guarda_nota)) {
            echo "<center><strong>Datos de la nota guardados con éxito.</strong></center>";
            $sql_nota_id=sprintf("SELECT MAX(nota_id) AS nota_id_maximo FROM nota;");
            $max_nota_id=$sistema->getBD($sql_nota_id,"nota_id_maximo");
            //echo $max_nota_id."<br>";
            /*GUARDAMOS LA CONSULTA*/
            $sql_guarda_consulta=sprintf("INSERT INTO consulta (pasante_id,paciente_id,nota_id) VALUES('$usuario',$max_paciente_id,$max_nota_id);");
            if ($sistema->enlaceBD->query($sql_guarda_consulta)) {
                echo "<center><strong>Consulta guardada con éxito</strong></center>";
            }
        }else{
            if (substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")) {
                echo "<center><strong>La nota ya se ha guardado.</strong></center>";
            }else{
                echo "<center><strong>Error al guardar<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
            }
        }
        $sistema->desconectar();
    ?>
    <center>
           <form action="bienvenido.php" method="post" name="regresar" target="_top">
               <input  style="font-size:24px" type="submit" value="Cerrar expediente" /><br />
               <input type="hidden" name="numcta" id="numcta" value="<?php //echo $numcta;?>" >
           </form>
	       <form action="agendar_cita.php" method="post" name="agendar_cita" target="_top">
               <input  style="font-size:24px" type="submit" value="Agendar Cita" /><br />
               <input type="hidden" name="numcta" id="numcta" value="<?php //echo $numcta;?>" >
           </form>
    </center>
</body>
</html>