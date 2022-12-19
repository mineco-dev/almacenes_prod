<?php
header('Content-Type: text/html; charset=iso-8859-1'); 
?>
<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	$qry_bodega="Select a.codigo_actividad,a.codigo_programa, a.actividad from
				 cat_actividad a
				inner join cat_programa p
					on a.codigo_programa = p.codigo_programa and p.activo=1
				where p.codigo_programa = ".$_REQUEST['Id']." and a.activo = 1  order by a.codigo_actividad";	 

					$res_qry_bodega=$query($qry_bodega);	
					//echo 'Subcategoria ';
					echo('<select name="cbo_actividad">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_bodega=$fetch_array($res_qry_bodega))
					{
						echo'<option value="'.$row_bodega["codigo_actividad"].'">'.$row_bodega["actividad"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_bodega);
?>
