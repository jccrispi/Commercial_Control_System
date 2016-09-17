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

<h3>CHANGING PURCHASE DATA</h3>
<form method="post" action="alt_compra_mercad.php">
<br>Purchase Code:<br>
<input type="text" name="codcompra" /><br>


<h4>REPORT THE REQUESTED INFORMATION TO MODIFY PRODUCT(S) PURCHASE:</h4>


<p>Product code to be changed:<br>
<input type="text" name="mercadalt" /></p>

<p>New product:
<select name="mercadnovo">
<option value="0" selected="selected">Select the product</option>
        <?php

          //Ligação ao ficheiro de ligação à BD  
          include('conexao.php');


          //Selecciona as cidades  
          $sql = "SELECT descricaomercad, codigomercad FROM mercadoria";
		  foreach($conexao->query($sql) as $item)
          {
         ?>
				<!-- O value possui o id da cidade a guardar na BD e na option mostra as cidades -->
                  <option value="<?php echo $item['codigomercad'];?>"><?php echo $item['descricaomercad'];?></option><br/>
			<?php	    
			}
           ?>
</select></p>
<p>Amount:<span style="padding-left:16px"></span>
<input type="text" name="qtde"/></p><br>

<input type="submit" value="Change" /><br>

</form>
</body>

</html>
