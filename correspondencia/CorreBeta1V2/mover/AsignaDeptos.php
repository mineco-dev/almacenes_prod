<?
session_start();

$_SESSION['nivel']=2;
include('../../valida.php');

 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];

	$_SESSION['folder'] = "correBeta1V2/mover/";
	$_SESSION['pagina'] = $page;

//	include('../../security.php');
	//print $_SESSION['iso_registro'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
body {
	background-image: url(file:///C|/Documents%20and%20Settings/PFuentes/Mis%20documentos/test/Fondo%20de%20Fiesta.jpg);
}
.Estilo2 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #FFFFFF;
}
.Estilo3 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 12pt;
}
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 10px; color: #FFFF00; }
.Estilo6 {color: #FFFF00}
.Estilo7 {font-weight: bold; font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;}
.Estilo8 {
	color: #333333;
	font-size: 12pt;
}
-->
</style>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo9 {font-size: 12px}
-->
</style>
</head>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<body>
<?

include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
//		include('../../conectarse.php');
/*require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);*/
//		$SQL = "select d.docu,d.titulo,concat(right(p.fecha_entrega,2),'/',month(p.fecha_entrega),'/',year(p.fecha_entrega)),v.nombre from proyecto p, vendedor v where v.vendedor=p.vendedor and proyecto=$proyecto";
//		$SQL = "select d.docu,d.titulo,e.nombres from doc d, empleados e where d.empleado = e.idempleado and docu = $docu";
//		$SQL = "select c.idcorrespondencia,c.titulo,concat(e.nombres,' ',e.apellidos),c.correlativo from correspondencia c, empleados e where c.idempleado1 = e.idempleado and idcorrespondencia = $docu";
		$SQL = "select c.idcorrespondencia,c.titulo,e.nombre+' '+e.apellido, c.correlativo 
				from correspondencia c, asesor e where c.idasesor = e.idasesor and idcorrespondencia = $docu";
		$result = mssql_query($SQL);
		$row = mssql_fetch_row($result);
		$nombre= $row[1];
		$fecha23= date("d-m-Y");
		$NombreCreador= $row[2];
		$codigo = $row[3];
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



<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Codigo # : </span></div></td>
    <td bgcolor="#0099FF"><span class="Estilo5"><? print $codigo;?></span></td>
    <td bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Fecha de entrega : </span></div></td>
    <td bgcolor="#0099FF"><div align="left" class="Estilo6"><span class="Estilo7"><? print $fecha23;?></span></div></td>
  </tr>
  <tr>
    <td width="15%" bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Titulo:</span></div></td>
    <td width="24%" bgcolor="#0099FF"><span class="Estilo5"><? print $nombre; ?></span></td>
    <td width="25%" bgcolor="#0099FF"><div align="right"><span class="Estilo2 Estilo9">Persona que creo el documento :</span></div></td>
    <td width="36%" bgcolor="#0099FF"><div align="left"><span class="Estilo5"><? print $NombreCreador?></span></div></td>
  </tr>
</table>
<TABLE width="100%" border=0 cellPadding=0 cellSpacing=5 bordercolor="#0099FF" id="table15">
  <TBODY>
    <TR bgcolor="#0066CC">
      <TD height=15 bgcolor="#0099FF" style="font-size: 10pt; font-family: verdana,arial"><div align="center" class="Estilo3">Mover su correspondencia a: </div></TD>
    </TR>
    <TR>
      <TD width="72%" style="font-size: 10pt; font-family: verdana,arial"><TABLE borderColor=#000000 cellSpacing=0 cellPadding=40 width="100%"
      border=2 id="table16">
          <TBODY>
            <TR>
              <Tliwidth="100%" align="center" background="../images/fondoTablas.gif" bgColor=#ffffff style="font-size: 10pt; font-family: verdana,arial">
			  <form name="form1" method="post" action="insertaDeptoProyecto.php<? print "?docu=$docu";?>">
                <? // print "si entro";?>
                  <div align="center">
                    <table width="55%"  border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td width="21%" bgcolor="#0099FF"><div align="left"></div></td>
                        <td width="79%" bgcolor="#0099FF"><div align="left"><span lang="es-gt">
                        </span></div></td>
                      </tr>
                      <tr>
                        <td><div align="left"><span class="Estilo8">Carpeta</span></div></td>
                        <td><div align="left">
                            <select name="cboCarpeta" id="cboCarpeta">
                              <option value="1">Bandeja de entrada</option>
                              <option value="2">Bandeja de salida</option>
                              <option value="3">Correspondencia Finalizada</option>
							  <option value="4">Correspondencia Almacenada</option>

                      </select>
                        </div></td>
                      </tr>
                    </table>
                    <input name="docu" type="hidden" id="docu" value=" <? print $docu;?> " >
                  </div>
                  <p align="center">
                  <input type="submit" name="Submit" value="Transferir">
                </p>
              </form>                <p align="center">&nbsp;</p>
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
