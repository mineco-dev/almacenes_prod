<?php
//initialize the session
session_start();

$_SESSION['nivel']=1;
include('valida.php');


// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}

include('INCLUDES/inc_header.inc');
$dbms=new DBMS($conexion); 


$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}

//mssql_select_db($database_Conn, $Conn);

$query_Recordset1 = sprintf("SELECT * FROM asesor WHERE usuario = '%s'", $colname_Recordset1);
$Recordset1 = mssql_query($query_Recordset1)  or die(mssql_error());
$row_Recordset1 = mssql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mssql_num_rows($Recordset1);



echo $row_Recordset1['nombre'];
?>



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
//session_start();
// $usuario = $_SESSION['ID'];
		
 $fecha = date("Y-m-d");
 $hora = date("H:i:s");

		
//require ('conexion.inc');
//		$db = mssql_connect($SERVIDOR,$USUARIO,$PASSWORD);
//		mssql_select_db($BASE_DATOS,$db);



//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 

			$sql="INSERT INTO bitadocu(docu,usuario,hora,fecha) values ($_SESSION[correlativo],$usuario,'$hora','$fecha')";


			$res = mssql_query($sql); 
//print $sql;print $_SESSION['correlativo'];

			//$result = mssql_query($SQL);.
			

//print "$SQL y $result";
?>


<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="100%"  border="1">
  <tr>
    <!--td>&nbsp;</td-->
    <td><div align="center">
      <p class="Estilo1">Se transfirio correctamente la correspondencia </p>
      <p class="Estilo1">El numero del documento es: <span class="Estilo3">
	  

<? 
	  	$sql = "SELECT correlativo FROM correspondencia where idcorrespondencia=$docu";
		$resu = mssql_query($sql); 
//		print mssql_num_rows($resu);

		//$result = mssql_query($SQL); 
		$row = mssql_fetch_row($resu);
		$scorrelativo =  intval($row[0]);
		print $scorrelativo;

	  ?></span> </p>
      <p class="Estilo1"><a href="CorreBeta1V2/imprimir/documento.php?docu=<? print $docu;?>" target="_blank" class="Estilo4">Imprimir Documento </a> </p>
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center" class="Estilo2"><a href="CorreBeta1V2/center.php" class="Estilo1"><strong>Regresar</strong></a></p>
</body> 
</html>
