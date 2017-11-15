<!DOCTYPE html>
<html>
<head>
	<title>Guardar Nota Paciente</title>
</head>
<body>
	<?php
		require_once("../coneccion.php");

		    $sistema = new sistema();
        $sistema->conectar();
        $usuario=$sistema->recuperaPOST("usuario","Por favor inice sesión");
        $nombre_pasante=$sistema->recuperaPOST("nombre_pasante","Por favor inice sesión");
        //echo $usuario." ".$opcion_nota;
        $fecha=date("Y-m-d");
        $formulario=$_POST['formulario'];

        switch ($formulario) {
        	case 1:
        		    $ap_paterno=$sistema->recuperaPOST("ap_paterno","Apellido paterno es requerido");
                $ap_materno=$sistema->recuperaPOST("ap_materno","Apellido materno es requerido");
                $nombre=$sistema->recuperaPOST("nombre","Nombre es requerido");
                $edad=$sistema->recuperaPOST("edad","La edad del paciente es requerida");
                $telefono=$_POST["telefono"];
                $sexo=$sistema->recuperaPOST("sexo","El sexo de paciente es necesario");
                if ($sexo=="M") {
                  $embarazo="No";
                }else{$embarazo=$sistema->recuperaPOST("embarazo","Es necesario saber si la paciente esta embarazada");}
                $opcion_nota=$sistema->recuperaPOST("opcion_nota","Error, inicie de nuevo sesión");

                /*SE AGREGA UNA NUEVA NOTA DE UN PACIENTE NUEVO*/
                if ($opcion_nota==4) {
                	$recien_nacido=$sistema->recuperaPOST("recien_nacido","Es necesario saber si el paciente es recien nacido");
                  $cita_embarazo=$_POST["cita_embarazo"];
                	/*GUARDAMOS LOS DATOS DEL PACIENTE*/
                	$sql_guarda_paciente=sprintf("INSERT INTO paciente (apellido_paterno,apellido_materno,nombre,edad_paciente,embarazo,
                	recien_nacido,telefono,paciente_activo,sexo) VALUES ('$ap_paterno','$ap_materno','$nombre','$edad','$embarazo',
                	'$recien_nacido','$telefono',1,'$sexo');");
                	if ($sistema->enlaceBD->query($sql_guarda_paciente)) {
                    if ($cita_embarazo=="Si" || $recien_nacido=="Si") {
                      $sql_paciente_id=sprintf("SELECT paciente_id FROM paciente WHERE apellido_paterno='$ap_paterno' 
                                                AND apellido_materno='$ap_materno' AND nombre='$nombre' AND paciente_activo=1;");
                      $paciente_id=$sistema->getBD($sql_paciente_id,"paciente_id");
                      $_SESSION["nombre_pasante"]=$nombre_pasante;
                      $_SESSION["usuario"]=$usuario;
                      header("Location:Historia_Clinica/historia_clinica.php?paciente_id=".$paciente_id);
                    }else{
                		/*INSERTO UNA NOTA NUEVA CON EL ID DEL PACIENTE PARA OBTENER EL ID DE LA NOTA*/
                		$sql_guarda_nota=sprintf("INSERT INTO nota (paciente_id,email,fecha_nota,frecuencia_cardiaca,frecuencia_respiratoria,
                                                  presion_arterial,temperatura,peso,talla,indice_masa_corporal,DxTx,texto_nota,diagnostico_id) 
                                                  SELECT paciente_id,'$usuario','$fecha',0,0,0,0,0,0,0,0,0,0 
                                                  FROM paciente WHERE apellido_paterno='$ap_paterno' 
                                                  AND apellido_materno='$ap_materno' AND nombre='$nombre' AND paciente_activo=1;");
                		if ($sistema->enlaceBD->query($sql_guarda_nota)) {
                      /*GUARDAMOS LABORATORIOS*/
                      $sql_bh=sprintf("INSERT INTO laboratorio_BH(nota_id,bandera) SELECT MAX(n.nota_id),0 
                                       FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                       WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                       AND nombre='$nombre' AND paciente_activo=1;");
                      $sistema->enlaceBD->query($sql_bh);
                      $sql_qs=sprintf("INSERT INTO laboratorio_QS(nota_id,bandera) SELECT MAX(n.nota_id),0 
                                       FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                       WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                       AND nombre='$nombre' AND paciente_activo=1;");
                      $sistema->enlaceBD->query($sql_qs);
                      $sql_ego=sprintf("INSERT INTO laboratorio_EGO(nota_id,bandera) SELECT MAX(n.nota_id),0 
                                        FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                        WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                        AND nombre='$nombre' AND paciente_activo=1;");
                      $sistema->enlaceBD->query($sql_ego);
                      $sql_cultivos=sprintf("INSERT INTO laboratorio_Cultivos(texto_cultivo,nota_id,bandera) 
                                             SELECT '0',MAX(n.nota_id),0 
                                             FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                             WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                             AND nombre='$nombre' AND paciente_activo=1;"); 
                      $sistema->enlaceBD->query($sql_cultivos);
                      /*GUARDAMOS GABINETES*/
                      $sql_electro=sprintf("INSERT INTO gabinete_electrocardiogramas (nota_id,bandera) 
                                            SELECT MAX(n.nota_id),0 FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                            WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                            AND nombre='$nombre' AND paciente_activo=1;");
                      $sistema->enlaceBD->query($sql_electro);
                      $sql_papanicolaou=sprintf("INSERT INTO gabinete_papanicolaou (nota_id,bandera,papanicolaou_descripcion)
                                                 SELECT MAX(n.nota_id),0,0 FROM nota n INNER JOIN paciente p ON 
                                                 n.paciente_id=p.paciente_id WHERE apellido_paterno='$ap_paterno' 
                                                 AND apellido_materno='$ap_materno' AND nombre='$nombre' AND 
                                                 paciente_activo=1;");
                      $sistema->enlaceBD->query($sql_papanicolaou);
                      $sql_ultrasonidos=sprintf("INSERT INTO gabinete_ultrasonidos (nota_id,bandera,ultrasonido_descripcion)
                                                 SELECT MAX(n.nota_id),0,0 FROM nota n INNER JOIN paciente p ON 
                                                 n.paciente_id=p.paciente_id WHERE apellido_paterno='$ap_paterno' 
                                                 AND apellido_materno='$ap_materno' AND nombre='$nombre' AND 
                                                 paciente_activo=1;");
                      $sistema->enlaceBD->query($sql_ultrasonidos);
                      $sql_rayosx=sprintf("INSERT INTO gabinete_rayosx (nota_id,bandera) 
                                           SELECT MAX(n.nota_id),0 FROM nota n INNER JOIN paciente p ON 
                                           n.paciente_id=p.paciente_id 
                                           WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                           AND nombre='$nombre' AND paciente_activo=1;") ;
                      $sistema->enlaceBD->query($sql_rayosx);
                      /*GUARDAMOS IMAGEN*/
                      $sql_imagen=sprintf("INSERT INTO imagen (nota_id,bandera) SELECT MAX(n.nota_id),0 
                                           FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id
                                           WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                           AND nombre='$nombre' AND paciente_activo=1;"); 
                      $sistema->enlaceBD->query($sql_imagen);
                      $sql_paciente_id=sprintf("SELECT paciente_id FROM paciente WHERE apellido_paterno='$ap_paterno' 
                                                AND apellido_materno='$ap_materno' AND nombre='$nombre' AND paciente_activo=1;");
                      $paciente_id=$sistema->getBD($sql_paciente_id,"paciente_id");
                      $_SESSION["nombre_pasante"]=$nombre_pasante;
                      $_SESSION["usuario"]=$usuario;
                      header("Location:Nota/cuerpo_nota.php?paciente_id=".$paciente_id);
                		}
                  }
                	}else{
                		if (substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")) {
                            echo "<center><strong>El paciente ya se ha guardado.</strong></center>";
                        }else{
                            echo "<center><strong>Error al guardar los datos del paciente<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
                        }
                	}
                	$sistema->desconectar();
                }
                /*SE ACTUALIZAN LOS DATOS DE UN PACIENTE QUE YA EXISTE*/
                if ($opcion_nota==3) {
                  $paciente_id=$sistema->recuperaPOST("paciente_id","Es necesario el identificador del paciente");
                  $recien_nacido="No";
                  $cita_embarazo=$_POST["cita_embarazo"];
                  $Nombre_paciente=$_POST["nombre_paciente"];
                  $sql_actualiza_domicilio=sprintf("UPDATE paciente SET telefono='$telefono',edad_paciente=$edad,
                    embarazo='$embarazo' WHERE paciente_id=$paciente_id;");
                  if ($sistema->enlaceBD->query($sql_actualiza_domicilio)) {
                    if ($cita_embarazo=="Si") {
                      $_SESSION["nombre_pasante"]=$nombre_pasante;
                      $_SESSION["usuario"]=$usuario;
                      //echo $cita_embarazo;
                      header("Location:Historia_Clinica/modificar_historia_clinica.php?paciente_id=".$paciente_id."&nombre_paciente=".$Nombre_paciente);
                    }else{
                      //echo $cita_embarazo;
                      /*INSERTO UNA NOTA NUEVA CON EL ID DEL PACIENTE PARA OBTENER EL ID DE LA NOTA*/
                      $sql_guarda_nota=sprintf("INSERT INTO nota (paciente_id,email,fecha_nota,frecuencia_cardiaca,frecuencia_respiratoria,
                                                  presion_arterial,temperatura,peso,talla,indice_masa_corporal,DxTx,texto_nota,diagnostico_id) 
                                                  VALUES ($paciente_id,'$usuario','$fecha',0,0,0,0,0,0,0,0,0,0);");
                      if($sistema->enlaceBD->query($sql_guarda_nota)){
                        /*GUARDA LABORATOIOS*/
                        $sql_bh=sprintf("INSERT INTO laboratorio_BH(nota_id,bandera) SELECT MAX(n.nota_id),0 
                                         FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                         WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                         AND nombre='$nombre' AND paciente_activo=1;");
                        $sistema->enlaceBD->query($sql_bh);
                        $sql_qs=sprintf("INSERT INTO laboratorio_QS(nota_id,bandera) SELECT MAX(n.nota_id),0 
                                         FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                         WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                         AND nombre='$nombre' AND paciente_activo=1;");
                        $sistema->enlaceBD->query($sql_qs);
                        $sql_ego=sprintf("INSERT INTO laboratorio_EGO(nota_id,bandera) SELECT MAX(n.nota_id),0 
                                          FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                          WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                          AND nombre='$nombre' AND paciente_activo=1;");
                        $sistema->enlaceBD->query($sql_ego);
                        $sql_cultivos=sprintf("INSERT INTO laboratorio_cultivos(texto_cultivo,nota_id,bandera) 
                                               SELECT '0',MAX(n.nota_id),0 
                                               FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                               WHERE apellido_paterno='$ap_paterno' AND apellido_materno='$ap_materno' 
                                               AND nombre='$nombre' AND paciente_activo=1;"); 
                        $sistema->enlaceBD->query($sql_cultivos);
                        /*GUARDAMOS GABINETES*/
                        $sql_electro=sprintf("INSERT INTO gabinete_electrocardiogramas (nota_id,bandera) 
                                              SELECT MAX(n.nota_id),0 FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id 
                                              WHERE p.paciente_id=$paciente_id AND paciente_activo=1;");
                        $sistema->enlaceBD->query($sql_electro);
                        $sql_papanicolaou=sprintf("INSERT INTO gabinete_papanicolaou (nota_id,bandera,papanicolaou_descripcion)
                                                   SELECT MAX(n.nota_id),0,0 FROM nota n INNER JOIN paciente p ON 
                                                    n.paciente_id=p.paciente_id WHERE p.paciente_id=$paciente_id AND 
                                                    paciente_activo=1;");
                        $sistema->enlaceBD->query($sql_papanicolaou);
                        $sql_ultrasonidos=sprintf("INSERT INTO gabinete_ultrasonidos (nota_id,bandera,ultrasonido_descripcion)
                                                   SELECT MAX(n.nota_id),0,0 FROM nota n INNER JOIN paciente p ON 
                                                   n.paciente_id=p.paciente_id WHERE p.paciente_id=$paciente_id AND 
                                                   paciente_activo=1;");
                        $sistema->enlaceBD->query($sql_ultrasonidos);
                        $sql_rayosx=sprintf("INSERT INTO gabinete_rayosx (nota_id,bandera) 
                                             SELECT MAX(n.nota_id),0 FROM nota n INNER JOIN paciente p ON 
                                             n.paciente_id=p.paciente_id 
                                             WHERE p.paciente_id=$paciente_id AND paciente_activo=1;") ;
                        $sistema->enlaceBD->query($sql_rayosx);
                        /*GUARDAMOS IMAGEN*/
                        $sql_imagen=sprintf("INSERT INTO imagen (nota_id,bandera) SELECT MAX(n.nota_id),0 
                                             FROM nota n INNER JOIN paciente p ON n.paciente_id=p.paciente_id
                                             WHERE p.paciente_id=$paciente_id AND paciente_activo=1;"); 
                        $sistema->enlaceBD->query($sql_imagen);
                        $_SESSION["nombre_pasante"]=$nombre_pasante;
                        $_SESSION["usuario"]=$usuario;
                        header("Location:Nota/cuerpo_nota.php?paciente_id=".$paciente_id);
                      }//TERMINA IF QUE EJECUTA LA QUERY $sql_guardar_nota
                    }//else DE LA CONDICION $cita_embarazo
                  }//TERMINA IF QUE EJECUTA LA QUERY: sql_actualiza_domicilio
                }//TERMINA IF DE opcion_nota==3
        	break;
        	case 2:
            $paciente_id=$_POST['paciente_id'];
        		?>
        			<center>
           			<form action="../bienvenido.php" method="post" name="regresar" target="_top">
               		<input  style="font-size:24px" type="submit" value="Cerrar expediente" /><br />
           			</form>
	       			<form action="Cita/agendar_cita.php" method="post" name="agendar_cita" target="_top">
                <input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
               	<input  style="font-size:24px" type="submit" value="Agendar Cita" /><br />
           		</form>
    				</center>
        		<?php
        	break;
          case 3:
            $paciente_id=$_POST['paciente_id'];
            $fecha_cita=$sistema->recuperaPOST("fecha_cita","La fecha de la cita del paciente es requerida");
            $sql_guarda_cita=sprintf("INSERT INTO cita (fecha_cita,paciente_id) VALUES ('$fecha_cita',$paciente_id);"); 
            if ($sistema->enlaceBD->query($sql_guarda_cita)) {
              echo "<center><strong>Cita guardada con éxito.</strong>
                    <form action=\"../bienvenido.php\" method=\"post\" name=\"regresar\" target=\"_top\">
                      <input  style=\"font-size:24px\" type=\"submit\" value=\"Inicio\" /><br />
                    </form>
                    </center>";
            }else{echo "<center><strong>Error al guardar<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";}
            $sistema->desconectar();
          break;
          case 4:
            $paciente_id=$_POST['paciente_id'];
            $fecha_cita=$sistema->recuperaPOST("fecha_cita","La fecha de la cita del paciente es requerida");
            $texto_cita=$sistema->recuperaPOST("texto_cita","La fecha de la cita del paciente es requerida");
            $sql_texto_cita=sprintf("UPDATE cita SET texto_cita='$texto_cita' WHERE fecha_cita='$fecha_cita' AND paciente_id=$paciente_id;");
            if ($sistema->enlaceBD->query($sql_texto_cita)) {
              echo "<center><strong>La anotación de la cita se ha guardado con éxito.</strong>
                    <form action=\"../bienvenido.php\" method=\"post\" name=\"regresar\" target=\"_top\">
                      <input  style=\"font-size:24px\" type=\"submit\" value=\"Inicio\" /><br />
                    </form>
                    </center>";
            }else{echo "<center><strong>Error al guardar<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";}
            $sistema->desconectar();
          break;
        }
	?>
</body>
</html>