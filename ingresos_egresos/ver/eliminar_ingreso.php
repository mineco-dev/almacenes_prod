<?php
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($almacen));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
    
	//require("../includes/funciones.php");
	//require("../includes/sqlcommand.inc");
	

	$idsolicitud=$_REQUEST["id"];
	
     //conectardb($almacen);
// 	$Fields="select distinct  d.rowid, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante, 
// e.fecha_ingreso,  cast (e.observaciones as varchar(500))as observaciones, dep.nombre, d.codigo_renglon, ac.actividad, e.codigo_programa, pro.programa, e.codigo_actividad, d.costo_unidad, d.precio_total, e.userfile, d.codigo_bodega, d.codigo_empresa, e.no_ingreso,
// d.codigo_ingreso_enc, b.bodega, prove.nombre as proveedor, prove.nit,
//  d.cantidad_ingresada from tb_ingreso_det d
// inner join tb_ingreso_enc e on
// e.codigo_ingreso_enc = d.codigo_ingreso_enc
// inner join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
// inner join cat_categoria c on d.codigo_categoria = c.codigo_categoria 
// inner join cat_bodega b on
// b.codigo_bodega = d.codigo_bodega
// inner join direccion dep
// on dep.iddireccion = e.codigo_dependencia
// inner join tb_proveedor prove
// on prove.rowid = e.codigo_proveedor
// inner join cat_programa pro
// on e.codigo_programa = pro.codigo_programa and pro.activo=1
// inner join cat_actividad ac
// on ac.codigo_actividad = e.codigo_actividad and pro.codigo_programa = ac.codigo_programa and ac.activo=1
// where d.codigo_ingreso_enc = '$idsolicitud'";

  $Fields = "select distinct  d.rowid, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante, 
e.fecha_ingreso,  cast (e.observaciones as varchar(500))as observaciones, dep.nombre, d.codigo_renglon,  e.codigo_programa, e.codigo_actividad, d.costo_unidad, d.precio_total, e.userfile, d.codigo_bodega, d.codigo_empresa, e.no_ingreso,
d.codigo_ingreso_enc, b.bodega, prove.nombre as proveedor, prove.nit,
 d.cantidad_ingresada from tb_ingreso_det d
inner join tb_ingreso_enc e on
e.codigo_ingreso_enc = d.codigo_ingreso_enc
inner join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
inner join cat_categoria c on d.codigo_categoria = c.codigo_categoria 
inner join cat_bodega b on
b.codigo_bodega = d.codigo_bodega
inner join direccion dep
on dep.iddireccion = e.codigo_dependencia
inner join tb_proveedor prove
on prove.rowid = e.codigo_proveedor
where e.codigo_ingreso_enc = '$idsolicitud'";
	
	$res_qry_producto=$query($Fields);
		while($row=$fetch_array($res_qry_producto))
		{				
			
			$codigo=$row["codigo_ingreso_enc"];
				$no_ingreso=$row["no_ingreso"];
			$producto=$row["producto"];
			$solicitante=$row["solicitante"];
			$categoria=$row["categoria"];
			$actividad=$row["actividad"];
			$programa=$row["programa"];
			$observaciones=utf8_encode($row["observaciones"]);
			$bodega=$row["bodega"];	
			$dependencia=$row["nombre"];
			//$userfile=$row["userfile"];	
			$fecha=$row["fecha_ingreso"];	
			$codigo_producto=$row["codigo_producto"];	
		    $proveedor=$row["proveedor"];	
			$nit=$row["nit"];	
	
		}
	// //session_register("hoja_ingreso");
	       $_SESSION["hoja_ingreso"]=$codigo;
	?>
	
<!DOCTYPE html>
<html>
<head>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
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

<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar (form) {
	try
	{
		if (form['pregunta'].value.length == 0)
		{
			alert("Debe ingresar la descripcion de la información a solicitar");
		}else
		{
			if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
		}
	}catch (ee)	
	{
		alert("Debe ingresar la descripción de la información a solicitar");
	}
}

function imprimir()
{
//	alert(window.document.form1.opnacionalidad[0].value);
//	alert(window.document.form1.opnacionalidad[1].value);
	if (window.document.form1.opnacionalidad[0].checked)
	{
	   document.getElementById("div_extranjero").style.display = "none";
	   document.getElementById("div_nacional").style.display = "inline";
	}else
	{
		if (window.document.form1.opnacionalidad[1].checked)
		{
		   document.getElementById("div_extranjero").style.display = "inline";
		   document.getElementById("div_nacional").style.display = "none";
		}else
		{
		   document.getElementById("div_extranjero").style.display = "none";
		   document.getElementById("div_nacional").style.display = "none";
		}
	}
}
</SCRIPT>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="form" method="post" action="geliminar_ingreso.php">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Detalles del Ingreso</strong></li>
    </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">   
      <table width="99%" cellspacing="4" class="panel">
    <tr>
          <td valign="top">&nbsp;</td>
        <td colspan="2"> <input name="txt_id" type="hidden" id="txt_id" value="<?PHP echo $codigo; ?>">  <input name="txt_no_ingreso" type="hidden" id="txt_id" value="<?PHP echo $no_ingreso; ?>">  </td>
          </tr>
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Fecha</td>
          <td colspan="2"><?PHP print $fecha; ?></td>
          </tr>
       
        <tr>
          <td width="8" valign="top">&nbsp;</td>
          <td width="134" bgcolor="#FEF8DE">Solicitante</td>
          <td colspan="2"><?PHP print $solicitante; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Dependencia</td>
          <td colspan="2"><?PHP print $dependencia; ?></td>
          </tr>
<!--  <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Programa</td>
          <td colspan="2"><?PHP print $programa; ?></td>
          </tr>
         
         <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Actividad</td>
          <td colspan="2"><?PHP print $actividad; ?></td>
          </tr> -->
       
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Proveedor</td>
          <td colspan="2"><?PHP print $proveedor; ?></td>
          </tr>
          
           <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Nit</td>
          <td colspan="2"><?PHP print $nit; ?></td>
          </tr>
      

        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Observaciones</td>
          <td colspan="2"><?PHP print $observaciones; ?></td>
          </tr>

            <tr>
               <td valign="top">&nbsp;</td>
              <td bgcolor="#FEF8DE"><div align="left">Justificacion</div></td>
              <td><textarea name="txt_justificacion" id="txt_justificacion" cols="60" rows="6"></textarea></td>
            </tr>

      </table>
      <div align="center"></div>
        <br>
     <?PHP  
	 $consulta = mssql_query ($Fields)  or die ("Fallo en la consulta");
  
	    
   // Mostrar resultados de la consulta
    
	 $nfilas = mssql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<TABLE>\n");
         print ("<TR>\n");
         print ("<TH>No.</TH>\n");
		 print ("<TH>Producto</TH>\n");
         print ("<TH>Categoria</TH>\n");
         print ("<TH>Subategoria</TH>\n");
		 print ("<TH>producto</TH>\n");
		 print ("<TH>Renglon</TH>\n");
		 print ("<TH>Cantidad Ingresada</TH>\n");
         print ("<TH>Costo Unidad</TH>\n");
		 print ("<TH>Costo Total</TH>\n");
		 print ("<TH>Bodega</TH>\n");
		 print ("</TR>\n");
        $cnt = 1;
         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mssql_fetch_array ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['codigo_ingreso_enc'] . "</TD>\n");
			print ("<TD>" . utf8_encode($resultado['producto']) . "</TD>\n");
            print ("<TD>" . $resultado['codigo_categoria'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_subcategoria'] . "</TD>\n");
			print ("<TD>" . $resultado['codigo_producto'] . "</TD>\n");
			print ("<TD>" . $resultado['codigo_renglon'] . "</TD>\n");
			print ("<TD>" . $resultado['cantidad_ingresada'] . "</TD>\n");
            print ("<TD>" . $resultado['costo_unidad'] . "</TD>\n");
			print ("<TD>" . $resultado['precio_total'] . "</TD>\n");
			print ("<TD>" . $resultado['bodega'] . "</TD>\n");
			print '<td> ';
			print('<input  name="txt_codigo['.$cnt.'][11]"  value='.$resultado['codigo_ingreso_enc'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="bien['.$cnt.'][8]" type="hidden" size="3" id="txt_bien1"/>
			<input  name="txt_empresa['.$cnt.'][7]"  value='.$resultado['codigo_empresa'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_bodega['.$cnt.'][6]"  value='.$resultado['codigo_bodega'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_subcategoria['.$cnt.'][5]"  value='.$resultado['codigo_subcategoria'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_categoria['.$cnt.'][4]"  value='.$resultado['codigo_categoria'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_producto['.$cnt.'][3]"  value='.$resultado['codigo_producto'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_rowid['.$cnt.'][2]"  value='.$resultado['rowid'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_ingresado['.$cnt.'][12]"  value='.$resultado['cantidad_ingresada'].' type="hidden" size="6" id="txt_ingresada"/>');
            print '</td>'; 
		  $cnt++;
		 }

         print ("</TABLE>\n");
		 echo "<ul> </ul>";
      }
      else
         print ("No hay noticias disponibles");
    ?>
    </div>
    </div>
</div>
</td>
</tr>  
<tr>
              <td colspan="2">   <input name="bt_eliminar" onClick="validar(this.form)"  class="boton grey" type="button" id="bt_eliminar" value="Eliminar Ingreso">
              </td>
              </tr>       
</table>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
<script type="text/javascript">

function validar(form)
{
//////////////////////// Encabezado ///////////////////////////////////////////////////
		if ((form['txt_justificacion'].value) == ""){alert('Debe de Escribir la Justificacion'); form['txt_justificacion'].focus();  return};	
	
	
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	
	
	if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
}
</script>
</html>
