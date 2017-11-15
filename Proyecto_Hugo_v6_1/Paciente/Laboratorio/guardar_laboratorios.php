<!DOCTYPE html>
<html>
<head>
    <title>Guarda Laboratorios</title>
</head>
<body>
    <?php
        require_once("../../coneccion.php");

        $sistema = new sistema();
        $sistema->conectar();
        $usuario=$sistema->recuperaPOST("usuario","Por favor inice sesión");
        $form_laboratorio=$_POST['form_laboratorio'];

        switch ($form_laboratorio) {
            /*LABORATORIOS BH*/
            case 1:
                
                $eritrocitos_vista = $sistema->recuperaPOST("eritrocitos_vista","Dato del BH_eritrocitos es requerido");
                $hemoglobina_vista = $sistema->recuperaPOST("hemoglobina_vista","Dato del BH_hemoglobina es requerido");
                $hematocrito_vista = $sistema->recuperaPOST("hematocrito_vista","Dato del BH_hematrocito es requerido");
                $plaquetas_vista = $sistema->recuperaPOST("plaquetas_vista","Dato del BH_plaquetas es requerido");
                $leucocitos_vista = $sistema->recuperaPOST("leucocitos_vista","Dato del BH_leucocitos es requerido");
                $volumen_corpuscular_medio_vista = $sistema->recuperaPOST("volumen_corpuscular_medio_vista","Dato del BH_volumen_corpuscular_medio es requerido");
                $neutrofilos_vista = $sistema->recuperaPOST("neutrofilos_vista","Dato del BH_neutrofilos es requerido");
                $eosinofilos_vista = $sistema->recuperaPOST("eosinofilos_vista","Dato del BH_eosinofilos es requerido");
                
                $sql_bh_id=sprintf("SELECT laboratorio_bh_id FROM laboratorio_BH
                                              WHERE nota_id=(SELECT MAX(nota_id) FROM nota WHERE email='$usuario');");
                $sistema->enlaceBD->query($sql_bh_id);
                $bh_id=$sistema->getBD($sql_bh_id,"laboratorio_bh_id");

                /*INSERTAMOS LOS DATOS EN EL LABORATORIO DE BH*/
                
                $sql_guarda_laboratorio_BH=sprintf("UPDATE laboratorio_BH SET eritrocitos='$eritrocitos_vista', hemoglobina='$hemoglobina_vista', hematocrito='$hematocrito_vista', plaquetas='$plaquetas_vista', leucocitos='$leucocitos_vista', volumen_corpuscular_medio='$volumen_corpuscular_medio_vista', neutrofilos='$neutrofilos_vista', eosinofilos='$eosinofilos_vista',bandera=1 
                                                           WHERE laboratorio_bh_id=$bh_id;");


                if ($sistema->enlaceBD->query($sql_guarda_laboratorio_BH)) {
                    echo "<center><strong>Datos del BH guardados con éxito.</strong></center>";
                }else{
                    if (substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")) {
                        echo "<center><strong>El BH ya se ha guardado.</strong></center>";
                    }else{
                        echo "<center><strong>Error al guardar los datos del BH<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
                    }
                }
                $sistema->desconectar();
            break;
           /*LABORATORIOS QS*/
        	case 2:
                $glucosa_vista = $sistema->recuperaPOST("glucosa_vista","Dato de QS_glucosa es requerido");
                $urea_vista = $sistema->recuperaPOST("urea_vista","Dato de QS_urea es requerido");
                $creatinina_vista = $sistema->recuperaPOST("creatinina_vista","Dato de QS_creatinina es requerido");
                $acido_urico_vista = $sistema->recuperaPOST("acido_urico_vista","Dato de QS_acido_urico es requerido");
                $colesterol_vista = $sistema->recuperaPOST("colesterol_vista","Dato de QS_colesterol es requerido");
                $trigliceridos_vista = $sistema->recuperaPOST("trigliceridos_vista","Dato de QS_trigliceridos es requerido");
                $btotal_vista = $sistema->recuperaPOST("btotal_vista","Dato de QS_Btotal es requerido");
                $bdirecta_vista = $sistema->recuperaPOST("bdirecta_vista","Dato de QS_Bdirecta es requerido");
                $bindirecta_vista = $sistema->recuperaPOST("bindirecta_vista","Dato de QS_Bindirecta es requerido");
                $tgo_vista = $sistema->recuperaPOST("tgo_vista","Dato de QS_tgo es requerido");
                $tgp_vista = $sistema->recuperaPOST("tgp_vista","Dato de QS_tgp es requerido");
                $amilasa_vista = $sistema->recuperaPOST("amilasa_vista","Dato de QS_amilasa es requerido");
                $lipasa_vista = $sistema->recuperaPOST("lipasa_vista","Dato de QS_lipasa es requerido");
                
                $sql_qs_id=sprintf("SELECT laboratorio_qs_id FROM laboratorio_QS
                                              WHERE nota_id=(SELECT MAX(nota_id) FROM nota WHERE email='$usuario');");
                $sistema->enlaceBD->query($sql_qs_id);
                $qs_id=$sistema->getBD($sql_qs_id,"laboratorio_qs_id");
        		/*INSERTAMOS LOS DATOS EN EL GABINETE DEL QS*/
        		 $sql_guarda_laboratorio_QS=sprintf("UPDATE laboratorio_QS SET glucosa='$glucosa_vista', urea='$urea_vista',creatinina='$creatinina_vista', acido_urico='$acido_urico_vista', colesterol='$colesterol_vista', trigliceridos='$trigliceridos_vista', B_total='$btotal_vista', B_directa='$bdirecta_vista', B_indirecta='$bindirecta_vista', TGO='$tgo_vista', TGP='$tgo_vista', amilasa='$amilasa_vista', lipasa='$lipasa_vista',bandera=1 
                                                           WHERE laboratorio_qs_id=$qs_id;");
        		if ($sistema->enlaceBD->query($sql_guarda_laboratorio_QS)) {
                    echo "<center><strong>Datos de QS guardados con éxito.</strong></center>";
                }else{
                    if (substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")) {
                        echo "<center><strong>El QS ya se ha guardado.</strong></center>";
                    }else{
                        echo "<center><strong>Error al guardar los datos del QS<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
                    }
                }
                $sistema->desconectar();
        	break;
            /*LABORATORIOS EGO*/
            case 3:

                $densidad_vista = $sistema->recuperaPOST("densidad_vista","Dato de EGO_densidad es requerido");
                $ph_vista = $sistema->recuperaPOST("ph_vista","Dato de EGO_ph es requerido");
                $celulas_epiteliales_vista = $sistema->recuperaPOST("celulas_epiteliales_vista","Dato de EGO_celulas_epiteliales es requerido");
                $cristales_vista = $sistema->recuperaPOST("cristales_vista","Dato de EGO_cristales es requerido");
                $leucocitos_vista = $sistema->recuperaPOST("leucocitos_vista","Dato de EGO_leucocitos es requerido");
                $eritrocitos_vista = $sistema->recuperaPOST("eritrocitos_vista","Dato de EGO_eritrocitos es requerido");
                $glucosa_vista = $sistema->recuperaPOST("glucosa_vista","Dato de EGO_glucosa es requerido");
                $bacterias_vista = $sistema->recuperaPOST("bacterias_vista","Dato de EGO_bacterias es requerido");
                
                $sql_ego_id=sprintf("SELECT laboratorio_ego_id FROM laboratorio_EGO
                                              WHERE nota_id=(SELECT MAX(nota_id) FROM nota WHERE email='$usuario');");
                $sistema->enlaceBD->query($sql_ego_id);
                $ego_id=$sistema->getBD($sql_ego_id,"laboratorio_ego_id");

                /*Insertamos los datos en el laboratorio de EGO*/
                
                 $sql_guarda_laboratorio_EGO=sprintf("UPDATE laboratorio_EGO SET densidad='$densidad_vista', PH='$ph_vista',celulas_epiteliales='$celulas_epiteliales_vista', cristales='$cristales_vista', leucocitos='$leucocitos_vista', eritrocitos='$eritrocitos_vista', glucosa='$glucosa_vista', bacterias='$bacterias_vista', bandera=1 
                                                           WHERE laboratorio_ego_id=$ego_id;");


                if ($sistema->enlaceBD->query($sql_guarda_laboratorio_EGO)) {
                    echo "<center><strong>Datos de EGO guardados con éxito.</strong></center>";
                }else{
                    if (substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")) {
                        echo "<center><strong>El EGO ya se ha guardado.</strong></center>";
                    }else{
                        echo "<center><strong>Error al guardar los datos del EGO<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
                    }
                }
                $sistema->desconectar();
            break;

            /*LABORATORIOS CULTIVOS*/
        	case 4:
                $cultivos_texto_vista = $sistema->recuperaPOST("cultivos_texto_vista","Dato de Cultivos es requerido");
                
                $sql_cultivos_id=sprintf("SELECT laboratorio_cultivos_id FROM laboratorio_Cultivos
                                              WHERE nota_id=(SELECT MAX(nota_id) FROM nota WHERE email='$usuario');");
                $sistema->enlaceBD->query($sql_cultivos_id);
                $cultivos_id=$sistema->getBD($sql_cultivos_id,"laboratorio_cultivos_id");


                /*Insertamos los datos en el laboratorio de Cultivos*/
                
                $sql_guarda_laboratorio_Cultivos=sprintf("UPDATE laboratorio_Cultivos SET texto_cultivo='$cultivos_texto_vista', bandera=1 
                                                           WHERE laboratorio_cultivos_id=$cultivos_id;");


                if ($sistema->enlaceBD->query($sql_guarda_laboratorio_Cultivos)) {
                    echo "<center><strong>Datos de Cultivos guardados con éxito.</strong></center>";
                }else{
                    if (substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")) {
                        echo "<center><strong>El Cultivos ya se ha guardado.</strong></center>";
                    }else{
                        echo "<center><strong>Error al guardar los datos del Cultivos<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
                    }
                }
                $sistema->desconectar();
        	break;
            
           
        }
	?>
</body>
</html>