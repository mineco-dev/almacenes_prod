<?PHP
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
if (isset($_REQUEST["txt_id"]))
{	
		$rowid=$_REQUEST["txt_id"];
		$categoria=strtoupper($_REQUEST["txt_categoria"]);
		conectardb($almacen);
		$nombre_usuario=$_SESSION["user_name"];
		$qry_cambia_stat="UPDATE cat_categoria SET categoria='$categoria', usuario_modifico='$nombre_usuario', fecha_modificado=getdate() WHERE codigo_categoria='$rowid'";
		$query($qry_cambia_stat);
}
header("Location: categoria.php"); 
?>
