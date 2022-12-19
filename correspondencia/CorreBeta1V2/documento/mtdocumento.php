<!DOCTYPE html>
<?php
function generaSelect()
{
	require_once('../Connections/redes.php'); 
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_1' name='select_1' onChange='cargaContenido(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1]</option>";
	}
	echo "</select>";
}
function generaSelect2()
{
	require_once('../Connections/redes.php'); 
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_21' name='select_21' onChange='cargaContenido2(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1]</option>";
	}
	echo "</select>";
}
function generaSelect3()
{
	require_once('../Connections/redes.php'); 
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_31' name='select_31' onChange='cargaContenido3(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1]</option>";
	}
	echo "</select>";
}
function generaSelect4()
{
	require_once('../Connections/redes.php'); 
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_41' name='select_41' onChange='cargaContenido4(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1]</option>";
	}
	echo "</select>";
}
function generaSelect5()
{
	require_once('../Connections/redes.php'); 
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_51' name='select_51' onChange='cargaContenido5(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1]</option>";
	}
	echo "</select>";
}
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<script language="javascript" type="text/javascript">
function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}

function cargaContenido(selectACargar)
{
	// Recibo el número correspondiente al combo que se debe llenar de datos
	var selectAnterior=selectACargar-1; // Obtengo el número del combo que activ� el evento onChange
	// Extraigo el valor del combo que se ha cambiado
	var valor=document.getElementById("select_"+selectAnterior).options[document.getElementById("select_"+selectAnterior).selectedIndex].value;
	var elemento;
	
	if(valor!=0)
	{
		ajax=nuevoAjax();
		// Envio al servidor el valor seleccionado y el combo al cual se le deben poner los datos
		ajax.open("GET", "mtselect_2_niveles_proceso.php?seleccionado="+valor+"&select="+selectACargar, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige" y pongo una que dice "Cargando"
				elemento=document.getElementById("select_"+selectACargar);
				elemento.length=0;
				var opcionCargando=document.createElement("option"); opcionCargando.value=0; opcionCargando.innerHTML="Cargando..."+selectACargar;
				elemento.appendChild(opcionCargando); elemento.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				// Coloco en la fila contenedora los datos que recivo del servidor
				document.getElementById("fila_"+selectACargar).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	/* Colocamos mediante los whiles los selects en "Selecciona opción..." cuando el select anterior
	ha quedado en estado "Elige" */
	var x=1, y=null;
	while(x<=3)
	{
		valor=document.getElementById("select_"+x).options[document.getElementById("select_"+x).selectedIndex].value;
		if(valor==0)
		{
			while(x<=3) 
			{
				y=x+1;
				elemento=document.getElementById("select_"+y);
				elemento.length=0;
				var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="Selecciona opci&oacute;n...";
				elemento.appendChild(opcionSelecciona); elemento.disabled=true;
				x++;
			}
		}
		x++;
	}
	
}

function nuevoAjax2()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}

function cargaContenido2(selectACargar)
{
	// Recibo el número correspondiente al combo que se debe llenar de datos
	var selectAnterior=selectACargar-1; // Obtengo el número del combo que activ� el evento onChange
	// Extraigo el valor del combo que se ha cambiado
	var valor=document.getElementById("select_2"+selectAnterior).options[document.getElementById("select_2"+selectAnterior).selectedIndex].value;
	var elemento;
	
	if(valor!=0)
	{
		ajax=nuevoAjax();
		// Envio al servidor el valor seleccionado y el combo al cual se le deben poner los datos
		ajax.open("GET", "mtselect_2_niveles_proceso.php?seleccionado="+valor+"&select="+selectACargar, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige" y pongo una que dice "Cargando"
				elemento=document.getElementById("select_2"+selectACargar);
				elemento.length=0;
				var opcionCargando=document.createElement("option"); opcionCargando.value=0; opcionCargando.innerHTML="Cargando..."+selectACargar;
				elemento.appendChild(opcionCargando); elemento.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				// Coloco en la fila contenedora los datos que recivo del servidor
				document.getElementById("fila_2"+selectACargar).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	/* Colocamos mediante los whiles los selects en "Selecciona opción..." cuando el select anterior
	ha quedado en estado "Elige" */
	var x=1, y=null;
	while(x<=3)
	{
		valor=document.getElementById("select_2"+x).options[document.getElementById("select_2"+x).selectedIndex].value;
		if(valor==0)
		{
			while(x<=3) 
			{
				y=x+1;
				elemento=document.getElementById("select_2"+y);
				elemento.length=0;
				var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="Selecciona opci&oacute;n...";
				elemento.appendChild(opcionSelecciona); elemento.disabled=true;
				x++;
			}
		}
		x++;
	}
}
function nuevoAjax3()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 
	return xmlhttp; 
}

function cargaContenido3(selectACargar)
{
	// Recibo el número correspondiente al combo que se debe llenar de datos
	var selectAnterior=selectACargar-1; // Obtengo el número del combo que activ� el evento onChange
	// Extraigo el valor del combo que se ha cambiado
	var valor=document.getElementById("select_3"+selectAnterior).options[document.getElementById("select_3"+selectAnterior).selectedIndex].value;
	var elemento;
	
	if(valor!=0)
	{
		ajax=nuevoAjax();
		// Envio al servidor el valor seleccionado y el combo al cual se le deben poner los datos
		ajax.open("GET", "mt3select_2_niveles_proceso.php?seleccionado="+valor+"&select="+selectACargar, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige" y pongo una que dice "Cargando"
				elemento=document.getElementById("select_3"+selectACargar);
				elemento.length=0;
				var opcionCargando=document.createElement("option"); opcionCargando.value=0; opcionCargando.innerHTML="Cargando..."+selectACargar;
				elemento.appendChild(opcionCargando); elemento.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				// Coloco en la fila contenedora los datos que recivo del servidor
				document.getElementById("fila_3"+selectACargar).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	/* Colocamos mediante los whiles los selects en "Selecciona opción..." cuando el select anterior
	ha quedado en estado "Elige" */
	var x=1, y=null;
	while(x<=3)
	{
		valor=document.getElementById("select_3"+x).options[document.getElementById("select_3"+x).selectedIndex].value;
		if(valor==0)
		{
			while(x<=3) 
			{
				y=x+1;
				elemento=document.getElementById("select_3"+y);
				elemento.length=0;
				var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="Selecciona opci&oacute;n...";
				elemento.appendChild(opcionSelecciona); elemento.disabled=true;
				x++;
			}
		}
		x++;
	}
}

function nuevoAjax4()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}

function cargaContenido4(selectACargar)
{
	// Recibo el número correspondiente al combo que se debe llenar de datos
	var selectAnterior=selectACargar-1; // Obtengo el número del combo que activ� el evento onChange
	// Extraigo el valor del combo que se ha cambiado
	var valor=document.getElementById("select_4"+selectAnterior).options[document.getElementById("select_4"+selectAnterior).selectedIndex].value;
	var elemento;
	
	if(valor!=0)
	{
		ajax=nuevoAjax();
		// Envio al servidor el valor seleccionado y el combo al cual se le deben poner los datos
		ajax.open("GET", "mt4select_2_niveles_proceso.php?seleccionado="+valor+"&select="+selectACargar, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige" y pongo una que dice "Cargando"
				elemento=document.getElementById("select_4"+selectACargar);
				elemento.length=0;
				var opcionCargando=document.createElement("option"); opcionCargando.value=0; opcionCargando.innerHTML="Cargando..."+selectACargar;
				elemento.appendChild(opcionCargando); elemento.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				// Coloco en la fila contenedora los datos que recivo del servidor
				document.getElementById("fila_4"+selectACargar).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	/* Colocamos mediante los whiles los selects en "Selecciona opción..." cuando el select anterior
	ha quedado en estado "Elige" */
	var x=1, y=null;
	while(x<=3)
	{
		valor=document.getElementById("select_4"+x).options[document.getElementById("select_4"+x).selectedIndex].value;
		if(valor==0)
		{
			while(x<=3) 
			{
				y=x+1;
				elemento=document.getElementById("select_4"+y);
				elemento.length=0;
				var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="Selecciona opci&oacute;n...";
				elemento.appendChild(opcionSelecciona); elemento.disabled=true;
				x++;
			}
		}
		x++;
	}
}

function nuevoAjax5()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}

function cargaContenido5(selectACargar)
{
	// Recibo el número correspondiente al combo que se debe llenar de datos
	var selectAnterior=selectACargar-1; // Obtengo el número del combo que activ� el evento onChange
	// Extraigo el valor del combo que se ha cambiado
	var valor=document.getElementById("select_5"+selectAnterior).options[document.getElementById("select_5"+selectAnterior).selectedIndex].value;
	var elemento;
	
	if(valor!=0)
	{
		ajax=nuevoAjax();
		// Envio al servidor el valor seleccionado y el combo al cual se le deben poner los datos
		ajax.open("GET", "mt5select_2_niveles_proceso.php?seleccionado="+valor+"&select="+selectACargar, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige" y pongo una que dice "Cargando"
				elemento=document.getElementById("select_5"+selectACargar);
				elemento.length=0;
				var opcionCargando=document.createElement("option"); opcionCargando.value=0; opcionCargando.innerHTML="Cargando..."+selectACargar;
				elemento.appendChild(opcionCargando); elemento.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				// Coloco en la fila contenedora los datos que recivo del servidor
				document.getElementById("fila_5"+selectACargar).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	/* Colocamos mediante los whiles los selects en "Selecciona opción..." cuando el select anterior
	ha quedado en estado "Elige" */
	var x=1, y=null;
	while(x<=3)
	{
		valor=document.getElementById("select_5"+x).options[document.getElementById("select_5"+x).selectedIndex].value;
		if(valor==0)
		{
			while(x<=3) 
			{
				y=x+1;
				elemento=document.getElementById("select_5"+y);
				elemento.length=0;
				var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="Selecciona opci&oacute;n...";
				elemento.appendChild(opcionSelecciona); elemento.disabled=true;
				x++;
			}
		}
		x++;
	}
}

</script>
<style type="text/css"> 
.punteado 
{ 
	border-style:inset; 
	border-color:#FFFFFF; 
	background-color:#FFFFFF;
	font-family:Verdana; 
	font-size:12px; 
	text-align:center;
}

.combo
{
	font-family:Verdana; 
	font-size:10px; 
	border-color:#CCCCCC;
}
.Estilo3 {	font-family: Verdana;
	font-size: medium;
	border-color: #CCCCCC;
	color: #FFFFFF;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
</style>
<style type="text/css">
<!--
.Estilo1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #878EAA;
}
.Estilo3 {	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<script language="javascript">
function enviar(form)
{
   form.action = "uploadForm.php";
   return true;
}

function enviar2(form)
{
   form.action = "saveLocal.php";
   return true;
}

function enviarAll(form)
{
 form.action = "saveAll.php";
 return true;
}
</script>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo4 {font-size: 12px}
.Estilo5 {
	color: #0033CC;
	font-weight: bold;
}
.Estilo6 {font-size: 12px; color: #0033CC; }
.Estilo7 {color: #0033CC}
body,td,th {
	font-size: 12px;
	color: #0066FF;
}
.Estilo8 {
	color: #FFFFFF;
	font-size: 18px;
}
-->
</style></head>
<?
		session_start();
		$usuario = $_SESSION['codigoUsuario'];
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 
			$SQL = "SELECT docu,titulo,quien,insti,descr,ref FROM tmp_documento WHERE empleado = $usuario";
			$result = mysql_query($SQL); // elimina informacion temporal
			$row = mysql_fetch_row($result);
?>
<body>
<p>&nbsp;</p>
<form name="form1" method="post" action="save.php">
  <div align="left">
    <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="5">
      <tr bgcolor="#000000">
        <td bgcolor="#0033FF">&nbsp;</td>
        <td colspan="3" bgcolor="#0033FF"><div align="left"><span class="Estilo8">  CORRESPONDENCIA NUEVA </span></div></td>
      </tr>
      <tr bgcolor="#000000">
        <td width="22%" bgcolor="#0033FF"><div align="left"><span class="Estilo3 Estilo4">Correspondencia</span></div></td>
        <td colspan="3" bgcolor="#0033FF"><div align="left"></div></td>
      </tr>
      <tr>
        <td><div align="left" class="Estilo1">
            <div align="left" class="Estilo6">Titulo</div>
        </div></td>
        <td colspan="3"><div align="left">
            <input name="txtTitulo" type="text" id="txtTitulo" size="45" value="<? print $row[1]?>">
        </div></td>
      </tr>
      <tr bgcolor="#000000">
        <td bgcolor="#0033FF"><div align="left"><span class="Estilo3 Estilo4">A Quien va el documento </span></div></td>
        <td colspan="3" bgcolor="#6699FF"><div align="left"></div></td>
      </tr>
      <tr>
        <td><span class="Estilo4 Estilo5">Direcci&oacute;n</span></td>
        <td><span lang="es-gt">
          <table border="0" width="600px" style="border-style:none;">
            <tr>
              <td width="200" bgcolor="#3399FF" class="punteado" id="fila_1"><?php generaSelect(); ?></td>
              <td id="fila_2" width="200" class="punteado">
                <select class="combo" disabled="disabled" id="select" name="select_2">
                  <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                </select>
              </td>
            </tr>
          </table>
        </span></td>
        <td>&nbsp;</td>
        <td><span lang="es-gt"><span lang="es-gt">
          <input name="docu2" type="hidden" id="docu22" value="<? print $row[0]?>">
          <span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
          <input name="docu" type="hidden" id="docu3" value="<? print $row[0]?>">
        </span></span></span></span> </span></span></td>
      </tr>
      <tr>
        <td><span class="Estilo4 Estilo5">CC1</span></td>
        <td><span lang="es-gt">
          <table border="0" width="600px" style="border-style:none;">
            <tr>
              <td width="200" bgcolor="#3399FF" class="punteado" id="fila_21"><?php generaSelect2(); ?></td>
              <td id="fila_22" width="200" class="punteado">
                 <select class="combo" disabled="disabled" id="select2" name="select_22">
                  <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                </select>
              </td>
            </tr>
          </table>
        </span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo4 Estilo5">CC2</span></td>
        <td><span lang="es-gt">
          <table border="0" width="600px" style="border-style:none;">
            <tr>
              <td width="200" bgcolor="#3399FF" class="punteado" id="fila_31"><?php generaSelect3(); ?></td>
              <td id="fila_32" width="200" class="punteado">
                <select class="combo" disabled="disabled" id="select3" name="select_32">
                  <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                </select>
              </td>
            </tr>
          </table>
        </span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo4 Estilo5">CC3</span></td>
        <td><span lang="es-gt">
          <table border="0" width="600px" style="border-style:none;">
            <tr>
              <td width="200" bgcolor="#3399FF" class="punteado" id="fila_41"><?php generaSelect4(); ?></td>
              <td id="fila_42" width="200" class="punteado">
                <select class="combo" disabled="disabled" id="select4" name="select_42">
                  <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                </select>
              </td>
            </tr>
          </table>
        </span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="left" class="Estilo4 Estilo5">CC4</div></td>
        <td width="15%"><div align="left">
          <table border="0" width="600px" style="border-style:none;">
            <tr>
              <td width="200" bgcolor="#3399FF" class="punteado" id="fila_51"><span lang="es-gt">
                <?php generaSelect5(); ?>
              </span></td>
              <td id="fila_52" width="200" class="punteado"> <span lang="es-gt">
                <select class="combo" disabled="disabled" id="select5" name="select_52">
                  <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                </select>
              </span></td>
            </tr>
          </table>
        <span lang="es-gt"><span lang="es-gt"></span></span></div></td>
        <td width="17%">&nbsp;</td>
        <td width="46%"><span lang="es-gt">          <span lang="es-gt">          <span lang="es-gt"><span lang="es-gt">
        </span></span> </span>        </span></td>
      </tr>
      <tr bgcolor="#000000">
        <td bgcolor="#0033FF"><div align="left"><span class="Estilo3 Estilo4">Detalle del Documento </span></div></td>
        <td colspan="3" bgcolor="#0099FF"><div align="left" class="Estilo3"></div></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td bgcolor="#FFFFFF"><div align="left" class="Estilo4 Estilo7"><strong>Quien Envia </strong></div></td>
        <td colspan="3"><div align="left">
            <input name="txtQuien" type="text" id="txtMonto" size="45" value="<? print $row[2]?>">
        </div></td>
      </tr>
      <tr >
        <td ><div align="left" class="Estilo6"><strong>Institucion</strong></div></td>
        <td colspan="3" ><div align="left">
            <input name="txtInsti" type="text" id="txtInsti" size="45" value="<? print $row[3]?>">
        </div></td>
      </tr>
      <tr>
        <td ><div align="left" class=">Dtilo6"><strong>Descripcion</strong></div></td>
        <td colspan="3" ><div align="left">
            <textarea name="txtDesc" cols="45" rows="7" id="txtDesc"> <? print $row[4]?></textarea>
        </div></td>
      </tr>
      <tr >
        <td><div align="left" class="Estilo6"><strong>Referencia</strong></div></td>
        <td colspan="3"><div align="left">
            <input name="txtRef" type="text" id="txtRef" size="45" value="<? print $row[5]?>">
        </div></td>
      </tr>
    </table>
    <table width="100%"  border="1">
      <tr>
        <td bgcolor="#0066FF"><div align="center" class="Estilo3">Adjuntar Archivos </div></td>
      </tr>
    </table>
    <table width="100%"  border="1">
      <tr bgcolor="#333333">
       
        <td width="42%" bgcolor="#0066FF"><div align="center"><span class="Estilo3">Documento</span></div></td>
        <td width="31%" bgcolor="#0066FF"><div align="center" class="Estilo3">
          <div align="center">Descripci&oacute;n</div>
        </div></td>
        <td width="12%" bgcolor="#0066FF"><div align="center" class="Estilo3">
          <div align="center">Acci&oacute;n</div>
        </div></td>
      </tr>
	  <?
	 		
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 
			$SQL = "SELECT da,nombre,descripcion,path,da FROM tmp_doc_adj WHERE   docu = $row[0]";
			
			$result = mysql_query($SQL); // elimina informacion temporal
			while ($row1 = mysql_fetch_row($result))
			{
			
				 print " <tr>";
//		        print " <td>$row1[0]</td>";
		        print " <td><a href=upload/$row1[3] target='_blank' >$row1[1]</a></td>";
		        print " <td>$row1[2]</td>";
		        print " <td><a href='eliminaDoc.php?da=$row1[4]&docu=$row[0]&nombreDoc=$row1[1] '>Eliminar</a></td>";
		      print " </tr>";
			} 

	  mysql_close($db);
	  ?>
    
    </table>
    <p>&nbsp;</p>
  </div>
  <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td><div align="center">
        <input type="submit" name="Submit" value="Enviar">
      </div></td>
      <td><div align="center">
        <input name="cboAlmacenar" type="submit" id="cboAlmacenar" value="Almacenar" onClick="enviar2(this.form)">
      </div></td>
      <td><div align="center">
        <input type="submit" name="Submit" value="Enviar a todos" onClick="enviarAll(this.form)">
      </div></td>
      <td><div align="center">
        <input name="adjuntar" type="submit" id="adjuntar" value="Adjuntar Archivo" onClick="enviar(this.form)">
      </div></td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
