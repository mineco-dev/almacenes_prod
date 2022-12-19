<?php
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
conectardb($almacen);
	 $query = "SELECT
			ROW_NUMBER() OVER(ORDER BY codigo_kardex asc) AS Row,  
			CONVERT(nvarchar(10), k.fecha, 103) as fecha,
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
			d.nombre
			from tb_kardex k
			inner join cat_tipo_movimiento m
			on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
			inner join direccion d
			on k.id_dependencia = d.iddireccion 
				where 
				CONVERT(varchar(20), k.fecha, 120) >= '2017-01-01 00:00:00' and CONVERT(varchar(20), k.fecha, 120) <= '2018-05-09 24:59:59' 
			 and k.codigo_producto = 1 and k.codigo_categoria = 211 and k.codigo_subcategoria = 1300 and codigo_empresa = ".$_SESSION["empresax"]." and k.codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo=1 
			 order by codigo_kardex asc";
$do=mssql_query($query);


$QueryRow ="SELECT
	 	COUNT(codigo_kardex) as cantidad
		from tb_kardex k
		inner join cat_tipo_movimiento m
		on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
		inner join direccion d
		on k.id_dependencia = d.iddireccion 
		where 
			CONVERT(varchar(20), k.fecha, 120) >= '2017-01-01 00:00:00' and CONVERT(varchar(20), k.fecha, 120) <= '2018-05-09 24:59:59' 
		and k.codigo_producto = 1 and k.codigo_categoria = 211 and k.codigo_subcategoria = 1300 and codigo_empresa = ".$_SESSION["empresax"]." and k.codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo=1 
		";

$cantidad=mssql_query($QueryRow);

while ($filas = mssql_fetch_row($cantidad)) {
	$countRows = $filas[0];
}

$cantidadHojas = (int)($countRows /24)+1;

$array = array();
$a = 0;		
$b = 24;
$xx = 0;



					while($vector = $fetch_array($do))	
						{
								$row[] = $vector['Row'];
								$fecha[] = $vector['fecha'];
								$movimiento[] = $vector['tipo_movimiento'];
								$despacho[] = $vector['no_despacho'];
								$ingreso[] = $vector['no_ingreso'];
								$entrada[] = $vector['entrada'];
								$salida[] = $vector['salida'];
								$saldo[] = $vector['saldo'];
								$costo_promedio[] = $vector['costo_promedio'];
								$costo_factura[] = $vector['costo_factura'];
								$costo_movimiento[] = $vector['costo_movimiento'];
								$costo_total[] = $vector['costo_total'];
								$nombre[] = $vector['nombre'];

						}
								
								
					
			
echo $nombre[10];
?>