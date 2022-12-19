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
    var valordepende = document.getElementById(comboAnterior)
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
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'producto_diaco.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][0]\" type=\"text\" value=\"\" id=\"textfield\"  alt=\"Doble clic para consultar el catalogo\" size=\"20\"></a>";
	

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cantidad_solicitada["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cantidad_autorizada["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\" disabled>";
  
	
	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" name=\"bien["+contLin4+"][1]\" id=\"hiddenField\">";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin4+"][4]\" type=\"hidden\" id=\"hiddenField["+contLin4+"]\"  size=\"7\">";
	
	
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
   <th width="7" rowspan="2" scope="col"><span class="Estilo2">#</span></th>
    
     <th width="579" rowspan="2" scope="col"><div align="center" class="Estilo2">Codigo del Articulo</div></th>
     
    <th height="19" colspan="2" scope="col"><span class="Estilo2">Cantidad</span></th>
  </tr>
  <tr>
  <th width="50" height="19" scope="col"><span class="Estilo2">Solicitada</span></th>
    <th width="54" scope="col"><span class="Estilo2">Autorizada</span></th>
  </tr>
</table>

<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4()" value="Borrar l&iacute;nea">

</body>
</html>