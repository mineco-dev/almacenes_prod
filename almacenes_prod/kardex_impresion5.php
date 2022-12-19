<?		
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
span.blue {font-weight:bold;font-size:10px;
}
span.green {color:darkolivegreen;font-weight:bold}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<table width="1045"  border="1" cellpadding="1" cellspacing="1">
  <tr>
  <td width="1045" height="55">test</td>
  </tr>
   
   
   <tr>
    <td><?PHP 
			  
			  if ($cboMesi < 10)
			  {
			  	$cboMesi = '0'.$cboMesi;
			  }

			  if ($cboMesf < 10)
			  {
			  	$cboMesf = '0'.$cboMesf;
			  }

			  if ($cboDiai < 10)
			  {
			  	$cboDiai = '0'.$cboDiai;
			  }

			  if ($cboDiaf < 10)
			  {
			  	$cboDiaf = '0'.$cboDiaf;
			  }
			  
			  
			  
				$fecha1 = $cboDiai.'/'.$cboMesi.'/'.$cboAnioi;
				$fecha2 = $cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
				$fechahora1 = $cboAnioi.'-'.$cboMesi.'-'.$cboDiai.' 00:00:00';
				$fechahora2 = $cboAniof.'-'.$cboMesf.'-'.$cboDiaf.' 24:59:59';								
				$fecha1h = $fecha1.' 00:00:00';
				$fecha2h = $fecha2.' 24:59:59';		
				echo 'Reporte del '.$cboDiai.'/'.$cboMesi.'/'.$cboAnioi.' al '.$cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
		?></td></tr>
  
  
  <tr>
 <td width="1045" height="55">test</td></tr>
  
   <tr>
  <td width="1045" height="55">test</td>
  </tr>
  


    <td><table width="1015" border="1" cellpadding="0" cellspacing="0" align="center">
    
      <tr> 
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
        <td width="20">&nbsp;</td>
         <td width="20">&nbsp;</td>
          <td width="20">&nbsp;</td>
           <td width="20">&nbsp;</td>
            <td width="20">&nbsp;</td>
             <td width="20">&nbsp;</td>
      </tr>
      <tr>
        <td><?				

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
 
 $query_kardex = "use almacen_nuevo_qa 
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
 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria
 order by codigo_kardex asc";
 //print($query);
     }
	
	$do=$query($query_kardex);
				//$i = 0;									
				//$tmp = 0;
							
				while($vector=$fetch_array($do))
				{	
					//$err = 0;
		
					//include("css/format_table.php");									
echo '<tr> <td width="60px"><span class="blue">'.$vector["fecha"].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[2].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[3].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[4].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[5].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[6].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[7].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[8].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[9].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[10].'</span></td>';
echo '<td width="60px"><span class="blue">'.$vector[11].'</span></td>';
echo '<td width="355px"><span class="blue">'.$vector[12].'</span></td></tr>';										
					//$tmp++;
					//$i++;
					
				}				
			$free_result($do);
?></td>
      
    </table></td>
  </tr>
</table>
</body>
</html>
