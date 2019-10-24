<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	
	
include("conexao.php");

if(!empty($_POST)){

	$ID_PAIS=$_POST["ID_PAIS"];
	$NOME_PAIS=$_POST["NOME_PAIS"];
	$ID_REGIAO=$_POST["ID_REGIAO"];

	$insert = "INSERT INTO pais VALUES (:id_pais,:nome_pais,:id_regiao)";

	$stmt = $conexao->prepare($insert);

	$stmt->bindValue(":id_pais",$ID_PAIS);
	$stmt->bindValue(":nome_pais",$NOME_PAIS);
	$stmt->bindValue(":id_regiao",$ID_REGIAO);

	$stmt->execute();
	
	echo "País inserido com sucesso";
	
}
else{
	header("location: form_pais.php");
}
?>