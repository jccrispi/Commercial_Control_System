<html>
<meta charset="utf-8">
<body bgcolor="#ebe9e9" text="#525252" link="#525252" alink="#525252" vlink="#525252" >
<?php
include('conexao.php');
$cnpj = $_POST['cnpj_forn'];
$codigo = $_POST['codigo'];
$qtde = $_POST['qtde'];
$qtde_a = $_POST['qtde_a'];

$sql  = " SELECT numcpf FROM login WHERE  cod = 1";
			foreach($conexao->query($sql) as $item) {
			$cadcpf = $item['numcpf'];
			}	

$sql="UPDATE fornvende SET qtdevend ='$qtde', cpf_funccompra='$cadcpf' WHERE cnpj_forn = $cnpj AND cod_mercad = $codigo AND qtdevend = $qtde_a";
$resultado = $conexao->exec($sql);
if(!$resultado){
echo "<h2>Error in execution</h2>";
echo "<a href='alt_compra.php' target='principal'><h1>Back</h1></a>";		
}
else
{
echo "<h2>Successfully Changed!</h2>";	
echo "<a href='alt_compra.php' target='principal'><h1>Back</h1></a>";		
}

?>
</body>
</html>