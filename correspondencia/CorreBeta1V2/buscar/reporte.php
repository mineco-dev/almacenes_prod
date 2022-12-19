<?
 	session_start();
$_SESSION['nivel']=2;
include('../../valida.php');

	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	

	$_SESSION['folder'] = "correBeta1V2/buscar/";
	$_SESSION['pagina'] = $page;

	//include('../../security.php');
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
.Estilo5 {color: #FFFFFF}
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
.Estilo18 {font-size: 10px;
	font-weight: bold;
}
.Estilo21 {	color: #660033;
	font-size: 10px;
}
-->
</style></head>

<body>
<table width="100%" class="Estilo21">
	<td align="left" bgcolor="#990000" width="15%" class="Estilo21" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
	</td>
	<td align="right">
		<p align="right"><span class="Estilo18"><a href="../center.php"><span class="Estilo21"><-- Regresar al Menu</span></a></span></p>
	</td>
</table>

<table width="100%">
<tr>
<th bgcolor="#0066FF" scope="col"><span class="Estilo5">Correspondencia</span></th>
</tr>	
</table>
<form name="form1" method="post" action="../center.php">
<table width="756" border="1">
  <tr>
    <th width="81" scope="col">Fecha</th>
    <th width="71" scope="col">Correlativo</th>
    <th width="281" scope="col">Descripci&oacute;n</th>
    <th width="153" scope="col">Instituci&oacute;n</th>
    <th width="166" scope="col">A quien se le env&iacute;o</th>
    </tr>


  <?

//  session_start();
		$usuario = $_SESSION['codigoUsuario'];
		

		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);

			include('../../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 
//			include('../../conectarse.php');


		/////////////////////////////////// agregado 7/11/2006 ////////////////////////////////////////////
		/// esta parte obtiene el id de la direccion a la cual pertenece el usuario
			$SQLOF = "select iddireccion from asesor where idasesor = " . $usuario;
			$resOF = mssql_query($SQLOF);
			$rowOF = mssql_fetch_row($resOF);
			$_SESSION['direcOF'] = $rowOF[0];

		//$SQL = "SELECT distinct(d.docu)correlativo,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)) fecha, d.descr descripcion, concat(e.nombres,e.apellidos) aquien FROM doc d, seguimiento s,empleados e ,direccion di WHERE e.idempleado=s.idempleado and d.docu=s.docu and s.aquien = $usuario and s.carpet=0 and s.salida is null and di.iddireccion = d.iddireccion order by d.docu desc";
		//$SQL = "select d.docu correlativo,s.fecha,d.descr desripcion, d.insti institucion, s.name23  from doc d,(  select docu,concat(e.nombres,'  ',e.apellidos) name23,concat(right(fecha,2),'/',month(fecha),'/',year(fecha)) fecha from segdocu sd,empleados e   where day(fecha)=$dia1 and month(fecha)=$mes1 and year(fecha)=$ano1 and sd.de = $usuario  and e.idempleado = sd.a )  s where d.docu = s.docu order by d.docu desc";
//		$fecha0= "$ano1/$mes1/$dia1";
		$fecha0= "$mes1/$dia1/$ano1";
		$SQL = "select c.idcorrespondencia correlativo,
						convert(varchar(20),s.fecha,105) fecha,
						rtrim(c.descr) desripcion,
						c.insti institucion,
						s.name23
				from correspondencia c,
					(
						select idcorrespondencia,
								e.nombre+'  '+e.apellido name23,
								fecha
						from correspondencia_seguimiento sd,asesor e
						where convert(varchar(20),fecha,105)=convert(varchar(20),cast('$fecha0' as datetime),105) and
								sd.idasesororigen = $usuario  and
								e.idasesor = sd.idasesordestino
					)  s
				where c.idcorrespondencia = s.idcorrespondencia
				order by c.idcorrespondencia desc";

		if (intval($rangofecha)==1)
		{
/*			$fecha0= "$ano2/$mes2/$dia2";
			$fecha1= "$ano3/$mes3/$dia3";*/
			$fecha0= "$mes2/$dia2/$ano2";
			$fecha1= "$mes3/$dia3/$ano3";


			if ($fecha1 < $fecha0 )
	{
envia_msg('la fecha final debe ser mayor que la inicial');
cambiar_ventana('documento.php');

	}


				/*$SQL = "select d.docu correlativo,
								s.fecha,
								d.descr desripcion,
								d.insti institucion,
								s.name23
						from doc d,
						(
							select docu,
								e.nombre+'  '+e.apellido name23,
								fecha
							from segdocu sd,asesor e
							where fecha>='$fecha0' and fecha <='$fecha1' and
							sd.de = $usuario  and e.idasesor = sd.a
						)  s
						where d.docu = s.docu order by d.docu desc";*/


		/*  $SQL = "select c.idcorrespondencia correlativo,
						s.fecha,
						trim(c.descr) desripcion,
						c.insti institucion,
						s.name23
				from correspondencia c,
					(
						select idcorrespondencia,
								concat(e.nombres,'  ',e.apellidos) name23,
								concat(right(fecha,2),'/',month(fecha),'/',year(fecha))
								fecha
						from correspondencia_seguimiento sd,empleados e
						where fecha>='$fecha0' and fecha <='$fecha1' and
								sd.idempleadoorigen = $usuario  and
								e.idempleado = sd.idempleadodestino
					)  s
				where c.idcorrespondencia = s.idcorrespondencia
				order by c.idcorrespondencia desc";   */

//envia_msg('uno');

$SQL = "select c.idcorrespondencia correlativo,
						convert(varchar(20),s.fecha,105),
						rtrim(c.descr) desripcion,
						c.insti institucion,
						s.name23
				from correspondencia c,
					(
						select idcorrespondencia,
								e.nombre+'  '+e.apellido name23,
								fecha
						from correspondencia_seguimiento sd,asesor e
						where convert(varchar(20),fecha)>=convert(varchar(20),cast('$fecha0' as datetime)) and convert(varchar(20),fecha)  <= convert(varchar(20),cast('$fecha1' as datetime)) and
								sd.idasesororigen = $usuario  and
								e.idasesor = sd.idasesordestino
					)  s
				where c.idcorrespondencia = s.idcorrespondencia
				order by c.idcorrespondencia desc";



		}

//		print $rangofecha.".".$SQL;
			$result = mssql_query($SQL); // elimina informacion temporal
			while($row = mssql_fetch_row($result))
			{
				if (strlen($row[2])==0) $row[2]="&nbsp;";
				if (strlen($row[3])==0) $row[3]="&nbsp;";

				print " <tr> ";
				print "<td>$row[1]</td>";
				print "<td>$row[0]</td>";
				print "<td>$row[2]</td>";
				print "<td>$row[3]</td>";
				print "<td >$row[4]</td>";
				  	print "</tr>";
			}
			//mysql_close($db);
  ?>
</table>

  </form>


<p>&nbsp;</p>
</body>
</html>
