<?php
	require_once("../../sesion.php");
	$paciente_id=$_GET["paciente_id"];
	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if(!isset($sistema)){
        require_once("../../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
    $sql_paciente_id=sprintf("SELECT CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) AS nombre_paciente,
    						  sexo,embarazo,recien_nacido,telefono FROM paciente 
    						  WHERE paciente_id='$paciente_id' AND paciente_activo=1;");
    $nombre_paciente=$sistema->getBD($sql_paciente_id,"nombre_paciente");
    $sexo=$sistema->getBD($sql_paciente_id,"sexo");
    $telefono=$sistema->getBD($sql_paciente_id,"telefono");
    $embarazo=$sistema->getBD($sql_paciente_id,"embarazo");
    $recien_nacido=$sistema->getBD($sql_paciente_id,"recien_nacido");
    
    $sql_ultima_cita=sprintf("SELECT fecha_cita,texto_cita FROM cita 
    						  WHERE fecha_cita=(SELECT MAX(fecha_cita) FROM cita WHERE paciente_id=$paciente_id);");
    $fecha_cita=$sistema->getBD($sql_ultima_cita,"fecha_cita");
    $texto_cita=$sistema->getBD($sql_ultima_cita,"texto_cita");

    $sql_diagnostico=sprintf("SELECT diagnostico_id,descripcion_diagnostico FROM diagnostico;");
    $resultado_diagnostico=$sistema->enlaceBD->query($sql_diagnostico);

    $sql_historia_clinica=sprintf("SELECT COUNT(historia_clinica_id) AS hc FROM historia_clinica WHERE paciente_id=$paciente_id;");
    $existe_hc=$sistema->getBD($sql_historia_clinica,"hc");
    if ($existe_hc==0) {
    	$mensaje="El paciente no cuenta con historia clinica. 
    	<a href=\"../Historia_Clinica/historia_clinica.php?paciente_id=$paciente_id\" >Click aquí para elaborar la historia clinica</a><br>";
    }else{$mensaje="El paciente ya cuenta con historia clinica.
    <a href=\"../Historia_Clinica/ver_historia_clinica.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id\" >Ver</a> o
    <a href=\"../Historia_Clinica/modificar_historia_clinica.php?nombre_paciente=$nombre_paciente&paciente_id=$paciente_id\" >Modificar</a>";}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nota</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../demo-files/demo.css">
	<link rel="stylesheet" href="../../css/estilo_bienvenido.css" type="text/css">
</head>
<body>
	<section id="contenedor">
	<header><h1><?php echo $nombre_pasante; ?></h1></header>
	<p>
		Fecha de la nota: <strong><?php echo date("d-m-Y"); ?></strong><br>
		Nombre del paciente: <strong><?php echo $nombre_paciente; ?></strong><br>
		Fecha de su &uacute;ltima cita: <strong><?php  if ($fecha_cita==NULL){echo "No hay cita previa";}else{
														echo date('d-m-Y',strtotime($fecha_cita));} ?></strong><br>
		Anotaciones de la cita: <strong><?php if ($texto_cita==NULL) {echo "No hay anotaciones en la cita";}
											  else{echo $texto_cita;}  ?></strong><br>
		Historia Clinica: <strong><?php echo $mensaje; ?></strong>
	</p>
	<hr>
		<form action="guardar_nota.php" method="post" target="guarda_nota">
			<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
			<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
			<h1><strong>Signos Vitales</strong></h1>
			<p>Frecuencia Cardiaca: <input type="text" id="fc" name="fc" required="required">
				Frecuencia Respiratoria: <input type="text" id="fr" name="fr" required="required">
				Presi&oacute;n Arterial: <input type="text" id="pa" name="pa" required="required"></p>
			<p>Temperatura: <input type="text" id="temp" name="temp" required="required">
			Peso: <input type="text" id="pe" name="pe" required="required">
			Talla: <input type="text" id="talla" name="talla" required="required">
			Indice de masa corporal: <input type="text" id="imc" name="imc" required="required"></p>
			<p>DxTx: <input type="text" id="dxtx" name="dxtx"></p>
			<h1><strong>Nota</strong></h1>
			<textarea rows="20" cols="150" id="texto_nota" name="texto_nota" required></textarea>
			<br><br>
			<p>Diagnostico:
				<select name="diagnostico" id="diagnostico" required="required">
                    <option value=""></option>
                    <?php 
                        while($reg_diagnostico=$resultado_diagnostico->fetch_object()){
                            echo "
                                <option value=\"$reg_diagnostico->diagnostico_id\">$reg_diagnostico->descripcion_diagnostico</option>
                            ";
                        }
                    ?>
                </select>
             </p>       
			<br><br>
			<input type="submit" value="Guardar Nota">
		</form>
		<iframe name="guarda_nota" id="guarda_nota" src="../../vacia.html" width="100%" height="60" frameborder="0"></iframe>

		<hr size="2px" color="black">

			<h1><strong>Laboratorio</strong></h1>
			<form action="../Laboratorio/guardar_laboratorios.php" method="post" target="guarda_bh">
				<input type="hidden" name="form_laboratorio" id="form_laboratorio" value="1">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
				<h2>BH</h2>
					<p>
						Eritrocitos: <input type="text" id="eritrocitos_vista" name="eritrocitos_vista"> 
						Hemoglobina: <input type="text" id="hemoglobina_vista" name="hemoglobina_vista">
					</p>
					<p>
						Hematocrito: <input type="text" id="hematocrito_vista" name="hematocrito_vista"> 
						Plaquetas: <input type="text" id="plaquetas_vista" name="plaquetas_vista">
					</p>
					<p>
						Leucocitos: <input type="text" id="leucocitos_vista" name="leucocitos_vista">
						Volumen corpuscular medio: <input type="text" id="volumen_corpuscular_medio_vista" name="volumen_corpuscular_medio_vista">
					</p>
					<p>
						Neutrofilos: <input type="text" id="neutrofilos_vista" name="neutrofilos_vista">
						Eosinofilos: <input type="text" id="eosinofilos_vista" name="eosinofilos_vista">
					</p>
				<input type="submit" value="Guardar BH">
			</form>
			<iframe name="guarda_bh" id="guarda_bh" src="../../vacia.html" width="100%" height="60" frameborder="0"></iframe>
			
			<hr>
			
			<form action="../Laboratorio/guardar_laboratorios.php" method="post" target="guarda_qs">
				<input type="hidden" name="form_laboratorio" id="form_laboratorio" value="2">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
				<h2>QS</h2>
					<p>
						Glucosa: <input type="text" id="glucosa_vista" name="glucosa_vista"> 
						Urea: <input type="text" id="urea_vista" name="urea_vista"> 
					</p>
					<p>
						Creatinina:<input type="text" id="creatinina_vista" name="creatinina_vista">
						Acido urico: <input type="text" id="acido_urico_vista" name="acido_urico_vista"> 
					</p>
					<p>
						Colesterol: <input type="text" id="colesterol_vista" name="colesterol_vista"> 
						Trigliceridos: <input type="text" id="trigliceridos_vista" name="trigliceridos_vista">
					</p>
					<p>
						B total: <input type="text" id="btotal_vista" name="btotal_vista">
						B directa: <input type="text" id="bdirecta_vista" name="bdirecta_vista">
						B indirecta: <input type="text" id="bindirecta_vista" name="bindirecta_vista">
					</p>
					<p>
						TGO: <input type="text" id="tgo_vista" name="tgo_vista">
						TGP: <input type="text" id="tgp_vista" name="tgp_vista">
					</p>
					<p>
						Amilasa: <input type="text" id="amilasa_vista" name="amilasa_vista">
						Lipasa: <input type="text" id="lipasa_vista" name="lipasa_vista">
					</p>
					<input type="submit" value="Guardar QS">
			</form>
			<iframe name="guarda_qs" id="guarda_qs" src="../../vacia.html" width="100%" height="60" frameborder="0"></iframe>
            
            <hr>

            <form action="../Laboratorio/guardar_laboratorios.php" method="post" target="guarda_ego">
				<input type="hidden" name="form_laboratorio" id="form_laboratorio" value="3">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
				<h2>EGO</h2>
  					 <p>
            			Densidad: <input type="text" id="densidad_vista" name="densidad_vista">
						PH: <input type="text" id="ph_vista" name="ph_vista">
					 </p>
					 <p>
						Celulas epiteliales: <input type="text" id="celulas_epiteliales_vista" name="celulas_epiteliales_vista">
						Cristales: <input type="text" id="cristales_vista" name="cristales_vista">
					 </p>
					 <p>
						Leucocitos: <input type="text" id="leucocitos_vista" name="leucocitos_vista">
						Eritrocitos: <input type="text" id="eritrocitos_vista" name="eritrocitos_vista">
					 </p>
					 <p>
						Glucosa: <input type="text" id="glucosa_vista" name="glucosa_vista">
						Bacterias: <input type="text" id="bacterias_vista" name="bacterias_vista">
            		 </p>
            		 <input type="submit" value="Guardar EGO">
			</form>
			<iframe name="guarda_ego" id="guarda_ego" src="../../vacia.html" width="100%" height="60" frameborder="0"></iframe>
            
            <hr>
            
            <form action="../Laboratorio/guardar_laboratorios.php" method="post" target="guarda_cultivos">
				<input type="hidden" name="form_laboratorio" id="form_laboratorio" value="4">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
				<h2>Cultivos</h2>
  					 <textarea rows="20" cols="150" id="cultivos_texto_vista" name="cultivos_texto_vista"></textarea>
  					 <br><br>
  				<input type="submit" value="Guardar Cultivos">
			</form>
			<iframe name="guarda_cultivos" id="guarda_cultivos" src="../../vacia.html" width="100%" height="60" frameborder="0"></iframe>

			<hr size="2px" color="black">

			<h1><strong>Gabinete</strong></h1>
			<form action="../Gabinete/guardar_nota_gabinete.php" method="post" target="guarda_electrocardiograma" enctype="multipart/form-data">
				<input type="hidden" name="form_gabinete" id="form_gabinete" value="1">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
					<ul>
					<li><h2>Electrocardiogramas</h2></li>
						<input name="gelectro1" type="file" />
						<input name="gelectro2" type="file" />
						<input name="gelectro3" type="file" />
						<input name="gelectro4" type="file" />
						<input name="gelectro5" type="file" />
						<br><br>
	
				<input type="submit" value="Guardar Electrocardiogramas">
			</form>
			<iframe name="guarda_electrocardiograma" id="guarda_electrocardiograma" src="../../vacia.html" width="100%" height="60" frameborder="0"></iframe>	
			
			<?php 
				if ($sexo=="F") {
			?>
				<hr>
            	<form action="../Gabinete/guardar_nota_gabinete.php" method="post" target="guarda_papanicolaou">
					<input type="hidden" name="form_gabinete" id="form_gabinete" value="2">
					<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<li><h2>Papanicolaou</h2></li>
							<textarea rows="20" cols="60" id="papanicolaou" name="papanicolaou"></textarea>
							<br><br>
						<input type="submit" value="Guardar Papanicolaou">
				</form>
				<iframe name="guarda_papanicolaou" id="guarda_papanicolaou" src="../../vacia.html" width="100%" height="60" frameborder="0"></iframe>
			<?php
				}
			?>
            
			<hr>
			
			<form action="../Gabinete/guardar_nota_gabinete.php" method="post" target="guarda_ultrasonidos" enctype="multipart/form-data">
				<input type="hidden" name="form_gabinete" id="form_gabinete" value="3">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
					<li><h2>Ultrasonidos</h2></li>
						<textarea rows="20" cols="60" id="ultrasonidos" name="ultrasonidos"></textarea>
						<br><br>
				<input type="submit" value="Guardar Ultrasonidos">
			</form>
			<iframe name="guarda_ultrasonidos" id="guarda_ultrasonidos" src="../../vacia.html" width="100%" height="60" frameborder="0"></iframe>
			
			<hr>
			
			<form action="../Gabinete/guardar_nota_gabinete.php" method="post" target="guarda_rayosx" enctype="multipart/form-data">
				<input type="hidden" name="form_gabinete" id="form_gabinete" value="4">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
					<li><h2>Rayos X</h2></li>
						<input name="rayosxi_1" type="file" />
						<input name="rayosxi_2" type="file" />
						<input name="rayosxi_3" type="file" />
						<input name="rayosxi_4" type="file" />
						<input name="rayosxi_5" type="file" />
					</ul>	
				<input type="submit" value="Guardar Rayos X">
			</form>
			<iframe name="guarda_rayosx" id="guarda_rayosx" src="../../vacia.html" width="100%" height="60" frameborder="0"></iframe>

			<hr size="2px" color="black">
            
			<form action="../Imagen/guardar_nota_imagen.php" method="post" target="guarda_imagen" enctype="multipart/form-data">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
					<h1><strong>Imagen</strong></h1>
					<input name="imagen_1" type="file" />
					<input name="imagen_2" type="file" />
					<input name="imagen_3" type="file" />
					<input name="imagen_4" type="file" />
					<input name="imagen_5" type="file" />
				<br><br>
				<input type="submit" value="Guardar Imagen">
			</form>
			<iframe name="guarda_imagen" id="guarda_imagen" src="../../vacia.html" width="100%" height="200" frameborder="0"></iframe>
		</form>
		
		<form action="../guardar_paciente.php" method="post">
			<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
			<input type="hidden" name="nombre_pasante" id="nombre_pasante" value="<?php echo  $nombre; ?>">
			<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
			<input type="hidden" name="formulario" id="formulario" value="2">
		   <br><br>
           <input type="submit" value="Salir de Nota">
		</form>
	</section>
</body>
</html>