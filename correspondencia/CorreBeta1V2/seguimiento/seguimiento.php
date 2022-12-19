<?
	session_start();

$_SESSION['nivel']=2;
include('../../valida.php');

 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	

	$_SESSION['folder'] = "correBeta1V2/seguimiento/";
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
.Estilo1 {color: #FFFFFF}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 18px;
}
-->
</style>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(file:///C|/Documents%20and%20Settings/PFuentes/Mis%20documentos/test/Fondo%20de%20Fiesta.jpg);
}
.Estilo5 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo8 {font-size: 14px}
.Estilo9 {
	color: #FF0000;
	font-size: 24px;
	font-weight: bold;
}
.Estilo10 {color: #000000}



-->
</style></head>
<script language="javascript">

function regresar(form)
{
   form.action = "../center.php";
   return true;
}
</script>
<body>

<p>&nbsp;</p>
<?
  		//session_start();
		$usuario = $_SESSION['codigoUsuario'];
		
		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
//		include('../../conectarse.php');

		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);
		
		$SQL = " select c.titulo from  correspondencia c where c.idcorrespondencia=$docu";

	    $result = mssql_query($SQL); // elimina informacion temporal
		$row = mssql_fetch_row($result);


?>

<table width="100%" class="Estilo21">
	<td align="left" bgcolor="#990000" width="15%" class="Estilo21" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
	</td>
	<td align="right">
		<p align="right"><span class="Estilo18"><a href="../center.php"><span class="Estilo21"><-- Regresar al Menu</span></a></span></p>
	</td>
</table>

<div align="center" class="Estilo9"><span class="Estilo10">Titulo:</span> <? print "$row[0]";?>
</div>


<table width="100%"  border="0" cellpadding="5">
  <tr>
    <td><table width="100%"  border="0" cellpadding="5">
      <tr bgcolor="#0066FF">
        <td colspan="6"><div align="center" class="Estilo2">Seguimiento</div></td>
      </tr>
      <tr bgcolor="#0066FF">
        <td><div align="center" class="Estilo1 Estilo5">Codigo</div></td>
        <td><div align="center" class="Estilo1 Estilo5">De</div></td>
        <td><div align="center"><span class="Estilo1 Estilo5">A</span></div></td>
		<td><div align="center"><span class="Estilo1 Estilo5">Fecha</span></div></td>
		<td><div align="center"><span class="Estilo1 Estilo5">Hora</span></div></td>
<!--         <td><div align="center"><span class="Estilo1 Estilo4">Titulo</span></div></td> -->
      </tr>
      <?

//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
			//$SQL = " select d.docu,a.user,b.user,s.fecha,s.hora,d.titulo from (select user,idasesor from asesor)  a,(select user,idasesor from asesor)  b, segdocu s,doc d where a.idempleado = s.de and b.idempleado = s.a and s.docu = d.docu and d.docu=$docu order by s.sd";

			/*$SQL = "select c.idcorrespondencia,
						   concat(e1.nombres,' ',e1.apellidos),
						   concat(e2.nombres,' ',e2.apellidos),
						   concat(right(cs.fecha,2),'/',month(cs.fecha),'/',year(cs.fecha)),
						   cs.hora,
						   c.titulo,
						   concat(c.correlativoinicial,'  -  ',d.nombre,'-',c.correlativo)
					from correspondencia c, correspondencia_seguimiento cs,empleados e1, empleados e2,direccion d
					where c.idcorrespondencia = cs.idcorrespondencia and
						  cs.idempleadoorigen = e1.idempleado and
						  cs.idempleadodestino = e2.idempleado and
						  c.iddireccion = d.iddireccion and
						  c.idcorrespondencia = $docu";*/




$SQL = "select c.idcorrespondencia,
						   e1.nombre+' '+e1.apellido,
						   e2.nombre+' '+e2.apellido,
						   cs.fecha,
						   cs.hora,
						   c.titulo,
						   c.correlativoinicial+'  -  '+d.nombre+'  -  ',
						  c.correlativo
					from correspondencia c, correspondencia_seguimiento cs,asesor e1, asesor e2,direccion d
					where c.idcorrespondencia = cs.idcorrespondencia and
						  cs.idasesororigen = e1.idasesor and
						  cs.idasesordestino = e2.idasesor and
						  c.iddireccion = d.iddireccion and
						  c.idcorrespondencia = $docu";


//			print $SQL;
			$result = mssql_query($SQL); // elimina informacion temporal

			while($row = mssql_fetch_row($result))
			{
			    switch($row[2])
				{
				   case 0: $figura = "mnoleido.gif";break;
				   case 1: $figura = "mleido.gif";break;
				   case 2: $figura = "mTrans.gif";break;
				}
				  print "<tr> ";
				print "<td> $row[6]$row[7]</td>";
				print "<td> $row[1]</td>";
				print "<td> $row[2]</td>";
				print "<td> $row[3]</td>";
				print "<td> $row[4]</td>";
				//print "<td> $row[5]</td>";
				 print " </tr>";

			}
  ?>
    </table></td>
  </tr>
  <tr>
    <td class="Estilo5">&nbsp;</td>
  </tr>
  <tr>
    <td class="Estilo5">
	<table width="100%" border="0" cellspacing="0">
  <tr>
    <th bgcolor="#0066FF" scope="col"><span class="Estilo5 Estilo1">Detalle de Seguimiento </span></th>
  </tr>
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr bgcolor="#000000">

    <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Usuario</span></div></td>
    <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Descripci&oacute;n</span></div></td>
    <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Fecha</span></div>
	</td>
  </tr>
  <tr>
  </tr>

  <?php

				   /*$SQL = "select
				   d.dd,
				   e.user,
				   d.descr,
				   concat(right(d.fecha,2),'/',month(d.fecha),'/',year(d.fecha))
				   FROM detalle_documento d,empleados e WHERE d.idempleado = e.idempleado and d.docu=$docu ";*/

				   $SQL = "select
						   d.dd,
						   e.nombre+' '+e.apellido,
						   d.descr,
						   d.fecha
				   FROM detalle_documento d,asesor e WHERE d.idempleado = e.idasesor and d.docu=$docu ";
//				   print $SQL;
				  $result = mssql_query($SQL);

					while ($row23 = mssql_fetch_row($result))
					{
		                   echo " <tr>";
                      //echo " <td>$row23[0]</td>";
                      echo " <td>$row23[1]</td>";
					  echo " <td>$row23[2]</td>";
					  echo " <td>$row23[3]</td>";


                    echo " </tr>";
					}
		       // echo " <tr bgcolor=#0066FF><td>.</td><td>.</td><td>.</td>";
				echo " <tr>";

				//$SQL = "select s.docu,e.user,s.descr,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)) FROM seguimiento s,empleados e WHERE s.idempleado=e.idempleado and s.docu=$docu ";
				
				$SQL = "select
							cs.idcorrespondencia,
							e.nombre+' '+e.apellido,
							cs.descripcion,
							cs.fecha
						FROM correspondencia_seguimiento cs,asesor e
						WHERE cs.idasesororigen=e.idasesor and
							cs.idcorrespondencia=$docu ";
				   //print $SQL;
				  $result = mssql_query($SQL);

					while ($row23 = mssql_fetch_row($result))
					{
		                   echo " <tr>";
                      //echo " <td>$row23[0]</td>";
                      echo " <td>$row23[1]</td>";
					  echo " <td>$row23[2]</td>";
					  echo " <td>$row23[3]</td>";


                    echo " </tr>";
					}
					//mysql_close($db);
?>

</table>	</td>
  </tr>
   <tr>
    <td class="Estilo5">

	      <table width="100%" border="0" cellspacing="0">
        <tr>
          <th bgcolor="#0066FF" scope="col"><span class="Estilo5 Estilo1">Archivos Adjuntos </span></th>
        </tr>
      </table>
      <table width="100%" border="1" cellpadding="0" cellspacing="0">
        <tr bgcolor="#000000">

          <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Documento</span></div></td>
          <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Descripci&oacute;n</span></div></td>
        </tr>
		<?
		 	//$SQL12 = "SELECT da,nombre,descripcion,path FROM correspondencia_adjunto WHERE   docu = $docu";
		 	
			$SQL12 = "SELECT idcorrespondencia,nombre,descripcion,path FROM correspondencia_adjunto WHERE idcorrespondencia = $docu";
			$result = mssql_query($SQL12); // elimina informacion temporal
			while ($row1 = mssql_fetch_row($result))
			{
				 print " <tr>";
//		        print " <td>$row1[0]</td>";
		        //print " <td><a href=../documento/upload/$row1[3] t0arget='_blank' >$row1[1]</a></td>";
				print " <td><a href=../../upload/$row1[3] t0arget='_blank' >$row1[1]</a></td>";
		        print " <td>$row1[2]</td>";
		      //  print " <td>Eliminar</td>";
		      print " </tr>";
			}
		?>
      </table>

	</td>
  </tr>
</table>
<table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td><div align="center"><a href="../center.php" class="Estilo8">Regresar</a> </div></td>
  </tr>
</table>
<p class="Estilo5">&nbsp;</p>
</body>
</html>
