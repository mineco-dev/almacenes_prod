<?php
//Configuracion de la conexion a base de datos
$bd_host = "server_appl"; 
$bd_usuario = "sa"; 
$bd_password = "Sup3rus3r2009"; 
$bd_base = "almacen"; 
$con = mssql_connect($bd_host, $bd_usuario, $bd_password); 
mssql_select_db($bd_base, $con); 
?>