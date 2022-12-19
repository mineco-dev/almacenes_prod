<?PHP
	//require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	session_unregister("egreso");
	//session_register("ingreso");
	$_SESSION["ingreso"]=true;
?>
  
<?PHP
//require('../includes/inc_header_sistema.inc');
//$dbms2=new DBMS($conexion);
//$dbms2->bdd=$database_cnn;
	
function get_banco_opciones($dbms2)
{
	/*$query = "select id_parentesco,parentesco from parentesco order by id_parentesco";
	$dbms2->sql=$query;
	$dbms2->Query();
	$opciones = "";
	while($Fields=$dbms2->MoveNext())*/		
	$qry_bodega = mssql_query("select * from cat_bodega where activo=1 and codigo_bodega=1 order by bodega");																									
	if ($qry_bodega)
		{
			while($row = mssql_fetch_row($qry_bodega))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

?>
<html>
<head>
<?PHP
$op = get_banco_opciones($dbms2);
$anio = anio();
$mes = mes();
$dia = dia();
echo '<script>
var contLin4 = 1;
function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"bodega["+contLin4+"]\" id=\"select\">';
	echo $op;
	echo '</select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onClick=\"buscar=window.open(\'producto.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=600,height=300,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][0]\" type=\"text\" value=\"[CLIC AQUI PARA BUSCAR]\" id=\"textfield\" disabled size=\"30\"></a>";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"ingresado["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"solicitado["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"costo_unitario["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"lote["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"diavence["+contLin4+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"mesvence["+contLin4+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"aniovence["+contLin4+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";		
	
	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" name=\"bien["+contLin4+"][1]\" id=\"hiddenField\">";
	
	td = tr.insertCell();
	contLin4++;
}

function borrarUltima4() {
	ultima = document.all.tabla4.rows.length - 1;
	if (ultima !=0)
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
    <th width="7" rowspan="2" scope="col"><span class="Estilo2">#</span></th>
    <th width="64" rowspan="2" scope="col"><span class="Estilo2">Bodega destino </span></th>
    <th width="579" rowspan="2" scope="col"><div align="center" class="Estilo2">Descripci&oacute;n</div></th>
    <th height="19" colspan="2" scope="col"><span class="Estilo2">Cantidad</span></th>
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">Costo unitario </span></th>
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">No. de Lote </span></th>
    <th colspan="3" scope="col"><span class="Estilo2">Vence</span></th>
  </tr>
  <tr>
	<th width="50" height="19" scope="col"><span class="Estilo2">Recibida</span></th>
    <th width="54" scope="col"><span class="Estilo2">Solicitada</span></th>
    <th scope="col" width="16"><span class="Estilo2">dia</span></th>
    <th scope="col" width="22"><span class="Estilo2">mes</span></th>
    <th scope="col" width="45"><span class="Estilo2">a�o</span></th>
  </tr>
</table>

<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4()" value="Borrar l&iacute;nea">

</body>
</html>