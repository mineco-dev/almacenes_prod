<?PHP

	$myserver="server_appl";
	//print(server_appl);
	$myuser="test2010";
	$mypass="test2010";
	$mydb="helpdesk";

/*	$myserver="me-s-portal";
	$myuser="test2010";
	$mypass="test2010";
	$mydb="helpdesk";*/
	//ini_set('mssql.charset', 'UTF-8');
$s=mssql_connect($myserver, $myuser,$mypass) or die ("no se pudo conectar al servidor $myserver");
$d=mssql_select_db($mydb, $s);
//variables para manejo de base de datos
$query="mssql_query";
$fetch_array="mssql_fetch_array";
$close="mssql_close";


?>