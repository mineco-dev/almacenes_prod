<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "correBeta1V2/";
	$_SESSION['pagina'] = $page;

//	include('../security.php');
	print $_SESSION['iso_registro'];
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
	color: #0000FF;
	font-weight: bold;
	font-size: 14px;
}
.Estilo4 {
	color: #0033FF;
	font-size: 14px;
}
.Estilo5 {
	font-size: 16pt;
	color: #3366CC;
	font-weight: bold;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo13 {
	color: #999999;
	font-size: 12px;
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



function cOn2(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#D3E8EF";
}
}

function cOut2(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#99FF99";
}
}

//-->
</SCRIPT>
</head>
<?
?>
<!-- <META HTTP-EQUIV=Refresh CONTENT="10">  -->
<body>
<table border="0" width="100%">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right" class="Estilo18">
		<a href="center.php"><img src="tareas.gif" width="16" height="16" border="0">Regresar al Menu</a>
		</td>
	</tr>
</table>
<p>&nbsp;</p>
<table width="100%"  border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td> <div align="center" class="Estilo5">Correspondencia Ministerio de Econom�a </div></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
                 <td width="4%" bgcolor="#0099FF"><span class="Estilo3">Menu</span></td>
          <td width="19%" height="28" bgcolor="#0099FF"><p align="center"><a href="documento/ingresaDocument.php" class="Estilo2">Crear Correpondencia </a><span class="Estilo13"><a href="imprimir/fecha.php?docu=<? print $docu;?>" target="_blank">Reporte</a> <a href="temporal_corres.php?docu=<? print $docu;?> class="Estilo4">Temporal</a> </span> </p>          </td>
          <td width="19%" bgcolor="#0099FF"><a href="center.php"><img src="img/muchos.gif" width="16" height="16" border="0"> Bandeja de Entrada</a></td>
          <td width="17%" bgcolor="#0099FF"><div align="center"><a href="otherCarpet.php?carpet=2&mensaje=Bandeja Correspondencia de Salida"><img src="img/form_login_config.gif" width="16" height="16" border="0"> Bandeja de Salida </a></div></td>
          <td width="16%" bgcolor="#0099FF"><div align="center"><a href="otherCarpet.php?carpet=4&mensaje=Bandeja de Correspondecia Almacenada"><img src="img/j2ee_view.gif" width="16" height="16" border="0"> Correspondencia Almacenada</a></div></td>
          <td width="8%" bgcolor="#0099FF"><span class="Estilo4"><img src="img/container.gif" width="15" height="17"> </span><a href="buscar/documento.php">Busca</a><span class="Estilo4"><a href="buscar/documento.php">r </a></span></td>
          <td width="17%" bgcolor="#0099FF"><div align="center"><a href="otherCarpet.php?carpet=3&mensaje=Bandeja de Correspondencia Finalizada"><img src="img/jworkingSet_obj.gif" width="16" height="16" border="0"> Correspondencia Finalizada</a> </div></td>
        </tr>

    </table></td>
  </tr>
  <tr>
    <td bgcolor="#0066FF">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0">
      <tr>
        <td><p align="center"><img src="img/adjuntar.gif" width="16" height="16"> Adjuntar </p>
          </td>
        <td><div align="center"><img src="img/imprimir.gif" width="16" height="16"> Imprimir </div></td>
        <td><div align="center"><img src="img/mover.gif"htidth="16" height="16"> Mover </div></td>
        <td><div align="center"><img src="img/seguimiento.gif" width="16" height="16"> Seguimiento </div></td>
        <td><div align="center"><img src="img/tranferir.gif" width="16" height="16"> Transferir </div></td>
        <td><div align="center"><img src="img/visualizar.gif" width="16" height="16"> Visualizar</div></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0">
  <tr>
    <td colspan="8" bgcolor="#0033FF"><div align="center"><span class="Estilo1">Correspondencia</span></div></td>
  </tr>

  <?
   	print " <tr > ";
				print "<td width='3%'></td>";
				print "<td width='3%'></td>";
				print "<td width='3%'></td>";
				print "<td width='40%'>Titulo</td>";
				print "<td width='10%'>Fecha</td>";
				print "<td width='10%'>Quien Envia</td>";
				print "<td width='10%'>Correlativo</td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
				print "<td width='4%'></td>";
			  	print "</tr>";
  session_start();
		$usuario = $_SESSION['codigoUsuario'];
		

		include('../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		include('../conectarse.php');

		//require ('conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);


			/*$SQL = "SELECT
					c.idcorrespondencia,
					c.status,
					c.titulo,
					concat(right(c.fechaenvio,2),'/',month(c.fechaenvio),'/',year(c.fechaenvio)),
					c.correlativo
					FROM correspondencia c
					WHERE c.idempleado1 = $usuario and
						  (c.carpeta = 3 or c.carpeta = 2)
					order by c.correlativo desc";*/




$SQL = "SELECT
					c.idcorrespondencia,
					c.status,
					c.titulo,
					c.fechaenvio,
					c.correlativo
					FROM correspondencia c
					WHERE c.idasesor = $usuario and
						  (c.carpeta = 3 or c.carpeta = 2)
					order by c.correlativo desc";


			$result = mssql_query($SQL);
			while($row = mssql_fetch_row($result))
			{

				switch($row[1])
				{
				   case 0: $figura = "mnoleido.gif";break;
				   case 1: $figura = "mleido.gif";break;
				   case 2: $figura = "mTrans.gif";break;
				}
			 	print " <tr onmouseover=cOn(this); onmouseout=cOut(this);> ";
				print "<td width='3%'>$row[6]</td>";
				print "<td width='3%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' ><img src='img/$figura' width='16' height='16' border=0></div></a></td>";
				print "<td width='3%'><div align='center'><img src='img/djuntos.gif' width='16' height='16' border=0></div></td>";
				print "<td width='30%'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[2]</a></td>";
				print "<td width='10%'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[3]</a></td>";
				print "<td width='20%'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[4]</a></td>";
				print "<td width='10%'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[5]</a></td>";
				print "<td width='4%'><div align='center'><a href ='transfiere/AsignaDeptos.php?docu=$row[0]' ><img src='img/tranferir.gif' width='16' height='16' border=0 alt='Transferir'></div></td>";
				print "<td width='4%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' ><img src='img/visualizar.gif' width='16' height='16' border=0 alt='Visualizar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='adjuntar/uploadForm.php?docu=$row[0]' ><img src='img/adjuntar.gif' width='16' height='16' border=0 alt='Adjuntar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='seguimiento/seguimiento.php?docu=$row[0]' ><img src='img/seguimiento.gif' width='16' height='16' border=0 alt='Seguimiento'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='imprimir/documento.php?docu=$row[0]' target='_blank'><img src='img/imprimir.gif' width='16' height='16' border=0 alt='Imprimir'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='mover/AsignaDeptos.php?docu=$row[0]' ><img src='img/mover.gif' width='16' height='16' border=0 alt='Mover'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='envioMuchos/detalle_accesosT.php?docu=$row[0]' ><img src='img/muchos.gif' width='16' height='16' border=0 alt='Transferir a Varios'></a></div></td>";
			  	print "</tr>";
			}
			//mysql_close($db);
  ?>

</table>
<p>&nbsp;</p>
</body>
</html>
