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
$codigo = $_POST['codcompra'];
$prodexc = $_POST['prodexcl'];


if(!$codigo || !$prodexc) {
		echo  "<h2>Please, type all the requested data!</h2>";
		echo "<a href='del_compra.php' target='principal'><h2>Back</h2></a>";
}
else {

	$sql = "SELECT COUNT(*) QTDE  FROM altera where cod_compra = $codigo and cod_mercadcomp = $prodexc";
		$resultado = $conexao->query($sql);
		foreach($resultado as $valor)
		{
			$qtdeprod = $valor['QTDE'];
		}
	if($qtdeprod) {


		$sql = "SELECT qtdecompra FROM altera where cod_compra = $codigo and cod_mercadcomp = $prodexc";
		$resultado = $conexao->query($sql);
		foreach($resultado as $valor)
		{
			$qtdealt = $valor['qtdecompra'];
		}

		$sql = "SELECT qtdemercad FROM mercadoria where codigomercad = $prodexc";
		$resultado = $conexao->query($sql);
		foreach($resultado as $valor)
		{
			$qtdeest = $valor['qtdemercad'];
		}

		if($qtdeest < $qtdealt) {
				echo  "<h2>This purchase can not be modified!</h2>";
				echo "<a href='del_compra.php' target='principal'><h2>Back</h2></a>";
		}
		else{


			$sql = "SELECT COUNT(*) QTDE  FROM altera where cod_compra = $codigo";
			$resultado = $conexao->query($sql);
			foreach($resultado as $valor)
			{
				$qtdeprod1 = $valor['QTDE'];
			}
			
		
			
			
			if($qtdeprod1 > 1) {
				$sql  ="DELETE FROM altera WHERE cod_compra = '$codigo' and cod_mercadcomp = '$prodexc'";
				$resultado = $conexao->exec($sql);
				if(!$resultado){
				echo "<h2>Error deleting the purchase</h2>";
				echo "<a href='del_compra.php' target='principal'><h1>Back</h1></a>";
				}
				else
				{
				echo "<h2>Successfully Removed!</h2>";	
				echo "<a href='del_compra.php' target='principal'><h1>Back</h1></a>";
				}
			}
			
			
			
			if($qtdeprod1 == 1) {
				$sql  ="DELETE FROM altera WHERE cod_compra = '$codigo' and cod_mercadcomp = '$prodexc'; DELETE";
				$sql .="  FROM fornvende WHERE codcompra = '$codigo' ";
				$resultado = $conexao->exec($sql);
				if(!$resultado){
				echo "<h2>Error deleting the purchase!</h2>";
				echo "<a href='del_compra.php' target='principal'><h1>Back</h1></a>";
				}
				else
				{
				echo "<h2>Error deleting the purchase!</h2>";	
				echo "<a href='del_compra.php' target='principal'><h1>Back</h1></a>";
				}
			}

			elseif(!$qtdeprod1) {
				$sql =" DELETE FROM fornvende WHERE codcompra = '$codigo' ";
				$resultado = $conexao->exec($sql);
				if(!$resultado){
				echo "<h2>Error deleting the purchase</h2>";
				echo "<a href='del_compra.php' target='principal'><h1>Back</h1></a>";
				}
				else
				{
				echo "<h2>Successfully Removed!</h2>";	
				echo "<a href='del_compra.php' target='principal'><h1>Back</h1></a>";
				}
			}
		}
	}
	else{
		echo  "<h2>Product / purchase not located!</h2>";
		echo "<a href='del_compra.php' target='principal'><h2>Back</h2></a>";
	}
}
?>
</body>
</html>