<?
session_start();
// if (  $_SESSION['usuario_nivel']>0 )
// {
// }
// else
// {
// header("Location: error1.php");
// }
?>
<!DOCTYPE html>
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOARCHIVE"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
body {
	background-image: url();
}
.style1 {font-family: "Courier New", Courier, monospace}
a:link {
	color: #818DB1;
}
a:visited {
	color: #818DB1;
}
a:hover {
	color: #00CCFF;
}
a:active {
	color: #00CCFF;
}
.style3 {font-size: 10px}
.style5 {font-size: 10}
.style9 {font-size: 9px}
.style12 {font-family: "Courier New", Courier, monospace; font-size: 12px; font-weight: bold; }
.style14 {font-size: 11px}
.style15 {color: #FFFFFF}
.style18 {font-family: "Courier New", Courier, monospace; font-size: 11px; color: #FFFFFF; }
.style20 {font-family: "Courier New", Courier, monospace; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.style21 {font-size: 12px}
.style22 {font-family: "Courier New", Courier, monospace; font-weight: bold; }
-->
</style></head>

<body><b/>
<!-- <p align="right" style="margin-top: 0; margin-bottom: 0"><strong>[</strong><a href="inteligencia.php">regresar</a><strong>]</strong> -->
  <?


  include("conex.php"); 
  $con=Conectarse(); 




$caso = $_GET['p'];
 $carol = mysql_query("SELECT s.equipo,d.descripcion,u.nombre,s.reporte,s.diagnostico,s.solucion,c.descripcion,a.fecha_i,a.fecha_f,a.tr FROM solicitud s,usuarios u, categoria c, asignar a, deptos d WHERE s.id_deptos = d.id_deptos and s.id_usuarios = u.id_usuarios and s.id_categoria = c.id_categoria and s.caso = a.caso and s.caso  = '$caso'",$con); 
 
 if ($carol)
 {
 	$x = mysql_fetch_row($carol);
 }
 else{
 
 	echo "Error al consultar la base de datos";
 }
 


 $carlos = mysql_query("SELECT p.descripcion,su.descripcion FROM solicitud s,analisis an, subcategoria su, procesos p WHERE s.caso = an.caso and an.id_subcategoria = su.id_subcategoria and an.id_procesos = p.id_procesos and s.caso  = '$caso'",$con); 
 
 $ye = mysql_fetch_row($carlos);


?>
  <BR clear=all>
</p>
<table width="880" align="center" style="margin-bottom: 0">
  <tr>
    <td height="20" colspan="4" bgcolor="#FFFFFF"><TABLE width="99%" border=1 align="center" cellPadding=0 cellSpacing=0 bordercolor="#000000" id="table25">
      <TBODY>
        <TR>
          <TD width="18%" rowspan="2" align="center" style="font-size: 10pt; font-family: verdana,arial"><img src="http://192.168.2.244/xampp/diacoweb/SIC/informatica/IMAGES/logo1.png" alt="logocalidad1.jpg" width="135" height="100"></TD>
          <TD height="88" align=right vAlign=bottom style="font-size: 10pt; font-family: verdana,arial"><p align="center" class="style22">MINISTERIO DE ECONOMIA</p>
            <p align="center" class="style22">DIRECCION DE ATENCION Y ASISTENCIA AL CONSUMIDOR </p>
            <p align="center" class="style22">-DIACO- </p>            </TD>
          <TD width="12%" rowspan="2" align=right vAlign=bottom style="font-size: 10pt; font-family: verdana,arial"><div align="center"><img src="http://192.168.2.244/xampp/diacoweb/SIC/informatica/IMAGES/logo2.png" alt="small" width="92" height="95"></div></TD>
          <TD align=right vAlign=bottom class="style22" style="font-size: 10pt; font-family: verdana,arial"><div align="center">
            <p class="style22">Codigo </p>
            <p class="style22">IN-FO-01</p>
            <p class="style22">Version 4 </p>
            </div></TD>
        </TR>
        <TR>
          <TD width="56%" height="18" align=right vAlign=bottom style="font-size: 10pt; font-family: verdana,arial"><div align="center" class="style22">SOLICITUD DE SERVICIOS DE SOPORTE TECNICO </div></TD>
          <TD width="14%" align=right vAlign=bottom style="font-size: 10pt; font-family: verdana,arial"><p align="center" class="style22">Hoja 1 de 1 </TD>
        </TR>
      </TBODY>
    </TABLE></td>
  </tr>
  <tr>
    <td height="20" colspan="4" bgcolor="#FFFFFF"><hr></td>
  </tr>
  <tr>
    <td width="146" height="20" bgcolor="#666666"><div align="left" class="style12 style15">Caso</div></td>
    <td width="258" bgcolor="#CCCCCC"><div align="left" class="style12"><? print $caso;?></div></td>
    <td width="235" bgcolor="#666666"><div align="left" class="style20">Equipo</div></td>
    <td width="221" bgcolor="#CCCCCC"><div align="left" class="style12"><? print $x[0]; ?>&nbsp;</div></td>
  </tr>
  <tr>
    <td height="20" bgcolor="#FFFFFF"><span class="style21"></span></td>
    <td bgcolor="#FFFFFF"><span class="style21"></span></td>
    <td bgcolor="#FFFFFF"><span class="style21"></span></td>
    <td><span class="style21"></span></td>
  </tr>
  <tr>
    <td height="20" bgcolor="#666666"><div align="left" class="style20">Departamento</div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><? print $x[1];?>&nbsp;</div></td>
    <td bgcolor="#666666"><div align="left" class="style20">Usuario</div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><? print $x[2]; ?>&nbsp;</div></td>
  </tr>
  <tr>
    <td height="20" bgcolor="#FFFFFF"><span class="style21"></span></td>
    <td bgcolor="#FFFFFF"><span class="style21"></span></td>
    <td bgcolor="#FFFFFF"><span class="style21"></span></td>
    <td><span class="style21"></span></td>
  </tr>
  <tr>
    <td height="20" bgcolor="#666666"><div align="left" class="style20">Fecha de Ingreso </div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><? print $x[7];?>&nbsp;</div></td>
    <td bgcolor="#666666"><div align="left" class="style20">Fecha Salida </div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><? print $x[8];?>&nbsp;</div></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><div align="left"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"><span class="style15"><span class="style21"></span></span></span></span></span></span></span></span></span></div></td>
    <td bgcolor="#FFFFFF"><div align="left"><span class="style1"><span class="style3"><span class="style5"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"><span class="style21"></span></span></span></span></span></span></span></span></span></span></span></div></td>
    <td bgcolor="#FFFFFF"><div align="left"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"><span class="style15"><span class="style21"></span></span></span></span></span></span></span></span></span></div></td>
    <td><div align="left"><span class="style1"><span class="style3"><span class="style5"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"><span class="style21"></span></span></span></span></span></span></span></span></span></span></span></div></td>
  </tr>
  <tr>
    <td height="55" bgcolor="#666666"><div align="left" class="style20">Reporte</div></td>
    <td colspan="3" bgcolor="#CCCCCC"><div align="left" class="style12"><? print $x[3] ;?>&nbsp;</div></td>
  </tr>
  <tr>
    <td height="52" bgcolor="#666666"><div align="left" class="style20">Diagnostico</div></td>
    <td colspan="3" bgcolor="#CCCCCC"><div align="left" class="style12"><? print $x[4];?>&nbsp;</div></td>
  </tr>
  <tr>
    <td height="50" bgcolor="#666666"><div align="left" class="style20">Solucion</div></td>
    <td colspan="3" bgcolor="#CCCCCC"><div align="left" class="style12"><? print $x[5];?></div></td>
  </tr>
  <tr>
    <td height="60" colspan="4" bgcolor="#FFFFFF"><div align="left"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"><span class="style15"><span class="style21"></span></span></span></span></span></span></span></span></span>
      <hr>
    </div>      <div align="left"><span class="style1"><span class="style3"><span class="style5"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"><span class="style21"></span></span></span></span></span></span></span></span></span></span></span></div>      <div align="left"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"><span class="style21"></span></span></span></span></span></span></span></span></div>      <div align="left"><span class="style1"><span class="style3"><span class="style5"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"><span class="style21"></span></span></span></span></span></span></span></span></span></span></span></div></td>
  </tr>
  <tr>
    <td height="20" bgcolor="#666666"><div align="left" class="style20">Categoria</div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><? print $x[6]; ?>&nbsp;</div></td>
    <td bgcolor="#666666"><div align="left" class="style20">Tiempo de Respuesta </div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><? print strftime("%j",strtotime($x[8]))-strftime("%j",strtotime($x[7]))." dia(s)"; ?></div></td>
  </tr>
  <tr>
    <td height="21" bgcolor="#666666"><div align="left" class="style20">Sub Categoria </div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><? print $ye[1]; ?></div></td>
    <td bgcolor="#666666"><div align="left" class="style20">Proceso Informatico </div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><? print $ye[0]; ?></div></td>
  </tr>
  <tr>
    <td height="21" bgcolor="#666666"><div align="left" class="style20">Conformidad de Usuario</div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><input type="checkbox" name="checkbox" value="True"></div> F:_______________</td>
    <td bgcolor="#666666"><div align="left" class="style20">No Conformidad de Usuario</div></td>
    <td bgcolor="#CCCCCC"><div align="left" class="style12"><input type="checkbox" name="checkbox1" value="False"></div> F:_______________</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style21"></span></td>
    <td><span class="style21"></span></td>
    <td><span class="style21"></span></td>
    <td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><span class="style21"></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><div align="left"><span class="style1"><span class="style3"><span class="style5"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"><span class="style15"></span></span></span></span></span></span></span></span></span></span></span></div></td>
    <td><div align="left"><span class="style1"><span class="style3"><span class="style5"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"></span></span></span></span></span></span></span></span></span></span></div></td>
    <td><div align="left"><span class="style1"><span class="style3"><span class="style5"><span class="style9"><span class="style9"><span class="style3"><span class="style3"><span class="style3"><span class="style14"><span class="style14"></span></span></span></span></span></span></span></span></span></span></div></td>
    <td bordercolor="#FFFFFF" bgcolor="#666666"><div align="right" class="style18">
      <?   print date("Y-m-d h:i:s"); ?>
      &nbsp;</div></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF"><hr></td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center" style="margin-top: 0; margin-bottom: 0"></p>
</body>
</html>
