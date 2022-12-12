<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<?PHP


      	$vec[0] = "No. Ing";
		$vec[1] = "Fecha Ingreso";
		$vec[2] = "Solicitante";
		$vec[3] = "Dependencia";
	    $vec[4] = "Actividad";
		
		
		
		
		$vec2[0] = "codigo_ingreso_enc";
		$vec2[1] = "fecha_ingreso";
		$vec2[2] = "solicitante";
		$vec2[3] = "Descripcion_Depen";
		$vec2[4] = "descripcion";
	    $vec2[5] = "codigo_ingreso_enc";
	
		
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
				 order by fechahora desc";*/

      $query ="select * from tb_ingreso_enc e
inner join tb_dependencias dep
on dep.codigo_depen = e.codigo_dependencia
inner join tb_actividad a 
on e.codigo_actividad = a.codigo_actividad and e.codigo_programa = a.codigo_programa 
inner join tb_programa p
on e.codigo_programa = p.codigo_programa order by e.codigo_ingreso_enc desc";



 getTabla($query,5,$vec,$vec2,$vec3,$dbms,95,"","","ver/detalle_ingreso.php?id=");

		
	  ?>
</body>
</html>
