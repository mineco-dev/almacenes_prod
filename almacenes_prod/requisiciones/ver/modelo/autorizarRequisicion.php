<?php
// llamada a conexion

    require_once('../../comandos/funciones.php');
    require_once('../../comandos/sqlcommand.inc');
    conectardb($almacen); 

    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

$TipoSolicitud = $_POST['optradio'];
$nombre_usuario = $_SESSION["user_name"];
$producto = $_POST['producto'];
$codigoP = $_POST['codigoP'];
$Solicitado = $_POST['Solicitado'];
$nRequi = $_POST['nRequi'];



$lista = "";
if ($TipoSolicitud == "1") {
    $fila = 0;
    $a=0;
    $rowUpdate = 0;
    $rowSaldo = 0;
    while ($fila < count($producto)) 
    {
        
        $SQL = 'SELECT 
                    inventario.rowid as fila,
                    inventario.existencia,
                    (pro.producto +\' \' + pro.marca) as Producto,
                    inventario.cantidad_comprometida ,
                    requi.cantidad_autorizada
                FROM tb_inventario inventario
                INNER JOIN tb_requisicion_det requi 
                    ON requi.codigo_bodega = inventario.codigo_bodega 
                    AND requi.codigo_producto = inventario.codigo_producto
                    AND requi.codigo_categoria = inventario.codigo_categoria
                    AND requi.codigo_subcategoria = inventario.codigo_subcategoria
                    AND requi.codigo_empresa = inventario.codigo_empresa
                INNER JOIN cat_producto pro
                    ON pro.codigo_categoria = inventario.codigo_categoria
                    AND pro.codigo_subcategoria = inventario.codigo_subcategoria
                    AND pro.codigo_producto = inventario.codigo_producto
                WHERE requi.rowid ='. $codigoP[$fila] .'
        ';
        //echo $SQL;
        
        $responseProducto = $query($SQL);

        while ($row  = $fetch_array($responseProducto)) {
            if ($row['cantidad_comprometida'] === 0) {
                $Saldo[] = 0;
            }else{
                $Saldo[] = $row['cantidad_comprometida'] - $Solicitado[$rowUpdate];
                
            }
            $fil[] = $row['fila'];

            $existencia[] = $row['existencia'];
            $arrayProducto[] = $row['Producto'];
            $arraycomprometida[] = $row['cantidad_autorizada'];
            $rowUpdate++;
        }
        
        $SQLUpdate = 'UPDATE
                            tb_inventario SET
                            cantidad_comprometida = cantidad_comprometida + ' . $producto[$rowSaldo] . '
                            WHERE rowid = '.$fil[$rowSaldo].'';
                            //echo "<hr>";
                           // echo $SQLUpdate;
                            //echo "<hr>";
        $responseUpdate = $query($SQLUpdate);

        $SQLUpdateRequiDet = 'UPDATE 
                            tb_requisicion_det SET
                                cantidad_autorizada = '. $producto[$rowSaldo].'
                                WHERE rowid = '.$codigoP[$rowSaldo].'';

        $responseRequiDet = $query($SQLUpdateRequiDet);

        $SQLUpdateRequiEnc = "UPDATE tb_requisicion_enc SET
                                codigo_estatus = 5,
                                usuario_autorizo ='". $nombre_usuario . "',
                                fecha_autorizado ='". date("Y-m-d H:i:s") ."' 
                                WHERE codigo_requisicion_enc = ".$nRequi."";

        $responseRequiEnc = $query($SQLUpdateRequiEnc);
        
        $fila++;
        $rowSaldo++;
    }
        echo 1;
}else{
        $SQLUpdateRequi = 'UPDATE 
                            tb_requisicion_enc SET
                                codigo_estatus = 0,
                                usuario_rechazo ="'. $nombre_usuario . '",
                                fecha_rechazo = "'.date("Y-m-d H:i:s").'"
                                WHERE codigo_requisicion_enc = '.$nRequi.'';

        //$responseRequi = $query($SQLUpdateRequi);

        echo 0;
}

?>