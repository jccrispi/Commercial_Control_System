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
$nome = $_POST['nome'];
if(!$nome) {
echo "<h2>Type the City's name!</h2>";
echo "<a href='novo_cid.php' target='principal'><h1>Back</h1></a>";
}
else{
$sql = "INSERT INTO cidade (nome) values ('$nome')";
$resultado = $conexao->exec($sql);
if(!$resultado){
echo "<h2>Error in execution</h2>";
}
else
{
echo "<h2>Successfully Registered!</h2>";	
echo "<a href='novo_cid.php' target='principal'><h1>New City</h1></a>";
}
}
?>
</body>
</html>
