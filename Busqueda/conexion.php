<?php
function conectar(){
    //ini_set('mssql.charset', 'UTF-8');
    $user = "sa";
    $pass = "abc123";
    $server  ="ALMACEN-PC\DEV";
    $db = "almacen";
    $con =mssql_connect($server,$user,$pass,$db) or die ("Error al conectar a la base de datos");
    //mysqli_set_charset($con,"utf8");
    return $con;
}
?>