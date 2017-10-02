<?php
	require_once("sesion.php");

	$usuario=$_SESSION["usuario"];
	$nombre_pasante=$_SESSION["nombre_pasante"];
	if(!isset($sistema)){
        require_once("coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }

    //echo $usuario." ".$nombre_pasante;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro Paciente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="demo-files/demo.css">
	<link rel="stylesheet" href="css/estilo_bienvenido.css" type="text/css">
	<script src="js/div.js"></script>
    <script src="js/funcion.js"></script><!--CONTIENE LA FUNCION PARA QUE LA PESTAÑA AL DARLE CLICK MUESTRE LO INDICADO-->
</head>
<body>
	<section id="contenedor">
		<nav>
			<ul>
				<li><a href="bienvenido.php"><span class="icon icon-home2"></span>Inicio</a></li>
				<li><a href="buscar_paciente.php"><span class="icon icon-profile"></span>Buscar paciente</a></li>
				<li><a href="#"><span class="icon icon-newspaper"></span>Reportes</a></li>
				<li><a href="#"><span class="icon icon-file-text2"></span>Estad&iacute;sticas</a></li>
				<li><a href="index.php"><span class="icon icon-clock"></span>Cerrar Sesi&oacute;n</a></li>
			</ul>
		</nav>
		<header><h1><?php echo $nombre_pasante; ?><br><br>Formulario de Registro de Paciente</h1></header>
		<section id="formulario_paciente">
			<form action="guardar_nota_paciente.php" method="post" target="guarda_paciente_nota" enctype="multipart/form-data">
				<p>Fecha: <input type="text" id="fecha" name="fecha" size="6" value="<?php echo date("d-m-Y"); ?>" readonly>
            	</p>
            	<hr>
            	<h1><strong>Datos personales del paciente</strong></h1>
            	<p>
            		Apellido Paterno: <input type="text" id="ap_paterno" name="ap_paterno" required="required">
            		Apellido Materno: <input type="text" id="ap_materno" name="ap_materno" required="required">
            		Nombre(s): <input type="text" id="nombre" name="nombre" required="required">
            	</p>
            	<p>Edad: <input type="number" id="edad" name="edad" required="required"></p>
            	<p>Domicilio: <input type="text" id="domicilio" name="domicilio" required="required"></p>
            	<p>Embarazo:
            		<div class="select">
                        <select name="embarazo" id="embarazo" required="">
                            <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
            	Recien nacido:
            		<div class="select">
                        <select name="recien_nacido" id="recien_nacido" required="">
                            <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
            	</p>
            	<hr size="2px" color="black">
            	<h1><strong>Signos Vitales</strong></h1>
            	<p>Frecuencia Cardiaca: <input type="text" id="fc" name="fc" required="required">
				Frecuencia Respiratoria: <input type="text" id="fr" name="fr" required="required">
				Presi&oacute;n Arterial: <input type="text" id="pa" name="pa" required="required"></p>
				<p>Temperatura: <input type="text" id="temp" name="temp" required="required">
				Peso: <input type="text" id="pe" name="pe" required="required">
				Talla: <input type="text" id="talla" name="talla" required="required">
            	Indice de masa corporal: <input type="text" id="imc" name="imc" required="required"></p>
            	<p>DxTx: <input type="text" id="dxtx" name="dxtx" required="required"></p>
				<hr size="2px" color="black">
            	<h1><strong>Nota</strong></h1>
            	<textarea rows="20" cols="150" id="comentarios_nota" name="comentarios_nota" required></textarea>
            	<hr size="2px" color="black">
            	<h1><strong>Laboratorio</strong></h1>
            	<h2>BH</h2>
					<p>
            			Eritrocitos: <input type="text" id="Eritrocitos_bh" name="Eritrocitos_bh"> 
						Hemoglobina: <input type="text" id="Hemoglobina" name="Hemoglobina">
					</p>
					<p>
						Hematocrito: <input type="text" id="Hematocrito" name="Hematocrito"> 
						Plaquetas: <input type="text" id="Plaquetas" name="Plaquetas">
					</p>
					<p>
						Leucocitos: <input type="text" id="Leucocitos_bh" name="Leucocitos_bh">
						Volumen corpuscular medio: <input type="text" id="Volumen" name="Volumen">
					</p>
					<p>
						Neutrofilos: <input type="text" id="Neutrofilos" name="Neutrofilos">
						Eosinofilos: <input type="text" id="Eosinofilos" name="Eosinofilos">
					</p>
					<hr>
				<h2>QS</h2>
  					 <p>
            			Glucosa: <input type="text" id="Glucosa_QS" name="Glucosa_QS"> 
						Urea: <input type="text" id="Urea" name="Urea"> 
					 </p>
					 <p>
						Creatinina:<input type="text" id="Creatinina" name="Creatinina">
						Acido urico: <input type="text" id="Acido_Urico" name="Acido_Urico"> 
					 </p>
					 <p>
						Colesterol: <input type="text" id="Colesterol" name="Colesterol"> 
						Trigliceridos: <input type="text" id="Trigliceridos" name="Trigliceridos">
					 </p>
					 <p>
						B total: <input type="text" id="B_total" name="B_total">
						B directa: <input type="text" id="B_directa" name="B_directa">
						B indirecta: <input type="text" id="B_indirecta" name="B_indirecta">
					 </p>
					 <p>
						TGO: <input type="text" id="TGO" name="TGO">
						TGP: <input type="text" id="TGP" name="TGP">
					 </p>
					 <p>
						Amilasa: <input type="text" id="Amilasa" name="Amilasa">
						Lipasa: <input type="text" id="Lipasa" name="Lipasa">
            		 </p>
            		 <hr>
				<h2>EGO</h2>
  					 <p>
            			Densidad: <input type="text" id="Densidad" name="Densidad">
						PH: <input type="text" id="PH" name="PH">
					 </p>
					 <p>
						Celulas epiteliales: <input type="text" id="Celulas_Epiteliales" name="Celulas_Epiteliales">
						Cristales: <input type="text" id="Cristales" name="Cristales">
					 </p>
					 <p>
						Leucocitos: <input type="text" id="Leucocitos_EGO" name="Leucocitos_EGO">
						Eritrocitos: <input type="text" id="Eritrocitos_EGO" name="Eritrocitos_EGO">
					 </p>
					 <p>
						Glucosa: <input type="text" id="Glucosa_EGO" name="Glucosa_EGO">
						Bacterias: <input type="text" id="Bacterias" name="Bacterias">
            		 </p>
            		 <hr>
				<h2>Cultivos</h2>
  					 <textarea rows="20" cols="150" id="lab_cultivos" name="lab_cultivos"></textarea>
				<hr>
            	<hr size="2px" color="black">
            	<h1><strong>Gabinete</strong></h1>
            		<ul>
					<li><h2>Electrocardiogramas</h2></li>
						<input name="g6uploadedfile1" type="file" />
            			<input name="g6uploadedfile2" type="file" />
            			<input name="g6uploadedfile3" type="file" />
            			<input name="g6uploadedfile4" type="file" />
            			<input name="g6uploadedfile5" type="file" />
            			<input name="g6uploadedfile6" type="file" />
            			<input name="g6uploadedfile7" type="file" />
            			<input name="g6uploadedfile8" type="file" />
            			<input name="g6uploadedfile9" type="file" />
            			<input name="g6uploadedfile10" type="file" />
						<hr>
					<li><h2>Papanicolaou</h2></li>
						<textarea rows="20" cols="60" id="papanicolaou" name="papanicolaou"></textarea>
						<hr>
					<li><h2>Ultrasonidos</h2></li>
						<textarea rows="20" cols="60" id="ultrasonidos" name="ultrasonidos"></textarea>
						<hr>
					<li><h2>Rayos X</h2></li>
						<input name="g8uploadedfile1" type="file" />
            			<input name="g8uploadedfile2" type="file" />
            			<input name="g8uploadedfile3" type="file" />
            			<input name="g8uploadedfile4" type="file" />
            			<input name="g8uploadedfile5" type="file" />
            			<input name="g8uploadedfile6" type="file" />
            			<input name="g8uploadedfile7" type="file" />
            			<input name="g8uploadedfile8" type="file" />
            			<input name="g8uploadedfile9" type="file" />
            			<input name="g8uploadedfile10" type="file" />
						<hr>
					</ul>	
            	<hr size="2px" color="black">
            	<h1><strong>Imagen</strong></h1>
            		<input name="uploadedfile1" type="file" />
            		<input name="uploadedfile2" type="file" />
            		<input name="uploadedfile3" type="file" />
            		<input name="uploadedfile4" type="file" />
            		<input name="uploadedfile5" type="file" />
            		<input name="uploadedfile6" type="file" />
            		<input name="uploadedfile7" type="file" />
            		<input name="uploadedfile8" type="file" />
            		<input name="uploadedfile9" type="file" />
            		<input name="uploadedfile10" type="file" />
            	<br><br>
            	<input type="submit" value="Guardar nota">
			</form>
			<iframe name="guarda_paciente_nota" id="guarda_paciente_nota" src="vacia.html" width="100%" height="200" frameborder="0"></iframe>
		</section>
	</section>
</body>
</html>