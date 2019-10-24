<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	$c = new CabecalhoHTML();
	$c->exibe();
	
	include("conexao.php");
	
	$ID_REGIAO = $_POST["ID_REGIAO"];
	
	$delete = "DELETE FROM regiao WHERE ID_REGIAO=:id_regiao";
	
	$stmt = $conexao->prepare($delete);
	

	$stmt->bindValue(":id_regiao",$ID_REGIAO);


	$stmt->execute();

	
	
	echo "Região removida com sucesso!";
	
?>
<hr />
<a href='lista_regiao.php'>Voltar Para a listagem</a>
</body>
</html>