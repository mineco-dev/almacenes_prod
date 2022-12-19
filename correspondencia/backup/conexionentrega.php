<?php
$conection = mssql_connect("SERVER_APPL","msjharry","lisa1607") or die("no se puede conectar a SQL Server");
mssql_select_db("MENSAJERIA",$conection);


$result=mssql_query("INSERT INTO INGRESO_MENSAJERIA(RECIBIO, NOMBRE_MENSAJERO, CODIGO_REMITENTE, FECHA, HORA)
       VALUES ('$RECIBIO','$NOMBRE_MENSAJERO',$CODIGO_REMITENTE,'$FECHA','$HORA') ",$conection);


$regreso = "1";
                header("Location: ENTREGAPRUEBA.PHP?regreso=1");

echo" <html>
       <head></head>
       <body>
       <h3>Ingreso Correctamente la Correspondencia</h3>
       </body>
       </html>";

?>



