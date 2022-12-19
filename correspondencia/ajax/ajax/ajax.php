<?php
include ("include.php");
echo $_POST['campo1']."<-------1";
echo "<br>";
echo $_POST['campo2']."<-------2";
list($d1,$d2,$d3)=Sql_fetch_row(Sql_query("Select nombre_pe, apellido_pe, rut_pe from personas where rut_pe=".$_POST['campo1']));

echo "<form name='frmempleado' action=''>";
    echo "<table>";
        echo "<tr><td><input type='text' name='nombres' id='nombres' value='$d1'></td></tr>";
        echo "<tr><td><input type='text' name='departamento' id='departamento' value='$d2'></td></tr>";
        echo "<tr><td><input type='text' name='idempleado' id='idempleado' value='".$_POST['campo1']."'></td></tr>";
    echo "</table>";
    
    echo "<input type='button' name='forma' value='Actualizar' onclick='enviarDatosEmpleado(); return false'>";
    
    if($d1){
        echo "<input type='button' name='forma' value='Eliminar' onclick='eliminarDatosEmpleado(); return false'>";
    }
    
    //echo "<input type='submit' name='Submit' value='Nuevo'>";
    echo "<input type='button' name='forma' value='Nuevo' onclick='nuevoDatosEmpleado(); return false'>";
echo "</form>";
?>
