<?
session_start();

$_SESSION['nivel']=2;
include('../../valida.php');

 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	

	$_SESSION['folder'] = "correBeta1V2/transfiere/";
	$_SESSION['pagina'] = $page;

	//include('../../security.php');
//	print $_SESSION['iso_registro'];
?>
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

<div style="display:none">
<script type="text/javascript" src="../../../resources/js/Fecha.js" ></script>
<script type="text/javascript" src="../../../resources/js/Calendario.js" ></script>
<link rel="STYLESHEET" type="text/css" href="../../../resources/css/calendario.css"></link>
</div>

<!DOCTYPE html>
<?php
function generaSelect()
{
	
	//require_once('../Connections/redes.php');
	//mysql_select_db($database_redes);
		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
//		include("../../conectarse.php");	


	$sSQL="Select iddireccion,nombre From direccion order by nombre";
	$consulta=mssql_query($sSQL);
	//mysql_close($coneccion);

	// Voy imprimiendo el primer select compuesto por los registros obtenidos
	echo "<select class='combo' id='select_1' name='select_1' onChange='cargaContenido(2)'>";
	echo "<option value='0'>Elige...</option>";
	while($registro=mssql_fetch_row($consulta))
	{
		echo "<option value='$registro[0]'>$registro[1]</option>";
	}
	echo "</select>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="description" content=" Click the '...' button to display the calendar. Notice that you can set the time at the bottom of the calendar. You cannot select Sundays. Select any Friday of the month. On Fridays you cannot set times earlier than 08:00 and later than 21:45. On Saturdays you can set only times between 11:00 and 17:00. Select any day of the month except Friday, Saturday or Sunday. You can set any time you want. Set the time to 23:00, and change the day to a Saturday. Notice that the time automatically scrolls past 11:00, since that is the earliest valid time for that day. ">
	<meta name="keywords" content="dhtml tools,javascript,DHTML Tools,Javascript,ajax,AJAX,Ajax,ajax tools,AJAX Tools,tools controls,simple javascript tools">
	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

	<!--script type='text/javascript' src='../utils/zapatec.js'></script>
	<script type="text/javascript" src="../src/calendar.js"></script>
	<script type="text/javascript" src="../lang/calendar-sp.js"></script>

	<link href="../../website/css/zpcal.css" rel="stylesheet" type="text/css">
	<link href="../../website/css/template.css" rel="stylesheet" type="text/css">
	<style>
		body {
			width: 760px;
		}
	</style>

	<!-- Theme css -->
	<link href="../themes/system.css" rel="stylesheet" type="text/css">
	<link rel="SHORTCUT ICON" href="http://www.zapatec.com/website/main/favicon.ico"-->
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
</style>

<style type="text/css">
<!--
.Estilo2 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #FFFFFF;
}
.Estilo3 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 13pt;
}
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 10px; color: #FFFF00; }
.Estilo6 {color: #FFFF00}
.Estilo7 {font-weight: bold; font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;}
.Estilo8 {color: #FFFFFF}
-->
</style>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo9 {font-size: 12px}
.Estilo10 {
	font-size: 12pt;
	font-weight: bold;
}
.Estilo11 {
	color: #660000;
	font-size: 10px;
}
.Estilo12 {font-size: 10px}
.Estilo18 {font-size: 10px;font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo21 {	color: #660033; font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>

</head>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<body>
<?

		
	include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
	//include("../../conectarse.php");
		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);


//		$SQL = "select d.docu,d.titulo,concat(right(p.fecha_entrega,2),'/',month(p.fecha_entrega),'/',year(p.fecha_entrega)),v.nombre from proyecto p, vendedor v where v.vendedor=p.vendedor and proyecto=$proyecto";
//		$SQL = "select c.idcorrespondencia,c.titulo,e.nombres,c.descr,c.correlativo,fechaentrega,horaentrega from 				correspondencia c, empleados e where c.idempleado1 = e.idempleado and idcorrespondencia = $docu";

		$SQL = "select c.idcorrespondencia,c.titulo,e.nombre,c.descr,c.correlativo,fechaentrega,horaentrega from 	
				correspondencia c, asesor e where c.idasesor = e.idasesor and idcorrespondencia = $docu";


		$result = mssql_query($SQL);
		$row = mssql_fetch_row($result);
		//print "$SQL y $row";
		$nombre= $row[1];
		$fecha23= date("d-m-Y");
		$NombreCreador= $row[2];
		$descripcion = $row[3];
		$codigo = $row[4];
		$fechahora = $row[5]." [".$row[6]."]";
//		mysql_close($db);

		$fecha[] = "Enero";
		$fecha[] = "Febrero";
		$fecha[] = "Marzo";
		$fecha[] = "Abril";
		$fecha[] = "Mayo";
		$fecha[] = "Junio";
		$fecha[] = "Julio";
		$fecha[] = "Agosto";
		$fecha[] = "Septiembre";
		$fecha[] = "Octubre";
		$fecha[] = "Noviembre";
		$fecha[] = "Diciembre";
?> 
<table width="100%" class="Estilo21">
	<td align="left" bgcolor="#990000" width="15%" class="Estilo21" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
	</td>
	<td align="right">
		<p align="right"><span class="Estilo18"><a href="../center.php"><span class="Estilo21"><-- Regresar al Menu</span></a></span></p>
	</td>
</table>




<table width="84%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Codigo # : </span></div></td>
    <td width="25%" bgcolor="#0099FF"><span class="Estilo5"><? print $codigo;?></span></td>
    <td width="28%" bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Fecha de entrega : </span></div></td>
    <td width="32%" bgcolor="#0099FF"><div align="left" class="Estilo6"><span class="Estilo7"><? print $fecha23;?></span></div></td>
  </tr>
  <tr>
    <td bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Titulo:</span></div></td>
    <td bordercolor="#ECE9D8" bgcolor="#0099FF"><span class="Estilo5"><? print $nombre; ?></span></td>
    <td bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Persona que creo el documento :</span></div></td>
    <td bgcolor="#0099FF"><span class="Estilo5"><? print $NombreCreador?></span></td>
  </tr>
  <tr>
    <td width="15%" bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Descripcion:</span></div></td>
    <td colspan="3" bordercolor="#ECE9D8" bgcolor="#0099FF"><div align="right"></div>      <div align="left"><span class="Estilo5"><? print $descripcion;?></span></div></td>
  </tr>
</table>
<TABLE width="84%" height="431" border=0 align="center" cellPadding=0 cellSpacing=5 id="table15">
  <TBODY>
    <TR bgcolor="#0066CC">
      <TD height=15 bordercolor="#0066FF" bgcolor="#0099FF" style="font-size: 10pt; font-family: verdana,arial"><div align="center" class="Estilo3">Transferencia de Correspondencia </div></TD>
    </TR>
    <TR>
 
  <TBODY>
            <TR>
              <TD width="100%" align="center" background="../images/fondoTablas.gif" bgColor=#FFFFFF style="font-size: 10pt; font-family: verdana,arial">
			   <form name="form1" method="post" action="insertaDeptoProyecto.php">
                <table width="93%"  border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td width="21%" bgcolor="#0099FF"><div align="left"></div></td>
                    <td width="79%"><div align="left"><span lang="es-gt">
                    </span></div></td>
                  </tr>
                  <tr>
                    <td bgcolor="#0099FF"><div align="left"><span class="Estilo8 Estilo10">Usuario</span></div></td>
                    <td><div align="left">
                      <table border="0" width="600px" style="border-style:none;">
  <tr>
    <td width="200" bgcolor="#3399FF" class="punteado" id="fila_1">



<span class="punteado"><span lang="es-gt"><select name="iddireccion" class="TituloMedios" id="iddireccion"  onChange="javascript:cargarCombo('../../subactividades3.php', 'iddireccion', 'Div_Subactividades3')">
            <option value=0> Seleccione </option>
            <? 
				$dbms->sql="select  iddireccion, nombre FROM direccion"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["nombre"]."</option>"; 
				}
			?>
		  </select></span></span>


<? //php generaSelect(); ?></td>
	<td id="fila_2" width="200" class="punteado">
	  

<div align="left">
		  <div id="Div_Subactividades3"> 
				<label for="SubActividad3"></label> 
                 <select name="idasesor"  id="idasesor" class="TituloMedios">

            </select>

</div>
        </div>
  </tr>
</table>
                    </div></td>
                  </tr>
                  <tr>
                    <td bordercolor="#0066FF" bgcolor="#0099FF"><div align="left"><span class="Estilo8 Estilo10">Descripcion</span></div></td>
                    <td>
                      <div align="left">
                        <textarea name="txtDescripcion" cols="50" id="txtDescripcion"></textarea>
                      </div></td>
                  </tr>
                </table>
                <p>
                  <input name="docu" type="hidden" id="docu" value=" <? print $docu;?> " >
</p>
                <table width="100%"  border="0">
                  <tr>
                    <th width="96%" scope="col" height="300" valign="top"><div align="left"><span class="Estilo12">La Correspondencia debe ser finalizada para el d&iacute;a</span>                          
                        <SPAN style='display:inline;width:100;'><input type="text" name="date9" id="sel9" size="30" onfocus='idfecha1Calendar.showCalendar();' value="<? print $fechahora;?>">
							<div id="idfecha1CalendarContiner" style='display:none;' class='calendario' ></div></SPAN>
							<script> 
							idfecha1Calendar = createCalendario( "date9", "idfecha1CalendarContiner", "../../../resources/img/", "dd-mm-yyyy", "english" );
							</script>
                        <!--input name="reset" type="reset" id='button9' onclick="setActiveStyleSheet(this, 'win2k-1');" value=" ... "-->
                    </div></th>
                    <th width="4%" scope="col">&nbsp;</th>
                  </tr>
                  <tr>
                    <td><div align="right">
                      <input type="submit" name="Submit" value="Transferir">
                    </div></td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <p>&nbsp;</p>
                <tr bordercolor="#000000">
        <td width="43%" height="16" valign="top">&nbsp;</td>                
        <p>
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
        <div class='zpCalDemoText Estilo12' style='width: 0px;>
        </div>
		  <div class="footer" style="width: 0px; text-align:center; margin-top:2em; font-size: 10px;">
        </div>	    
		<strong>
		    <a href='http://www.zapatec.com/'></a>
		  </strong>
                </p>
              </form>              </TD>
    </TR>
  </TBODY>
</TABLE>
        <p align="center" style="margin-top: 0; margin-bottom: 0"><b> </b></p>


<SCRIPT>
idfechaIniCalendar.setUpperLimit( idfechaFinCalendar );
idfechaFinCalendar.setLowerLimit( idfechaIniCalendar );
</SCRIPT>

</body>
</html>
