<?php
// session_start();
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
require_once('../includes/conectarse.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
    <link href="../helpdesk.css" rel="stylesheet" type="text/css" />
</head>
<script>
    function Abrir_ventana(pagina)
        {
            var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=700, height=400, top=85, left=140";
            window.open(pagina,"",opciones);
        }
</script>
<body>
<?php

if(isset($_SESSION["ingreso"]))
{
    //variables globales recibidas desde el formulario
    conectardb($almacen);
    $solicitante=$_POST['solicitante']; 
    $proveedor=$_POST['idProveedor'];
    $nombre_usuario = $_SESSION["user_name"];
    $observaciones=utf8_decode($_POST['txt_observaciones']);


    $txt_no=$_POST['txt_no'];    
    $codigo_empresa=$_POST['cbo_empresa'];
    $codigo_bodega=$_POST['cbo_bodega'];
    $tipo_doc=$_POST['cbo_tipo_docto'];
    $cod_dependencia=$_POST['cbo_dependencia'];
    $cod_solicitante=$_POST['idSolicitante'];
    $programa=$_POST['cbo_programa'];
    $actividad=$_POST['cbo_actividad'];
    $serie_fact=$_POST['txt_no_serie'];
    $no_fact=$_POST['txt_no_ingreso'];
    $fecha_fact=$_POST['date1'];
    $fecha_ingreso_sis=$_POST['date2'];
    $cantidad_filas = $_POST['cantidad_filas'];
    $bien=$_POST['bien'];
    $cant_ingresada=$_POST['ingresado'];
    $costo_unitario=$_POST['costo_unitario'];
    $precio_total=$_POST['precio_total'];
    $precio_total1=$_POST['precio_total1'];
    $hoy=date("Y-m-d H:i:s");
    $activo=1;


    //////se devuelve el numero del ultimo ingreso mas uno///////////////////////
    $qry_ultimo_ingreso = "select max(codigo_ingreso_enc) as ultimo_ingreso from tb_ingreso_enc";
    $res_ultimo_ingreso = $query($qry_ultimo_ingreso);
    while ($row = $fetch_array($res_ultimo_ingreso)) {
        $no_ingreso = $row["ultimo_ingreso"]+1;
    }
    ///INSERTAMOS DATOS A LA TABLA TB_INGRESO_ENC////////
    $qry_ingreso = "INSERT INTO tb_ingreso_enc 
        (no_ingreso,
        codigo_tipo_documento, 
        fecha_documento, 
        numero_documento, 
        usuario_solicitante, 
        solicitante, 
        observaciones, 
        usuario_creo, 
        fecha_creado,
        activo, 
        codigo_proveedor, 
        fecha_recepcion, 
        codigo_actividad, 
        fecha_ingreso, 
        codigo_programa, 
        codigo_dependencia, 
        numero_serie, 
        codigo_empresa, 
        codigo_bodega, 
        codigo_estatus
        ) VALUES ($txt_no, 
        '$tipo_doc',
        '$fecha_fact', 
        '$no_fact',
        $cod_solicitante, 
        '$solicitante',
        '$observaciones',
        '$nombre_usuario',
        '$hoy',
        $activo,
        '$proveedor',
        '$hoy', 
        '$actividad',
        getdate(), 
        '$programa',
        $cod_dependencia,
        '$serie_fact',
        $codigo_empresa,
        $codigo_bodega,7)";    
        $query($qry_ingreso);
        /////seleccionar el ultimo codigo generado//////////////////////
        $qry_ultimo_ingreso = "SELECT MAX(codigo_ingreso_enc) AS ultimo_ingreso FROM tb_ingreso_enc";
        $res_ultimo_ingreso = $query($qry_ultimo_ingreso);
        while ($row = $fetch_array($res_ultimo_ingreso)) {
            $no_ingreso = $row["ultimo_ingreso"];
        }  
    /////////////////////////////////// inserta detalle del ingreso ////////////////////////////////////////// 
    $cnt = 1;
    while ($cnt <= count($bien)) {
        $renglon = $bien[$cnt][5];
        $codigoproducto = $bien[$cnt][1];
        $categoria = $bien[$cnt][2];
        $subcategoria = $bien[$cnt][3];
        if ($costo_unitario[$cnt] == "") $costo_unitario[$cnt] = 0;
        $qry_ingreso_det = "INSERT INTO tb_ingreso_det
           ( codigo_ingreso_enc, 
            codigo_categoria, 
            codigo_subcategoria, 
            codigo_producto, 
            cantidad_ingresada,              
            costo_unidad, 
            Precio_total,
            codigo_bodega,
            usuario_creo,
            fecha_creado,
            activo,
            codigo_renglon,             
            codigo_empresa           
            )
        VALUES (
            $no_ingreso,
            $categoria,
            $subcategoria, 
            $codigoproducto, 
            $cant_ingresada[$cnt],  
            $costo_unitario[$cnt], 
            $precio_total[$cnt], 
            $codigo_bodega, 
            '$nombre_usuario', 
            '$hoy',
            $activo,
            '$renglon',              
            $codigo_empresa                              
             )";   
        
        //print($qry_ingreso_det);     
        $query($qry_ingreso_det);
        $cnt++;
    }

      /////////////////////////////////// inserta detalle del ingreso en la tabla kardex//////////////////////////////////////////


    $cnt = 1;
    while ($cnt <= count($bien)) {
        $codigoproducto = $bien[$cnt][1];
        $categoria = $bien[$cnt][2];
        $subcategoria = $bien[$cnt][3];
  
        // Consultar si existe el producto en la tabla
        $qry_consulta = "SELECT * FROM tb_kardex WHERE 
        codigo_bodega=$codigo_bodega 
        AND codigo_empresa=$codigo_empresa 
        AND codigo_producto=$codigoproducto 
        AND codigo_categoria=$categoria 
        AND codigo_subcategoria=$subcategoria";
        //print($qry_consulta);
        $res_consulta = $query($qry_consulta);
        $existe = false;
        while ($row = $fetch_array($res_consulta)) {
            $existe = true;  
            $saldo = $row["saldo"] + $cant_ingresada[$cnt];              
            $costo_actual = $row["saldo"] * $row["costo_actual"];             
            $costo_totalant = $row["costo_total"];            
            $costo_nuevo = $cant_ingresada[$cnt] * $costo_unitario[$cnt];
            $suma_costo = $costo_actual + $costo_nuevo;  


            
            //print($costo_factura); 
            $costo_total = $precio_total[$cnt] + $costo_totalant;            
            $promedio = $costo_total / $saldo;
            $trues = number_format($promedio, 8, '.', '');  
            $costo_movimiento = $saldo * $trues;  
            //$costo_factura=$promedio*$cant_ingresada[$cnt]; 
            $costo_factura=$precio_total1[$cnt];
            $qry_ingreso_kardex = "INSERT INTO tb_kardex
            (codigo_bodega,
            codigo_categoria, 
            codigo_subcategoria, 
            codigo_producto, 
            codigo_tipo_movimiento, 
            fecha_creado,
            cantidad, 
            usuario_creo, 
            fecha,
            activo,
            codigo_empresa,
            no_ingreso, 
            costo_promedio, 
            costo_factura,        
            costo_movimiento,   
            id_dependencia,            
            entrada, 
            saldo,   
            costo_total,
            costo_actual)    
            VALUES (
            $codigo_bodega,
            $categoria,
            $subcategoria, 
            $codigoproducto,
            1,
            '$hoy',
            $cant_ingresada[$cnt], 
            '$nombre_usuario', 
            '$hoy',
            $activo,
            $codigo_empresa, 
            $txt_no,
            $promedio,
            $costo_factura,
            $costo_movimiento, 
            $cod_dependencia,
            $cant_ingresada[$cnt],
            $saldo,      
            $costo_total,
            $costo_unitario[$cnt])";
            //print($suma_costo);
        } 
         
        if (!$existe) {
            $existe = true;  
            $saldo = $row["saldo"] + $cant_ingresada[$cnt];              
            $costo_actual = $row["saldo"] * $row["costo_actual"];             
            $costo_totalant = $row["costo_total"];            
            $costo_nuevo = $cant_ingresada[$cnt] * $costo_unitario[$cnt];
            $suma_costo = $costo_actual + $costo_nuevo;  
            //print($costo_factura); 
            $costo_total = $precio_total[$cnt] + $costo_totalant;            
            $promedio = $costo_total / $saldo;
            $trues = number_format($promedio, 8, '.', '');  
            $costo_movimiento = $saldo * $trues;  
            //$costo_factura=$promedio*$cant_ingresada[$cnt]; 
            $costo_factura=$precio_total1[$cnt];
            $qry_ingreso_kardex = "INSERT INTO tb_kardex
            (codigo_bodega,
            codigo_categoria, 
            codigo_subcategoria, 
            codigo_producto, 
            codigo_tipo_movimiento, 
            fecha_creado,
            cantidad, 
            usuario_creo, 
            fecha,
            activo,
            codigo_empresa,
            no_ingreso, 
            costo_promedio, 
            costo_factura,        
            costo_movimiento,   
            id_dependencia,            
            entrada, 
            saldo,   
            costo_total,
            costo_actual)    
            VALUES (
            $codigo_bodega,
            $categoria,
            $subcategoria, 
            $codigoproducto,
            1,
            '$hoy',
            $cant_ingresada[$cnt], 
            '$nombre_usuario', 
            '$hoy',
            $activo,
            $codigo_empresa, 
            $txt_no,
            $promedio,
            $costo_factura,
            $costo_movimiento, 
            $cod_dependencia,
            $cant_ingresada[$cnt],
            $saldo,      
            $costo_total,
            $costo_unitario[$cnt])";
            //print($costo_factura); 
            //print($qry_ingreso_kardex);  
        }    
        if (!$existe) {
            $saldo = $row["saldo"] + $cant_ingresada[$cnt];
            $costo_actual = $row["saldo"] * $row["costo_actual"];
            $costo_totalant = $row["costo_total"];
            $costo_nuevo = $cant_ingresada[$cnt] * $costo_unitario[$cnt];
            $suma_costo = $costo_actual + $costo_nuevo;            
            $costo_total = $precio_total1[$cnt] + $costo_totalant;
            $promedio = $costo_total / $saldo;
            $trues = number_format($promedio, 8, '.', '');
            $costo_movimiento = $saldo * $trues;
            //$costo_factura=$promedio*$cant_ingresada[$cnt];
            $costo_factura=$precio_total1[$cnt];
            
            $qry_ingreso_kardex = "UPDATE tb_kardex SET 
            saldo=$saldo, 
            costo_actual=$costo_unitario[$cnt], 
            costo_promedio=$promedio, 
            costo_movimiento=$costo_movimiento, 
            costo_total=$costo_total 
            WHERE codigo_empresa=$codigo_empresa 
                AND codigo_bodega=$codigo_bodega 
                AND codigo_producto=$codigoproducto 
                AND codigo_categoria=$categoria 
                AND codigo_subcategoria=$subcategoria";
                //print($qry_ingreso_kardex);  
            
        }  
        //print($qry_ingreso_kardex);
        
        $query($qry_ingreso_kardex);
        $cnt++;
    }

       /////////////////////////////////// Actualiza tabla inventario /////////////////////////////
    $cnt = 1;
    while ($cnt <= count($bien)) {
        $codigoproducto = $bien[$cnt][1];
        $categoria = $bien[$cnt][2];
        $subcategoria = $bien[$cnt][3];
        //$codigo = $bien[$cnt][4];
        $renglon = $bien[$cnt][5];
        // Consultar si existe el producto en la tabla
        $qry_consulta = "SELECT * FROM tb_inventario
         WHERE codigo_bodega=$codigo_bodega 
         AND codigo_empresa=$codigo_empresa 
         AND codigo_producto=$codigoproducto 
         AND codigo_categoria=$categoria 
         AND codigo_subcategoria=$subcategoria";
        //print($qry_consulta);
        //echo "<h1>select inventario".$qry_consulta."</h1><hr/>";
        
        $res_consulta = $query($qry_consulta);
        $existe = false;
        while ($row = $fetch_array($res_consulta)) {
            $existe = true;
            $existencia_actual = $row["existencia"] + $cant_ingresada[$cnt];
            //print($existencia_actual);
            $qry_ingreso_inventario = "UPDATE tb_inventario 
            SET existencia=$existencia_actual, 
            ultimo_ingreso='$hoy', 
            usuario_ingreso='$nombre_usuario', 
            ultimo_costo=$costo_unitario[$cnt] 
            WHERE codigo_empresa=$codigo_empresa 
            AND codigo_bodega=$codigo_bodega 
            AND codigo_producto=$codigoproducto 
            AND codigo_categoria=$categoria 
            AND codigo_subcategoria=$subcategoria";
        }
        
        if (!$existe) {

            $existencia_actual = $row["existencia"] + $cant_ingresada[$cnt];
            //echo "<h1>exist".$row["existencia"]."</h1><hr/>";
            //echo "<h1>ingre".$cant_ingresada[$cnt]."</h1><hr/>";
            //echo "<h1>tot".$existencia_actual."</h1><hr/>";
            $qry_ingreso_inventario = "INSERT INTO tb_inventario 
                (                
                codigo_bodega, 
                codigo_categoria,
                codigo_subcategoria, 
                codigo_producto, 
                existencia, 
                ultimo_ingreso,
                ultimo_egreso,
                usuario_ingreso,
                cantidad_comprometida,
                costo_inicial, 
                ultimo_costo,      
                codigo_empresa                              
                )
            values 
                (
                $codigo_bodega,
                $categoria,
                $subcategoria,   
                $codigoproducto,
                $cant_ingresada[$cnt],
                '$hoy',     
                '$hoy',
                '$nombre_usuario',
                0,
                $costo_unitario[$cnt], 
                $costo_unitario[$cnt],
                $codigo_empresa                             
                )";
        }
        //print($qry_ingreso_inventario);
        //echo "primero: ".$qry_ingreso_inventario;
        echo 
        $query($qry_ingreso_inventario);
        $cnt++;
    }

    /////////////////////////////////// Actualiza tabla inventario_det /////////////////////////////
  
    $cnt=1;
    while($cnt<=count($bien))
    {
        $codigo = $bien[$cnt][4];
        $codigoproducto = $bien[$cnt][1];
        $categoria = $bien[$cnt][2];
        $subcategoria = $bien[$cnt][3];
        $renglon = $bien[$cnt][5];
        // Consultar si existe el producto en la tabla
        $qry_consulta="SELECT * FROM tb_inventario_det 
        WHERE codigo_empresa=$codigo_empresa 
        AND codigo_bodega=$codigo_bodega 
        AND codigo_producto=$codigoproducto 
        AND codigo_categoria=$categoria 
        AND codigo_subcategoria=$subcategoria";
        //print($qry_consulta);
        $res_consulta=$query($qry_consulta);
        $existe=false;
        while($row=$fetch_array($res_consulta))
        {
            $existe=true;
            $existencia_actual=$row["existencia"]+$cant_ingresada[$cnt];
            $qry_ingreso_inventario ="UPDATE tb_inventario_det 
            SET existencia=$existencia_actual, 
            activo=1 
            WHERE codigo_empresa=$codigo_empresa 
            AND codigo_bodega=$codigo_bodega 
            AND codigo_producto=$codigoproducto 
            AND codigo_categoria=$categoria 
            AND codigo_subcategoria=$subcategoria";
        }
        if(!$existe)
        {
            $existencia_actual=$row["existencia"]+$cant_ingresada[$cnt];
            //echo "<h1>exist".$row["existencia"]."</h1><hr/>";
            //echo "<h1>ingre".$cant_ingresada[$cnt]."</h1><hr/>";
            //echo "<h1>tot".$existencia_actual."</h1><hr/>";
            $qry_ingreso_inventario ="INSERT INTO tb_inventario_det 
                (existencia, 
                codigo_empresa, 
                codigo_bodega, 
                codigo_producto, 
                codigo_categoria, 
                codigo_subcategoria, 
                activo)
            VALUES (
                $cant_ingresada[$cnt],
                $codigo_empresa, 
                $codigo_bodega, 
                $codigoproducto, 
                $categoria,
                $subcategoria, 
                1)";
        }
        //echo "ultimo: ".$qry_ingreso_inventario;
        //print($qry_ingreso_inventario);
        $query($qry_ingreso_inventario);
        
        $cnt++;
    
    }
    echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';
    echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Hoja de ingreso guardada correctamente!</span></center></TD></TR>';
}
else
{
    echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';                            
    echo '<TR><TD COLSPAN="5"><span class="error"><center>Puede ingresar nuevos productos utilizando la opcion Entradas, del menú izquierdo</span></center></TD></TR>';    
}
?>

    
</body>
</html>