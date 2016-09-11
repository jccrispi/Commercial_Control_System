<html>
<meta charset="utf-8">
<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000" >
<h3>TYPE THE REQUESTED INFORMATION TO START SALE:</h3>
<?php
$time = mktime(date('H')-3, date('i'), date('s'));
$hora = gmdate("m/d/Y - H:i:s", $time);
echo "<h3>  $hora </h3>";
?>
<form method="post" action="cad_venda.php"> 
<p>Cliente:<span style="padding-left:8px"></span>
<select name="cliente">
<option value="0" selected="selected">Select the Customer</option>
        <?php

          //Ligação ao ficheiro de ligação à BD  
          include('conexao.php');


          //Selecciona as cidades  
          $sql = "SELECT nome, cnpjcli FROM cliente";
		  foreach($conexao->query($sql) as $item)
          {
         ?>
				<!-- O value possui o id da cidade a guardar na BD e na option mostra as cidades -->
                  <option value="<?php echo $item['cnpjcli'];?>"><?php echo $item['nome'];?></option><br/>
			<?php	    
			}
           ?>
</select></p>
<br>Estimated completion date of the service / goods delivery:<br>
<input type="text" name="previsao" />

<p><input type="submit" value="CONTINUE" /></p>

</form>

</body>

</html>