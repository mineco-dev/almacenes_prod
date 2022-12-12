<?php
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
?>
<?PHP
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
		alert("Escriba el nombre del medicamento o parte del mismo para realizar la búsqueda"); 
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
.oculto {
	display:none;
}
-->
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
							<p><strong><strong>            [<a href="producto.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="producto.php?in=B">B</a>] [<a href="producto.php?in=C">C</a>] [<a href="producto.php?in=D">D</a>] [<a href="producto.php?in=E">E</a>] [<a href="producto.php?in=F">F</a>] [<a href="producto.php?in=G">G</a>] [<a href="producto.php?in=H">H</a>] [<a href="producto.php?in=I">I</a>] [<a href="producto.php?in=J">J</a>] [<a href="producto.php?in=K">K</a>] [<a href="producto.php?in=L">L</a>] [<a href="producto.php?in=M">M</a>] [<a href="producto.php?in=N">N</a>] [<a href="producto.php?in=O">O</a>] [<a href="producto.php?in=P">P</a>] [<a href="producto.php?in=Q">Q</a>] [<a href="producto.php?in=R">R</a>] [<a href="producto.php?in=S">S</a>] [<a href="producto.php?in=T">T</a>] [<a href="producto.php?in=U">U</a>] [<a href="producto.php?in=V">V</a>] [<a href="producto.php?in=W">W</a>] [<a href="producto.php?in=X">X</a>] [<a href="producto.php?in=Y">Y</a>] [<a href="producto.php?in=Z">Z</a>] <a href="producto.php?in=all">[TODO]</a><BR></strong></strong><strong><strong>
								<input name="txt_buscar" type="text" id="txt_buscar2" size="30">
								<input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
								(ESCRIBA NOMBRE, APELLIDO O DEPENDENCIA)</strong></strong></p>
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
					<?PHP
					if ($_REQUEST["txt_buscar"]!="")
					{
						$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
						// $consulta = "SELECT distinct     p.rowid, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto,  p.codigo_subcategoria,
						// p.codigo_categoria,  p.activo,  p.codigo_producto, p.uso
						// FROM     cat_producto p
						// INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
						// where (p.producto like '%$busqueda%' or p.uso like '%$busqueda%')";
						$consulta = "SELECT  p.rowid ,(p.producto +' - '+ p.marca +' EN '+ cat_medida.unidad_medida) as producto,
						p.codigo_subcategoria, p.codigo_categoria, 
						p.activo, p.codigo_producto, p.uso, tb_inventario.existencia
						FROM            cat_medida 
						INNER JOIN cat_producto p  
							ON cat_medida.codigo_medida = p.codigo_medida 
						INNER JOIN tb_inventario 
							ON p.codigo_categoria = tb_inventario.codigo_categoria 
						AND p.codigo_subcategoria = tb_inventario.codigo_subcategoria 
						AND p.codigo_producto = tb_inventario.codigo_producto
						WHERE 
						(tb_inventario.existencia >= 1 and p.producto like '%$busqueda%'   and p.activo = 1  and tb_inventario.codigo_bodega= 8 )
						or (p.uso like '%$busqueda%'   and p.activo = 1  and tb_inventario.codigo_bodega= 8 and tb_inventario.existencia >= 1)";

					}
					else	
						if (isset($_REQUEST["in"]))	
						{
							$inicial=$_REQUEST["in"];
							echo "Listado de categoria inicia con $inicial";
							if ($inicial!="all")
							// 	$consulta = "SELECT distinct     p.rowid, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto,  p.codigo_subcategoria,
							// p.codigo_categoria,  p.activo,  p.codigo_producto, p.uso
							// FROM     cat_producto p
							// INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
							// where p.producto like '$inicial%'";
								$consulta = "SELECT  p.rowid ,(p.producto +' - '+ p.marca +' EN '+ cat_medida.unidad_medida) as producto,
								p.codigo_subcategoria, p.codigo_categoria, 
								p.activo, p.codigo_producto, p.uso, tb_inventario.existencia
								FROM            cat_medida 
								INNER JOIN cat_producto p  ON cat_medida.codigo_medida = p.codigo_medida 
								INNER JOIN tb_inventario ON p.codigo_categoria = tb_inventario.codigo_categoria AND p.codigo_subcategoria = tb_inventario.codigo_subcategoria 
								AND p.codigo_producto = tb_inventario.codigo_producto
								WHERE 
								(tb_inventario.existencia >= 1 and p.producto like '$inicial%'  and tb_inventario.codigo_bodega= 8 and p.activo = 1)";

							else
								// $consulta = "SELECT  distinct    p.rowid, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto,  p.codigo_subcategoria,
								// p.codigo_categoria,  p.activo,  p.codigo_producto, p.uso
								// FROM     cat_producto p
								// INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
								// order by p.producto";
								$consulta = "SELECT  p.rowid ,(p.producto +' - '+ p.marca +' EN '+ cat_medida.unidad_medida) as producto,
								p.codigo_subcategoria, p.codigo_categoria, 
								p.activo, p.codigo_producto, p.uso, tb_inventario.existencia
								FROM            cat_medida 
								INNER JOIN cat_producto p  ON cat_medida.codigo_medida = p.codigo_medida 
								INNER JOIN tb_inventario ON p.codigo_categoria = tb_inventario.codigo_categoria AND p.codigo_subcategoria = tb_inventario.codigo_subcategoria 
								AND p.codigo_producto = tb_inventario.codigo_producto
								WHERE 
								(tb_inventario.existencia >= 1   and tb_inventario.codigo_bodega= 8  and p.activo = 1)
								order by p.producto";

						}
						else
						{
							// $consulta =     "SELECT distinct     p.rowid, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto,  p.codigo_subcategoria,
							// p.codigo_categoria,  p.activo,  p.codigo_producto, p.uso
							// FROM     cat_producto p
							// INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
							// where p.producto like 'a%'";
							$consulta = "SELECT  p.rowid ,(p.producto +' - '+ p.marca +' EN '+ cat_medida.unidad_medida) as producto,
								p.codigo_subcategoria, p.codigo_categoria, 
								p.activo, p.codigo_producto, p.uso, tb_inventario.existencia
								FROM            cat_medida 
								INNER JOIN cat_producto p  ON cat_medida.codigo_medida = p.codigo_medida 
								INNER JOIN tb_inventario ON p.codigo_categoria = tb_inventario.codigo_categoria AND p.codigo_subcategoria = tb_inventario.codigo_subcategoria 
								AND p.codigo_producto = tb_inventario.codigo_producto
								WHERE (tb_inventario.existencia >= 1  and tb_inventario.codigo_bodega= 8 and p.activo = 1)  or (tb_inventario.existencia >= 1  and tb_inventario.codigo_bodega=8 and p.activo = 1)";

						}

						//echo $consulta;
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
							echo '<td>'.$row["codigo_producto"].'</td><td>'.utf8_encode($row["producto"]).'</td><td class="oculto">'.$row["codigo_categoria"].'</td><td class="oculto">'.$row["codigo_subcategoria"].'</td><td class="oculto" >'.$row["rowid"].'</td> <td class="oculto">'.$row["existencia"].'</td> </tr>';	

					// echo '<tr class='.$clase.'>';
					// echo "<td><a href=\"javascript:void(0)\" onClick=\"window.opener.document.getElementById('$tipo"."[".$posi."][1]').value = '$completo'; 
					// window.opener.document.getElementById('$tipo"."[".$posi."][4]').value = '".$row["rowid"]."';
			  //    	window.opener.document.getElementById('$tipo"."[".$posi."][7]').value = '".$row["producto"]."';
					// window.opener.document.getElementById('$tipo"."[".$posi."][2]').value = '".$row["codigo_categoria"]."';
					// window.opener.document.getElementById('$tipo"."[".$posi."][3]').value = '".$row["codigo_subcategoria"]."';
					// window.opener.document.getElementById('$tipo"."[".$posi."][5]').value = '".$row["codigo_categoria"]."';
					// window.close();
					// window.opener.focus(); 
					// return false;\"><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar esta categoria\"></a></center></td>";					
					// echo '<td>'.$row["codigo_producto"].'</td><td>'.$row["producto"].'</td></tr>';										
							$i++;
						}				
						$free_result($result);				
						?>
					</table>
				</form>
				<p>&nbsp;</p>
			</div>



			<script type="text/javascript">   


			function valor_celda(celda){

				alert(celda.innerHTML);
				window.opener.document.getElementById("nombre[0][1]").value = celda.innerHTML ;
				window.close();
				window.opener.focus();
			}

			window.onload = function(){

				$(".boton").click(function(){



					var valores= new Array();



            // Obtenemos todos los valores contenidos en los <td> de la fila

            // seleccionada

            $(this).parents("tr").find("td").each(function(){

                // valores+=$(this).html()+"\n";
                valores.push($(this).html())


            });

            var posi = '<?php echo $posi; ?>';
            var tipo = '<?php echo $tipo; ?>'


            window.opener.document.getElementById(tipo+"["+posi+"][1]").value = valores[1];
            window.opener.document.getElementById(tipo+"["+posi+"][7]").value = valores[2];
            window.opener.document.getElementById(tipo+"["+posi+"][5]").value = valores[3];
            window.opener.document.getElementById(tipo+"["+posi+"][6]").value = valores[4];
            window.opener.document.getElementById(tipo+"["+posi+"][4]").value = valores[5];
			window.opener.document.getElementById(tipo+"["+posi+"][8]").value = valores[6];

            window.close();
            window.opener.focus();

        });



// var tags_td = new Array();
// var tags_td=document.getElementsByTagName('td');
// for (i=0; i<tags_td.length; i++) {
//             if (tags_td[i].addEventListener) {   // IE9 y el resto
//                 tags_td[i].addEventListener ("click", function () {valor_celda(this)}, false);
//             } 
//             else {
//                 if (tags_td[i].attachEvent) {    // IE9 -
// //                    tags_td[i].attachEvent ('onclick',  function () {valor_celda(this)}, false);
//    tags_td[i].setAttribute('onclick', 'valor_celda(this)');                 

//                 }
//             }
// }
};


</script>
</body>

</html>