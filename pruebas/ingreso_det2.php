<?PHP
	//require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	session_unregister("egreso");
	//session_register("ingreso");
	$_SESSION["ingreso"]=true;
?>
<head>
<script type="text/javascript">
var peticion = false;
var  testPasado = false;
try {
  peticion = new XMLHttpRequest();
  } catch (trymicrosoft) {
  try {
  peticion = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (othermicrosoft) {
  try {
  peticion = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (failed) {
  peticion = false;
  }
  }
}

if (!peticion)
alert("ERROR AL INICIALIZAR!");

function cargarCombo (url, comboAnterior, element_id) {
    //Obtenemos el contenido del div
    //donde se cargaran los resultados
    var element =  document.getElementById(element_id);	

    //Obtenemos el valor seleccionado del combo anterior
    var valordepende = document.getElementById(comboAnterior);
 
	var x = valordepende.value
    //construimos la url definitiva
    //pasando como parametro el valor seleccionado
    var fragment_url = url+'?Id='+x;
    element.innerHTML = '<img src="../images/loading.gif" />';
    //abrimos la url
    peticion.open("GET", fragment_url);
    peticion.onreadystatechange = function() {
      if (peticion.readyState == 4) {
//escribimos la respuesta
element.innerHTML = peticion.responseText;
        }
    }
   peticion.send(null);
}

</script>


<?PHP
//require('../includes/inc_header_sistema.inc');
//$dbms2=new DBMS($conexion);
//$dbms2->bdd=$database_cnn;
	

function get_banco_opciones1($dbms1)
{
	
	$qry_bodega = mssql_query("select codigo_bodega, bodega from cat_bodega");																									
	if ($qry_bodega)
		{
			while($row = mssql_fetch_row($qry_bodega))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}


function get_banco_opciones2($dbms2)
{
	
	$qry_categoria = mssql_query("select codigo_categoria, categoria from cat_categoria");																									
	if ($qry_categoria)
		{
			while($row = mssql_fetch_row($qry_categoria))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}



?>

<head>
<?PHP
$op1 = get_banco_opciones1($dbms1);
$op2 = get_banco_opciones2($dbms2);


echo '<script>
var contLin4 = 1;
function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";

	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"bodega["+contLin4+"]\" id=\"select\">';
	echo $op1;
	echo '</select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'categorias.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][0]\" type=\"text\" value=\"\" id=\"textfield\"  alt=\"Doble clic para consultar el catalogo\" size=\"10\"></a>";
	
	
    td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'subcategoria.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][0]\" type=\"text\" value=\"\" id=\"textfield\"  alt=\"Doble clic para consultar el catalogo\" size=\"10\"></a>";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"unidadmedida["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"10\">";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"unidadmedida["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"10\">";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"unidadmedida["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cantidad["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"costo_unitario["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
  
    td = tr.insertCell();
	td.innerHTML = 	"<input name=\"costo_unitario["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";	
 
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
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">Bodega</span></th>
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">Categoria</span></th>
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">SubCategoria</span></th>
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">Articulo</span></th>
    <th width="57" rowspan="2" scope="col"><div align="center" class="Estilo2">Descripci&oacute;n</div></th>
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">Unidad de Medida</span></th>
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">Cantidad Solicitada</span></th>
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">Costo unitario</span></th>
    <th width="57" rowspan="2" scope="col"><span class="Estilo2">Precio Total</span></th>
  </tr>
  <tr>
  </tr>
</table>

<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4()" value="Borrar l&iacute;nea">

</body>
</html>