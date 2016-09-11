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
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$precocusto = $_POST['precocusto'];
if(!$descricao || !$preco || !$precocusto) {
echo "<h2>Please, fill out all the fields!</h2>";
echo "<a href='novo_mercad.php' target='principal'><h1>Back</h1></a>";
}
else{
$sql="INSERT INTO mercadoria (descricaomercad, precmercad, preccusto) values ('$descricao', '$preco', '$precocusto')";
$resultado = $conexao->exec($sql);
if(!$resultado){
echo "<h2>Error in execution</h2>";
}
else
{
echo "<h2>The product has been registered successfully!</h2>";	
echo "<a href='novo_mercad.php' target='principal'><h1>New Product</h1></a>";
}
}
?>
</body>
</html>
