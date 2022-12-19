<style type="text/css">
<!--
.Estilomt1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
	color: #FF0000;
}
.Estilomt8 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #6699FF;
}
-->
</style>
<table width="276" border="0" cellspacing="1">
  <tr>
    <td colspan="2"><span class="Estilomt1">Actividades</span></td>
  </tr>

<?
	session_start();	$_SESSION['folder'] = "";
	$usuario = $_SESSION['codigoUsuario'];

	include('../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 


/*	require_once('Connections/redes.php');
	mysql_select_db($database_redes);*/

	$sql= "select count(*) from calendario where idasesor = $usuario and fecha > getdate()";
		$result=mssql_query($sql);
		$row=mssql_fetch_array($result);
		if (intval($row[0])>0) $actividades = "- Usted tiene $row[0] actividades pendientes";
		$hoy = $row[1];

	$sql= "select count(*) from
			(
				select fecha, hora from calendario where idasesor =$usuario and fecha=getdate() group by fecha,hora
			)tmp";

		$result=mssql_query($sql);
		$row=mssql_fetch_array($result);
		if (intval($row[0])>0) $actividades = "- Hoy tiene $row[0] actividad(es)";


?>
  <tr>
    <td width="99">&nbsp;</td>
    <td width="545">&nbsp;</td>
  </tr>
  <tr bordercolor="1" class="Estilomt8">
    <td colspan="2"><span class="Estilomt8"><? print $actividades;?></span></td>
  </tr>
  <tr bordercolor="1" class="Estilomt8">
    <td colspan="2"><span class="Estilomt8"><? print $actividadeshoy;?></span></td>
  </tr>
  <tr bordercolor="1" class="Estilomt8">
    <td colspan="2"><span class="Estilomt8"><hr></td>
</table>
