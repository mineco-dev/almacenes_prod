<?php 
    require('../conexion.php');
    $con=conectar();


     $query = " use almacen_nuevo_qa 
   					select distinct(c.codigo_categoria), c.categoria 
   					from cat_subcategoria s
    					inner join cat_categoria c
    					on c.codigo_categoria = s.codigo_categoria order by c.categoria";
//$filas = mysqli_num_rows($sesion);
  	$do=mssql_query($query);
	$rowdata=array();
	$i=0;
        while($row = mssql_fetch_array($do))
        {
            
            $rowdata[$i]=$row;
            $i++;           
        }

        echo json_encode($rowdata);
        
        
?>