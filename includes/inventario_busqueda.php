<?
	//session_start();
	
	$hostname_cnn = "server_appl";
	$database_cnn = "inventario";
	$username_cnn = "inventario_busqueda";
	$password_cnn = "inv3ntar1o";
	$conexion = mysql_connect($hostname_cnn,$username_cnn,$password_cnn);
	mysql_select_db($database_cnn);


/*	$hostname_cnn1 = "server_appl";
	$database_cnn1 = "rrhh";
	$username_cnn1 = "rrhh_busqueda";
	$password_cnn1 = "33hh1";
	$conexion = mysql_connect($hostname_cnn1,$username_cnn1,$password_cnn1);
	mysql_select_db($database_cnn1);*/

	
?>