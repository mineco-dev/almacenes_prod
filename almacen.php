<?
require("includes/funciones.php");
require("includes/sqlcommand.inc");	

$dia_numero= date("d");
$dia_letras = date('D');

conectardb($almacen);											
					$qry_tipo_empresa="use almacen; SELECT * FROM dbo.fecha";										
					$res_qry_tipo_empresa=$query($qry_tipo_empresa);	
					   
				
					while($row_tipo_empresa=$fetch_array($res_qry_tipo_empresa))
					{
				    $contador = $row_tipo_empresa["id_fecha"];
					$valida =$row_tipo_empresa["dia"];

					}
							
					$free_result($res_qry_tipo_empresa);	
  
if($dia_numero >=1  && $dia_letras != "Sun" && $dia_letras != "Sat")
{
 
 $contador= $contador +1;

 if($contador <=9 )
 
 {
     
	 if( $dia_numero != $valida)
	  {
  $qry_actualiza="update dbo.fecha set id_fecha ='$contador', dia='$dia_numero' where id_fecha >=0";
		$query($qry_actualiza);	
		
		
	  }
 
 
	  
 }
 else

{ 
		
 
 if($dia_numero >=1 && $dia_numero <=3  && $dia_letras != "Sun" && $dia_letras != "Sat")
 {
 $qry_actualiza="update dbo.fecha set id_fecha =0, dia=0 where id_fecha >=0";
		$query($qry_actualiza);	
 
 $qry_actualiza="update dbo.tb_requisicion_enc set codigo_estatus =9 where codigo_estatus =3";
		$query($qry_actualiza);	
		
 $qry_actualiza="update dbo.tb_inventario set cantidad_comprometida=0 where codigo_bodega=8";
		$query($qry_actualiza);	

 }
 
}
 

}
?>

