<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	$qry_subcategoria="select cat_subcategoria.subcategoria, cat_categoria.categoria from cat_subcategoria
inner join
cat_categoria on
cat_subcategoria.codigo_categoria = cat_categoria.codigo_categoria
ORDER BY cat_subcategoria.codigo_subcategoria";	

					$res_qry_subcategoria=$query($qry_subcategoria);	
					//echo 'Subccategoria ';
					echo('<select name="cbo_subcategoria">');
					$nombre=": Seleccione :";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_subcategoria=$fetch_array($res_qry_subcategoria))
					{
						echo'<option value="'.$row_subcategoria["codigo_subcategoria"].'">'.$row_subcategoria["codigo_subcategoria"].'-'.$row_subcategoria["subcategoria"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_subcategoria);
?>
