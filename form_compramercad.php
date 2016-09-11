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

//Pesquisa o código da compra
$sql = " SELECT MAX(codcompra) maxcodcompra FROM fornvende";
foreach($conexao->query($sql) as $item)
{
$codfornvende=$item['maxcodcompra'];
}	

	$sql  = " SELECT fornecedor.nome nomeforn, fornecedor.cnpjforn, fornvende.dtcompra, fornvende.codcompra, ";
	$sql .= " fornvende.hrcompra, funcionario.nome nomefunc FROM funcionario, fornecedor, fornvende ";
	$sql .= "  WHERE fornvende.codcompra = $codfornvende and fornecedor.cnpjforn = fornvende.cnpj_forn ";
	$sql .= " and fornvende.cpf_funccompra = funcionario.cpffunc";
	
	echo '<center>';
	echo '<table border="1"  bordercolor="#FFFFFF" >';
	echo '<tr>';
	echo '<td><center>Purchase Code</td>';
	echo '<td><center>Date</td>';
	echo '<td><center>Time</td>';
	echo '<td><center>Supplier</td>';
	echo '<td><center>ID</td>';
	echo '<td><center>Vendor</td>';
	
	echo '</tr>';
	foreach($conexao->query($sql) as $item)
	{							
	echo '<tr>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['codcompra'] . '</td>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['dtcompra'] . '</td>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['hrcompra'] . '</td>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['nomeforn'] . '</td>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['cnpjforn'] . '</td>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['nomefunc'] . '</td>';
	
	echo '</tr>';
	}	
	echo '</table>';
	echo '</center>';
?>


<h4>TYPE THE REQUESTED DATA IN ORDER TO INCLUDE PRODUCT(S) TO THE PURCHASE:</h4>


<form method="post" action="cad_compramercad.php"> 
Produto:
<select name="mercad">
<option value="0" selected="selected">Select the product</option>
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

<a href='del_item_compra.php' target='principal'><h4>REMOVE ITEM(S)</h4></a>
<a href='finalizacompra.php' target='principal'><h1>CONCLUDE / PURCHASE DETAILS</h1></a>

<center><input type="submit" value="ADD PRODUCT" /></center><br>

</form>

<?php
include('conexao.php');

//Insere o código da compra
$sql = " SELECT MAX(codcompra) maxcod FROM fornvende";
foreach($conexao->query($sql) as $item)
{
$codfornvende=$item['maxcod'];
}	

$sql = "SELECT COUNT(*) QTDE  FROM altera where cod_compra = $codfornvende";
$resultado = $conexao->query($sql);
foreach($resultado as $valor)
{
	$qtdeprod = $valor['QTDE'];
}
if($qtdeprod){

	$sql  = " SELECT mercadoria.codigomercad, mercadoria.descricaomercad, altera.qtdecompra, mercadoria.preccusto ";
	$sql .= " FROM mercadoria, altera  WHERE  altera.cod_compra =  $codfornvende and ";
	$sql .= " altera.cod_mercadcomp = mercadoria.codigomercad ";
	echo '<center>';
	echo '<right><table border="1" bordercolor="#FFFFFF" >';
	echo '<tr>';
	echo '<td><center>Product</td>';
	echo '<td><center>Code</td>';
	echo '<td><center>Amount</td>';
	echo '<td><center>Unit Price</td>';
	echo '<td><center>Total Value(s) of product(s)</td>';
	echo '</tr>';
	
	foreach($conexao->query($sql) as $item)
	{							
	echo '<tr>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['descricaomercad'] . '</td>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['codigomercad'] . '</td>';
	echo '<td bgcolor="#E0DFEE"><center>' . $item['qtdecompra'] . '</td>';
	echo '<td bgcolor="#E0DFEE">$ ' . $item['preccusto'] . '</td>';
	$total = $item['preccusto']*$item['qtdecompra'];
	echo '<td bgcolor="#E0DFEE"> $ ' . number_format($total,2, ',', '.') . '</td>';
	echo '</tr>';
	}	
	echo '</table>';
	echo '</center>';
}
?>



</body>

</html>
