<?PHP
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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
<form name="frm_select_persona" id="frm_select_persona" action="requisicion2.php" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Solicitante</strong></li>
    
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
          <td valign="top"><div align="center"></div></td>
          <td valign="top">Empresa</td>
          <td colspan="2">
			 	 <?PHP
		  	conectardb($almacen);											
					$qry_tipo_empresa="SELECT * FROM cat_empresa WHERE activo=1";										
					$res_qry_tipo_empresa=$query($qry_tipo_empresa);	
					   
					echo('<select name="cbo_tipo_empresa">');
					$nombre=":: Seleccione ::";
					//echo'<option value="0">'.$nombre.'</option>';
					while($row_tipo_empresa=$fetch_array($res_qry_tipo_empresa))
					{
						echo'<option value="'.$row_tipo_empresa["codigo_empresa"].'">'.$row_tipo_empresa["empresa"].'</option>';

					}
					echo('</select>');				
					$free_result($res_qry_tipo_empresa);									 
				?>
			</select>          </td>
       </tr>  
    <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>

          <td colspan="2">&nbsp;</td>
        </tr>  
 <tr>
          <td colspan="4"><div align="center">
      			<input name="btn1" type="button" class="grey" onClick="validar(this.form)" value="Aceptar">
			</div>		</td>
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

<p>&nbsp;</p>

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

function validar(form)
{
//////////////////////// Encabezado ///////////////////////////////////////////////////
	if ((form['cbo_tipo_empresa'].value) == "0"){alert('Seleccione el tipo de documento que respalda el ingreso'); form['cbo_tipo_docto'].focus();  return};	
		
	
   
	//if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
	//if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Detalle //////////////////////////////////////////////////////////	
	//	ban = 0; for (i=1;i<100;i++) { if (validarEntero(form['ingresado['+i+']']!="")) ban = 1; } if (ban == 0) {alert('No se acepta el ingreso de letras y comas en Cantidad recibida'); return};	
		
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	
	
	if (confirm('�Asegurese de seleccionar correctamente su empresa de lo contrario podrian alterar algun dato de otra dependencia?')) form.submit();
}
</script>
</html>