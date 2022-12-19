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
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 24px;
}
-->
</style>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo5 {
	font-size: 16pt;
	color: #3366CC;
	font-weight: bold;
}
.Estilo18 {	font-size: 18px;
	font-weight: bold;
}
.Estilo7 {
	font-size: x-small;
	color: #660033;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
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
<?
// esto se debera de quita rya que el proyecto ya trae la varible de session
/*session_start();
session_register();
$_SESSION['codigoUsuario'] = 1;*/
/*****
campo carpet
 0 en inbox
 1 bandeja de salida
 2 Finalizados

******/
?>
<!-- <META HTTP-EQUIV=Refresh CONTENT="10">  -->
<body>
<table width="100%" class="Estilo21">
	<td align="left" bgcolor="#990000" width="15%" class="Estilo21" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
	</td>
	<td align="right">
		<p align="right"><span class="Estilo18"><a href="../center.php"><span class="Estilo21"><-- Regresar al Menu</span></a></span></p>
	</td>
</table>
<table width="100%"  border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td> <div align="center" class="Estilo5">
      <div align="center">CORRESPONDENCIA  MINISTERIO DE ECONOMIA  </div>
    </div></td>
  </tr>
</table>
<table width="100%"  border="0">
  <tr>
    <td colspan="8" bgcolor="#0033FF"><div align="center"><span class="Estilo1">Correspondencia - Resultado de Busqueda - </span></div></td>
  </tr>

  <?
   	print " <tr > ";
				print "<td width='3%'></td>";
				print "<td width='3%'></td>";
				print "<td width='3%'></td>";
				print "<td width='40%'>Titulo</td>";
				print "<td width='10%'>Fecha</td>";
				print "<td width='10%'>Quien Envia</td>";
/*				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";*/
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
			  	print "</tr>";

		$usuario = $_SESSION['codigoUsuario'];


		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);

		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
//		include('../../conectarse.php');



//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
////           esto se modifico... 21/03/2006
//			$SQL = "SELECT d.docu,s.status,d.titulo FROM doc d, seguimiento s WHERE d.docu=s.docu and s.aquien = $usuario and s.carpet=0 group by d.docu order by s.fecha desc";
//			$SQL = "SELECT d.docu,s.status,d.titulo,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado=s.idempleado and d.docu=s.docu and s.aquien = $usuario and s.carpet=0 order by d.docu desc";
			//print $cboCriterio;
//			print $txtCriterio;

			switch ($cboCriterio)
			{
				case 1:  // busqueda por codigo

			if ($txtCriterio == null )
			{
			envia_msg('EL CRITERIO DE BUSQUEDA NO PUEDE SER NULO');
			cambiar_ventana('documento.php');

		exit;  
		   }		
					$SQL = "SELECT c.idcorrespondencia,
								c.status,
								c.titulo,
								s.fecha,
								e.nombre+' '+e.apellido
								FROM correspondencia c, correspondencia_seguimiento s,asesor e
								WHERE s.idasesororigen=e.idasesor and
									c.idcorrespondencia=s.idcorrespondencia and
									c.correlativo=$txtCriterio
								order by c.idcorrespondencia desc";
//									c.idcorrespondencia=$txtCriterio								
//					print $SQL;
				break;
				case 2: // busqueda por fecha
					if ($fecha == null )
								{
								envia_msg('EL CRITERIO DE BUSQUEDA NO PUEDE SER NULO');
								cambiar_ventana('documento.php');
					
							exit;  
							   }		

					$fec = split("/",$txtCriterio);
					$fecha = $fec[2]."/".$fec[1]."/".$fec[0];
					/*$SQL = "SELECT d.docu,s.status,
							d.titulo, s.fecha,
							e.nombre+' '+e.apellido
							FROM doc d, seguimiento s,asesor e
							WHERE e.idasesor=s.idasesor and
								d.docu=s.docu and
								s.fecha='$fecha'
							order by d.docu desc";*/
					

						$SQL = "SELECT c.idcorrespondencia,
						c.status,
						c.titulo,
						s.fecha,
						e.nombre+' '+e.apellido
						FROM correspondencia c, correspondencia_seguimiento s,asesor e
						WHERE s.idasesororigen=e.idasesor and
							c.idcorrespondencia=s.idcorrespondencia and
							s.fecha='$fecha'
						order by c.idcorrespondencia desc";
				break;
				case 3:  // por titulo
					if ($txtCriterio == null )
								{
								envia_msg('EL CRITERIO DE BUSQUEDA NO PUEDE SER NULO');
								cambiar_ventana('documento.php');
					
							exit;  
							   }		

					$SQL = "SELECT d.docu,s.status,d.titulo,s.fecha,
							e.nombre+' '+e.apellido FROM doc d, seguimiento s,asesor e 
							WHERE e.idasesor=s.idasesor and d.docu=s.docu and
					d.titulo like '%$txtCriterio%' order by d.docu desc";
					$SQL = "SELECT c.idcorrespondencia,
						c.status,
						c.titulo,
						s.fecha,
						e.nombre+' '+e.apellido
						FROM correspondencia c, correspondencia_seguimiento s,asesor e
						WHERE s.idasesororigen=e.idasesor and
							c.idcorrespondencia=s.idcorrespondencia and
							c.titulo like '%$txtCriterio%'
						order by c.idcorrespondencia desc";
				break;
				case 4:  // quien envia

if ($cboEmpleado == null )
			{
			envia_msg('EL CRITERIO DE BUSQUEDA NO PUEDE SER NULO');
			cambiar_ventana('documento.php');

		exit;  
		   }		

					$SQL = "SELECT d.docu,s.status,d.titulo,s.fecha,
					e.nombre+' '+e.apellido FROM doc d, seguimiento s,asesor e 
					WHERE e.idasesor=s.idasesor and d.docu=s.docu and s.idasesor = $cboEmpleado order by d.docu desc";
					$SQL = "SELECT c.idcorrespondencia,
						c.status,
						c.titulo,
						s.fecha,
						e.nombre+' '+e.apellido
						FROM correspondencia c, correspondencia_seguimiento s,asesor e
						WHERE s.idasesororigen=e.idasesor and
							c.idcorrespondencia=s.idcorrespondencia and
							s.idasesororigen = $cboEmpleado
						order by c.idcorrespondencia desc";
				break;
				case 5:
					//$SQL = "SELECT d.docu,s.status,d.titulo,concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha)),concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado=s.idempleado and d.docu=s.docu and s.aquien =  $cboEmpleado order by d.docu desc";

if ($cboEmpleado == null )
			{
			envia_msg('EL CRITERIO DE BUSQUEDA NO PUEDE SER NULO');
			cambiar_ventana('documento.php');

		exit;  
		   }		

					$SQL = "SELECT c.idcorrespondencia,
						c.status,
						c.titulo,
						s.fecha,
						e.nombre+' '+e.apellido
						FROM correspondencia c, correspondencia_seguimiento s,asesor e
						WHERE s.idasesororigen=e.idasesor and
							c.idcorrespondencia=s.idcorrespondencia and
							s.idasesordestino = $cboEmpleado
						order by c.idcorrespondencia desc";
				break;
			}




//			print $SQL;
			$result = mssql_query($SQL); // elimina informacion temporal
			//print "$SQL datos  $result";
			while($row = mssql_fetch_row($result))
			{

				switch($row[1])
				{
				   case 0: $figura = "mnoleido.gif";break;
				   case 1: $figura = "mleido.gif";break;
				   case 2: $figura = "mTrans.gif";break;
				}
			 	print " <tr onmouseover=cOn(this); onmouseout=cOut(this);> ";
				print "<td width='3%'>$row[0]</td>";
				print "<td width='3%'><div align='center'><a href ='../seguimiento/seguimiento.php?docu=$row[0]'' ><img src='../img/$figura' width='16' height='16' border=0></div></a></td>";
				print "<td width='3%'><div align='center'><img src='../img/djuntos.gif' width='16' height='16' border=0></div></td>";
				print "<td width='30%'><a href ='../seguimiento/seguimiento.php?docu=$row[0]'' >$row[2]</a></td>";
				print "<td width='10%'><a href ='../seguimiento?deguimiento.php?docu=$row[0]'' >$row[3]</a></td>";
				print "<td width='20%'><a href ='../seguimiento/seguimiento.php?docu=$row[0]'' >$row[4]</a></td>";
				//print "<td width='4%'><div align='center'><a href ='../transfiere/AsignaDeptos.php?docu=$row[0]' ><img src='../img/tranferir.gif' width='16' height='16' border=0 alt='Transferir'></div></td>";
				print "<td width='4%'><div align='center'><a href ='../visualiza/documento.php?docu=$row[0]&quien=$row[4]' ><img src='../img/visualizar.gif' width='16' height='16' border=0 alt='Visualizar'></a></div></td>";
				//print "<td width='4%'><div align='center'><a href ='../adjuntar/uploadForm.php?docu=$row[0]' ><img src='../img/adjuntar.gif' width='16' height='16' border=0 alt='Adjuntar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='../seguimiento/seguimiento.php?docu=$row[0]' ><img src='../img/seguimiento.gif' width='16' height='16' border=0 alt='Seguimiento'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='../imprimir/documento.php?docu=$row[0]' target='_blank'><img src='../img/imprimir.gif' width='16' height='16' border=0 alt='Imprimir'></a></div></td>";
				//print "<td width='4%'><div align='center'><a href ='../mover/AsignaDeptos.php?docu=$row[0]' ><img src='../img/mover.gif' width='16' height='16' border=0 alt='Mover'></a></div></td>";
			  	print "</tr>";
			}
			//mysql_close($db);
  ?>

</table>
<p>&nbsp;</p>
</body>
</html>
