<html>
<meta charset="utf-8">
<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000" >
<?php
include('conexao.php');
$codigo = $_POST['codigo'];
$sql="DELETE FROM mercadoria WHERE codigomercad = $codigo";
if($codigo == 1) {
echo "<h2>This item cannot be deleted!</h2>";
}
else{
$resultado = $conexao->exec($sql);
if(!$resultado){
echo "<h2>Error in execution</h2>";
echo "<a href='del_mercad.php' target='principal'><h1>Back</h1></a>";	
}
else
{
echo "<h2>The product has been successfully removed!</h2>";	
echo "<a href='del_mercad.php' target='principal'><h1>Back</h1></a>";	
}
}
?>
</body>
</html>
