

<script language="javascript">
   function suma()
   {      
   
 var valores = 1;
 
 while(valores<contLin4) {
	  
	  var num1 = String(document.getElementById(['ingresado['+valores+']']).value);
      if(num1==undefined) num1 = 0;
      var num2 = String(document.getElementById(['costo_unitario['+valores+']']).value);
      if(num2==undefined) num2 = 0;      
      document.getElementById(['precio_total['+valores+']']).value = num1 * num2;	  
	  document.getElementById(['precio_total1['+valores+']']).value = num1 * num2;	  
	  valores++;
	}}	
	
</script>
 


<?PHP
	//require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	session_unregister("egreso");
	//session_register("ingreso");
	$_SESSION["ingreso"]=true;
?>




<head>
<?PHP

echo '<script>
var contLin4 = 1;

function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";		
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'productoIngreso.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][1]\" type=\"text\" value=\"\" id=\"bien["+contLin4+"][1]\"  alt=\"Doble clic para consultar el catalogo\" size=\"30%\" class=\"fondo\"></a>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin4+"][2]\"type=\"text\" id=\"bien["+contLin4+"][2]\" size=\"20\" class=\"fondo\"  >";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin4+"][3]\" type=\"text\" id=\"bien["+contLin4+"][3]\" size=\"20\" class=\"fondo\"  >";
   
	 
	 td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'renglon.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][5]\" type=\"text\" value=\"\" id=\"bien["+contLin4+"][5]\"  alt=\"Doble clic para consultar el catalogo\" size=\"15\" class=\"fondo\"></a>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin4+"][7]\" type=\"text\" id=\"bien["+contLin4+"][7]\" size=\"45\" class=\"fondo\"> ";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"ingresado["+contLin4+"]\" type=\"text\" id=\"ingresado["+contLin4+"]\" onblur=\"javascript:suma()\" size=\"7\" class=\"fondo\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input class=\"fondo\" name=\"costo_unitario["+contLin4+"]\" type=\"text\" id=\"costo_unitario["+contLin4+"]\" onblur=\"javascript:suma()\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"precio_total["+contLin4+"]\" type=\"text\" id=\"precio_total["+contLin4+"]\"  size=\"7\" >";
	

	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"precio_total1["+contLin4+"]\" type=\"hidden\" id=\"precio_total1["+contLin4+"]\" size=\"7\" >";
  

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin4+"][4]\" type=\"hidden\" id=\"bien["+contLin4+"][4]\"  size=\"7\">";
	
	td = tr.insertCell();
	contLin4++;
}

function borrarUltima4() {
	ultima = document.all.tabla4.rows.length - 1;
	if (ultima !=1)
	{
	 document.all.tabla4.deleteRow(ultima);
	 contLin4--;
	}
}
</script>';
?>
<style type="text/css">
<!--
.Estilo2 {font-size: x-small;}
.fondo{
	background: #DEDADA;
}
-->
</style>
</head>
<body>


<table width="99%" border=1 cellspacing="0" id="tabla4" class="Estilo2">
  <tr >
    <th width="11" rowspan="2" scope="col">#</th>
    <th width="154" rowspan="2" scope="col">Codigo</th>
    <th width="187" rowspan="2" scope="col">Categoria</th>
    <th width="152" rowspan="2" scope="col">Sub-Categoria</th>
    <th width="130" rowspan="2" scope="col">Renglon</th>
    <th width="301" rowspan="2" scope="col">Producto</th>
    <th width="86" rowspan="2" scope="col">Cantidad Ingresada</th>
    <th width="78" rowspan="2" scope="col">Costo unitario</th>
    <th width="82" rowspan="2" scope="col">Precio Total</th>
    
  </tr>
  <tr>
  </tr>
</table>

<br>

<input name="Bot&oacute;n" type="button" class="boton grey" onClick="agregar4()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button"  class="boton grey" onClick="borrarUltima4()" value="Borrar l&iacute;nea">


</body>
</html>