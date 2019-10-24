<?php

	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	
	require_once("../classeForm/InterfaceExibicao.php");
	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeSelect.php");
	require_once("../classeForm/classeOption.php");
	require_once("../classeForm/classeButton.php");
	require_once("../classeForm/classeForm.php");
	
	include("conexao.php");
	
	///////////////////		/////////////////////		//////////////
	
	if (isset($_POST["id"])) {
		require_once("classeControllerBD.php");
		
		$c = new ControllerBD($conexao);
		
		$colunas=array("id_funcionario","nome","sobrenome","email","telefone","data_contratacao","id_funcao","salario","comissao","id_gerente","id_departamento");
		$tabelas[0][0]="funcionario";
		$tabelas[0][1]=null;
		$ordenacao = null;
		$condicao = $_POST["id"];
		
		$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$value_id_funcionario = $linha["id_funcionario"];
		$value_nome = $linha["nome"];
		$value_sobrenome = $linha["sobrenome"];
		$value_email = $linha["email"];
		$value_telefone = $linha["telefone"];
		$value_data_contratacao = $linha["data_contratacao"];
		$value_id_funcao = $linha["id_funcao"];
		$value_salario = $linha["salario"];
		$value_comissao = $linha["comissao"];
		$value_id_gerente = $linha["id_gerente"];
		$value_id_departamento = $linha["id_departamento"];
		
		$action = "altera.php?tabela=funcionario";
	}
	
	else{
		$action = "insere.php?tabela=funcionario";
		$value_id_funcionario=null;
		$value_nome=null;
		$value_sobrenome=null;
		$value_email=null;
		$value_telefone=null;
		$value_data_contratacao=null;
		$value_id_funcao=null;
		$value_salario=null;
		$value_comissao=null;
		$value_id_gerente=null;
		$value_id_departamento=null;
	}
	
	///////////////		//////////////		//////////////
	$select = "SELECT ID_FUNCAO AS value, TITULO_FUNCAO AS texto FROM funcao ORDER BY TITULO_FUNCAO";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_funcao[] = $linha;
	}	
	////////////////////////////////////////////////////
	
	$select = "SELECT ID_FUNCIONARIO AS value, CONCAT(SOBRENOME,', ',NOME) AS texto FROM funcionario ORDER BY SOBRENOME, NOME";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_gerente[] = $linha;
	}	
	////////////////////////////////////////////////////	
	
	$select = "SELECT ID_DEPARTAMENTO AS value, NOME_DEPARTAMENTO AS texto FROM departamento ORDER BY NOME_DEPARTAMENTO";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_departamento[] = $linha;
	}	
	
	///////////////		/////////////////		////////////////////	

	$v = array("action"=>"insere.php?tabela=funcionario","method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"text","name"=>"ID_FUNCIONARIO","placeholder"=>"SIGLA...", "value"=>$value_id_funcionario);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"NOME","placeholder"=>"NOME...","value"=>$value_nome);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"SOBRENOME","placeholder"=>"SOBRENOME...","value"=>$value_sobrenome);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"EMAIL","placeholder"=>"EMAIL...","value"=>$value_email);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"TELEFONE","placeholder"=>"TELEFONE...","value"=>$value_telefone);
	$f->add_input($v);
	$v = array("type"=>"date","label"=>"Data Contratação: ", "name"=>"DATA_CONTRATACAO","placeholder"=>"DATA CONTRATAÇÃO...","value"=>$value_data_contratacao);
	$f->add_input($v);
	
	$v = array("name"=>"ID_FUNCAO","selected"=>"value_id_funcao");
	$f->add_select($v,$matriz_funcao);
	
	$v = array("type"=>"number","name"=>"SALARIO","placeholder"=>"SALÁRIO...","value"=>$value_salario);
	$f->add_input($v);

	$v = array("type"=>"number","name"=>"COMISSAO","placeholder"=>"COMISSÃO (DE 0 A 50%)...","value"=>$value_comissao);
	$f->add_input($v);	

	$v = array("name"=>"ID_GERENTE","selected"=>"value_id_gerente");
	$f->add_select($v,$matriz_gerente);

	$v = array("name"=>"ID_DEPARTAMENTO","selected"=>"value_id_departamento");
	$f->add_select($v,$matriz_departamento);

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
		<h3>Formulário - Inserir Funcionário</h3>

		<hr />
		<?php
			$f->exibe();

		?>
	</body>
</html>
</html>