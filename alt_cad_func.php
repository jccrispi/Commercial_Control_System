<html>
<meta charset="utf-8">
<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000" >
<?php
include('conexao.php');
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$codcidade = $_POST['cidade'];
$cep = $_POST['cep'];
$sql="UPDATE funcionario SET nome ='$nome', rg='$rg', rua='$rua', numero='$numero', bairro='$bairro', cod_cid='$codcidade', cep='$cep' WHERE cpffunc = $cpf";
$resultado = $conexao->exec($sql);
if(!$resultado){
echo "<h2>Error in execution</h2>";
echo "<a href='alt_func.php' target='principal'><h1>Back</h1></a>";		
}
else
{
echo "<h2>Successfully Changed !</h2>";	
echo "<a href='alt_func.php' target='principal'><h1>Back</h1></a>";		
}

?>
</body>
</html>