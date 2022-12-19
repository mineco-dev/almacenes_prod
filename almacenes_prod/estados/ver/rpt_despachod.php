<?php
session_start();
header("Content-Type: text/html;charset=utf-8");

ob_start();
require "../../../includes/funciones.php";
require "../../../includes/sqlcommand.inc";

$hoja_despacho = $_SESSION["hoja_despacho"];

$existe = false;

conectardb($almacen);


/*NUEVO CODIGO PARA MOSTRAR LOS DATOS DE SOLICITANTE DE REQUISICIONES*/

$queryNew = "
  SELECT
    convert(nvarchar(10), e.fecha_requisicion, 103) as fecha_requisicion,
    convert(nvarchar(10), e.fecha_despacho, 103) as fecha_despacho,
    e.codigo_requisicion_enc as No_Requisicion,
    e.codigo_egreso as No_Despacho,
    convert(nvarchar(10), e.fecha_aprobacion, 103) as fecha_aprobacion,
    e.solicitante as Solicitante,
    d.nombre As Dependencia,
    jefe.Nombre_Jefe_Depen as Aprobo,
    d.nombre As DependenciaAprobo,
    (u.nombres + ' ' + u.apellidos) as Autorizo,
    convert(nvarchar(10),  e.fecha_autorizado, 103) as Fecha_Autorizo,
    e.observaciones as Observaciones
  FROM tb_requisicion_enc e
    INNER JOIN direccion d
        ON d.iddireccion = e.codigo_dependencia
    INNER JOIN [helpdesk_nuevo].dbo.usuario usu
        ON usu.nombre_usuario = e.usuario_aprobo
    INNER JOIN Tb_Jefes_Depen jefe
        ON jefe.codigo_usuario = e.codigo_jefe_dependencia
    INNER JOIN [helpdesk_nuevo].dbo.usuario u
        ON u.nombre_usuario = e.usuario_autorizo
  WHERE e.codigo_requisicion_enc = $hoja_despacho and jefe.Codigo_Dependencia = e.codigo_dependencia";


$Ingreso_enc = $query($queryNew);

while ($row = $fetch_array($Ingreso_enc)) {
    $Fecha_Requisicion = $row["fecha_requisicion"];
    $Fecha_Despacho = $row["fecha_despacho"];
    $numero_requisicion = $row["No_Requisicion"];
    $No_Despacho = $row["No_Despacho"];
    $fecha_aprobo = $row["fecha_aprobacion"];
    $solicitante = $row["Solicitante"];
    $dependencia = $row["Dependencia"];
    $jefe_aprobo = $row["Aprobo"];
    $depen_jefe = $row["DependenciaAprobo"];
    $Autorizo = $row["Autorizo"];
    $Fecha_Autorizo = $row["Fecha_Autorizo"];
    $observaciones = $row["Observaciones"];
}

/*Resultado para los productos a mostrar */
$queryArticulo = "SELECT
  ROW_NUMBER() OVER(ORDER BY r.codigo_categoria asc) AS Row,  
    cast(r.codigo_categoria as varchar) + '-' +
    cast(r.codigo_subcategoria as varchar) + '-' +
    cast(r.codigo_producto as varchar) AS Articulo,
    articulo.producto as Descripcion,
    medida.unidad_medida as Medida,
    r.cantidad_solicitada as Solicitado,
    r.cantidad_autorizada as Despachado
FROM tb_requisicion_det r
    INNER JOIN cat_producto articulo
        ON articulo.codigo_categoria = r.codigo_categoria
            and articulo.codigo_subcategoria = r.codigo_subcategoria
            and articulo.codigo_producto = r.codigo_producto
    INNER JOIN cat_medida medida
        ON medida.codigo_medida = articulo.codigo_medida

WHERE codigo_requisicion_enc = $numero_requisicion
order by  r.codigo_categoria asc";

$Result_Articulo = $query($queryArticulo);
$free_result($Ingreso_enc);



while ($row_Articulo = $fetch_array($Result_Articulo)) {
  $Fila[] = $row_Articulo["Row"]; 
  $Articulo[] = $row_Articulo["Articulo"];
  $Descripcion[] = $row_Articulo["Descripcion"];
  $Medida[] =  $row_Articulo["Medida"];
  $Solicitado[] = $row_Articulo["Solicitado"];
  $Despachado[] = $row_Articulo["Despachado"];

}
$free_result($Result_Articulo);



/*Numero de Articulos para verificar la cantidad de hojas a mostrar */
$count = "SELECT
COUNT
(r.codigo_categoria) as cantidad
FROM tb_requisicion_det r
WHERE codigo_requisicion_enc = $numero_requisicion";

$Result_Count = $query($count);

while ($row_Count = $fetch_array($Result_Count)) {
    $cantidadArticulos = $row_Count["cantidad"];
}

$free_result($Result_Count);

$Phoja = 0;

$cantidadHojas = ceil($cantidadArticulos / 40);

$html = '
<!DOCTYPE html>
<html lang="en">
<head>


      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">


<style>

@page {
  size: 8.5in 11in;
  margin-top:0.6cm;
  margin-left:0.5cm;
}


.table td {
  vertical-align: top;
  border-top: 1px solid #fff !important;
  border-buttom:1px solid #fff !important;

}



.table td{
	padding:0.1rem 0rem 0.1rem 0 !important;
}

.Producto, .PSolicitado{
  border:1px solid #000 !important;
  font-size: 9px !important;
  margin:4px !important;
}

.Codigo, .Cantidad, .despachado ,.Articulo, .Unidad, .numero, .Encabezado{
  background-color: #0090FF !important;
  font-size: 9px ;
  color: #FFFFFF ;
  font-weight: bold !important;
  
  text-align:center !important;
  padding:0.1rem 0rem 0.1rem 0 !important;
  width:10%;
}

.Encabezado{
  background: #0090FF !important;
  color: #fff !important ;
}

.numero{
  width:3% !important;
}
.Articulo{
  width:45% !important;
}

.Codigo{
  width:8% !important;
}

.Cantidad, .despachado{
 width:10% !important;
}

.Unidad{
  width:10% !important;
  text-align: center;
}

.PSolicitado{
  text-align: center;
}

.page{
  text-align: right;
}

.titulomenu , .page{
  font-family: Verdana, Arial, Helvetica, sans-serif !important;
  font-size: 9px !important;
  color: #0A64AA !important;
  font-weight: bold !important;
  padding-top: 20px;
}
.error {
  font-family: Verdana, Arial, Helvetica, sans-serif !important;
  color: #FF0000 !important;
  font-size: x-small !important;
  font-weight: bold !important;
}

.observaciones{
  font-family: Verdana, Arial, Helvetica, sans-serif !important;
  font-size: 9px !important;
  color: #0A64AA !important;
  text-align: justify !important;
  padding-top:20px !important;
  border-collapse: collapse !important;

}

</style>
</head>
<body>';
$inicial = 0;
$tamaño = 0;


do {

    $html .= '<div class="container">
  <center><p class="titulomenu">HOJA DE DESPACHO </p></center>
      <table  class="table" >
        <tr>
          <td style="width:35%;">
            <img src="../../images/logo_mineco.jpg" width="260" height="95">
          </td>
          <td style="width:35%" >
                <table class="table"  border=1 cellpadding="0" cellspacing="0">
                              <tr >
                                    <td style="background-color: #0090FF !important;border:1px solid #000 !important;" class="Encabezado">
                                      SOLICITANTE
                                    </td>
                              </tr>
                              <tr>
                                    <td style="border:1px solid #000;" class="titulomenu">
                                      ' . $solicitante . '
                                    </td>
                              </tr>
                              <tr>
                                    <td style="border:1px solid #000;" class="titulomenu">
                                      ' . $dependencia . '
                                    </td>
                              </tr>
                              <tr >
                                    <td style="background-color: #0090FF !important;" class="Encabezado">
                                      APROBADO POR:
                                    </td>
                              </tr>
                              <tr >
                                    <td style="border:1px solid #000;" class="titulomenu">' . $jefe_aprobo . '</td>
                              </tr>
                              <tr >
                                    <td style="border:1px solid #000;" class="titulomenu">' . $depen_jefe . '</td>
                              </tr>
                </table>
          </td>
          <td  style="width:35%">
                          <table class="table" border=1 cellpadding="0" cellspacing="0" >
                              <tr >
                                  <td style="background-color: #0090FF !important;" class="Encabezado"><div align="center">DESPACHO</div></td>
                                  <td style="background-color: #0090FF !important;" class="Encabezado"><div align="center">REQUISICI&Oacute;N</div></td>
                              </tr>
                              <tr>
                                  <td style="border:1px solid #000;" class="titulomenu">N&uacute;mero: ' . $No_Despacho . '</td>
                                  <td style="border:1px solid #000;" class="titulomenu">N&uacute;mero: ' . $numero_requisicion . '</td>
                              </tr>
                              <tr>
                                 <td style="border:1px solid #000;" class="titulomenu">Fecha:&nbsp;&nbsp;&nbsp;' . $Fecha_Despacho . '</td>
                                 <td style="border:1px solid #000;" class="titulomenu">Fecha: &nbsp;&nbsp;' . $Fecha_Requisicion . '</td>
                              </tr>
                              <tr class="titulotabla">
                                  <td  colspan="2"  style="background-color: #0090FF !important;" class="Encabezado">FECHA DE APROBACI&Oacute;N:</td>
                              </tr>
                              <tr >
                                  <td style="border:1px solid #000;" colspan=2 class="titulomenu">Fecha:&nbsp;' . $fecha_aprobo . '</td>
                              </tr>
                              <tr>
                              <td style="border:1px solid #000;" colspan=2 class="page">P&aacute;gina '; $html .= $Phoja+1; $html .='  / '; $html .= $cantidadHojas; $html .='</td>
                              </tr>
                              
                          </table>
          </td>
      </tr>
      <tr >
        <td  colspan=3 class="observaciones">

                <div>Observaciones:  ' . ($observaciones) . '</div>
        </td>
      </tr>
    </table>
</div>
<div class="container">
    <table  width="100%" >
        <thead>
            <tr>
              <th class="numero">No.</th>
              <th class="Codigo" >C&oacute;digo</th>
              <th class="Articulo" >Descripci&oacute;n</th>
              <th class="Unidad" >Uni. Medida</th>
              <th class="Cantidad" >Cantidad Solicitada</th>
              <th class="despachado" >Cantidad Despachada</th>
            </tr>
        </thead>
          <tbody>
   ';

    $paso = $tamaño;
    $tamaño = $tamaño + 40;
    //$SaldoInicial = $tamaño - 1;
    if ($Phoja < $cantidadHojas) {
      while($paso < $tamaño){

        if (!empty($Fila[$paso])) {
          $html .= '
                    <tr >
                      <td class="Producto">';     $html .=$Fila[$paso]; $html .= '</td>
                      <td class="Producto">';     $html .=($Articulo[$paso]); $html .= '</td>
                      <td class="Producto">';     $html .=($Descripcion[$paso]); $html .= '</td>
                      <td class="Producto">';     $html .=$Medida[$paso]; $html .= '</td>
                      <td class="PSolicitado">';  $html .=$Solicitado[$paso]; $html .= '</td>
                      <td class="PSolicitado">';  $html .=$Despachado[$paso]; $html .= '</td>
                    </tr>';
        }
        $paso++;
      }
    }
    $html .= '
</tbody>
  </table>
<table class="table"  style="width:100%;padding-top:50px;">

    <tr>
    <td></td>
    <td class="titulomenu"><center><div align="center">(F)_______________________________________</div></center></td>

    <td class="titulomenu"><div align="center">(F)_________________________________________</div></td>
  </tr>
  <tr>
  <td></td>
    <td height="19" class="titulomenu"><div align="center">Encargado o/y Asistente  de Almacen Entrega Conforme </div></td>

    <td height="19" class="titulomenu"><div align="center">Solicitante Recibe Conforme</div></td>
  </tr>
</table>
<table>

<tr >
    <td colspan=3 style="width:100%;padding-top:-30px;">
    <br/>
    <br/>
    <br/>
       <div class="titulomenu">Autorizado por:  <b>' . $Autorizo . ' El ' . $Fecha_Autorizo . '</b></div>
    </td>
</tr>
</table>
</div>';

    $Phoja++;
} while ($Phoja < $cantidadHojas);

$html .= '</html>
    ';
   // echo $html;
    
    require_once '../../dompdf/pdf/dompdf_config.inc.php';
    $dompdf = new DOMPDF();
  $dompdf->set_paper("letter", "portraint");
  $dompdf->load_html(utf8_encode($html));
  $dompdf->render();
  $dompdf->stream("ACTA1.pdf", array("Attachment" => false));

// include("../../mpdf60/mpdf.php");
// $mpdf=new mPDF();
// $html = utf8_encode($html);
// $mpdf->WriteHTML($html);
// $mpdf->Output("nombre.pdf","D"); exit;
