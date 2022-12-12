
<?PHP
	require("../includes/sqlcommand.inc");	
	require('../includes/funciones.php');

$empresa = ($_POST['cbo_tipo_empresa']); 

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
<link href="HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
<form action="grequisicion_directa.php" method="post" enctype="multipart/form-data" name="form1">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Ingreso de Requisicion</strong></li>
    
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
        
        
       
        
 <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
       <tr>
         <td valign="top">&nbsp;</td>
    <td>Solicitante:       
<td colspan="2">	  <a href="javascript:void(0)" onclick="buscar=window.open('busca_persona.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;"><input name="nombre[0][0]" type="text" id="textfield3" value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]" size="55" disabled />
	  </a>
	  <input name="nombre[0][2]" type="hidden" id="hiddenField" size="55"/>
      <input type="hidden" name="nombre[0][1]" id="hiddenField"/></td>
   
  </tr>
       
       
        <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td width="92" valign="top">&nbsp;</td>
          <td width="191">No. Requisicion</td>
          <td width="627" colspan="2">
   <?PHP
				  
					conectardb($almacen);											
					$qry_tipo_estatus="select max(codigo_requisicion_enc + 1) as ultima_requisicion from tb_requisicion_enc";										
					$res_qry_tipo_estatus=$query($qry_tipo_estatus);	
					while($row_tipo_estatus=$fetch_array($res_qry_tipo_estatus))
					{
					print('<input  name="txt_no_requisicion" value='.$row_tipo_estatus["ultima_requisicion"].' type="text" size="10" id="txt_no_requisicion" disabled/><input name="txt_no_requisicion" value='.$row_tipo_estatus["ultima_requisicion"].' type="hidden" size="10" id="txt_no_requisicion" disabled/>');
                         }
								$free_result($res_qry_tipo_estatus);									 
				?>
         </td>
        </tr>
       
       
        <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
       
     <tr>
              <td valign="top">&nbsp;</td>
               <td>Dependencia</td>
               <td colspan="2">
                  <?PHP
				  	conectardb($almacen);
					$qry_empresa="select * from direccion order by nombre";	
					$res_qry_empresa=$query($qry_empresa);					
					?>
					<select name="cbo_dependencias" id="cbo_dependencias" onChange="javascript:cargarCombo('cbo_jefe.php', 'cbo_dependencias', 'Div_jefe')">
					<?PHP
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_empresa=$fetch_array($res_qry_empresa))
					{
						echo'<option value="'.$row_empresa["iddireccion"].'">'.$row_empresa["nombre"].'</option>';
					}
					?>
					</select>
					<?				
						$free_result($res_qry_empresa);
					?>
                </td>
              </tr>
                  <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
            <tr>
                <td valign="top">&nbsp;</td>
                <td>Jefe Dependencia</td>
                <td colspan="2">
				<div id="Div_jefe">
		  		<select name="cbo_jefe"  id="cbo_jefe">
		  		</select>
	 			 </div>
                  </td>
                  </tr>
     
      
       
        <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
       
        
         <tr>
          <td valign="top"><div align="center"></div></td>
          <td valign="top">Estatus</td>
          <td colspan="2">
			 	 <?PHP
				  
					conectardb($almacen);											
					$qry_tipo_estatus="select * from cat_estatus where codigo_estatus = '3'";										
					$res_qry_tipo_estatus=$query($qry_tipo_estatus);	
					while($row_tipo_estatus=$fetch_array($res_qry_tipo_estatus))
					{
					print('<input  name="txt_estatus" value='.$row_tipo_estatus["estatus"].' type="text" size="10" id="txt_estatus" disabled/><input name="txt_estatus" value='.$row_tipo_estatus["codigo_estatus"].' type="hidden" size="10" id="txt_estatus"/>');
                         }
								$free_result($res_qry_tipo_estatus);									 
				?>
		         </td>
       </tr>
        
         <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        
        <tr>
          <td valign="top">&nbsp;</td>
          <td>Observaciones</td>
          <td colspan="2"><input name="observaciones" type="text" id="observaciones" size="75"></td>
        </tr>
     
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
    
    <li class="TabbedPanelsTab style3" tabindex="0">Detalle del Producto</li>
    <!-- <li class="TabbedPanelsTab style3" tabindex="0">Acreedor(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Bien(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Condiciones</li> -->
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
 
  <?PHP  if ($empresa=="1") {

 include("requisicion_det_mineco_directa.php");
 }
 
if ($empresa=="2") {

 include("requisicion_det_micro_directa.php");
 }

	?>    <?PHP // include("requisicion_det_mineco.php"); ?>
    <br>
    </div>
</div>
</div>
</td>
</tr>
</table>
<p align="center">
  <input name="cmd_guardar" type="button"onClick="validar(this.form)" id="cmd_guardar" value="Guardar hoja de ingreso" >
</p>
</form>

<p>&nbsp;</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>


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
	if ((form['nombre[0][1]'].value) == ""){alert('Seleccione el nombre del solicitante'); form['nombre[0][1]'].focus();  return};	
	
	if ((form['cbo_dependencias'].value) == "0"){alert('Seleccione la dependencia'); form['cbo_dependencias'].focus();  return};	
	
	if ((form['cbo_jefe'].value) == "0"){alert('Seleccione el jefe de dependencia'); form['cbo_jefe'].focus();  return};
    

   
	//if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
	//if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Detalle //////////////////////////////////////////////////////////	
	//	ban = 0; for (i=1;i<100;i++) { if (validarEntero(form['ingresado['+i+']']!="")) ban = 1; } if (ban == 0) {alert('No se acepta el ingreso de letras y comas en Cantidad recibida'); return};	
		ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][4]'])) ban = 1; } if (ban == 0) {alert('Falta el detalle de los productos ingresados'); return};
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	
	
	if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
}
</script>
</html>