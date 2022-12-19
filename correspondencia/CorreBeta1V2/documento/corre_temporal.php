<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "correBeta1V2/documento/";
	$_SESSION['pagina'] = $page;

	include('../../security.php');
	print $_SESSION['iso_registro'];
?>
<!DOCTYPE html>
<?php
function generaSelect()
{
	require_once('../Connections/redes.php');
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre,siglas From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_1' name='select_1' onChange='cargaContenido(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1] - $registro[2]</option>";
	}
	echo "</select>";
}
function generaSelect2()
{
	require_once('../Connections/redes.php');
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre,siglas From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_21' name='select_21' onChange='cargaContenido2(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1] - $registro[2]</option>";
	}
	echo "</select>";
}
function generaSelect3()
{
	require_once('../Connections/redes.php');
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre,siglas From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_31' name='select_31' onChange='cargaContenido3(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1] - $registro[2]</option>";
	}
	echo "</select>";
}
function generaSelect4()
{
	require_once('../Connections/redes.php');
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre,siglas From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_41' name='select_41' onChange='cargaContenido4(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1] - $registro[2]</option>";
	}
	echo "</select>";
}
function generaSelect5()
{
	require_once('../Connections/redes.php');
	mysql_select_db($database_redes);
	$sSQL="Select iddireccion,nombre,siglas From direccion order by nombre";
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_51' name='select_51' onChange='cargaContenido5(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1] - $registro[2]</option>";
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
	if (!f lhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }

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
		ajax.open("GET", "mtselect_1_niveles_proceso.php?seleccionado="+valor+"&select="+selectACargar, true);
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
				var opcionSelecciona=document.createEleopnt("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="Selecciona opci&oacute;n...";
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
.Estilo9 {color: #FFFFFF}
.Estilo12 {font-family: Verdana;
	font-size: medium;
	border-color: #CCCCCC;
	color: #FFFFFF;
}
.Estilo12 {color: #FFFFFF;
	font-weight: bold;
}
.Estilo13 {font-size: 14px}
.Estilo17 {color: #0033CC; font-weight: bold; font-size: 24px; }
-->
</style></head>
<?
		session_start();
		$usuario = $_SESSION['codigoUsuario'];

		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);

		///////////////////////////////// modificado 7-11/2006 ///////////////////////////
		   $dOF23 = $_SESSION['direcOF'];
			$sqlOF44 = "select correlativo +1 from direccion where iddireccion = ". $dOF23;
			$resOF44 = mysql_query($sqlOF44);
			$rowOF44 = mysql_fetch_row($resOF44);
			$correlativo = $rowOF44[0];
			print $correlativo;

			//////////////////////////////////////////////////////////////////////////////////
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
			$SQL = "SELECT docu,titulo,quien,insti,descr,ref FROM tmp_documento WHERE empleado = $usuario";
			$result = mysql_query($SQL); // elimina informacion temporal
			$row = mysql_fetch_row($result);
			$mtdocutmp = $row[0];



			//print $SQL." - ".$mtdocutmp;
?>
<body>
<p>&nbsp;</p>
<form name="form1" method="post" action="save.php">
  <div align="left">
    <p>&nbsp;</p>
  </div>
  <span class="Estilo17">Correspondencia almacenada para ser enviada</span>
  <table width="100%"  border="1">
    <tr>
      <th rowspan="2" valign="top" scope="col">        <table width="97%"  border="0" align="center" cellpadding="0" cellspacing="5">
          <tr bgcolor="#6699FF">
            <td colspan="3"><div align="left" class="Estilo8"> Correspondecia a enviar - No.
                      <?= $correlativo ?>
            </div></td>
          </tr>
          <tr bgcolor="#000000">
            <td width="22%" bgcolor="#0066FF"><div align="left" class="Estilo3 Estilo4">Correspondencia</div></td>
            <td colspan="2" bgcolor="#6699FF"><div align="left"></div></td>
          </tr>
          <tr>
            <td class="Estilo6"><strong>Instituci&oacute;n</strong></td>
            <td width="78%" class="Estilo6"><strong>
              <input name="txtInsti" type="text" id="txtInsti2" size="45" value="<? print $row[3]?>">
            </strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="Estilo4 Estilo7"><strong>Persona que envia </strong></td>
            <td><div align="left"> <span class="Estilo6"><strong>
              <input name="txtQuien" type="text" id="txtQuien3" size="45" value="<? print $row[2]?>">
            </strong></span></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="left" class="Estilo6"><strong>Referencia</strong></div></td>
            <td><input name="txtRef" type="text" id="txtRef" size="45" value="<? print $row[5]?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="#000000">
            <td bgcolor="#0066FF"><div align="left" class="Estilo3 Estilo4">Detalle del </div></td>
            <td colspan="2" bgcolor="#6699FF"><div align="left" class="Estilo12"><span class="Estilo3 Estilo4">Documento </span></div></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td background="Fondo de Fiesta.jpg" bgcolor="#FFFFFF"><div align="left" class="Estilo6"><strong>Asunto</strong></div></td>
            <td colspan="2" background="Fondo de Fiesta.jpg"><div align="left">
                <input name="txtTitulo" type="text" id="txtTitulo" size="45" value="<? print $row[1]?>">
            </div></td>
          </tr>
          <tr >
            <td ><div align="left" class="Estilo6"></div></td>
            <td colspan="2" ><div align="left"> </div></td>
          </tr>
          <tr>
            <td ><div align="left" class="Estilo6"><strong>Descripcion</strong></div></td>
            <td colspan="2" ><div align="left">
                <textarea name="txtDesc" cols="45" rows="7" id="textarea"> <? print $row[4]?></textarea>
            </div></td>
          </tr>
          <tr >
            <td colspan="3"><div align="left"> </div></td>
          </tr>
        </table>       </th>
      <th valign="top" scope="col"><table width="62%"  border="0" align="center" cellpadding="0" cellspacing="5">
        <tr bgcolor="#000000">
          <td width="8%" bgcolor="#0066FF"><div align="left" class="Estilo9">Direcci&oacute;n</div></td>
          <td colspan="2" bgcolor="#6699FF"><div align="left">
              <p class="Estilo3 Estilo4">A Quien va el documento </p>
          </div>
            </td>
        </tr>
        <tr>
          <td class="Estilo4 Estilo5">Direcci&oacute;n</td>
          <td width="12%">
            <table border="0" width="326" style="border-style:none;">
              <tr>
                <td width="70" bgcolor="#3399FF" class="punteado" id="fila_1">
                  <?php generaSelect(); ?>
                </td>
                <td id="fila_2" width="246" class="punteado"> <span lang="es-gt">
                  <select class="combo" disabled="disabled" id="select11" name="select_2">
                    <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                  </select>
                </span></td>
              </tr>
          </table></td>
          <td>
            <input name="docu2" type="hidden" id="docu23" value="<? print $row[0];?>">
            <span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
            <input name="docu" type="hidden" id="docu4" value="<? print $row[0];?>">
          </span></span></span></span> </td>
        </tr>
        <tr>
          <td class="Estilo4 Estilo5">CC1</td>
          <td rowspan="4">
            <table border="0" width="328" style="border-style:none;">
              <tr>
                <td width="65" bgcolor="#3399FF" class="punteado" id="fila_21">
                  <?php generaSelect2(); ?>
                </td>
                <td id="fila_22" width="253" class="punteado"> <span lang="es-gt">
                  <select class="combo" disabled="disabled" id="select12" name="select_22">
                    <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                  </select>
                </span></td>
              </tr>
            </table>
            <table border="0" width="331" style="border-style:none;">
              <tr>
                <td width="68" bgcolor="#3399FF" class="punteado" id="fila_31">
                  <?php generaSelect3(); ?>
                </td>
                <td id="fila_32" width="253" class="punteado"> <span lang="es-gt">
                  <select class="combo" disabled="disabled" id="select13" name="select_32">
                    <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                  </select>
                </span></td>
              </tr>
            </table>
            <table border="0" width="332" style="border-style:none;">
              <tr>
                <td width="67" bgcolor="#3399FF" class="punteado" id="fila_41">
                  <?php generaSelect4(); ?>
                </td>
                <td id="fila_42" width="255" class="punteado"> <span lang="es-gt">
                  <select class="combo" disabled="disabled" id="select14" name="select_42">
                    <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                  </select>
                </span></td>
              </tr>
            </table>
            <div align="left">
              <table border="0" width="332" style="border-style:none;">
                <tr>
                  <td width="70" bgcolor="#3399FF" class="punteado" id="fila_51">
                    <?php generaSelect5(); ?>
                  </td>
                  <td id="fila_52" width="307" class="punteado"> <span lang="es-gt">
                    <select class="combo" disabled="disabled" id="select15" name="select_52">
                      <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
                    </select>
                  </span></td>
                </tr>
              </table>
              <span lang="es-gt"><span lang="es-gt"></span></span></div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="Estilo4 Estilo5">CC2</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="Estilo4 Estilo5">CC3</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div align="left" class="Estilo4 Estilo5">CC4</div></td>
          <td width="2%"> <span lang="es-gt"> <span lang="es-gt"><span lang="es-gt"> </span></span> </span> </td>
        </tr>
      </table>           </th>
    </tr>
    <tr>
      <td width="62%" bordercolor="#000000"><div align="center">
          <input name="adjuntar" type="submit" id="adjuntar" value="Adjuntar Archivo" onClick="enviar(this.form)">
          <input type="hidden" name="correl23" value="<?= $correlativo ?>">
          <input type="hidden" name="idDir" value = "<?= $dOF23?>">
      </div></td>
    </tr>
    <tr>
      <th colspan="2" scope="row"><table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
        <tr>
          <td colspan="2"><div align="left"></div></td>
          <td colspan="2"><div align="left"></div></td>
        </tr>
        <tr>
          <td colspan="2">              <div align="left">
                <input name="radiobutton" type="radio" value="1">
            Para su conocimiento </div></td>
          <td>
            <div align="left">
              <input name="radiobutton" type="radio" value="5">
            Preparar respuesta /Hacer nota </div></td>
          <td><div align="left">
            <input name="radiobutton" type="radio" value="9">
        Desig: Funcionario /s </div></td>
        </tr>
        <tr>
          <td colspan="2">      <div align="left">
      <input name="radiobutton" type="radio" value="2">
      Emitir dict&aacute;men /opini&oacute;n </div></td>
          <td>            <div align="left">
              <input name="radiobutton" type="radio" value="6">
          Realizar consulta </div></td>
          <td><div align="left">
            <input name="radiobutton" type="radio" value="10">
        Asistir / Participar </div></td>
        </tr>
        <tr>
          <td colspan="2">            <div align="left">
              <input name="radiobutton" type="radio" value="3">
          Rendir informe / Resultados </div></td>
          <td>             <div align="left">
              <input name="radiobutton" type="radio" value="7">
          Convocar / Dar cita </div></td>
          <td><div align="left">
            <input name="radiobutton" type="radio" value="11">
        Organizar Evento </div></td>
        </tr>
        <tr>
          <td colspan="2">      <div align="left">
      <input name="radiobutton" type="radio" value="4">
      Preparar s&iacute;ntesis / Res&uacute;men </div></td>
          <td>            <div align="left">
              <input name="radiobutton" type="radio" value="8">
          Atender audiencia / Solicitante </div></td>
          <td><div align="left">
            <input name="radiobutton" type="radio" value="12">
        Investigar</div></td>
        </tr>
        <tr>
          <td colspan="2"><div align="left"></div></td>
          <td><div align="left"></div></td>
          <td><div align="left">
            <input name="radiobutton" type="radio" value="13">
        Distribuir</div></td>
        </tr>
        <tr align="left" valign="top">
          <td colspan="4">Asunto / Observaciones: <font face="Arial, Helvetica, sans-serif">
            <textarea name="obsercac" cols="40" rows="3" id="textarea2"></textarea>
          </font></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td><div align="center">Secretar&iacute;a </div></td>
          <td>Llamar
              <input name="radiobutton2" type="radio" value="14"></td>
          <td>Archivar
              <input name="radiobutton2" type="radio" value="15"></td>
          <td>Agendar
              <input name="radiobutton2" type="radio" value="16"></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center"></div></td>
          <td colspan="2"><div align="center"> </div></td>
        </tr>
      </table></th>
    </tr>
    <tr>
      <th scope="col"><input type="submit" name="Submit2" value="Enviar"></th>
      <th scope="col"><input type="submit" name="Submit3" value="Enviar a todos" onClick="enviarAll(this.form)"></th>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;  </p>
</form>
<p>&nbsp;</p>
</body>
</html>
