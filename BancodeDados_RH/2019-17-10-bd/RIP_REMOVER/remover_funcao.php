<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	$c = new CabecalhoHTML();
	$c->exibe();
	
	include("conexao.php");
	
	$ID_FUNCAO = $_POST["ID_FUNCAO"];
	
	$delete = "DELETE FROM funcao WHERE ID_FUNCAO=:id_funcao";
	
	$stmt = $conexao->prepare($delete);
	

	$stmt->bindValue(":id_funcao",$ID_FUNCAO);


	$stmt->execute();

	
	
	echo "Função removida com sucesso!";
	
?>
<hr />
<a href='lista_funcao.php'>Voltar Para a listagem</a>
</body>
</html>