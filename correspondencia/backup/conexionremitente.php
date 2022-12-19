<?php

$conection = mssql_connect("SERVER_APPL","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);


$result=mssql_query("INSERT INTO REMITENTE ( NOMBRE_REMITENTE, APELLIDO_REMITENTE, DIRECCION_REMITENTE, TELEFONO)
       VALUES ('$NOMBRE_REMITENTE','$APELLIDO_REMITENTE','$DIRECCION_REMITENTE','$TELEFONO') ",$conection);


 $regreso = "1";
                header("Location: REMITENTE.PHP?regreso=1");
		



    echo" <html>
       <head></head>
       <body>
       <h3>Los datos han sido guardados</h3>
       </body>
       </html>";


?>