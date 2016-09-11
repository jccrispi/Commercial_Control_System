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
$cliente = $_POST['cliente'];
$previsao = $_POST['previsao'];
$data = gmdate("d/m/Y");
$time = mktime(date('H')-3, date('i'), date('s'));
$hora = gmdate("H:i:s", $time);

//Buscar CPF do funcionário
$sql  = " SELECT numcpf FROM login WHERE  cod = 1";
			foreach($conexao->query($sql) as $item) {
			$cadcpf = $item['numcpf'];
			}	

$sql = "INSERT INTO venda (cnpj_cliente, cpf_func, preventrega, dtvenda, hrvenda) values ('$cliente','$cadcpf',";
$sql .= "'$previsao','$data','$hora')";
$resultado = $conexao->exec($sql);
if(!$resultado){
echo "<h2>Error in execution</h2>";
echo "<br><a href='novo_venda.php' target='principal'><h1>Back</h1></a>";

}
else
{
include ('form_vendamercad.php');
}
?>

</body>
</html>