<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {font-size: 16px}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
body,td,th {
	font-size: 16px;
	color: #0033CC;
}
.Estilo2 {color: #003399}
.Estilo3 {
	font-size: 24px;
	font-weight: bold;
	color: #FF0000;
}
.Estilo4 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<?
session_start();
 $usuario = $_SESSION['codigoUsuario'];
 $fecha = date("Y-m-d");
 $hora = date("H:i:s");
		require ('conexion.inc');
		$db = mssql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mssql_select_db($BASE_DATOS,$db);
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 
			$SQL = "INSERT INTO bitaDocu(docu,usuario,hora,fecha) values ($docu,$usuario,'$hora','$fecha')";
			$result = mssql_query($SQL);
			//print "$SQL y $result";
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="100%"  border="1">
  <tr>
    <td>&nbsp;</td>
    <td><div align="center">
      <p class="Estilo1">Se transfirio correctamente la correspondencia </p>
      <p class="Estilo1">El numero del documento es: <span class="Estilo3">
	  <? 
	  	$SQL = "SELECT correlativo FROM correspondencia where idcorrespondencia=$docu";
		$result = mssql_query($SQL); 
		$row = mssql_fetch_row($result);
		$scorrelativo =  intval($row[0]);
		print $scorrelativo;
	  ?></span> </p>
      <p class="Estilo1"><a href="../imprimir/documento.php?docu=<? print $docu;?>" target="_blank" class="Estilo4">Imprimir Documento </a> </p>
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center" class="Estilo2"><a href="../center.php" class="Estilo1"><strong>Regresar</strong></a></p>
</body>
</html>
