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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel = "stylesheet" href = "../../../Interfaces/css/main.css">
</head>
<body>
	<div id = "wrapper">
		<!-- Cabecera -->
		<div class="container-fluid navbar-fixed-top" id = "cabecera">
			<div class = "row">
				<div class = "col-md-1">
					<img src= "../../../Interfaces/imag/neuros.jpg" height = "80" width = "100"></img>
				</div>
				<div class = "col-md-4">
					<h2>Expediente Médico Digital</h2>
					<h4>Centro de Salud San Francisco Mihualtepec</h4>
				</div>
				<div class = "col-md-7" style="position: absolute; bottom: 10px; right:15px;" align = "right">
					<div class = "row">
						<form class="form-inline">
							Buscar paciente: <input class="form-control input-sm" type="text" placeholder="Apellido Paterno">
							<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='listadoPacientes.html'">
								<span class="glyphicon glyphicon-search"></span> Buscar
							</button>
						</form>
					</div><br>
					<div class = "row">
						<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='../../bienvenido.php'">
							<span class="glyphicon glyphicon-home"></span> Inicio
						</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='../../../index.php'">Cerrar sesión
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Contenido -->
		<div id = "contenido" align = "center">
			<div class = "container-fluid" >
				<h1>Registro de la nota del paciente: <?php echo $nombre_paciente; ?></h1>
				<p>
					Fecha de la nota: <strong><?php echo date("d-m-Y"); ?></strong><br>
					Nombre del paciente: <strong><?php echo $nombre_paciente; ?></strong><br>
					Fecha de su &uacute;ltima cita: <strong><?php  if ($fecha_cita==NULL){echo "No hay cita previa";}else{
														echo date('d-m-Y',strtotime($fecha_cita));} ?></strong><br>
					Anotaciones de la cita: <strong><?php if ($texto_cita==NULL) {echo "No hay anotaciones en la cita";}
											  else{echo $texto_cita;}  ?></strong><br>
					Historia Clinica: <strong><?php echo $mensaje; ?></strong>
				</p>
				<p>Favor de proporcionar la siguiente información</p>
				<hr>
			</div><br>
			<div class = "container">
				<div class = "row">
					<form class = "form-horizontal" action="guardar_nota.php" method="post" target="guarda_nota">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
						<h1><strong>Signos Vitales</strong></h1>
						<p>
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Frecuencia Cardiaca:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="fc" name="fc" required="required">
								</div>
						 	</div>

							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Frecuencia Respiratoria:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="fr" name="fr" required="required">
								</div>
						 	</div>
							 
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Presi&oacute;n Arterial:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="pa" name="pa" required="required">
								</div>
						 	</div>
						
							 <div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Temperatura:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="temp" name="temp" required="required">
								</div>
						 	</div>

							 <div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Peso:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="pe" name="pe" required="required">
								</div>
						 	</div>

							 <div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Talla:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="talla" name="talla" required="required">
								</div>
						 	</div>

							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Indice de masa corporal:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="imc" name="imc" required="required">
								</div>
						 	</div>

							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">DxTx:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="dxtx" name="dxtx">
								</div>
						 	</div>
						</p>

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
						<input class="btn btn-primary" class="btn btn-primary" type="submit" value="Guardar Nota">
					</form>
					<iframe name="guarda_nota" id="guarda_nota" src="../../../vacia.html" width="100%" height="60" frameborder="0"></iframe>

					<hr size="2px" color="black">

					<h1><strong>Laboratorio</strong></h1>
					<form class = "form-horizontal" action="../Laboratorio/guardar_laboratorios.php" method="post" target="guarda_bh">
						<input type="hidden" name="form_laboratorio" id="form_laboratorio" value="1">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<h2>BH</h2>
						<p>
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Eritrocitos:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="eritrocitos_vista" name="eritrocitos_vista">
								</div>
						 	</div> 
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Hemoglobina:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="hemoglobina_vista" name="hemoglobina_vista">
								</div>
						 	</div>
						 
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Hematocrito:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="hematocrito_vista" name="hematocrito_vista">
								</div>
						 	</div>

							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Plaquetas:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="plaquetas_vista" name="plaquetas_vista">
								</div>
						 	</div>
						
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Leucocitos:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="leucocitos_vista" name="leucocitos_vista">
								</div>
						 	</div>
							 
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Volumen corpuscular medio:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="volumen_corpuslar_medio_vista" 
							  			name="volumen_corpuslar_medio_vista">
								</div>
						 	</div>
						
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Neutrofilos:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="neutrofilos_vista" name="neutrofilos_vista">
								</div>
						 	</div>
							 
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Eosinofilos:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="eosinofilos_vista" name="eosinofilos_vista">
								</div>
						 	</div>
						</p>
						<input class="btn btn-primary" type="submit" value="Guardar BH">
					</form>
					<iframe name="guarda_bh" id="guarda_bh" src="../../../vacia.html" width="100%" height="60" frameborder="0"></iframe>
			
					<hr>
			
					<form class = "form-horizontal" action="../Laboratorio/guardar_laboratorios.php" method="post" target="guarda_qs">
						<input type="hidden" name="form_laboratorio" id="form_laboratorio" value="2">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<h2>QS</h2>
						<p>
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Glucosa:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="glucosa_vista" name="glucosa_vista">
								</div>
						 	</div> 
							 
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Urea:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="urea_vista" name="urea_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Creatinina:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="creatinina_vista" name="creatinina_vista">
								</div>
						 	</div>
							 
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Acido urico:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="acido_urico_vista" name="acido_urico_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Colesterol:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="colesterol_vista" name="colesterol_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Trigliceridos:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="trigliceridos_vista" name="trigliceridos_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">B total:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="btotal_vista" name="btotal_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">B directa:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="bdirecta_vista" name="bdirecta_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">B indirecta:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="bindirecta_vista" name="bindirecta_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">TGO:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="tgo_vista" name="tgo_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">TGP:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="tgp_vista" name="tgp_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Amilasa:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="amilasa_vista" name="amilasa_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Lipasa:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="lipasa_vista" name="lipasa_vista">
								</div>
						 	</div>
						</p>
						<input class="btn btn-primary" type="submit" value="Guardar QS">
					</form>
					<iframe name="guarda_qs" id="guarda_qs" src="../../../vacia.html" width="100%" height="60" frameborder="0"></iframe>
            
            		<hr>

            		<form class = "form-horizontal" action="../Laboratorio/guardar_laboratorios.php" method="post" target="guarda_ego">
						<input type="hidden" name="form_laboratorio" id="form_laboratorio" value="3">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<h2>EGO</h2>
  					 	<p>
            				
            				<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Densidad:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="densidad_vista" name="densidad_vista">
								</div>
						 	</div>
							
					 		<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">PH:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="ph_vista" name="ph_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Celulas epiteliales:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="celulas_epiteliales_vista" name="celulas_epiteliales_vista">
								</div>
						 	</div>
							
					 		<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Cristales:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="cristales_vista" name="cristales_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Leucocitos:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="leucocitos_vista" name="leucocitos_vista">
								</div>
						 	</div>
							
					 		<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Eritrocitos:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="eritrocitos_vista" name="eritrocitos_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Glucosa:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="glucosa_vista" name="glucosa_vista">
								</div>
						 	</div>
							
							<div class="form-group">
								<label for="inputName" class="col-md-4 control-label">Bacterias:</label>
								<div class="col-md-4">
							  		<input type="text" class="form-control" id="bacterias_vista" name="bacterias_vista">
								</div>
						 	</div>
            		 	</p>
            		 	<input class="btn btn-primary" type="submit" value="Guardar EGO">
					</form>
					<iframe name="guarda_ego" id="guarda_ego" src="../../../vacia.html" width="100%" height="60" frameborder="0"></iframe>
            
            		<hr>
            
            		<form class = "form-horizontal" action="../Laboratorio/guardar_laboratorios.php" method="post" target="guarda_cultivos">
						<input type="hidden" name="form_laboratorio" id="form_laboratorio" value="4">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<h2>Cultivos</h2>
  					 	
  					 	<div class="form-group">
							<textarea class="form-control" rows="20" cols="150" id="cultivos_texto_vista" name="cultivos_texto_vista"></textarea>
						</div>
  					 	<br><br>
  						<input class="btn btn-primary" type="submit" value="Guardar Cultivos">
					</form>
					<iframe name="guarda_cultivos" id="guarda_cultivos" src="../../../vacia.html" width="100%" height="60" frameborder="0">
					</iframe>

					<hr size="2px" color="black">

					<h1><strong>Gabinete</strong></h1>
					<form class = "form-horizontal" action="../Gabinete/guardar_nota_gabinete.php" method="post" 
						target="guarda_electrocardiograma" enctype="multipart/form-data">
						<input type="hidden" name="form_gabinete" id="form_gabinete" value="1">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
							<h2>Electrocardiogramas</h2>
							<input class="form-control" name="gelectro1" type="file" />
							<input class="form-control" name="gelectro2" type="file" />
							<input class="form-control" name="gelectro3" type="file" />
							<input class="form-control" name="gelectro4" type="file" />
							<input class="form-control" name="gelectro5" type="file" />
							<br><br>
						<input class="btn btn-primary" type="submit" value="Guardar Electrocardiogramas">
					</form>
					<iframe name="guarda_electrocardiograma" id="guarda_electrocardiograma" src="../../../vacia.html" width="100%" 
						height="60" frameborder="0"></iframe>	
			
					<?php 
					if ($sexo=="F") {
					?>
					<hr>
            		<form class = "form-horizontal" action="../Gabinete/guardar_nota_gabinete.php" method="post" target="guarda_papanicolaou">
						<input type="hidden" name="form_gabinete" id="form_gabinete" value="2">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<h2>Papanicolaou</h2>
							<div class="form-group">
								<textarea rows="20" cols="60" id="papanicolaou" name="papanicolaou"></textarea>
							</div>
							<br><br>
						<input class="btn btn-primary" type="submit" value="Guardar Papanicolaou">
					</form>
					<iframe name="guarda_papanicolaou" id="guarda_papanicolaou" src="../../../vacia.html" width="100%" height="60" 
						frameborder="0"></iframe>
					<?php
						}
					?>
            
					<hr>
			
					<form class = "form-horizontal" action="../Gabinete/guardar_nota_gabinete.php" method="post" target="guarda_ultrasonidos" 
						enctype="multipart/form-data">
						<input type="hidden" name="form_gabinete" id="form_gabinete" value="3">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<h2>Ultrasonidos</h2>
							<div class="form-group">
								<textarea rows="20" cols="60" id="ultrasonidos" name="ultrasonidos"></textarea>
							</div>
							<br><br>
						<input class="btn btn-primary" type="submit" value="Guardar Ultrasonidos">
					</form>
					<iframe name="guarda_ultrasonidos" id="guarda_ultrasonidos" src="../../../vacia.html" width="100%" height="60" 
						frameborder="0"></iframe>
			
					<hr>
			
					<form class = "form-horizontal" action="../Gabinete/guardar_nota_gabinete.php" method="post" target="guarda_rayosx" 
						enctype="multipart/form-data">
						<input type="hidden" name="form_gabinete" id="form_gabinete" value="4">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<h2>Rayos X</h2>
							<input class="form-control" name="rayosxi_1" type="file" />
							<input class="form-control" name="rayosxi_2" type="file" />
							<input class="form-control" name="rayosxi_3" type="file" />
							<input class="form-control" name="rayosxi_4" type="file" />
							<input class="form-control" name="rayosxi_5" type="file" />	
							<br><br>
						<input class="btn btn-primary" type="submit" value="Guardar Rayos X">
					</form>
					<iframe name="guarda_rayosx" id="guarda_rayosx" src="../../../vacia.html" width="100%" height="60" frameborder="0"></iframe>

					<hr size="2px" color="black">
            
					<form class = "form-horizontal" action="../Imagen/guardar_nota_imagen.php" method="post" target="guarda_imagen" 
						enctype="multipart/form-data">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<h1><strong>Imagen</strong></h1>
						<input class="form-control" name="imagen_1" type="file" />
						<input class="form-control" name="imagen_2" type="file" />
						<input class="form-control" name="imagen_3" type="file" />
						<input class="form-control" name="imagen_4" type="file" />
						<input class="form-control" name="imagen_5" type="file" />
						<br><br>
						<input class="btn btn-primary" type="submit" value="Guardar Imagen">
					</form>
					<iframe name="guarda_imagen" id="guarda_imagen" src="../../../vacia.html" width="100%" height="200" frameborder="0"></iframe>
					</form>

					<form class = "form-horizontal" action="../guardar_paciente.php" method="post">
						<input type="hidden" name="usuario" id="usuario" value="<?php echo  $usuario; ?>">
						<input type="hidden" name="nombre_pasante" id="nombre_pasante" value="<?php echo  $nombre; ?>">
						<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo  $paciente_id; ?>">
						<input type="hidden" name="formulario" id="formulario" value="2">
		   				<br><br>
           				<input class="btn btn-primary" type="submit" value="Salir de Nota">
					</form>
				</div>
			</div>
		</div>
		<!-- Pie de página -->
		<div id = "pie">
			<div class = "container-fluid text-muted">
				<div class = "col-md-3">
					<span>
						&copy; 2017 Expediente Médico Digital<br>
						Centro de salud: San Francisco Mihualtepec<br>
						<a href = "#">Aviso de privacidad</a><br>
						Última actualización: 28 de octubre de 2017
					</span>
				</div>
				<div class = "col-md-6" align = "center">
					<span>
						<strong>Grupo de desarrollo: OmegaTech</strong><br><br>
						<ul align = "left">
						<li>Víctor Arturo Morales Díaz | <span class="glyphicon glyphicon-earphone"></span> +52 1 55 3100 0803 | <span class="glyphicon glyphicon-envelope"></span> ar2days@gmail.com</li>
						<li>David Antúnez Montoya | <span class="glyphicon glyphicon-earphone"></span> +52 1 464 100 9135 | <span class="glyphicon glyphicon-envelope"></span> xps.3000cc@gmail.com</li>
						<li>Miqueas Esli Aldama Sánchez | <span class="glyphicon glyphicon-earphone"></span> +52 1 55 6481 6752 | <span class="glyphicon glyphicon-envelope"></span> mikefantas2@gmail.com</li>
						<li>David Sánchez Nolasco | <span class="glyphicon glyphicon-earphone"></span> +52 1 55 9139 2527 | <span class="glyphicon glyphicon-envelope"></span> lci.david.sanchez.unam@gmail.com</li>
						</ul>
					</span>
				</div>
				<div class = "col-md-3" align = "center">
					<img src="../../../Interfaces/imag/logoOmegaTech_v2.jpg" height = "80px" width = "80px"></img><br>
					OmegaTech
				</div>
			</div>
		</div>
	</div>
</body>
</html>