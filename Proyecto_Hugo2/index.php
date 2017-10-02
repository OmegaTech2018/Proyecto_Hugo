<!doctype html>
<html lang="es">
<head>

	<meta charset="utf-8">

	<title>Login</title>

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
	<link rel="stylesheet" href="css/estilo.css" type="text/css">
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>

	<div id="login">

		<h2><span class="fontawesome-lock"></span>Ingrese sus datos</h2>

		<form action="autentificacion.php" method="POST">

			<fieldset>

				<p><label for="email">Correo electrónico</label></p>
				<p><input type="email" id="email" name="email" placeholder="mail@address.com" onBlur="if(this.value=='')this.value='mail@address.com'" onFocus="if(this.value=='mail@address.com')this.value=''" required="required"></p> 

				<p><label for="password">Contraseña</label></p>
				<p><input type="password" id="password" name="password" placeholder="password" onBlur="if(this.value=='')this.value='password'" onFocus="if(this.value=='password')this.value=''" required="required"></p>

				<p><input type="submit" value="Login"></p>

			</fieldset>

		</form>

	</div> <!-- end login -->

</body>	
</html>