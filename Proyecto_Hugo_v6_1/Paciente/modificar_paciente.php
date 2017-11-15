<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro Pasante</title>
    <meta charset="utf-8">
    <link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php 
    require_once("../coneccion.php");

    $sistema = new sistema();
    $sistema->conectar();
    $paciente_id=$sistema->recuperaPOST("paciente_id","Id del paciente es requerido");
    $Nombre=$sistema->recuperaPOST("nombre","Nombre es requerido");
    $Ap_Paterno=$sistema->recuperaPOST("ap_paterno","Apellido Paterno es requerido");
    $Ap_Materno=$sistema->recuperaPOST("ap_materno","Apellido Materno es requerido");
    $Edad=$sistema->recuperaPOST("edad","Edad es requerida");
    $Embarazo=$sistema->recuperaPOST("embarazo","Embarazo es requerido");
    $Recien_nacido=$sistema->recuperaPOST("recien_nacido","Recien nacido es requerido");
    $Telefono=$sistema->recuperaPOST("telefono","Telefono es requerido");

    //echo $paciente_id." ".$Nombre.",".$Ap_Paterno.",".$Ap_Materno.",".$Edad.",".$Domicilio.",".$Embarazo.",".$Recien_nacido.",".$Telefono;
?>

<?php
    $sql_actualiza_paciente=sprintf("UPDATE paciente SET apellido_paterno='$Ap_Paterno', apellido_materno='$Ap_Materno', nombre='$Nombre',
        edad_paciente='$Edad', embarazo='$Embarazo', recien_nacido='$Recien_nacido', telefono='$Telefono' 
        WHERE paciente_id=$paciente_id;");
    if($sistema->enlaceBD->query($sql_actualiza_paciente)){
        echo "<center><strong>Datos actualizados con éxito.</strong></center>";
    }else{
        echo "<center><strong>Error al actualizar datos del paciente<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
    }
    $sistema->desconectar();
?>
</body>
</html>