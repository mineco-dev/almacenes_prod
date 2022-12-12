<?php
require "../../../includes/funciones.php";
require "../../../includes/sqlcommand.inc";
//if (isset($_REQUEST["txt_id"]))
//{

if (isset($_REQUEST["otros"]))

/////////////////////////////////// Actualiza tabla de inventario si aprueba el producto /////////////////////////////
{
    $otro_reporte = $_REQUEST["otros"];
}

if ($otro_reporte == 'AP') {

    /////////////////////////////////// consulta existencias //////////////////////////////////////////
    $cnt = 1;
    $saldo = true;
    $bien = $_POST['bien'];
    $txt_codigo = $_POST['txt_codigo'];
    $txt_autorizado = $_POST['txt_autorizado'];
    $txt_rowid = $_POST['txt_rowid'];
    $txt_producto = $_POST['txt_producto'];
    $txt_categoria = $_POST['txt_categoria'];
    $txt_subcategoria = $_POST['txt_subcategoria'];
    $txt_bodega = $_POST['txt_bodega'];
    $txt_empresa = $_POST['txt_empresa'];
    while ($cnt <= count($bien)) {

        $codigo = $bien[$cnt][8]; //
        //$solicitado = $entregado[$cnt];
        $codigo = $txt_codigo[$cnt][25];
        $autorizado = $txt_autorizado[$cnt][11];
        //print($autorizado);
        $numero = $txt_rowid[$cnt][12];
        // $codigo = $txt_codigo[$cnt][11];
        $producto = $txt_producto[$cnt][3];
        $categoria = $txt_categoria[$cnt][4];
        $subcategoria = $txt_subcategoria[$cnt][5];
        $bodega = $txt_bodega[$cnt][6];
        $empresa = $txt_empresa[$cnt][7];
        //$renglon = $txt_renglon[$cnt][9];
        ////session_register("hoja_despacho");
        //$_SESSION["hoja_despacho"]=$codigo;
        ////// consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae
        conectardb($almacen);
        $qry_x_rowid_producto = "select * from tb_inventario where codigo_producto = '$producto' and codigo_categoria = '$categoria' and codigo_subcategoria = '$subcategoria' and codigo_bodega = '$bodega' and codigo_empresa = '$empresa'";
        //print($qry_x_rowid_producto);
        //$qry_x_rowid_producto="select * from tb_inventario where rowid='$codigo'";
        $res_rowid_producto = $query($qry_x_rowid_producto);
        while ($rowid = $fetch_array($res_rowid_producto)) {
            $cproducto[$cnt] = $rowid["codigo_producto"];
            $ccategoria[$cnt] = $rowid["codigo_categoria"];
            $csubcategoria[$cnt] = $rowid["codigo_subcategoria"];
            $cbodega[$cnt] = $rowid["codigo_bodega"];
            $cempresa[$cnt] = $rowid["codigo_empresa"];
            $comprometido = $rowid["cantidad_comprometida"];
            $existencia = $rowid["existencia"];
            // print($comprometido);
            $diferencia = $existencia;
            // print($diferencia);
        }
        /////// fin de consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae

        $qry_consulta_exist = "select i.existencia, (p.producto +' '+ p.marca) as producto, i.codigo_producto, i.codigo_categoria, i.codigo_subcategoria, i.codigo_bodega, i.codigo_empresa from tb_inventario i
								 inner join cat_producto p on i.codigo_producto=p.codigo_producto and i.codigo_categoria=p.codigo_categoria and i.codigo_subcategoria=p.codigo_subcategoria
								 where (i.codigo_empresa='$cempresa[$cnt]' and i.codigo_bodega='$cbodega[$cnt]' and i.codigo_producto='$cproducto[$cnt]' and i.codigo_categoria='$ccategoria[$cnt]' and i.codigo_subcategoria='$csubcategoria[$cnt]' and $autorizado > $diferencia)";
        //print($qry_consulta_exist);
        $res_consulta_exist = $query($qry_consulta_exist);

        while ($row = $fetch_array($res_consulta_exist)) {
            $saldo = false;
            $existencia = $row["existencia"];
            $producto = $row["producto"];
            echo '<TR><TD COLSPAN="5"><span class="error"><center>Ya hay comprometido ' . $comprometido . '  de ' . $producto . ' unicamente puede autorizar ' . $diferencia . ' </span></center></TD></TR>';
            $tipo_reporte = "";
        }
        $cnt++;
        echo '<br>';
    } //fin del while

    if ($saldo) {

        /////////////////////////////////// Actualiza tabla inventario /////////////////////////////

        $cnt = 1;
        while ($cnt <= count($bien)) {
            $codigo = $bien[$cnt][8];

            $autorizado = $txt_autorizado[$cnt][11];
            $solicitado = $txt_solicitada[$cnt][15];
            $cod = $bien[$cnt][8];
            $producto = $txt_producto[$cnt][3];
            $nombre_usuario = $_SESSION["user_name"];
            $categoria = $txt_categoria[$cnt][4];
            $subcategoria = $txt_subcategoria[$cnt][5];
            $bodega = $txt_bodega[$cnt][6];
            $empresa = $txt_empresa[$cnt][7];

            //$autorizado = $txt_autorizado[$cnt][0];

            //busca el producto en la tabla
            conectardb($almacen);
            $qry_consulta = "select * from tb_inventario where codigo_bodega='$bodega' and codigo_empresa='$empresa' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
            $res_consulta = $query($qry_consulta);
            $existe = false;
            while ($row = $fetch_array($res_consulta)) {
                $existe = true;

                // $comprometido=$row["cantidad_comprometida"]-$autorizado;
                $comprometido = $row["cantidad_comprometida"] - $solicitado;

                //$existencia_actual=$row["existencia"]-$solicitado;
                $qry_ingreso_inventario = "update tb_inventario set cantidad_comprometida='$comprometido' where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
                //$qry_ingreso_inventario ="update tb_inventario";
                //$qry_ingreso_inventario.="set existencia='$existencia_actual', ultimo_egreso=getdate(), usuario_egreso='$nombre_usuario' where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
            }
            //    print($qry_ingreso_inventario);
            $query($qry_ingreso_inventario);
            $cnt++;
        } // fin actualiza inventario

        $cnt = 1;
        while ($cnt <= count($txt_autorizado)) {

            $autorizado = $txt_autorizado[$cnt][11];
            $numero = $txt_rowid[$cnt][12];
            $qry_actualiza = "UPDATE tb_requisicion_det SET cantidad_autorizada='$autorizado' WHERE rowid='$numero'";
            //print($qry_actualiza);
            $query($qry_actualiza);
            $cnt++;
        }

        conectardb($almacen);
        $codigo = $_REQUEST["txt_id"];
        //$rowid=$_REQUEST["txt_rowid"];
        $nombre_usuario = $_SESSION["user_name"];
        $qry_actualiza = "UPDATE tb_requisicion_enc SET codigo_estatus=5, usuario_autorizo='$nombre_usuario',
						  fecha_autorizado=getdate() WHERE codigo_requisicion_enc='$codigo'";
        //print($qry_actualiza);
        $query($qry_actualiza);
        echo "REQUISICION AUTORIZADA EXITOSAMENTE";
        echo '<a href="almacen/select_empresa-php"> <<--regresar </a>';

    } // cierre del saldo

} //fin del ap

else

if ($otro_reporte == 'RE') {
    /////////////////////////////////// Actualiza tabla de nuevo si se rechaza la autorizacion inventario /////////////////////////////

    /*
    $cnt=1;
    while($cnt<=count($bien))
    {

    conectardb($almacen);
    $cod = $bien[$cnt][8];
    $producto = $txt_producto[$cnt][3];
    $nombre_usuario=$_SESSION["user_name"];
    $categoria = $txt_categoria[$cnt][4];
    $subcategoria = $txt_subcategoria[$cnt][5];
    $bodega = $txt_bodega[$cnt][6];
    $empresa = $txt_empresa[$cnt][7];
    $solicitado = $txt_solicitada[$cnt][15];
    //$codigo = $bien[$cnt][4];
    // $renglon = $bien[$cnt][5];
    // Consultar si existe el producto en la tabla
    $qry_consulta="select * from tb_inventario where codigo_bodega='$bodega' and codigo_empresa='$empresa' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
    print($qry_consulta);
    $res_consulta=$query($qry_consulta);
    $existe=false;
    while($row=$fetch_array($res_consulta))
    {
    $existe=true;
    $existencia_actual=$row["existencia"]+$solicitado;

    $qry_ingreso_inventario ="update tb_inventario set existencia='$existencia_actual', fecha_reingreso=getdate(), usuario_rechazo='$nombre_usuario' where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
    }

    print($qry_ingreso_inventario);
    $query($qry_ingreso_inventario);
    $cnt++;
    }
     */
    /*

    /////////////////////////////////// Actualiza tabla inventario /////////////////////////////

    $cnt=1;
    while($cnt<=count($bien))
    {
    $codigo = $bien[$cnt][8];

    $autorizado = $txt_autorizado[$cnt][11];
    $solicitado = $txt_solicitada[$cnt][15];
    $cod = $bien[$cnt][8];
    $producto = $txt_producto[$cnt][3];
    $nombre_usuario=$_SESSION["user_name"];
    $categoria = $txt_categoria[$cnt][4];
    $subcategoria = $txt_subcategoria[$cnt][5];
    $bodega = $txt_bodega[$cnt][6];
    $empresa = $txt_empresa[$cnt][7];

    //$autorizado = $txt_autorizado[$cnt][0];

    //busca el producto en la tabla
    conectardb($almacen);
    $qry_consulta="select * from tb_inventario where codigo_bodega='$bodega' and codigo_empresa='$empresa' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
    $res_consulta=$query($qry_consulta);
    $existe=false;
    while($row=$fetch_array($res_consulta))
    {
    $existe=true;

    //$diferencia=$autorizado-$solicitado;
    $comprometido=$row["cantidad_comprometida"]-$solicitado;

    //$existencia_actual=$row["existencia"]-$solicitado;
    $qry_ingreso_inventario ="update tb_inventario set cantidad_comprometida='$comprometido' where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
    //$qry_ingreso_inventario ="update tb_inventario";
    //$qry_ingreso_inventario.="set existencia='$existencia_actual', ultimo_egreso=getdate(), usuario_egreso='$nombre_usuario' where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
    }
    //    print($qry_ingreso_inventario);
    $query($qry_ingreso_inventario);
    $cnt++;
    }    // fin actualiza inventario

     */

    conectardb($almacen);
    $codigo = $_REQUEST["txt_id"];

    $qry_actualiza = "UPDATE tb_requisicion_enc SET codigo_estatus=0, usuario_rechazo='$nombre_usuario',
						  fecha_rechazo=getdate() WHERE codigo_requisicion_enc='$codigo'";
    //print($qry_actualiza);
    $query($qry_actualiza);
    echo "LA REQUISICION HA SIDO RECHAZADA...";
    echo '<a href="almacen/requisiciones/versolicitud.php?ver=2"> <<--regresar </a>';

}

//header("Location: ../versolicitud.php?ver=2");
