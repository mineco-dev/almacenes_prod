<?php

$conection = mssql_connect("SERVER_APPL","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);

$result=mssql_query("INSERT INTO DEPARTAMENTO ( NOMBRE)
       VALUES ('$NOMBRE') ",$conection);
  

$regreso = "1";
                header("Location: DEPARTAMENTO.PHP?regreso=1");


    echo" <html>
       <head></head>
       <body>
       <h3>Los datos han sido guardados</h3>
       </body>
       </html>";


?>


<form action="DEPARTAMENTO.php" method="get">
  <div align="center">
    <input type="submit" name="Submit" value="INGRESE OTRO DATO">
  </div>
</form>