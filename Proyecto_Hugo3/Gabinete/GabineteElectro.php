<?php
	class GabineteElectro{
		private $gelectro1;
		private $gelectro2;
		private $gelectro3;
		private $gelectro4;
		private $gelectro5;
		private $gelectro6;

		function GabineteElectro($gelectro1,$gelectro2,$gelectro3,$gelectro4,$gelectro5,$gelectro6){
			$this->gelectro1 = $gelectro1;
			$this->gelectro2 = $gelectro2;
			$this->gelectro3 = $gelectro3;
			$this->gelectro4 = $gelectro4;
			$this->gelectro5 = $gelectro5;
			$this->gelectro6 = $gelectro6;
		}

		function setGelectro1($gelectro1){
			$this->gelectro1 = $gelectro1;
		}

		function getGelectro1(){
			return $this->gelectro1;
		}

		function setGelectro2($gelectro2){
			$this->gelectro2 = $gelectro2;
		}

		function getGelectro2(){
			return $this->gelectro2;
		}

		function setGelectro3($gelectro3){
			$this->gelectro3 = $gelectro3;
		}

		function getGelectro3(){
			return $this->gelectro3;
		}

		function setGelectro4($gelectro4){
			$this->gelectro4 = $gelectro4;
		}

		function getGelectro4(){
			return $this->gelectro4;
		}

		function setGelectro5($gelectro5){
			$this->gelectro5 = $gelectro5;
		}

		function getGelectro5(){
			return $this->gelectro5;
		}

		function setGelectro6($gelectro6){
			$this->gelectro6 = $gelectro6;
		}

		function getGelectro6(){
			return $this->gelectro6;
		}		
	}
?>