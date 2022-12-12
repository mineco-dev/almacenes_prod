<?php
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");

	if (isset($_REQUEST["tipo"]))
	{
		// //session_register("tipo");
		$_SESSION["tipo"]=$_REQUEST["tipo"];
		// //session_register("posi");
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ajax_request.js"></script>
<script type="text/javascript">

function obtenVal(op){
	
	var urlarg = '';
	if (op > 0)
	{
	    if (op == 1) urldestino = 'individual.php?';
	    if (op == 2) urldestino = 'representantemandatario.php?';
	    ajax_request(urldestino,'embebida',true);
	}
}

</script>

<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "" && form.txt_buscarx.value =="")
  { 
  	alert("Escriba el nombre o apellido del empleado para realizar la búsqueda"); 
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

.Estilo1 {font-size: 12px}
.Estilo3 {color: #FFFFFF}

</style>
</head>

<body>
<div align="left">
  <form name="form1" method="post" action="">
    <table width="100%" border="0" bordercolor="#ECE9D8">
      <tr>
        <td><div align="left" class="titulocategoria">
          <div align="center">Catalogo de Productos</div>
        </div></td>
      </tr>
      <tr>
        <td><center>
            </center></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1">
          <div align="left">
            <p><strong><strong>            [<a href="productoIngreso.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="productoIngreso.php?in=B">B</a>] [<a href="productoIngreso.php?in=C">C</a>] [<a href="productoIngreso.php?in=D">D</a>] [<a href="productoIngreso.php?in=E">E</a>] [<a href="productoIngreso.php?in=F">F</a>] [<a href="productoIngreso.php?in=G">G</a>] [<a href="productoIngreso.php?in=H">H</a>] [<a href="productoIngreso.php?in=I">I</a>] [<a href="productoIngreso.php?in=J">J</a>] [<a href="productoIngreso.php?in=K">K</a>] [<a href="productoIngreso.php?in=L">L</a>] [<a href="productoIngreso.php?in=M">M</a>] [<a href="productoIngreso.php?in=N">N</a>] [<a href="productoIngreso.php?in=O">O</a>] [<a href="productoIngreso.php?in=P">P</a>] [<a href="productoIngreso.php?in=Q">Q</a>] [<a href="productoIngreso.php?in=R">R</a>] [<a href="productoIngreso.php?in=S">S</a>] [<a href="productoIngreso.php?in=T">T</a>] [<a href="productoIngreso.php?in=U">U</a>] [<a href="productoIngreso.php?in=V">V</a>] [<a href="productoIngreso.php?in=W">W</a>] [<a href="productoIngreso.php?in=X">X</a>] [<a href="productoIngreso.php?in=Y">Y</a>] [<a href="productoIngreso.php?in=Z">Z</a>] [<a href="productoIngreso.php?in=all">[TODO]</a>]<BR></strong></strong><strong><strong>
            <input name="txt_buscarx" type="text" id="txt_buscar2x" size="30"  placeholder="Código de producto">  
			<input name="txt_buscar" type="text" id="txt_buscar2" size="30" placeholder= "ESCRIBA NOMBRE PRODUCTO, USO O CÓDIGO DE PRODUCTO">
                <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar" >
    
            </div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="0" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
        <td width="9%" class="titulotabla"><div align="center"><strong>Seleccionar
        </strong></div></td>
        <td width="10%" class="titulotabla"><strong>Codigo Producto</strong></td>
        <td width="50%" class="titulotabla">Producto</td>

      </tr>
		<?php
				if ($_REQUEST["txt_buscar"]!="")
				{
					$busqueda=strtoupper(utf8_decode($_REQUEST["txt_buscar"]));					
					$consulta = "SELECT distinct     p.rowid, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto,  p.codigo_subcategoria,
					p.codigo_categoria,  p.activo,  p.codigo_producto, p.uso
					FROM     cat_producto p
					INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
					where (p.producto like '%$busqueda%' or p.uso like '%$busqueda%')";
					
				}
				else{
					if ($_REQUEST["txt_buscarx"]!="")
					{
						$busqueda=strtoupper($_REQUEST["txt_buscarx"]);	
						$consulta = "SELECT distinct     p.rowid, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto,  p.codigo_subcategoria,
						p.codigo_categoria,  p.activo,  p.codigo_producto, p.uso
						FROM     cat_producto p
						INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
						where (p.codigo_producto = TRY_CAST ($busqueda as int))";
					}
					else{
						if (isset($_REQUEST["in"]))	
						{
							$inicial=$_REQUEST["in"];
							echo "Listado de categoria inicia con $inicial";
							if ($inicial!="all")
								$consulta = "SELECT distinct     p.rowid, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto,  p.codigo_subcategoria,
										p.codigo_categoria,  p.activo,  p.codigo_producto, p.uso
										FROM     cat_producto p
										INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
										where p.producto like '$inicial%'";
										
								else
									$consulta = "SELECT  distinct    p.rowid, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto,  p.codigo_subcategoria,
												p.codigo_categoria,  p.activo,  p.codigo_producto, p.uso
												FROM     cat_producto p
												INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
												order by p.producto";
						}
						else
						{
							$consulta =     "SELECT distinct     p.rowid, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto,  p.codigo_subcategoria,
							p.codigo_categoria,  p.activo,  p.codigo_producto, p.uso
							FROM     cat_producto p
							INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
							where p.producto like 'a%'";
						}

					}

					
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
					echo "<td class='boton'><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar esta categoria\"></a></center></td>";					
					echo '<td>'.$row["codigo_producto"].'</td><td>'.utf8_encode($row["producto"]).'</td><td style="display:none;">'.$row["codigo_categoria"].'</td><td style="display:none;" >'.$row["codigo_subcategoria"].'</td><td style="display:none;"  >'.$row["rowid"].'</td></tr>';											
					$i++;
				}				
				$free_result($result);				
			 ?>
    </table>
  </form>
  <p>&nbsp;</p>
</div>



<script type="text/javascript">   
window.onload = function(){
        $(".boton").click(function(){
            var valores= new Array();
            $(this).parents("tr").find("td").each(function(){
                valores.push($(this).html())
            });

var posi = '<?php echo $posi; ?>';
var tipo = '<?php echo $tipo; ?>'

window.opener.document.getElementById(tipo+"["+posi+"][1]").value = valores[1];
window.opener.document.getElementById(tipo+"["+posi+"][4]").value = valores[1];
// window.opener.document.getElementById(tipo+"["+posi+"][12]").value = valores[1];
window.opener.document.getElementById(tipo+"["+posi+"][2]").value = valores[3];
window.opener.document.getElementById(tipo+"["+posi+"][5]").value = valores[3];
window.opener.document.getElementById(tipo+"["+posi+"][3]").value = valores[4];
window.opener.document.getElementById(tipo+"["+posi+"][7]").value = valores[2];
window.close();
window.opener.focus();

        });
};


</script>
</body>

</html>