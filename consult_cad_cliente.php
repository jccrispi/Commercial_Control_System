<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
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
header('Content-Type: text/html; charset=UTF-8');
echo '<html>';
include('conexao.php');
if(isset($_POST['nome'])){
	$nomecliente = $_POST['nome'];
	
	if(!$nomecliente) {
		echo "<h2> Please, type the Customer's Name! </h2>";
		echo "<a href='consult_cliente.php' target='principal'><h1>Back</h1></a>";
	}
	else{

		$sql = "SELECT COUNT(*) QTDE  FROM cidade, cliente WHERE  cliente.cod_cid = cidade.codigocid ";
			$sql .= " and UPPER(cliente.nome) LIKE UPPER ('$nomecliente%')";
		$resultado = $conexao->query($sql);
		foreach($resultado as $valor)
		{
			$qtde = $valor['QTDE'];
		}
		
		if($qtde!=0){	
			echo "<p><h2>Your search for '" . $nomecliente . "' have found " .$qtde . " customer(s):</h2></p>";
			$sql  = " SELECT cidade.nome nomecid, cliente.cnpjcli, cliente.nome nomecliente, cliente.inscricao,";
			$sql .= " cliente.rua, cliente.numero, cliente.bairro, cliente.cep FROM cidade, cliente WHERE  cliente.cod_cid = cidade.codigocid ";
			$sql .= " and UPPER(cliente.nome) LIKE UPPER ('$nomecliente%')";
			
				echo '<table border="1"  bordercolor="#FFFFFF">';
				echo '<tr>';
				echo '<td><center>Name</td>';
				echo '<td><center>ID</td>';
				echo '<td><center>Company Code</td>';
				echo '<td><center>Street</td>';
				echo '<td><center>Number</td>';
				echo '<td><center>District</td>';
				echo '<td><center>City</td>';
				echo '<td><center>ZIP CODE</td>';
				echo '</tr>';
				foreach($conexao->query($sql) as $item)
				{							
				echo '<tr>';
				echo '<td bgcolor="#E0DFEE">' . $item['nomecliente'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['cnpjcli'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['inscricao'] . '</td>';
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
			echo "<a href='consult_cliente.php' target='principal'><h1>Back</h1></a>";
		}
	}
}
echo "<p><br><a href='consult_cliente.php' target='principal'><h2>New Search</h2></a></p>";
?>
</body>
</meta>
</html>