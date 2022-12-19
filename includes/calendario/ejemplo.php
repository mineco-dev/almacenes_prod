<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<script language='javascript' src="popcalendar.js"></script>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="39%" border="0" align="center" class="panel">
  <tr>
    <td width="852">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Prueba de fechas</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="fecha" type="text" id="dateArrival" onClick="popUpCalendar(this, form1.dateArrival, 'dd-mm-yyyy');" size="10" 
    value ="<? print date("d")."-".date("m")."-".date("Y");?>"/>
	<img src="images/iconCalendar.gif" width="16" height="16" border="0" onClick="popUpCalendar(this, form1.dateArrival, 'dd-mm-yyyy');"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>