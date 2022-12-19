<?php 
include("../connection/conexion.php");
header("Content-Type: text/html; charset=iso-8859-1");  
 ?>

<!DOCTYPE html>
<html lang="es-Es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/af-2.2.0/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/af-2.2.0/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
header, footer, nav, aside {
  display: none;
}

.t{
  background: #378AFB;
  color:white;
  
  
}
.th{
  text-align: center;
  
}


</style>




</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="left" class="boxBgWhite45">
 <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div align="center">
          <table  width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="33%"></td>
            </tr>
            <tr >
              <td class="success" >Fecha Impresion: <?php $hoy = date("d/m/Y"); print($hoy); ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="5" >Hora de Impresion: <?php $hoy = date("H:m:s"); print($hoy); ?></td>
              <td>&nbsp;</td>
            </tr>
          </table>
          </div></td>
      </tr>
  </table>

	 <div  class="container">
 <table id="dt" class="table table-striped table-hover " cellspacing="0" width="100%">
    <thead >
	<tr>
	<!-- <td style="border: 0px solid; border-color: #00FF00;" colspan="4"></td> -->
	<!-- <td style="border: 3px solid; border-color: #000000;" colspan="4"><center>Inventario General de Productos</center></td> -->
	<!-- <td style="border: 0px solid; border-color: #00FF00;" colspan="4"> <center>    SALDO INICIAL     <input type="NUMBER" size="6"> </center></</td> -->
	</tr>
    <tr class="t">
	          	<th class="th">Codigo del Producto</th>
          		<th class="th">Descripcion del Producto</th>
      			<th class="th">Unidad de Medida</th>
	 			<th class="th">Existencia</th>
	  
 </tr>

	
	  </thead>
	  <tbody>
<?				

 

 
// $query2 = "select (convert(varchar(12), a.codigo_categoria,101) + '    '+ convert(varchar(12), a.codigo_categoria,101)+'    ' + convert(varchar(12),a.codigo_producto,101)),producto,unidad_medida,existencia from cat_producto a
// inner join cat_medida b on b.codigo_medida = a.codigo_medida
// inner join tb_inventario c on c.codigo_producto = a.codigo_producto";
 
$query2 = "
SELECT     (convert(varchar(12),tb_inventario.codigo_categoria,101)+'  '+ convert(varchar(12),tb_inventario.codigo_subcategoria,101)+ ' '+ 
                      convert(varchar(12),tb_inventario.codigo_producto,101)) as codigo,cat_producto.producto, cat_medida.unidad_medida, tb_inventario.existencia
FROM         cat_medida INNER JOIN
                      cat_producto ON cat_medida.codigo_medida = cat_producto.codigo_medida INNER JOIN
                      tb_inventario ON cat_producto.codigo_categoria = tb_inventario.codigo_categoria AND cat_producto.codigo_subcategoria = tb_inventario.codigo_subcategoria AND 
                      cat_producto.codigo_producto = tb_inventario.codigo_producto

WHERE tb_inventario.existencia >0

ORDER BY codigo
";


 $consulta=mssql_query("select producto, mit.unidad_medida from dbo.cat_producto as pro inner join cat_medida as mit on mit.codigo_medida=pro.codigo_medida   where pro.activo = 1");
 

		echo "<center style='font-size:1.5em'>  Reporte de Saldos</center>";
		


	

 
 
 //print($query);


	
	
	

				$do=mssql_query($query2);
				$gt=0;
				$i = 0;									
				$tmp = 0;
				$k=array();
        $i = 0;
		

								
				while($vector = mssql_fetch_row($do))
				{	
					$err = 0;
          $i = $i+1;
					
			$cantidad=$vector[7]*$vector[8];
			
			
					// include("css/format_table.php");
					/*
					creacion del formato de impresion de kardex
					segun el requerimiento por el encargado de Almacen Noe Blas
					el numero de registros en la tarjeta tiene que se de 36
					y dos adicionales uno en el encabezado y elotro en el  pie de pagina 
					en el ENCABEZADO: VIENEN DE LA TARJETA NO. seguido de un input para ingresar el numero de las tarjetas
					en el PIE DE PAGINA: VAN A LA TARJETA NO. seguido de un input para ingresar el numero de tarjeta siguiente, 
					en la linea del VAN A LA TARJETA NO. va el ultimo registro de la consulta de 36 y se repite en el vienen de la siguiente pagina.
						DEV. Kevin de Paz			
					*/
								
					//imprime todos los valores que tiene el vector
            
					echo  '<tr><td >'.$vector[0].'</td><td >'.$vector[1].'</td><td ">'.$vector[2].'</td><td >'.$vector[3].'</td></tr>';		
					echo"";	
					
	

					
				}	
	
				mssql_free_result($do);
			
?>

		
		</tbody>

  </table>

  </div>
  
  <script>


  $(document).ready(function() {

$('#print_btn').click(function () {
          $('#dt').printThis();
        });

  	 var buttonCommon = {
        exportOptions: {
            format: {
                body: function ( data, row, column, node ) {
                    // Strip $ from salary column to make it numeric
                    return column === 5 ?
                        data.replace( /[$,]/g, '' ) :
                        data;
                }
            }
        }
    };
    var d = new Date();
  var fecha = d.toLocaleDateString('es-CL');
  var hora = d.toLocaleTimeString('es-CL');
    var totaltotal= null;
	$('#dt').DataTable( {

		"pagingType": "full",
		"searching": false,
		"ordering": true,
		"lengthChange": false,
		"autoWidth": false,
		"pageLength": 38,
		"responsive": true,
		"language": {
        "url": "datatable/json/Spanish.json"	
        },
       
        "dom": 'Bfrtip',
        "buttons": [


// $.extend( true, {}, buttonCommon, {
//                 extend: 'copyHtml5'

//             } ),
$.extend( true, {}, buttonCommon, {
                extend: 'excelHtml5',
                title: 'Reporte',
                
            } ),
$.extend( true, {}, buttonCommon, {
                extend: 'pdfHtml5',
                filename:'Reporte General al ' +fecha,
                message: 'Fecha Impresion: '+fecha+'\nHora Impresion: '+hora+'     ',
                title: 'Reporte de Saldos',

                

             
            } ),






				// text: 'Imprimir',
				// extend: 'print',
    //             exportOptions: {

    //                 columns: ':visible'
    //             }


// imprsion con mensaje
				// extend: 'print',
    //             message: 'This print was produced using the Print button for DataTables'
			

// cuarto ejemplo
     {
                extend: 'print',
                text:'Imprimir',
                title:'',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<tr><></td></tr>',
                            '<tr ><td >Fecha Impresion: <?php $hoy = date("d/m/Y"); print($hoy); ?></td>',
                            '</tr><tr><td colspan="5" >Hora de Impresion: <?php $hoy = date("H:m:s"); print($hoy); ?></td>',
                            '</tr></table>',
                            '<center >  Reporte General de Saldos</center>'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }



         ]
		
    } );
	//alert (table.page.info().page); 
	$('#dt_next').click( 'click', function () {
    //alert (table.page.info().page); 
} );
	

	
 	
} );



</script>


  

</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
			
			
            
</body>




</html>
