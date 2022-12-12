<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	$qry_subcategoria="SELECT s.codigo_categoria, s.codigo_subcategoria, s.subcategoria FROM cat_subcategoria s
	inner join tb_categoria_x_bodega c
	on c.codigo_categoria=s.codigo_categoria and c.codigo_subcategoria=s.codigo_subcategoria
	WHERE activo=1 and c.codigo_bodega='$bodega' and s.codigo_categoria = ".$_REQUEST['Id']." ORDER BY s.codigo_subcategoria";	

					$res_qry_subcategoria=$query($qry_subcategoria);	
					echo 'Subcategoria ';
					echo('<select name="cbo_subcategoria">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_subcategoria=$fetch_array($res_qry_subcategoria))
					{
						echo'<option value="'.$row_subcategoria["codigo_subcategoria"].'">'.$row_subcategoria["codigo_subcategoria"].'-'.$row_subcategoria["subcategoria"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_subcategoria);

?>
