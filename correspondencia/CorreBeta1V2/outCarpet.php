<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "correBeta1V2/";
	$_SESSION['pagina'] = $page;

	include('../security.php');
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
.Estilo2 {font-size: 14px}
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
session_start();
session_register();
$_SESSION['codigoUsuario'] = 1;

?>
<body>

<p>&nbsp;</p>
<table width="100%"  border="0">
  <tr>
    <td><a href="documento/ingresaDocument.php" class="Estilo2">Crear Correpondencia </a></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="5">
        <tr>
          <td height="28"><p align="center"> <img src="img/eargroup_obj.gif" width="16" height="16"> Bandeja de Entrada</p></td>
          <td><div align="center"> <a href="outCarpet.php"><img src="img/form_login_config.gif" width="16" height="16" border="0"> Bandeja de Salida </a></div></td>
          <td><div align="center"> <img src="img/jworkingSet_obj.gif" width="16" height="16"> Documentos Finalizados </div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#333333">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="5">
        <tr>
          <td><p align="center"><img src="img/adjuntar.gif" width="16" height="16"> Adjuntar </p></td>
          <td><div align="center"><img src="img/imprimir.gif" width="16" height="16"> Imprimir </div></td>
          <td><div align="center"><img src="img/mover.gif" width="16" height="16"> Mover </div></td>
          <td><div align="center"><img src="img/seguimiento.gif" width="16" height="16"> Seguimiento </div></td>
          <td><div align="center"><img src="img/tranferir.gif" width="16" height="16"> Transferir </div></td>
          <td><div align="center"><img src="img/visualizar.gif" width="16" height="16"> Visualizar</div></td>
        </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%"  border="0">
  <tr>
    <td colspan="8" bgcolor="#000000"><div align="center"><span class="Estilo1">Bandeja de Salida</span></div></td>
  </tr>
  <?
  session_start();
		$usuario = $_SESSION['codigoUsuario'];
		require ('conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
			$SQL = "SELECT d.docu,s.status,d.titulo FROM documento d, seguimiento s WHERE d.docu=s.docu and s.aquien = $usuario and s.carpet=1 group by d.docu order by s.fecha desc";
			$result = mysql_query($SQL); // elimina informacion temporal

			while($row = mysql_fetch_row($result))
			{

				switch($row[1])
				{
				   case 0: $figura = "mnoleido.gif";break;
				   case 1: $figura = "mleido.gif";break;
				   case 2: $figura = "mTrans.gif";break;
				}
			 	print " <tr onmouseover=cOn(this); onmouseout=cOut(this);> ";
				print "<td width='3%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]' ><img src='img/$figura' width='16' height='16' border=0></div></a></td>";
				print "<td width='3%'><div align='center'><img src='img/djuntos.gif' width='16' height='16' border=0></div></td>";
				print "<td width='60%'><a href ='visualizaococumento.php?docu=$row[0]' >$row[2]</a></td>";
				print "<td width='4%'><div align='center'><a href ='transfiere/AsignaDeptos.php?docu=$row[0]' ><img src='img/tranferir.gif' width='16' height='16' border=0 alt='Transferir'></div></td>";
				print "<td width='4%'><div align='center'><a href ='visualiza/documento.php?docu=$row[0]' ><img src='img/visualizar.gif' width='16' height='16' border=0 alt='Visualizar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='adjuntar/uploadForm.php?docu=$row[0]' ><img src='img/adjuntar.gif' width='16' height='16' border=0 alt='Adjuntar'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='seguimiento/seguimiento.php?docu=$row[0]' ><img src='img/seguimiento.gif' width='16' height='16' border=0 alt='Seguimiento'></a></div></td>";
				print "<td width='4%'><div align='center'><a href ='imprimir/documento.php?docu=$row[0]' ><img src='img/imprimir.gif' width='16' height='16' border=0 alt='Imprimir'></a></div></td>";
				print "<td width='4%'><div align='center'><img src='img/mover.gif' width='16' height='16' border=0></div></td>";
			  	print "</tr>";
			}
			mysql_close($db);
  ?>

</table>
<p>&nbsp;</p>
</body>
</html>
