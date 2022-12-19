<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
   <table width="372"  align="center" >
            <tr>
              <td><span class="Estilo2">Busqueda Ingrese No. requisicion  </span></td>
			  <form action="" enctype="multipart/form-data" >

              <td><input type="text" name="cris" size="7"  value=""></td>
			  
			  <td> <input  type="submit" value="BUSCAR" >
			   
			  </form>
			  </td> </td>
            </tr>
          </table>
		  
		  

<?PHP
$jefe = ($_POST['cbo_jefe']); 

      	$vec[0] = "No. Req";
		$vec[1] = "No. Desp";
		$vec[2] = "Fecha Solicitud";
		$vec[3] = "Solicitante";
		$vec[4] = "Dependencia";
	    $vec[5] = "Fecha Aprobo";
		$vec[6] = "Fecha Autorizo";
		$vec[7] = "Fecha Despacho";
		
		
		$vec2[0] = "codigo_requisicion_enc";
		$vec2[1] = "codigo_egreso";
		$vec2[2] = "fecha_requisicion";
		$vec2[3] = "solicitante";
		$vec2[4] = "nombre";
		$vec2[5] = "fecha_aprobacion";
		$vec2[6] = "fecha_autorizado";
		$vec2[7] = "fecha_despacho";
		$vec2[8] = "codigo_requisicion_enc";
	
		
		$vec3[0] = "width=\"5%\"";
		$vec3[1] = "width=\"5%\"";
		$vec3[2] = "width=\"13%\"";
		$vec3[3] = "width=\"24%\"";
		$vec3[4] = "width=\"21%\"";
		$vec3[5] = "width=\"13%\"";
		$vec3[6] = "width=\"13%\"";
		$vec3[7] = "width=\"13%\"";
	
		/*$query ="select CONVERT(nvarchar(10), fechahora, 103) as fecha,
						CONVERT(nvarchar(10), fechahora, 108) as hora, 
						nombre as solicitante,
						pregunta,idsolicitud
				 from
					tbl_solicitud
				 where 
				 	idstatus in ($mtstatus)
				 order by fechahora desc";*/
//top 139 promedio de 139 despachadas mensuales
$mtstatus= 3;
$cris= $_REQUEST["cris"];
 if ($cris > 0) // REQUISICION
 
 {      $query ="select  e.fecha_requisicion, e.codigo_egreso,
 e.solicitante, d.nombre, e.codigo_requisicion_enc, e.fecha_aprobacion, e.fecha_autorizado, e.fecha_despacho
from tb_requisicion_enc e
left outer join direccion d
on e.codigo_dependencia = d.iddireccion
where 
codigo_estatus = 4
and  e.codigo_requisicion_enc='$cris'

order by fecha_requisicion desc";
}
else 
{
      $query ="select top 500 e.fecha_requisicion, e.codigo_egreso,
 e.solicitante, d.nombre, e.codigo_requisicion_enc, e.fecha_aprobacion, e.fecha_autorizado, e.fecha_despacho
from tb_requisicion_enc e
left outer join direccion d
on e.codigo_dependencia = d.iddireccion
where 
codigo_estatus in ($mtstatus,4)
and
e.fecha_requisicion between '2013-01-01' and getdate()
order by fecha_requisicion desc";

}

//echo $query;
if ($mtstatus=="3") {

 getTabla2($query,8,$vec,$vec2,$vec3,$dbms,95,"","","ver/detalle_solicitud2.php?id=");
 }

if ($mtstatus=="4") {

 getTabla2($query,8,$vec,$vec2,$vec3,$dbms,95,"","","ver/detalle_aprobacion2.php?id=");
 }
 
if ($mtstatus==="5") {

getTabla2($query,8,$vec,$vec2,$vec3,$dbms,95,"","","ver/detalle_autorizado.php?id=");

 }

if ($mtstatus==="6") {

getTabla2($query,8,$vec,$vec2,$vec3,$dbms,95,"","","ver/detalle_despachado.php?id=");

 }

if ($mtstatus==="0") {

getTabla2($query,8,$vec,$vec2,$vec3,$dbms,95,"","","ver/detalle_solicitud.php?id=");

 }
		
	  ?>
</body>
</html>
