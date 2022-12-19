<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "correBeta1V2/envioMuchos/";
	$_SESSION['pagina'] = $page;

//	include('../../security.php');
	print $_SESSION['iso_registro'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
body {
	background-image: url(../transfiere/Fondo%20de%20Fiesta.jpg);
}
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo7 {
	color: #339933;
	font-weight: bold;
	font-size:18px;

}
-->
</style>
<script language="javascript">

function enviarAll(form)
{
 form.action = "sendAll.php";
 return true;
}
</script>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo8 {font-size: 14px}
-->
</style>

<div style="display:none">
<script type="text/javascript" src="../../resources/js/Fecha.js" ></script>
<script type="text/javascript" src="../../resources/js/Calendario.js" ></script>
<link rel="STYLESHEET" type="text/css" href="../../resources/css/calendario.css"></link>
</div>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="description" content=" Click the '...' button to display the calendar. Notice that you can set the time at the bottom of the calendar. You cannot select Sundays. Select any Friday of the month. On Fridays you cannot set times earlier than 08:00 and later than 21:45. On Saturdays you can set only times between 11:00 and 17:00. Select any day of the month except Friday, Saturday or Sunday. You can set any time you want. Set the time to 23:00, and change the day to a Saturday. Notice that the time automatically scrolls past 11:00, since that is the earliest valid time for that day. ">
	<meta name="keywords" content="dhtml tools,javascript,DHTML Tools,Javascript,ajax,AJAX,Ajax,ajax tools,AJAX Tools,tools controls,simple javascript tools">
	<!--title>Zapatec DHTML Calendar Widget - Limit Time and Day Selection</title>

	<script type='text/javascript' src='../utils/zapatec.js'></script>
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
	<!--link href="../themes/system.css" rel="stylesheet" type="text/css">
	<link rel="SHORTCUT ICON" href="http://www.zapatec.com/website/main/favicon.ico"-->
</head>

<body>
   <?php
						//require ('../conexion.inc');
						//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
						//mysql_select_db($BASE_DATOS,$db);

			include('../../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 
			include('../../conectarse.php');						

//						$SQL = "select docu,titulo from doc where docu=$docu";
						$SQL = "select idcorrespondencia, titulo from correspondencia where idcorrespondencia=$docu";
						$result = mssql_query($SQL);
						$docu2 = mssql_fetch_row($result);
						//mysql_close($db);
/*		print $docu[0];
		print $SQL;*/
							?>
						

<table width="100%"  border="1">
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo8">Envio de Correspondencia a Varias personas </span></td>
  </tr>
  <tr>
    <td width="22%"><p align="center">Codigo Documento: <span class="Estilo7"><? print $docu2[0];?></span></p>    </td>
    <td width="78%"><div align="center">Titulo: <span class="Estilo7"><? print $docu2[1];?></span></div></td>
  </tr>
  <tr>
    <td colspan="2"><p style="margin-top: 0; margin-bottom: 0"> </p>
      <form action="inAccesoT.php" method="get" name="form1" class="Estilo5">
        <TABLE width="50%"
                        border=0 align=center cellPadding=0 cellSpacing=10 id="table18">
          <TBODY>
            <TR>
              <TD width="77"><div align="left">Empleados</div></TD>
              <TD width="283"><div align="left">
                <p>Seleccione Empleados </p>
                <p align="center"><span lang="es-gt"><span lang="es-gt">
                  <select name="cboEmpleado[]" size="7" multiple id="cboEmpleado[]">
                      <?php

						//require ('../conexion.inc');
						//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
						//mysql_select_db($BASE_DATOS,$db);

						include('../INCLUDES/inc_header.inc');
						$dbms=new DBMS($conexion); 
						include('conectarse.php');

						 $SQL = "select idasesor, nombre+' '+apellido from asesor where habilitado='Y' order by nombre";
								$result = mssql_query($SQL);
									while ($row = mssql_fetch_row($result))
									{
										echo "<option value=$row[0]>$row[1]</option>";
									}

								//mysql_close($db);
							?>
                    </select>
                                </span></span></p>
              </div></TD>
            </TR>
            <tr>
              <TD>Descripcion</TD>
              <TD><textarea name="txtDesc" cols="50" rows="5" id="txtDesc"></textarea>
              <input name="docu" type="hidden" id="docu2" value="<? print $docu;?>"></TD>
            </tr>
            <TR>
              <TD width="77"></TD>
              <TD width="283"></TD>
            </TR>
          </TBODY>
        </TABLE>
        <table width="100%"  border="0">
          <tr>
                    <th width="96%" scope="col"><span class="Estilo12">
					La Correspondencia debe ser finalizada para el d&iacute;a y hora:</span>       
				<SPAN style='display:inline;width:100;'>                  
					 <input type="text" name="date9" id="sel9" size="30" value="<? print $fechahora;?>" onfocus='idfecha1Calendar.showCalendar();'>
<div id="idfecha1CalendarContiner" style='display:none;' class='calendario' ></div></SPAN>
<script> 
idfecha1Calendar = createCalendario( "date9", "idfecha1CalendarContiner", "resources/img/", "dd-mm-yyyy", "english" );
</script>

                     <!--input name="reset" type="reset" id='button9' onclick="setActiveStyleSheet(this, 'win2k-1');" value=" ... ">
					 

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
              <!--/script>

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
		  <div class="footer" style= width: 0px; text-align:center; margin-top:2em; font-size: 5px; >
        </div>	    
		<strong>
		    <a href='http://www.zapatec.com/'></a>
		  </strong>
          </p>          </tr-->
          <tr>
            <td><div align="center">
              <input name="btnInsertar" type="submit" id="btnInsertar" value="Insertar">
              <input name="Enviar" type="submit" id="Enviar2" value="Enviar Correspondencia" onClick="enviarAll(this.form)">
              <input name="btnLimpiar" type="reset" id="btnLimpiar" value="Limpiar">
            </div></td>
          </tr>
        </table>
        <p align="center">&nbsp;        </p>
        <hr size="1">
      </form>
      <table width="100%" border="1" cellpadding="0" cellspacing="0">
        <tr bgcolor="#0066FF">
          <td width="171" class="Estilo5"><span class="Estilo1">Codigo Empleado </span></td>
          <td width="670" class="Estilo5"><span class="Estilo1">Nombre del empleado </span></td>
		  <td width="117" class="Estilo5"><span class="Estilo1">Accion</span></td>
        </tr>
        <?php

				   $SQL = "select e.idasesor, e.nombre+' '+e.apellido, d.iddocemple from asesor e, docemple d where e.idasesor = d.idasesor and d.doc = $docu";
							//print $SQL;
								$result = mssql_query($SQL);
									while ($row = mssql_fetch_row($result))
									{
										  echo " <tr>";
										  echo " <td>$row[0]</td>";
										  echo " <td>$row[1]</td>";
										//  echo " <td>$row[2]</td>";
										  echo " <td><span class='Estilo3'><a href='eliminaD.php?ide=$row[2]&docu=$docu'>Eliminar </a></span></td>";
										echo " </tr>";
									}
//								mysql_close($db);
?>
      </table>
    <p class="Estilo5">&nbsp;</p></td>
  </tr>
</table>
<p style="margin-top: 0; margin-bottom: 0"><BR clear=all>
</p>

<SCRIPT>
idfechaIniCalendar.setUpperLimit( idfechaFinCalendar );
idfechaFinCalendar.setLowerLimit( idfechaIniCalendar );
</SCRIPT>

</body>
</html>
