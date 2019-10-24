<?php

	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	
	require_once("../classeForm/InterfaceExibicao.php");
	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeOption.php");
	require_once("../classeForm/classeSelect.php");
	require_once("../classeForm/classeForm.php");
	require_once("../classeForm/classeButton.php");

	include("conexao.php");
	
	//////////////		//////////////////		//////////////////
	
	if (isset($_POST["id"])) {
		require_once("classeControllerBD.php");
		
		$c = new ControllerBD($conexao);
		
		$colunas=array("id_departamento","nome_departamento","id_gerente","id_localizacao");
		$tabelas[0][0]="departamento";
		$tabelas[0][1]=null;
		$ordenacao = null;
		$condicao = $_POST["id"];
		
		$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$value_id_departamento = $linha["id_departamento"];
		$value_nome_departamento = $linha["nome_departamento"];
		$value_id_gerente = $linha["id_gerente"];
		$value_id_localizacao = $linha["id_localizacao"];
		
		$action = "altera.php?tabela=departamento";
	}
	
	else{
		$action = "insere.php?tabela=departamento";
		$value_id_departamento=null;
		$value_nome_departamento=null;
		$value_id_gerente=null;
		$value_id_localizacao=null;
	}
	
	/////////////////		///////////////		///////////////
	
	//seleção dos valores que irão criar o <select>//////
	$select = "SELECT ID_LOCALIZACAO AS value, ID_LOCALIZACAO AS texto FROM localizacao ORDER BY ID_LOCALIZACAO";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz[] = $linha;
	} 

	//////////////		//////////////////		//////////////

	$v = array("action"=>"insere.php?tabela=departamento","method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"text","name"=>"ID_DEPARTAMENTO","placeholder"=>"ID DO DEPARTAMENTO...", "value"=>$value_id_departamento);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"NOME_DEPARTAMENTO","placeholder"=>"NOME DO DEPARTAMENTO...", "value"=>$value_nome_departamento);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"ID_GERENTE","placeholder"=>"NOME DO DEPARTAMENTO...", "value"=>$value_id_gerente);
	$f->add_input($v);
	
	$v = array("name"=>"ID_LOCALIZACAO", "selected"=>"value_id_localizacao");
	$f->add_select($v,$matriz);
	
	
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
		<h3>Formulário - Inserir Localização</h3>

		<hr />
		<?php
			$f->exibe();
		?>
	</body>
</html>
</html>