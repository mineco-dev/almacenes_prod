<?PHP
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
if (isset($_REQUEST["txt_id"]))
{	
		$rowid=$_REQUEST["txt_id"];
		$medida=strtoupper($_REQUEST["txt_medida"]);
		conectardb($almacen);
		$nombre_usuario=$_SESSION["user_name"];
		$qry_cambia_stat="UPDATE cat_medida SET unidad_medida='$medida', usuario_modifico='$nombre_usuario', fecha_modificado=getdate() WHERE codigo_medida='$rowid'";
		$query($qry_cambia_stat);
}
header("Location: medida.php"); 
?>
