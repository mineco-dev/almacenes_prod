


<?PHP
	//require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	$empresa = ($_POST['cbo_tipo_empresa']);
	
	session_unregister("egreso");
	//session_register("ingreso");
	$_SESSION["ingreso"]=true;
?>
<head>


<?PHP
//require('../includes/inc_header_sistema.inc');
//$dbms2=new DBMS($conexion);
//$dbms2->bdd=$database_cnn;
	


?>

<head>
<?PHP


echo '<script language="javascript">
var contLin4 = 1;
function agregar4() {
	
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'producto_micro.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=900,height=600,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][0]\" type=\"text\" value=\"\" id=\"textfield\"  alt=\"Doble clic para consultar el catalogo\" size=\"10\"></a>";
	

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin4+"][7]\" type=\"text\" id=\"textfield\" size=\"70\" disabled>";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin4+"][5]\" type=\"text\" id=\"textfield\" size=\"15\" disabled>";
	

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin4+"][6]\" type=\"text\" id=\"textfield\" size=\"15\" disabled>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cantidad_solicitada["+contLin4+"]\" type=\"text\" id=\"cantidad_solicitada["+contLin4+"]\" size=\"15\">";
	
   
  
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin4+"][4]\" type=\"hidden\" id=\"hiddenField["+contLin4+"]\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" name=\"bien["+contLin4+"][1]\" id=\"hiddenField\">";
 
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
.Estilo2 {font-size: x-small}
-->
</style>
</head>
<body>


<table width="99%" border=1 cellspacing="0" id="tabla4">
  <tr>
   <th width="6" rowspan="2" scope="col"><span class="Estilo2">#</span></th>

    <th width="121" rowspan="2" scope="col"><div align="center" class="Estilo2">Codigo del Articulo</div></th>
    <th width="288" rowspan="2" scope="col"><div align="center" class="Estilo2">Articulo</div></th>
    <th width="154" rowspan="2" scope="col"><div align="center" class="Estilo2">Categoria</div></th>
    <th width="190" rowspan="2" scope="col"><div align="center" class="Estilo2">Subcategoria</div></th>
   <th width="147" rowspan="2" scope="col"><div align="center" class="Estilo2">Cantidad Solicitada</div></th>
   
  </tr>
 <tr>
  </tr>
</table>

<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4()" value="Borrar l&iacute;nea">

</body>
</html>