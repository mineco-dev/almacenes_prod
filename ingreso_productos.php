<?php
session_start();
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
define("L_LANG", "es_ES");
$usuario_id = ($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">





    <script type="text/javascript">
        var peticion = false;
        var testPasado = false;
        try {
            peticion = new XMLHttpRequest();
        } catch (trymicrosoft) {
            try {
                peticion = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (othermicrosoft) {
                try {
                    peticion = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (failed) {
                    peticion = false;
                }
            }
        }
        if (!peticion)
            alert("ERROR AL INICIALIZAR!");
        function cargarCombo(url, comboAnterior, element_id) {
            console.log("url", url, " combo", comboAnterior, " elemento id", element_id)
            var element = document.getElementById(element_id);
            var valordepende = document.getElementById(comboAnterior)
            var x = valordepende.value
            var fragment_url = url + '?Id=' + x;
            element.innerHTML = '<img src="../images/loading.gif" />';
            peticion.open("GET", fragment_url);
            peticion.onreadystatechange = function () {
                if (peticion.readyState == 4) {
                    element.innerHTML = peticion.responseText;
                }
            }
            peticion.send(null);
        }

    </script>
    <style>
        .form-control {
            display: inline !important;
            margin-right: 5px !important;   
        }
    </style>
    <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
    <meta charset="utf-8">
    <meta lang="es">
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
    <link href="HojaEstilo.css" rel="stylesheet" type="text/css"/>
    <link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
    <script language="javascript" src="calendar/calendar.js"></script>
</head>
<body>
<form name="frm_ingreso_productos" id="frm_ingreso_productos" action="gingreso_productos.php" method="POST"
      enctype="multipart/form-data">
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div id="TabbedPanels1" class="TabbedPanels">
                    <ul class="TabbedPanelsTabGroup">
                        <li class="TabbedPanelsTab" tabindex="0"><strong>Ingreso de Producto</strong></li>
                    </ul>
                    <div class="TabbedPanelsContentGroup">
                        <div class="TabbedPanelsContent">
                            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td width="92" valign="top">&nbsp;</td>
                                    <td width="191">No. Ingreso</td>
                                    <td width="627" colspan="2">
                                        <?php
                                        $qry_ingreso_enc = "select max (no_ingreso)+1 as no_ingreso from tb_ingreso_enc";
                                        conectardb($almacen);
                                        $res_ingreso_enc = $query($qry_ingreso_enc);
                                        while ($row_ingreso_enc = $fetch_array($res_ingreso_enc)) {
                                            $no_ingreso = $row_ingreso_enc["no_ingreso"];
                                        }
                                        ?>
                                        <input class="form-control" style="width:10%;" name="txt_no" type="text"
                                               id="txt_no" size="12" value="<?php echo $no_ingreso ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">Nit Proveedor</td>
                                    <td colspan="3" width="627"><a
                                                onClick="buscar=window.open('proveedor.php?tipo=proveedor&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;">
                                            <input name="proveedor[0][0]" type="text" id="proveedor[0][0]" size="15"
                                                   class="form-control " style="width:12%;" disabled/>
                                            <button class="btn btn-primary">..</button>
                                        </a>
                                        <input name="proveedor[0][1]" type="text" id="proveedor[0][1]" size="55" style="visibility:hidden"/>
                                        <input name="idProveedor" type="text" id="idProveedor" size="55"  style="visibility:hidden"/></td>
                                </tr>

                                <td valign="top">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td colspan="2">&nbsp;</td>

                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>Empresa</td>
                                    <td colspan="2">
                                        <?php
                                        conectardb($almacen);
                                        $qry_empresa = "SELECT * from cat_empresa
										WHERE activo=1";
                                        $res_qry_empresa = $query($qry_empresa);
                                        ?>
                                        <select class="form-control " style="width:17%;" name="cbo_empresa"
                                                id="cbo_empresa"
                                                onChange="javascript:cargarCombo('cbo_bodega2.php', 'cbo_empresa', 'Div_bodega')">
                                            <?php
                                            $nombre = ":: Seleccione ::";
                                            //echo '<option value="0">' . $nombre . '</option>';
                                            while ($row_empresa = $fetch_array($res_qry_empresa)) {
                                                echo '<option value="' . $row_empresa["codigo_empresa"] . '">' . $row_empresa["empresa"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <?php
                                        $free_result($res_qry_empresa);
                                        ?>                </td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>Bodega</td>
                                    <td colspan="2">
                                        <div id="Div_bodega">
                                            <select class="form-control " style="width:20%;" name="cbo_bodega" id="cbo_bodega">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td valign="top">
                                        <div align="center"></div>
                                    </td>
                                    <td valign="top">Tipo de Ingreso</td>
                                    <td colspan="2"><?php
                                        conectardb($almacen);
                                        //print($almacen);
                                        $qry_tipo_docto = "SELECT * FROM cat_tipo_documento WHERE activo=1 and codigo_tipo_movimiento=1 ORDER BY tipo_documento";
                                        $res_qry_tipo_docto = $query($qry_tipo_docto);
                                        echo('<select class="form-control " style="width:20%;" name="cbo_tipo_docto">');
                                        $nombre = ":: Seleccione ::";
                                        //echo'<option value="0">'.$nombre.'</option>';
                                        while ($row_tipo_docto = $fetch_array($res_qry_tipo_docto)) {
                                            echo '<option value="' . $row_tipo_docto["codigo_tipo_documento"] . '">' . $row_tipo_docto["tipo_documento"] . '</option>';
                                        }
                                        echo('</select>');
                                        $free_result($res_qry_tipo_docto);
                                        ?> </select>          </td>
                                </tr>
                                <td valign="top">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td colspan="2">&nbsp;</td>

                                <tr>
                                    <td valign="top">
                                        <div align="center"></div>
                                    </td>
                                    <td valign="top">Dependencia</td>
                                    <td colspan="2">
                                        <?php
                                        conectardb($almacen);
                                        $qry_tipo_dependencia = "select * from direccion order by nombre";
                                        $res_qry_tipo_dependencia = $query($qry_tipo_dependencia);
                                        echo('<select class="form-control " style="width:20%;" name="cbo_dependencia">');
                                        $nombre = ":: Seleccione ::";
                                        //echo'<option value="0">'.$nombre.'</option>';
                                        while ($row_tipo_dependencia = $fetch_array($res_qry_tipo_dependencia)) {
                                            echo '<option value="' . $row_tipo_dependencia["iddireccion"] . '">' . $row_tipo_dependencia["nombre"] . '</option>';
                                        }
                                        echo('</select>');
                                        $free_result($res_qry_tipo_dependencia);
                                        ?>
                                        </select>          </td>
                                </tr>
                                <td valign="top">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td colspan="2">&nbsp;</td>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">Solicitante</td>
                                    <td colspan="2"><a href="javascript:void(0)"
                                                       onclick="buscar=window.open('busca_persona2.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;">
                                            <input name="nombre[0][0]" type="text" id="nombre[0][0]"
                                                   value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]" size="20"
                                                   class="form-control " style="width:36%;" disabled/>
                                            <button class="btn btn-primary">..</button>
                                        </a>
                                        <input name="solicitante" type="input" id="solicitante" size="55" style="visibility:hidden"/>
                                        <input type="input" name="idSolicitante" id="idSolicitante" style="visibility:hidden"/></td>
                                </tr>
                                <td valign="top">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td colspan="2">&nbsp;</td>
                                <tr>
                                    <td valign="top">
                                        <div align="center"></div>
                                    </td>
                                    <td valign="top">Programa</td>
                                    <td colspan="2">
                                        <?php
                                        conectardb($almacen);
                                        $type = "select codigo_programa, Descripcion from tb_programa WHERE activo = 1";
                                        $response = $query($type);
                                        ?>

                                        <select
                                                class="form-control "
                                                style="width:20%;"
                                                name="cbo_programa"
                                                id="cbo_programa"
                                                onChange="cargarCombo('PHP/actividades.php', 'cbo_programa', 'actividad')">

                                        <?php
                                        $nombre = ":: Seleccione ::";
                                        echo'<option value="0">'.$nombre.'</option>';
                                        while ($row = $fetch_array($response)) {
                                            echo '<option value="' . $row["codigo_programa"] . '">' . $row["Descripcion"] . '</option>';
                                        }
                                        echo('</select>');
                                        $free_result($response);
                                        ?>
                                        </select>          </td>
                                </tr>
                                <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>Actividad</td>
                                    <td colspan="2">
                                        <div id="actividad">
                                            <select class="form-control " style="width:20%;" name="cbo_actividad" id="cbo_actividad">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>

                                 </td>
              </tr>
                                <!--                   <tr>
                                          <td valign="top">&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td colspan="2">&nbsp;</td>
                                        </tr>
                                            <tr>
                                                <td valign="top">&nbsp;</td>
                                                <td>Actividad</td>
                                                <td colspan="2">
                                                <div id="Div_actividad">
                                                  <select name="cbo_actividad"  id="cbo_actividad">
                                                  </select>
                                                  </div>                  </td>
                                                  </tr> -->


                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="92" valign="top">&nbsp;</td>
                                    <td width="191">Serie Factura</td>
                                    <td width="627" colspan="2"><input class="form-control " style="width:12%;" name="txt_no_serie" type="text" id="txt_no_serie" size="5"></td>
                                </tr>

                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="92" valign="top">&nbsp;</td>
                                    <td width="191">No. Factura</td>
                                    <td width="627" colspan="2"><input class="form-control " style="width:12%;"
                                                                       name="txt_no_ingreso" type="text"
                                                                       id="txt_no_ingreso" size="12"></td>
                                </tr>

                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>Fecha de Factura:</td>
                                    <td colspan="2">
                                        <?php
                                        $day = date("d");
                                        $month = date("m");
                                        $year = date("Y");
                                        require_once('calendar/classes/tc_calendar.php');
                                        $myCalendar = new tc_calendar("date1", true);
                                        $myCalendar->setIcon("calendar/images/iconCalendar.gif");
                                        $myCalendar->setDate($day, $month, $year);
                                        $myCalendar->writeScript();
                                        ?>
                                        </span></span></td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr style = "display:none">
                                    <td valign="top">&nbsp;</td>
                                    <td>Fecha de Ingreso al sistema de Almacen</td>
                                    <td colspan="2" readonly>
                                        <?php
                                        $day = date("d");
                                        $month = date("m");
                                        $year = date("Y");
                                        require_once('calendar/classes/tc_calendar.php');
                                        $myCalendar = new tc_calendar("date2", true);
                                        $myCalendar->setIcon("calendar/images/iconCalendar.gif");
                                        $myCalendar->setDate($day, $month, $year);
                                        $myCalendar->writeScript();
                                        ?>
                                        </span></span></td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>


                                <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>
                                        <div align="left">Observaciones</div>
                                    </td>
                                    <td><textarea class="form-control " style="width:45%;" name="txt_observaciones"
                                                  id="txt_observaciones" cols="50" rows="5"></textarea></td>
                                </tr>
                                <tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                            </table>


        </tr>
    </table>
    </td>
    
    </tr>
    </table>
    <p>&nbsp;</p>
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div id="TabbedPanels1" class="TabbedPanels">
                    <ul class="TabbedPanelsTabGroup">
                        <li class="TabbedPanelsTab" tabindex="0"><strong>Detalle del Producto</strong></li>
                    </ul>
                    <div class="TabbedPanelsContentGroup">
                        <div class="">
                            <?php include("ingreso_pro.php"); ?>
                            <br>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>


    <p align="center">
        <input name="cmd_guardar" type="button" class="boton grey" onClick="validar(this.form)" id="cmd_guardar"
               value="Guardar hoja de ingreso">
    </p>


    <p>&nbsp;</p>

</form>
</body>
<script type="text/javascript">
    window.onload = function() {
        
        cargarCombo('cbo_bodega2.php', 'cbo_empresa', 'Div_bodega');
    };
    function valor(objeto) {
        try {
            if ((objeto.value + 0) == 0)
                return false;
            else
                return true;
        } catch (e) {
            return false;
        }
    }

    function validarEntero(numero) {
        if ((isNaN(numero)) && (numero > 0)) {
            alert("Solo puede ingresar numeros validos en el campo");
            return "";
        } else {
            return numero;
        }
    }
    function validar(form) {
//////////////////////// Encabezado ///////////////////////////////////////////////////

        if ((form['txt_no'].value) == "") {
            alert('Escriba el numero de documento de ingreso');
            form['txt_no'].focus();
            return
        }
        ;
        if ((form['idProveedor'].value) == "") {
            alert('Seleccione el proveedor');
            form['idProveedor'].focus();
            return
        }
        ;
        if ((form['cbo_tipo_docto'].value) == "0") {
            alert('Seleccione el tipo de documento que respalda el ingreso');
            form['cbo_tipo_docto'].focus();
            return
        }
        ;
        if ((form['cbo_empresa'].value) == "0") {
            alert('Seleccione la empresa');
            form['cbo_empresa'].focus();
            return
        }
        ;
        if ((form['cbo_bodega'].value) == "0") {
            alert('Seleccione la bodega');
            form['cbo_bodega'].focus();
            return
        }
        ;
        // if ((form['cbo_actividad'].value) == "0"){alert('Seleccione el programa'); form['cbo_actividad'].focus();  return};
        // if ((form['cbo_programa'].value) == "0"){alert('Seleccione la empresa'); form['cbo_programa'].focus();  return};
        if ((form['txt_no_serie'].value) == "") {
            alert('Escriba el numero de documento de ingreso');
            form['txt_no_serie'].focus();
            return
        }
        ;
        if ((form['txt_no_ingreso'].value) == "") {
            alert('Escriba el numero de documento de ingreso');
            form['txt_no_ingreso'].focus();
            return
        }
        ;


        if ((form['solicitante'].value) == "") {
            alert('Seleccione el nombre del solicitante');
            form['solicitante'].focus();
            return
        }
        ;


        //if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
        //if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Detalle //////////////////////////////////////////////////////////	
        //	ban = 0; for (i=1;i<100;i++) { if (validarEntero(form['ingresado['+i+']']!="")) ban = 1; } if (ban == 0) {alert('No se acepta el ingreso de letras y comas en Cantidad recibida'); return};
        ban = 0;
        for (i = 1; i < 100; i++) {
            if (valor(form['bien[' + i + '][1]'])) ban = 1;
        }
        if (ban == 0) {
            alert('Falta el detalle de los productos ingresados');
            return
        }
        ;
        ban = 0;
        for (i = 1; i < 100; i++) {
            if (valor(form['bien[' + i + '][2]'])) ban = 1;
        }
        if (ban == 0) {
            alert('Falta el codigo de categoria');
            return
        }
        ;
        ban = 0;
        for (i = 1; i < 100; i++) {
            if (valor(form['bien[' + i + '][3]'])) ban = 1;
        }
        if (ban == 0) {
            alert('Falta el codigo de subcategoria');
            return
        }
        ;
        ban = 0;
        for (i = 1; i < 100; i++) {
            if (valor(form['bien[' + i + '][5]'])) ban = 1;
        }
        if (ban == 0) {
            alert('Falta el renglon');
            return
        }
        ;
        ban = 0;
        for (i = 1; i < 100; i++) {
            if (valor(form['ingresado[' + i + ']'])) ban = 1;
        }
        if (ban == 0) {
            alert('Falta las unidades ingresadas');
            return
        }
        ;
        //ban = 0; for (i=1;i<100;i++) { if (valor(form['costo_unitario['+i+']'])) ban = 1; } if (ban < 0) {alert('Falta el costo unitario'); return};


/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	

        if (confirm('¿Esta seguro de guardar estos datos?')) form.submit();
    }
</script>
<script>
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
</script>>
</html>