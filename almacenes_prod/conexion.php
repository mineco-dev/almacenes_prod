<?php
//Configuracion de la conexion a base de datos
////ini_set('mssql.charset', 'UTF-8');
$bd_host = "ALMACEN-PC\DEV"; 
$bd_usuario = "sa"; 
$bd_password = "Sup3rus3r2009"; 
$bd_base = "almacen"; 
$con = mssql_connect($bd_host, 'sa', 'abc123'); 
mssql_select_db($bd_base, $con); 
?>