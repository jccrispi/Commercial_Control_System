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

<h3>CHANGING OF SALES DATA</h3>
<form method="post" action="alt_venda_servico.php">
<br>Sale Code:<br>
<input type="text" name="codvend" /><br>


<h4>REPORT THE REQUESTED INFORMATION TO MODIFY (S) SERVICE (S) OF SALE:</h4>


<p>The service code to be changed:<br>
<input type="text" name="servalt" /></p>

<p>New Service:<br><span style="padding-left:3px"></span>
<select name="novoserv">
<option value="0" selected="selected">Select the Service</option>
        <?php

          //Ligação ao ficheiro de ligação à BD  
          include('conexao.php');


          //Selecciona as cidades  
          $sql = "SELECT descricaoserv, codigoserv FROM servico";
		  foreach($conexao->query($sql) as $item)
          {
         ?>
				<!-- O value possui o id da cidade a guardar na BD e na option 

mostra as cidades -->
                  <option value="<?php echo $item['codigoserv'];?>"><?php echo 

$item['descricaoserv'];?></option><br/>
			<?php	    
			}
           ?>
</select></p>



<input type="submit" value="CHANGE" /><br>

</form>
</body>

</html>
