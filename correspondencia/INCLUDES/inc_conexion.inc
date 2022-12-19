<?
$hostname_redes = "ALMACEN-PC\DEV";
$database_redes = "RRHH";
$username_redes = "sa";
$password_redes = "sa";
$conexion = mssql_connect($hostname_redes, 'sa', 'abc123');
//or die("no se puede conectar a SQL Server");
mssql_select_db($database_redes,$conexion);



function Conectarse($base)
{
//	if (!($conexion=@mysql_connect('172.17.1.28','escena','scn')))
	if (!($conexion=mssql_connect('ALMACEN-PC\DEV','sa', 'abc123')))
	{
		echo "Error conectando a la base de datos...";
		exit();
	}

	if (!mssql_select_db($base,$conexion))
	{
		echo "Error seleccionando la base de datos.";
		exit();
	}

	return $conexion;

}

//$conexion =Conectarse('RRHH');




?>