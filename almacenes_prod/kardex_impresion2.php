<?		
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<html>
<head>
<style type="text/css">
span.blue {font-weight:bold;font-size:10px;
}
span.green {color:darkolivegreen;font-weight:bold}
</style>
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {font-size: 9px}
-->
</style>
</head>

<body>

<div>

    <table width="1047px"  border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div>
          <table width="1047px" border="0" cellspacing="0" cellpadding="0">
            <tr>
             
              <td width="1047px"><div align="center" class="legal1">Tarjeta de Kardex de Almacen</div></td>
            
            </tr>
            <tr>
              <td colspan="2"><?PHP 
			  
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
		?>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p></td>
          
            </tr>
          </table>
          </div></td>
      </tr>
  
  
  
  
  
    </table>
    
	
<table cellpadding="2" cellspacing="1" border="0" width="1047px" id="table17">     
 
<?				



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
	
	
				$do=mssql_query($query);
				$i = 0;									
				$tmp = 0;
		

								
				while($vector = mssql_fetch_row($do))
				{	
					$err = 0;
		
					//include("css/format_table.php");									
echo '<tr><td width="10px"></td>
<td width="5px"><span class="blue">'.$vector[0].'</span></td>
<td width="5px"><span class="blue">'.$vector[2].'</span></td>
<td width="5px"><span class="blue">'.$vector[3].'</span></td>
<td width="5px"><span class="blue">'.$vector[4].'</span></td>
<td width="5px"><span class="blue">'.$vector[5].'</span></td>
<td width="5px"><span class="blue">'.$vector[6].'</span></td>
<td width="5px"><span class="blue">'.$vector[7].'</span></td>
<td width="5px"><span class="blue">'.$vector[8].'</span></td>
<td width="5px"><span class="blue">'.$vector[9].'</span></td>
<td width="5px"><span class="blue">'.$vector[10].'</span></td>
<td width="5px"><span class="blue">'.$vector[11].'</span></td>
<td width="10px"><span class="blue">'.$vector[12].'</span></td>
</tr>';										
					$tmp++;
					$i++;
					
				}				
				mssql_free_result($do);
?>
		
  </table>

 
</div>
<!-- /forum rules and admin links -->

	
            
</body>

</html>

