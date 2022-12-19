<?PHP
$hostname_redes = "server_appl";
$database_redes = "almacen";
$username_redes = "sa";
$password_redes = "Sup3rus3r2009";
$conexion = mssql_connect($hostname_redes,$username_redes,$password_redes) or die("no se puede conectar a SQL Server");
mssql_select_db($database_redes,$conexion);
?>