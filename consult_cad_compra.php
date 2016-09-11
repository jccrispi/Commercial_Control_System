<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000" >
<style type="text/css">
a:link, a:visited {
	text-decoration: none
	}
a:hover {
	text-decoration: underline;
	color #f00
	}
a:active {
	text-decoration: none
	}
</style>
<?php
include('conexao.php');
if(isset($_POST['data']) && isset($_POST['mercad'])){
	$data = $_POST['data'];
	$mercad = $_POST['mercad'];

	
	
	if(!$data && !$mercad) {
			echo "<h2> Enter the date or the products name! </h2>";
			echo "<a href='consult_compra.php' target='principal'><h1>Back</h1></a>";
	}
	else{
	
	
	
		$sql = "SELECT COUNT(*) QTDE  FROM altera";
		$resultado = $conexao->query($sql);
		foreach($resultado as $valor)
		{
			$qtdealtera = $valor['QTDE'];
		}
		if(!$qtdealtera) {
			echo "<h1> No results found, please try again! </h1>";
			echo "<a href='consult_compra.php' target='principal'><h1>Back</h1></a>";
		}
		else
		{
			
					if (!$data && $mercad) {
						$sql = "SELECT COUNT(*) QTDE  FROM fornvende, altera WHERE   ";
						$sql .= "  altera.cod_compra = fornvende.codcompra and altera.cod_mercadcomp = '$mercad' ";
						$resultado = $conexao->query($sql);
						foreach($resultado as $valor)
						{
						$qtde = $valor['QTDE'];
						}
					}
					
					else {
						if ($data && !$mercad) {
							$sql  = "SELECT COUNT(*) QTDE  FROM fornvende ";
							$sql .= "WHERE codcompra IN ( SELECT cod_compra FROM altera) ";
							$sql .= "  AND dtcompra LIKE '%$data%'";
							$resultado = $conexao->query($sql);
							foreach($resultado as $valor)
							{
								$qtde = $valor['QTDE'];
							}
						}
						else {
							if ($data && $mercad) {
								$sql = "SELECT COUNT(*) QTDE  FROM fornvende, altera WHERE  altera.cod_compra = fornvende.codcompra ";
								$sql .= " and fornvende.dtcompra LIKE '%$data%' and altera.cod_mercadcomp = '$mercad'";
								$resultado = $conexao->query($sql);
								foreach($resultado as $valor)
								{
								$qtde = $valor['QTDE'];
								}
							}
						}
					}
								
					if($qtde==0){
						echo "<h1> No results found, please try again! </h1>";
						echo "<a href='consult_compra.php' target='principal'><h1>Back</h1></a>";
					}
					else{
				
						$sql = "SELECT descricaomercad FROM mercadoria WHERE codigomercad = '$mercad'";
						foreach($conexao->query($sql) as $item)
						{							
						$mercadnome = $item['descricaomercad'];
						}
					
						if(!$data && $mercad) {
						echo "<p><h2>Your research for '" . $mercadnome . "' have found " .$qtde . " purchase(s) performed:</h2></p>";
						}
						else{
							if(!$mercad && $data){
								echo "<p><h2>Your research for '" . $data . "' have found " .$qtde . " purchase(s) performed:</h2></p>";
							}
							elseif ($mercad && $data){
								echo "<p><h2>Your research for '" . $mercadnome . "' made on " . $data . " have found " .$qtde . " result(s):</h2></p>";
							}
						}
						if (!$data && $mercad) { 
							$sql  = " SELECT funcionario.nome nomefunc, fornecedor.nome nomeforn, fornecedor.cnpjforn, fornvende.hrcompra,  ";
							$sql .= "  fornvende.dtcompra, fornvende.codcompra  FROM fornecedor, fornvende, funcionario, altera WHERE   ";
							$sql .= "  fornecedor.cnpjforn = fornvende.cnpj_forn and fornvende.cpf_funccompra = funcionario.cpffunc and ";
							$sql .= " altera.cod_compra = fornvende.codcompra and altera.cod_mercadcomp = '$mercad' GROUP BY codcompra ORDER BY codcompra DESC";
							
							echo '<table border="1"  bordercolor="#FFFFFF">';
							echo '<tr>';
							echo '<td><center>Query</td>';
							echo '<td><center>Purchase Code</td>';
							echo '<td><center>Date</td>';
							echo '<td><center>Time</td>';
							echo '<td><center>Supplier</td>';
							echo '<td><center>ID</td>';
							echo '<td><center>Employee/Purchase</td>';
							echo '</tr>';
							foreach($conexao->query($sql) as $item)
							{							
							echo '<tr>';
							echo '<td bgcolor="#E0DFEE"><center><a href="compradetalhes.php?codcompra=' . $item['codcompra'] . '">Detalhes</a><br></td>';
							echo '<td bgcolor="#E0DFEE">' . $item['codcompra'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['dtcompra'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['hrcompra'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['nomeforn'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['cnpjforn'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['nomefunc'] . '</td>';
							echo '</tr>';
							}	
							echo '</table>';
						}
						elseif($data && $mercad) {
							
							$sql  = " SELECT funcionario.nome nomefunc, fornecedor.nome nomeforn, fornecedor.cnpjforn, fornvende.hrcompra,  ";
							$sql .= "  fornvende.dtcompra, fornvende.codcompra  FROM fornecedor, fornvende, funcionario, altera WHERE   ";
							$sql .= "  fornecedor.cnpjforn = fornvende.cnpj_forn and fornvende.cpf_funccompra = funcionario.cpffunc and ";
							$sql .= " altera.cod_compra = fornvende.codcompra and fornvende.dtcompra LIKE '%$data%' ";
							$sql .= " and altera.cod_mercadcomp = '$mercad' GROUP BY codcompra ORDER BY codcompra DESC ";
							
							echo '<table border="1"  bordercolor="#FFFFFF">';
							echo '<tr>';
							echo '<td><center>Query</td>';
							echo '<td><center>Purchase Code</td>';
							echo '<td><center>Date</td>';
							echo '<td><center>Time</td>';
							echo '<td><center>Supplier</td>';
							echo '<td><center>ID</td>';
							echo '<td><center>Employee/Purchase</td>';
							echo '</tr>';
							foreach($conexao->query($sql) as $item)
							{							
							echo '<tr>';
							echo '<td bgcolor="#E0DFEE"><center><a href="compradetalhes.php?codcompra=' . $item['codcompra'] . '">Detalhes</a><br></td>';
							echo '<td bgcolor="#E0DFEE">' . $item['codcompra'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['dtcompra'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['hrcompra'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['nomeforn'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['cnpjforn'] . '</td>';
							echo '<td bgcolor="#E0DFEE">' . $item['nomefunc'] . '</td>';
							echo '</tr>';
							}	
							echo '</table>';
					
						}
						elseif ($data && !$mercad) {
								
							
								$sql  = " SELECT funcionario.nome nomefunc, fornecedor.nome nomeforn, fornecedor.cnpjforn, fornvende.hrcompra,  ";
								$sql .= "  fornvende.dtcompra, fornvende.codcompra  FROM fornecedor, fornvende, funcionario, altera WHERE   ";
								$sql .= "  fornecedor.cnpjforn = fornvende.cnpj_forn and fornvende.cpf_funccompra = funcionario.cpffunc and ";
								$sql .= " altera.cod_compra = fornvende.codcompra and fornvende.dtcompra LIKE '%$data%' GROUP BY codcompra ORDER BY codcompra DESC";
								
								echo '<table border="1"  bordercolor="#FFFFFF">';
								echo '<tr>';
								echo '<td><center>Query</td>';
								echo '<td><center>Purchase Code</td>';
								echo '<td><center>Date</td>';
								echo '<td><center>Time</td>';
								echo '<td><center>Supplier</td>';
								echo '<td><center>ID</td>';
								echo '<td><center>Employee/Purchase</td>';
								echo '</tr>';
								foreach($conexao->query($sql) as $item)
								{							
								echo '<tr>';
								echo '<td bgcolor="#E0DFEE"><center><a href="compradetalhes.php?codcompra=' . $item['codcompra'] . '">Detalhes</a><br></td>';
								echo '<td bgcolor="#E0DFEE">' . $item['codcompra'] . '</td>';
								echo '<td bgcolor="#E0DFEE">' . $item['dtcompra'] . '</td>';
								echo '<td bgcolor="#E0DFEE">' . $item['hrcompra'] . '</td>';
								echo '<td bgcolor="#E0DFEE">' . $item['nomeforn'] . '</td>';
								echo '<td bgcolor="#E0DFEE">' . $item['cnpjforn'] . '</td>';
								echo '<td bgcolor="#E0DFEE">' . $item['nomefunc'] . '</td>';
								echo '</tr>';
								}	
								echo '</table>';
							}
						}
						echo "<p><br><a href='consult_compra.php' target='principal'><h2>Nova consulta</h2></a></p>";
				
		}
	}
}
?>
</body>
</meta>
</html>