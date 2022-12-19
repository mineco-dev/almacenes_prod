<?php
//INICIO DE LA SESION
session_start();



// ESTE ES EL LOGEO DEL USUARIO **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}

include('restrict.php'); 
require_once('Conn.php');



$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mssql_select_db($database_Conn, $Conn);

$query_Recordset1 = sprintf("SELECT * FROM usuarios WHERE usuario = '%s'", $colname_Recordset1);
$Recordset1 = mssql_query($query_Recordset1, $Conn) or die(mssql_error());
$row_Recordset1 = mssql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mssql_num_rows($Recordset1);

?>
<?php
mssql_free_result($Recordset1);



echo $row_Recordset1['nombre']; 

include('../INCLUDES/inc_header.inc');
$dbms=new DBMS($conexion); 
include("../conectarse.php");

/*	include('../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); */




?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
 	require_once('class.datepicker.php');
    $db=new datepicker();
    $db->firstDayOfWeek = 1;
    $db->dateFormat = "d/m/Y";

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

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
   form.action = "okTransfer.php?ccarpeta=3";
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
-->
</style>
	<meta name="description" content=" Click the '...' button to display the calendar. Notice that you can set the time at the bottom of the calendar. You cannot select Sundays. Select any Friday of the month. On Fridays you cannot set times earlier than 08:00 and later than 21:45. On Saturdays you can set only times between 11:00 and 17:00. Select any day of the month except Friday, Saturday or Sunday. You can set any time you want. Set the time to 23:00, and change the day to a Saturday. Notice that the time automatically scrolls past 11:00, since that is the earliest valid time for that day. ">
	<meta name="keywords" content="dhtml tools,javascript,DHTML Tools,Javascript,ajax,AJAX,Ajax,ajax tools,AJAX Tools,tools controls,simple javascript tools">
	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

	<script type='text/javascript' src='../../utils/zapatec.js'></script>
	<script type="text/javascript" src="../src/calendar.js"></script>
	<script type="text/javascript" src="../lang/calendar-sp.js"></script>

	<link href="../../website/css/zpcal.css" rel="stylesheet" type="text/css">
	<link href="../../website/css/template.css" rel="stylet/eet" type="text/css">
	<style>
		body {
			width: 760px;
		}
	</style>

	<!-- Theme css -->
	<link href="../themes/system.css" rel="stylesheet" type="text/css">
	<link rel="SHORTCUT ICON" href="http://www.zapatec.com/website/main/favicon.ico">
    <style type="text/css">
<!--
.Estilo10 {color: #FF0000}
.Estilo11 {font-size: 15px}
.Estilo18 {font-size: 18px;
	font-weight: bold;
}
.Estilo12 {
	font-size: 10px;
	color: #660000;
}
-->
    </style>
</head>
<?

?>






<body>
<p align="right"><span class="Estilo18"><a href="../center.php"><img src="tareas.gif" width="16" height="16"><span class="Estilo12">Regresar al Menu</span></a></span></p>
<form name="form1" method="post" action="save.php?ccarpeta=1">
  <div align="left">
    
    <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="5">
      <tr bgcolor="#000000">
        <td bgcolor="#0066FF">&nbsp;</td>
        <td width="78%" colspan="4" bgcolor="#6699FF"><div align="left"><span class="Estilo8">  CORRESPONDENCIA NUEVA - No. <? print $correlativo; ?></span></div></td>
      </tr>
      <tr bgcolor="#000000">
        <td width="22%" bgcolor="#0066FF"><div align="left"><span class="Estilo3 Estilo4">Correspondencia</span></div></td>
        <td colspan="4" bgcolor="#6699FF"><div align="left">
        </div></td>
      </tr>
      <tr>
        <td><span class="Estilo6"><strong>Instituci&oacute;n</strong></span></td>
        <td>&nbsp;</td>
        <td colspan="2"><span class="Estilo6"><strong>
        <strong>
        <input name="txtInsti" type="text" id="txtInsti" size="45" value="<? print $insti;?>">
        </strong> </strong></span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo6"><span class="Estilo4 Estilo7"><strong>Persona que envia </strong></span></span></td>
        <td><div align="left">            <span class="Estilo6"></span></div></td>
        <td><div align="left"><span class="Estilo6"><strong>
            <input name="txtQuien" type="text" id="txtQuien" size="45" value="<? print $quien;?>">
        </strong></span></div></td>
        <td><div align="right"><span class="Estilo6"><strong>Referencia</strong></span></div></td>
        <td><input name="txtRef" type="text" id="txtRef2" size="45" value="<? print $ref;?>"></td>
      </tr>
      <tr bgcolor="#000000">
        <td bgcolor="#0066FF"><div align="left"><span class="Estilo3 Estilo4">Detalle del Documento </span></div></td>
        <td colspan="4" bgcolor="#6699FF"><div align="left" class="Estilo3"></div></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td background="Fondo de Fiesta.jpg" bgcolor="#FFFFFF"><div align="left" class="Estilo4 Estilo7"><span class="Estilo6"><strong>Asunto</strong></span></div></td>
        <td colspan="4" background="Fondo de Fiesta.jpg"><div align="left">

<input name="txtTitulo" type="text" id="txtTitulo2" size="45" value="<? print $titulo;?>">
        </div></td>
      </tr>
      <tr >
        <td ><div align="left" class="Estilo6"></div></td>
        <td colspan="4" ><div align="left">        </div></td>
      </tr>
      <tr>
        <td ><div align="left" class="Estilo6"><strong>Descripcion</strong></div></td>
        <td colspan="4" ><div align="left">
            <textarea name="txtDesc" cols="45" rows="7" id="txtDesc"> <? print $desc;?></textarea>
        </div></td>
      </tr>
      <tr >
        <td colspan="5"><div align="left">
        </div></td>
      </tr>
    </table>
    <table width="99%"  border="1">
      <tr>
        <td bgcolor="#0066FF"><div align="center" class="Estilo3">Adjuntar Archivos </div></td>
      </tr>
    </table>
    <table width="99%"  border="1">
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
			$SQL = "SELECT da,nombre,descripcion,path,da FROM tmp_doc_adj WHERE idempleado = $usuario";
			$result = mssql_query($SQL); //elimina informacion temporal
			while ($row1 = mssql_fetch_row($result))
			{

				 print " <tr>";
//		        print " <td>$row1[0]</td>";
		        print " <td><a href=upload/$row1[3] target='_blank' >$row1[1]</a></td>";
		        print " <td>$row1[2]</td>";
		        print " <td><a href='eliminaDoc.php?da=$row1[4]&docu=$row[0]&nombreDoc=$row1[1] '>Eliminar</a></td>";
		      print " </tr>";
			}

	  mssql_close($db);
	  ?>

    </table>
    <p>&nbsp;</p>
  </div>
  <table width="96%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td><div align="center">
      </div></td>
      <td><div align="center">
        <input name="cboAlmacenar" type="submit" id="cboAlmacenar" value="Guardar Borrador" onClick="enviar2(this.form)">
      </div></td>
      <td><div align="center">
      </div></td>
      <td><div align="center">
        <input name="adjuntar" type="submit" id="adjuntar" value="Adjuntar Archivo" onClick="enviar(this.form)">
		<input type="hidden" name="correl23" value="<?= $correlativo ?>">
		<input type="hidden" name="idDir" value = "<?= $dOF23?>">
      </div></td>
    </tr>
  </table>
  <table width="97%"  border="0" align="center" cellpadding="0" cellspacing="5">
    <tr bgcolor="#000000">
      <td width="8%" rowspan="2" bgcolor="#0066FF"><div align="left"><span class="Estilo9">Direcci&oacute;n</span></div></td>
      <td colspan="2" bgcolor="#6699FF"><div align="left">
        <p class="Estilo3 Estilo4">&nbsp;</p>
        </div>        </td>
    </tr>
    <tr bgcolor="#000000">
      <td colspan="2" bgcolor="#6699FF"><span class="Estilo3 Estilo4">A Quien va el documento </span></td>
    </tr>
    <tr>
      <td><span class="Estilo4 Estilo5">Direcci&oacute;n</span></td>
      <td width="12%">
        <table border="0" width="600px" style="border-style:none;">
          <tr>
            <td width="200" bgcolor="#3399FF" class="punteado" id="fila_1"><span lang="es-gt">

			

			<select name="iddireccion" class="TituloMedios" id="iddireccion"  onChange="javascript:cargarCombo('subactividades3.php', 'iddireccion', 'Div_Subactividades3')">
            <option value=0> Seleccione </option>
            <? 
				$dbms->sql="select  iddireccion, direccion FROM direccion"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["direccion"]."</option>"; 
				}
			?>
		  </select>

            </span></td>
            <td id="fila_2" width="200" class="punteado"> <span lang="es-gt">

<div align="left">
		  <div id="Div_Subactividades3"> 
				<label for="SubActividad3"></label> 
                 <select name="idasesor"  id="idasesor" class="TituloMedios">

            </select>

</div>
        </div>
            </span></td>
          </tr>
      </table></td>
      <td><span lang="es-gt"><span lang="es-gt">
        <input name="docu2" type="hidden" id="docu22" value="<? print $row[0];?>">
        <span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
        <input name="docu" type="hidden" id="docu3" value="<? print $row[0];?>">
      </span></span></span></span> </span></span></td>
    </tr>
    <tr>
        <td>CC1</td>
        <td rowspan="5">
          <table border="0" width="600px" style="border-style:none;">
            <tr>
              <td width="200" bgcolor="#3399FF" class="punteado" id="fila_21"><span lang="es-gt">
                <select name="iddireccion1" class="TituloMedios" id="iddireccion1"  onChange="javascript:cargarCombo('subactividades4.php', 'iddireccion1', 'Div_Subactividades4')">
                  <option value=0> Seleccione </option>
                  <? 
				$dbms->sql="select  iddireccion, direccion FROM direccion"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["direccion"]."</option>"; 
				}
			?>
                </select>
              </span></td>
              <td id="fila_22" width="200" class="punteado"> <span lang="es-gt">
                <div align="left">
                  <div id="Div_Subactividades4">
                    <label for="SubActividad4"></label>
                    <select name="idasesor"  id="idasesor" class="TituloMedios">
                    </select>
                  </div>
                </div>
              </span></td>
            </tr>
          </table>
          <table border="0" width="600px" style="border-style:none;">
          <tr>
            <td width="200" bgcolor="#3399FF" class="punteado" id="fila_31"><span lang="es-gt">

<select name="iddireccion2" class="TituloMedios" id="iddireccion2"  onChange="javascript:cargarCombo('subactividades5.php', 'iddireccion2', 'Div_Subactividades5')">
            <option value=0> Seleccione </option>
            <? 
				$dbms->sql="select  iddireccion, direccion FROM direccion"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["direccion"]."</option>"; 
				}
			?>
		  </select>
            </span></td>
            <td id="fila_32" width="200" class="punteado"> <span lang="es-gt">
<div align="left">
		  <div id="Div_Subactividades5"> 
				<label for="SubActividad5"></label> 
                 <select name="idasesor"  id="idasesor" class="TituloMedios">

            </select>

</div>
        </div>

            </span></td>
          </tr>
        </table>
        <table border="0" width="600px" style="border-style:none;">
          <tr>
            <td width="200" bgcolor="#3399FF" class="punteado" id="fila_41"><span lang="es-gt">
            <span lang="es-gt">

<span class="punteado"><span lang="es-gt">

<select name="iddireccion3" class="TituloMedios" id="iddireccion3"  onChange="javascript:cargarCombo('subactividades6.php', 'iddireccion3', 'Div_Subactividades6')">
            <option value=0> Seleccione </option>
            <? 
				$dbms->sql="select  iddireccion, direccion FROM direccion"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["direccion"]."</option>"; 
				}
			?>
		  </select></span></span>

            </span> </span></td>
            <td id="fila_42" width="200" class="punteado"> <span lang="es-gt">
<div align="left">
		  <div id="Div_Subactividades6"> 
				<label for="SubActividad6"></label> 
                 <select name="idasesor"  id="idasesor" class="TituloMedios">

            </select>

</div>
        </div>

            </span></td>
          </tr>
        </table>        <div align="left">
          <table border="0" width="600px" style="border-style:none;">
            <tr>
              <td width="200" bgcolor="#3399FF" class="punteado" id="fila_51"><span lang="es-gt">
              <span lang="es-gt">
              <span class="Estilo6"><strong><strong>
              <input name="txtInsti2" type="text" id="txtInsti2" size="45" value="<? print $insti;?>">
              </strong> </strong></span>              </span> </span></td>
              <td id="fila_52" width="200" class="punteado"> <span lang="es-gt">
                <span class="Estilo6"><strong><strong>
                <input name="txtInsti3" type="text" id="txtInsti4" size="45" value="<? print $insti;?>">
                </strong></strong></span></span></td>
            </tr>
          </table>
      <span lang="es-gt"><span lang="es-gt"></span></span></div></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
      <td>CC2</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>CC3</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>CC4</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="left" class="Estilo4 Estilo5"></div></td>
      <td width="2%"><span lang="es-gt"> <span lang="es-gt"> <span lang="es-gt"><span lang="es-gt"> </span></span> </span> </span></td>
    </tr>
  </table>
  <table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td colspan="3"><div align="center" class="Estilo11">Nota de Tr&aacute;mite </div></td>
    </tr>
    <tr>
      <td><input name="radiobutton" type="radio" value="1" checked>
      Para su conocimiento </td>
      <td><input name="radiobutton" type="radio" value="5">
      Preparar respuesta /Hacer nota </td>
      <td><input name="radiobutton" type="radio" value="9">
      Desig: Funcionario /s </td>
    </tr>
    <tr>
      <td><input name="radiobutton" type="radio" value="2">
      Emitir dict&aacute;men /opini&oacute;n </td>
      <td><input name="radiobutton" type="radio" value="6">
      Realizar consulta </td>
      <td><input name="radiobutton" type="radio" value="10">
      Asistir / Participar </td>
    </tr>
    <tr>
      <td><input name="radiobutton" type="radio" value="3">
      Rendir informe / Resultados </td>
      <td><input name="radiobutton" type="radio" value="7">
      Convocar / Dar cita </td>
      <td><input name="radiobutton" type="radio" value="11">
      Organizar Evento </td>
    </tr>
    <tr>
      <td><input name="radiobutton" type="radio" value="4">
      Preparar s&iacute;ntesis / Res&uacute;men </td>
      <td><input name="radiobutton" type="radio" value="8">
      Atender audiencia / Solicitante </td>
      <td><input name="radiobutton" type="radio" value="12">
      Investigar</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="radiobutton" type="radio" value="13">
      Distribuir</td>
    </tr>
  </table>
<table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr bordercolor="#000000">
        <td colspan="3"></td>
      </tr>
      <tr bordercolor="#000000">
        <td width="43%" height="202" valign="top"><p><font face="Arial, Helvetica, sans-serif"><span class="Estilo10">La Correspondencia debe ser finalizada para </span></font></p>
          <p><font face="Arial, Helvetica, sans-serif"><span class="Estilo10">el d�a y hora: </span></font><input type="text" name="date9" id="sel9" size="30">
            <input type="reset" value=" ... " id='button9' onclick="setActiveStyleSheet(this, 'win2k-1');">
            <script type="text/javascript">
	<!--  to hide script contents from old browsers

	function timeOutOfRange(date, year, month, day, hours, minutes) {
		if (date.getDay() == 0) { //No Sunday
			return true;
		}
		if (typeof(hours) != "undefined") {
			if (date.getDay() == 6) {
				//only allow 11AM to 5PM on Saturday
				if ((hours < 17 || hours==17 && minutes==0) && hours >= 11) {
					return false;
				} else {
					return true;
				}
			}

			//on saturdays allow
			if (date.getDay() == 5) {
				//only allow 8AM to 9:45PM on Friday
				if (hours > 21 || hours < 8) {
					return true; //not within the hours
				}

				if (hours != 21) {
					return false; //within the hours
				}

				//hours = 21
				if (minutes <= 45) {
					return false;
				} else {
					return true;
				}
			}

		}
		return false;
	}
// end hiding contents from old browsers  -->
              </script>

            <script type="text/javascript">
		var cal = new Zapatec.Calendar.setup({

		inputField     :    "sel9",     // id of the input field
        weekNumbers       : false,
		singleClick    :     false,     // require two clicks to submit
		ifFormat       :    "%d/%m/%Y [%H:%M]",     // format of the input field
		showsTime      :     true,     // show time as well as date
		button         :    "button9",  // trigger button
		dateStatusFunc :    timeOutOfRange

		});

	          </script>
          </p>
        <div class='zpCalDemoText'></div>

		  <div class="footer" style='width: 0px; text-align:center; margin-top:2em'>
		  <strong>
		    <a href='http://www.zapatec.com/'></a>
		  </strong>
        </div>	    </td>
        <td width="57%" colspan="2" valign="top">Asunto / Observaciones:<font face="Arial, Helvetica, sans-serif">
          <textarea name="textarea" cols="90" rows="5" id="textarea11"></textarea>
</font></td>
      </tr>
  </table>
  <tr>
        <td></td>
        <td colspan="4"></td>
  </tr>

      <tr>
        <td width="22%"><table width="96%"  border="0">
          <table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">  <tr bordercolor="#000000">
            <td width="13%"><div align="center">Secretar&iacute;a: </div></td>
            <td width="25%">Llamar
                <input name="radiobutton1" type="radio" value="14"></td>
            <td width="13%">Archivar
                <input name="radiobutton1" type="radio" value="15"></td>
            <td width="49%">Agendar
                <input name="radiobutton1" type="radio" value="16"></td>
          </tr>
        </table>
        <td colspan="4">		<noscript>
		<p>&nbsp;</p>
        </noscript></td>
      </tr>
      <table width="473" height="31" border="1" align="center">
    <tr>
      <th scope="col"><input type="submit" name="Submit2" value="Enviar"></th>
    </tr>
  </table>
  <p align="center">&nbsp;  </p>
</form>
<p>&nbsp;</p>




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
    element.innerHTML = '<img src="Imagenes/loading.gif" />'; 
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


</body>
</html>
