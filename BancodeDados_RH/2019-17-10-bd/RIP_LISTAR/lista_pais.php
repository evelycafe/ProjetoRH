<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	

	include("conexao.php");
	
	$sql = "SELECT ID_PAIS,NOME_PAIS, NOME_REGIAO FROM 
					pais INNER JOIN regiao
				ON pais.ID_REGIAO=regiao.ID_REGIAO";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();
	
	echo "<table border='1'>";
	echo "<thead>
			<tr>
				<th>ID PAÍS</th>
				<th>NOME DO PAÍS</th>
				<th>NOME REGIÃO</th>			
				<th>AÇÃO</th>
			</tr>
		  </thead>
		  <tbody>
		  ";
	while($linha=$stmt->fetch()){
		echo "<tr>
				<td>".$linha["ID_PAIS"]."</td>
				<td>".$linha["NOME_PAIS"]."</td>
				<td>".$linha["NOME_REGIAO"]."</td>
				<td>
					<form method='post' action='remover_pais.php'>
						<input type='hidden' name='tabela' value='funcao' />
						<input type='hidden' name='id'  value='".$linha["ID_PAIS"]."' />
						<button>Remover</button>
					</form>
					
				</td>
		      </tr>";
	}
	echo "</tbody>
		</table>";
?>