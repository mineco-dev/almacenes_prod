	
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<?php
$usuario_id=($_SESSION["user_id"]);
ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

//$jefe = ($_POST['cbo_jefe']); 

      	$vec[0] = "Ingreso";
		$vec[1] = "Código";	
		$vec[2] = "Fecha";
		$vec[3] = "Solicitante";
		$vec[4] = "Dependencia";	

		$vec2[1] = "codigo_ingreso_enc";		
		$vec2[0] = "no_ingreso";
		$vec2[2] = "fecha";
		$vec2[3] = "solicitante";
		$vec2[4] = "nombre";
		
		$vec3[0] = "width=\"4%\"";
		$vec3[1] = "width=\"4%\"";
		$vec3[2] = "width=\"20%\"";
		$vec3[3] = "width=\"20%\"";
		$vec3[4] = "width=\"20%\"";
		
	
$query ="select distinct  e.codigo_ingreso_enc,e.no_ingreso, CONVERT(nvarchar(10), e.fecha_creado, 103) as fecha, e.solicitante, d.nombre, e.codigo_bodega 
from tb_ingreso_enc e
left join direccion d on d.iddireccion = e.codigo_dependencia where e.codigo_estatus = '7' 
and e.codigo_bodega = 15 and e.activo = 1  and  e.usuario_solicitante = ".$usuario_id." order by e.no_ingreso desc";
//$query= "select top 30  e.no_ingreso, CONVERT(nvarchar(10), e.fecha_creado, 103) as fecha, e.solicitante, d.nombre, e.codigo_ingreso_enc, e.codigo_bodega from tb_ingreso_enc e left join direccion d on d.iddireccion = e.codigo_dependencia where e.codigo_estatus = '7' and e.codigo_bodega = 15 and e.activo = 1 and e.usuario_solicitante = 342 order by e.no_ingreso desc";
//echo $query;
getTabla2($query,5,$vec,$vec2,$vec3,$dbms,95,"","","ver/detalle_ingreso.php?id=");


		
	  ?>
</body>
</html>
