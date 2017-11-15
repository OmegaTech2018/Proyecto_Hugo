<?php 
    class sistema{
        
        var $usuarioBD='root';
        var $claveBD='root';
        var $servidorBD='127.0.0.1';
        var $nombreBD='b9_20505183_pacientes_centro_salud_mihualtepec';
        var $enlaceBD=null;
        
        
        
        /*
        var $usuarioBD='b9_20505183';
        var $claveBD='hulk_1988';
        var $servidorBD='sql303.byethost9.com';
        var $nombreBD='b9_20505183_pacientes_centro_salud_mihualtepec';
        var $enlaceBD=null;
        */
        
        /*FUNCIÓN PARA CONECTARSE A LA BASE DE DATOS*/
        function conectar(){
            $this->enlaceBD=new mysqli($this->servidorBD,$this->usuarioBD,$this->claveBD,$this->nombreBD);
            if(mysqli_connect_errno()){
                printf("Error en la conexión a la base de datos: %s/n", mysqli_connect_error());
            }
        }
        /*TERMINA FUNCIÓN PARA CONECTARSE A LA BASE DE DATOS*/

        /*FUNCIÓN PARA DESCONECTARSE DE LA BASE DE DATOS*/
        function desconectar(){
            if($this->enlaceBD){
                mysqli_close($this->enlaceBD);
            }
        }
        /*TERMINA FUNCIÓN PARA DESCONECTARSE DE LA BASE DE DATOS*/

        /*FUNCIÓN PARA RECUPERAR LOS DATOS ENVIADOS POR MEDIO DEL METODO POST*/
        function recuperaPOST($variable,$aviso="No se pudo recuperar la variable."){
            if(isset($_POST[$variable])){
                if($_POST[$variable]!=""){
                    return $_POST[$variable];/*REGRESA LA VARIABLE QUE FUE ENVIADA POR POST*/
                }else{
                    die($aviso);
                }
            }else{
                die($aviso);
            }
        }
        /*TERMINA FUNCIÓN PARA RECUPERAR LOS DATOS ENVIADOS POR MEDIO DEL METODO POST*/

        /*FUNCIÓN QUE SE ENCARGA DE OBTENER LOS DATOS DE LA BD AL EJECUTAR UNA QUERY*/
        function getBD($sql,$columna){
            $valor=null;
            if($result=$this->enlaceBD->query($sql)){
                while($row=$result->fetch_assoc()){
                    $valor=$row[$columna];
                }
                $result->close();
            }else{
                echo $this->enlaceBD->error;
            }
            return $valor;
        }
        /*TERMINA FUNCIÓN QUE SE ENCARGA DE OBTENER LOS DATOS DE LA BD AL EJECUTAR UNA QUERY*/
    }
?>