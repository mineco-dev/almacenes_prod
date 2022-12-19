<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_redes = "ECORTES";
$database_redes = "RRHH";
//$username_redes = "sinfodace";
//$password_redes = "dace";
$username_redes = "";
$password_redes = "";

//$mysql_select_db("sinfodace");
//$redes = mysql_connect("localhost","1234","1234");


mssql_connect($hostname_redes,$username_redes,$password_redes);
//mysql_select_db($database_redes);
//$redes = mysql_pconnect($hostname_redes, $username_redes, $password_redes) or trigger_error(mysql_error(),E_USER_ERROR); 
?>