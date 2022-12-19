<?php
$conection = mssql_connect("SERVER_APPL","msjharry","lisa1607") or die("no se puede conectar a SQL Server");
mssql_select_db("MENSAJERIA",$conection);


$result=mssql_query("INSERT INTO DETALLE_INGRESO(CODIGO_INGRESO, CODIGO_EMPLEADO, STATUS, TIPO_DOCUMENTO, CODIGO_DESCRIPCION)
       VALUES ($CODIGO_INGRESO, $CODIGO_EMPLEADO, '$STATUS','$TIPO_DOCUMENTO', '$CODIGO_DESCRIPCION') ",$conection);



$regreso = "1";
                header("Location: ENTREGAPRUEBA.PHP?regreso=1");


?>


