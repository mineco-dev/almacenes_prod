<?php
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
    $CostoControlInicial = 0;
	$PromedioControlInicial = 0;
	$SaldoControlInicial =0;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Puede buscar por nombre, apellido, extensión o dependencia"); 
	form.txt_buscar.focus(); 
	return;
  }  
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
form.submit();
}
</script>
<link href="css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<!--<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>-->
<style type="text/css">

<!--
.Estilo14 {font-size: 6px;  font-family: Arial, Helvetica, sans-serif;}
.Estilo15 {font-size: 10px;  font-family: Arial, Helvetica, sans-serif;}

-->
</style>
<style>
#divc { max-height: 5px }

</style>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatable/css/dataTables.responsive.min.js">


<script type="text/javascript" language="javascript" src="datatable/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="datatable/js/page.jumpToData().js"></script>

<style>
header, footer, nav, aside {
  display: none;
}
</style>

<style>


#dt {
    font-size: small;
    font-style: normal;
    color: -internal-quirk-inherit;
    text-align: start;
     border: 1px solid black;
}

#dt th {    
	 border: 2px solid black;
	background-color: 	#cde;
	text-align: center;
}#dt td {    
       text-align: ceter;
	font-size: 80%;
    font-family: Arial, Helvetica, sans-serif;
	padding: 0px 5px 0px;
	 border: 1px solid gray;
}





</style>


</head>
<body style="width: 98%; margin-left: 1%">
<div align="left" class="boxBgWhite45">
 <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" style="margin-top: 70px;">
      <tr>
        <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"></td>
              <!--<td width="72%"><div align="center" class="legal1">Tarjeta de Kardex de Almacen Compra General</div></td>-->
			  
              <!--<td width="15%"><div align="center"><img src="mineco.JPG" width="107" height="113"></div></td>-->
            </tr>
            <tr>
              <td colspan="3">Codigo Articulo
              <?php 
              $MesInicioControl;
				$AnioIncioControl;
				$FechaInicioControl;
				$FechaFinalControl;
						  
			  if ($_POST['cboMesi'] < 10)
			  {
			  	if($_POST['cboMesi'] == 1)
				{
					$MesInicioControl = 12;
					$AnioInicioControl = $_POST['cboAnioi'] - 1;
				}
				else
				  	$MesInicioControl = '0'.$_POST['cboMesi'] - 1;
					
				$_POST['cboMesi'] = '0'.$_POST['cboMesi'];
			  }

			  if ($_POST['cboMesf'] < 10)
			  {
			  	$_POST['cboMesf'] = '0'.$_POST['cboMesf'];
			  }

			  if ($_POST['cboDiai'] < 10)
			  {
			  	$_POST['cboDiai'] = '0'.$_POST['cboDiai'];
			  }

			  if ($_POST['cboDiaf'] < 10)
			  {
			  	$_POST['cboDiaf'] = '0'.$_POST['cboDiaf'];
			  }
              $cboMesi= $_POST['cboMesi'];
              $cboAnioi=$_POST['cboAnioi'];
              $cboMesf= $_POST['cboMesf'];
              $cboDiai= $_POST['cboDiai'];
              $cboDiaf= $_POST['cboDiaf'];
              $cboAniof = $_POST['cboAniof']; 
			  
			$FechaInicioControl = $AnioInicioControl . '-' . $MesInicioControl . '-01' .' 00:00:00';
			if(($MesInicioControl)  === '02')
			{
				$FechaFinalControl = $AnioInicioControl . '-' . $MesInicioControl . '-28';
			}
			else{
				if((($MesInicioControl) == 4) || (($MesInicioControl) == 6) || (($MesInicioControl) == 9) ||(($MesInicioControl) == 11) ) 
				{
					$FechaFinalControl = $AnioInicioControl . '-' . $MesInicioControl . '-30';
				}
				else
				{
					$FechaFinalControl = $AnioInicioControl . '-' . $MesInicioControl . '-31' . ' 24:59:59';
				}
			}
			  
			  
			  
				$fecha1 = $cboDiai.'/'. $cboMesi .'/'.$cboAnioi;
				$fecha2 = $cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
				$fechahora1 = $cboAnioi.'-'.$cboMesi.'-'.$cboDiai.' 00:00:00';
				$fechahora2 = $cboAniof.'-'.$cboMesf.'-'.$cboDiaf.' 24:59:59';								
				$fecha1h = $fecha1.' 00:00:00';
				$fecha2h = $fecha2.' 24:59:59';	
                $categoria    = $_POST["select1"];
                $subcategoria = $_POST["select2"];
                $producto     = $_POST["select3"];
	

//print($categoria); echo ' - '; print($subcategoria);  echo ' - ';	print($producto);
		
		?>
		<?= $_REQUEST["select1"] . ' - ' . $_REQUEST["select2"] . ' - ' . $_REQUEST["select3"] ?>
		<br>C. D.</td>
            </tr>
          </table>
          </div></td>
      </tr>
  </table>

	 <div id="divc">
 <table id="dt" class="display compact nowrap" cellspacing="0" width="10%">
    <thead>
	<tr>
	<td style="border: 0px solid; border-color: #00FF00;" colspan="4"></td>
	<td style="border: 3px solid; border-color: #000000;" colspan="3"><center>UNIDADES</center></td>
	<td style="border: 0px solid; border-color: #00FF00;" colspan="4"> <center>    SALDO INICIAL     <input type="NUMBER" size="6"> </center></td>
	</tr>
    <tr >
	          <th>Fecha</th>
          <th>Tipo Mov.</th>
      <th>No. Desp.</th>
	  <th>No. Ingre.</th>
	  <th>Entrada</th>
      <th>Salida</th>
	   <th>Saldo</th>
          <th>Promedio</th>
          <th>Factura</th>
          <th>Mov.</th>
          <th>Ext.</th>
      <th>Proveedor/Dependencia</th>
 </tr>
 <!--<tr>
	<td colspan="5">VIENEN DE LA TARGETA NO. <input type="number" align="center"/></td>
	<td></td>
	<td></td>
	<td></td>
	<td ><center></center></td>
	<td></td>
	<td></td>
	<td></td>
	
	</tr>-->
	<??>
	  </thead>
	  <tbody>
<?				

	conectardb($almacen);


 if ($_REQUEST["select1"]!="0")
	{
		//session_register("categoria");
		$_SESSION["categoria"]=$_REQUEST["select1"];  //para un reporte por categoria		
		
		if ($_REQUEST["select2"]!="0")
		{
			//session_register("subcategoria");
			$_SESSION["subcategoria"]=$_REQUEST["select2"];  //para un reporte por subcategoria
			
			if ($_REQUEST["select3"]!="0")
			{
				//session_register("producto");
				$_SESSION["producto"]=$_REQUEST["select3"];  //para un reporte por producto
			}	//fin producto
		}		//fin subcat
	} //fin de evaluacion de categoria	
	
 if (isset($_SESSION["categoria"]))
				 {				
					$prodcuto=$_SESSION["producto"];	
					$categoria=$_SESSION["categoria"];	
					$subcategoria=$_SESSION["subcategoria"];	
					
//print($prodcuto);
//print($categoria);
//print($subcategoria);

 conectardb($almacen);

  $queryControl = "use almacen_nuevo_qa
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
 k.fecha as Fecha2
 from tb_kardex k
inner join cat_tipo_movimiento m
on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
inner join direccion d
on k.id_dependencia = d.iddireccion 
	where 
	CONVERT(varchar(20), k.fecha, 120) >= '".$FechaInicioControl."' and CONVERT(varchar(20), k.fecha, 120) <= '".$FechaFinalControl."' 
 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = 1 and k.codigo_bodega = 15 and k.activo=1 
 order by codigo_kardex asc";
 
 $ResultadoControl = mssql_query($queryControl);
 while($rowControl = mssql_fetch_row($ResultadoControl))
 {
 	$CostoControlInicial = $rowControl[11];
	$PromedioControlInicial = $rowControl[8];
	$SaldoControlInicial = $rowControl[7];
 }
 
 $query = "use almacen_nuevo_qa
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
 d.nombre
 from tb_kardex k
inner join cat_tipo_movimiento m
on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
inner join direccion d
on k.id_dependencia = d.iddireccion 
	where 
	CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = 1 and k.codigo_bodega = 15 and k.activo=1 
 order by codigo_kardex asc";
 



 $consulta=mssql_query("select producto, mit.unidad_medida from dbo.cat_producto as pro inner join cat_medida as mit on mit.codigo_medida=pro.codigo_medida   where codigo_producto = $producto and codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and  pro.activo = 1");
 

	
	while($registro=mssql_fetch_row($consulta))
	{
		echo "<center id='nombre_origen'>  Articulo: ".utf8_encode($registro['0'])." - ".$registro['1']." </center>";
		echo "<input type='text' style='display:none;' id='nombre_control' value='".$registro['0']." - ".$registro['1']."' >";
	}
 

 
 
 //print($query);

}
	
	
	
	
				$do=mssql_query($query);
				$gt=0;
				$i = 0;									
				$tmp = 0;
				$k=array();
				$corte = false;
				$enero = false;
		

								
				while($vector = mssql_fetch_row($do))
				{	
					$err = 0;
					
					$cantidad=$vector[7]*$vector[8];
			
			
					include("css/format_table.php");
					/*
					creacion del formato de impresion de kardex
					segun el requerimiento por el encargado de Almacen Noe Blas
					el numero de registros en la targeta tiene que se de 36
					y dos adicionales uno en el encabezado y elotro en el  pie de pagina 
					en el ENCABEZADO: VIENEN DE LA TARJETA NO. seguido de un input para ingresar el numero de las targetas
					en el PIE DE PAGINA: VAN A LA TARJETA NO. seguido de un input para ingresar el numero de targeta siguiente, 
					en la linea del VAN A LA TARJETA NO. va el ultimo registro de la consulta de 36 y se repite en el vienen de la siguiente pagina.
						DEV. Kevin de Paz			
					*/

					$fechaControl = explode('/', $vector[0]);
					$condicional = $i-1;
					
					if((int)$fechaControl[1] == 12)
					{
						$enero = true;
					}
					
					if($enero == true)
					{
						if((int)$fechaControl[1] != 12)
						{
							$corte = true;
						}
					}
					
					if($corte == true)
					{
						$corte = false;
						$enero = false;
						while(($condicional+1) % 36 != 0)
						{
					/*echo "<tr><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'><td><img src = 'images/Diagonal.png' style = 'width: 200px; height: 15px;'></tr>";*/
							echo "<tr><td style = 'padding:1px;'>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td></tr>";
							$condicional++;	
							$i++;
						}	
						echo "<tr><td style = 'padding:5px;'>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td></tr>";
						echo  '<tr style="background-color:#EBEBEB"><td ></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'.$PrevioSaldo.'</td><td height="5">'.$PrevioPromedio.'</td><td height="5"> </td><td height="5"></td><td height="5">'.$PrevioTotal.'</td><td height="5"></td></tr>';
					}

					if($i==0){
						//imprimir el encabezado del formato 
						echo  '<tr style="background-color:#EBEBEB"><td ></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'.$SaldoControlInicial.'</td><td height="5">'.$PromedioControlInicial.'</td><td height="5"> </td><td height="5"></td><td height="5">'.$CostoControlInicial.'</td><td height="5"></td></tr>';			
					}					
					//imprime todos los valores que tiene el vector
						echo  '<tr style="height:17px;"><td height="8">'.$vector[0].'</td><td height="8">'.$vector[2].'</td><td height="8">'.$vector[3].'</td><td height="8">'.$vector[4].'</td><td height="8">'.$vector[5].'</td><td height="8">'.$vector[6].'</td><td height="8">'.$vector[7].'</td><td height="8"> Q';
						if($vector[6] > 0){
							echo '0.00';
						}
						else{
							echo number_format($vector[8], 2, '.', ' ');	
						}
						echo '</td><td height="8">Q'.number_format($vector[9], 2, '.', ' ').'</td><td height="8"> Q'.number_format($vector[10], 2, '.', ' ').'</td><td height="8"> Q'./*$cantidad*/number_format($vector[11], 2, '.', ' ').'</td><td height="8">'.$vector[12].'</td></tr>';		
						echo"";	
					
					if(($i+1) % 36 == 0)//El quererimiento fue que la targeta tuviera 36 elementos |aqui dividimos el numero de registro en 36 y si el resto es 0 imprimir la linea van
					{
											
						//echo $k[$i]=$vector;
						//
						echo  '<tr style="background-color:#EBEBEB"><td >VAN A LA TARJETA NO.</td><td height="5"><input type="number"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'.$vector[7].'</td><td height="5"> Q'.$vector[8].'</td><td height="5"></td><td height="5"> </td><td height="5"> Q'./*$cantidad*/$vector[11].'</td><td height="5"></td></tr>';	
						//echo  '<tr style="border-bottom:0pt solid black;"><td >VIENEN A LA TARGETA</td><td height="5"><input type="number"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'.$vector[7].'</td><td height="5"> Q'.$vector[8].'</td><td height="5"></td><td height="5"> Q'.$vector[10].'</td><td height="5"> Q'./*$cantidad*/$vector[11].'</td><td height="5">'.$vector[12].'</td></tr>';													
						echo  '<tr style="background-color:#EBEBEB"><td >VIENEN DE LA TARJETA NO.</td><td height="5"><input type="number"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'.$vector[7].'</td><td height="5">Q'.$vector[8].'</td><td height="5"> </td><td height="5"></td><td height="5">Q'./*$cantidad*/$vector[11].'</td><td height="5"></td></tr>'; 
										}

					//en la variable $tmp guardamos el van para su posterior impresion
					$tmp='<tr style="background-color:#EBEBEB"><td >VAN A LA TARJETA NO.</td><td height="5"><input type="number"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'.$vector[7].'</td><td height="5"> Q'.$vector[8].'</td><td height="5"></td><td height="5"></td><td height="5"> Q'./*$cantidad*/$vector[11].'</td><td height="5"></td></tr>';
					$FechaFinal = strtotime($vector[13]);
					$PrevioTotal = $vector[11];
					$PrevioPromedio = $vector[8];
					$PrevioSaldo = $vector[7];
					$i++;

					
				}	
					while(($condicional+1) % 36 != 0)
					{
						echo "<tr><td style = 'padding:1px;'>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td><td>\</td></tr>";
						$condicional++;	
					}
				mssql_free_result($do);
			
?>
		
		</tbody>

  </table>
  </div>
  
  <script>

  $(document).ready(function() {

  	let nombre_control = $('#nombre_control').val()

  	if(nombre_control.length > 55){
  		$('#nombre_origen').css({
  			'font-size': '85%'
  		})
  	}
  	if(nombre_control.length > 100){
  		$('#nombre_origen').css({
  			'font-size': '75%'
  		})
  	}

    var totaltotal= null;
	var table=$('#dt').DataTable( {
		
		"pagingType": "simple",
		"searching": false,
		 "ordering": false,
		 "lengthChange": false,
		"autoWidth": false,
		 "pageLength": 38,
		  "responsive": false,
		  "language": {
            "url": "datatable/json/Spanish.json"
			
        },
		
		  
        /*"footerCallback": function ( row, data, page, page, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
	
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return  intVal(b);
                }, 0 );
				
				// Total over this page
            pageTotalgt = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return  b;
                }, 0 );
				
				// Total over this page
            pageTotalal = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return  b;
                }, 0 );
				
						
            
			// Update saldo
            $( api.column( 6 ).header() ).html(
               pageTotal
            );

			// Update movimiento
            $( api.column( 9 ).header() ).html(
               pageTotalgt
            );
			// Update ext
            $( api.column( 10 ).header() ).html(
               pageTotalal
            );
			
			// Update saldo
            $( api.column( 6 ).footer() ).html(
               pageTotal
            );

			// Update movimiento
            $( api.column( 9 ).footer() ).html(
               pageTotalgt
            );
			// Update ext
            $( api.column( 10 ).footer() ).html(
               pageTotalal
            );
			
						
			totaltotal=pageTotal;
        }*/
    } );
	//alert (table.page.info().page); 
	$('#dt_next').click( 'click', function () {
    //alert (table.page.info().page); 
} );
	


/*var info = table.page.info();
 
$('#dt').html(
    'Currently showing page '+(info.page+1)+' of '+info.pages+' pages.'
);*/


	
 	
} );

</script>


  

<!--  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;van a la tarjeta No.</p> --> 
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
			
			
            
</body>

</html>
