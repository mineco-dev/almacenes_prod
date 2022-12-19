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
.Estilo8 {
	color: #C2DCDC;
	font-size: 24px;
}
-->
</style>



<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.NOMBRE.value == "")
  { alert("Por favor ingrese un NOMBRE"); form.NOMBRE.focus(); return; }

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
   			form.action = "DEPARTAMENTO.PHP?regreso=1";	} 
}
</script>




<? include ("menus.php");
?>	

<body>
		<p align="center"><span class="Estilo7">DEPARTAMENTO</span></p>
		 
</p>
		 
		  <form name="form1" method="post" action="conexiondepto.php">
		    <table width="296" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="148"><div align="center"><strong> NOMBRE:</strong></div></td>
      <td width="140"><input name="NOMBRE" type="text" id="NOMBRE" size="35" style="position:absolute;width:202px;left:470px;top:244px;z-index:1; height: 12px;"></td>


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

<form name="form1" method="post" action="">
  
  <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
  <p>&nbsp;</p>
<div align="right">   <a href="encabezado1.php?cmd=resetall" class="Estilo4"> <img src="imagenes/VOLVER.GIF" width="50" height="31" >

MENU</a>   </marquee>


</div>


</body>
</html>


