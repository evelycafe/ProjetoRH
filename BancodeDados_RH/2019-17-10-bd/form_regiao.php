<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	
	require_once("../classeForm/InterfaceExibicao.php");
	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeForm.php");
	require_once("../classeForm/classeButton.php");

	/////////////		////////////////////		//////////

	if(isset($_POST["id"])){
		require_once("conexao.php");
		require_once("classeControllerBD.php");
		
		$c = new ControllerBD($conexao);
		
		$colunas=array("id_regiao","nome_regiao");
		$tabelas[0][0]="regiao";
		$tabelas[0][1]=null;
		$ordenacao = null;
		$condicao = $_POST["id"];
		
		$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$value_id_regiao = $linha["id_regiao"];
		$value_nome_regiao = $linha["nome_regiao"];
		
		$action = "altera.php?tabela=regiao";
	}
	else{
		$action = "insere.php?tabela=regiao";
		$value_id_regiao=null;
		$value_nome_regiao=null;
	}
	
	/////////////////		/////////////////		///////////

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_REGIAO","placeholder"=>"ID DA REGIÃO...","value"=>$value_id_regiao);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"NOME_REGIAO","placeholder"=>"NOME DA REGIÃO...","value"=>$value_nome_regiao);
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
		<h3>Formulário - Inserir Região</h3>

		<hr />
		<?php
			$f->exibe();
		?>
	</body>
</html>
</html>