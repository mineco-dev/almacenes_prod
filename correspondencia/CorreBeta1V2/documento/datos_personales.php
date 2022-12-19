<?
session_start();
include('../../conectarse.php');
$_SESSION['nivel']=2;

if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}

	if ( $sstipo != 1) // valida que sea un usuario administrador
	{
	 cambiar_ventana('../../mtlogin.php');
	}

	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 

	

?>
<script language="JavaScript">
	function Verifica()
	 {
		textoCampo = window.document.form1.cedula.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.cedula.value = textoCampo 

		textoCampo = window.document.form1.empadronamiento.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.empadronamiento.value = textoCampo 


		textoCampo = window.document.form1.dia3.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.dia3.value = textoCampo 
		
		textoCampo = window.document.form1.mes3.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.mes3.value = textoCampo 

		textoCampo = window.document.form1.ano3.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.ano3.value = textoCampo 


		textoCampo = window.document.form1.hijos.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.hijos.value = textoCampo 

//		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.idregistro.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.usuario.value = "" || form1.password.value == "" || form1.iddepartamento2 == value ""  )
		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.dia3.value == "" || form1.mes3.value == ""  || form1.ano3.value == "")
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}

		if (form1.usuario_s.value == "" || form1.sexo.value == "")
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}

		//if (form1.password.value == "")
			//{
				//alert('Por favor llene los campos requeridos **');
				//return false
			//}

		if (form1.tema2.value == "")
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}
//	|| form1.idmunicipio.value == ""
	//	|| form1.idmunicipio_reside == value ""
		}
 

function validarEntero(numero){ 
      //Compruebo si es un valor num�rico 
      if (isNaN(numero)) { 
            //entonces (no es numero) devuelvo el valor cadena vacia 
            alert("Solo puede ingresar numeros en el campo");
			return ""
//   		    document.numeros.numero.focus();
      }else{ 
            //En caso contrario (Si era un número) devuelvo el valor 
            return numero
           // document.numeros.numero.focus();
      } 
}
</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css">


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
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo6 {color: #FF0000}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: larger}
.Estilo22 {font-size: 11px}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo46 {color: #666666; font-weight: bold;}
.Estilo47 {color: #000000}
.Estilo61 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
}
.Estilo64 {
	color: #000000;
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
}
/*body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}*/
.Estilo28 {font-size: 12px}
.Estilo67 {font-size: 9px}
.Estilo69 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
a:link {
	color: #999999;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
-->
</style>


</head>

<body>
<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="../../visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Regresar al Menu ]</a>
		</td>
		<!--td align="right" >
		<!--a href="../../mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0">[ Cerrar Sesión ]</a-->
		<!--/td-->

	</tr>
</table>
<table>
	<tr>
		<td class="Estilo13" align="center" bgcolor="#C0E2FE">
			
			<a href="busqueda_asesor1.php">Actualizar Datos de Usuario</a><br>
			
		</td>
	</tr>

</table>

<form name="form1" method="post" action="asesoringreso.php" onSubmit="return Verifica()" enctype="multipart/form-data">
<!--form name="form1" method="post" action="asesoringreso.php"-->
  <table width="91%"  border="0" align="center">

    <tr>
      <!--th width="83%" scope="col">&nbsp;</th-->
      <th width="17%" scope="col"><table width="100%"  border="0">
        <tr>
          <th scope="col"><span class="Estilo28"><? print $letra;?></span></th>
        </tr>
      </table>      </th>
    </tr>
    <tr>
      <th colspan="2" scope="col"><span class="Estilo3"><span class="Estilo1 Estilo8">
        <input type="hidden" name="empresa_registro" value="<? print $empresa_registro;?>">
        <input type="hidden" name="registro2" value="<? print $registro;?>">
      </span>Ministerio de Econom�a de Guatemala </span></th>
    </tr>
    <!--tr>
      <th colspan="2" class="Estilo13" scope="row"><span class="Estilo46">Ministerio de Econom&iacute;a de Guatemala</span></th>
    </tr-->
    <tr>
      <th class="Estilo13" scope="row">
	  <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
	  <input type="hidden" name="MAX_FILE_SIZE2" value="100000000">
	  </th>
      <!--td class="Estilo13">&nbsp;</td-->
    </tr>
    <!--tr>
      <td class="Estilo13" colspan="2"><div align="center"><span class="Estilo61">Curriculum</span></div></td>
    </tr-->
  </table>

  <p class="Estilo8 Estilo7"></p>
  <table width="800" border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2">Datos Personales </span></div></td>
    </tr>
  <tr>
    <td><span class="Estilo67"><font color="#6699FF" face="Arial, Helvetica, sans-serif">Fecha</font></span></td>
    <td> <span class="Estilo67">
	<font face="Arial, Helvetica, sans-serif">
	<? echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> 
	<? echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?>	</font></span></td>
    </tr>&nbsp;</td>
    <!--td colspan="2">&nbsp;</td>
    <td colspan="-1">&nbsp;</td-->
  </tr>
  <tr>
    <td width="111">&nbsp;</td>
    <td width="233">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="299" colspan="-1">&nbsp;</td>
  </tr>
  <tr class="Estilo1">
    <td class="Estilo22">Primer Nombre<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7" width="20"><input name="nombre" type="text" class="Estilo7" id="nombre" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Segundo Nombre </div></td>
    <td colspan="-1"><input name="nombre2" type="text" class="Estilo7" id="nombre2" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();">
      <span class="Estilo6">      </span></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Tercer  Nombre</span></td>
    <td class="Estilo7"><input name="nombre3" type="text" class="Estilo7" id="nombre3" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>

    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Primer Apellido<font color="#FF0000"><strong>**</strong></font></div></td>
    <td colspan="-1"><input name="apellido" type="text" class="Estilo7" id="apellido" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Segundo Apellido</span></td>
    <td class="Estilo7"><input name="apellido2" type="text" class="Estilo7" id="apellido2" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
    <td colspan="2" class="Estilo7"><div align="right"><span class="Estilo22">Apellido de Casada</span></div></td>
    <td colspan="5" class="Estilo7"><input name="apellidocasada" type="text" class="Estilo7" id="apellidocasada" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Estado Civil</span></td>
    <td class="Estilo7"><span class="Estilo22">

<select name="estadocivil" id="estadocivil" class="Estilo7">
                  <option value="S">SOLTERO </option>
                  <option value="C">CASADO </option>
                  <option value="V">VIUDO </option>
                  <option value="D">DIVORCIADO </option>
                  <option value="U">UNIDO </option>
        </select>


    </span></td>

    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Fecha nacimiento<font color="#FF0000"><strong>**</strong></font></div></td>
    <td colspan="5" class="Estilo7"><span class="Estilo22">d&iacute;a
        <!--input name="dia3" type="text" class="Estilo1" id="dia3" maxlength="2"  size="2"-->
		<select name="dia3" class="Estilo1">
			<option></option>		
	<?
	$i=1;
		
	 while ($i<=31)
	  {
	  ?>
		<option value="<? echo $i; ?>"><? echo $i; ?></option>
	 <?  $i++;
	 }
	 
	?>
</select>
mes
<!--input name="mes3" type="text" class="Estilo1" id="mes3" size="2" maxlength="2"-->
<select name="mes3" class="Estilo1">
	<option></option>		
	<?
	$i=1;
	 while ($i<=12)
	  {
	  ?>
		<option value="<? echo $i; ?>"><? echo $i; ?></option>
	 <?  $i++;
	 }
	 
	?>
</select>
a&ntilde;o
<!--input name="ano3" type="text" class="Estilo1" id="ano3" size="4" maxlength="4"--> 
<select name="ano3" class="Estilo1">
			<option></option>		
	<?
	$i=1920;
	 while ($i<=date('Y')-18)
	  {
	  ?>
		<option value="<? echo $i; ?>"><? echo $i; ?></option>
	 <?  $i++;
	 }
	 
	?>
</select> 
<!--input name="edad" type="text" id="nacimiento" size="5"--> </span></td> 
</tr>
<tr class="Estilo1">
<td><span class="Estilo22">Sexo:<font color="#FF0000"><strong>**</strong></font></span> </td>
<td><span class="Estilo22">
M<input name="sexo" type="radio" value="M"> 
F<input name="sexo" type="radio" value="F">
</span></td>

<td colspan="2" class="Estilo7" align="right">Hijos</td>
<td class="Estilo7"><input type="text" name="hijos" size="2" maxlength="2" value="0"></td>
  </tr>
 
<tr class="Estilo1">
<td class="Estilo22">

Adjunte Fotografia
</td>
<td>
<span class="Estilo22"><input name="userfilefoto" type="file">
    </span>
</td>
</tr>

<tr class="Estilo1">
    <td class="Estilo22">NIT</td>
    <td class="Estilo7">
      <input name="nit" type="text" class="Estilo7" id="nit" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Igss</div></td>
    <td colspan="-1"><input name="igss" type="text" class="Estilo1" id="igss" size="30">
      <span class="Estilo6">      </span></td>
  </tr>



<tr class="Estilo1">
    <td class="Estilo22">Empadronamiento</td>
    <td class="Estilo7">
      <input name="empadronamiento" type="text" class="Estilo7" id="empadronamiento" size="30"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Grupo Sanguineo </div></td>
    <td colspan="-1">

<select name="gruposanguineo" id="gruposanguineo">
                  <option value="AB+">AB+ </option>
                  <option value="AB-">AB-</option>
                  <option value="A+">A+ </option>
                  <option value="A-">A- </option>
                  <option value="B+">B+ </option>
                  <option value="B-">B- </option>
                  <option value="O+" selected>O+ </option>
                  <option value="O-">O- </option>
        </select>
				
<!--input name="gruposanguineo" type="text" class="Estilo1" id="gruposanguineo" size="30"-->
      <span class="Estilo6">      </span></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">C&eacute;dula de Vecindad</span></td></tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Registro<font color="#FF0000"><strong>**</strong></font></span></td>
     <td class="Estilo7"><span class="Estilo22">

<select name="idregistro" id="idregistro" class="Estilo7" size="1">
  <?
	$dbms->sql="select idregistro,registro from asesor_registro"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idregistro"]."\">".$Fields["registro"]."</option>"; 
	}
?>
</select>
N&uacute;mero<font color="#FF0000"><strong>**</strong></font>
<input name="cedula" type="text" class="Estilo7" id="cedula" size="6"></span></td>
     <td colspan="2" class="Estilo7"><!--div align="right" class="Estilo22">
adjunte copia de C&eacute;dula</div-->
</span></td><!--td c><span class="Estilo22"><input name="userfile" type="file" id="userfile" size="30">
    </span></td-->
    <td width="5" colspan="-1"><span class="Estilo22"></span></td>
  </tr>

<tr class="Estilo1">
    <td class="Estilo22">Departamento<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7">
	<div align="left">
		  

		<select name="iddepartamento" class="TituloMedios" id="iddepartamento"  onChange="javascript:cargarCombo('../../subactividades.php', 'iddepartamento', 'Div_Subactividades')">
          <option value=''> Seleccione </option>
          <? 
				$dbms->sql="select iddepartamento,nombre_departamento from asesor_departamento"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddepartamento"]."\">".$Fields["nombre_departamento"]."</option>"; 
				}
			?>
        </select>

		</span></span> </div>
	
	</td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Municipio<font color="#FF0000"><strong>**</strong></font></div></td>
    <td colspan="-1">      
	<span class="Estilo6">      
		<div align="left">
		  <div id="Div_Subactividades"> 
				<label for="SubActividad"></label> 
                <select name="idmunicipio"  id="idmunicipio" class="TituloMedios">
            </select>
</div>
        </div>
	</span>
	</td>
  </tr>

<tr class="Estilo1">
    <td class="Estilo22">Numero de Licencia </td>
    <td class="Estilo7">
      <input name="licencia" type="text" class="Estilo7" id="licencia" size="30"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Tipo licencia </div></td>
    <td colspan="-1">
<select name="tipolicencia" id="tipolicencia">
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="M">M</option>
                  <option value="T">T</option>
                  
        </select>

<!--input name="tipolicencia" type="text" class="Estilo1" id="tipolicencia" size="30"-->

      <span class="Estilo22">    Grupo Etnico</span>
      <select name="idgrupoetnico" id="idgrupoetnico" class="Estilo7" size="1">
        <?
	$dbms->sql="select idgrupoetnico,grupoetnico from asesor_grupoetnico order by 2"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idgrupoetnico"]."\">".$Fields["grupoetnico"]."</option>"; 
	}
?>
      </select>      <span class="Estilo6">      </span></td>
  </tr>
<tr class="Estilo1">
    <td class="Estilo22">Usuario<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7"><input name="usuario_s" type="text" class="Estilo7" id="usuario_s" size="30" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
    <!--td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Password<font color="#FF0000"><strong>**</strong></font></div></td-->
    <td colspan="-1"><!--input name="password" type="password" class="Estilo1" id="password" size="30"--></td>
  </tr>
</table>

  <p>&nbsp;</p>
  <table width="830" border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">

  </tr>
</table>
<table width="800"  border="0" align="center" class="Estilo7">
  <tr>
    <td colspan="4"><div align="left"><span class="Estilo47"><span class="Estilo7"><span class="Estilo31">Datos de residencia</span></span></span></div>      </td>
    </tr>
  <tr>
    <td width="10%"><span class="Estilo22">Calle y avenida </span></td>
    <td width="24%"><span class="Estilo47"><span class="Estilo7">
      <input name="calle" type="text" class="Estilo7" id="calle" size="15" onKeyUp="javascript:this.value=this.value.toUpperCase();">
    </span></span></td>


	<td  width="10%" align="right"><span class="Estilo22">Numero</span> </td>
	<td width="16%">
		<span class="Estilo7">
		  <input name="numero" type="text" class="Estilo7" id="numero" size="5" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		</span>
	</td>
<tr>
    <td width="14%" class="Estilo7">
		<div align="right" class="Estilo22">
        	<div align="right" class="Estilo22">
          		<div align="left">
					Zona      
				</div>
        	</div>
	    </div>
 	</td>
	<td class="Estilo7">
	          	<div align="left">
					<input name="zona" type="text" class="Estilo7" id="zona" size="5" onKeyUp="javascript:this.value=this.value.toUpperCase();">
				</div>

    </td>

  <td width="8%" align="right" class="Estilo7"><span class="Estilo22">Colonia / Edificio</span></span></td>
    <td width="18%">
		<div align="left" class="Estilo22">
	      <input name="colonia" type="text" class="Estilo7" id="colonia2" size="15" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		</div>
	</td>
</tr>
    <td><span class="Estilo47"><span class="Estilo7"><span class="Estilo22">Departamento<font color="#FF0000"><strong>**</strong></font></span></span></span></td>
    <td><span class="Estilo47"><span class="Estilo7">
	<div align="left">
		    <select name="tema2" class="TituloMedios" id="iddepartamento2"  onChange="javascript:cargarCombo('../../subactividades2.php', 'tema2', 'Div_Subactividades2')">
            <option value=''> Seleccione </option>
            <? 
				$dbms->sql="select iddepartamento,nombre_departamento from asesor_departamento"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddepartamento"]."\">".$Fields["nombre_departamento"]."</option>"; 
				}
			?>
			</select>
	    </div>
</span></span></td>
    <td width="10%" align="right"><span class="Estilo22">Municipio<font color="#FF0000"><strong>**</strong></font></span></td>
    <td width="16%"><span class="Estilo7">
	<div align="left">
		  <div id="Div_Subactividades2"> 
				<label for="SubActividad2"></label> 
                <select name="idgrupo2"  id="select" class="TituloMedios">
                </select>
</div>
        </div>
    </span></td>
</tr><tr>
    <td><div align="left" class="Estilo22">Nacionalidad</div></td>
    <td colspan="2"><span class="Estilo7">
      <input type="text" name="nacionalidad" id="nacionalidad" onKeyUp="javascript:this.value=this.value.toUpperCase();">
    </span></td>
    </tr>
  <tr>
    <td height="25"><span class="Estilo47"><span class="Estilo7"><span class="Estilo22">Tel&eacute;fono de casa </span></span></span></td>
    <td><span class="Estilo47"><span class="Estilo7">
      <input name="telefono" type="text" class="Estilo7" id="telefono" maxlength="8" size="24" onKeyUp="javascript:this.value=this.value.toUpperCase();">
    </span></span></td>



    <td  width="10%" align="right"><span class="Estilo22">celular</span> </td>
<td width="16%"><span class="Estilo7">

<input name="celular" type="text" class="Estilo7" id="celular" maxlength="8" size="20" onKeyUp="javascript:this.value=this.value.toUpperCase();">
</span></td>
   
    </tr>
  <tr>
    <td class="Estilo22">Direccion para Notificaciones </td>
    <td><span class="Estilo47">
      <input name="direccion_para_notificaciones" type="text" id="direccion_para_notificaciones" size="24" onKeyUp="javascript:this.value=this.value.toUpperCase();">
    </span>
</td>  

 <td align="right"><div align="right"><span class="Estilo47"><span class="Estilo22">Correo electr&oacute;nico personal </span></span></div></td>
    <td ><span class="Estilo7"><span class="Estilo47">
      <input name="correo" type="text" class="Estilo7" id="correo" size="50" maxlength="75" onKeyUp="javascript:this.value=this.value.toLowerCase();">
    </span>
    </span></td>


</tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6">
</select>
&nbsp;</td>
</tr>

<tr>
<td>&nbsp;</td>
    <td colspan="6">
</select>
&nbsp;</td>


  </tr>
  <tr>
    <td colspan="7"><span class="Estilo69">Datos del Ministerio de Econom&iacute;a </span></td>
    </tr>
  <tr>

<td>
<div align="left"><span class="Estilo47"><span class="Estilo22">Cargo Nominal</span></span></div>
</font>
</td>

<td>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
							  <select name="id_puesto">
                                <?  
								  $sqlsel = "select id_puesto, puesto from puesto";
								$result = @mssql_query($sqlsel);
								while ($row = mssql_fetch_array($result))
								 { 
								 $id_puesto = $row['id_puesto'];
								 $puesto= $row['puesto'];
								 ?>
                                <option value= "<? echo $id_puesto; ?>"><? echo $puesto; ?> </option>
                                <? }	?>
                              </select></font>
</td>
</tr>
<tr>
<td><div align="left"><span class="Estilo47"><span class="Estilo22">Cargo Funcional </span></span></div>
  </font></td>
							<td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
							  <select name="id_puesto1">
                                <?  
								  $sqlsel = "select id_puesto, puesto from puesto";
								$result = @mssql_query($sqlsel);
								while ($row = mssql_fetch_array($result))
								 { 
								 $id_puesto = $row['id_puesto'];
								 $puesto= $row['puesto'];
								 ?>
                                <option value= "<? echo $id_puesto; ?>"><? echo $puesto; ?> </option>
                                <? }	?>
                              </select></font></td>

<td align="right">
 </span></span><span class="Estilo22">Descripcion del Puesto</span></td>
<td>
<span class="Estilo47">
<span class="Estilo1"> <span class="Estilo7"><span class="Estilo22">
 <input name="userfile2" type="file" id="userfile2" size="30">
 </span></span></span></span></td>

  </tr>
  <tr>
    <td><span class="Estilo22">Renglon</span></td>
    <td colspan="1" >	<span class="Estilo22"> 011</span><span class="Estilo1">        
      <input name="reglon" type="radio" value="11" checked>
        </span><span class="Estilo22">022</span><span class="Estilo1">        
        <input name="reglon" type="radio" value="22">
        </span><span class="Estilo22">
        029</span><span class="Estilo1">
         <input name="reglon" type="radio" value="29">
</span></td>
<td align="right"><span class="Estilo22">Fecha Ingreso</span></td>

<td>
<input type="text" name="date9" id="sel9" size="20"
><input type="reset" value=" ... " 
onclick="return showCalendar('sel9', '%d-%m-%Y  %H:%M', '24', true);">

</td>

  </tr>
  <tr>
    <td><span class="Estilo22">Partida Presupuestaria No. </span></td>
    <td><span class="Estilo47"><span class="Estilo1"> <input name="partida" type="text" class="Estilo7" id="partida" onKeyUp="javascript:this.value=this.value.toUpperCase();">
    </span></span></td>
    <td align="right"><span class="Estilo22">Dependencia</span></td>
	<td>
      <select name="iddireccion" id="iddireccion" class="Estilo7" >
<?
	$dbms->sql="select iddireccion,nombre from direccion"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["nombre"]."</option>"; 
	}
?>
        </select> 
</td>
</tr>
<tr>
<td><span class="Estilo22">Extension</span></td>
<td>

	  <input name="extension" type="text" id="extension" size="10" onKeyUp="javascript:this.value=this.value.toUpperCase();">
</td>
<td align="right"><span class="Estilo22">Gafete</span></td>



<td>
<input name="gafete" type="text" id="gafete" size="10" onKeyUp="javascript:this.value=this.value.toUpperCase();">
</td>

  </tr>
<tr class="Estilo22">
<td align="left"><span class="Estilo22">Sueldo Q. </span></td>
<td>
<input name="sueldo" type="text" id="sueldo" size="10" onKeyUp="javascript:this.value=this.value.toUpperCase();">
</td>


<?
if ( $sstipo == 1)
 {
?>
	<!--tr class="Estilo22" -->
		<td class="Estilo22" align="right">Tipo de usuario</td>
		<td class="Estilo22">
		<select name="tipo_usuario" >
		<?  
								  $sqlsel = "select idtipousuario, tipo from tipo_usuario";
								$result = @mssql_query($sqlsel);
								while ($row = mssql_fetch_array($result))
								 { 
								 $id_tipo = $row['idtipousuario'];
								 $tipo= $row['tipo'];
								 ?>
                                <option value= "<? echo $id_tipo; ?>"><? echo $tipo; ?> </option>
                                <? }	?>
		<!--option value="1">Administrador</option>
		<option value="2">Operador</option-->
		</select>
		<td>
	<!--/tr-->
<?
}
else
{
?>
<input name="tipo_usuario" type="hidden" size="1" value="2">
<?
}
?>
</tr>
</table>
<table width="77%"  border="0" align="center">
  <tr>
    <th width="43%" scope="row">&nbsp;</th>
    <td width="31%"><div align="right"><span class="Estilo1 Estilo6"><font color="#FF0000">** Campos Requeridos</font>
        <input type="submit" name="Submit" value="Siguiente">
      <!--img src="images/flecha4.JPG" width="43" height="39"--> </span></div></td>
  </tr>
</table>
<div align="center"></div><font color="#990000">
<p class="Estilo1">Favor revisar los datos antes de ser enviados. </p>
<p class="Estilo1">Toda la  informaci&oacute;n proporcionada, ser&aacute; utilizada &uacute;nica y exclusivamente para registro del Ministerio de Econom&iacute;a.</p>
<p align="center" class="Estilo1 Estilo6">&nbsp;</p></font>
</form>

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
    element.innerHTML = '<img src="../../Imagenes/loading.gif" />'; 
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
