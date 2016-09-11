<html>
<meta charset="utf-8">
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


	$sql  = " SELECT cliente.nome nomecli, cliente.cnpjcli, venda.dtvenda, venda.codigovend, ";
	$sql .= " venda.preventrega, venda.hrvenda, funcionario.nome nomefunc FROM funcionario, cliente, venda ";
	$sql .= "  WHERE venda.codigovend = $codvenda and cliente.cnpjcli = venda.cnpj_cliente ";
	$sql .= " and venda.cpf_func = funcionario.cpffunc";
	echo '<center>';
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
?>


<h4>ENTER THE DATA REQUESTED TO INCLUDE PRODUCT (S) ON SALE:</h4>


<form method="post" action="cad_vendamercad.php"> 
PRODUCT:
<select name="mercad">
<option value="0" selected="selected">ADD PRODUCT</option>
        <?php

          //Ligação ao ficheiro de ligação à BD  
          include('conexao.php');


          //Selecciona as cidades  
          $sql = "SELECT descricaomercad, codigomercad FROM mercadoria";
		  foreach($conexao->query($sql) as $item)
          {
         ?>
				<!-- O value possui o id da cidade a guardar na BD e na option mostra as cidades -->
                  <option value="<?php echo $item['codigomercad'];?>"><?php echo $item['descricaomercad'];?></option><br/>
			<?php	    
			}
           ?>
</select>
Amount:
<input type="text" name="qtde" />

<a href='form_vendaservico.php' target='principal'><h4>ADD SERVICE(S)</h4></a>
<a href='del_itemvendamercad.php' target='principal'><h4>CANCEL ITEM(S)</h4></a>
<a href='finalizavenda.php' target='principal'><h1>CONCLUDE / SALES DETAILS</h1></a>

<center><input type="submit" value="ADD PRODUCT" /></center><br>

</form>

<?php
include('conexao.php');

//Insere o código da venda
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
if($qtdeprod){

	$sql  = " SELECT mercadoria.codigomercad, mercadoria.descricaomercad, consome.qtdemercvenda, mercadoria.precmercad ";
	$sql .= " FROM mercadoria, consome  WHERE  consome.cod_vendamercad =  $codvenda and ";
	$sql .= " consome.cod_mercad = mercadoria.codigomercad ";
	echo '<center>';
	echo '<right><table border="1" bordercolor="#FFFFFF" >';
	echo '<tr>';
	echo '<td><center>Product</td>';
	echo '<td><center>Code</td>';
	echo '<td><center>Amount</td>';
	echo '<td><center>Unit Value</td>';
	echo '<td><center>Total Value(s) of product(s)</td>';
	echo '</tr>';
	
	foreach($conexao->query($sql) as $item)
	{							
	echo '<tr>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['descricaomercad'] . '</td>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['codigomercad'] . '</td>';
	echo '<td bgcolor="#E0DFEE">' . $item['qtdemercvenda'] . '</td>';
	echo '<td bgcolor="#E0DFEE">R$ ' . number_format($item['precmercad'],2, ',', '.') . '</td>';
	$total = $item['precmercad']*$item['qtdemercvenda'];
	echo '<td bgcolor="#E0DFEE">$ ' . number_format($total,2, ',', '.') . '</td>';
	echo '</tr>';
	}	
	echo '</table>';
	echo '</center>';
}
?>



</body>

</html>
