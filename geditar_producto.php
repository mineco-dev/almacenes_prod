<?PHP
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
if (isset($_REQUEST["txt_id"]))
{			
		$rowid=$_REQUEST["txt_id"];
		$producto=strtoupper(utf8_decode($_REQUEST["txt_producto"]));
		$marca=strtoupper($_REQUEST["txt_marca"]);
			
		$uso=$_REQUEST["txt_uso"];	

		$subcategoria=$_REQUEST["txt_subcategoria"];
		$subcategoria_temp=$_REQUEST["cbo_subcategoria"];
		if ($subcategoria_temp!=0) $subcategoria=$subcategoria_temp;		
		
		$medida=$_REQUEST["txt_medida"];
		$medida_temp=$_REQUEST["cbo_medida"];
		if ($medida_temp!=0) $medida=$medida_temp;
		
		$estado=$_REQUEST["txt_estado"];
		$estado_temp=$_REQUEST["cbo_estado"];
		if ($estado_temp!=0) $estado=$estado_temp;			

		conectardb($almacen);
		$nombre_usuario=$_SESSION["user_name"];
		$qry_actualiza="UPDATE cat_producto SET producto='$producto', marca='$marca', codigo_subcategoria='$subcategoria', codigo_medida='$medida', codigo_estado='$estado', uso='$uso', usuario_modifico='$nombre_usuario', 
						  fecha_modificado=getdate() WHERE rowid='$rowid'";
		$query($qry_actualiza);				
}		
header("Location: cat_producto.php"); 
?>
