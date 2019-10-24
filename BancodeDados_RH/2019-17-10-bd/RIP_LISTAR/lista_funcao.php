<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	
	include("conexao.php");
	
	$sql = "SELECT * FROM funcao ORDER BY TITULO_FUNCAO";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();
	
	echo "<table border='1'>";
	echo "<thead>
			<tr>
				<th>ID FUNÇÃO</th>
				<th>TÍTULO DA FUNÇÃO</th>
				<th>SALÁRIO MÍNIMO</th>
				<th>SALÁRIO MÁXIMO</th>
				<th>AÇÃO</th>
			</tr>
		  </thead>
		  <tbody>
		  ";
	while($linha=$stmt->fetch()){
		echo "<tr>
				<td>".$linha["ID_FUNCAO"]."</td>
				<td>".$linha["TITULO_FUNCAO"]."</td>
				<td>".$linha["SALARIO_MINIMO"]."</td>
				<td>".$linha["SALARIO_MAXIMO"]."</td>
				<td>
					<form method='post' action='remover.php'>
						<input type='hidden' name='tabela' value='funcao' />
						<input type='hidden' name='id' 
							value='".$linha["ID_FUNCAO"]."' />
						<button>Remover</button>
					</form>
					
				</td>
		      </tr>";
	}
	echo "</tbody>
		</table>";
?>