<?php
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");	
?>

<!DOCTYPE html>
<html>
<head>

  <script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
  <script language="javascript" src="calendar/calendar.js"></script>
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
<style>
  .form-control{
    display:inline !important;
    margin-right: 5px !important;
  }
</style>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
  <form name="frm_ingreso_productos" id="frm_ingreso_productos" action="gingreso_productos_temporal.php" method="post" enctype="multipart/form-data">
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>
          <div id="TabbedPanels1" class="TabbedPanels">
            <ul class="TabbedPanelsTabGroup">
              <li class="TabbedPanelsTab" tabindex="0"><strong>Ingreso de Producto</strong></li>
            </ul>
            <div class="TabbedPanelsContentGroup">
              <div class="TabbedPanelsContent">
                <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
                  <tr>
                    <td colspan="4">&nbsp;</td>
                  </tr>



                  <tr>
                    <td colspan="4">&nbsp;</td>
                  </tr>


                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>Empresa</td>
                    <td colspan="2">
                      <?php
                      conectardb($almacen);
                      $qry_empresa="SELECT * from cat_empresa
                      WHERE activo=1";	
                      $res_qry_empresa=$query($qry_empresa);					
                      ?>
                      <select class="form-control " style="width:20%;" name="cbo_empresa" id="cbo_empresa" onChange="javascript:cargarCombo('cbo_bodega2.php', 'cbo_empresa', 'Div_bodega')">
                       <?php
                       $nombre=":: Seleccione ::";
                       echo'<option value="0">'.$nombre.'</option>';
                       while($row_empresa=$fetch_array($res_qry_empresa))
                       {
                        echo'<option value="'.$row_empresa["codigo_empresa"].'">'.$row_empresa["empresa"].'</option>';
                      }
                      ?>
                    </select>
                    <?php				
                    $free_result($res_qry_empresa);
                    ?>                </td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>Bodega</td>
                    <td colspan="2">
                      <div id="Div_bodega">
                        <select  name="cbo_bodega"  id="cbo_bodega">
                        </select>
                      </div>                  </td>
                    </tr>

                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                    </tr>  

                    <tr>
                      <td valign="top"><div align="center"></div></td>
                      <td valign="top">Dependencia</td>
                      <td colspan="2">
                        <?php
                        conectardb($almacen);											
                        $qry_tipo_dependencia="select * from direccion order by nombre";										
                        $res_qry_tipo_dependencia=$query($qry_tipo_dependencia);	
                        echo('<select class="form-control " style="width:20%;" name="cbo_dependencia">');
                        $nombre=":: Seleccione ::";
					//echo'<option value="0">'.$nombre.'</option>';
                        while($row_tipo_dependencia=$fetch_array($res_qry_tipo_dependencia))
                        {
                          echo'<option value="'.$row_tipo_dependencia["iddireccion"].'">'.$row_tipo_dependencia["nombre"].'</option>';
                        }
                        echo('</select>');				
                        $free_result($res_qry_tipo_dependencia);									 
                        ?>
                      </select>          </td>
                    </tr>
                    <td valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <tr>

                      <tr>
                        <td valign="top"><div align="center"></div></td>
                        <td valign="top">Tipo de Ingreso</td>
                        <td colspan="2"><?php
                        conectardb($almacen);											
					//print($almacen);
                        $qry_tipo_docto="SELECT * FROM cat_tipo_documento WHERE activo=1 and codigo_tipo_movimiento=1 ORDER BY tipo_documento";										
                        $res_qry_tipo_docto=$query($qry_tipo_docto);	
                        echo('<select class="form-control " style="width:20%;" name="cbo_tipo_docto">');
                        $nombre=":: Seleccione ::";
					//echo'<option value="0">'.$nombre.'</option>';
                        while($row_tipo_docto=$fetch_array($res_qry_tipo_docto))
                        {
                          echo'<option value="'.$row_tipo_docto["codigo_tipo_documento"].'">'.$row_tipo_docto["tipo_documento"].'</option>';
                        }
                        echo('</select>');				
                        $free_result($res_qry_tipo_docto);									 
                        ?>            </select>          </td>
                      </tr>
                      <td valign="top">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td colspan="2">&nbsp;</td>

                      <tr>
                       <td valign="top">&nbsp;</td>
                       <td><div align="left">Observaciones</div></td>
                       <td><textarea class="form-control " style="width:40%;"name="txt_observaciones" id="txt_observaciones" cols="50" rows="5"></textarea></td>
                     </tr>
                     <tr>
                      <tr>
                        <td colspan="4">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="4">&nbsp;</td>
                      </tr>
                    </table>


                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <br>
          <br>
          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <div id="TabbedPanels1" class="TabbedPanels">

                  <ul class="TabbedPanelsTabGroup">

                    <li class="TabbedPanelsTab" tabindex="0"><strong>Detalle del Producto</strong></li>
    <!-- <li class="TabbedPanelsTab style3" tabindex="0">Acreedor(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Bien(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Condiciones</li> -->
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">

     <?php  include("ingreso_det2_temporal.php"); ?>
     <br>
   </div>
 </div>
</div>
</td>
</tr>
</table>
<p align="center">
  <input type="submit" onClick="validar(this.form)" class ="btn boton grey" id="cmd_guardar" value="Guardar hoja de ingreso" >
</p>


<p>&nbsp;</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</form>
</body>
<script type="text/javascript">
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
function validarEntero(numero){ 
  if ((isNaN(numero)) && (numero > 0)) { 
    alert("Solo puede ingresar numeros validos en el campo");
    return "";
  }else{ 
    return numero;
  } 
}
function validar(form)
{
//////////////////////// Encabezado ///////////////////////////////////////////////////
if ((form['cbo_tipo_docto'].value) == "0"){alert('Seleccione el tipo de documento que respalda el ingreso'); form['cbo_tipo_docto'].focus();  return};	
if ((form['cbo_empresa'].value) == "0"){alert('Seleccione la empresa'); form['cbo_empresa'].focus();  return};	
if ((form['cbo_bodega'].value) == "0"){alert('Seleccione la bodega'); form['cbo_bodega'].focus();  return};	
if ((form['cbo_actividad'].value) == "0"){alert('Seleccione el programa'); form['cbo_actividad'].focus();  return};	
if ((form['cbo_programa'].value) == "0"){alert('Seleccione la empresa'); form['cbo_programa'].focus();  return};	


if ((form['nombre[0][1]'].value) == ""){alert('Seleccione el nombre del solicitante'); form['nombre[0][1]'].focus();  return};	


	//if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
	//if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Detalle //////////////////////////////////////////////////////////	
	//	ban = 0; for (i=1;i<100;i++) { if (validarEntero(form['ingresado['+i+']']!="")) ban = 1; } if (ban == 0) {alert('No se acepta el ingreso de letras y comas en Cantidad recibida'); return};	
  ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][1]'])) ban = 1; } if (ban == 0) {alert('Falta el detalle de los productos ingresados'); return};
  ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][2]'])) ban = 1; } if (ban == 0) {alert('Falta el codigo de categoria'); return};
  ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][3]'])) ban = 1; } if (ban == 0) {alert('Falta el codigo de subcategoria'); return};
  ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][5]'])) ban = 1; } if (ban == 0) {alert('Falta el el renglon'); return};
  ban = 0; for (i=1;i<100;i++) { if (valor(form['ingresado['+i+']'])) ban = 1; } if (ban == 0) {alert('Falta las unidades ingresadas'); return};
  ban = 0; for (i=1;i<100;i++) { if (valor(form['costo_unitario['+i+']'])) ban = 1; } if (ban == 0) {alert('Falta el costo unitario'); return};


/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	

if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
}
</script>
</html>