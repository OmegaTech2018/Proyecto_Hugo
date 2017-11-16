<!DOCTYPE html>
<html>
<head>
	<title>Guarda Gabinete</title>
</head>
<body>
	<?php
		require_once("../../coneccion.php");
		$sistema = new sistema();
        $sistema->conectar();
        $usuario=$sistema->recuperaPOST("usuario","Por favor inice sesión");

        $form_gabinete=$_POST['form_gabinete'];

        switch ($form_gabinete) {
            /*ELECTROCARDIOGRAMAS*/
        	case 1:
                $sql_electro_id=sprintf("SELECT gabinete_electrocardiogramas_id FROM gabinete_electrocardiogramas 
                                     WHERE nota_id=(SELECT MAX(nota_id) FROM nota WHERE email='$usuario');");
                $sistema->enlaceBD->query($sql_electro_id);
                $electro_id=$sistema->getBD($sql_electro_id,"gabinete_electrocardiogramas_id");
                //echo $electro_id;
                require_once("GabineteElectro.php");
        		require_once("conexion.php");
                $gabinete = new GabineteElectro($_FILES["gelectro1"]["tmp_name"], $_FILES["gelectro2"]["tmp_name"], 
                                                $_FILES["gelectro3"]["tmp_name"], $_FILES["gelectro4"]["tmp_name"],
                                                $_FILES["gelectro5"]["tmp_name"]
                                                );
                $conect = new Conexion();
                $conect->insertaGabinete($gabinete,$electro_id);
                echo "<center><strong>Datos del electrocardiograma guardados con éxito.</strong></center>";
                die(); 
        	break;
        	/*PAPANICOLAOU*/
        	case 2:
                $papanicolaou=$sistema->recuperaPOST("papanicolaou","Dato del papanicolaou es requerido");
                $sql_papanicolaou_id=sprintf("SELECT gabinete_papanicolaou_id FROM gabinete_papanicolaou 
                                              WHERE nota_id=(SELECT MAX(nota_id) FROM nota WHERE email='$usuario');");
                $sistema->enlaceBD->query($sql_papanicolaou_id);
                $papanicolaou_id=$sistema->getBD($sql_papanicolaou_id,"gabinete_papanicolaou_id");
        		/*INSERTAMOS LOS DATOS EN EL GABINETE DEL PAPANICOLAOU*/
        		$sql_guarda_gabinete_papanicolaou=sprintf("UPDATE gabinete_papanicolaou SET papanicolaou_descripcion='$papanicolaou',bandera=1 
                                                           WHERE gabinete_papanicolaou_id=$papanicolaou_id;");
        		if ($sistema->enlaceBD->query($sql_guarda_gabinete_papanicolaou)) {
                	echo "<center><strong>Datos del papanicolaou guardados con éxito.</strong></center>";
                }else{
                	if (substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")) {
                        echo "<center><strong>El papanicolaou ya se ha guardado.</strong></center>";
                	}else{
                        echo "<center><strong>Error al guardar los datos del papanicolaou<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
                    }
                }
                $sistema->desconectar();
        	break;
            /*ULTRASONIDOS*/
        	case 3:
                $ultrasonidos=$sistema->recuperaPOST("ultrasonidos","Dato del ultrasonido es requerido");
                $sql_ultrasonido_id=sprintf("SELECT gabinete_ultrasonidos_id FROM gabinete_ultrasonidos 
                                              WHERE nota_id=(SELECT MAX(nota_id) FROM nota WHERE email='$usuario');");
                $sistema->enlaceBD->query($sql_ultrasonido_id);
                $ultrasonido_id=$sistema->getBD($sql_ultrasonido_id,"gabinete_ultrasonidos_id");
        		/*INSERTAMOS LOS DATOS EN EL GABINETE DEL ULTRASONIDO*/
        		$sql_guarda_gabinete_ultrasonidos=sprintf("UPDATE gabinete_ultrasonidos SET ultrasonido_descripcion='$ultrasonidos',bandera=1
                                                           WHERE gabinete_ultrasonidos_id=$ultrasonido_id;");
        		if ($sistema->enlaceBD->query($sql_guarda_gabinete_ultrasonidos)) {
                	echo "<center><strong>Datos del ultrasonido guardados con éxito.</strong></center>";
                }else{
                	if (substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")) {
                        echo "<center><strong>El ultrasonido ya se ha guardado.</strong></center>";
                	}else{
                        echo "<center><strong>Error al guardar los datos del ultrasonido<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
                    }
                }
                $sistema->desconectar();
        	break;
            /*RAYOS X*/
            case 4:
                $sql_rayosx_id=sprintf("SELECT gabinete_rayosx_id FROM gabinete_rayosx 
                                         WHERE nota_id=(SELECT MAX(nota_id) FROM nota WHERE email='$usuario');");
                $sistema->enlaceBD->query($sql_rayosx_id);
                $rayosx_id=$sistema->getBD($sql_rayosx_id,"gabinete_rayosx_id");
                require_once("GabineteRayosX.php");
                require_once("conexion.php");
                $rayosx = new GabineteRayosX($_FILES["rayosxi_1"]["tmp_name"], $_FILES["rayosxi_2"]["tmp_name"], 
                                             $_FILES["rayosxi_3"]["tmp_name"], $_FILES["rayosxi_4"]["tmp_name"],
                                             $_FILES["rayosxi_5"]["tmp_name"]
                                             );
                $conect = new Conexion();
                $conect->insertaRayosX($rayosx,$rayosx_id);
                echo "<center><strong>Datos de los Rayos X guardados con éxito.</strong></center>";
                die();    
            break;
        }
	?>
</body>
</html>