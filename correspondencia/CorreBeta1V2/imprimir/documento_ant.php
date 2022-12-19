<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "correBeta1V2/imprimir/";
	$_SESSION['pagina'] = $page;

	//include('../../security.php');
	print $_SESSION['iso_registro'];
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
body {
	background-image: url(file:///C|/Documents%20and%20Settings/PFuentes/Mis%20documentos/test/Fondo%20de%20Fiesta.jpg);
}
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
<?
		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		include('../../conectarse.php');
		
		$usuario = $_SESSION['codigoUsuario'];
		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);

//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
			$SQL = "UPDATE seguimiento SET status = 1 WHERE docu = $docu";
			$result = mssql_query($SQL); // elimina informacion temporal
			//$SQL = "SELECT docu,titulo,quien,insti,descr,ref FROM doc WHERE docu = $docu";

			//$SQL = "SELECT d.docu,d.titulo,d.quien,d.insti,d.descr,d.ref,s.fecha,d.corr FROM doc d,seguimiento s WHERE d.docu = $docu and s.docu=d.docu";
			$SQL = "SELECT c.idcorrespondencia,
							c.titulo,
							c.quien,
							c.insti,
							c.descr,
							c.ref,
							c.fechaenvio,
							c.correlativo,
							c.correlativoinicial
					FROM correspondencia c
					WHERE c.idcorrespondencia = $docu";
			//print $SQL;
			$result = mssql_query($SQL); // elimina informacion temporal
			$row = mssql_fetch_row($result);

?>
<body>
<p align="center" class="Estilo6">Correspondencia </p>
<form name="form1" method="post" action="../center.php">
  <div align="left">
    <table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr bgcolor="#000000">
        <td width="23%" bgcolor="#00CCFF"><div align="center"></div></td>
        <td width="77%" bgcolor="#00CCFF"><div align="left"><span class="Estilo3 Estilo4">Correspondencia</span></div></td>
      </tr>
      <tr>
        <td><div align="left" class="Estilo1">
            <div align="left" class="Estilo4">Titulo</div>
        </div></td>
        <td><div align="left">
            <? print $row[1]?>
        </div></td>
      </tr>
      <tr bgcolor="#000000">
        <td bgcolor="#00CCFF"><div align="center"></div></td>
        <td bgcolor="#00CCFF"><div align="left"><span class="Estilo3 Estilo4">Documento</span></div></td>
      </tr>
      <tr>
        <td><div align="left" class="Estilo4">Codigo Documento </div></td>
        <td><div align="left"><span lang="es-gt">
            <input name="docu" type="hidden" id="docu" value="<? print $row[0]?>"><span class="Estilo9">
            <? if ($row[8] == '-' ) { print $row[7]; } else { print $row[8]."/".$row[7]; }?></span></span></div></td>
      </tr>
      <tr bgcolor="#000000">
        <td bgcolor="#00CCFF"><div align="left"></div></td>
        <td bgcolor="#33CCFF"><div align="left" class="Estilo3">Detalle del Documento</div></td>
      </tr>
      <tr >
        <td ><div align="left" class="Estilo4"><strong>Quien Envia </strong></div></td>
        <td ><div align="left">
            <? print $row[2]?>
        </div></td>
      </tr>

        <td ><div align="left" class="Estilo4"><strong>Institucion</strong></div></td>
        <td ><div align="left">
            <? print $row[3]?>
        </div></td>
      </tr>
      <tr >
        <td><div align="left" class="Estilo4"><strong>Descripcion</strong></div></td>
        <td ><div align="left">
            <? print $row[4]?>
        </div></td>
      </tr>
      <tr >
        <td ><div align="left" class="Estilo4"><strong>Referencia</strong></div></td>
        <td ><div align="left">
          <? print $row[5]?> </div></td>
      </tr>
	   <tr >
        <td ><div align="left" class="Estilo4"><strong>Fecha de Ingreso</strong></div></td>
        <td ><div align="left">
          <? print $row[6]?> </div></td>
      </tr>
    </table>
  </div>

        <table width="100%" border="1" cellpadding="0" cellspacing="0">
        <tr bgcolor="#33CCFF">

          <td width="171"><div align="center"><span class="Estilo3 Estilo8">Documento</span></div></td>
          <td width="171"><div align="center"><span class="Estilo3 Estilo8">Descripci&oacute;n</span></div></td>
        </tr>
		<?
		 	$SQL12 = "SELECT da,nombre,descripcion,path FROM doc_adj WHERE   docu = $row[0]";
			$result = mssql_query($SQL12); // elimina informacion temporal
			while ($row1 = mssql_fetch_row($result))
			{
				 print " <tr>";
//		        print " <td>$row1[0]</td>";
		        print " <td><a href=../documento/upload/$row1[3] target='_blank' >$row1[1]</a></td>";
		        print " <td>$row1[2]</td>";
		      //  print " <td>Eliminar</td>";
		      print " </tr>";
			}
		?>
  </table>
        <p>&nbsp;</p>
        <table width="100%" border="0" cellspacing="0">
          <tr>
            <td>Transferir a:____________________________________________ </td>
            <td> <input type="checkbox" name="checkbox" value="checkbox">
            Corrdinador</td>
          </tr>
          <tr>
            <td><p>&nbsp;</p>
            <p>Observaci&oacute;n: ___________________________________________________</p>
            <p>________________________________________________________________</p>
            <p>_______________________________________________________________ </p></td>
            <td><p>Recibe:______________________________________</p>            </td>
          </tr>
        </table>
</form>
<p>&nbsp;</p>
<p align="center" class="Estilo6">Correspondencia </p>
<form name="form1" method="post" action="../center.php">
  <div align="left">
    <table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr bgcolor="#000000">
        <td width="23%" bgcolor="#00CCFF"><div align="center"></div></td>
        <td width="77%" bgcolor="#00CCFF"><div align="left"><span class="Estilo3 Estilo4">Correspondencia</span></div></td>
      </tr>
      <tr>
        <td><div align="left" class="Estilo1">
            <div align="left" class="Estilo4">Titulo</div>
        </div></td>
        <td><div align="left"> <? print $row[1]?> </div></td>
      </tr>
      <tr bgcolor="#000000">
        <td bgcolor="#00CCFF"><div align="center"></div></td>
        <td bgcolor="#00CCFF"><div align="left"><span class="Estilo3 Estilo4">Documento</span></div></td>
      </tr>
      <tr>
        <td><div align="left" class="Estilo4">Nombre</div></td>
        <td><div align="left"><span lang="es-gt">
            <input name="docu2" type="hidden" id="docu2" value="<? print $row[0]?>">
            <span lang="es-gt"><span class="Estilo9"><? print $row[7]?></span></span> </span></div></td>
      </tr>
      <tr bgcolor="#000000">
        <td bgcolor="#00CCFF"><div align="left"></div></td>
        <td bgcolor="#33CCFF"><div align="left" class="Estilo3">Detalle del Documento</div></td>
      </tr>
      <tr >
        <td ><div align="left" class="Estilo4"><strong>Quien Envia </strong></div></td>
        <td ><div align="left"> <? print $row[2]?> </div></td>
      </tr>
      <td ><div align="left" class="Estilo4"><strong>Institucion</strong></div></td>
          <td ><div align="left"> <? print $row[3]?> </div></td>
      </tr>
      <tr >
        <td><div align="left" class="Estilo4"><strong>Descripcion</strong></div></td>
        <td ><div align="left"> <? print $row[4]?> </div></td>
      </tr>
      <tr >
        <td ><div align="left" class="Estilo4"><strong>Referencia</strong></div></td>
        <td ><div align="left"> <? print $row[5]?> </div></td>
      </tr>
	  <tr >
        <td ><div align="left" class="Estilo4"><strong>Fecha que Ingreso</strong></div></td>
        <td ><div align="left"><strong> <? print $row[6]?> </strong></div></td>
      </tr>
    </table>
  </div>
  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr bgcolor="#33CCFF">
      <td width="171"><div align="center"><span class="Estilo3 Estilo8">Documento</span></div></td>
      <td width="171"><div align="center"><span class="Estilo3 Estilo8">Descripci&oacute;n</span></div></td>
    </tr>
    <?
		 	$SQL12 = "SELECT da,nombre,descripcion,path FROM doc_adj WHERE   docu = $row[0]";
			$result = mssql_query($SQL12); // elimina informacion temporal
			while ($row1 = mssql_fetch_row($result))
			{
				 print " <tr>";
//		        print " <td>$row1[0]</td>";
		        print " <td><a href=../documento/upload/$row1[3] target='_blank' >$row1[1]</a></td>";
		        print " <td>$row1[2]</td>";
		      //  print " <td>Eliminar</td>";
		      print " </tr>";
			}
		?>
  </table>
  <p>&nbsp;</p>
  <table width="100%" border="0" cellspacing="0">
    <tr>
      <td>Transferir a:____________________________________________ </td>
      <td>
        <input type="checkbox" name="checkbox2" value="checkbox">
        Corrdinador</td>
    </tr>
    <tr>
      <td><p>&nbsp;</p>
          <p>Observaci&oacute;n: ___________________________________________________</p>
          <p>________________________________________________________________</p>
          <p>_______________________________________________________________ </p></td>
      <td><p>Recibe:______________________________________</p></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
