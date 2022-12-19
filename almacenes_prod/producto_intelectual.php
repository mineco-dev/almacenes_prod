<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
	if (isset($_REQUEST["tipo"]))
	{
		//session_register("tipo");
		$_SESSION["tipo"]=$_REQUEST["tipo"];
		//session_register("posi");
		$_SESSION["posi"]=$_REQUEST["posi"];
		$tipo=$_REQUEST["tipo"];
		$posi=$_REQUEST["posi"];
	}
	else
	{
		$tipo=$_SESSION["tipo"];
		$posi=$_SESSION["posi"];
	}	
?>
<html>
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

<script language="JavaScript" type="text/javascript" src="../includes/ajax_request.js"></script>
<script type="text/javascript">
<!--
function obtenVal(op){
	
	var urlarg = '';
	if (op > 0)
	{
	    if (op == 1) urldestino = 'individual.php?';
	    if (op == 2) urldestino = 'representantemandatario.php?';
	    ajax_request(urldestino,'embebida',true);
	}
}
//-->
</script>

<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Debe escribir por lo menos parte del nombre del producto para realizar la b�squeda"); 
	form.txt_buscar.focus(); 
	return;
  }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>
<div align="left">
  <form name="form1" method="post" action="">
    <table width="100%" border="0" bordercolor="#ECE9D8">
      <tr>
        <td><div align="left" class="titulocategoria">
          <div align="center">FORMULARIO PARA B&Uacute;SQUEDA DE PRODUCTOS </div>
        </div></td>
      </tr>
      <tr>
        <td><center>
            </center></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1">
          <div align="left">
            <p><strong><strong>            [<a href="producto_intelectual.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="producto_intelectual.php?in=B">B</a>] [<a href="producto_intelectual.php?in=C">C</a>] [<a href="producto_intelectual.php?in=D">D</a>] [<a href="producto_intelectual.php?in=E">E</a>] [<a href="producto_intelectual.php?in=F">F</a>] [<a href="producto_intelectual.php?in=G">G</a>] [<a href="producto_intelectual.php?in=H">H</a>] [<a href="producto_intelectual.php?in=I">I</a>] [<a href="producto_intelectual.php?in=J">J</a>] [<a href="producto_intelectual.php?in=K">K</a>] [<a href="producto_intelectual.php?in=L">L</a>] [<a href="producto_intelectual.php?in=M">M</a>] [<a href="producto_intelectual.php?in=N">N</a>] [<a href="producto_intelectual.php?in=O">O</a>] [<a href="producto_intelectual.php?in=P">P</a>] [<a href="producto_intelectual.php?in=Q">Q</a>] [<a href="producto_intelectual.php?in=R">R</a>] [<a href="producto_intelectual.php?in=S">S</a>] [<a href="producto_intelectual.php?in=T">T</a>] [<a href="producto_intelectual.php?in=U">U</a>] [<a href="producto_intelectual.php?in=V">V</a>] [<a href="producto_intelectual.php?in=W">W</a>] [<a href="producto_intelectual.php?in=X">X</a>] [<a href="producto_intelectual.php?in=Y">Y</a>] [<a href="producto_intelectual.php?in=Z">Z</a>] <a href="producto_intelectual.php?in=all">[TODO]</a>
                </strong></strong></p>
            <p><strong><strong>
                <input name="txt_buscar" type="text" id="txt_buscar2" size="20">
                <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
    (ESCRIBA EL NOMBRE DEL PRODUCTO O EL USO) </strong></strong></p>
          </div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="0" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
        <td width="10%" class="titulotabla"><div align="center"><strong>Seleccionar</strong></div></td>
        <td width="10%" colspan="-1" class="thead Estilo3"><span class="titulotabla">Codigo Producto</span></td> 
        <td class="titulotabla"><strong><strong>Descripci&oacute;n - marca y presentaci&oacute;n </strong></strong></td>
        <td width="10%" colspan="-1" class="thead Estilo3"><span class="titulotabla">Existencias</span></td>
        <td width="20%" class="titulotabla"><strong>Bodega</strong></td>
      </tr>
		<?PHP
				if ($_REQUEST["txt_buscar"]!="")
				{
				$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
				$consulta = "SELECT     (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto, i.rowid, p.codigo_subcategoria,
p.codigo_categoria,  p.activo, i.existencia, p.codigo_producto, p.uso, b.bodega, e.empresa 
FROM     cat_producto p
INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
INNER JOIN tb_inventario i ON p.codigo_producto = i.codigo_producto and p.codigo_subcategoria=i.codigo_subcategoria and p.codigo_categoria=i.codigo_categoria
INNER JOIN cat_bodega b ON b.codigo_bodega = i.codigo_bodega
INNER JOIN cat_empresa e ON e.codigo_empresa = i.codigo_empresa
							where (p.producto like '%$busqueda%' or p.uso like '%$busqueda%') and p.activo=1 and i.codigo_empresa='4' order by bodega";																		
				}
				else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];
					if ($inicial!="all")
						$consulta = "SELECT     (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto, i.rowid, p.codigo_subcategoria,
p.codigo_categoria,  p.activo, i.existencia, p.codigo_producto, p.uso, b.bodega, e.empresa 
FROM     cat_producto p
INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
INNER JOIN tb_inventario i ON p.codigo_producto = i.codigo_producto and p.codigo_subcategoria=i.codigo_subcategoria and p.codigo_categoria=i.codigo_categoria
INNER JOIN cat_bodega b ON b.codigo_bodega = i.codigo_bodega
INNER JOIN cat_empresa e ON e.codigo_empresa = i.codigo_empresa
							        where p.producto like '$inicial%' and i.codigo_empresa='4'";
						else
							$consulta = "SELECT     (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto, i.rowid, p.codigo_subcategoria,
p.codigo_categoria,  p.activo, i.existencia, p.codigo_producto, p.uso, b.bodega, e.empresa 
FROM     cat_producto p
INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
INNER JOIN tb_inventario i ON p.codigo_producto = i.codigo_producto and p.codigo_subcategoria=i.codigo_subcategoria and p.codigo_categoria=i.codigo_categoria
INNER JOIN cat_bodega b ON b.codigo_bodega = i.codigo_bodega
INNER JOIN cat_empresa e ON e.codigo_empresa = i.codigo_empresa 
							 			where i.codigo_empresa='4'
										order by p.producto";
				}
				else
				{
					$consulta = "SELECT     (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto, i.rowid, p.codigo_subcategoria,
p.codigo_categoria,  p.activo, i.existencia, p.codigo_producto, p.uso, b.bodega, e.empresa 
FROM     cat_producto p
INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
INNER JOIN tb_inventario i ON p.codigo_producto = i.codigo_producto and p.codigo_subcategoria=i.codigo_subcategoria and p.codigo_categoria=i.codigo_categoria
INNER JOIN cat_bodega b ON b.codigo_bodega = i.codigo_bodega
INNER JOIN cat_empresa e ON e.codigo_empresa = i.codigo_empresa
							where p.producto like 'A%' and i.codigo_empresa='4'";
				}
				conectardb($almacen);
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$completo=$row["codigo_producto"];
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
						echo '<tr class='.$clase.'>';
						echo "<td><a href=\"javascript:void(0)\" onClick=\"window.opener.document.getElementById('$tipo"."[".$posi."][0]').value = '$completo'; 
						window.opener.document.getElementById('$tipo"."[".$posi."][4]').value = '".$row["rowid"]."';
						window.close();
						window.opener.focus(); 
						return false;\"><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar este producto\"></a></center></td>";					
						echo '<td>'.$row["codigo_producto"].'</td><td>'.$row["producto"].'</td><td>'.$row["existencia"].'</td><td>'.$row["bodega"].'</td></tr>';																				
					$i++;
				}
				$free_result($result);
			 ?>
    </table>
  </form> 
</div>
</body>
</html>
