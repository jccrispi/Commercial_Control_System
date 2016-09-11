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
	$nomefunc = $_POST['nome'];
	
	if(!$nomefunc) {
		echo "<h2> Please, Type the Employee Name! </h2>";
	}
	else{
	
		$sql = "SELECT COUNT(*) QTDE  FROM cidade, funcionario WHERE  funcionario.cod_cid = cidade.codigocid ";
		$sql .= " and UPPER(funcionario.nome) LIKE UPPER ('$nomefunc%')";
		$resultado = $conexao->query($sql);
		foreach($resultado as $valor)
		{
			$qtde = $valor['QTDE'];
		}
		if($qtde!=0){
			echo "<p><h2>Your search for '" . $nomefunc . "' have found " .$qtde . " employee(s):</h2></p>";
			$sql  = " SELECT cidade.nome nomecid, funcionario.cpffunc, funcionario.nome nomefunc, funcionario.rg,";
			$sql .= " funcionario.rua, funcionario.numero, funcionario.bairro, funcionario.cep FROM cidade, funcionario WHERE  funcionario.cod_cid = cidade.codigocid ";
			$sql .= " and UPPER(funcionario.nome) LIKE UPPER ('$nomefunc%')";
					
				echo '<table border="1"  bordercolor="#FFFFFF">';
				echo '<tr>';
				echo '<td><center>Name</td>';
				echo '<td><center>Drivers License</td>';
				echo '<td><center>ID</td>';
				echo '<td><center>Street</td>';
				echo '<td><center>Number</td>';
				echo '<td><center>District</td>';
				echo '<td><center>City</td>';
				echo '<td><center>Zip Code</td>';
				echo '</tr>';
				foreach($conexao->query($sql) as $item)
				{							
				echo '<tr>';
				echo '<td bgcolor="#E0DFEE">' . $item['nomefunc'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['cpffunc'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['rg'] . '</td>';
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
			echo "<h1> No results found. Please try again! </h1>";
		}
	}
}
echo "<p><br><a href='consult_func.php' target='principal'><h2>New Search</h2></a></p>";
?>
</body>
</meta>
</html>