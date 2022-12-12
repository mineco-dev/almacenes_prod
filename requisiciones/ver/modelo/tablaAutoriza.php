<?php 
// llamada a las funciones

require('../../comandos/inc_seguridad.inc');
require_once('../../comandos/funciones.php');
require_once('../../comandos/sqlcommand.inc');
require_once('../../comandos/controldb.inc');

$dbms = new DBMS(conectardb($almacen));
$dbms->bdd = $database_cnn;
//require '../includes/funciones.php';

$idsolicitud = $_POST['valor'];
//idsolicitud = $_REQUEST["id"];

$Fields = "
    SELECT DISTINCT 
        ROW_NUMBER() OVER(ORDER BY p.producto ASC) AS Row,
        d.rowid, 
        p.producto, 
        c.categoria,  
        d.codigo_categoria,
        d.codigo_subcategoria,
        d.codigo_producto, 
        e.solicitante,
        e.fecha_requisicion, 
        dep.nombre, 
        e.observaciones, 
        e.codigo_estatus, 
        es.estatus, 
        d.codigo_empresa,
        d.codigo_requisicion_enc, 
        b.bodega, 
        em.empresa, 
        d.codigo_bodega, 
        e.usuario_aprobo, 
        e.codigo_dependencia, 
        inv.existencia,
        inv.cantidad_comprometida as cantidad_comprometida,
        d.cantidad_autorizada, 
        d.cantidad_solicitada 
        , cm.unidad_medida
        from tb_requisicion_det d
inner join tb_requisicion_enc e on
e.codigo_requisicion_enc = d.codigo_requisicion_enc
inner join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
inner join cat_categoria c on d.codigo_categoria = c.codigo_categoria
inner join cat_bodega b on
b.codigo_bodega = d.codigo_bodega
inner join cat_empresa em on
d.codigo_empresa = em.codigo_empresa
inner join direccion dep
on dep.iddireccion = e.codigo_dependencia
inner join cat_estatus es on
e.codigo_estatus = es.codigo_estatus
inner join tb_inventario inv on
d.codigo_producto = inv.codigo_producto and d.codigo_categoria = inv.codigo_categoria and d.codigo_subcategoria = inv.codigo_subcategoria
and d.codigo_bodega = inv.codigo_bodega and d.codigo_empresa = inv.codigo_empresa
left join cat_medida cm on cm.codigo_medida = p.codigo_medida
where d.codigo_requisicion_enc = '$idsolicitud'";


$res_qry_producto = $query($Fields);

$tabla = "";

while ($row = $fetch_array($res_qry_producto)) {
    $maximoexistencia = $row['existencia'] -  $row['cantidad_comprometida'];
    $input = '<input min= 0 max = '.$maximoexistencia. ' class=\"x\" name=\"producto[]\" type=\"number\" size=\"3\" id=\"solicitado\" value=\"'.$row['cantidad_solicitada'].'\" required /></br><input class=\"form-control cantidad\" name=\"codigoP[]\" type=\"hidden\" size=\"3\" id=\"codigoP\" value=\"'.$row['rowid'].'\" Readonly/></br><input class=\"form-control cantidad\" name=\"Solicitado[]\" type=\"hidden\" size=\"3\" id=\"Solicitado\" value=\"'.$row['cantidad_solicitada'].'\" Readonly/>';
    $check = '<i class=\"fas fa-exclamation-circle circle\"></i>';
    $tabla .= '{
				  "CODIGO":"' . $row["Row"] . '",
				  "ROWID":"' . $row["rowid"] . '",
                  "PRODUCTO":"' . $row["producto"]. '",
                  "unidad_medida":"' . $row["unidad_medida"]. '",
                  "SOLICITANTE":"' . $row["solicitante"]. '",
                  "CATEGORIA":"' . $row["categoria"]. '",
                  "ESTATUS":"' . $row["codigo_estatus"]. '",
                  
                  
                  "BODEGA":"' . $row["bodega"]. '",
                  "DEPENDENCIA":"' . $row["nombre"]. '",
                  "FECHA":"' . $row["fecha_requisicion"]. '",
                  "CODIGO_PRODUCTO":"' . $row["codigo_producto"]. '",
                  "APROBO":"' . $row["usuario_aprobo"]. '",
                  "SOLICITADO":"'. $row['cantidad_solicitada'].'",
                  "CODIGOPRODUCTO":"'. $row['codigo_categoria'] .'-'. $row['codigo_subcategoria'].'-'. $row['codigo_producto'].' ",
                  "INPUT":"'. $input.'",
                  "EXISTENCIA":"'. $row['existencia'].'",
                  "COMPROMETIDO": "'. $row['cantidad_comprometida'].'",
                  "CAMPO":"'. $check.'"
				},';


}

$tabla = substr($tabla, 0, strlen($tabla) - 1);

echo '{"data":[' . utf8_encode($tabla) . ']}';




?>