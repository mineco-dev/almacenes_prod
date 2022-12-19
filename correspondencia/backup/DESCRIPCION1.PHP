
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo5 {
	color: #FF0000;
	font-weight: bold;
}
.Estilo7 {
	color: #FF0000;
	font-size: 22px;
	font-weight: bold;
}
body {
	background-color: #CDDCDC;
}
-->
</style>



<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.DESCRIPCION.value == "")
  { alert("Por favor ingrese una DESCRIPCION"); form.DESCRIPCION.focus(); return; }

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
   			form.action = "DESCRIPCION1.PHP?regreso=1";	} 
}
</script>




</head>

<body>
		  <p align="center"><span class="Estilo7">DESCRIPCION DE LA ENTREGA</span></p>
		  <p align="center">&nbsp;</p>
		 
		  <form name="form1" method="post" action="conexiondescripcion1.php">
		
    <table width="296" border="0" cellspacing="0" cellpadding="2">


    <tr>
      <td width="148"><div align="center"><strong> DESCRIPCION:</strong></div></td>
      <td width="140">
	<input name="DESCRIPCION" type="text" id="DESCRIPCION" size="35" ></td>
    </tr>


    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  <p>
<input name="cmd_guardar" type="button"onClick="Validar(this.form)" id="cmd_guardar" value="Guardar" >
</p>
  </form>


</html>
