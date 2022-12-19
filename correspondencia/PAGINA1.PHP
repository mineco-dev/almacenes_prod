<html> 

<head> 
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title> 
</head> 

<body> 
<form method="post" action="PAGINA2.PHP"> 

    <table width="70%" border="0" align="center"> 
    <?php 
// Me conecto a la base de datos 
mssql_connect("ECORTES","",""); 
mssql_select_db("RRHH"); 

// Declaro la variable $paisant que es la que me va a indicar si hay que volver a cargar los datos de las provincias 
$paisant=$pais; 

print (" 
    <tr> 
       <td><div align=\"right\"><strong>nombre:</strong></div></td> 
       <td> <input type=\"text\" name=\"nombre\" value=\"$nombre\"></td> 
    </tr> 

    <input type=\"hidden\" name=\"paisant\" value=\"$paisant\"> 

    <tr> 
       <td><div align=\"right\"><strong>departamento:</strong></div></td> 
       <td><select name=\"nombre_departamento\" onchange=\"submit();\"> 
       "); 
//Muestra el combobox de las provincias una vez que se haya elegido el pa�s, no antes 
if (!isset($pais)){ 
    print ("<option selected>Seleccione el pais</option>"); 
    $pais="0"; 
} 

$sql="select * from asesor_departamento order by 2"; 
$res=mssql_query($sql); 

while($fila=mssql_fetch_array($res)){ 
print("<option value=\"$fila[iddepartamento]\""); 
if ($fila[iddepartamento] == $pais) {
print ("selected"); 
} 
print(">$fila[nombre_departamento]</option>\n"); 
} 
print("</select></td></tr>"); 

if ($pais!="0"){ 
print(" 
<tr> 
    <td><div align=\"right\"><strong>municipio:</strong></div></td> 
<td><select name=\"nombre_municipio\"> 
"); 

$sqlprov="select * from asesor_municipio where iddepartamento='$pais' order by 2"; 
$resprov=mssql_query($sqlprov); 

while($filaprov=mssql_fetch_array($resprov)){ 
print("<option value=\"$filaprov[idmunicipio]\">$filaprov[nombre_municipio]</option>"); 
} 
print(" 
    </select> 
    </td> 
       </tr> 
"); 
} 
       ?> 
<tr> 
       <td><div align="right"><input name="button" type="submit" value="Enviar"></div></td> 
       <td><input name="reset" type="reset" value="Borrar"></td> 
    </tr> 
    </table> 

</form> 

</body> 
</html> 
