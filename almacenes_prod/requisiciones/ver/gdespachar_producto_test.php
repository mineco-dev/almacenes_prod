<?PHP
	//session_start();
require("../../../includes/funciones.php");
require("../../../includes/sqlcommand.inc");
require_once('../../../includes/conectarse.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
?>




<?PHP
if (isset($_GET["id"])) 
{		

		$cod=$_GET["id"];


		conectardb($almacen);
		$queryconsulta = "select *  from  tb_requisicion_enc  WHERE codigo_requisicion_enc='$cod' and codigo_egreso is  null";
		$responsexyz = $query($queryconsulta);
		$contadorxxx=0;
		while($rowid=$fetch_array($responsexyz))
			{	
				$contadorxxx+=1;
				
			}
			
		
		
		

				
}

?>
