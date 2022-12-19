<?php
 require('conexion.php');
 
//Configuracion de la conexion a base de datos


 
 $RegistrosAMostrar=4;

 //estos valores los recibo por GET
 if(isset($_GET['pag'])){
  $RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
  $PagAct=$_GET['pag'];
  //caso contrario los iniciamos
 }else{
  $RegistrosAEmpezar=1;
  $PagAct=1;
 }

$Resultado=mssql_query("SELECT TOP 4 nombres, departamento, sueldo FROM empleado 
ORDER BY nombres asc, $RegistrosAEmpezar, $RegistrosAMostrar",$con); //$RegistrosAEmpezar, $RegistrosAMostrar", $con

/*$Resultado=mssql_query("SELECT TOP 4 nombres, departamento, sueldo FROM (SELECT TOP 20 nombres, departamento, sueldo
  FROM empleado ORDER BY nombres) nombres ORDER BY nombres asc",$con);*/

//$Resultado=mssql_query("SELECT TOP 20 nombres, departamento, sueldo FROM empleado",$con);



 echo "<table border='1px'>";
 while($MostrarFila=mssql_fetch_array($Resultado)){
  echo "<tr>";
  echo "<td>".$MostrarFila['nombres']."</td>";
  echo "<td>".$MostrarFila['departamento']."</td>";
  echo "<td>".$MostrarFila['sueldo']."</td>";
  echo "</tr>";
 }
 echo "</table>";

 //******--------determinar las páginas---------******//
 $NroRegistros=mssql_num_rows(mssql_query("SELECT nombres, departamento, sueldo FROM empleado",$con));
 $PagAnt=$PagAct-1;
 $PagSig=$PagAct+1;
 $PagUlt=$NroRegistros/$RegistrosAMostrar;

 //verificamos residuo para ver si llevará decimales
 $Res=$NroRegistros%$RegistrosAMostrar;
 // si hay residuo usamos funcion floor para que me
 // devuelva la parte entera, SIN REDONDEAR, y le sumamos
 // una unidad para obtener la ultima pagina
 if($Res>0) $PagUlt=floor($PagUlt)+1;
 
 //desplazamiento
 echo "<a onclick=\"Pagina('1')\">Primero</a> ";
 if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\">Anterior</a> ";
 echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
 if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig')\">Siguiente</a> ";
 echo "<a onclick=\"Pagina('$PagUlt')\">Ultimo</a>";
 ?>