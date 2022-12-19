<?php
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($almacen));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
    
	//require("../includes/funciones.php");
	//require("../includes/sqlcommand.inc");
	

	$idsolicitud=$_REQUEST["id"];
	
    //  conectardb($almacen);
	$Fields="select distinct  d.rowid, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante, d.codigo_bodega, d.codigo_empresa,
e.fecha_ingreso,   cast (e.observaciones as varchar(500))as observaciones, dep.nombre, d.codigo_renglon, ac.actividad, e.codigo_programa, pro.descripcion as programa, e.codigo_actividad, d.costo_unidad, d.precio_total, 
d.codigo_ingreso_enc, b.bodega, e.codigo_dependencia,
 d.cantidad_ingresada, e.no_ingreso
 from tb_ingreso_det d
inner join tb_ingreso_enc e on
e.codigo_ingreso_enc = d.codigo_ingreso_enc
inner join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
inner join cat_categoria c on d.codigo_categoria = c.codigo_categoria 
inner join cat_bodega b on
b.codigo_bodega = d.codigo_bodega
inner join direccion dep
on dep.iddireccion = e.codigo_dependencia
inner join tb_programa pro
on e.codigo_programa = pro.codigo_programa and pro.activo=1
left join cat_actividad ac
on ac.codigo_actividad = e.codigo_actividad and pro.codigo_programa = ac.codigo_programa and ac.activo=1
where e.no_ingreso  = '$idsolicitud'";
	
	$res_qry_producto=$query($Fields);
		while($row=$fetch_array($res_qry_producto))
		{				
			
				$codigo_dependencia=$row["codigo_dependencia"];
			$codigo=$row["codigo_ingreso_enc"];
			$producto=utf8_encode($row["producto"]);
			$solicitante=utf8_encode($row["solicitante"]);
			$categoria=utf8_encode($row["categoria"]);
			$actividad=utf8_encode($row["actividad"]);
			$programa=utf8_encode($row["programa"]);
			$observaciones=utf8_encode($row["observaciones"]);
			$bodega=utf8_encode($row["bodega"]);	
			$dependencia=utf8_encode($row["nombre"]);
			
			$fecha=$row["fecha_ingreso"];	
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
    element.innerHTML = '<img src="../../images/loading.gif" />';
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
<script type="text/javascript">
function compara (form) {
if (form.clave1.value == form.clave2.value) 
	form.img.src = "../../imagenes/yes.jpg";
else
	form.img.src = "../../imagenes/no.jpg";
}
function valida (form) {
if (form.clave1.value = form.clave2.value) form.img.src = "../../imagenes/no.jpg";
alert("hola");
}
</script>
<script language=javascript src=../includes/FormCheck.js></script>
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
			if (confirm('¿Esta seguro de guardar estos datos?')) form.submit();
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
<form name="form" method="post" action="gdetalle_ingreso.php" enctype="multipart/form-data">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Detalles de la Requisicion</strong></li>
    </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
  
     
     
      <table width="99%" cellspacing="4" class="panel">

 
 
       
      
         <tr>
          <td valign="top">&nbsp;</td>
        <td colspan="2"> <input name="txt_id" type="hidden" id="txt_id" value="<?php echo $codigo; ?>">   </td>
          </tr>
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Fecha</td>
          <td colspan="2"><?php print $fecha; ?></td>
          </tr>
       
        <tr>
          <td width="8" valign="top">&nbsp;</td>
          <td width="134" bgcolor="#FEF8DE">Solicitante de la Compra</td>
          <td colspan="2"><?php print $solicitante; ?></td>
          </tr>
          
             <tr>
         <td valign="top">&nbsp;</td>
    <td>Solicitante para la requisicion:       
<td colspan="2">	  <a href="javascript:void(0)" onclick="buscar=window.open('../../busca_persona.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;">
<input name="nombre[0][0]" type="text" id="textfield3" value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]" size="55"  />
	  </a>
	  <input name="nombre[0][2]" type="hidden" id="nombre[0][2]" size="55"/>
      <input type="hidden" name="nombre[0][1]" id="nombre[0][1]"/></td>
   
  </tr>
       
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Dependencia</td>
          <td colspan="2"><?php print $dependencia; ?><input name="txt_dependencia" type="hidden" id="txt_id" value="<?php echo $codigo_dependencia; ?>"></td>
          </tr>
 <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Programa</td>
          <td colspan="2"><?php print $programa; ?></td>
          </tr>
         <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Actividad</td>
          <td colspan="2"><?php print $actividad; ?></td>
          </tr>
       
      

    
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Observaciones</td>
          <td colspan="2"><?php print $observaciones; ?><input name="txt_observaciones" type="hidden" id="txt_id" value="<?php echo $observaciones; ?>"></td>
          </tr>
      
     

                    
           
     
      </table>
      <div align="center"></div>
        <br>
     
          <?php
    
	 $consulta = mssql_query ($Fields)  or die ("Fallo en la consulta");
  
	    
   // Mostrar resultados de la consulta
    
	 $nfilas = mssql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<TABLE>\n");
         print ("<TR>\n");
         print ("<TH>No. Req.</TH>\n");
		 print ("<TH>Producto</TH>\n");
         print ("<TH>Categoria</TH>\n");
         print ("<TH>Subategoria</TH>\n");
		 print ("<TH>Cocigo Producto</TH>\n");
		  print ("<TH>Renglon</TH>\n");
		 print ("<TH>Cantidad Ingresada</TH>\n");
       
		  print ("<TH>Bodega</TH>\n");
		 print ("</TR>\n");
    $cnt = 1;
         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mssql_fetch_array ($consulta);
            print ("<TR>\n");
            //print ("<TD>" . $resultado['codigo_ingreso_enc'] . "</TD>\n");
            print ("<TD>" . $resultado['no_ingreso'] . "</TD>\n");
			print ("<TD>" . utf8_encode($resultado['producto']) . "</TD>\n");
            print ("<TD>" . $resultado['codigo_categoria'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_subcategoria'] . "</TD>\n");
			print ("<TD>" . $resultado['codigo_producto'] . "</TD>\n");
			print ("<TD>" . $resultado['codigo_renglon'] . "</TD>\n");
			
            
			print '<td> ';
			print('<input  name="txt_ingresado['.$cnt.'][12]"  value='.$resultado['cantidad_ingresada'].' type="text" size="5" id="txt_autorizado1"/ disabled>
			<input  name="txt_ingresado['.$cnt.'][13]"  value='.$resultado['cantidad_ingresada'].' type="hidden" size="5" id="txt_autorizado1"/>
			<input  name="txt_codigo['.$cnt.'][11]"  value='.$resultado['codigo_ingreso_enc'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="bien['.$cnt.'][8]" type="hidden" size="3" id="txt_bien1"/>
			<input  name="txt_empresa['.$cnt.'][7]"  value='.$resultado['codigo_empresa'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_bodega['.$cnt.'][6]"  value='.$resultado['codigo_bodega'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_subcategoria['.$cnt.'][5]"  value='.$resultado['codigo_subcategoria'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_categoria['.$cnt.'][4]"  value='.$resultado['codigo_categoria'].' type="hidden" size="3" id="txt_autorizado1"/>
			<input  name="txt_producto['.$cnt.'][3]"  value='.$resultado['codigo_producto'].' type="hidden" size="3" id="txt_autorizado1"/>');
		  print '</td>'; 
			
			
			print ("<TD>" . utf8_encode($resultado['bodega']) . "</TD>\n");
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
              <td colspan="2">   <input name="bt_actualizar" onClick="validar(this.form)" type="button" id="bt_actualizar" value="Enviar Requisicion">
              </td>
              </tr>            
</table>
</form>
<p>&nbsp;</p>
<script type="text/javascript">

var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");

</script>
</body>
<script type="text/javascript">

function validar(form)
{
//////////////////////// Encabezado ///////////////////////////////////////////////////
		if ((form['nombre[0][1]'].value) == ""){alert('Seleccione el nombre del solicitante'); form['nombre[0][1]'].focus();  return};	
	
	
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	
	
	if (confirm('¿Esta seguro de guardar estos datos?')) form.submit();
}
</script>
</html>
