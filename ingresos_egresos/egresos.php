<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<?php
$jefe = ($_POST['cbo_jefe']); 

      	$vec[0] = "No. Ing";
		$vec[1] = "Fecha Egreso";
		$vec[2] = "Solicitante";
		$vec[3] = "Dependencia";
	    $vec[4] = "Recibio";
		
		$vec2[0] = "codigo_egreso_enc";
		$vec2[1] = "fecha_creado";
		$vec2[2] = "nombre_solicitante";
		$vec2[3] = "nombre";
	    $vec2[4] = "recibe";
	    $vec2[5] = "codigo_egreso_enc";
		
		$vec3[0] = "width=\"5%\"";
		$vec3[1] = "width=\"13%\"";
		$vec3[2] = "width=\"27%\"";
		$vec3[3] = "width=\"25%\"";
		$vec3[4] = "width=\"25%\"";
	
		/*$query ="select CONVERT(nvarchar(10), fechahora, 103) as fecha,
						CONVERT(nvarchar(10), fechahora, 108) as hora, 
						nombre as solicitante,
						pregunta,idsolicitud
				 from
					tbl_solicitud
				 where 
				 	idstatus in ($mtstatus)
				 order by fechahora desc";
				 
				 select * from tb_egreso_enc e
  inner join direccion dep
	on dep.iddireccion = e.codigo_dependencia
	 where e.activo=1 /*and (e.fecha_documento between ('01/01/2011') and getdate())
	order by e.codigo_egreso_enc desc	 */

      $query ="select top 1000 e.codigo_egreso_enc, e.fecha_creado, e.nombre_solicitante, e.recibe, d.nombre from tb_egreso_enc e
	inner join direccion d on d.iddireccion =e.codigo_dependencia where e.activo=1
	order by e.codigo_egreso_enc desc";
 getTabla2($query,5,$vec,$vec2,$vec3,$dbms,95,"","","ver/detalle_egreso.php?id=");

		
	  ?>
</body>
</html>
