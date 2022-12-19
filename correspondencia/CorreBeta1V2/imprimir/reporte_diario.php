<?
	session_start();
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	
	$_SESSION['folder'] = "correBeta1V2/imprimir/";
	$_SESSION['pagina'] = $page;

//	include('../../security.php');
//	print $_SESSION['iso_registro'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #878EAA;
}
.Estilo3 {	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<script language="javascript">
function enviar(form)
{
   form.action = "uploadForm.php";
   return true;
}

function regresar(form)
{
   form.action = "../center.php";
   return true;
}

function enviar2(form)
{
   form.action = "saveLocal.php";
   return true;
}
</script>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
/*body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}*/
.Estilo4 {font-size: 12px}
.Estilo6 {
	font-size: 36px;
	color: #000000;
}
.Estilo8 {font-size: 14}
.Estilo9 {
	color: #FF0000;
	font-weight: bold;
	font-size: 12px;
}
-->
</style></head>

<body><form name="form1" method="post" action="../center.php">
<p align="center" class="Estilo6">Correspondencia enviada </p>
<table width="713" border="1" align="center">
  <tr>
    <th width="75" scope="col">Fecha</th>
    <th width="63" scope="col">Correlativo</th>
    <th width="277" scope="col">Descripci&oacute;n</th>
    <th width="162" scope="col">A quien se le env&iacute;o</th>
    <th width="167" scope="col">Firma</th>
    </tr>


  <?

  
	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	include('../../conectarse.php');
		$usuario = $_SESSION['codigoUsuario'];
/*		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);*/

		/////////////////////////////////// agregado 7/11/2006 ////////////////////////////////////////////
		/// esta parte obtiene el id de la direccion a la cual pertenece el usuario
			$SQLOF = "select iddireccion from asesor where idasesor = " . $usuario;
			$resOF = mssql_query($SQLOF);
			$rowOF = mssql_fetch_row($resOF);
			$_SESSION['direcOF'] = $rowOF[0];
/*		$SQL = "SELECT distinct(d.docu)correlativo, s.fecha,
		 d.descr descripcion,
		 e.nombre+' '+e.apellido) aquien
		 FROM doc d, seguimiento s, asesor e ,direccion di
		 WHERE e.idasesor=s.idasesor and d.docu=s.docu and s.aquien = $usuario
		 and s.carpet=0 and s.salida is null
		 and di.iddireccion = d.iddireccion order by d.docu desc";*/

//		$SQL = "select d.docu correlativo,s.fecha,d.descr desripcion, s.name23  from doc d,(  select docu,concat(e.nombres,'  ',e.apellidos) name23,concat(right(fecha,2),'/',month(fecha),'/',year(fecha)) fecha from segdocu sd,empleados e   where day(fecha)=$dia1 and month(fecha)=$mes1 and year(fecha)=$ano1 and sd.de = $usuario  and e.idempleado = sd.a )  s where d.docu = s.docu order by d.docu desc";

//		$SQL = "select c.correlativo, c.fechainicio,
		$SQL = "select c.correlativo, convert(varchar,c.fechainicio,105),
							'<br>INSTITUCión:'+c.insti +	'<br> ENVIA:'+c.quien + ' <br>DESCRIPCión:<br> ' +c.descr +
							' <br>FECHA/HORA ENTREGA:<br> ' + convert(char,c.fechaentrega,105)+ ' '+convert(char,c.horaentrega)+
							' <br>TRAMITE:<br> '+t.nombre desripcion,
						e.nombre, c.idcorrespondencia,
						c.correlativoinicial
				from
					correspondencia c,
					asesor e ,
					tramite t
				where c.idasesor2 = e.idasesor and
					c.idasesorcrea = $usuario and
					c.tramite = t.idtramite and
						c.fechainicio >= convert(varchar(20),cast('$mes1/$dia1/$ano1' as datetime))
				order by c.correlativo desc ";
//						c.fechainicio >= convert(varchar(10),cast('$dia1/$mes1/$ano1' as datetime),103)
//					c.fechainicio = convert(datetime,(cast,'$dia1'+'/'+'$mes1'+'/'+'$ano1' as datetime),103)
		if ((strlen(trim($correlativo))+strlen(trim($correlativo1)))>0)
		{
//			$SQL = "select d.docu correlativo,s.fecha,d.descr desripcion, s.name23  from doc d,(  select docu,concat(e.nombres,'  ',e.apellidos) name23,concat(right(fecha,2),'/',month(fecha),'/',year(fecha)) fecha from segdocu sd,empleados e   where sd.de = $usuario  and e.idempleado = sd.a )  s where d.docu = s.docu ";
			$SQL = "select c.correlativo, convert(varchar,c.fechainicio,105),
						'<br>INSTITUCión:'+c.insti+'<br> ENVIA:'+c.quien+' <br>DESCRIPCión:<br> '+c.descr+
						' <br>FECHA/HORA ENTREGA:<br> '+convert(char,c.fechaentrega,105)+' '+convert(char,c.horaentrega)+
						' <br>TRAMITE:<br> '+ t.nombre descripcion,
						e.nombre, c.idcorrespondencia,
						c.correlativoinicial
					from
						correspondencia c,
						asesor e,
						tramite t
					where c.idasesor2 = e.idasesor and
						c.idasesorcrea = $usuario and
						c.tramite = t.idtramite and 
						c.fechainicio >= convert(varchar(20),cast('$mes1/$dia1/$ano1' as datetime))";
//						c.fechainicio >= convert(varchar(10),cast('$dia1/$mes1/$ano1' as datetime),103)";
				//		c.fechainicio = convert(datetime,(cast,$dia1+'/'+$mes1+'/'+$ano1 as datetime),103)";
						/* and day(fechainicio)=$dia1 and month(fechainicio)=$mes1 and year(fechainicio)=$ano1 ";**/

		if ( (strlen(trim($correlativo))>0) && (strlen(trim($correlativo1))>0) )
			if (strlen(trim($correlativo))>0)
			{
//				$SQL = $SQL." and c.idcorrespondencia >=$correlativo ";
				$SQL = $SQL." and c.correlativo >=$correlativo ";
			}
			if (strlen(trim($correlativo1))>0)
			{
//				$SQL = $SQL." and c.idcorrespondencia <=$correlativo1 ";
				$SQL = $SQL." and c.correlativo <=$correlativo1 ";
			}
			$SQL = $SQL." order by c.idcorrespondencia desc";
		}
//	print $SQL;
			$result = mssql_query($SQL); // elimina informacion temporal
			while($row = mssql_fetch_row($result))
			{
				 	print " <tr> ";
				print "<td>$row[1]</td>";
				print "<td>$row[0]</td>";
				print "<td >$row[2]</td>";
				print "<td>$row[3]</td>";
				print "<td >&nbsp;</td>";
				  	print "</tr>";
			}
			//mysql_close($db);
  ?>
</table>

  </form>


<p>&nbsp;</p>
</body>
</html>
