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
if(isset($_POST['descricao'])){
	$descserv = $_POST['descricao'];
	
	if(!$descserv) {
		echo "<h2> Please, Type the Product Name! </h2>";
	}
	else{
		$sql = "SELECT COUNT(*) QTDE  FROM mercadoria WHERE UPPER(descricaomercad) LIKE UPPER ('%$descserv%')";
		$resultado = $conexao->query($sql);
		foreach($resultado as $valor)
		{
			$qtde = $valor['QTDE'];
		}
		
		if($qtde!=0){
		echo "<p><h2>Your search for '" . $descserv . "' have found " .$qtde . " product(s):</h2></p>";
		
			$sql="SELECT descricaomercad, qtdemercad, codigomercad, precmercad FROM mercadoria WHERE UPPER(descricaomercad) LIKE UPPER ('%$descserv%')";
				echo '<table border="1"  bordercolor="#FFFFFF">';
				echo '<tr>';
				echo '<td><center>Code   </td>';
				echo '<td><center>Description   </td>';
				echo '<td><center>Unit Price </td>';
				echo '<td><center>Quantity in stock</td>';
				echo '</tr>';
				foreach($conexao->query($sql) as $item)
				{							
				echo '<tr>';
				echo '<td bgcolor="#E0DFEE">' . $item['codigomercad'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['descricaomercad'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['precmercad'] . '</td>';
				echo '<td bgcolor="#E0DFEE">' . $item['qtdemercad'] . '</td>';
				echo '</tr>';
				}	
			echo '</table>';
		}
		else {
			echo "<h1> No results found, please try again! </h1>";
		}
	}
}
echo "<p><br><a href='consult_mercad.php' target='principal'><h2>New Search</h2></a></p>";
?>
</body>
</meta>
</html>