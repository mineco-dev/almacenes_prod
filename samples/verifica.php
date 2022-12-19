<?
session_start(); 
$query="mssql_query";
$fetch_array="mssql_fetch_array";
$close="mssql_close";
$connect="mssql_connect";
$select_db="mssql_select_db";
// $myserver="server_appl";
$myserver="128.5.8.85";
	$bd_usuario = "dev"; 
	$bd_password = "12345678"; 
function conectardb($grupo_rol)
{	
	if (isset($_SESSION["param_conexion"]))
	{
		$grupos=count($_SESSION["param_conexion"]);
		$i=1;
		while ($i<=$grupos)
		{
			if ($_SESSION["param_conexion"]["$i"][3]==$grupo_rol)
			{
				$myuser=$_SESSION["param_conexion"]["$i"][1];
				$mypass=$_SESSION["param_conexion"]["$i"][2];
				$mydb=$_SESSION["param_conexion"]["$i"][4];
			}
			$i++;		
		}
	}
	else
	{
		while ($i<=$grupos)
		{
			if ($param_conexion[$i][3]==$grupo_rol)
			{
				$myuser=$param_conexion[$i][1];
				$mypass=$param_conexion[$i][2];
				$mydb=$param_conexion[$i][4];
			}
			$i++;		
		}
	}
	$server=$connect($myserver, $bd_usuario, $bd_password) or die ("el verificador no se pudo conectar al servidor $myserver");
	$database=$select_db($mydb, $server);	
	return;
}
function desconectardb()
{
	mssql_close($server);
}
?>
