<?php
	class Imagen{
		private $imagen_1;
		private $imagen_2;
		private $imagen_3;
		private $imagen_4;
		private $imagen_5;

		function Imagen($imagen_1,$imagen_2,$imagen_3,$imagen_4,$imagen_5){
			$this->imagen_1 = $imagen_1;
			$this->imagen_2 = $imagen_2;
			$this->imagen_3 = $imagen_3;
			$this->imagen_4 = $imagen_4;
			$this->imagen_5 = $imagen_5;
		}

		function setimagen_1($imagen_1){
			$this->imagen_1 = $imagen_1;
		}

		function getimagen_1(){
			return $this->imagen_1;
		}

		function setimagen_2($imagen_2){
			$this->imagen_2 = $imagen_2;
		}

		function getimagen_2(){
			return $this->imagen_2;
		}

		function setimagen_3($imagen_3){
			$this->imagen_3 = $imagen_3;
		}

		function getimagen_3(){
			return $this->imagen_3;
		}

		function setimagen_4($imagen_4){
			$this->imagen_4 = $imagen_4;
		}

		function getimagen_4(){
			return $this->imagen_4;
		}

		function setimagen_5($imagen_5){
			$this->imagen_5 = $imagen_5;
		}

		function getimagen_5(){
			return $this->imagen_5;
		}		
	}
?>