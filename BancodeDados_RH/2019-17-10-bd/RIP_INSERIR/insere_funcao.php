<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");	
	
include("conexao.php");

if(!empty($_POST)){

	$ID_FUNCAO=$_POST["ID_FUNCAO"];
	$TITULO_FUNCAO=$_POST["TITULO_FUNCAO"];
	$SALARIO_MINIMO=$_POST["SALARIO_MINIMO"];
	$SALARIO_MAXIMO=$_POST["SALARIO_MAXIMO"];


	$insert = "INSERT INTO funcao VALUES (:id_funcao,:titulo_funcao,:salario_minimo,:salario_maximo)";

	$stmt = $conexao->prepare($insert);

	$stmt->bindValue(":id_funcao",$ID_FUNCAO);
	$stmt->bindValue(":titulo_funcao",$TITULO_FUNCAO);
	$stmt->bindValue(":salario_minimo",$SALARIO_MINIMO);
	$stmt->bindValue(":salario_maximo",$SALARIO_MAXIMO);

	$stmt->execute();
	
	echo "Função inserida com sucesso";
	
}
else{
	header("location: form_funcao.php");
}
?>