<?PHP
	require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");		
?>
<table width="1100" height="807" border="1" cellpadding="1" cellspacing="1">
    
    
  <tr>
    <td height="831" valign="top"><table width="1100" height="189" border="0" cellpadding="1" cellspacing="1">
      <tr>
      <td width="1100" height=70" colspan="8" "style:>      </td>
      </tr></table>
      <table width="1100"  height="550"border="1" cellspacing="1" cellpadding="1">
        <tr>
          <td><?				

$hoja_ingreso=$_SESSION["hoja_kardex"];

/*$query = "select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
t.nombre as solicitante,
		t.pregunta,t.idsolicitud,t.telefono,p.pais						
from
	tbl_solicitud t, tbl_pais p
	where 
year(t.fechahora) >= '$cboAnioi' and month(t.fechahora) >= '$cboMesi' and day(t.fechahora) >= '$cboDiai'
and year(t.fechahora) <= '$cboAniof' and month(t.fechahora) <= '$cboMesf' and day(t.fechahora) <= '$cboDiaf'
and t.idpais = p.idpais 
order by t.fechahora desc";*/



/*
$query = "select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
						CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
						t.nombre as solicitante,
						t.pregunta,t.idsolicitud,t.telefono,p.pais
						
 from
	tbl_solicitud t, tbl_pais p
	where 
	fechahora >= '$fecha1h' and fechahora <= '$fecha2h' and t.idpais = p.idpais 
 order by fechahora desc";*/
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
 
 $query = "use almacen_nuevo 
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
 k.no_requisicion
 
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
	
	
				$do=mssql_query($query);
				$i = 0;									
				$tmp = 0;
		

								
				while($vector = mssql_fetch_row($do))
				{	
					$err = 0;
		
					include("css/format_table.php");									
echo '<tr class='.$clase.'><td colspan="2">'.$vector[0].'</td><td>'.$vector[2].'</td><td>'.$vector[3].'</td><td>'.$vector[4].'</td><td>'.$vector[5].'</td><td>'.$vector[6].'</td><td>'.$vector[7].'</td><td>'.$vector[8].'</td><td>'.$vector[9].'</td><td>'.$vector[10].'</td><td>'.$vector[11].'</td><td>'.$vector[12].'</td><td>'.$vector[13].'</td></tr>';										
					$tmp++;
					$i++;
					
				}				
				mssql_free_result($do);
?></td>
        </tr>
      </table>
   
    </tr>
  
  
    
</table>
