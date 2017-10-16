<?php
	class Conexion{
		
        const usuarioBD='b9_20505183';
        const claveBD='hulk_1988';
        const servidorBD='sql303.byethost9.com';
        const nombreBD='b9_20505183_pacientes_centro_salud_mihualtepec';
        
        /*
		const usuarioBD='root';
        const claveBD='arturo';
        const servidorBD='127.0.0.1';
        const nombreBD='paciente_centro_salud_mihualtepec';
        */
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

        /*FUNCION QUE GUARDA LAS IMAGENES DEL GABINETE ELECTROCARDIOGRAMA*/
        public function insertaGabinete($gabinete,$electro_id){
        	$file1=$gabinete->getGelectro1();
        	$file2=$gabinete->getGelectro2();
        	$file3=$gabinete->getGelectro3();
        	$file4=$gabinete->getGelectro4();
        	$file5=$gabinete->getGelectro5();
        	$file6=$gabinete->getGelectro6();
        	$blob1=fopen($file1, 'rb');
        	$blob2=fopen($file2, 'rb');
        	$blob3=fopen($file3, 'rb');
        	$blob4=fopen($file4, 'rb');
        	$blob5=fopen($file5, 'rb');
        	$blob6=fopen($file6, 'rb');

        	$stm=$this->pdo->prepare("UPDATE gabinete_electrocardiogramas SET gelectro1=:datosF1,gelectro2=:datosF2,gelectro3=:datosF3,
                                      gelectro4=:datosF4,gelectro5=:datosF5,gelectro6=:datosF6,bandera=1 
                                      WHERE gabinete_electrocardiogramas_id=$electro_id;");
        	$stm->bindParam(':datosF1',$blob1, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF2',$blob2, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF3',$blob3, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF4',$blob4, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF5',$blob5, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF6',$blob6, PDO::PARAM_LOB);
        	return $stm->execute();
        }

        /*FUNCION QUE GUARDA LAS IMAGENES DEL GABINETE RAYOS X*/
        public function insertaRayosX($rayosx,$rayosx_id){
        	$file1=$rayosx->getrayosxi_1();
        	$file2=$rayosx->getrayosxi_2();
        	$file3=$rayosx->getrayosxi_3();
        	$file4=$rayosx->getrayosxi_4();
        	$file5=$rayosx->getrayosxi_5();
        	$file6=$rayosx->getrayosxi_6();
            $file7=$rayosx->getrayosxi_7();
            $file8=$rayosx->getrayosxi_8();
            $file9=$rayosx->getrayosxi_9();
            $file10=$rayosx->getrayosxi_10();
        	$blob1=fopen($file1, 'rb');
        	$blob2=fopen($file2, 'rb');
        	$blob3=fopen($file3, 'rb');
        	$blob4=fopen($file4, 'rb');
        	$blob5=fopen($file5, 'rb');
        	$blob6=fopen($file6, 'rb');
            $blob7=fopen($file7, 'rb');
            $blob8=fopen($file8, 'rb');
            $blob9=fopen($file9, 'rb');
            $blob10=fopen($file10, 'rb');

        	$stm=$this->pdo->prepare("UPDATE gabinete_rayosx SET rayosxi_1=:datosF1,rayosxi_2=:datosF2,rayosxi_3=:datosF3,rayosxi_4=:datosF4,
                                      rayosxi_5=:datosF5,rayosxi_6=:datosF6,rayosxi_7=:datosF7,rayosxi_8=:datosF8,
                                      rayosxi_9=:datosF9,rayosxi_10=:datosF10,bandera=1 WHERE gabinete_rayosx_id=$rayosx_id;");
        	$stm->bindParam(':datosF1',$blob1, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF2',$blob2, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF3',$blob3, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF4',$blob4, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF5',$blob5, PDO::PARAM_LOB);
        	$stm->bindParam(':datosF6',$blob6, PDO::PARAM_LOB);
            $stm->bindParam(':datosF7',$blob7, PDO::PARAM_LOB);
            $stm->bindParam(':datosF8',$blob8, PDO::PARAM_LOB);
            $stm->bindParam(':datosF9',$blob9, PDO::PARAM_LOB);
            $stm->bindParam(':datosF10',$blob10, PDO::PARAM_LOB);
        	return $stm->execute();
        }

        public function listarElectro($electro_id){
                $stm = $this->pdo->prepare("SELECT gelectro1,gelectro2,gelectro3,gelectro4,gelectro5,gelectro6 FROM gabinete_electrocardiogramas 
                                            WHERE gabinete_electrocardiogramas_id=$electro_id;");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listarRayosX($rayosx_id){
                $stm = $this->pdo->prepare("SELECT rayosxi_1,rayosxi_2,rayosxi_3,rayosxi_4,rayosxi_5,rayosxi_6,rayosxi_7,rayosxi_8,rayosxi_9,
                                            rayosxi_10 FROM gabinete_rayosx WHERE gabinete_rayosx_id=$rayosx_id;");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_ASSOC);
        }


        }
?>