<?		
	//include("../pagemaker.php");
	//require("../includes/sqlcommand.inc");	
	//require("../includes/encabezado.php");
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<html> 
<body> 
<?php 
$link = mssql_connect("server_appl","sa","Sup3rus3r2009"); 
mssql_select_db("almacen",$link); 
$result = mssql_query("SELECT nombres, departamento FROM empleado", $link); 
if (mssql_num_rows($result)){ 
  echo "<table border = '1'> 
"; 
  echo "<tr><td>Nombres</td>
"; 
  while ($row = mssql_fetch_array($result)) { 
    echo "<tr><td>".$row["nombres"].
      "</td><td>".$row["departamento"]."</td></tr> 
"; 
  }
  echo "</table>  "; 
  echo pagemaker($pag, $total, $tampag, "clientes.php?pag=");
}
else
  echo "¡ No se ha encontrado ningún registro !";

if (!isset($pag)) $pag = 1; // Por defecto, pagina 1
$result = mssql_query("SELECT COUNT(*) FROM empleado", $link); 
$total = mssql_fetch_row($result);
$tampag = 10;
$reg1 = ($pag-1) * $tampag;
$result = mssql_query("SELECT top 10 nombres, departamento FROM empleado
  order by nombres, $reg1, $tampag", $link);

?> 

</body> 
</html>



