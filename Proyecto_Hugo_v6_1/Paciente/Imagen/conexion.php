<?php
	class Conexion{
		
//        const usuarioBD='b9_20505183';
//        const claveBD='hulk_1988';
//        const servidorBD='sql303.byethost9.com';
//        const nombreBD='b9_20505183_pacientes_centro_salud_mihualtepec';
        
      
        const usuarioBD='root';
        const claveBD='root';
        const servidorBD='127.0.0.1';
        const nombreBD='b9_20505183_pacientes_centro_salud_mihualtepec';
        

        
        public function __construct(){
        	$constr=sprintf("mysql:host=%s;dbname=%s;charset=utf8", self::servidorBD, self::nombreBD);
        	try{
        		$this->pdo=new PDO($constr, self::usuarioBD, self::claveBD);
        	}catch(PDOException $e){
        		echo $e->getMessage();
        	}
        }

        public function __destruct(){
        	$this->pdo=null;
        }

        /*FUNCION QUE GUARDA LAS IMAGENES DE LAS IMAGENES DE LA NOTA*/
        public function insertaImagen($imagen,$imagen_id){
        	$file1=$imagen->getimagen_1();
        	$file2=$imagen->getimagen_2();
        	$file3=$imagen->getimagen_3();
        	$file4=$imagen->getimagen_4();
        	$file5=$imagen->getimagen_5();
        	$blob1=fopen($file1, 'rb');
        	$blob2=fopen($file2, 'rb');
        	$blob3=fopen($file3, 'rb');
        	$blob4=fopen($file4, 'rb');
        	$blob5=fopen($file5, 'rb');

        	$stm=$this->pdo->prepare("UPDATE imagen SET imagen_1=:datosF1,imagen_2=:datosF2,imagen_3=:datosF3,
                                      imagen_4=:datosF4,imagen_5=:datosF5,bandera=1 
                                      WHERE imagen_id=$imagen_id;");
        	$stm->bindParam(':datosF1',$blob1, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF2',$blob2, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF3',$blob3, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF4',$blob4, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF5',$blob5, PDO::PARAM_LOB);
        	return $stm->execute();
        }

        

        public function listarImagen($imagen_id){
                $stm = $this->pdo->prepare("SELECT imagen_1,imagen_2,imagen_3,imagen_4,imagen_5 FROM imagen 
                                            WHERE imagen_id=$imagen_id;");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
        }


        }
?>