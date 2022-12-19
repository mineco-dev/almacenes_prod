<?php
// $myserver="ALMACEN-PC\DEV"; 
// $myuser="test2010";
// $mypass="test2010";
// $mydb="helpdesk";
// $s=mssql_connect($myserver, 'sa', 'abc123') or die ("no se pudo conectar al servidor $myserver");
	$myserver="128.5.8.85"; 
	$myuser="dev";
	$mypass="12345678";
	$mydb="helpdesk_nuevo_qa";


$s=mssql_connect($myserver, $myuser, $mypass) or die ("no se pudo conectar al servidor" .mssql_get_last_message());
$d=mssql_select_db($mydb, $s);
//variables para manejo de base de datos
$query="mssql_query";
$fetch_array="mssql_fetch_array";
$close="mssql_close";
?>