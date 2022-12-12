<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script type='text/javascript' src="../bootstrap/jquery/jquery-3.2.1.js"></script> 
 <script type='text/javascript' src="../datatable/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" type="text/css" href="../datatable/css/jquery.dataTables.min.css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

    <table width="372"  align="center" >
            <tr>
              <td><span class="Estilo2">Busqueda Ingrese No. Ingreso  </span></td>
			  <form action="" enctype="multipart/form-data" >

              <td><input type="text" name="ger" size="7"  value=""></td>
			  
			  <td> <input  type="submit" value="BUSCAR" >
			   
			  </form>
			  </td> </td>
            </tr>
          </table> 
		  


<?php

$jefe = ($_POST['cbo_jefe']); 
//echo "<hr>";
//echo $jefe;
//echo "<hr>";

      	$vec[0] = "ID";
      	$vec[1] = "No. Ingreso";
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
	    $vec2[7] = "codigo_ingreso_enc";
	
		
		$vec3[0] = "width=\"6%\"";
		$vec3[1] = "width=\"6%\"";
		$vec3[2] = "width=\"30%\"";
		$vec3[3] = "width=\"20%\"";
		$vec3[4] = "width=\"20%\"";
		$vec3[5] = "width=\"20%\"";
		$vec3[6] = "width=\"30%\"";
		
	$ger= 	$_POST['ger'];
		if ($ger > 0)
{
//      $query ="select distinct top 300 e.codigo_ingreso_enc, e.no_ingreso, e.codigo_tipo_documento, e.fecha_documento,e.numero_documento,
//  e.usuario_solicitante, e.solicitante, e.codigo_dependencia, e.fecha_ingreso, e.codigo_programa,e.codigo_actividad, p.programa, a.actividad, d.nombre, e.fecha_recepcion
//  from tb_ingreso_enc e
// inner join direccion d
// on d.iddireccion = e.codigo_dependencia
// inner join cat_programa p
// on e.codigo_programa = p.codigo_programa and p.activo=1
// inner join cat_actividad a
// on a.codigo_actividad = e.codigo_actividad and a.codigo_programa = p.codigo_programa and a.activo = 1 and e.activo = 1 and e.no_ingreso='$ger'
// order by e.codigo_ingreso_enc desc ";

$query = "select distinct top 300 e.codigo_ingreso_enc, e.no_ingreso, e.codigo_tipo_documento, e.fecha_documento,e.numero_documento,
 e.usuario_solicitante, e.solicitante, e.codigo_dependencia, e.fecha_ingreso, e.codigo_programa,e.codigo_actividad, d.nombre, e.fecha_recepcion
 from tb_ingreso_enc e
inner join direccion d
on d.iddireccion = e.codigo_dependencia
where e.no_ingreso='$ger'
order by e.codigo_ingreso_enc desc";	
/*
$query= 'select distinct top 40300 e.codigo_ingreso_enc, e.no_ingreso, e.codigo_tipo_documento, e.fecha_documento,e.numero_documento,   e.usuario_solicitante, e.solicitante, e.codigo_dependencia, e.fecha_ingreso, e.codigo_programa,e.codigo_actividad, p.programa, a.actividad, d.nombre, e.fecha_recepcion
  from tb_ingreso_enc e  inner join direccion d  on d.iddireccion = e.codigo_dependencia   inner join cat_programa p on e.codigo_programa = p.codigo_programa and p.activo=1  inner join cat_actividad a   on a.codigo_actividad = e.codigo_actividad and a.codigo_programa = p.codigo_programa and a.activo = 1 and e.activo = 1 
 order by e.codigo_ingreso_enc desc
 ';
*/

}
else
{
// $query ="select distinct top 300 e.codigo_ingreso_enc, e.no_ingreso, e.codigo_tipo_documento, e.fecha_documento,e.numero_documento,
//  e.usuario_solicitante, e.solicitante, e.codigo_dependencia, e.fecha_ingreso, e.codigo_programa,e.codigo_actividad, p.programa, a.actividad, d.nombre, e.fecha_recepcion
//  from tb_ingreso_enc e
// inner join direccion d
// on d.iddireccion = e.codigo_dependencia
// inner join cat_programa p
// on e.codigo_programa = p.codigo_programa and p.activo=1
// inner join cat_actividad a
// on a.codigo_actividad = e.codigo_actividad and a.codigo_programa = p.codigo_programa and a.activo = 1 and e.activo = 1 
// order by e.codigo_ingreso_enc desc ";
// }
/*
	$query = "select distinct top 300 e.codigo_ingreso_enc, e.no_ingreso, e.codigo_tipo_documento, e.fecha_documento,e.numero_documento,
 e.usuario_solicitante, e.solicitante, e.codigo_dependencia, e.fecha_ingreso, e.codigo_programa,e.codigo_actividad, d.nombre, e.fecha_recepcion
 from tb_ingreso_enc e
inner join direccion d
on d.iddireccion = e.codigo_dependencia
where e.activo = 1
order by e.codigo_ingreso_enc desc";*/
$query= 'select distinct top 300 e.codigo_ingreso_enc, e.no_ingreso, e.codigo_tipo_documento, e.fecha_documento,e.numero_documento,   e.usuario_solicitante, e.solicitante, e.codigo_dependencia, e.fecha_ingreso, e.codigo_programa,e.codigo_actividad, p.programa, a.actividad, d.nombre, e.fecha_recepcion
  from tb_ingreso_enc e  inner join direccion d  on d.iddireccion = e.codigo_dependencia   inner join cat_programa p on e.codigo_programa = p.codigo_programa and p.activo=1  inner join cat_actividad a   on a.codigo_actividad = e.codigo_actividad and a.codigo_programa = p.codigo_programa and a.activo = 1 and e.activo = 1 
 order by e.codigo_ingreso_enc desc
 ';
}

/* $query ="select distinct top 200 e.codigo_ingreso_enc, e.no_ingreso, codigo_tipo_documento, e.fecha_documento,e.numero_documento,
 e.usuario_solicitante,e.solicitante, e.codigo_dependencia, e.fecha_ingreso,a.codigo_actividad, p.codigo_programa from tb_ingreso_enc e
inner join direccion d
on d.iddireccion=e.codigo_dependencia
inner join cat_actividad a
on e.codigo_actividad=a.codigo_actividad and a.activo=1
inner join cat_programa p
on a.codigo_programa=p.codigo_programa and p.activo=1
order by e.no_ingreso desc";*/





getTabla2($query,7,$vec,$vec2,$vec3,$dbms,100,"ver/editar_ingreso2.php?id=","ver/eliminar_ingreso.php?id=","ver/detalle_ingreso.php?id=");

?>
</body>
</html>