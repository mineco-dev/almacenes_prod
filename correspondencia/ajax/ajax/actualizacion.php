<?php

include ("include.php");

//Desarrollado por Jesus Liñán
//webmaster@ribosomatic.com
//ribosomatic.com
//Puedes hacer lo que quieras con el código
//pero visita la web cuando te acuerdes

//Configuracion de la conexion a base de datos
    /*
        $bd_host = "localhost";
        $bd_usuario = "root";
        $bd_password = "";
        $bd_base = "ribosomatic";
        $con = mysql_connect($bd_host, $bd_usuario, $bd_password);
        mysql_select_db($bd_base, $con);
    */
//variables POST
    /*
        $idemp=$_POST['idempleado'];
        $nom=$_POST['nombres'];
        $dep=$_POST['departamento'];
        $suel=$_POST['sueldo'];
    */
        $idemp=$_POST['idempleado'];
        $nom=$_POST['nombres'];
//actualiza los datos del empleados
    Sql_query("Update personas set nombre_pe='$nom' Where rut_pe='$idemp';");
    /*
        $sql="UPDATE empleados SET nombres='$nom', departamento='$dep', sueldo='$suel' WHERE idempleado=$idemp";

        mysql_query($sql,$con);
        http://www.ribosomatic.com/articulos/87/ajax-php-mysql-actualizacion-de-registros/
    */
//include("consulta.php");
?>
