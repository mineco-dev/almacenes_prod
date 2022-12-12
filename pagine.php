<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<body bgcolor=#FFFFFF> 
<?PHP

// Datos de conexión a la base

$base="almacen";
//servidor, usuario, password
//ini_set('mssql.charset', 'UTF-8');
$con=mssql_connect("server_appl","sa","Sup3rus3r2009");
mssql_select_db($base,$con);



if (!isset($pg))

$pg = 1; // $pg es la pagina actual

$cantidad=30; // cantidad de resultados por página

$inicial = $pg * $cantidad;



$pegar = "SELECT * FROM tb_kardex ORDER BY codigo_kardex, ".$inicial.",".$cantidad."";

$cad = mssql_query($base,$pegar) or die ("Error Query [".$pegar."]");



$contar = "SELECT * FROM tb_kardex ORDER BY codigo_kardex"; 

$contarok= mssql_query($base,$contar);

$total_records = mssql_num_rows($contarok);

$pages = intval($total_records / $cantidad);



// Imprimiendo los resultados

while($array = mssql_fetch_array($cad)) {

echo $array['codigo_kardex']."<br>";

} 



// Cerramos la conexión a la base

$con=mysql_close($con);



// Creando los enlaces de paginación

echo "<p>";

if ($pg <> 0)

{

$url = $pg - 1;

echo "<a href='pagine.php?pg=".$url."'>« Anterior</a> ";

}

else {

echo " ";

}



for ($i = 0; $i<($pages + 1); $i++) {

if ($i == $pg) {

echo "<font face=Arial size=2 color=ff0000><b> $i </b></font>";

}

else {

echo "<a href='pagine.php?pg=".$i."'>".$i."</a> ";

}

}



if ($pg < $pages) {

$url = $pg + 1;

echo "<a href='pagine.php?pg=".$url."'>Siguiente »</a>";

}

else {

echo " ";

}

echo "</p>";

?>

</body>
</html>
