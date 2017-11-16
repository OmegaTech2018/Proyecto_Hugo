<!DOCTYPE html>
<html>
<head>
	<title>Guarda Imagen</title>
</head>
<body>
	<?php
        require_once("../../coneccion.php");
        $sistema = new sistema();
        $sistema->conectar();
        $usuario=$sistema->recuperaPOST("usuario","Por favor inice sesión");
        $sql_imagen_id=sprintf("SELECT imagen_id FROM imagen 
                                     WHERE nota_id=(SELECT MAX(nota_id) FROM nota WHERE email='$usuario');");
        $sistema->enlaceBD->query($sql_imagen_id);
        $imagen_id=$sistema->getBD($sql_imagen_id,"imagen_id");
        //echo $electro_id;
        require_once("Imagen.php");
        require_once("conexion.php");
        $imagen = new Imagen($_FILES["imagen_1"]["tmp_name"], $_FILES["imagen_2"]["tmp_name"], 
                             $_FILES["imagen_3"]["tmp_name"], $_FILES["imagen_4"]["tmp_name"],
                             $_FILES["imagen_5"]["tmp_name"]
                             );
        $conect = new Conexion();
        $conect->insertaImagen($imagen,$imagen_id);
        echo "<center><strong>Las imágenes se han guardados con éxito.</strong></center>";
        die();         	
	?>
</body>
</html>