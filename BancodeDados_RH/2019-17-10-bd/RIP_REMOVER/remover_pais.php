<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	$c = new CabecalhoHTML();
	$c->exibe();
	
	include("conexao.php");
	
	$ID_PAIS = $_POST["ID_PAIS"];
	
	$delete = "DELETE FROM pais WHERE ID_PAIS=:id_pais";
	
	$stmt = $conexao->prepare($delete);
	

	$stmt->bindValue(":id_pais",$ID_PAIS);


	$stmt->execute();

	
	
	echo "País removido com sucesso!";
	
?>
<hr />
<a href='lista_pais.php'>Voltar Para a listagem</a>
</body>
</html>