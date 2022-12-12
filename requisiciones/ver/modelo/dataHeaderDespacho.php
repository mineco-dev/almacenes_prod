<?php
    session_start();
    require_once('../../comandos/funciones.php');
    require_once('../../comandos/sqlcommand.inc');
    conectardb($almacen);

    $idsolicitud=$_REQUEST["id"];

    $listheader = "";

    $SQL = 'SELECT 
                e.fecha_requisicion,
                e.solicitante,
                dep.nombre,
                e.observaciones,
                e.codigo_requisicion_enc
                FROM tb_requisicion_enc e
                
                        LEFT JOIN direccion dep ON 
                                        dep.iddireccion = e.codigo_dependencia
                        LEFT JOIN cat_estatus es ON
                                        e.codigo_estatus = es.codigo_estatus
                        WHERE 
                                        e.codigo_requisicion_enc = 571
    ';
    $requestDespacho = $query($SQL);
    while ($row = $fetch_array($requestDespacho)) {
        $input ='<a href=\"javascript:void(0)\" onClick=\"buscar=window.open(\"../../buscar_persona_req.php?tipo=nombre&posi=0\",\"Buscar\",\"width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\"); return false;\"><input  class=\"form-control\" name=\"nombre[0][0]\" type=\"text\" id=\"nombre[0][0]\" value=\"[CLIC AQUI PARA SELECCIONAR SOLICITANTE]\" size=\"55\" /></a><input  name=\"nombre[0][2]\" type=\"hidden\" id=\"nombre[0][2]\" size=\"55\"/><input type=\"hidden\" name=\"nombre[0][1]\" id=\"nombre[0][1]\"/>';
        $modal = '<input name=\"recibename\" id=\"recibename\" class=\"form-control recibe\" /><button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModal\">...</button>';
        $listheader .= '{

            "FECHA":"'. $row["fecha_requisicion"].'",
            "SOLICITANTE":"'.$row["solicitante"].'",
            "DEPARTAMENTO":"'.$row["nombre"].'",
            "OBSERVACIONES":"'.$row["observaciones"].'",
            "NUMERO":"'.$row['codigo_requisicion_enc'].'",
            "RECIBE":"'.$modal.'"
        },';
    }

    $listheader = substr($listheader, 0, strlen($listheader) - 1);

    echo '{"data":[' . utf8_encode($listheader) . ']}';
?>