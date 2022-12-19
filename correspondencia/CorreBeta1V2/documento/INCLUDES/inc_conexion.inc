
<?
$hostname_redes = "ecortes";
$database_redes = "RRHH";
$username_redes = "";
$password_redes = "";
$conexion = mssql_connect($hostname_redes,$username_redes,$password_redes) or die("no se puede conectar a SQL Server");
mssql_select_db($database_redes,$conexion);
?>