<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	$qry_bodega="select cat_bodega.codigo_bodega, cat_bodega.bodega from cat_bodega
inner join cat_empresa on
cat_bodega.codigo_empresa = cat_empresa.codigo_empresa
where cat_bodega.codigo_empresa = ".$_REQUEST['Id']." and cat_bodega.activo = 1 ORDER BY cat_bodega.bodega";	

					$res_qry_bodega=$query($qry_bodega);	
					//echo 'Subcategoria ';
					echo('<select  class="form-control " style="width:20%;" name="cbo_bodega">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_bodega=$fetch_array($res_qry_bodega))
					{
						echo'<option value="'.$row_bodega["codigo_bodega"].'">'.$row_bodega["bodega"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_bodega);
?>
