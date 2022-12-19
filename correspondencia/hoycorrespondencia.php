
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
    <td colspan="2"><span class="Estilomt1">Correspondencia</span></td>
  </tr>

<?
//	include("conectarse.php");
//	session_start();	$_SESSION['folder'] = "";
	$usuario = $_SESSION['codigoUsuario'];
//	require_once('Connections/redes.php');
//	mysql_select_db($database_redes);


	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 





//	$sql= "select count(*),concat(day(curdate()),'/',month(curdate()),'/',year(curdate())) from correspondencia where idempleado2 =$usuario and status=0";

	$sql= "select count(*) from correspondencia where idasesor2 =  $usuario and status=0";
//	envia_msg($sql);
		$result=mssql_query($sql);
		$row=mssql_fetch_array($result);
		if (intval($row[0])>0) $noleidos = "- Usted tiene $row[0] mensajes sin leer";
		$hoy = date('d/m/y');

	$sql= "select count(*) from correspondencia where status = 0 and idasesor2 =$usuario and fechaenvio=getdate()";
		$result=mssql_query($sql);
		$row=mssql_fetch_array($result);
		if (intval($row[0])>0) $noleidoshoy = "- Usted tiene $row[0] mensaje que han entrado el dia de hoy";


?>
  <tr>
    <td width="99">&nbsp;</td>
    <td width="545">&nbsp;</td>
  </tr>
  <tr bordercolor="1" class="Estilomt8">
    <td colspan="2"><span class="Estilomt8"><? print $noleidos;?></span></td>
  </tr>
  <tr bordercolor="1" class="Estilomt8">
    <td colspan="2"><span class="Estilomt8"><? if (isset($noleidoshoy)) { print $noleidoshoy; }?></span></td>
  </tr>
  <tr bordercolor="1" class="Estilomt8">
    <td colspan="2"><hr></td>
  </tr>
  <tr bordercolor="1" class="Estilomt8">
    <td colspan="2"><span class="Estilomt8">- Fecha actual <? print $hoy;?></span></td>
  </tr>
  <tr bordercolor="1" class="Estilomt8">
    <td colspan="2"><hr></td>
  </tr>
  <?

/*		$sql = "select if ((fechaentrega-curdate())<=0,
							'Hoy tiene que entregar ',
							concat('Faltan ',(fechaentrega-curdate()),' dia(s), fecha entrega ')
							),titulo,
						descr, date_format(fechaenvio,'%d/%m/%Y'), horaenvio,
						if(fechaentrega=curdate(),'',date_format(fechaentrega,'%d/%m/%Y')),
						horaentrega,idcorrespondencia
				from correspondencia c1
				where carpeta <> 3 and
					fechaentrega <> '0000/00/00' and
					(fechaentrega - curdate()) >= 0 and
					idcorrespondencia in
					(
						select idcorrespondencia
						from correspondencia_seguimiento
						where
							idempleadodestino = $usuario and
							idcorrespondencia = (
									select max(idcorrespondencia)
									from seguimiento
									where idcorrespondencia = c1.idcorrespondencia
								)
					)
				order by fechaentrega";*/
// en sqlserver quedaria 
/*$sql = "select case when ((fechaentrega-getdate())<=0,'Hoy tiene que entregar ',
		'Faltan ',(fechaentrega-getdate()),' dia(s), fecha entrega ')),titulo,
		descr, date_format(fechaenvio,'%d/%m/%Y'), horaenvio,
	    when (fechaentrega=getdate(),'',date_format(fechaentrega,'%d/%m/%Y')),
						horaentrega,idcorrespondencia
	end
				from correspondencia c1
				where carpeta <> 3 and
					fechaentrega <> '0000/00/00' and
					(fechaentrega - getdate()) >= 0 and
					idcorrespondencia in
					(
						select idcorrespondencia
						from correspondencia_seguimiento
						where
							idempleadodestino = $usuario and
							idcorrespondencia = (
									select max(idcorrespondencia)
									from seguimiento
									where idcorrespondencia = c1.idcorrespondencia
								) 
					)
				order by fechaentrega";
*/
// finaliza query en sqlserver quedaria
/*$sql = "select ((fechaentrega-getdate())<=0,'Hoy tiene que entregar ',
		'Faltan ',(fechaentrega-getdate()),' dia(s), fecha entrega ')),titulo,
		descr, fechaenvio, horaenvio
				from correspondencia c1
				where carpeta <> 3 and
					fechaentrega is not null
					(fechaentrega - getdate()) >= 0 and
					idcorrespondencia in
					(
						select idcorrespondencia
						from correspondencia_seguimiento
						where
							idasesordestino = $usuario and
							idcorrespondencia = (
									select max(idcorrespondencia)
									from seguimiento
									where idcorrespondencia = c1.idcorrespondencia
								) 
					)
				order by fechaentrega";
//echo $sql;
		$result=mssql_query($sql);
		$cnt = 0;
		while ($row=mssql_fetch_array($result))
		{
			if ($cnt == 0)	print "<tr><td colspan=\"2\"><span class=\"Estilomt1\">Alarmas</span></td></tr>";
			/*print "<tr>
					<td width=\"99\">&nbsp;</td>
					<td width=\"545\">&nbsp;</td>
				  </tr>";*/
//			$cnt ++;
		/*  print "<tr bordercolor=\"1\" class=\"Estilomt8\">
		    	<td colspan=\"2\"><span class=\"Estilomt8\">
				-  $row[0] entregar la correspondencia de asunto $row[1],
				descripcion $row[2], enviado el dia $row[3] a las $row[4], tiene que estar lista para el dia $row[5] a las $row[6] horas</span></td>
			  	</tr>";*/
/*			print "<tr bordercolor=\"1\" class=\"Estilomt8\">
		    	<td colspan=\"2\">
				<span class=\"Estilomt8\">
				<a href=\"CorreBeta1V2/visualiza/documento.php?docu=$row[7]&quien=Pahola Fuentes\">-  Alarma $cnt</a>
				<br>$row[0] $row[5] a las $row[6] horas</span>
				</td>
			  	</tr>";
		}*/
  ?>
</table>
