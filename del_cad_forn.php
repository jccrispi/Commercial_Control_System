<html>
<meta charset="utf-8">
<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000" >
<?php
include('conexao.php');
$cnpj = $_POST['cnpj'];
$sql="DELETE FROM fornecedor WHERE cnpjforn = $cnpj";
$resultado = $conexao->exec($sql);
if(!$resultado){
echo "<h2>Error in execution</h2>";
echo "<a href='del_forn.php' target='principal'><h1>Back</h1></a>";	
}
else
{
echo "<h2>Successfully Removed!</h2>";	
echo "<a href='del_forn.php' target='principal'><h1>Back</h1></a>";	
}
?>
</body>
</html>
