<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<?php 
//Limito la busqueda  
$TAMANO_PAGINA = 15;  

//examino la página a mostrar y el inicio del registro a mostrar  
$pagina = $_GET["pagina"];  
if (!$pagina) {  
$inicio = 0;  
$pagina=1;  
}  
else {  
$inicio = ($pagina - 1) * $TAMANO_PAGINA;  
}  
//miro a ver el número total de campos que hay en la tabla con esa búsqueda  
////ini_set('mssql.charset', 'UTF-8');
$db = mssql_connect('server_appl','sa','Sup3rus3r2009');
mssql_select_db('almacen_nuevo_qa',$db);
$ssql = "select * from tb_kardex where codigo_bodega = 8 and
codigo_categoria = 241
and codigo_subcategoria = 600
and codigo_producto= 1";  
$rs = mssql_query($ssql);  
$num_total_registros = mssql_num_rows($rs);  
//calculo el total de páginas  
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);  

//pongo el número de registros total, el tamaño de página y la página que se muestra  
echo "Número de registros encontrados: " . $num_total_registros . "<br>";  
echo "Se muestran páginas de " . $TAMANO_PAGINA . " registros cada una<br>";  
echo "Mostrando la página " . $pagina . " de " . $total_paginas . "<p>";  
//construyo la sentencia SQL  
$ssql = "select codigo_kardex, codigo_ from tb_kardex" . $inicio . "," . $TAMANO_PAGINA;  
$rs = mssql_query($ssql);  
while($f=mssql_fetch_array($rs)){  
echo '<tr>'.$f['codigo_tipo_movimiento'].'</td><br />';  
echo '<tr>'.$f['fecha'].'</td><br />';  
//echo nl2br (substr(($f['noticia']),0,150)) . "...";  
//echo '<tr><a href="paginacion.php?id='.$f['codigo_kardex'].'">[Ver todo]</a><br /><br /><br />';  
}  
//cerramos el conjunto de resultado y la conexión con la base de datos  
mssql_free_result($rs);  
//muestro los distintos índices de las páginas, si es que hay varias páginas  
if ($total_paginas > 1){  
for ($i=1;$i<=$total_paginas;$i++){  
if ($pagina == $i)  
//si muestro el índice de la página actual, no coloco enlace  
echo $pagina . " ";  
else  
//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
echo "<a href='paginacion.php?pagina=" . $i ."'>" . $i . "</a> ";  
}  
}
<body>
</body>
</html>
