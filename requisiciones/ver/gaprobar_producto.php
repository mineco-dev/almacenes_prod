<?PHP
require("../../../includes/funciones.php");
require("../../../includes/sqlcommand.inc");
//if (isset($_REQUEST["txt_id"])) 
//{			
	   
if (isset($_REQUEST["otros"]))

			/////////////////////////////////// Actualiza tabla de inventario si aprueba el producto /////////////////////////////
		$otro_reporte=$_REQUEST["otros"];	
if ($otro_reporte=='AP') 
	{			
	
		$rowid=$_REQUEST["txt_id"];
		conectardb($almacen);
		$nombre_usuario=$_SESSION["user_name"];
		
		$qry_actualiza="UPDATE tb_requisicion_enc SET codigo_estatus=4, usuario_aprobo='$nombre_usuario', 
						  fecha_aprobacion=getdate() WHERE codigo_requisicion_enc='$rowid'";
		$query($qry_actualiza);				
        echo "REQUISICION APROBADA EXITOSAMENTE";
		
		echo '<a href="../versolicitud.php?ver=1"> <<--regresar </a>';
    }				

else

if ($otro_reporte=='RE') 
	{		
			
	
	
	conectardb($almacen);
		$codigo=$_REQUEST["txt_id"];
		
		$qry_actualiza="UPDATE tb_requisicion_enc SET codigo_estatus=0, usuario_rechazo='$nombre_usuario', 
						  fecha_rechazo=getdate() WHERE codigo_requisicion_enc='$codigo'";
		//print($qry_actualiza);
		$query($qry_actualiza);	
		echo "LA REQUISICION HA SIDO RECHAZADA";
		echo '<a href="almacen/estados/versolicitud.php?ver=5"> <<--regresar </a>';
	}
							
	


?>
