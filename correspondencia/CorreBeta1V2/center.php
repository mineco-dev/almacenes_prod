<?
	session_start();
/* 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
*/
//include('../conectarse.php');
//envia_msg($_SESSION['usr_val']);
//envia_msg($_SESSION['nivel']);
//envia_msg($nivel);
$_SESSION['nivel']=4;
//include('valida.php');
include('../valida.php');


if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}


	$_SESSION['folder'] = "correBeta1V2/";
	$_SESSION['pagina'] = $page;
//include('conectarse.php');

	//include('../security.php');
	//print $_SESSION['iso_registro'];
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
.Estilo4 {
	color: #0066CC;
	font-size: 14px;
}
.Estilo5 {
	font-size: 16pt;
	color: #3366CC;
	font-weight: bold;
}
.Estilo6 {color: #0066CC}
.Estilo2 {color: #000000}
.Estilo7 {font-size: 14px}
a:link {
	color: #000033;
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
		<td align="right"  width="70%">
		<a href="../visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Regresar al Menu ]</a>
		</td>

		<!--td align="right" class="Estilo18">
		<a href="../mtlogin.php">[ Cerrar Sesión ]</a>
		</td-->
	</tr>
</table>
<table width="100%"  border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td>
      <!--div align="center" class="Estilo5"><a href="hoja_informacion.php"><img src="img/ayuda.jpg" width="26" height="18" border =0></a> Correspondencia Ministerio de Econom&iacute;a </div></td-->
	  <div align="center" class="Estilo5"><a href="manual_correspondencia.pdf" target="_blank"><img src="img/ayuda.jpg" width="26" height="18" border =0></a> Correspondencia Ministerio de Econom&iacute;a </div></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr background="Fondo de Fiesta.jpg">
          <td width="5%" bgcolor="#B4C4EF"><span class="Estilo3">Menu</span></td>
          <td width="14%" height="28" bgcolor="#B4C4EF"><p align="center"><a href="documento/ingresaDocument.php" >Crear Correpondencia </a></p></td>
		  <Td width="6%" height="28" bgcolor="#B4C4EF" align="center"><p align="center"><a href="imprimir/fecha.php?docu=<? print $docu;?>" target="_blank">Reporte</a>         </p></td>

<!--esto fue lo que quite del temporal   aqui empieza el codigo    <a href="temporal_corres.php?docu=<? print $docu;?> class="estilo4">Temporal</a>    -->

          <td width="16%" bgcolor="#B4C4EF"><div><a href="center.php" class="Estilo6"><img src="img/muchos.gif" width="16" height="16" border="0"> <strong>Bandeja de Entrada</strong></a></div></td>
          <td width="18%" bgcolor="#B4C4EF"><div align="center" class="Estilo6"><a href="otherCarpet.php?carpet=2&mensaje=Bandeja Correspondencia de Salida"><img src="img/form_login_config.gif" width="16" height="16" border="0"> Bandeja de Salida </a></div></td>
          <td width="17%" bgcolor="#B4C4EF"><div align="center" class="Estilo6"><a href="otherCarpet.php?carpet=4&mensaje=Bandeja de Correspondecia Almacenada"><img src="img/j2ee_view.gif" width="16" height="16" border="0"> Correspondencia Almacenada</a></div></td>
          <td width="17%" bgcolor="#B4C4EF"><div align="center" class="Estilo6"><a href="otherCarpet.php?carpet=3&mensaje=Bandeja de Correspondencia Finalizada"><img src="img/jworkingSet_obj.gif" width="16" height="16" border="0"> Correspondencia Finalizada</a> </div></td>
          <td width="9%" bgcolor="#B4C4EF"><span class="Estilo4"><img src="img/container.gif" width="15" height="17"> </span><span class="Estilo6"><a href="buscar/documento.php">Buscar</a></span></td>
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
          <td><div align="center"> <img src="img/adjuntar.gif" width="16" height="16"> Adjuntar </div></td>
          <td><div align="center"><img src="img/seguimiento.gif" width="16" height="16"> Seguimiento </div></td>
          <td><div align="center"><img src="img/imprimir.gif" width="16" height="16"> Imprimir </div></td>
          <td><div align="center"> <img src="img/mover.gif" width="16" height="16"> Mover </div></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0">
  <tr>
    <td colspan="8" bgcolor="#0033FF"><div align="center"><span class="Estilo1">Correspondencia Entrante</span></div></td>
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
		$usuario = $_SESSION['codigoUsuario'];
//		require ('conexion.inc');
//		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
//		mysql_select_db($BASE_DATOS,$db);


	include('../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
//	include("../conectarse.php");

/*			$SQL = "SELECT
					c.idcorrespondencia,
					c.status,
					c.titulo,
					concat(right(c.fechaenvio,2),'/',month(c.fechaenvio),'/',year(c.fechaenvio)),
					concat(e.nombres,' ',e.apellidos),
					concat(di.nombre),
					c.correlativoinicial
					FROM correspondencia c, empleados e ,direccion di
					WHERE e.idempleado=c.idempleado1 and
						  c.idempleado2 = $usuario and
						  c.carpeta = 1 and
						  di.iddireccion = c.iddireccion
					order by c.correlativo desc";*/

			$SQL = "SELECT
					c.idcorrespondencia,
					c.status,
					c.titulo,
					convert(varchar,c.fechaenvio,105),
					e.nombre+' '+e.apellido,
					c.correlativoinicial,
					di.nombre, 
					c.correlativo
					FROM correspondencia c, asesor e ,direccion di
					WHERE e.idasesor=c.idasesor and
						  c.idasesor2 = $usuario and
						  c.carpeta = 1 and
						  di.iddireccion = c.iddireccion
					order by c.correlativo desc";
		//print $SQL;
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
				print "<td width='3%'>$row[6] $row[7]</td>";
				print "<td width='3%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' ><img src='img/$figura' width='16' height='16' border=0></div></a></td>";
				print "<td width='3%'><div align='center'><img src='img/djuntos.gif' width='16' height='16' border=0></div></td>";
				print "<td width='30%'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[2]</a></td>";
				print "<td width='10%'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[3]</a></td>";
				print "<td width='20%'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[4]</a></td>";
				print "<td width='10%'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' >$row[6] $row[7]</a></td>";
				print "<td width='4%'><div align='center'><a href ='transfiere/AsignaDeptos.php?docu=$row[0]' ><img src='img/tranferir.gif' width='16' height='16' border=0 alt='Transferir'></div></td>";
				print "<td width='4%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]&quien=$row[4]' ><img src='img/visualizar.gif' width='16' height='16' border=0 alt='Visualizar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='adjuntar/uploadForm.php?docu=$row[0]' ><img src='img/adjuntar.gif' width='16' height='16' border=0 alt='Adjuntar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='seguimiento/seguimiento.php?docu=$row[0]' ><img src='img/seguimiento.gif' width='16' height='16' border=0 alt='Seguimiento'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='imprimir/documento.php?docu=$row[0]' target='_blank'><img src='img/imprimir.gif' width='16' height='16' border=0 alt='Imprimir'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='mover/AsignaDeptos.php?docu=$row[0]' ><img src='img/mover.gif' width='16' height='16' border=0 alt='Mover'></a></div></td>";
//				print "<td width='4%'><div align='center'><a href ='envioMuchos/detalle_accesosT.php?docu=$row[0]' ><img src='img/muchos.gif' width='16' height='16' border=0 alt='Transferir a Varios'></a></div></td>";
			  	print "</tr>";
			}
			mssql_close($conexion);
  ?>

</table>
<p>&nbsp;</p>
</body>
</html>
