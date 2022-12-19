<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo5 {color: #9DACBF}
.Estilo6 {
	color: #C2DCDC;
	font-size: 24px;
}
body {
	background-color: #CDDCDC;
}
-->
</style>

<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.NOMBRE_REMITENTE.value == "")
  { alert("Por favor ingrese un NOMBRE"); form.NOMBRE_REMITENTE.focus(); return; }
  if (form.APELLIDO_REMITENTE.value == "")
  { alert("Por favor ingrese un APELLIDO"); form.APELLIDO_REMITENTE.focus(); return; }
  if (form.DIRECCION_REMITENTE.value == "")
  { alert("Por favor ingrese una direccion"); form.DIRECCION_REMITENTE.focus(); return; }
  if (form.TELEFONO.value == "")
  { alert("Por favor ingrese un TELEFONO"); form.TELEFONO.focus(); return; }

	if (confirm('�Estas seguro de guardar estos datos?')){ 
    //  document.form.submit() 
		form.submit();
   		} 

}
</script>



<script LANGUAGE="JavaScript">
function Back(form,opc)
{
	if (opc=='0') {
   			form.action = "REMITENTE1.PHP?regreso=1";	} 
}
</script>





<body>

<p class="Estilo7" align="CENTER">REMITENTE</span>
</p>

<form name="form1" method="post" action="conexionremitente1.php">
<div align="left">
  <table width="742" border="0" cellspacing="7" cellpadding="6">
    
    <tr>
      <th width="115" scope="col"><div align="left">NOMBRE</div></th>
      <th width="189" scope="col"><input name="NOMBRE_REMITENTE" type="text" id="NOMBRE_REMITENTE" size="35"></th>



      <th width="10" scope="col">&nbsp;</th>
      <th width="146" scope="col"><div align="left">APELLIDO</div></th>
      <th width="180" scope="col"><input name="APELLIDO_REMITENTE" type="text" id="APELLIDO_REMITENTE" size="35" ></th>



    </tr>

    <tr>

      <td><div align="left"><strong>DIRECCION</strong></div></td>
      <td><input name="DIRECCION_REMITENTE" type="text" id="DIRECCION_REMITENTE" size="35">

</td>
      <td>&nbsp;</td>
      <td><div align="left"><strong>TELEFONO</strong></div></td>
      <td><input name="TELEFONO" type="text" id="TELEFONO" size="35">
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>

  <input name="cmd_guardar" type="button"onClick="Validar(this.form)" id="cmd_guardar" value="Guardar" >
</div>
</form>


</body>
</html>
