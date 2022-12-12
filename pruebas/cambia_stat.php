<?PHP
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
if (isset($_REQUEST["stat"]))
{	
		$referencia=$_REQUEST["ref"];	
		if ($referencia==1) 
		 	{

					  $latabla="cat_categoria";
					  $campocond="codigo_categoria";
					  $retornar="categoria.php";
			}
		else
		if ($referencia==2) 
		{
					  $latabla="cat_subcategoria";
  					  $campocond="codigo_subcategoria";
					  $retornar="subcategoria.php";		
		}
		else
		if ($referencia==3) 
		{
					  $latabla="cat_medida";
  					  $campocond="codigo_medida";
					  $retornar="medida.php";	
		}
		else
		if ($referencia==4) 
		{
					  $latabla="cat_producto";
  					  $campocond="rowid";
					  $retornar="cat_producto.php";		  						  				  
		}
		conectardb($almacen);
		$nuevo_estado=$_REQUEST["stat"];	
		$rowid=$_REQUEST["id"];	
		$nombre_usuario=$_SESSION["user_name"];
		$qry_cambia_stat="UPDATE $latabla SET activo='$nuevo_estado', usuario_desactivo='$nombre_usuario', fecha_desactivado=getdate() WHERE $campocond='$rowid'";
		$query($qry_cambia_stat);
}
header("Location: $retornar"); 
?>
