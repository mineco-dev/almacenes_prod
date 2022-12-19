<?PHP
require "../../includes/sqlcommand.inc";
require '../../includes/funciones.php';





$usuario_id = ($_SESSION["user_id"]); //codigo del usuario
$grupo_id = ($_SESSION["group_id"]); // Codigo del grupo
$usuario_nombre = $_SESSION["user_name"];
$dependencia = $_SESSION["departament_id"];
$codigo_grupo = $_SESSION["codigo_grupo"];
//print($codigo_grupo);

$empresa = ($_POST['cbo_tipo_empresa']);

?>
  <!DOCTYPE html>
  <html>
  <head>
    <script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript">
function compara (form) {
  if (form.clave1.value == form.clave2.value)
   form.img.src = "../../imagenes/yes.jpg";
 else
   form.img.src = "../../imagenes/no.jpg";
}
function valida (form) {
  if (form.clave1.value = form.clave2.value) form.img.src = "../../imagenes/no.jpg";
  //alert("hola");
}
</script>
<!-- <script language=javascript src=../includes/FormCheck.js></script> -->
<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar (form) {
	try
	{
		if (form['pregunta'].value.length == 0)
		{
			alert("Debe ingresar la descripcion de la información a solicitar");
		}else
		{
			if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
		}
	}catch (ee)
	{
		alert("Debe ingresar la descripción de la información a solicitar");
	}
}

function imprimir()
{
//	alert(window.document.form1.opnacionalidad[0].value);
//	alert(window.document.form1.opnacionalidad[1].value);
if (window.document.form1.opnacionalidad[0].checked)
{
  document.getElementById("div_extranjero").style.display = "none";
  document.getElementById("div_nacional").style.display = "inline";
}else
{
  if (window.document.form1.opnacionalidad[1].checked)
  {
   document.getElementById("div_extranjero").style.display = "inline";
   document.getElementById("div_nacional").style.display = "none";
 }else
 {
   document.getElementById("div_extranjero").style.display = "none";
   document.getElementById("div_nacional").style.display = "none";
 }
}
}
</SCRIPT>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<meta http-equiv="Content-Type" content="text/html" charset="utf-8_spanish_ci" />
<link href="../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">

</head>
<body oncontextmenu="return false">
  <form action="guardarRequi.php" method="post" enctype="multipart/form-data" name="form1" id="data">
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>
          <div id="TabbedPanels1" class="TabbedPanels">
            <ul class="TabbedPanelsTabGroup">
              <li class="TabbedPanelsTab" tabindex="0"><strong>Ingreso de Requisicion</strong></li>

            </ul>
            <div class="TabbedPanelsContentGroup" >
              <div class="TabbedPanelsContent" >
                <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
                  <tr>
                    <td colspan="4">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="4">&nbsp;</td>
                  </tr>



                  <td valign="top">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  <tr>
                   <td valign="top">&nbsp;</td>
                   <td>Solicitante:
                    <td colspan="2">
                      <a   onclick="buscar=window.open('busca_persona.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;">
                       <input name="nombre[0][0]" type="text" id="textfield3" value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]" size="55" /> <button>...</button>
                     </a>
                     <input id="nombre[0][2]" type="input" name="nombre[0][2]" size="55" style="visibility: hidden;"/>
                     <input type="input" id="nombre[0][1]"  name="nombre[0][1]"  style="visibility: hidden;"/>
                   </td>

                 </tr>


                 <tr>
                  <td valign="top">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="92" valign="top">&nbsp;</td>
                  <td width="191">No. Requisicion</td>
                  <td width="627" colspan="2">
                   <?PHP

conectardb($almacen);
// $qry_tipo_estatus="select max(codigo_requisicion_enc + 1) as ultima_requisicion from tb_requisicion_enc";
$qry_tipo_estatus = "select isnull(max(codigo_requisicion_enc)+ 1,0+1) as ultima_requisicion from tb_requisicion_enc";
$res_qry_tipo_estatus = $query($qry_tipo_estatus);
while ($row_tipo_estatus = $fetch_array($res_qry_tipo_estatus)) {
    print('<input  name="txt_no_requisicion" value=' . $row_tipo_estatus["ultima_requisicion"] . ' type="text" size="10" id="txt_no_requisicion" disabled/><input name="txt_no_requisicion" value=' . $row_tipo_estatus["ultima_requisicion"] . ' type="hidden" size="10" id="txt_no_requisicion" disabled/>');
}
$free_result($res_qry_tipo_estatus);
?>
                 </td>
               </tr>


               <tr>
                <td valign="top">&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>







<!--               <tr>
                <td valign="top">&nbsp;</td>
                <td>Dependencia</td>
                <td colspan="2">
                  <?PHP
conectardb($almacen);
$qry_empresa = "select * from direccion where activo = 1";
$res_qry_empresa = $query($qry_empresa);
?>
                  <select  class="form-control" style="width:40%;" name="cbo_dependencias" id="cbo_dependencias" onChange="javascript:cargarCombo('cbo_jefe.php', 'cbo_dependencias', 'Div_jefe')">
                   <?PHP
$nombre = ":: Seleccione ::";
echo '<option value="0">' . $nombre . '</option>';
while ($row_empresa = $fetch_array($res_qry_empresa)) {
    echo '<option value="' . $row_empresa["iddireccion"] . '">' . $row_empresa["nombre"] . '</option>';
}
?>
                </select>
                <?PHP
$free_result($res_qry_empresa);
?>
              </td>
            </tr>  -->
            <tr >
                <td valign="top">&nbsp;</td>
                <td>Dependencia</td>

                    <td  colspan="2"><label class = "desc" for = "Departamento"></label><br>
                      <select  class="form-control"  style="width:40%;" id = "Departamento" name = "Departamento" required>
                        <option    value = "0">--Seleccione una opcion--</option>
                      </select>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
            <td>Jefe Dependencia</td>
          <td colspan="2" ><label class = "desc" for = "Municipio"></label><br>

            <select class="form-control" style="width:40%" id = "Municipio" name = "Municipio" required>
              <option   value = "0" >--Seleccione una opcion--</option>
            </select>
          </td>
            </tr>
<!--             <tr>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
            <td>Jefe Dependencia</td>
            <td colspan="2">
              <div id="Div_jefe">
                <select  class="form-control" style="width:40%;" name="cbo_jefe"  id="cbo_jefe">
                </select>
              </div>
            </td>
            </tr> -->

            <tr>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>


            <tr>
              <td valign="top"><div align="center"></div></td>
              <td valign="top">Estatus</td>
              <td colspan="2">
                <?PHP

conectardb($almacen);
$qry_tipo_estatus = "select * from cat_estatus where codigo_estatus = '3'";
$res_qry_tipo_estatus = $query($qry_tipo_estatus);
while ($row_tipo_estatus = $fetch_array($res_qry_tipo_estatus)) {
    print('<input  name="txt_estatus" value=' . $row_tipo_estatus["estatus"] . ' type="text" size="10" id="txt_estatus" disabled/><input name="txt_estatus" value=' . $row_tipo_estatus["codigo_estatus"] . ' type="hidden" size="10" id="txt_estatus"/>');
}
$free_result($res_qry_tipo_estatus);
?>
             </td>
           </tr>

           <tr>
            <td valign="top">&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>

          <tr>
            <td valign="top">&nbsp;</td>
            <td>Observaciones</td>
            <td colspan="2">
              <textarea class="form-control" style="width:40%;" name="observaciones" id="observaciones" cols="30" rows="5"></textarea>
              <!-- <input class="form-control"  style="width:40%;" name="observaciones" type="text" id="observaciones" size="75"> --></td>
            </tr>

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
<br>
<br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <div id="TabbedPanels1" class="TabbedPanels">

        <ul class="TabbedPanelsTabGroup">

          <li class="TabbedPanelsTab " tabindex="0"><strong>Detalle del Producto</strong></li>
    <!-- <li class="TabbedPanelsTab style3" tabindex="0">Acreedor(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Bien(es)</li>
    <li class="TabbedPanelsTab style3" tabindex="0">Condiciones</li> -->
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">

      <?if ($empresa == "1") {

    include "../requisicion_pro_diaco.php";
}

if ($empresa == "2") {

    include "../requisicion_det_micro.php";
}

if ($empresa == "3") {

    include "../requisicion_det_mercantil.php";
}

if ($empresa == "5") {
    include "../requisicion_pro_diaco.php";
}

?>    <?// include("requisicion_det_mineco.php"); ?>
     <br>
   </div>
 </div>
</div>
</td>
</tr>
</table>
<p align="center">
  <input type="hidden" id="T_Accion" name="T_Accion" value="0">
  <input name="cmd_guardar" type="button" onClick="validar(this.form)"  class="boton grey" id="cmd_guardar" value="Mandar a Aprobación" >
 <!-- <input name="Temporal" type="button"   onClick="validar(this.form)" class="boton grey" id="Temporal" value="Guardar" > -->

</p>
</form>

<p>&nbsp;</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>


</body>

<script type="text/javascript">

//Funcion Envio a temporal
// $(document).on('ready',function(){
//     $('#Temporl').click(function(){
//         var url = "RequiTemporal.php";
//         $.ajax({
//            type: "POST",
//            url: url,
//            data: $("#data").serialize(),
//            success: function(data)
//            {
//              alert("enviado");
//            }
//        });
//     });
// });

var enviodocumento;
$(document).on('ready',function (){
    $('#Temporal').click(function(){
       document.getElementById("T_Accion").value = 1;
       if (confirm('�Esta seguro de guardar temporalmente esta requisición?')) {
          document.getElementById("Temporal").value = "Guardar Temporal";
            //if (document.getElementById("T_Accion").value == 1) {

           // };
       };
    });
});
  $.ajax({
    url: '../PHP/CargaDepartamento.php',
    async: false,
    success: function(data)
    {
      $("#Departamento").empty();
      $("#Departamento").append(data);
    }
  });

  $("#Departamento").change(function(){
    $.ajax({
      url: '../PHP/CargaJefe.php',
      type: 'POST',
      data: {idDepartamento: $("#Departamento").val()},
      async : false,
      success: function(data)
      {
        $("#Municipio").empty();
        $("#Municipio").append(data);
      }
    });
  });


//************************************

function valor(objeto)
{
	try {
		if ((objeto.value+0) == 0)
			return false;
		else
			return true;
	} catch(e)
	{
		return false;
	}
}
function validarEntero(numero){
  if ((isNaN(numero)) && (numero > 0)) {
    alert("Solo puede ingresar numeros validos en el campo");
    return "";
  }else{
    return numero;
  }
}
function validar(form)
{
//////////////////////// Encabezado ///////////////////////////////////////////////////
if ((form['nombre[0][1]'].value) == ""){alert('Seleccione el nombre del solicitante'); form['nombre[0][1]'].focus();  return};

if ((form['Departamento'].value) == "0"){alert('Seleccione la dependencia'); form['Departamento'].focus();  return};

 if ((form['Municipio'].value) == "0"){alert('Seleccione el jefe de dependencia'); form['Municipio'].focus();  return};
//if ((form['T_Accion'].value) == "0"){return};

/*Codigo de verificacion de producto 19-12-2016*/
for(i = 0; i < 100; i++)
{
  if(form['bien['+i+'][4]'])
  {
   if(form['bien['+i+'][4]'].value == 0)
   {
    alert('Debe seleccionar un producto o eliminar la linea que esta vacia en el detalle del producto'); form['bien['+i+'][4]'].focus();return
  };
  if(!form['cantidad_solicitada['+i+']'].value)
  {
    alert('Debe ingresar un cantidad para el producto seleccionado'); form['cantidad_solicitada['+i+']'].focus();return
  };
}
}
/*Fin del codigo 19-12-2016*/

	//if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
	//if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Detalle //////////////////////////////////////////////////////////
	//	ban = 0; for (i=1;i<100;i++) { if (validarEntero(form['ingresado['+i+']']!="")) ban = 1; } if (ban == 0) {alert('No se acepta el ingreso de letras y comas en Cantidad recibida'); return};
  ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][4]'])) ban = 1; } if (ban == 0)
  {alert('Falta el detalle de los productos ingresados'); return};
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////

if (confirm('�Esta seguro de guardar estos datos?')) form.submit();
}
</script>
</html>