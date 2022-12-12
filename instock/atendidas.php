<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

	<table width="372"  align="center" >
		<tr>
			<form action="" enctype="multipart/form-data" >
				<td><span class="Estilo2 form-control-static ">Tipo de Compra:  </span></td>
				<td>
				<select class="form-control" style="width:170px;" name="a" required >
				
				<option value="0">:: Seleccione ::</option>
				<option value="15">Compra Directa</option>
				<option value="8">Compra General</option> 
				</select>
				</td>
			
			
				<td><span class="Estilo2 form-control-static">Busqueda Categoria:  </span></td>
				

				<td><input type="text" name="b" size="10"  value=""  class="form-control" style="width:70px;"/></td>
				 <td><span class="Estilo2 form-control-static">Busqueda subcategoria:  </span></td>
				
				<td><input type="text" name="c" size="10"  value="" class="form-control" style="width:70px;" /></td>
				<td><span class="Estilo2 form-control-static">Busqueda Producto:  </span></td>
			

				<td><input type="text" name="d" size="10"  value=""  class="form-control" style="width:70px;"/></td>
				
				<td> <input  class="btn btn-primary"  type="submit" value="MOSTRAR" >
				
			</form>
			</td> </td>
        </tr>
    </table>

  

	<?PHP
		if (isset($_POST["a"]))
		{
			$a = $_POST["a"];

		}
		if (isset($_POST["b"]))
		{
			$b = $_POST["b"];

		}

		if (isset($_POST["c"]))
		{
			$c = $_POST["c"];

		}

		if (isset($_POST["d"]))
		{
			$d = $_POST["d"];

		}

		$vec[0] = "categoria";
		$vec[1] = "subcategoria";
		$vec[2] = "codigo_producto";
		$vec[3] = "Producto";
		$vec[4] = "Unidad Medida";
		$vec[5] = "Existencia";
		$vec[6] = "Bodega";
		$vec[7] = "Empresa";
		$vec[8] = "Costo Promedio";
		$vec[9] = "Costo Total";

		$vec2[0] = "categoria";
		$vec2[1] = "subcategoria";
		$vec2[2] = "codigo_producto";
		$vec2[3] = "producto";
		$vec2[4] = "unidad_medida";
		$vec2[5] = "existencia";
		$vec2[6] = "bodega";
		$vec2[7] = "empresa";
		$vec2[8] = "promedio";
		$vec2[9] = "costo_total";

		$vec3[0] = "width=\"5%\"";
		$vec3[1] = "width=\"5%\"";
		$vec3[2] = "width=\"5%\"";
		$vec3[3] = "width=\"40%\"";
		$vec3[4] = "width=\"12%\"";
		$vec3[5] = "width=\"10%\"";
		$vec3[6] = "width=\"15%\"";
		$vec3[7] = "width=\"15%\"";
		$vec3[8] = "width=\"15%\"";

		if ($a == 12)
		{ //compra directa
			//Modificacion 07-12-2016 costo total cambia
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = ". $_SESSION["bodega15"] . " and p.activo=1   group by p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/
			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria 
								where i.codigo_bodega = " . $_SESSION["bodega15"] . " and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where codigo_producto=kd.codigo_producto and codigo_categoria=kd.codigo_categoria and codigo_subcategoria=kd.codigo_subcategoria  and codigo_bodega = 15) and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra directa
		if ($a == 8)
		{ //compra general
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = 8 and p.activo=1   and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = 8 and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where codigo_producto=kd.codigo_producto and codigo_categoria=kd.codigo_categoria and codigo_subcategoria=kd.codigo_subcategoria and codigo_bodega = 8) and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra general
		if ($a == 15)
		{ //compra directa y categoria
			/* $query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = ". $_SESSION["bodega15"] . " and p.activo=1 and p.codigo_categoria = '$b'  and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto 
			";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = " . $_SESSION["bodega15"] . " and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where codigo_bodega= 15 and codigo_producto=kd.codigo_producto  and codigo_subcategoria=kd.codigo_subcategoria) and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by p.codigo_categoria asc ";

		} 

		if ($a == 15 && $b > 0)
		{ //compra directa y categoria
			/* $query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = ". $_SESSION["bodega15"] . " and p.activo=1 and p.codigo_categoria = '$b'  and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto 
			";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = " . $_SESSION["bodega15"] . " and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where  codigo_bodega = 15 andcodigo_producto=kd.codigo_producto and codigo_categoria='$b'  and codigo_subcategoria=kd.codigo_subcategoria) and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra directa y categoria


		if ($a == 15 && $c > 0)
		{ //compra directa y subcategoria
			

			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = ". $_SESSION["bodega15"] . " and p.activo=1  and p.codigo_subcategoria = '$c'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto ";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = " . $_SESSION["bodega15"] . " and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where  codigo_bodega = 15 and codigo_producto=kd.codigo_producto and codigo_categoria=kd.codigo_categoria  and codigo_subcategoria='$c') and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra directa y subcategoria
		if ($a == 15 && $d > 0)
		{ //compra directa y  producto
			/* $query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = ". $_SESSION["bodega15"] . " and p.activo=1   and p.codigo_producto = '$d'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = " . $_SESSION["bodega15"] . " and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where  codigo_bodega = 15 and  codigo_producto='$d' and codigo_categoria=kd.codigo_categoria and codigo_subcategoria=kd.codigo_subcategoria) and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra directa y producto


		if ($a == 15 && $b > 0 && $c > 0)
		{ //compra directa, categoria y  subcategoria
			/* $query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = ". $_SESSION["bodega15"] . " and p.activo=1 and p.codigo_categoria = '$b' and p.codigo_subcategoria = '$c'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = " . $_SESSION["bodega15"] . " and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where  codigo_bodega = 15 and  codigo_producto=kd.codigo_producto and codigo_categoria='$b' and codigo_subcategoria='$c') and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra directa, categoria y  subcategoria


		if ($a == 15 && $b > 0 && $d > 0)
		{ //compra directa, categoria y producto
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = ". $_SESSION["bodega15"] . " and p.activo=1 and p.codigo_categoria = '$b' and p.codigo_producto = '$d'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = " . $_SESSION["bodega15"] . " and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where  codigo_bodega = 15 and  codigo_producto='$d' and codigo_categoria='$b' and codigo_subcategoria=kd.codigo_subcategoria) and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra directa, categoria y  producto


		if ($a == 15 && $c > 0 && $d > 0)
		{ //compra directa, subcategoria y producto
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = ". $_SESSION["bodega15"] . " and p.activo=1  and p.codigo_subcategoria = '$c' and p.codigo_producto = '$d'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = " . $_SESSION["bodega15"] . " and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where  codigo_bodega = 15 and  codigo_producto='$d' and codigo_categoria=kd.codigo_categoria and codigo_subcategoria='$c') and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra directa, subcategoria y  producto


		if ($a == 15 && $b > 0 && $c > 0 && $d > 0)
		{ //total
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = ". $_SESSION["bodega15"] . " and p.activo=1 and p.codigo_categoria = '$b'  and p.codigo_subcategoria = '$c' and p.codigo_producto = '$d'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = 15 and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where  codigo_bodega = 15 and  codigo_producto='$d' and codigo_categoria='$b' and codigo_subcategoria='$c') and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //total


		// compra general id 8 en base de datos


		if ($a == 8 && $b > 0)
		{ //compra general y categoria
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = 8 and p.activo=1 and p.codigo_categoria = '$b'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/
			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = 8 and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where  codigo_bodega = 8 and codigo_producto=kd.codigo_producto and codigo_categoria='$b'  and codigo_subcategoria=kd.codigo_subcategoria) and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra general y categoria


		if ($a == 8 && $c > 0)
		{ //compra general y subcategoria
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = 8 and p.activo=1 and p.codigo_subcategoria = '$c'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = 8 and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where codigo_bodega = 8 and  codigo_producto=kd.codigo_producto and codigo_categoria=kd.codigo_categoria  and codigo_subcategoria='$c') and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra general y subcategoria
		if ($a == 8 && $d > 0)

		{ //compra general y  producto
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = 8 and p.activo=1 and p.codigo_producto = '$d'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and 
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = 8 and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where codigo_bodega = 8 and codigo_producto='$d' and codigo_categoria=kd.codigo_categoria and codigo_subcategoria=kd.codigo_subcategoria) and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra general  y producto


		if ($a == 8 && $b > 0 && $c > 0)
		{ //compra  general, categoria y  subcategoria
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = 8 and p.activo=1 and p.codigo_categoria = '$b' and p.codigo_subcategoria = '$c'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = 8 and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where codigo_bodega = 8 and codigo_producto=kd.codigo_producto and codigo_categoria='$b' and codigo_subcategoria='$c') and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra general, categoria y  subcategoria


		if ($a == 8 && $b > 0 && $d > 0)
		{ //compra general, categoria y producto
			/* $query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = 8 and p.activo=1 and p.codigo_categoria = '$b' and p.codigo_producto = '$d'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = 8 and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where codigo_bodega = 8 and codigo_producto='$d' and codigo_categoria='$b' and codigo_subcategoria=kd.codigo_subcategoria) and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra general, categoria y  producto


		if ($a == 8 && $c > 0 && $d > 0)
		{ //compra general, subcategoria y producto
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = 8 and p.activo=1 and p.codigo_subcategoria = '$c' and p.codigo_producto = '$d'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = 8 and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where codigo_bodega = 8 and codigo_producto='$d' and codigo_categoria=kd.codigo_categoria and codigo_subcategoria='$c') and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //compra general, subcategoria y  producto


		if ($a == 8 && $b > 0 && $c > 0 && $d > 0)
		{ //total
			/*$query="select  top 400
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria,
			max (p.codigo_producto) as codigo_producto,  max (p.producto +' - '+ p.marca) as producto,
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia,
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row,
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_promedio * i.existencia) as costo_total
			from
			tb_inventario i inner join cat_producto p
			on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
			on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
			on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
			on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
			where i.codigo_bodega = 8 and p.activo=1 and p.codigo_categoria = '$b'  and p.codigo_subcategoria = '$c' and p.codigo_producto = '$d'
			and i.codigo_empresa = ".$_SESSION["empresax"]."  group by  p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
			order by producto";*/

			$query = "select  top 400 
			max (p.codigo_categoria) as categoria, max( p.codigo_subcategoria) as subcategoria, 
			max (p.codigo_producto) as codigo_producto, max (kd.fecha_creado) as FECHAMOV,  max (p.producto +' - '+ p.marca) as producto, 
			max ( m.unidad_medida) as unidad_medida, max( i.existencia) as existencia, 
			max(b.bodega) as bodega, max( e.empresa) as empresa, max( i.rowid) as row, 
			max( i.costo_inicial) as costo_inical,
			max( kd.costo_promedio) as promedio, max (kd.costo_total) as costo_total
			from 
			tb_inventario i inner join cat_producto p 
					on i.codigo_producto = p.codigo_producto and i.codigo_categoria = p.codigo_categoria and i.codigo_subcategoria = p.codigo_subcategoria
			inner join cat_medida m
					on m.codigo_medida = p.codigo_medida
			inner join cat_empresa e
					on e.codigo_empresa = i.codigo_empresa
			inner join cat_bodega b
					on b.codigo_bodega = i.codigo_bodega inner join dbo.tb_kardex as kd on  kd.codigo_bodega= i.codigo_bodega and
			i.codigo_producto = kd.codigo_producto and i.codigo_categoria = kd.codigo_categoria and i.codigo_subcategoria = kd.codigo_subcategoria
								where i.codigo_bodega = 8 and p.activo=1 and kd.fecha_creado = (select max(fecha_creado)from tb_kardex where codigo_bodega = 8 and codigo_producto='$d' and codigo_categoria='$b' and codigo_subcategoria='$c') and i.codigo_empresa = ".$_SESSION["empresax"]."  group by p.codigo_categoria,p.codigo_subcategoria,p.codigo_producto 
								
								order by producto";

		} //total
		//print $query;


		getTabla2($query, 10, $vec, $vec2, $vec3, $dbms, 95, "", "", "");

	?>
</body>
</html>
