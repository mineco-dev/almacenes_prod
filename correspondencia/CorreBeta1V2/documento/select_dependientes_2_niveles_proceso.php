<?php
function validaEntrada($valor, $selectACargar)
{
	// Funcion utilizada para validar el numero recibido por GET.
	/*
	if($selectACargar==2 && $valor>=1 && $valor<=20) return TRUE;
	elseif($selectACargar==3 && $valor>=1 && $valor<=20) return TRUE;
	else return FALSE;
	*/
	if($selectACargar>1 && $valor>=1) return TRUE;
	else return FALSE;
}

$valor=$_GET["seleccionado"]; $selectACargar=$_GET["select"];

if(validaEntrada($valor, $selectACargar))
{
	require_once('../Connections/redes.php'); 
	mysql_select_db($database_redes);
	$sSQL="Select idempleados,nombres,apellidos From empleados order by nombres";
	
	if ($selectACargar==2)
	{
		 $sSQL=	"select idempleados,nombres,apellidos From empleados where iddireccion = $valor 
		 order by nombres";
	}
	
	$consulta=mysql_query($sSQL);
	mysql_close($coneccion);



	// Comienzo a imprimir el select
	if($selectACargar==2) 
		echo "<select class='combo' onChange='cargaContenido(3)' id='select_$selectACargar' name='select_$selectACargar'>";
	else
		if($selectACargar==3) 
			echo "<select class='combo' onChange='cargaContenido(4)' id='select_3' name='select_3'>";
		else
		echo "<select class='combo' id='select_$selectACargar' name='select_$selectACargar'>";		
	
	echo "<option value='0'>Elige...</option>";
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