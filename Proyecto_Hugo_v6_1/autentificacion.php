<?php
	session_start();
	require_once("coneccion.php");
	$sistema = new sistema;
	$usuario=$sistema->recuperaPOST("email","Email es requerido");
	$pass=$sistema->recuperaPOST("password","Password es requerido");

	//echo $usuario." ".$pass

	/*QUERY CON LA QUE VERIFICO SI EL USUARIO EXISTE EN LA BASE DE DATOS*/
    $sql_num_usuario=sprintf("SELECT COUNT(email) AS num_paciente FROM pasante WHERE email='$usuario' AND clave='$pass';");
    $sistema->conectar();/*ACCEDO AL METODO conectar DE LA CLASE SISTEMA PARA COMPROBAR SI EL USUARIO EXISTE*/
    $num_usuario=$sistema->getBD($sql_num_usuario,"num_paciente");/*CON EL METODO getBD DE LA CLASE SISTEMA, EJECUTO LA QUERY Y OBTENGO EL NÚMERO DE USUARIO*/
    //echo $num_usuario;

    if($num_usuario==1){
    	$sql_nombre_pasante=sprintf("SELECT nombre FROM pasante WHERE email='$usuario';");
    	$nombre_pasante=$sistema->getBD($sql_nombre_pasante,"nombre");
    	//echo $nombre_pasante;
    	$_SESSION["activo"]=1;
    	$_SESSION["usuario"]=$usuario;/*email*/
    	$_SESSION["nombre_pasante"]=$nombre_pasante;
    	$_SESSION["sistema"]=$sistema;

    	//echo $_SESSION["usuario"]." ".$pass." ".$_SESSION["nombre_pasante"];
    	header('Location:bienvenido.php');
    }else{
    	header('Location:error.html');
    	$sistema->desconectar();
    }
?>