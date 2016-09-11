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
<h3>TYPE THE EMPLOYEE DATA:</h3>
<form method="post" action="cad_func.php"> 
Name <input type="text" name="nome" /><br>
ID <input type="text" name="cpf" /><br>
Driver's license <input type="text" name="rg" /><br>
<p><h3>Address:</h3></p>
Street <input type="text" name="rua" /><br>
Number <input type="text" name="numero" /><br>
District <input type="text" name="bairro" /><br>
<p>City<br>
<select name="cidade">
<option value="0" selected="selected">Select a City</option>
        <?php

          //Ligação ao ficheiro de ligação à BD  
          include('conexao.php');


          //Selecciona as cidades  
          $sql = "SELECT nome, codigocid FROM cidade";
		  foreach($conexao->query($sql) as $item)
          {
         ?>
				<!-- O value possui o id da cidade a guardar na BD e na option mostra as cidades -->
                  <option value="<?php echo $item['codigocid'];?>"><?php echo $item['nome'];?></option><br/>
			<?php	    
			}
           ?>
</select></p>
ZIP CODE <input type="text" name="cep" /><br>
<p><input type="submit" value="Save" /></p>
</body>
</html>