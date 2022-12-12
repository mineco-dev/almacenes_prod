<?php

require("../../includes/sqlcommand.inc");	
require('../../includes/funciones.php');
conectardb($almacen);

	$qry_empresa="select * from direccion where activo = 1";
	
	$res_qry_empresa=$query($qry_empresa);	
	
	
	
	if($res_qry_empresa)
	{
        echo $data = "<option value='' disabled selected>--Seleccione una opcion--</option>";
		while($row = $fetch_array($res_qry_empresa))	
		{
			echo $data = "<option value = '" .$row['iddireccion'] ."'>" .$row['nombre'] ."</option>";
		}
		desconectardb($con);
	}
	else
	{
		echo "Error datos no encontrados";
	}
	
?>