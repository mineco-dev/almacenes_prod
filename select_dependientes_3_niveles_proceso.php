<?php
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");	
conectardb($almacen);
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"select1"=>"cat_categoria",
"select2"=>"cat_subcategoria",
"select3"=>"cat_producto"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if ($selectDestino=="select2") 
{
	// //session_register("rptcategoria");
	$_SESSION["rptcategoria"]=$opcionSeleccionada;
}
if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];		
	if ($tabla == "cat_producto")
		{												
		if (isset($_SESSION["rptcategoria"])) $cbo_categoria=$_SESSION["rptcategoria"];
		$consulta=mssql_query("SELECT p.codigo_producto, (p.producto +' - '+ p.marca +' EN '+ m.unidad_medida) as producto, 
p.activo, p.codigo_subcategoria, p.codigo_categoria 
	FROM     cat_producto p
	INNER JOIN cat_medida m ON p.codigo_medida = m.codigo_medida 
	INNER JOIN tb_inventario i ON p.codigo_producto = i.codigo_producto 
       and p.codigo_subcategoria=i.codigo_subcategoria and p.codigo_categoria=i.codigo_categoria
where i.codigo_subcategoria = '$opcionSeleccionada' and p.activo = 1 and i.codigo_empresa = ".$_SESSION["empresax"]." 
and i.codigo_categoria = $cbo_categoria order by producto");	
									
									// where i.codigo_subcategoria = '$opcionSeleccionada' and p.activo = 1 and i.codigo_empresa = ".$_SESSION["empresax"]." and i.codigo_bodega = ". $_SESSION["bodega15"] . "
		// Comienzo a imprimir el select
		echo "<select class='form-control' style='width:300px;' name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Seleccione Producto</option>";
		while($registro=mssql_fetch_row($consulta))
		{
			// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
			$registro[1]=htmlentities($registro[1]);
			// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[0]."  ---  ".$registro[1]."</option>";
		}			
		echo "</select>";
	}	
	if ($tabla == "cat_subcategoria")
	{	
		$consulta=mssql_query("SELECT s.codigo_categoria, s.codigo_subcategoria, s.subcategoria FROM $tabla s 
		
		WHERE s.codigo_categoria='$opcionSeleccionada' and activo=1 ORDER BY s.codigo_subcategoria");
				
		// Comienzo a imprimir el select
		echo "<select class='form-control' style='width:300px;' name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
		echo "<option value='0'>Seleccione Subcategoria</option>";
		while($registro=mssql_fetch_row($consulta))
		{
			// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
			$registro[2]=htmlentities($registro[2]);
			// Imprimo las opciones del select
			echo "<option value='".$registro[1]."'>".$registro[1]."  ---  ".$registro[2]."</option>";
		}			
		echo "</select>";
	}	
}
?>