<?php
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");

	//conectardb($almacen);
conectardb($almacen);
	//print($rrhh);
	///print($almacen);

$qry_bodega="select * from direccion d
inner join tb_jefes_depen j
on iddireccion = codigo_dependencia
where iddireccion = ".$_REQUEST['Id']." and j.activo = 1";	
//print($qry_bodega);
$res_qry_bodega=$query($qry_bodega);	
					//echo 'Subcategoria ';
echo('<select  class="form-control" style="width:40%;" name="cbo_jefe">');
$nombre=":: Seleccione ::";
echo'<option value="0">'.$nombre.'</option>';
while($row_bodega=$fetch_array($res_qry_bodega))
{
	echo'<option value="'.$row_bodega["codigo_usuario"].'">'.$row_bodega["Nombre_Jefe_Depen"].'</option>';
}
echo('</select>');				
$free_result($res_qry_bodega);
?>
