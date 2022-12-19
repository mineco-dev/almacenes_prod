<?php
# FileName="Connection_php_mssql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Conn = "ECORTES";
$database_Conn = "RRHH";
$username_Conn = "";
$password_Conn = "";
$Conn = mssql_pconnect($hostname_Conn, $username_Conn, $password_Conn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>