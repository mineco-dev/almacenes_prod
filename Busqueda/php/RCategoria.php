<?php
    //require("../../../includes/funciones.php");
    require('../conexion.php');
    $con=conectar();

    $categoria = $_POST['datos'];

    
     $query = " use almacen_nuevo 
          select CONVERT(nvarchar(10), k.fecha, 103) as fecha,
              CONVERT(nvarchar(10), k.fecha, 108) as hora,
              m.tipo_movimiento,
              k.no_despacho, 
              k.no_ingreso, 
              k.entrada,
              k.salida, 
              k.saldo, 
              k.costo_promedio, 
              k.costo_factura, 
              costo_movimiento,
              costo_total, 
              d.nombre,
              codigo_kardex,
              cast(k.codigo_categoria as varchar) + ' - '  + cast(k.codigo_subcategoria as varchar) + ' - '  + cast(k.codigo_producto as varchar) as codigo,
              p.producto
          from tb_kardex k
            inner join cat_producto p
              on p.codigo_categoria = k.codigo_categoria and
              p.codigo_subcategoria = k.codigo_subcategoria and
              p.codigo_producto = k.codigo_producto
            inner join cat_tipo_movimiento m
              on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
            inner join direccion d
              on k.id_dependencia = d.iddireccion
          where 
              k.codigo_categoria = $categoria and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo = 1
          order by p.producto";

	$tabla = "";
	
  $do=mssql_query($query);

  while($row = mssql_fetch_array($do)){
	//while($row = mysqli_fetch_array($registro)){		
		


		$tabla.='{
				          "Fecha":"'.$row['fecha'].'",
                  "Codigo":"'.$row['codigo'].'",
                  "Descripcion":"'.$row['producto'].'",
                  "CantidadIngresada":"'.$row['entrada'].'",
                  "CantidadDespachada":"'.$row['salida'].'",
                  "Existencias":"'.$row['saldo'].'"
				  
				},';		
	}	

	//eliminamos la coma que sobra
	$tabla = substr($tabla,0, strlen($tabla) - 1);

    echo '{"data":['.$tabla.']}';	


?>