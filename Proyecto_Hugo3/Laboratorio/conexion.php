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


        }
?>