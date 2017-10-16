<?php
	require_once("coneccion.php");

    $sistema = new sistema();
    $sistema->conectar();
	
	$sql_cargo=sprintf("SELECT cargo_id, nombre_cargo FROM cargo;");
	$resultado_cargo=$sistema->enlaceBD->query($sql_cargo);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Registro Pasante</title>
		<meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html" charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <link href="css/validacionPasante.css" rel="stylesheet" type="text/css" href="validacionPasante.css" media="screen" /><!--DISEÑO DEL input password-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><!--EJECUTA EL CÓDIGO DE js/funciones.js-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/funciones.js"></script><!--VALIDA LA CONTRASEÑA: 8 caracteres, una mayúscula y un dígito -->
        <script src="js/valida_contra.js"></script><!--VALIDA LAS DOS CONTRASEÑAS -->
        <script src="js/limpiar.js"></script><!--LIMPIA EL FORMULARIO -->
    </head>
    <body>
       
        <section id="contenedor">
            <header><h1>FORMULARIO DE REGISTRO DE PASANTE</h1></header>
            <section id="formulario_registro">
                <form method="post" action="guardar_pasante.php" id="form-clave" name="mi_formulario" onSubmit="return validar_clave()" target="alta_pasante">
                    <p>Nombre:</p>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required="required">
                    <br>
                    <p>Fecha de nacimiento:</p>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" step="1" requiered="required">
                    <br>
                    <p>Sexo:</p>
                    <div class="select">
                        <select name="sexo" id="sexo" required="">
                            <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <br>
                    <p>Escuela:</p>
                    <input type="text" id="escuela" name="escuela" placeholder="Ingresa el nombre de tu escuela" required="required">
                    <br>
                    <p>Cargo:</p>
                    <div class="select">
                        <select name="cargo" id="cargo" name="cargo" required="required">
                        <option value=""></option>
                        <?php 
                            while($reg_cargo=$resultado_cargo->fetch_object()){
                                echo "
                                    <option value=\"$reg_cargo->cargo_id\">$reg_cargo->nombre_cargo</option>
                                ";
                            }
                        ?>
                        </select>
                    </div>
                    <br>
                    <p>Email:</p>
                    <input type="email" id="correo" name="correo" placeholder="Ingresa tu correo" required="required">
                    <br>
                    <p>Contraseña:</p>
                    <input type="password" id="contra" name="contra" placeholder="Ingresa tu contraseña" maxlength="12" size="25" class="form-control form-control-red" required="required">
                    <div id = "mensajePsswLength" class = "error">8 caracteres mínimo. </div>
                    <div id = "mensajePsswMayusc" class = "error"> Al menos una letra mayúscula.</div>
                    <div id = "mensajePsswDigit" class = "error"> Al menos un dígito</div>
                    <br>
                    <p>Repite tu contraseña:</p>
                    <input type="password" id="contra2" name="contra2" placeholder="Ingresa de nuevo tu contraseña" maxlength="12" size="25" required="required">
                    <br><br>
                    <input type="submit" value="Guardar Pasante">
                    <input type="button" onclick="Clean()" value="Limpiar campos">
                    <br>
                </form>
                <iframe name="alta_pasante" id="alta_pasante" src="vacia.html" width="100%" height="200" frameborder="0"></iframe>
            </section>
        </section>
    </body>
</html>		