<?php
//Configuracion de la conexion a base de datos
$bd_host = "me-s-soporte"; 
$bd_usuario = "sa"; 
$bd_password = "a$eggy$"; 
$bd_base = "almacen"; 
//ini_set('mssql.charset', 'UTF-8');
$con = mssql_connect($myserver, 'sa','a$eggy$'); 
mssql_select_db($bd_base, $con); 
?>