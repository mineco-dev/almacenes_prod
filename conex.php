<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<!-- Manual de PHP de WebEstilo.com --> 
<html> 
<head> 
   <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title> 
</head> 
<body> 
<?php 
function Conectarse() 
{ 
   if (!($link=mysql_connect("192.168.2.244","diacoweb","seguridad"))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("informatica",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
} 

$link=Conectarse(); 
echo "<br>"; 

mysql_close($link); //cierra la conexion 
?> 
</body> 

</body>
</html>
