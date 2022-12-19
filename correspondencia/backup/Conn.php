<?php
# FileName="Connection_php_mssql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Conn = "SERVER_APPL";
$database_Conn = "MENSAJERIA";
$username_Conn = "msjharry";
$password_Conn = "lisa1607";
$Conn = mssql_pconnect($hostname_Conn, $username_Conn, $password_Conn) or trigger_error(mysql_error(),E_USER_ERROR); 


		

?>