<?PHP
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
if (isset($_REQUEST["txt_id"]))
{			
		$rowid=$_REQUEST["txt_id"];
		$nombre=$_REQUEST["txt_nombre"];
		$nit=$_REQUEST["txt_nit"];
		$direccion=$_REQUEST["txt_direccion"];	
		$telefono=$_REQUEST["txt_telefonos"];	
		$correo=$_REQUEST["txt_correo"];
		$contacto=$_REQUEST["txt_contacto"];		

		conectardb($almacen);
		//$nombre_usuario=$_SESSION["user_name"];
		$qry_actualiza="UPDATE tb_proveedor SET nit='$nit', nombre='$nombre', direccion='$direccion', telefonos='$telefono', 
						  contacto='$contacto', corrreo='$correo' WHERE rowid='$rowid'";
		//print($qry_actualiza);
		$query($qry_actualiza);				
}		
header("Location: nuevo_proveedor2.php"); 
?>
