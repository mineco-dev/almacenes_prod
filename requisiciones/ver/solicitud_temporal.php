<?PHP
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($almacen));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');


session_unregister("egreso");
//session_register("ingreso");
$_SESSION["ingreso"]=true;


	$idsolicitud=$_REQUEST["id"];
     //conectardb($almacen);
	$Fields="select d.rowid,p.rowid as codProducto,e.codigo_jefe_dependencia,e.codigo_solicitante, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante, 
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
			$Jefe = $row["codigo_jefe_dependencia"];
			$CodSolicitante = $row["codigo_solicitante"];
		
		$aprobo=$row["usuario_aprobo"];
		}
	?>
<!DOCTYPE html>
<html>
<head>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript">
var peticion = false;
var  testPasado = false;


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
    //form.submit();
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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- <link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" /> -->
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" /> 
<link href="SpryAssets/SpryTabbedPanels2.css" rel="stylesheet" type="text/css">

		<link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
		<!-- <script src="../../bootstrap/js/bootstrap.js"></script>-->
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	
</head>
<body>
<form name="form" method="post" action="gguardarTem.php">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Detalles de la Requisicion</strong></li>
    </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent container table-responsive">
  
     
     
      <table width="99%" cellspacing="4" class=" table">
 
       
       
       
         <tr>
          <td valign="top">&nbsp;</td>
        <td colspan="2"> <input name="txt_id" type="hidden" id="txt_id" value="<?PHP echo $codigo; ?>">   </td>
          </tr>
        
        <tr class="info">
          <td valign="top">&nbsp;</td>
          <td width="134" bgcolor="#FEF8DE">Fecha</td>
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

       

        <tr>
          <td valign="top">&nbsp;</td>
          <td bgcolor="#FEF8DE">Observaciones</td>
          <td colspan="2"><?PHP print $observaciones; ?></td>
          </tr>


      
      <!-- <tr>
        <td valign="top">&nbsp;</td>
      <td  valign="top"><div><span class="fieldTitle">
    Aprobar   <input name="otros" type="radio" value="AP" checked="CHECKED" />
</div></td>
    
      <td valign="top">&nbsp;</td>
    <td valign="top"><div><span class="fieldTitle">
    Rechazar     <input name="otros" type="radio" value="RE" /> 
    </div></td>
  </tr> -->
     
                    
           
     
      </table>
      <div align="center"></div>
        <br>
     
           <?PHP
    
	 $consulta = mssql_query ($Fields)  or die ("Fallo en la consulta");
  
	    
   // Mostrar resultados de la consulta
    
	  $nfilas = mssql_num_rows ($consulta);
      $_SESSION['nfilas'] = $nfilas;

	  if ($nfilas > 0)
      {
      	 print ("<div class=\"container table-responsive\">");
         print ("<TABLE class=\"table \" id=\"T_Temporal\">\n");
   //       print ("<TR>\n");
		 // print ("<TH>No. Req</TH>\n");
		 // print ("<TH>Producto</TH>\n");
   //       print ("<TH>Codigo Producto</TH>\n");
		 // print ("<TH>Categoria</TH>\n");
   //       print ("<TH>SubCategoria</TH>\n");
		 // print ("<TH>Estado</TH>\n");
		 // print ("<TH>Cantidad Solicitada</TH>\n");
		 // print ("<TH>Bodega</TH>\n");
		 // print ("</TR>\n");

		 print ("
				<thead>
			<tr>
				<th width=\"1%\" >#</th>
				<th width=\"10%\" >Codigo</th>
				<th width=\"440px\" >Articulo</th>
				<th width=\"12%\" >Categoria</th>
				<th width=\"12%\">SubCategoria</th>
				<th width=\"10%\">Cantidad Solicitada</th>
				<th width=\"50px\">Eliminar</th>
				<th width=\"1px\" ></th>
				<th width=\"1px\" ></th>
			</tr>
		</thead>
				");
            $cnt = 1;
            $cont = 0;
		for ($i=0; $i<$nfilas; $i++)
         {

            $resultado = mssql_fetch_array ($consulta);
            $cont++;
             print("
					 
					 	<tr  class=\"selected\" id=\"fila".$cont."\" >
					 		<td id=\"cantidad\">".$cont."</td>
					 		<td>
								<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open('productoTem.php?tipo=bien&posi=".$cont."','Buscar4','width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;\">
								<input  id=\"bien[".$cont."][1]\" name=\"bien[".$cont."][1]\" type=\"text\" value=\"". $resultado['codigo_producto'] ."\"  alt=\"Doble clic para consultar el catalogo\" style=\"width:100%\" class=\"form-control\">
								</a>
					 		</td>
					 		<td>
					 		<input style=\"border:none;background:#fff\" id=\"bien[".$cont."][7]\" name=\"bien[".$cont."][7]\" type=\"text\" size=\"70%\" value=\"".$resultado['producto']."\"  ></td>
					 		<td>
							<input  id=\"bien[".$cont."][5]\" name=\"bien[".$cont."][5]\" type=\"text\"  style=\"width:100%;border:none;background:#fff\" value=\"". $resultado['codigo_categoria'] ."\" >
					 		</td>
					 		<td>
							<input id=\"bien[".$cont."][6]\" name=\"bien[".$cont."][6]\" type=\"text\"  style=\"width:100%;border:none;background:#fff\" value=\"". $resultado['codigo_subcategoria'] ."\" >
					 		</td>
							<td>
							<input   id=\"cantidad_solicitada[".$cont."]\" type=\"text\" name=\"cantidad_solicitada[".$cont."]\" size=\"12\" style=\"width:100%\" class=\"form-control\" value=\"". $resultado['cantidad_solicitada'] ."\" required>
							</td>
					 		<td id=\"fila".$cont."\" onclick=\"seleccionarFila(id, 'check".$cont."');\" ><input id=\"check".$cont."\" type=\"checkbox\" name=\"transporte\" disabled>Eliminar</td>
					 		<td><input id=\"bien[".$cont."][4]\" type=\"text\" name=\"bien[".$cont."][4]\"   value=\"". $resultado['codProducto']."\"  style=\"display:none\" size=\"0\"/></td>
					 		<td><input id=\"bien[".$cont."][10]\" type=\"text\" name=\"bien[".$cont."][10]\"   value=\"". $resultado['rowid']."\" style=\"display:none\"  size=\"0\"/></td>
					 	</tr>
					 
             	");

     //        print ("<TR>\n");
		     

//<input  id=\"bien["+cont+"][1]\" type=\"text\" value=\""+CodigoProducto+"\"  alt=\"Doble clic para consultar el catalogo\" style=\"width:100%\" class=\"form-control\">
			  // print ("<TD>" . $resultado['codigo_requisicion_enc'] . "</TD>\n");
			  // print ("<TD>" . $resultado['codigo_producto'] . "</TD>\n");
			  // print ("<TD>" . $resultado['producto'] . "</TD>\n");
			  // print ("<TD>" . $resultado['codigo_categoria'] . "</TD>\n");
     //          print ("<TD>" . $resultado['codigo_subcategoria'] . "</TD>\n");
			  // print ("<TD>" . $resultado['cantidad_solicitada'] . "</TD>\n"); 
			

			//#
			//Codigo
			//Articulo
			//Categoria
			//subcategoria
			//cantidad solicitada
			//Eliminar
			
      //       print '<td>';
      //      print('
      //      	<input  name="txt_solicitada1['.$cnt.'][20]"  value='.$resultado['cantidad_solicitada'].' type="text" size="8" id="txt_autorizado1"/ disabled>
		    // <input  name="txt_rowid['.$cnt.'][12]"  value='.$resultado['rowid'].' type="text" size="3" id="txt_autorizado1"/>
		    // <input  name="txt_solicitada['.$cnt.'][15]"  value='.$resultado['cantidad_solicitada'].' type="text" size="8" id="txt_autorizado1"/>
		    // <input  name="txt_empresa['.$cnt.'][7]"  value='.$resultado['codigo_empresa'].' type="text" size="3" id="txt_autorizado1"/>
		    // <input  name="txt_bodega['.$cnt.'][6]"  value='.$resultado['codigo_bodega'].' type="text" size="3" id="txt_autorizado1"/>
		    // <input  name="txt_subcategoria['.$cnt.'][5]"  value='.$resultado['codigo_subcategoria'].' type="text" size="3" id="txt_autorizado1"/>
		    // <input  name="txt_categoria['.$cnt.'][4]"  value='.$resultado['codigo_categoria'].' type="text" size="3" id="txt_autorizado1"/>
		    // <input  name="txt_producto['.$cnt.'][3]"  value='.$resultado['codigo_producto'].' type="text" size="3" id="txt_autorizado1"/>
		    // <input  name="bien['.$cnt.'][8]" type="text" size="3" id="txt_bien1"/>');
      //       print '</td>'; 

			//print ("<TD>" . $resultado['bodega'] . "</TD>\n"); 
		   $cnt++;
					
   }
	 		
		 print ("</TABLE>\n");

		 print ("</div>");
		
	  
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
              <td colspan="2">   
              <input name="bt_actualizar" class="btn boton grey" onClick="Validar(this.form)" type="button" id="bt_actualizar" value="Enviar Requisicion">
              <input name="bt_add"  class="btn boton grey" type="button"  onclick="addRow()" value="Agregar l&iacute;nea">
			  <input  id="bt_del" class="btn boton grey" type="button" value="Eliminar">
			
              </td>
              </tr>              
</table>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
$(document).ready(function(){
		
	$('#bt_del').click(function(){
		eliminar(id_fila_selected);
	});		
});

var cont=0;

function addRow(){
		cont++;
		
		
		var fila = "<tr class=\"selected\" id=\"fila"+cont+"\" >";
		fila += "<td id=\"cantidad\">"+cont+"</td>"
		fila += "<td ><a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'productoTem.php?tipo=bien&posi="+cont+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input  id=\"bien["+cont+"][1]\" type=\"text\" value=\"\"  alt=\"Doble clic para consultar el catalogo\" style=\"width:100%\" class=\"form-control\"></a></td>"
		fila += "<td><input style=\"border:none;background:#fff\" id=\"bien["+cont+"][7]\" type=\"text\" size=\"70%\"  disabled></td>"
		fila += "<td><input  id=\"bien["+cont+"][5]\" type=\"text\"  style=\"width:100%;border:none;background:#fff\" disabled></td>"
		fila += "<td><input id=\"bien["+cont+"][6]\" type=\"text\"  style=\"width:100%;border:none;background:#fff\" disabled></td>"
		fila += "<td><input   id=\"cantidad_solicitada["+cont+"]\" type=\"text\" name=\"cantidad_solicitada["+cont+"]\" size=\"12\" style=\"width:100%\" class=\"form-control\" required></td>"
		fila += "<td id=\"fila"+cont+"\" onclick=\"seleccionarFila(id, 'check"+cont+"');\" ><input id=\"check"+cont+"\" type=\"checkbox\" name=\"transporte\" >Eliminar</td>"
		fila += "<td><input id=\"bien["+cont+"][4]\" type=\"hidden\" name=\"bien["+cont+"][4]\"  style=\"display:none;\"  size=\"0\"/></td>"
		fila += "</tr>";
		$('#T_Temporal').append(fila);
		reordenar();
	};
	function reordenar(){	
		var num=1;
		$('#T_Temporal tbody tr').each(function(){
			
			$(this).find('td').eq(1).find('input').attr("id","bien["+num+"][1]");//codigo
			$(this).find('td').eq(2).find('input').attr("id","bien["+num+"][7]");//Articulo
			$(this).find('td').eq(3).find('input').attr("id","bien["+num+"][5]");//categoria
			$(this).find('td').eq(4).find('input').attr("id","bien["+num+"][6]");//subcategoria
			$(this).find('td').eq(5).find('input').attr("id","cantidad_solicitada["+num+"]");
			$(this).find('td').eq(5).find('input').attr("name","cantidad_solicitada["+num+"]");//cantidad solicitada
			$(this).find('td').eq(1).find('a').attr("onDblClick","buscar=window.open('productoTem.php?tipo=bien&posi="+num+"','Buscar4','width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;");
			//$(this).find('td').eq(1).setAttribute("onclick","https://www.google.com");
			$(this).find('td').eq(6).attr("id","fila"+num+"");
			$(this).find('td').eq(6).attr("onclick","seleccionarFila(id, 'check"+num+"');");
			$(this).find('td').eq(6).find('input').attr("id","check"+num+"");
			$(this).find('td').eq(7).find('input').attr("id","bien["+num+"][4]");
			$(this).find('td').eq(7).find('input').attr("name","bien["+num+"][4]");

			$(this).attr("id","fila"+num+"");
			$(this).find('td').eq(0).text(num);
			num++;
		}); 		 
};


function seleccionarFila(fila, chk) {

			if (document.getElementById(fila).className == "seleccionada"){
				document.getElementById(fila).className = "original";
				document.getElementById(chk).checked = false;
				removeItemFromArr(id_fila_selected,fila);
				
			}  else {
				document.getElementById(fila).className = "seleccionada";
				document.getElementById(chk).checked = true;
				id_fila_selected.push(fila);
				

			}
		};

function eliminar(id_fila){
		// $('#fila'+id_fila).remove();
		for(var i=0; i<=id_fila.length; i++){
			$('#'+id_fila[i]).remove();
			
		}
		reordenar();
		id_fila_selected=[];
	};


var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
function valor(objeto)
{
	try {
		if ((objeto.value+0) == 0)
			return false;
		else
			return true;
	} catch(e) 
	{
		return false;
	}
}

function Validar(form)
{

//////////////////////// Encabezado ///////////////////////////////////////////////////
//if ((form['nombre[0][1]'].value) == ""){alert('Seleccione el nombre del solicitante'); form['nombre[0][1]'].focus();  return};	

//if ((form['cbo_dependencias'].value) == "0"){alert('Seleccione la dependencia'); form['cbo_dependencias'].focus();  return};	

//if ((form['cbo_jefe'].value) == "0"){alert('Seleccione el jefe de dependencia'); form['cbo_jefe'].focus();  return};
//if ((form['T_Accion'].value) == "0"){return};

/*Codigo de verificacion de producto 19-12-2016*/
// for(i = 0; i < 100; i++)
// {

//   if(form["bien["+i+"][4]"])
//   {
  	
//    if(form['bien['+i+'][4]'].value == 0)
   
//    {
//     alert('Debe seleccionar un producto o eliminar la linea que esta vacia en el detalle del producto'); form['bien['+i+'][4]'].focus();return
//   };
//   if(!form['cantidad_solicitada['+i+']'].value)
//   {
//     alert('Debe ingresar un cantidad para el producto seleccionado'); form['cantidad_solicitada['+i+']'].focus();return
//   };
// }
// }
/*Fin del codigo 19-12-2016*/

	//if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
	//if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Detalle //////////////////////////////////////////////////////////	
	//	ban = 0; for (i=1;i<100;i++) { if (validarEntero(form['ingresado['+i+']']!="")) ban = 1; } if (ban == 0) {alert('No se acepta el ingreso de letras y comas en Cantidad recibida'); return};	
 // ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][4]'])) ban = 1; } if (ban == 0) 
  //{alert('Falta el detalle de los productos ingresados'); return};
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	

if (confirm("¿Esta seguro de guardar estos datos?")) form.submit();

  }


var row = "<?php echo $nfilas; ?>";
console.log(row);

</script>
</body>
</html>
