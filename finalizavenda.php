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


//Pesquisa o código da venda
$sql = " SELECT MAX(codigovend) maxcod FROM venda";
foreach($conexao->query($sql) as $item)
{
$codvenda=$item['maxcod'];
}	

$sql = "SELECT COUNT(*) QTDE  FROM consome where cod_vendamercad = $codvenda";
$resultado = $conexao->query($sql);
foreach($resultado as $valor)
{
	$qtdeprod = $valor['QTDE'];
}

$sql = "SELECT COUNT(*) QTDE  FROM recai where codvenda = $codvenda";
$resultado = $conexao->query($sql);
foreach($resultado as $valor)
{
	$qtdeserv = $valor['QTDE'];
}




if(!$qtdeprod && !$qtdeserv){
	echo  "<h2><center>THERE ARE NO PRODUCTS OR SERVICES SELECTED!</center></h2>";
	echo "<a href='form_vendamercad.php' target='principal'><h2>Back</h2></a>";
}
else
{

	echo '<h2><center>THE SALE HAS BEEN MADE SUCCESSFULLY!</center></h2>';


		$sql  = " SELECT cliente.nome nomecli, cliente.cnpjcli, venda.dtvenda, venda.codigovend, ";
		$sql .= " venda.preventrega, venda.hrvenda, funcionario.nome nomefunc FROM funcionario, cliente, venda ";
		$sql .= "  WHERE venda.codigovend = $codvenda and cliente.cnpjcli = venda.cnpj_cliente ";
		$sql .= " and venda.cpf_func = funcionario.cpffunc";
		echo '<table border="1"  bordercolor="#FFFFFF" >';
		echo '<tr>';
		echo '<td><center>Sale Code</td>';
		echo '<td><center>Date</td>';
		echo '<td><center>Time</td>';
		echo '<td><center>Customer</td>';
		echo '<td><center>ID</td>';
		echo '<td><center>Forecast Delivery</td>';
		echo '<td><center>Vendor</td>';
		
		echo '</tr>';
		foreach($conexao->query($sql) as $item)
		{							
		echo '<tr>';
		echo '<td bgcolor="#E0DFEE"><center>' . $item['codigovend'] . '</td>';
		echo '<td bgcolor="#E0DFEE"><center>' . $item['dtvenda'] . '</td>';
		echo '<td bgcolor="#E0DFEE"><center>' . $item['hrvenda'] . '</td>';
		echo '<td bgcolor="#E0DFEE"><center>' . $item['nomecli'] . '</td>';
		echo '<td bgcolor="#E0DFEE"><center>' . $item['cnpjcli'] . '</td>';
		echo '<td bgcolor="#E0DFEE"><center>' . $item['preventrega'] . '</td>';
		echo '<td bgcolor="#E0DFEE"><center>' . $item['nomefunc'] . '</td>';
		
		echo '</tr>';
		}	
		echo '</table>';
		echo '</center>';
	


	echo '<h3>TRANSACTION SUMMARY:</h3>';

	
	

	
			$totprod = 0;
			$totserv = 0;

if($qtdeprod) {
			
			$sql  = " SELECT mercadoria.descricaomercad, mercadoria.precmercad, consome.qtdemercvenda, consome.cod_mercad FROM  ";
			$sql .= " mercadoria, venda, consome WHERE mercadoria.codigomercad = consome.cod_mercad";
			$sql .= "  and consome.cod_vendamercad = venda.codigovend and venda.codigovend = $codvenda";
			$sql .= "  and consome.cod_vendamercad = $codvenda GROUP BY codigomercad ";
			
			echo '<h4>PRODUCTS:</h4>';
			echo '<table border="1"  bordercolor="#FFFFFF" >';
			echo '<tr>';
			echo '<td><center>Code</td>';
			echo '<td><center>Description</td>';
			echo '<td><center>Unit Price</td>';
			echo '<td><center>Amount</td>';
			echo '<td><center>Total</td>';
			echo '</tr>';
			
			foreach($conexao->query($sql) as $item)
			{							
			echo '<tr>';
			echo '<td bgcolor="#E0DFEE">' . $item['cod_mercad'] . '</td>';
			echo '<td bgcolor="#E0DFEE">' . $item['descricaomercad'] . '</td>';
			echo '<td bgcolor="#E0DFEE">$ ' . $item['precmercad'] . '</td>';
			echo '<td bgcolor="#E0DFEE">' . $item['qtdemercvenda'] . '</td>';
			$total = $item['precmercad']*$item['qtdemercvenda'];
			$totprod += $total;
			echo '<td bgcolor="#E0DFEE">$ ' . number_format($total,2, ',', '.') . '</td>';
			echo '</tr>';
			
			
			}	
			echo '</table>';
			
}

if($qtdeserv){			
			
			$sql  = " SELECT servico.descricaoserv, servico.precserv, recai.codservico FROM  servico, venda, recai ";
			$sql .= " WHERE recai.codvenda = venda.codigovend and recai.codservico = servico.codigoserv and ";
			$sql .= " venda.codigovend = $codvenda and recai.codvenda = $codvenda GROUP BY codigoserv";
		
			
			echo '<h4>SERVICES:</h4>';
			echo '<table border="1"  bordercolor="#FFFFFF" >';
			echo '<tr>';
			echo '<td><center>Description</td>';
			echo '<td><center>Price</td>';	
			echo '</tr>';
			
			foreach($conexao->query($sql) as $item)
			{							
			echo '<tr>';
			echo '<td bgcolor="#E0DFEE"><center>' . $item['codservico'] . '</td>';
			echo '<td bgcolor="#E0DFEE"><center>' . $item['descricaoserv'] . '</td>';
			echo '<td bgcolor="#E0DFEE"><center>$ ' . $item['precserv'] . '</td>';
			$totserv += $item['precserv'];
			echo '</tr>';
			
			}	
			echo '</table>';
}			
			echo '<br><table border="1"  bordercolor="#FFFFFF" >';
			echo '<tr>';
			echo '<td bgcolor="#E0DFEE"><h2>TOTAL SALES VALUE</h2></td>';
			$totalvenda = $totprod + $totserv;
			echo '<td bgcolor="#E0DFEE"><h2>R$ ' . number_format($totalvenda,2, ',', '.').'</h2></td>';
			echo '</tr>';
			echo '</table>';
}
		echo "<a href='novo_venda.php' target='principal'><h2>New Sale</h2></a>";

?>
</body>
</meta>
</html>