<!DOCTYPE html>
<html>
<head>
	<title>Eliminar Nota</title>
</head>
<body>
	<?php
		require_once("coneccion.php");
		$sistema = new sistema();
        $sistema->conectar();
        $nota_id=$_POST['nota_id'];
        //echo $nota_id;
        $sql_baja_nota=sprintf("UPDATE nota SET nota_activa=0 WHERE nota_id=$nota_id;");
        if($sistema->enlaceBD->query($sql_baja_nota)){
            echo "<center>
                        <strong>La nota se ha eliminado con éxito.</strong>
                   </center>";
        }else{
            echo "<center><strong>Error al eliminar la nota<br>Por favor vuelve a intentarlo en 30 segundos.</strong></center>";
        }
        $sistema->desconectar();
	?>
</body>
</html>