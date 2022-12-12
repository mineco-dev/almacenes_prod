<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
body {
	background-image: url(../images/fondo1.jpg);
}
.Estilo1 {
	font-size: 14pt;
	font-weight: bold;
}
.style2 {color: #000000}
-->
</style>
</head>
<SCRIPT language=javascript>
function cOn(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#FFF2F2";
}
}

function cOut(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#FFFFFF";
}
}

//-->
</SCRIPT>

<body>
<table cellspacing=0 cellpadding=0 width="100%" border=0 id="table25">
  <tbody>
    <tr>
      <td width="1%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</td>
      <td width="99%" align=right valign=bottom style="font-size: 10pt; font-family: verdana,arial"><p align="justify">
      
    <tr>
  <td width="1155" height="51"></td>
  </tr>
    <?PHP
conectardb($almacen);	
	$Fields="use almacen_nuevo 
		select producto
			 from cat_producto
				where 
 					codigo_producto ='$producto' 
					and codigo_categoria = '$categoria'
					and codigo_subcategoria = '$subcategoria'";
			$res_qry_producto=$query($Fields);
		
		while($row=$fetch_array($res_qry_producto))
		{				
			$nombre_producto=$row["producto"];
		}
	?>
    	
	<?PHP
	
	$Fields2="use almacen_nuevo
	select 
	saldo
	from tb_kardex
	where 
	codigo_kardex in(select min(codigo_kardex) from tb_kardex where codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and codigo_producto=$producto
	and codigo_bodega = 8 and 
	codigo_tipo_movimiento = 1
	and saldo is not null)";
				
				$res_qry_producto=$query($Fields2);
				
				while($row=$fetch_array($res_qry_producto)) 
		{				
			$saldo=$row["saldo"];
		}
	
?> 

<td>
   <table width="1152" border="0" cellspacing="1" cellpadding="1" align="center">
   <tr>
    <td width="103">&nbsp;</td>
    <td width="248"><?PHP 
		
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
				//echo 'Reporte del '.$cboDiai.'/'.$cboMesi.'/'.$cboAnioi.' al '.$cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
//		print($saldo); 
		 print($categoria. ' - ');print($subcategoria. ' - ');print($producto. '');
		
		?>		</td>
	    <td width="1500"><?PHP echo $nombre_producto; ?></td> <!--imprime nombre de producto--> 
    		<!--<td width="4">&nbsp;</td> 
    		<td width="6">&nbsp;</td>-->
    		<td style="font-size:10px; font-family:arial;"> <?PHP print($saldo);?> </td>  <!--imprime saldo del producto-->
	  </tr>
</table>
</td>
   <tr>
	 <td width="1155" height="94"><p align="right">&nbsp;</p></td>
  </tr>

       <td height="52"><table width="1152" border="0" cellpadding="0" cellspacing="0" align="center">
     <tr bordercolor="#000000"> 
        <td width="86" height="23"><span class="style2"></span></td>
        <td width="73">&nbsp;</td>
        <td width="81">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="75">&nbsp;</td>
        <td width="65">&nbsp;</td>
        <td width="82">&nbsp;</td>
        <td width="81">&nbsp;</td>
        <td width="81">&nbsp;</td>
        <td width="84">&nbsp;</td>
        <td width="252">&nbsp;</td>
      </tr>
      
      <tr>
        <td><span class="style2">
          				
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table23">
  <TBODY>
    <TR>
      <TD colSpan=3 height=15 style="font-size: 10pt; font-family: verdana,arial"></TD>
    </TR>
    <TR>
      <TD width="2%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
      <TD width="97%" style="font-size: 10pt; font-family: verdana,arial"><TABLE width="100%" 
      border=2 align="center" cellPadding=40 cellSpacing=0 borderColor=#000000 id="table24">
          <TBODY>
            <TR>
              <TD width="100%" bgColor=#ffffff style="font-size: 10pt; font-family: verdana,arial" align="center"><p align="center" style="margin-top: 0">
				 
				  &nbsp;</p>
                  <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#333333">
                    <tr>
                      <td width="11%">Paginas:</td>
                      <td width="89%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
					  <tr>
					  <?PHP
                        $y = date("Y");
						$yy = $y-1;  
						/* contador de paginas */
						//require ('../conexion.inc');
						////ini_set('mssql.charset', 'UTF-8');
						$db = mssql_connect($SERVIDOR,$USUARIO,$PASSWORD);
						mssql_select_db($BASE_DATOS,$db);

						$SQL = "select count(1) from tb_kardex k WHERE 
						codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and codigo_producto=$producto and 
						k.codigo_bodega = 8";
						
						//print $SQL;
						$result = mssql_query($SQL);
						$row = mssql_fetch_row($result);
						$paginas = round($row[0]/10);
						for($p=0;$p<=$paginas;$p++)
						{
							echo "<a href='kardex_impresion7.php?conta=$p' ><td onmouseover=cOn(this); onmouseout=cOut(this);> $p </td> </a>";
						}                   
			/********** fin de contador de paginas ************/		
						?></tr>
                      </table>					  </td>
                    </tr>
                  </table>                  
                  <table width="1152" border="0" cellpadding="0" cellspacing="0" align="center">
                    <tr bordercolor="#000000">
                      <td width="86" height="23"><span class="style2"></span></td>
                      <td width="73">&nbsp;</td>
                      <td width="81">&nbsp;</td>
                      <td width="96">&nbsp;</td>
                      <td width="96">&nbsp;</td>
                      <td width="75">&nbsp;</td>
                      <td width="65">&nbsp;</td>
                      <td width="82">&nbsp;</td>
                      <td width="81">&nbsp;</td>
                      <td width="81">&nbsp;</td>
                      <td width="84">&nbsp;</td>
                      <td width="252">&nbsp;</td>
                    </tr>
                    <tr>
                      <td><span class="style2">
                        <!---------------------------------------------------------fin del encabezado del reporte--------------------------------------------->
                        <!---------------------------------------------------------inicio del cuerpo del reporte--------------------------------------------->
                        <?PHP
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
conectardb($almacen);
$query_kardex = "use almacen_nuevo 
select top 62 CONVERT(nvarchar(10), k.fecha, 103) as fecha,
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
 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8
 and k.codigo_kardex BETWEEN (select min(k.codigo_kardex) from tb_kardex k) AND (select max(k.codigo_kardex) from tb_kardex k)
 order by codigo_kardex asc";

     }
	$do=$query($query_kardex);
				$i = 0;									
				$tmp = 0;    
			while($vector = $fetch_array($do))
				{	
					
		
					//include("css/format_table.php");									
echo '<table>
<tr> 
<td aling="left"><span class="blue">'.$vector["fecha"].'</span></td>';
echo '<td aling="center"><span class="blue">'.$vector["tipo_movimiento"].'</span></td>';
echo '<td aling="center"><span class="blue">'.$vector["no_despacho"].'</span></td>';
echo '<td aling="center"><span class="blue">'.$vector["no_ingreso"].'</span></td>';
echo '<td aling="center"><span class="blue">'.$vector["entrada"].'</span></td>';
echo '<td aling="center"><span class="blue">'.$vector["salida"].'</span></td>';
echo '<td aling="center"><span class="blue">'.$vector["saldo"].'</span></td>';
echo '<td aling="center"><span class="blue">Q.'.$vector["costo_promedio"].'</span></td>';
echo '<td aling="center"><span class="blue">Q.'.$vector["costo_factura"].'</span></td>';
echo '<td aling="center"><span class="blue">Q.'.$vector["costo_movimiento"].'</span></td>';
echo '<td aling="center"><span class="blue">Q.'.$vector["costo_total"].'</span></td>';
echo '<td aling="center"><span class="blue">'.$vector["nombre"].'</span></td>
</tr>
</table>';						
					//$tmp++;
					//$i++;
					}				
			$free_result($do);
?>
                      </span></td>
                    </table>
                  <p align="center"><BR clear=all>
                  </p>
                  <p>&nbsp;                    </p>
                  <p>&nbsp;</p>
			  </TD>
            </TR>
          </TBODY>
      </TABLE></TD>
      <TD width="1%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>

    <TR>
      <TD colSpan=3 style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>

</body>
</html>
