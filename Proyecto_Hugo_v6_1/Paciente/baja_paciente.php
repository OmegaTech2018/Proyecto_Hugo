<!DOCTYPE html>
<html>
<head>
    <title>Baja Paciente</title>
</head>
<body>
    <?php
        require_once("../coneccion.php");

        $sistema = new sistema();
        $sistema->conectar();
        $paciente_id=$_POST['paciente_id'];
        //echo $paciente_id;

        $sql_baja_pasante=sprintf("UPDATE paciente SET paciente_activo=0 WHERE paciente_id=$paciente_id;");
        if($sistema->enlaceBD->query($sql_baja_pasante)){
            echo "<center>
                        <strong>El paciente se ha eliminado con éxito.</strong>
                   </center>";
        }else{
            echo "<center><strong>Error al eliminar al paciente<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
        }
        $sistema->desconectar();
    ?>
</body>
</html>