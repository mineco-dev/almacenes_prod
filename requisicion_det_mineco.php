
<?PHP
	//require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	$empresa = ($_POST['cbo_tipo_empresa']);
	
	session_unregister("egreso");
	//session_register("ingreso");
	$_SESSION["ingreso"]=true;
?>

<?PHP
//require('../includes/inc_header_sistema.inc');
//$dbms2=new DBMS($conexion);
//$dbms2->bdd=$database_cnn;

?>

<head>
<?PHP

echo '
<script language="javascript">
var contLin4 = 1;
function agregar4() {
	
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";

	td = tr.insertCell();
	
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'producto.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input  style=\"border:none\" id=\"bien["+contLin4+"][1]\" type=\"text\" value=\"\"  alt=\"Doble clic para consultar el catalogo\" size=\"15%\"></a>";


	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input style=\"border:none;background:#fff\" id=\"bien["+contLin4+"][7]\" type=\"text\"  size=\"50%\" disabled>";

	td = tr.insertCell();
	td.innerHTML = 	"<input  id=\"bien["+contLin4+"][5]\" type=\"text\"  size=\"12%\" disabled>";
	

	td = tr.insertCell();
	td.innerHTML = 	"<input id=\"bien["+contLin4+"][6]\" type=\"text\"  size=\"12%\" disabled>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input id=\"cantidad_solicitada["+contLin4+"]\" type=\"text\" name=\"cantidad_solicitada["+contLin4+"]\" size=\"10%\" >";
   
  
	td = tr.insertCell();
	td.innerHTML = 	"<input id=\"bien["+contLin4+"][4]\" type=\"hidden\" name=\"bien["+contLin4+"][4]\" border=\"0\" >";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" id=\"bien["+contLin4+"][1]\" name=\"bien["+contLin4+"][1]\" border=\"0\" >";

	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" id=\"bien["+contLin4+"][8]\" name=\"bien["+contLin4+"][8]\" value = "+contLin4+"  border=\"0\" >";
 
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
<!-- 
name=\"hiddenField\"
name=\"hiddenField["+contLin4+"]\" -->
<table width="100%" border=1 cellspacing="0" id="tabla4">
  <tr>
   <th width="1%"  scope="col"><span class="Estilo2">#</span></th>
    <th width="10%" rowspan="2" scope="col"><div align="center" class="Estilo2">Codigo del Articulo</div></th>
    <th width="20%" rowspan="2" scope="col"><div align="center" class="Estilo2">Articulo</div></th>
    <th width="5%" rowspan="2" scope="col"><div align="center" class="Estilo2">Categoria</div></th>
    <th width="5%" rowspan="2" scope="col"><div align="center" class="Estilo2">Subcategoria</div></th>
   <th width="10%" rowspan="2" scope="col"><div align="center" class="Estilo2">Cantidad Solicitada</div></th>
<!--    <th width="1%"></th>
   <th width="1%"></th>
   <th width="1%"></th>
   <th width="1%"></th> -->

   
  </tr>
 <tr>
  </tr>
</table>
<br>
<input name="Bot&oacute;n"  class="boton grey" type="button" onClick="agregar4()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n"  class="boton grey" type="button" onClick="borrarUltima4()" value="Borrar l&iacute;nea">

</body>
<script type="text/javascript">
	


</script>
</html>