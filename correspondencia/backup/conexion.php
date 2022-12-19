<?php

$conection = mssql_connect("SERVER_APPL","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);

 $result=mssql_query("INSERT INTO empleado ( NOMBRE_EMPLEADO, APELLIDO_EMPLEADO, CARGO, EMAIL, EXTENSION, CODIGO_DEPARTAMENTO, DE_BAJA, NIVEL)
       VALUES ('$NOMBRE_EMPLEADO','$APELLIDO_EMPLEADO','$CARGO','$EMAIL','$EXTENSION', $CODIGO_DEPARTAMENTO,'$DE_BAJA', '$NIVEL') ",$conection);


$regreso = "1";
                header("Location: EMPLEADOS.PHP?regreso=1");



    echo" <html>
       <head></head>
       <body>
       <h3>Los datos han sido guardados</h3>
       </body>
       </html>";


?>