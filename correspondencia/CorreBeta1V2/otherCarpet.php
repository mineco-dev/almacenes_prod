<?

session_start();

$_SESSION['nivel']=2;
include('../valida.php');

 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];

	$_SESSION['folder'] = "correBeta1V2/";
	$_SESSION['pagina'] = $page;

//	include('../security.php');
//	print $_SESSION['iso_registro'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 24px;
}
-->
</style>
<link href="style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo3 {
	color: #0066CC;
	font-weight: bold;
	font-size: 16px;
}
body,td,th {
	color: #0033CC;
}

.Estilo6 {	font-size: 16pt;
	color: #3366CC;
	font-weight: bold;
}
.Estilo4 {	color: #0066CC;
	font-size: 14px;
}
.Estilo7 {color: #0066CC}
.Estilo8 {font-size: 14px}
-->
</style>
<SCRIPT language=javascript>
function cOn(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#FFF2F2";
}
}

function cOut(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#FFFFFF";
}
}

//-->
</SCRIPT>
</head>

<body>
<table border="0" width="100%">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right" width="70%" class="Estilo18">
		<a href="../CorreBeta1V2/center.php"><-- Regresar al Menu </a>
		</td>
		<!--td align="right" class="Estilo18">
		<a href="../mtlogin.php">[ Cerrar Sesión ]</a>
		</td-->
	</tr>
</table>

<!--p>&nbsp;</p>
<p>&nbsp;</p-->
<table width="100%"  border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td><div align="center"><span class="Estilo6">Correspondencia Ministerio de Econom&iacute;a </span></div></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr background="Fondo de Fiesta.jpg">
          <td width="5%" bgcolor="#B4C4EF"><span class="Estilo3">Menu</span></td>
          <td width="14%" height="28" bgcolor="#B4C4EF"><p align="center" class="Estilo7"><a href="documento/ingresaDocument.php" class="Estilo8">Crear Correpondencia </a></p></td>
          <td width="6%" bgcolor="#B4C4EF"><p align="center" class="Estilo7"><a href="center.php" class="Estilo7"><a href="imprimir/fecha.php?docu=<? print $docu;?>" target="_blank">Reporte</a></p></td>
          <td width="16%" bgcolor="#B4C4EF"><a href="center.php" class="Estilo7"><img src="img/muchos.gif" width="16" height="16" border="0"> Bandeja de Entrada</a></td>
          <td width="18%" bgcolor="#B4C4EF"><div align="center" class="Estilo7"><a href="otherCarpet.php?carpet=2&mensaje=Bandeja Correspondencia de Salida"><img src="img/form_login_config.gif" width="16" height="16" border="0"> Bandeja de Salida </a></div></td>
          <td width="17%" bgcolor="#B4C4EF"><div align="center" class="Estilo7"><a href="otherCarpet.php?carpet=4&mensaje=Bandeja de Correspondecia Almacenada"><img src="img/j2ee_view.gif" width="16" height="16" border="0"> Correspondencia Almacenada</a></div></td>
          <td width="17%" bgcolor="#B4C4EF"><div align="center" class="Estilo7"><a href="otherCarpet.php?carpet=3&mensaje=Bandeja de Correspondencia Finalizada"><img src="img/jworkingSet_obj.gif" width="16" height="16" border="0"> Correspondencia Finalizada</a> </div></td>
          <td width="9%" bgcolor="#B4C4EF"><span class="Estilo4"><img src="img/container.gif" width="15" height="17"> </span><span class="Estilo7"><a href="buscar/documento.php">Busca</a><span class="Estilo8"><a href="buscar/documento.php">r</a></span></span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td  bgcolor="#0066FF">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0">
        <tr>
          <td><p align="center"><img src="img/tranferir.gif" width="16" height="16"> Transferir</p></td>
          <td><div align="center"><img src="img/visualizar.gif" width="16" height="16"> Visualizar</div></td>
          <td><div align="center"> <img src="img/adjuntar.gif" width="16" height="16"> Adjuntar</div></td>
          <td><div align="center"><img src="img/seguimiento.gif" width="16" height="16"> Seguimiento </div></td>
          <td><div align="center"><img src="img/imprimir.gif" width="16" height="16"> Imprimir </div></td>
          <td><div align="center"> <img src="img/mover.gif" width="16" height="16"> Mover </div></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0">
  <tr>
    <td colspan="8" bgcolor="#0066FF"><div align="center"><span class="Estilo1"><? print "$mensaje"; ?></span></div></td>
  </tr>
  <?
     	print " <tr > ";
				print "<td width='3%'></td>";
				print "<td width='3%'></td>";
				print "<td width='3%'></td>";
				print "<td width='40%'>Titulo</td>";
				print "<td width='10%'>Fecha</td>";
				print "<td width='10%'>Se Envio</td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
			  	print "</tr>";
  				/*print "<tr>";
				print "<td width='3%'></td>";
				print "<td width='3%'></td>";
				print "<td width='3%'></td>";
				print "<td width='3%'></td>";
				print "<td width='40%'>Titulo</td>";
				print "<td width='10%'>Fecha</td>";
				print "<td width='10%'>A Quien Envia</td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
			  	print "</tr>";*/
  
		$usuario = $_SESSION['codigoUsuario'];
		
		//require ('conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);

		include('../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		//include('../conectarse.php');


//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
//			$SQL = "SELECT d.docu,s.status,d.titulo concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s WHERE d.docu=s.docu and s.aquien = $usuario and s.carpet=$carpet group by d.docu order by s.fecha desc";
		//$SQL = "SELECT d.docu,s.status,d.titulo, concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado = d.empleado and d.docu=s.docu and s.aquien =1 and s.carpet=0 group by d.docu order by s.fecha desc";
//		$SQL = "SELECT d.docu,s.status,d.titulo,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado=s.idempleado and d.docu=s.docu and s.aquien = $usuario and s.carpet=$carpet group by d.docu order by s.fecha desc";
//		$SQL = "SELECT d.docu,s.status,d.titulo,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado=s.salida and d.docu=s.docu and s.aquien = $usuario and s.carpet=$carpet group by d.docu order by s.fecha desc";


		//--$SQL = "SELECT d.docu,s.status,d.titulo,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado=s.salida and d.docu=s.docu and s.idempleado = $usuario and s.carpet=$carpet group by d.docu order by s.fecha desc";
		// --------- $SQL = "SELECT d.docu,s.status,d.titulo,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado=s.aquien and d.docu=s.docu and s.idempleado = $usuario and s.carpet=$carpet order by d.docu desc";


     /*  if ($carpet==1)
	   {
		   $SQL = "select d.docu,d.docu,d.titulo,s.fecha,s.name23  from doc d,(  select docu,concat(e.nombres,'  ',e.apellidos) name23,concat(right(fecha,2),'/',month(fecha),'/',year(fecha)) fecha from segdocu sd,empleados e   where sd.de = $usuario  and e.idempleado = sd.a )  s where d.docu = s.docu order by d.docu desc";
	   }
	   else
	   {
		   $SQL = "SELECT d.docu,s.status,d.titulo,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado=s.aquien and d.docu=s.docu and s.idempleado = $usuario and s.carpet=$carpet order by d.docu desc";
	   }
		$SQL = "SELECT distinct(c.idcorrespondencia),
						c.correlativoinicial,
						c.titulo,
						concat(right(c.fechainicio,2),'/',month(c.fechainicio),'/',year(c.fechainicio)),
						concat(e.nombres,' ',e.apellidos,'/',c.correlativo)
					FROM correspondencia c, empleados e
					WHERE e.idempleado=c.idempleado2 and
						c.idempleadocrea = $usuario and
						c.carpeta=$carpet
					order by c.idcorrespondencia desc";   */



       if ($carpet==1)
	   {
		   $SQL = "select d.docu,d.docu,d.titulo,s.fecha,s.name23  from doc d,
		(  select docu, e.nombre+'  '+e.apellido, name23,  fecha 
		from segdocu sd,asesor e   where sd.de = $usuario  and e.idasesor = sd.a )  s where d.docu = s.docu order by d.docu desc";
	   }
	   else
	   {
		   $SQL = "SELECT d.docu,s.status,d.titulo, fecha, e.nombre+' '+e.apellido FROM doc d, seguimiento s,asesor e WHERE e.idasesor=s.aquien and d.docu=s.docu and s.idasesor = $usuario and s.carpet=$carpet order by d.docu desc";
	   }
		$SQL = "SELECT distinct(c.idcorrespondencia),
						c.correlativoinicial,
						c.titulo,
						convert(varchar,c.fechainicio,105),
						e.nombre+' '+e.apellido+'/',
						c.correlativo
					FROM correspondencia c, asesor e
					WHERE e.idasesor=c.idasesor2 and
						c.idasesorcrea = $usuario and
						c.carpeta=$carpet
					order by c.idcorrespondencia desc";

			/*$SQL = "SELECT distinct(c.idcorrespondencia),
						c.correlativo,
						c.titulo,
						concat(right(c.fechainicio,2),'/',month(c.fechainicio),'/',year(c.fechainicio)),
						concat(e.nombres,' ',e.apellidos)
					FROM correspondencia c, empleados e
					WHERE e.idempleado=c.idempleado2  $cad and
						c.idcorrespondencia in (
							SELECT distinct(idcorrespondencia)
							FROM correspondencia_seguimiento
							WHERE idempleadoorigen=$usuario
					) order by c.correlativo desc";
		print $SQL;*/
			//$SQL = "SELECT d.docu,s.status,d.titulo,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado=s.idempleado and d.docu=s.docu and s.aquien = $usuario and s.carpet=0 group by d.docu order by s.fecha desc";
			$result = mssql_query($SQL); // elimina informacion temporal

			while($row = mssql_fetch_row($result))
			{
				 $figura = "mleido.gif";
/*				switch($row[1])
				{
				   case 0: $figura = "mnoleido.gif";break;
				   case 1: $figura = "mleido.gif";break;
				   case 2: $figura = "mTrans.gif";break;
				}*/
			 	/*print " <tr onmouseover=cOn(this); onmouseout=cOut(this);> ";
				print "<td width='3%'>$row[0]</td>";
				print "<td width='3%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]' ><img src='img/$figura' width='16' height='16' border=0></div></a></td>";
				print "<td width='3%'><div align='center'><img src='img/djuntos.gif' width='16' height='16' border=0></div></td>";
				print "<td width='60%'><a href ='visualiza/documento.php?docu=$row[0]' >$row[2]</a></td>";
				print "<td width='4%'><div align='center'><a href ='transfiere/AsignaDeptos.php?docu=$row[0]' ><img src='img/tranferir.gif' width='16' height='16' border=0 alt='Transferir'></div></td>";
				print "<td width='4%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]' ><img src='img/visualizar.gif' width='16' height='16' border=0 alt='Visualizar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='adjuntar/uploadForm.php?docu=$row[0]' ><img src='img/adjuntar.gif' width='16' height='16' border=0 alt='Adjuntar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='seguimiento/verSeguimiento.php?docu=$row[0]' ><img src='img/seguimiento.gif' width='16' height='16' border=0 alt='Seguimiento'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='imprimir/documento.php?docu=$row[0]' ><img src='img/imprimir.gif' width='16' height='16' border=0 alt='Imprimir'></a></div></td>";
				print "<td width='4%'><div align='center'><img src='img/mover.gif' width='16' height='16' border=0></div></td>";
			  	print "</tr>";*/
				print " <tr onmouseover=cOn(this); onmouseout=cOut(this);> ";
				print "<td width='3%'>$row[1]</td>";
				print "<td width='3%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]&dato=$row[4]$row[5]' ><img src='img/$figura' width='16' height='16' border=0></div></a></td>";
				print "<td width='3%'><div align='center'><img src='img/djuntos.gif' width='16' height='16' border=0></div></td>";
				print "<td width='30%'><a href ='visualiza/documento.php?docu=$row[0]&dato=$row[4]$row[5]' >$row[2]</a></td>";
				print "<td width='10%'><a href ='visualiza/documento.php?docu=$row[0]&dato=$row[4]$row[5]' >$row[3]</a></td>";
				print "<td width='20%'><a href ='visualiza/documento.php?docu=$row[0]&dato=$row[4]$row[5]' >$row[4]$row[5]</a></td>";
				print "<td width='4%'><div align='center'><a href ='transfiere/AsignaDeptos.php?docu=$row[0]' ><img src='img/tranferir.gif' width='16' height='16' border=0 alt='Transferir'></div></td>";
				print "<td width='4%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]&dato=$row[4]$row[5]' ><img src='img/visualizar.gif' width='16' height='16' border=0 alt='Visualizar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='adjuntar/uploadForm.php?docu=$row[0]' ><img src='img/adjuntar.gif' width='16' height='16' border=0 alt='Adjuntar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='seguimiento/seguimiento.php?docu=$row[0]' ><img src='img/seguimiento.gif' width='16' height='16' border=0 alt='Seguimiento'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='imprimir/documento.php?docu=$row[0]' ><img src='img/imprimir.gif' width='16' height='16' border=0 alt='Imprimir'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='mover/AsignaDeptos.php?docu=$row[0]' ><img src='img/mover.gif' width='16' height='16' border=0 alt='Mover'></a></div></td>";
			  	print "</tr>";
			}

			/************************************ esto es agregado al dia 7-06-2006 se visualizan los documentos compartidos *****/

			//$SQL = "SELECT distinct(d.docu),du.du,d.titulo,concat(right(du.fecha,2),'/',month(du.fecha),'/',year(du.fecha)),concat(e1.nombres,' ',e1.apellidos) FROM doc d, docemple du,empleados e,empleados e1 WHERE e.idempleado=du.idempleado and d.docu=du.doc and du.idempleado = $usuario and du.quien =e1.idempleado and du.status=$carpet order by d.docu desc";
			$SQL = "SELECT distinct(c.idcorrespondencia),
						c.correlativo,
						c.titulo,
						convert(varchar,c.fechainicio,105),
						e1.nombre+' '+e1.apellido
					FROM correspondencia c, asesor e
					WHERE e.idasesor=c.idasesor2 and
						c.idasesorcrea = $usuario and
						c.carpeta=$carpet
					order by c.correlativo desc";

			$tmpusu = $usuario;

			if (intval($usuario)==2) $tmpusu = 123;
			$cad = " and c.carpeta not in (3,4) ";
			if ((intval($carpet)== 3) || (intval($carpet)==4)) $cad = " and
						c.carpeta=$carpet ";

			$SQL = "SELECT distinct(c.idcorrespondencia),
						c.correlativo,
						c.titulo,
						convert(varchar,c.fechainicio,105),
						e.nombre+' '+e.apellido,
						di.nombre 
					FROM correspondencia c, asesor e, direccion di
					WHERE e.idasesor=c.idasesor2  $cad and
						di.iddireccion = c.iddireccion and
						c.idcorrespondencia in (
							SELECT distinct(idcorrespondencia)
							FROM correspondencia_seguimiento
							WHERE idasesororigen=$usuario
					) order by c.correlativo desc";

//			print $SQL;
			$result = mssql_query($SQL); // elimina informacion temporal
			while($row = mssql_fetch_row($result))
			{
   				print " <tr onmouseover=cOn2(this); onmouseout=cOut2(this); > ";
				print "<td width='4%' >$row[5] $row[1]</td>";
				print "<td width='3%' ></td>";
				print "<td width='3%' ></td>";
				print "<td width='40%' ><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' > $row[2] </a></td>";
				print "<td width='10%' ><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[3]</a></td>";
				print "<td width='10%' ><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[4]</a></td>";
				print "<td width='4%'><div align='center'><a href ='transfiere/AsignaDeptos.php?docu=$row[0]' ><img src='img/tranferir.gif' width='16' height='16' border=0 alt='Transferir'></div></td>";
				print "<td width='4%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' ><img src='img/visualizar.gif' width='16' height='16' border=0 alt='Visualizar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='adjuntar/uploadForm.php?docu=$row[0]' ><img src='img/adjuntar.gif' width='16' height='16' border=0 alt='Adjuntar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='seguimiento/seguimiento.php?docu=$row[0]' ><img src='img/seguimiento.gif' width='16' height='16' border=0 alt='Seguimiento'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='imprimir/documento.php?docu=$row[0]' target='_blank'><img src='img/imprimir.gif' width='16' height='16' border=0 alt='Imprimir'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='mover/AsignaDeptosShare.php?docu=$row[0]&idDoc=$row[0]' ><img src='img/mover.gif' width='16' height='16' border=0 alt='Mover'></a></div></td>";
				//print "<td width='4%'><div align='center'><a href ='envioMuchos/detalle_accesosT.php?docu=$row[0]' ><img src='img/muchos.gif' width='16' height='16' border=0 alt='Transferir a Varios'></a></div></td>";
			  	print "</tr>";




			}


//			mssql_close($db);






  ?>

</table>
<p>&nbsp;</p>
</body>
</html>
