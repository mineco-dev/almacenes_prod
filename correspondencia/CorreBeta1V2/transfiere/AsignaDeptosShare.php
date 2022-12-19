<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "correBeta1V2/transfiere/";
	$_SESSION['pagina'] = $page;

	include('../../security.php');
	print $_SESSION['iso_registro'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
body {
	background-image: url(file://///Sinfodace/www/sinfodace/CorreBeta1/adjuntar/Fondo%20de%20Fiesta.jpg);
}
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
-->
</style>
</head>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<body>
<?
session_start();
require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
//		$SQL = "select d.docu,d.titulo,concat(right(p.fecha_entrega,2),'/',month(p.fecha_entrega),'/',year(p.fecha_entrega)),v.nombre from proyecto p, vendedor v where v.vendedor=p.vendedor and proyecto=$proyecto";
		$SQL = "select d.docu,d.titulo,e.nombres from doc d, empleados e where d.empleado = e.idempleado and docu = $docu";
		$result = mysql_query($SQL);
		$row = mysql_fetch_row($result);
		//print "$SQL y $row";
		$nombre= $row[1];
		$fecha23= date("d-m-Y");
		$NombreCreador= $row[3];
		mysql_close($db);

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
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Codigo # : </span></div></td>
    <td bgcolor="#0099FF"><span class="Estilo5"><? print $docu;?></span></td>
    <td bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Fecha de entrega : </span></div></td>
    <td bgcolor="#0099FF"><div align="left" class="Estilo6"><span class="Estilo7"><? print $fecha23;?></span></div></td>
  </tr>
  <tr>
    <td width="15%" bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Titulo:</span></div></td>
    <td width="25%" bordercolor="#ECE9D8" bgcolor="#0099FF"><span class="Estilo5"><? print $nombre; ?></span></td>
    <td width="23%" bgcolor="#0099FF"><span class="Estilo2 Estilo9">Persona que creo el documento :</span></td>
    <td width="37%" bgcolor="#0099FF"><div align="left"><span class="Estilo5"><? print $NombreCreador?></span></div></td>
  </tr>
</table>
<TABLE cellSpacing=5 cellPadding=0 width="100%" border=0 id="table15">
  <TBODY>
    <TR bgcolor="#0066CC">
      <TD height=15 bordercolor="#0066FF" bgcolor="#0099FF" style="font-size: 10pt; font-family: verdana,arial"><div align="center" class="Estilo3">Transferencia de Correspondencia </div></TD>
    </TR>
    <TR>
      <TD width="72%" style="font-size: 10pt; font-family: verdana,arial"><TABLE borderColor=#000000 cellSpacing=0 cellPadding=40 width="100%"
      border=2 id="table16">
          <TBODY>
            <TR>
              <TD width="100%" align="center" background="../images/fondoTablas.gif" bgColor=#ffffff style="font-size: 10pt; font-family: verdana,arial">                <form name="form1" miohod="post" action="insertaDeptoProyecto.php">
                <table width="100%"  border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td width="21%" bgcolor="#0099FF"><div align="left"></div></td>
                    <td width="79%"><div align="left"><span lang="es-gt">
                    </span></div></td>
                  </tr>
                  <tr>
                    <td bgcolor="#0099FF"><div align="left"><span class="Estilo8 Estilo10">Usuario</span></div></td>
                    <td><div align="left">
                      <select name="lstUsuario" id="lstUsuario">
				                              <?
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera
   el mensaje que se despliegue */

		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$SQL = "select * from empleados order by user desc";
		$result = mysql_query($SQL);
		if ($result) // verifica si la base de datos dejo hacer la insercion
		{
			/* Insercion con exito*/

			while ($row = mysql_fetch_row($result))
			{
				print "<option value='$row[0]'>$row[1]</option>";
			}

		} else {
			/* Error en la insercion*/
			print "<p class='Estilo1'>No se pudo insertar la inforci&oacute;n !!!ERROR!!</p>";
		}
		mysql_close($db);
?>
                      </select>
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
                <input name="docu" type="hidden" id="docu" value=" <? print $docu;?> " >
                <p>
                  <input type="submit" name="Submit" value="Transferir">
                </p>
              </form>                <p>&nbsp;</p>
              </TD></TR>
          </TBODY>
      </TABLE></TD>
    </TR>
    <TR>
      <TD style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>
<hr>
<p align="center" style="margin-top: 0; margin-bottom: 0"><b> </b></p>
</body>
</html>
