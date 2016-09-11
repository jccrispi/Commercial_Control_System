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
$precos = $_POST['precoserv'];
if(!$descricao || !$precos) {
echo "<h2>Please, fill out all the fields!</h2>";
echo "<a href='novo_serv.php' target='principal'><h1>Back</h1></a>";
}
else{
$sql="INSERT INTO servico (descricaoserv, precserv) values ('$descricao','$precos')";
$resultado = $conexao->exec($sql);
if(!$resultado){
echo "<h2>Error in execution</h2>";
echo "<a href='novo_serv.php' target='principal'><h1>Back</h1></a>";
}
else
{
echo "<h2>Successfully Changed!</h2>";	
echo "<a href='novo_serv.php' target='principal'><h1>New Service</h1></a>";
}
}
?>
</body>
</html>