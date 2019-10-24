<?php
	require_once("InterfaceExibicao.php");
	
	class Button implements Exibicao{
		private $texto;
		
		public function __construct($vetor){
			$this->texto = $vetor["texto"];
		}
		
		public function exibe(){
			echo "<button>$this->texto</button>";
		}
		
	}
?>