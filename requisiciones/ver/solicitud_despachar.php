<?PHP
	require '../includes/cnn/inc_header_1.inc';
	require '../includes/cnn/funciones.php';



	$dbms = new DBMS(conectardb($almacen));
	$dbms->bdd = $database_cnn;

    
	//require("../includes/funciones.php");
	//require("../includes/sqlcommand.inc");
	
?>
  <?PHP

	$idsolicitud=$_REQUEST["id"];
     //conectardb($almacen);
	$Fields="select d.rowid, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante, 
e.fecha_requisicion, dep.nombre, e.observaciones, e.codigo_estatus, es.estatus, d.codigo_empresa,
d.codigo_requisicion_enc, b.bodega, d.codigo_bodega, e.codigo_solicitante, e.codigo_dependencia,
 d.cantidad_autorizada, d.cantidad_solicitada from tb_requisicion_det d
left outer join tb_requisicion_enc e on
e.codigo_requisicion_enc = d.codigo_requisicion_enc
left join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
left join cat_categoria c on d.codigo_categoria = c.codigo_categoria 
left join cat_bodega b on
b.codigo_bodega = d.codigo_bodega
left join direccion dep
on dep.iddireccion = e.codigo_dependencia
left  join cat_estatus es on
e.codigo_estatus = es.codigo_estatus
where d.codigo_requisicion_enc = '$idsolicitud'";
	//echo $Fields;
	$res_qry_producto=$query($Fields);
		while($row=$fetch_array($res_qry_producto))
		{				
			
			$codigo=$row["codigo_requisicion_enc"];
			$producto=utf8_encode($row["producto"]);
			$codsolicitante=$row["codigo_solicitante"];
			$solicitante=$row["solicitante"];
			$categoria=$row["categoria"];
			$estatus=$row["codigo_estatus"];
			$observaciones=utf8_encode($row["observaciones"]);
			$bodega=$row["bodega"];	
			$dependencia=$row["nombre"];
			$coddependencia=$row["codigo_dependencia"];
			$fecha=$row["fecha_requisicion"];	
			$codigo_producto=$row["codigo_producto"];	
		}
		
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
<script LANGUAGE="JavaScript">
function Validar(form)
{
	
  if (form["nombre[0][1]"].value == "")
  { 
  	
  	alert("Debe ingresar quien recibe");
	return;
  }
 
  
  function numerico(valor)
{ 
	   campo=valor.toString();
	   var nuLongitud = campo.length;
	   var i= 0;
	   var bobandera = "TRUE";
	   for(i=0;i<nuLongitud;i++)
	   {
		  switch(campo.charAt(i))
		  {
				case '1': case '2': case '3':
				case '4': case '5': case '6':
				case '7': case '8': case '9': case '0':
				bobandera = "TRUE";
				break;
				default:
				bobandera = "FALSE";				
		  } //end switch           
	   }//end for
	   if (bobandera == "FALSE") return false
	   else return true;      
}
    form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_producto.focus(); 
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


<link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
		<!-- <script src="../../bootstrap/js/bootstrap.js"></script>-->
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<body>
<form name="form" method="post" action="gdespachar_producto.php">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Detalles de la Requisicion</strong></li>
    </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent table-responsive">
  
     
     
      <table width="99%" cellspacing="4" class="table table-responsive">
 
       
       
       
         <tr>
          <td valign="top">&nbsp;</td>
        <td colspan="2"> <input name="txt_id" type="hidden" id="txt_id" value="<?PHP echo $codigo; ?>">   </td>
          </tr>
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Fecha</td>
          <td colspan="2"><input name="txt_fecha" type="hidden" id="txt_id" value="<?PHP echo $fecha; ?>"><?PHP print $fecha; ?></td>
          </tr>
       
        <tr>
          <td width="8" valign="top">&nbsp;</td>
          <td width="134" bgcolor="#FEF8DE">Solicitante</td>
          <td colspan="2"><input name="txt_codigo_solicitante" type="hidden" id="txt_id" value="<?PHP echo $codsolicitante; ?>"><input name="txt_solicitante" type="hidden" id="txt_id" value="<?PHP echo $solicitante; ?>"><?PHP print $solicitante; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Dependencia</td>
          <td colspan="2"><input name="txt_dependencia" type="hidden" id="txt_id" value="<?PHP echo $coddependencia ?>"><?PHP print $dependencia; ?></td>
          </tr>

       

        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Observaciones</td>
          <td colspan="2"><input name="txt_observaciones" type="hidden" id="txt_id" value="<?PHP echo $observaciones; ?>"><?PHP print $observaciones; ?></td>
          </tr>
      
        <tr>
  <!--     hidden
     -->
      
                <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Recibe</td>
                <td colspan="2"><a href="javascript:void(0)" 
				onClick="buscar=window.open('../../buscar_persona_req.php?tipo=nombre&posi=0&dependencia=<?PHP echo $coddependencia ?>','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;"
				><input  class="form-control"name="nombre[0][0]" type="text" id="nombre[0][0]" value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]" size="55" />
	</a>
	  <input  name="nombre[0][2]" type="hidden" id="nombre[0][2]" size="55"/>
      <input type="hidden" name="nombre[0][1]" id="nombre[0][1]"/></td>
              </tr>
      </table>
      <div align="center"></div>
        <br>
     
          <?PHP
     $consulta = mssql_query ($Fields)
         or die ("Fallo en la consulta");
   // Mostrar resultados de la consulta
      $nfilas = mssql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<div class=\"table-responsive\">");
         print ("<TABLE class=\"table table-striped\">\n");
         print ("<TR>\n");
         print ("<TH>No. Req.</TH>\n");
		 print ("<TH>Producto</TH>\n");
         print ("<TH>Codigo Producto</TH>\n");
		 print ("<TH>Categoria</TH>\n");
         print ("<TH>Subcategoria</TH>\n");
		
		 print ("<TH>Estado</TH>\n");
		 print ("<TH>Cantidad Solicitada</TH>\n");
		 print ("<TH>Cantidad Autorizada</TH>\n");
         print ("<TH>Bodega</TH>\n");
		 print ("</TR>\n");
           $cnt = 1;
         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mssql_fetch_array ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['codigo_requisicion_enc'] . "</TD>\n");
			print ("<TD>" . utf8_encode($resultado['producto']) . "</TD>\n");
            print ("<TD>" . $resultado['codigo_producto'] . "</TD>\n");
			print ("<TD>" . $resultado['codigo_categoria'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_subcategoria'] . "</TD>\n");
			
			print ("<TD>" . $resultado['estatus'] . "</TD>\n");
			print ("<TD>" . $resultado['cantidad_solicitada'] . "</TD>\n");
			print ('<td> ');
			
			if ($resultado['cantidad_autorizada'] == 0) {
				$cantidadSoli = "0";
				
			}else{
				$cantidadSoli = $resultado['cantidad_autorizada'];
			}
			print $cantidadSoliEnvia;

			print('
			<input  name="txt_solicitada['.$cnt.'][20]"  value='.$resultado['cantidad_solicitada'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_codigo['.$cnt.'][11]"  value='.$resultado['codigo_requisicion_enc'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="bien['.$cnt.'][8]" type="hidden" size="3" id="txt_bien1"/>
			<input  name="txt_empresa['.$cnt.'][7]"  value='.$resultado['codigo_empresa'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_bodega['.$cnt.'][6]"  value='.$resultado['codigo_bodega'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_subcategoria['.$cnt.'][5]"  value='.$resultado['codigo_subcategoria'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_categoria['.$cnt.'][4]"  value='.$resultado['codigo_categoria'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_producto['.$cnt.'][3]"  value='.$resultado['codigo_producto'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_rowid['.$cnt.'][2]"  value='.$resultado['rowid'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_autorizado['.$cnt.'][1]"  value='.$cantidadSoli.' type="text" size="8" id="txt_autorizado1" disabled/>
			<input  name="txt_autorizado['.$cnt.'][0]"  value="'.$resultado['cantidad_autorizada'].'" type="hidden" size="8" id="txt_autorizado1"/>');
            print ('</td>'); 
            print ("<TD>" . $resultado['bodega'] . "</TD>\n");

		  $cnt++;
		 }

         print ("</TABLE>\n");
          print ("</div>");
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
<!-- onClick="Validar(this.form)" -->
            <tr>
              <td colspan="2">   <input name="bt_actualizar" class="boton grey" type="button" onClick="Validar(this.form)"  id="bt_actualizar" value="Enviar Despacho">
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
</html>
