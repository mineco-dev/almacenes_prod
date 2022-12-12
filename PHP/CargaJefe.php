<?php
	require("../../includes/sqlcommand.inc");	
	require('../../includes/funciones.php');
	conectardb($almacen);

	
	$idDepartamento = $_POST['idDepartamento'];
	
	$qry_bodega = "select * from direccion d inner join tb_jefes_depen j on iddireccion = codigo_dependencia where iddireccion = $idDepartamento and j.activo = 1";
	$res_qry_bodega=$query($qry_bodega);
	

	if($res_qry_bodega)
	{
		$i = 1;
		while($row_bodega=$fetch_array($res_qry_bodega))
		{
			echo $data = '<option value="'.$row_bodega["codigo_usuario"].'">'.$row_bodega["Nombre_Jefe_Depen"].'</option>';
			$i++;
		}
		desconectardb($con);
	}
	else
	{
		echo "Error al intentar cargar los datos";
	}



?>