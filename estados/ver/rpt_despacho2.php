<?php 
    require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../../helpdesk.css" rel="stylesheet" type="text/css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> -->
    <script src="./js/comandos_rpt.js"></script>
    <style>
      .titulotabla {
  background-color: #0090ff;
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: small;
  color: #ffffff;
  font-weight: bold;
  height: 30px;
}
    </style>
  </head>
  <body>
    <div >
    <table
      width="95%"
      border="0"
      align="center"
      cellpadding="0"
      cellspacing="0"
    >
      <tr>
    
        <td colspan="2">
          <table
            width="100%"
            height="98"
            border="0"
            align="center"
            cellpadding="0"
            cellspacing="0"
          >
            <tr>
              <td width="8%" rowspan="3">
                <div align="center">
                  <span class="titulomenu">
                    <img
                      src="../../images/logo_mineco.jpg"
                      
                      height="55"
                    />
                  </span>
                </div>
              </td>
              <td colspan="3">
                <div align="right">
                  <div align="center">
                    <p class="titulomenu">
                      <?php 
                                    $hoja_despacho=$_SESSION["hoja_despacho"];
                                    $existe=false;
                                    $qry_ingreso_enc = "select convert(nvarchar(10), e.fecha_requisicion, 103) as fecha_requisicion,
                                                        convert(nvarchar(10), e.fecha_requisicion, 108) as hora_requisicion,
                                                        convert(nvarchar(10), e.fecha_despacho, 103) as fecha_despacho, e.codigo_egreso, e.numero_ingresofac,
                                                        dep.nombre, e.codigo_requisicion_enc, e.solicitante, e.observaciones
                                                        from tb_requisicion_enc e 
                                                        inner join direccion dep
                                                        on dep.iddireccion = e.codigo_dependencia
                                                        where  e.codigo_requisicion_enc = '$hoja_despacho'";
                                    conectardb($almacen);
                                    $res_ingreso_enc=$query($qry_ingreso_enc);
                                    while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
                                    {
                                        $numero_requisicion=$row_ingreso_enc["codigo_requisicion_enc"];
                                        $solicitante=$row_ingreso_enc["solicitante"];
                                        $dependencia=$row_ingreso_enc["nombre"];
                                        $observaciones=$row_ingreso_enc["observaciones"];
                                        $numero_egreso=$row_ingreso_enc["codigo_egreso"];
                                        $numero_ingreso=$row_ingreso_enc["numero_ingresofac"];
                                        $fecha=$row_ingreso_enc["fecha_requisicion"];
                                        $hora=$row_ingreso_enc["hora_requisicion"];
                                        $fecha_despacho=$row_ingreso_enc["fecha_despacho"];
                                        $existe=true;
                                        
                                    }
                                    $free_result($res_ingreso_enc);	
                                    if ($existe==true)
                                    {								
                                    ?>
                      <span class="Estilo4"
                        >Ministerio de Economía<br />
                        Solicitud de Almacén </span
                      ><br /><br />
                    </p>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td width="53%" height="60">
                <div align="left">
                  <table
                    width="98%"
                    border="1"
                    align="left"
                    cellpadding="0"
                    cellspacing="0"
                  >
                    <tr class="titulotabla">
                      <td>
                        <div align="left">SOLICITANTE</div>
                        <div align="center"></div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="titulomenu">
                          <?php  echo $solicitante; ?>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="titulomenu">
                          <?php  echo $dependencia; ?>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="titulomenu"> </span>
                      </td>
                    </tr>
                  </table>
                  <span class="titulomenu">&nbsp;</span>
                </div>
              </td>
              <td width="39%">
                <table
                  width="51%"
                  border="1"
                  align="right"
                  cellpadding="0"
                  cellspacing="0"
                >
                  <tr class="titulotabla">
                    <td width="53%"><div align="center">REQUISICIÓN</div></td>
                  </tr>
                  <tr>
                    <td>
                      <span class="titulomenu"
                        >Número:
                        <?php echo $numero_requisicion; ?>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <td height="20">
                      <span class="titulomenu"
                        >Fecha: &nbsp;&nbsp;
                        <?php echo $fecha; ?>
                      </span>
                      <span class="titulomenu"
                        >Hora: &nbsp;&nbsp;
                        <?php echo $hora; ?>
                      </span>
                    </td>
                  </tr>
                </table>
              </td>
              <td width="0%">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">
                <span class="titulomenu">observaciones: </span>
                <span class="titulomenu"> <?php echo utf8_encode($observaciones); ?> </span>
              </td>
            </tr>
            <tr>
              <td height="2" colspan="4"></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table
            width="95%"
            border="1"
            align="center"
            cellpadding="0"
            cellspacing="0"
          >
            <tr class="titulotabla">
              <td width="15%">
                <div align="center">Código</div>
              </td>
              <td width="40%">
                <div align="center">Descripción</div>
              </td>
              <td width="15%">
                <div align="center">Uni. Medida</div>
              </td>
              <td width="15%">
                <div align="center">Cantidad Solicitada</div>
              </td>
            </tr>
            <?php	  	
                    $qry_ingreso_det = "select d.codigo_requisicion_enc, d.codigo_producto, d.codigo_categoria, d.codigo_subcategoria, p.producto, m.unidad_medida,  
                    d.cantidad_solicitada, d.cantidad_autorizada
                    from  tb_requisicion_det d
                    inner join cat_producto p
                    on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
                    inner join cat_medida m
                    on p.codigo_medida = m.codigo_medida
                    where d.codigo_requisicion_enc = $numero_requisicion";
                            conectardb($almacen);
                            $res_ingreso_det=$query($qry_ingreso_det);		
                            while($row_ingreso_det=$fetch_array($res_ingreso_det))
                            {			
                                //$operador=$row_ingreso_det["usuario_creo"];
                                //$operado=$row_ingreso_det["fecha_creado"];
                                echo '<tr>
            <td align="center" width="15%">
              <span class="descripcionproducto"
                >'.$row_ingreso_det["codigo_categoria"].'-'.$row_ingreso_det["codigo_subcategoria"].'-'.$row_ingreso_det["codigo_producto"].'</span
              >
            </td>
            '; echo '
            <td align="left" width="40%">
              <span class="descripcionproducto"
                >'.utf8_encode($row_ingreso_det["producto"]).'</span
              >
            </td>
            '; echo '
            <td align="center" width="15%">
              <span class="descripcionproducto"
                >'.$row_ingreso_det["unidad_medida"].'</span
              >
            </td>
            '; echo '
            <td align="center" width="15%">
              <span class="descripcionproducto"
                >'.$row_ingreso_det["cantidad_solicitada"].'</span
              >
            </td>
            '; } $free_result($res_ingreso_det); ?>
          </table>
        </td>
      </tr>
    </table>
    <table
      width="95%"
      border="0"
      align="center"
      cellpadding="0"
      cellspacing="0"
      >
      <tr>
        <td class="titulomenu">&nbsp;</td>
        <td class="titulomenu">&nbsp;</td>
        <td class="titulomenu">&nbsp;</td>
      </tr>
      <tr>
      </tr>
      <br>
      <p></p>
      <br>
      <tr>
        <td height="19" class="titulomenu">
          <div div align="center">
            (F)_________________<br />Solicitante (Firma y nombre)
          </div>
        </td>
        <td height="19" class="titulomenu">
          <div align="center">
            (F)__________________<br />
            Jefe Inmediato(Firma y Sello)
          </div>
        </td>
        <td height="19" class="titulomenu">
          <div align="center">
            __________________ <br />
            Sello de Recibido (Direccion Administrativa)
          </div>
        </td>
      </tr>
    </table>
   </div>
  <?php
    }
    else
        {
            echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
            echo '<TR><TD COLSPAN="5"><span class="error"><center>NO SE ENCONTRO NINGUNA HOJA DE DESPACHO CON EL N�MERO --> </span>'.$hoja_despacho.' </center></TD></TR>';					
        }
  ?>
  </body>
</html>
