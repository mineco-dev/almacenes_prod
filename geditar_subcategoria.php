<?PHP
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
if (isset($_REQUEST["txt_id"]))
{	
		$rowid=$_REQUEST["txt_id"];
		$subcategoria=strtoupper($_REQUEST["txt_subcategoria"]);
		$categoria=$_REQUEST["txt_categoria"];
		$categoria_temp=$_REQUEST["cbo_categoria"];
		if ($categoria_temp!=0) $categoria=$categoria_temp;		
		conectardb($almacen);
		$nombre_usuario=$_SESSION["user_name"];
		$qry_cambia_stat="UPDATE cat_subcategoria SET subcategoria='$subcategoria', codigo_categoria=$categoria, usuario_modifico='$nombre_usuario', fecha_modificado=getdate() WHERE codigo_subcategoria='$rowid'";
		$query($qry_cambia_stat);
}
header("Location: nueva_subcategoria.php"); 
?>
