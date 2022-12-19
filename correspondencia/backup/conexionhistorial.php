<?php

$conection = mssql_connect("ECORTES","","") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);


$result=mssql_query("INSERT INTO HISTORIAL (RECIBIO_HISTORIAL, FECHA_HISTORIAL, HORA_HISTORIAL)
       VALUES ('$RECIBIO_HISTORIAL','$FECHA_HISTORIAL','$HORA_HISTORIAL') ",$conection);




$regreso = "1";
                header("Location: RECEPCIONCONSULTA.PHP?regreso=1");


    echo" <html>
       <head></head>
       <body>
       <h3>Los datos han sido guardados</h3>
       </body>
       </html>";


?>