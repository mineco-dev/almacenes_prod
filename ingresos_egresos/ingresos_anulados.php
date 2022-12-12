<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<?PHP
$jefe = ($_POST['cbo_jefe']); 

      	$vec[0] = "Cod. Ing";
		$vec[1] = "No. Ing";
		$vec[2] = "Fecha Ingreso";
		$vec[3] = "Solicitante";
		$vec[4] = "Dependencia";
	    $vec[5] = "Programa";
		$vec[6] = "Actividad";
		
		
		
		
		
		$vec2[0] = "codigo_ingreso_enc";
		$vec2[1] = "no_ingreso";
		$vec2[2] = "fecha_ingreso";
		$vec2[3] = "solicitante";
		$vec2[4] = "nombre";
		$vec2[5] = "programa";
		$vec2[6] = "actividad";
	   
	
		
		$vec3[0] = "width=\"4%\"";
		$vec3[1] = "width=\"4%\"";
		$vec3[2] = "width=\"13%\"";
		$vec3[3] = "width=\"19%\"";
		$vec3[4] = "width=\"20%\"";
	 	$vec3[5] = "width=\"20%\"";
		$vec3[6] = "width=\"20%\"";
	
	
	
		/*$query ="select CONVERT(nvarchar(10), fechahora, 103) as fecha,
						CONVERT(nvarchar(10), fechahora, 108) as hora, 
						nombre as solicitante,
						pregunta,idsolicitud
				 from
					tbl_solicitud
				 where 
				 	idstatus in ($mtstatus)
				 order by fechahora desc";*/

//       $query ="select * from tb_ingreso_enc e
// inner join direccion dep
// on dep.iddireccion = e.codigo_dependencia
// inner join cat_programa p
// on p.codigo_programa = e.codigo_programa and p.activo=1
// inner join cat_actividad a 
// on e.codigo_actividad = a.codigo_actividad  and a.codigo_programa = p.codigo_programa and a.activo=1 and e.activo = 2
//  order by e.no_ingreso desc";


$query = "select * from tb_ingreso_enc e
inner join direccion dep
on dep.iddireccion = e.codigo_dependencia
where e.codigo_estatus = 0
 order by e.no_ingreso desc";


 $query= ' select distinct  e.codigo_ingreso_enc, e.no_ingreso, e.codigo_tipo_documento, e.fecha_documento,e.numero_documento,   e.usuario_solicitante, e.solicitante, e.codigo_dependencia, e.fecha_ingreso, e.codigo_programa,e.codigo_actividad, p.programa, a.actividad, d.nombre, e.fecha_recepcion
 from tb_ingreso_enc e  
 inner join direccion d  on d.iddireccion = e.codigo_dependencia   
 left join cat_programa p on e.codigo_programa = p.codigo_programa and p.activo=1  
 left join cat_actividad a   on a.codigo_actividad = e.codigo_actividad and a.codigo_programa = p.codigo_programa 
 and a.activo = 1 --and e.activo = 1 
 where e.codigo_estatus= 0
order by e.codigo_ingreso_enc desc
';





 getTabla2($query,7,$vec,$vec2,$vec3,$dbms,95,"","","ver/detalle_ingreso.php?id=");

		
	  ?>
</body>
</html>
