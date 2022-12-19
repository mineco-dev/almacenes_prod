<?php
function validaEntrada($valor, $selectACargar)
{
	// Funcion utilizada para validar el numero recibido por GET.
	if($selectACargar==2 && $valor>=1 && $valor<=20) return TRUE;
	elseif($selectACargar==3 && $valor>=1 && $valor<=20) return TRUE;
	else return FALSE;
}

$valor=$_GET["seleccionado"]; $selectACargar=$_GET["select"];

if(validaEntrada($valor, $selectACargar))
{
	require_once('../Connections/redes.php'); 
	mysql_select_db($database_redes);
	$sSQL="Select idnomaran,nombrearan From arancel_nombre where tipo = 0 order by nombrearan";
	
	if ($selectACargar==2)
	{
	   if ($valor != 6)
		$sSQL=
		"Select idnomaran,nombrearan From arancel_nombre where tipo = $valor 
		 union 
		 Select idnomaran,nombrearan From arancel_nombre where idnomaran = $valor   
		 order by nombrearan";
		 else
		 $sSQL=
		"Select idnomaran,nombrearan From arancel_nombre where tipo = $valor 
		 order by nombrearan";
	}
	
	if ($selectACargar==2)
	{
		$sSQL="select idempleado, concat(nombres,'  ',apellidos) from empleados where iddireccion = $valor and habilitado = 'y' and nombres <> '  -- Seleccione --' order by nombres";
	}
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);



	// Comienzo a imprimir el select
	if($selectACargar==2) 
		echo "<select class='combo' onChange='cargaContenido(3)' id='select4_$selectACargar' name='select4_$selectACargar'>";
	else
		echo "<select class='combo' id='select4_$selectACargar' name='select4_$selectACargar'>";		
	
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Paso a HTML acentos y ñ para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='$registro[0]'>$registro[1]</option>";
	}			
	echo "</select>";
}
?>