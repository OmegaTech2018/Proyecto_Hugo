<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Registro Pasante</title>
        <meta charset="utf-8">
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <link href="css/validacionPasante.css" rel="stylesheet" type="text/css" href="validacionPasante.css" media="screen" /><!--DISEÑO DEL input password-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><!--EJECUTA EL CÓDIGO DE js/funciones.js-->
        <script src="js/funciones.js"></script><!--VALIDA LA CONTRASEÑA: 8 caracteres, una mayúscula y un dígito -->
    </head>
    <body>
        <section id="contenedor">
            <header><h1>FORMULARIO DE REGISTRO DE PASANTE</h1></header>
            <section id="formulario_registro">
                <form method="post" action="guardar_pasante.php" target="alta_pasante">
                    <p>Nombre:</p>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                    <br>
                    <p>Fecha de nacimiento:</p>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" step="1" requiered>
                    <br>
                    <p>Sexo:</p>
                    <select name="sexo" id="sexo" required="">
                        <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    <br>
                    <p>Escuela:</p>
                    <input type="text" id="escuela" name="escuela" placeholder="Ingresa el nombre de tu escuela" >
                    <br>
                    <p>Cargo:</p>
                    <select name="cargo" id="cargo" required="">
                        <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                        <option value="medico">Médico</option>
                        <option value="enfermera">Enfermera</option>
                        <option value="fisioterapeuta">Fisioterapeuta</option>
                    </select>
                    <br>
                    <p>Email:</p>
                    <input type="email" id="correo" name="correo" placeholder="Ingresa tu correo" required>
                    <br>
                    <p>Contraseña:</p>
                    <input type="password" id="contra" name="contra" placeholder="Ingresa tu contraseña" class="form-control form-control-red" required>
                    <div id = "mensajePsswLength" class = "error">8 caracteres mínimo. </div>
			        <div id = "mensajePsswMayusc" class = "error"> Al menos una letra mayúscula.</div>
			        <div id = "mensajePsswDigit" class = "error"> Al menos un dígito</div>
                    <br>
                    <p>Repite tu contraseña:</p>
                    <input type="password" id="contra2" name="contra2" placeholder="Ingresa de nuevo tu contraseña" required>
                    <br><br>
                    <input type="submit" value="Guardar Pasante">
                    <br>
                </form>
                <iframe name="alta_pasante" id="alta_pasante" src="vacia.html" width="100%" height="200" frameborder="0"></iframe>
            </section>
        </section>
    </body>
</html>