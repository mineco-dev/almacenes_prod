<?php
	session_start();
    //llamada a las funciones
    
    require_once('../comandos/inc_seguridad.inc');
    require_once('../comandos/funciones.php');
    require_once('../comandos/sqlcommand.inc');
    require_once('../comandos/controldb.inc');
    $dbms = new DBMS(conectardb($almacen));
    $dbms->bdd = $database_cnn;
    
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


	$idsolicitud=$_REQUEST["id"];
     //conectardb($almacen);
	$Fields="select d.rowid, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante, 
e.fecha_requisicion, dep.nombre, e.observaciones, e.codigo_estatus, es.estatus, d.codigo_empresa,
d.codigo_requisicion_enc, b.bodega, em.empresa, d.codigo_bodega, e.usuario_aprobo, e.codigo_dependencia,
d.cantidad_autorizada, d.cantidad_solicitada from tb_requisicion_det d
inner join tb_requisicion_enc e on
e.codigo_requisicion_enc = d.codigo_requisicion_enc
inner join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
inner join cat_categoria c on d.codigo_categoria = c.codigo_categoria 
inner join cat_bodega b on
b.codigo_bodega = d.codigo_bodega
inner join cat_empresa em on
d.codigo_empresa = em.codigo_empresa
inner join direccion dep
on dep.iddireccion = e.codigo_dependencia
inner join cat_estatus es on
e.codigo_estatus = es.codigo_estatus
where d.codigo_requisicion_enc = '$idsolicitud'";
	
	$res_qry_producto=$query($Fields);
		while($row=$fetch_array($res_qry_producto))
		{				
			
			$codigo=$row["codigo_requisicion_enc"];
			$rowid=$row["rowid"];
			$producto=$row["producto"];
			$solicitante=$row["solicitante"];
			$categoria=$row["categoria"];
			$estatus=$row["codigo_estatus"];
			$observaciones=$row["observaciones"];
			$bodega=$row["bodega"];	
			$dependencia=$row["nombre"];
			$fecha=$row["fecha_requisicion"];	
			$codigo_producto=$row["codigo_producto"];
		
		$aprobo=$row["usuario_aprobo"];
		}
	?>
	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script lenguage="JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
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
  if (form.txt_id.value == "")
  { 
  	alert("Debe de llevar un id"); 
	form.txt_id.focus(); 
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
<title>Ingreso de Usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">

</head>
<body>
<form name="form" method="post" action="gaprobar_producto.php">
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
        <td colspan="2"> <input name="txt_id" type="hidden" id="txt_id" value="<? echo $codigo; ?>">   </td>
          </tr>
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Fecha</td>
          <td colspan="2"><? print $fecha; ?></td>
          </tr>
       
        <tr>
          <td width="8" valign="top">&nbsp;</td>
          <td width="134" bgcolor="#FEF8DE">Solicitante</td>
          <td colspan="2"><? print $solicitante; ?></td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Dependencia</td>
          <td colspan="2"><? print $dependencia; ?></td>
          </tr>

       

        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Observaciones</td>
          <td colspan="2"><? print utf8_encode($observaciones); ?></td>
          </tr>
      
      <tr>
        <td valign="top">&nbsp;</td>
      <td  valign="top"><div><span class="fieldTitle">
    Aprobar   <input name="otros" type="radio" value="AP" checked="CHECKED" />
</div></td>
    
      <td valign="top">&nbsp;</td>
    <td valign="top"><div><span class="fieldTitle">
    Rechazar     <input name="otros" type="radio" value="RE" /> 
    </div></td>
  </tr>
     
                    
           
     
      </table>
      <div align="center"></div>
        <br>
     
           <?
    
	 $consulta = mssql_query ($Fields)  or die ("Fallo en la consulta");
  
	    
   // Mostrar resultados de la consulta
    
	  $nfilas = mssql_num_rows ($consulta);
      
	  if ($nfilas > 0)
      {
         print ("<TABLE>\n");
         print ("<TR>\n");
         
		 print ("<TH>No. Req</TH>\n");
		 print ("<TH>Producto</TH>\n");
         print ("<TH>Codigo Producto</TH>\n");
		 print ("<TH>Categoria</TH>\n");
         print ("<TH>SubCategoria</TH>\n");
		
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
			
			
			
            print '<td>';
           print(' 
		   
		   
		   <input  name="txt_solicitada1['.$cnt.'][20]"  value='.$resultado['cantidad_solicitada'].' type="text" size="8" id="txt_autorizado1"disabled/>
		   <input  name="txt_rowid['.$cnt.'][12]"  value='.$resultado['rowid'].' type="hidden" size="3" id="txt_autorizado1"/ disabled>
		   <input  name="txt_solicitada['.$cnt.'][15]"  value='.$resultado['cantidad_solicitada'].' type="hidden" size="8" id="txt_autorizado1"/ disabled>
		   <input  name="txt_empresa['.$cnt.'][7]"  value='.$resultado['codigo_empresa'].' type="hidden" size="3" id="txt_autorizado1"/ disabled>
		   <input  name="txt_bodega['.$cnt.'][6]"  value='.$resultado['codigo_bodega'].' type="hidden" size="3" id="txt_autorizado1"/ disabled>
		   <input  name="txt_subcategoria['.$cnt.'][5]"  value='.$resultado['codigo_subcategoria'].' type="hidden" size="3" id="txt_autorizado1"/ disabled>
		   <input  name="txt_categoria['.$cnt.'][4]"  value='.$resultado['codigo_categoria'].' type="hidden" size="3" id="txt_autorizado1"/ disabled>
		   <input  name="txt_producto['.$cnt.'][3]"  value='.$resultado['codigo_producto'].' type="hidden" size="3" id="txt_autorizado1"/ disabled>
		   <input  name="bien['.$cnt.'][8]" type="hidden" size="3" id="txt_bien1"/>');
            print '</td>'; 
		print '<td>';
		print(' <input name="'.$cnt.'" id="autorizado_id" type="text" onblur="test(this.value,this.name,\''.$resultado['rowid'].'\')"/> </td>');

			print ("<TD>" . $resultado['bodega'] . "</TD>\n"); 
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
              <td colspan="2">   <input name="bt_actualizar" onClick="Validar(this.form)" type="button" id="bt_actualizar" value="Enviar Requisicion">
              </td>
              </tr>              
</table>
</form>
<p>&nbsp;</p>
<script type="text/javascript">

var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");

//document.getElementById("autorizado_id").onblur = function() {test()};



function test(value_change,row,id_row){
    if (value_change.length > 0){
        var params = {
		value : value_change,
		row_id : id_row
        }
        $.ajax({
            data: params,
            url: '../php/change.php',
            type: "post",
            success: function(resp){
                if(resp){
                    console.log(resp);
                        
                }
            }
        })
    }
    else{console.log("valor no lleno");}
	
}

</script>
</body>
</html>
