
<?PHP
    //session_start();
    require("../includes/funciones.php");
    require("../includes/sqlcommand.inc");
    require_once('../includes/conectarse.php');
    //$tipo_reporte="rpt_ingreso_det.php";
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../helpdesk.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
function Abrir_ventana(pagina)
    {
        var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=700, height=400, top=85, left=140";
        window.open(pagina,"",opciones);
    }
</script>
<body>
<?PHP
if (isset($_SESSION["ingreso"]))
{
    conectardb($almacen);
    $solicitante=$nombre[0][2];
    $proveedor=$proveedor[0][1];
    $nombre_usuario=$_SESSION["user_name"];
    $txt_observaciones=strtoupper($_REQUEST["txt_observaciones"]);

    /////////////////////////////////// inserta datos generales del ingreso /////////////////////////////////////////
    //session_register("hoja_ingreso");
    //$_SESSION["hoja_ingreso"]=$txt_no_ingreso;
   
//tomo el valor de un elemento de tipo texto del formulario

//datos del arhivo
/*$nombre_archivo = $HTTP_POST_FILES['userfile']['name'];
$tipo_archivo = $HTTP_POST_FILES['userfile']['type'];
$extension = split('[.]',$nombre_archivo);
$extension = $extension[sizeof($extension)-1];  
$tamano_archivo = $HTTP_POST_FILES['userfile']['size'];*/
//compruebo si las características del archivo son las que deseo
/*if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "zip")) && ($tamano_archivo < 10000))) {
    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
}else{ */
 
 $qry_ultimo_ingreso="select max(codigo_ingreso_enc) as ultimo_ingreso from tb_ingreso_enc";
    $res_ultimo_ingreso=$query($qry_ultimo_ingreso);
    while($row=$fetch_array($res_ultimo_ingreso))
    {
        $codigo_archivo = $row["ultimo_ingreso"]+1;    
    }
 
   //$nombre_archivo_def=$codigo_archivo.".".$extension;  
 
  /* if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "documentos/".$nombre_archivo_def))
   {
     echo "El archivo ha sido cargado correctamente.";
    }else{
       echo "No se adjunto ninguna Imagen.";
    }*/

    $qry_ingreso ="insert into tb_ingreso_enc
    (no_ingreso, codigo_tipo_documento, fecha_ingreso, fecha_documento, fecha_recepcion, numero_serie, numero_documento, solicitante, usuario_solicitante, codigo_programa, codigo_actividad, codigo_dependencia, observaciones, codigo_proveedor, activo, usuario_creo, fecha_creado, userfile, codigo_empresa, codigo_bodega, codigo_estatus)
    values ('$txt_no', '$cbo_tipo_docto', getdate(), '$date1', '$date2', '$txt_no_serie', '$txt_no_ingreso', '$solicitante', '".$nombre[0][1]."', '$cbo_programa', '$cbo_actividad', '$cbo_dependencia', '$txt_observaciones', '$proveedor', 1, '$nombre_usuario', getdate(), '$nombre_archivo_def', $cbo_empresa, $cbo_bodega, 7)";
    //print($qry_ingreso);
    $query($qry_ingreso);
    /////////////////////////////////// selecciona el ultimo ingreso guardado   /////////////////////////////////////////
    $qry_ultimo_ingreso="select max(codigo_ingreso_enc) as ultimo_ingreso from tb_ingreso_enc";
    $res_ultimo_ingreso=$query($qry_ultimo_ingreso);
    while($row=$fetch_array($res_ultimo_ingreso))
    {
        $no_ingreso = $row["ultimo_ingreso"];      
    }
   
   
    /////////////////////////////////// inserta detalle del ingreso //////////////////////////////////////////
    $cnt=1;        
    while($cnt<=count($bien))
    {              
        $renglon = $bien[$cnt][5];
        //$codigo = $bien[$cnt][4];
        $codigoproducto = $bien[$cnt][1];      
        $categoria = $bien[$cnt][2];
        $subcategoria = $bien[$cnt][3]; 
        if ($costo_unitario[$cnt]=="") $costo_unitario[$cnt]=0;    
        $qry_ingreso_det ="insert into tb_ingreso_det";
        $qry_ingreso_det.="(codigo_ingreso_enc, codigo_producto, codigo_categoria, codigo_subcategoria, codigo_renglon, cantidad_ingresada, costo_unidad, precio_total, codigo_empresa, codigo_bodega, usuario_creo, fecha_creado, activo) ";
        $qry_ingreso_det.="values ('$no_ingreso', '$codigoproducto', '$categoria', '$subcategoria', '$renglon', '$ingresado[$cnt]', '$costo_unitario[$cnt]', '$precio_total1[$cnt]', $cbo_empresa, $cbo_bodega, '$nombre_usuario', getdate(), 1)";
        //print $qry_ingreso_det;
                   
        $query($qry_ingreso_det);      
        $cnt++;    
    }      
   
   
    /////////////////////////////////// inserta detalle del ingreso en la tabla kardex//////////////////////////////////////////
   
   
    $cnt=1;        
    while($cnt<=count($bien))
    {                      
        $codigoproducto = $bien[$cnt][1];      
        $categoria = $bien[$cnt][2];
        $subcategoria = $bien[$cnt][3];
        //$renglon = $bien[$cnt][5];
        // Consultar si existe el producto en la tabla
        $qry_consulta="select * from tb_kardex where codigo_bodega='$cbo_bodega' and codigo_empresa='$cbo_empresa' and codigo_producto='$codigoproducto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
        //print($qry_consulta);
        $res_consulta=$query($qry_consulta);
        $existe=false;
        while($row=$fetch_array($res_consulta))
        {
            $existe=true;
            $saldo=$row["saldo"]+$ingresado[$cnt];  
            $costo_actual=$row["saldo"]*$row["costo_actual"];  
            $costo_totalant=$row["costo_total"];
            $costo_nuevo=$ingresado[$cnt]*$costo_unitario[$cnt];
            $suma_costo=$costo_actual+$costo_nuevo;                   
            //$costo_factura=$promedio*$ingresado[$cnt];     
            $costo_total=$precio_total1[$cnt]+$costo_totalant;
            $promedio= $costo_total/$saldo;
            $trues = number_format($promedio, 2, '.', '2');
         
         
            $costo_movimiento= $saldo * $trues;
       
        $qry_ingreso_kardex ="insert into tb_kardex";  
        $qry_ingreso_kardex.="(no_ingreso, codigo_empresa, codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, codigo_tipo_movimiento, fecha, entrada, usuario_creo, fecha_creado, saldo, activo, costo_promedio, id_dependencia, costo_actual, costo_factura, costo_movimiento, costo_total)";
        $qry_ingreso_kardex.="values ('$txt_no', $cbo_empresa, $cbo_bodega, '$codigoproducto', '$categoria', '$subcategoria', 1, getdate(), '$ingresado[$cnt]', '$nombre_usuario', getdate(), '$saldo', 1, '$promedio', '$cbo_dependencia', '$costo_unitario[$cnt]', '$precio_total1[$cnt]', '$costo_movimiento', '$costo_total')";
        //print($qry_ingreso_kardex);
       
        }
       

        if (!$existe)
        {
               

        $qry_ingreso_kardex ="insert into tb_kardex";  
        $qry_ingreso_kardex.="(no_ingreso, codigo_empresa, codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, codigo_tipo_movimiento, fecha, entrada, usuario_creo, fecha_creado, saldo, activo, id_dependencia, costo_actual, costo_factura)";
        $qry_ingreso_kardex.="values ('$txt_no', $cbo_empresa, $cbo_bodega, '$codigoproducto', '$categoria', '$subcategoria', 1, getdate(), '$ingresado[$cnt]', '$nombre_usuario', getdate(), '$ingresado[$cnt]', 1, '$cbo_dependencia', '$costo_unitario[$cnt]', '$precio_total1[$cnt]')";
       
        $query($qry_ingreso_kardex);
            //  print($qry_ingreso_kardex);
                           
        }  
               
               
                if (!$existe)
        {
               
                         
        $saldo=$row["saldo"]+$ingresado[$cnt];  
       
       
   
            $costo_actual=$row["saldo"]*$row["costo_actual"];
               
                $costo_totalant=$row["costo_total"];
     $costo_nuevo=$ingresado[$cnt]*$costo_unitario[$cnt];
        $suma_costo=$costo_actual+$costo_nuevo;
           
       
           
           
        //$costo_factura=$promedio*$ingresado[$cnt];
       
       
       
         $costo_total=$precio_total1[$cnt]+$costo_totalant;
         
         $promedio= $costo_total/$saldo;
          $trues = number_format($promedio, 2, '.', '2');
         
         
         $costo_movimiento= $saldo * $trues;
         
                    $qry_ingreso_kardex ="update tb_kardex set saldo='$saldo', costo_actual='$costo_unitario[$cnt]', costo_promedio='$promedio', costo_movimiento='$costo_movimiento', costo_total='$costo_total' where codigo_empresa='$cbo_empresa' and codigo_bodega='$cbo_bodega' and codigo_producto='$codigoproducto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";    
       
    //print($qry_ingreso_kardex);
       
        }
       
       
        //print($qry_ingreso_inventario);
        $query($qry_ingreso_kardex);
        $cnt++;
    }          
   
    /////////////////////////////////// Actualiza tabla inventario /////////////////////////////
    $cnt=1;        
    while($cnt<=count($bien))
    {                      
        $codigoproducto = $bien[$cnt][1];      
        $categoria = $bien[$cnt][2];
        $subcategoria = $bien[$cnt][3];
       
       
        //$codigo = $bien[$cnt][4];
        $renglon = $bien[$cnt][5];
        // Consultar si existe el producto en la tabla
        $qry_consulta="select * from tb_inventario where codigo_bodega='$cbo_bodega' and codigo_empresa='$cbo_empresa' and codigo_producto='$codigoproducto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
        //print($qry_consulta);
        $res_consulta=$query($qry_consulta);
        $existe=false;
        while($row=$fetch_array($res_consulta))
        {
            $existe=true;
            $existencia_actual=$row["existencia"]+$ingresado[$cnt];
            $qry_ingreso_inventario ="update tb_inventario set 
            existencia='$existencia_actual', 
            ultimo_ingreso=getdate(), 
            usuario_ingreso='$nombre_usuario', 
            ultimo_costo='$costo_unitario[$cnt]' 
            where codigo_empresa=$cbo_empresa 
            and codigo_bodega=$cbo_bodega 
            and codigo_producto='$codigoproducto' 
            and codigo_categoria='$categoria' 
            and codigo_subcategoria='$subcategoria'";
        }
        if (!$existe)
        {
            $qry_ingreso_inventario ="insert into tb_inventario";  
            $qry_ingreso_inventario.="(
                existencia, 
                ultimo_ingreso, 
                usuario_ingreso, 
                codigo_empresa, 
                codigo_bodega, 
                codigo_producto, 
                codigo_categoria, 
                codigo_subcategoria, 
                costo_inicial, 
                ultimo_costo, 
                cantidad_comprometida)";
            $qry_ingreso_inventario.="values (
                '$ingresado[$cnt]', 
                getdate(), 
                '$nombre_usuario',
                 $cbo_empresa, 
                 $cbo_bodega,
                  '$codigoproducto', 
                  '$categoria', 
                  '$subcategoria',
                   '$costo_unitario[$cnt]', 
                   '$costo_unitario[$cnt]',
                    0)";        
        }
        //print($qry_ingreso_inventario);
        $query($qry_ingreso_inventario);
        $cnt++;
    }          
   
    /////////////////////////////////// Actualiza tabla inventario_det /////////////////////////////
    /*
    $cnt=1;        
    while($cnt<=count($bien))
    {                      
        $codigo = $bien[$cnt][4];
        $codigoproducto = $bien[$cnt][1];      
        $categoria = $bien[$cnt][2];
        $subcategoria = $bien[$cnt][3];
            $renglon = $bien[$cnt][5];  
        // Consultar si existe el producto en la tabla
        $qry_consulta="select * from tb_inventario_det where codigo_empresa='$cbo_empresa' and codigo_bodega='$cbo_bodega' and codigo_producto='$codigoproducto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
        //print($qry_consulta);
        $res_consulta=$query($qry_consulta);
        $existe=false;
        while($row=$fetch_array($res_consulta))
        {
            $existe=true;
            $existencia_actual=$row["existencia"]+$ingresado[$cnt];
            $qry_ingreso_inventario ="update tb_inventario_det ";          
            $qry_ingreso_inventario.="set existencia='$existencia_actual', activo=1 where codigo_empresa=$cbo_empresa and codigo_bodega=$cbo_bodega and codigo_producto='$codigoproducto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
        }
        if ($existe==false)
        {
            $qry_ingreso_inventario ="insert into tb_inventario_det ";  
            $qry_ingreso_inventario.="(existencia, codigo_empresa, codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, activo) ";
            $qry_ingreso_inventario.="values ('$ingresado[$cnt]', $cbo_empresa, $cbo_bodega, '$codigoproducto', '$categoria', '$subcategoria', 1)";        
        }
        $query($qry_ingreso_inventario);
        $cnt++;
    }              
    */
    //session_unregister("ingreso");
    echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';                            
    echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Hoja de ingreso guardada correctamente!</span></center></TD></TR>';                                      
}



else

{
    echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';                            
    echo '<TR><TD COLSPAN="5"><span class="error"><center>Puede ingresar nuevos productos utilizando la opcion Entradas, del menú izquierdo</span></center></TD></TR>';    
}
//cambiar_ventana("../index.php");
?>
</body>
</html>