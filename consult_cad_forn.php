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
if(isset($_POST['nome'])){
	$nomeforn = $_POST['nome'];
	
	if(!$nomeforn) {
	echo "<h2> Enter the supplier name! </h2>";
	echo "<a href='consult_forn.php' target='principal'><h1>Back</h1></a>";
	}
	else{
	
		$sql = "SELECT COUNT(*) QTDE  FROM cidade, fornecedor WHERE  fornecedor.cod_cid = cidade.codigocid ";
		$sql .= " and UPPER(fornecedor.nome) LIKE UPPER ('$nomeforn%')";
		$resultado = $conexao->query($sql);
		foreach($resultado as $valor)
		{
			$qtde = $valor['QTDE'];
		}
		
		if($qtde!=0){
			echo "<p><h2>Your search for '" . $nomeforn . "' have found " .$qtde . " suppliers:</h2></p>";		
			$sql  = " SELECT cidade.nome nomecid, fornecedor.cnpjforn, fornecedor.nome nomeforn, fornecedor.inscricaoforn,";
			$sql .= " fornecedor.rua, fornecedor.numero, fornecedor.bairro, fornecedor.cep FROM cidade, fornecedor WHERE  fornecedor.cod_cid = cidade.codigocid ";
			$sql .= " and UPPER(fornecedor.nome) LIKE UPPER ('$nomeforn%')";
			
				echo '<table border="1"  bordercolor="#FFFFFF">';
				echo '<tr>';
				echo '<td><center>Name</td>';
				echo '<td><center>ID</td>';
				echo '<td><center>Company Number</td>';
				echo '<td><center>Street</td>';
				echo '<td><center>Number</td>';
				echo '<td><center>District</td>';
				echo '<td><center>City</td>';
				echo '<td><center>Zip Code</td>';
				echo '</tr>';
				foreach($conexao->query($sql) as $item)
				{							
				echo '<tr>';
				echo '<td bgcolor="#E0DFEE">' . $item['nomeforn'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['cnpjforn'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['inscricaoforn'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['rua'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['numero'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['bairro'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['nomecid'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['cep'] . '</td>';
				echo '</tr>';
				}	
			echo '</table>';
		}
		else {
			echo "<h1> No results found, please try again! </h1>";
			echo "<a href='consult_forn.php' target='principal'><h1>Back</h1></a>";
		}
	}
}
echo "<p><br><a href='consult_forn.php' target='principal'><h2>New Search</h2></a></p>";
?>
</body>
</meta>
</html>