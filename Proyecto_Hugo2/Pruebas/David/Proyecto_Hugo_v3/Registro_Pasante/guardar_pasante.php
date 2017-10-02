<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro Pasante</title>
    <meta charset="utf-8">
    <link href="css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php 
    require_once("coneccion.php");

    $sistema = new sistema();
    $sistema->conectar();
    $nombre=$sistema->recuperaPOST("nombre","Usuario es requerido");/*ACCEDO AL METODO recuperaPOST DE LA CLASE SISTEMA PARA VERIFICAR QUE EL USUARIO INGRESO SU NOMBRE*/
    $fecha_nacimiento=$sistema->recuperaPOST("fecha_nacimiento","La fecha de nacimiento del pasante es requerida");
    $sexo=$sistema->recuperaPOST("sexo","El sexo es requerido");
    $escuela=$sistema->recuperaPOST("escuela","El nombre de la escuela del pasante es requerido");
    $cargo_id=$sistema->recuperaPOST("cargo","El cargo del pasante es requerido");
	$correo=$sistema->recuperaPOST("correo","El correo electrónico del pasante es requerido");
    $clave=$sistema->recuperaPOST("contra","La contraseña es requerida");
    $clave2=$sistema->recuperaPOST("contra2","La contraseña es requerida");
    //echo $nombre.",".$fecha_nacimiento.",".$sexo.",".$escuela.",".$cargo_id.",".$correo.",".$clave.",".$clave2;
?>

<?php
    $sql_guardar_pasante=sprintf("INSERT INTO pasante(nombre, fecha_nacimiento, sexo, escuela, cargo_id,email, clave, activo)
                                  VALUES('$nombre','$fecha_nacimiento','$sexo','$escuela','$cargo_id','$correo','$clave',1);");
    if($sistema->enlaceBD->query($sql_guardar_pasante)){
        echo "<center><strong>Datos guardados con éxito.</strong></center>";
    }else{
        if(substr_count(mysqli_error($sistema->enlaceBD), "Duplicate")){
            echo "<center><strong>El pasante ya se ha guardado.</strong></center>";
        }else{
            echo "<center><strong>Error al guardar<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
        }
    }
    $sistema->desconectar();
?>
</body>
</html>