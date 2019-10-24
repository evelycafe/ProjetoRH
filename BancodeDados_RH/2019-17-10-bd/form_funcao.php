<?php

	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	
	require_once("../classeForm/InterfaceExibicao.php");
	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeButton.php");
	require_once("../classeForm/classeForm.php");
	
	/////////////		////////////////////		//////////

	if(isset($_POST["id"])){
		require_once("conexao.php");
		require_once("classeControllerBD.php");
		
		$c = new ControllerBD($conexao);
		
		$colunas=array("id_funcao","titulo_funcao","salario_minimo","salario_maximo");
		$tabelas[0][0]="funcao";
		$tabelas[0][1]=null;
		$ordenacao = null;
		$condicao = $_POST["id"];
		
		$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$value_id_funcao = $linha["id_funcao"];
		$value_titulo_funcao = $linha["titulo_funcao"];
		$value_salario_minimo = $linha["salario_minimo"];
		$value_salario_maximo = $linha["salario_maximo"];
		
		$action = "altera.php?tabela=funcao";
	}
	else{
		$action = "insere.php?tabela=funcao";
		$value_id_funcao=null;
		$value_titulo_funcao=null;
		$value_salario_minimo=null;
		$value_salario_maximo=null;
	}
	
	/////////////////		/////////////////		///////////

	$v = array("action"=>"insere.php?tabela=funcao","method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"text","name"=>"ID_FUNCAO","placeholder"=>"ID DA FUNÇÃO...","value"=>$value_id_funcao);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"TITULO_FUNCAO","placeholder"=>"TÍTULO DA FUNÇÃO...","value"=>$value_titulo_funcao);
	$f->add_input($v);
	$v = array("type"=>"number","name"=>"SALARIO_MINIMO","placeholder"=>"SALÁRIO MÍNIMO...","value"=>$value_salario_minimo);
	$f->add_input($v);
	$v = array("type"=>"number","name"=>"SALARIO_MAXIMO","placeholder"=>"SALÁRIO MÁXIMO...","value"=>$value_salario_maximo);
	$f->add_input($v);
	
	$v = array("texto"=>"ENVIAR");
	$f->add_button($v);	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<style> input{margin:4px;}</style>
	</head>
	<body>
		<h3>Formulário - Inserir Função</h3>

		<hr />
		<?php
			$f->exibe();
		?>
	</body>
</html>
</html>