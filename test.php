<?
session_start();
if (isset($_SESSION["param_conexion"]))
{		
		$grupos=count($_SESSION["param_conexion"]);
		$i=1;
		while ($i<=$grupos)
		{			
			if ($_SESSION["param_conexion"]["$i"][3]==21)
			{
				$myuser=$_SESSION["param_conexion"]["$i"][1];
				$mypass=$_SESSION["param_conexion"]["$i"][2];
				$mydb=$_SESSION["param_conexion"]["$i"][4];				
			}
			$i++;		
		}
		echo $myuser;
		echo $mypass;		
	}
	else
	{
	echo "no se encontro el arreglo";
	}
?>
