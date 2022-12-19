<?php
@session_start();
function conectardb($grupo_rol)
{	
	$myserver="128.5.8.85";
	$bd_usuario = "dev"; 
	$bd_password = "12345678"; 
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
		//ini_set('mssql.charset', 'UTF-8');
	$server=mssql_connect($myserver, $bd_usuario, $bd_password) or die ("Ministerio de Economia");
	$database=mssql_select_db($mydb, $server);	
	return($server);
	}
	else
	{
		define('__DIR__', realpath(dirname(__FILE__)));
		require_once( __DIR__ . '/../connection/helpdesk.php');
	}
}


function permisosdb($grupo_rol)
{		
	if (isset($_SESSION["param_conexion"]))
	{
		$grupos=count($_SESSION["param_conexion"]);
		$i=1;
		while ($i<=$grupos)
		{
			if ($_SESSION["param_conexion"]["$i"][3]==$grupo_rol)
			{				
				$myaccess=$_SESSION["param_conexion"]["$i"][5];
			}
			$i++;		
		}	
		return($myaccess);
	}	
}
function desconectardb($s)
{
	mssql_close($s);
}

function dia()
{
	$i=1;	
	 while ($i<=31)
	  {
					
                    $dia = $dia."<option value=".$i.">".$i."</option>";
          $i++;
	 }
	 return $dia;
}	

function mes()
{
	$i=1;	
	 while ($i<=12)
	  {
					
                    $mes = $mes."<option value=".$i.">".$i."</option>";
          $i++;
	 }
	 return $mes;
}		

function anio()
{
	$i=1945;	// se cambio para 1945 que solicitaron en Recursos Humanos 2005
	 while ($i<=2025)
	  {
					
                    $anio = $anio."<option value=".$i.">".$i."</option>";
          $i++;
	 }
	 return $anio;
}
?>