<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");

	
include("conexao.php");

if(!empty($_POST)){


	$insert = "INSERT INTO regiao VALUES (:id_regiao,:nome_regiao)";

	$stmt = $conexao->prepare($insert);

	$stmt->bindValue(":id_regiao",$_POST["ID_REGIAO"]);
	$stmt->bindValue(":nome_regiao",$_POST["NOME_REGIAO"]);
	

	$stmt->execute();
	
	echo "Região inserida com sucesso";
	
}
else{
	header("location: form_funcao.php");
}
?>