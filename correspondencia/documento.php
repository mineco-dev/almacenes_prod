<?php
session_start();

$_SESSION['nivel']=1;
include('valida.php');

	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
//	include('conectarse.php');

//$link =conectarse('RRHH');
?>



<div style="display:none">
<script type="text/javascript" src="resources/js/Fecha.js" ></script>
<script type="text/javascript" src="resources/js/Calendario.js" ></script>
<script type="text/javascript" src="resources/js/Calendario1.js" ></script>
<link rel="STYLESHEET" type="text/css" href="resources/css/calendario.css"></link>
</div>

<script language="JavaScript" src="incluciones/popcalendar.js"></script>
<script language="JavaScript">
function fechadinamica(link) {
	popcalendar.selectWeekendHoliday(1,1)
	popcalendar.show(link, null, "")
}
popcalendar = getCalendarInstance()
popcalendar.shadow = 1
popcalendar.initCalendar()
</script>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
// 	require_once('class.datepicker.php');
  /*  $db=new datepicker();
    $db->firstDayOfWeek = 1;
    $db->dateFormat = "d/m/Y";*/

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

<link rel="stylesheet" type="text/css" media="all" href="calendario/skins/aqua/theme.css" title="Aqua" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-blue.css" title="winter" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-blue2.css" title="blue" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-brown.css" title="summer" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-green.css" title="green" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-1.css" title="win2k-1" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-2.css" title="win2k-2" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-win2k-cold-2.css" title="win2k-cold-2" />
<link rel="alternate stylesheet" type="text/css" media="all" href="calendar-system.css" title="system" />

<!-- import the calendar script -->
<script type="text/javascript" src="calendar.js"></script>

<!-- import the language module -->
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>

<!-- other languages might be available in the lang directory; please check
your distribution archive. -->

<!-- helper script that uses the calendar -->
<script type="text/javascript">

var oldLink = null;
// code to change the active stylesheet
function setActiveStyleSheet(link, title) {
  var i, a, main;
  for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
      a.disabled = true;
      if(a.getAttribute("title") == title) a.disabled = false;
    }
  }
  if (oldLink) oldLink.style.fontWeight = 'normal';
  oldLink = link;
  link.style.fontWeight = 'bold';
  return false;
}

// This function gets called when the end-user clicks on some date.
function selected(cal, date) {
  cal.sel.value = date; // just update the date in the input field.
  if (cal.dateClicked && (cal.sel.id == "sel1" || cal.sel.id == "sel3"))
    // if we add this call we close the calendar on single-click.
    // just to exemplify both cases, we are using this only for the 1st
    // and the 3rd field, while 2nd and 4th will still require double-click.
    cal.callCloseHandler();
}

// And this gets called when the end-user clicks on the _selected_ date,
// or clicks on the "Close" button.  It just hides the calendar without
// destroying it.
function closeHandler(cal) {
  cal.hide();                        // hide the calendar
//  cal.destroy();
  _dynarch_popupCalendar = null;
}

// This function shows the calendar under the element having the given id.
// It takes care of catching "mousedown" signals on document and hiding the
// calendar if the click was outside.
function showCalendar(id, format, showsTime, showsOtherMonths) {
  var el = document.getElementById(id);
  if (_dynarch_popupCalendar != null) {
    // we already have some calendar created
    _dynarch_popupCalendar.hide();                 // so we hide it first.
  } else {
    // first-time call, create the calendar.
    var cal = new Calendar(1, null, selected, closeHandler);
    // uncomment the following line to hide the week numbers
    // cal.weekNumbers = false;
    if (typeof showsTime == "string") {
      cal.showsTime = true;
      cal.time24 = (showsTime == "24");
    }
    if (showsOtherMonths) {
      cal.showsOtherMonths = true;
    }
    _dynarch_popupCalendar = cal;                  // remember it in the global var
    cal.setRange(1900, 2070);        // min/max year allowed.
    cal.create();
  }
  _dynarch_popupCalendar.setDateFormat(format);    // set the specified date format
  _dynarch_popupCalendar.parseDate(el.value);      // try to parse the text in field
  _dynarch_popupCalendar.sel = el;                 // inform it what input field we use

  // the reference element that we pass to showAtElement is the button that
  // triggers the calendar.  In this example we align the calendar bottom-right
  // to the button.
  _dynarch_popupCalendar.showAtElement(el.nextSibling, "Br");        // show the calendar

  return false;
}

var MINUTE = 60 * 1000;
var HOUR = 60 * MINUTE;
var DAY = 24 * HOUR;
var WEEK = 7 * DAY;

// If this handler returns true then the "date" given as
// parameter will be disabled.  In this example we enable
// only days within a range of 10 days from the current
// date.
// You can use the functions date.getFullYear() -- returns the year
// as 4 digit number, date.getMonth() -- returns the month as 0..11,
// and date.getDate() -- returns the date of the month as 1..31, to
// make heavy calculations here.  However, beware that this function
// should be very fast, as it is called for each day in a month when
// the calendar is (re)constructed.
function isDisabled(date) {
  var today = new Date();
  return (Math.abs(date.getTime() - today.getTime()) / DAY) > 10;
}

function flatSelected(cal, date) {
  var el = document.getElementById("preview");
  el.innerHTML = date;
}

function showFlatCalendar() {
  var parent = document.getElementById("display");

  // construct a calendar giving only the "selected" handler.
  var cal = new Calendar(0, null, flatSelected);

  // hide week numbers
  cal.weekNumbers = false;

  // We want some dates to be disabled; see function isDisabled above
  cal.setDisabledHandler(isDisabled);
  cal.setDateFormat("%A, %B %e");

  // this call must be the last as it might use data initialized above; if
  // we specify a parent, as opposite to the "showCalendar" function above,
  // then we create a flat calendar -- not popup.  Hidden, though, but...
  cal.create(parent);

  // ... we can show it here.
  cal.show();
}
</script>

<style type="text/css">
.ex { font-weight: bold; background: #fed; color: #080 }
.help { color: #080; font-style: italic; }
body { background: ; font: 10pt tahoma,verdana,sans-serif; } 
table { font: 13px verdana,tahoma,sans-serif; }
a { color: #00f; }
a:visited { color: #00f; }
a:hover { color: #f00; background: #fefaf0; }
a:active { color: #08f; }
.key { border: 1px solid #000; background: #fff; color: #008;
padding: 0px 5px; cursor: default; font-size: 80%; }
</style>






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
   form.action = "uploadForm.php?";
   return true;
}

function enviar2(form)
{
//   form.action = "okTransfer.php?ccarpeta=3";
form.action = "save.php?ccarpeta=3&borrad=1";
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
// $dOF23 = $_SESSION['direcOF'];
		   $dOF23 = $_SESSION['siddireccion'];
			$sqlOF44 = "select correlativo from direccion where iddireccion = ". $dOF23;
			$resOF44 = mssql_query($sqlOF44);
			$rowOF44 = mssql_fetch_row($resOF44);
			$correlativo = $rowOF44[0];
			//print $sqlOF44;
			//print $correlativo;

			//////////////////////////////////////////////////////////////////////////////////
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
/*			envia_msg($usuario);
			envia_msg($_SESSION['usuario'].' USUARIO DE SESION');*/
			$SQL = "SELECT docu,titulo,quien,insti,descr,ref FROM tmp_documento WHERE empleado = $usuario and docu = ". $_SESSION['correlativo'] ;
//			envia_msg($SQL);
			$result = mssql_query($SQL); // elimina informacion temporal
			
			$cantidad = mssql_num_rows ($result);
			if ($cantidad==0)
			{
				$row = mssql_fetch_row($result);
				$mtdocutmp = 0;
				$titulo='';
				$quien='';
				$insti='';
				$desc='';
				$ref='';

			}
			else

			{
				$row = mssql_fetch_row($result);
				$mtdocutmp = $row[0];
				$titulo=$row[1];
				$quien=$row[2];  
				$insti=$row[3];
				$desc=$row[4];
				$ref=$row[5];  
            }
?>






<body>
<table border="0" width="100%">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right" class="Estilo18">
		<a href="CorreBeta1V2/center.php"> <-- Regresar al Menu </a>
		</td>
	</tr>
</table>

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
			<textarea name="txtDesc" cols="45" rows="7" id="txtDesc"><? if ($desc != '') { print $desc; } ?></textarea>
        </div></td>
      </tr>
      <tr >
        <td colspan="5"><div align="left">
        </div></td>
      </tr>
    </table>
      <tr>
    <table width="99%"  border="1">
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
		//	$dbms->sql= "SELECT da,nombre,descripcion,path,da FROM tmp_doc_adj where docu = $mtdocutmp";  // WHERE idempleado = $usuario";
		//	$dbms->Query(); 
			
			//while($Fields=$dbms->MoveNext()) 
if ($mtdocutmp>0)
	{	

		$sql= "SELECT da,nombre,descripcion,path,da FROM tmp_doc_adj where docu = $mtdocutmp";  // WHERE idempleado = $usuario";
			$res = mssql_query($sql); 
			while ($row1 = mssql_fetch_row($res))
			{

				 print " <tr>";
//		        print " <td>$row1[0]</td>";
//		        print " <td><a href=upload/$Fields[3] target='_blank' >$Fields[1]</a></td>";
		  print " <td><a href=upload/$row1[3] target='_blank' >$row1[1]</a></td>";

		       

		        print " <td>$row1[2]</td>";
		        print " <td><a href='eliminaDoc.php?da=$row1[4]&docu=$row1[0]&nombreDoc=$row1[1] '>Eliminar</a></td>";
		
      print " </tr>";
			}

	}
	  ?>

    </table>
    <p>&nbsp;</p>
  </div>
  <table width="96%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" align="center">
    <tr>
      <!--td><div align="center">
      </div></td>
      <td><div align="center"-->
		<input type="hidden" name="doc" value="<?= $correlativo ?>">
        <!--input name="cboAlmacenar" type="submit" id="cboAlmacenar" value="Guardar Borrador" onClick="enviar2(this.form)"-->
      <!--/div></td>
      <td><div align="center">
      </div></td-->
      <td><div align="center">
		<?
			session_register('correlativo');
			session_register('iddireccion');
			$_SESSION['correlativo']=$correlativo;
/*			envia_msg($correlativo);
			envia_msg($_SESSION['correlativo']);*/
			
		?>
        <input name="adjuntar" type="submit" id="adjuntar" value="Adjuntar Archivo" onClick="enviar(this.form)">
		<input type="hidden" name="correl23" value="<?= $correlativo ?>">
		<input type="hidden" name="idDir" value = "<?= $dOF23?>">
		
		

      </div></td>
    </tr>
  </table>
  <table width="97%"  border="0" align="center" cellpadding="0" cellspacing="5">
    <tr bgcolor="#6699FF">
      <td width="3%" rowspan="2" bgcolor="#6699FF" ><div align="left"><span class="Estilo9"><strong>Direcci&oacute;n</strong></span></div></td>
      <td colspan="2" ><div align="left">
        <p class="Estilo3 Estilo4">&nbsp;</p>
        </div>        </td>
    </tr>
    <tr bgcolor="#000000">
      <td colspan="2" bgcolor="#6699FF"><span class="Estilo3 Estilo4">A Quien va el documento </span></td>
    </tr>
    <tr>
      <td><span class="Estilo4 Estilo5">Direcci&oacute;n</span></td>
      <td ><table border="0" width="800px" style="border-style:none;">
          <tr>
            <td  width="600"  id="fila_1"><span lang="es-gt">
			<img src="lupa.jpg" width="20" height="20" border="0" onClick="window.open('consulta_personal.php','Consulta','width=750,height=400,top=175,left=200,scrollbars=yes')" alt="Busca Ubicación" title="Busca Ubicación">
			<select name="iddireccion" id="iddireccion"  onChange="javascript:cargarCombo('subactividades3.php', 'iddireccion', 'Div_Subactividades3')">
            <option value=0> Seleccione </option>
            <? 
				$dbms->sql="select  iddireccion, nombre FROM direccion"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["nombre"]."</option>"; 
				}
			?>
		  </select>

            </span></td>
            <td id="fila_2" width="400" align="left"> <span lang="es-gt">

<div align="left">
		  <div id="Div_Subactividades3" align="left"> 
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
          <table border="0" width="800px" style="border-style:none;">
            <tr>
              <td width="600"   id="fila_21"><span lang="es-gt">
              <span lang="es-gt">
	  			<img src="lupa.jpg" width="20" height="20" border="0" onClick="window.open('consulta_personal.php','Consulta','width=750,height=400,top=175,left=200,scrollbars=yes')" alt="Busca Ubicación" title="Busca Ubicación">
              <select name="iddireccion1" class="TituloMedios" id="iddireccion1"  onChange="javascript:cargarCombo('subactividades4.php', 'iddireccion1', 'Div_Subactividades4')">
                <option value=0> Seleccione </option>
                <? 
				$dbms->sql="select  iddireccion, nombre FROM direccion"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["nombre"]."</option>"; 
				}
			?>
              </select>
              </span> </span></td>
              <td id="fila_22" width="400" align="left" > <span lang="es-gt">
                <div align="left">
                  <div id="Div_Subactividades4" align="left">
                    <label for="SubActividad4"></label>
                    <select name="idasesor1"  id="idasesor1" class="TituloMedios">
                    </select>
                  </div>
                </div>
              </span></td>
            </tr>
          </table>
          <table border="0" width="800px" style="border-style:none;">
          <tr>
            <td width="600"   id="fila_31">
			<span lang="es-gt">
			<img src="lupa.jpg" width="20" height="20" border="0" onClick="window.open('consulta_personal.php','Consulta','width=750,height=400,top=175,left=200,scrollbars=yes')" alt="Busca Ubicación" title="Busca Ubicación">
			<select name="iddireccion2" class="TituloMedios" id="iddireccion2"  onChange="javascript:cargarCombo('subactividades5.php', 'iddireccion2', 'Div_Subactividades5')">
            <option value=0> Seleccione </option>
            <? 
				$dbms->sql="select  iddireccion, nombre FROM direccion"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["nombre"]."</option>"; 
				}
			?>
		  </select>
            </span></td>
            <td id="fila_32" width="400" align="left" > <span lang="es-gt">
				<div align="left">
				  <div id="Div_Subactividades5" align="left"> 
					<label for="SubActividad5"></label> 
	                 <select name="idasesor2"  id="idasesor2" class="TituloMedios">
		            </select>
				  </div>
		        </div>
            </span></td>
          </tr>
        </table>
        <table border="0" width="800px" style="border-style:none;">
          <tr>
            <td width="600" id="fila_41"><span><span lang="es-gt">

			<img src="lupa.jpg" width="20" height="20" border="0" onClick="window.open('consulta_personal.php','Consulta','width=750,height=400,top=175,left=200,scrollbars=yes')" alt="Busca Ubicación" title="Busca Ubicación">
			<select name="iddireccion3" class="TituloMedios" id="iddireccion3"  onChange="javascript:cargarCombo('subactividades6.php', 'iddireccion3', 'Div_Subactividades6')">
			  <option value=0> Seleccione </option>
			  <? 
				$dbms->sql="select  iddireccion, nombre FROM direccion"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["nombre"]."</option>"; 
				}
			?>
			</select>
</span></span></td>
            <td id="fila_42" width="400" align="left" > <span lang="es-gt">
<div align="left">
		  <div id="Div_Subactividades6" align="left"> 
				<label for="SubActividad6"></label> 
                <span lang="es-gt">
                <select name="idasesor3"  id="idasesor3" class="TituloMedios">
                </select>
                </span></div>
        </div>

            </span></td>
          </tr>
        </table>       
          <table border="0" width="800px" style="border-style:none;">
            <tr>
              <td width="600"  id="fila_51"><span lang="es-gt">
              <span lang="es-gt">
              <span class="Estilo6"><strong><strong>
              <input name="txtInsti2" type="text" id="txtInsti2" size="45" value="<? print $insti;?>">
              </strong> </strong></span>              </span> </span></td>
              <td id="fila_52" width="400" > <span lang="es-gt">
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
  <? if ( $sstipo != 3) // valida que sea un tipo de usuario no recepcionista
      { ?>
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
  <? } else { ?>
	  <input name="radiobutton" type="hidden" value="1">
 <? 
  } ?>
  
<table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr bordercolor="#000000">
        <td colspan="3"></td>
      </tr>
      <tr bordercolor="#000000">
        <td width="43%" height="202" valign="top"><p><font face="Arial, Helvetica, sans-serif"><span class="Estilo10">La Correspondencia debe ser finalizada para el d�a y hora: </span></font></p>

<SPAN style='display:inline;width:100;'>

<!--input type="text" name="date9" id="sel9" size="30"   onClick=fechadinamica(document.form1.date9); -->

<input type="text" name="date9" id="sel9" size="20"
><input type="reset" value=" ... " 
onclick="return showCalendar('sel9', '%d-%m-%Y  %H:%M', '24', true);">



<!--div id="idfecha1CalendarContiner" style='display:none;' class='calendario' ></div></SPAN>
<script> 
idfecha1Calendar = createCalendario( "date9", "idfecha1CalendarContiner", "resources/img/", "dd-mm-yyyy", "english" );
</script>


<div id="idfecha1CalendarContiner" style='display:none;' class='calendario' ></div></SPAN>
<script> 
idfecha1Calendar = escribirCalendario( "date9", "idfecha1CalendarContiner", "resources/img/", "dd-mm-yyyy", "english" );
</script-->



    
<? // prueba de calendario ?>



<? // termina prueba de calendario 
?>
</td-->



        <td width="57%" colspan="2" valign="top">Asunto / Observaciones:<font face="Arial, Helvetica, sans-serif">
          <textarea name="observacion" cols="90" rows="5" id="observacion"></textarea>
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



<!--SCRIPT>
idfechaIniCalendar.setUpperLimit( idfechaFinCalendar );
idfechaFinCalendar.setLowerLimit( idfechaIniCalendar );
</SCRIPT-->

</body>
</html>
