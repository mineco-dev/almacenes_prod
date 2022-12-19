
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- TemplateParam name="OptionalRegion1" type="boolean" value="true" -->

<style type="text/css">
<!--
.Estilo1 {color: #C2DCDC}
.Estilo5 {	color: #C2DCDC;
	font-weight: bold;
	font-size: 24px;
}
body {
	background-color: #C2DCDC;
}
-->


</style>



<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.NOMBRE_EMPLEADO.value == "")
  { alert("Por favor ingrese un NOMBRE"); form.NOMBRE_EMPLEADO.focus(); return; }
  if (form.APELLIDO_EMPLEADO.value == "")
  { alert("Por favor ingrese un APELLIDO"); form.APELLIDO_EMPLEADO.focus(); return; }
  if (form.CARGO.value == "")
  { alert("Por favor ingrese un CARGO"); form.CARGO.focus(); return; }
  if (form.NIVEL.value == "")
  { alert("Por favor ingrese un NIVEL"); form.NIVEL.focus(); return; }
  if (form.EMAIL.value == "")
  { alert("Por favor ingrese un EMAIL"); form.EMAIL.focus(); return; }
  if (form.EXTENSION.value == "")
  { alert("Por favor ingrese una EXTENSION"); form.EXTENSION.focus(); return; }
  if (form.CODIGO_DEPARTAMENTO.value == "")
  { alert("Por favor ingrese un DEPARTAMENTO"); form.CODIGO_DEPARTAMENTO.focus(); return; }



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
   			form.action = "EMPLEADOS.PHP?regreso=1";	} 
}
</script>






<? include ("menus.php");
?>




<body>
<p align="center"><span class="Estilo7">EMPLEADO</span></p>

</p>
<form name="form1" method="post" action="conexion.php">
		  
		  
	        <table width="622" border="0" align="left">
              <tr>
                <th width="129" scope="col"><div align="left">NOMBRE:</div></th>
                <th width="224" scope="col">
                  <div align="left">
                    <input name="NOMBRE_EMPLEADO" type="text" id="NOMBRE_EMPLEADO" size="35" style="position:absolute;width:202px;left:445px;top:224px;z-index:4">                
                 

 </div></th>
                <th width="95" scope="col">&nbsp;</th>
                <th width="156" scope="col">&nbsp;</th>
              </tr>
              <tr>
                <td><div align="left"><strong>APELLIDO:</strong></div></td>
                <td>
                  <div align="left">
<input name="APELLIDO_EMPLEADO" type="text" id="APELLIDO_EMPLEADO" size="35" style="position:absolute;width:202px;left:445px;top:246px;z-index:5">
                    

             

                  </div></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="left"><strong>CARGO:</strong></div></td>
                <td>                  <div align="left">
                    <input name="CARGO" type="text" id="CARGO" size="35" style="position:absolute;width:202px;left:445px;top:268px;z-index:6">



                  </div></td>
                <td><strong>NIVEL:</strong></td>
                <td><input name="NIVEL" type="text" id="NIVEL" size="35"    style="position:absolute;width:110px;left:820px;top:268px;z-index:7"></td>
              </tr>
              <tr>
                <td><div align="left"><strong>EMAIL:</strong></div></td>
                <td>
                  <div align="left">
                    <input name="EMAIL" type="text" id="EMAIL" size="35"    style="position:absolute;width:202px;left:445px;top:290px;z-index:8">
</div></td>
                <td><strong>EXTENSION</strong></td>
                <td><input name="EXTENSION" type="text" id="EXTENSION" style="position:absolute;width:110px;left:820px;top:290px;z-index:9"  ></td>
              </tr>
              <tr>
			 
                <td height="53"><strong>DEPARTAMENTO:</strong></td>
                <td>
                  <div align="left"><select name="CODIGO_DEPARTAMENTO" id="CODIGO_DEPARTAMENTO">

<?
$conection = mssql_connect("SERVER_APPL","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);


				  $q= "select * from DEPARTAMENTO";
	$res=mssql_query($q);
	
	while ($row = mssql_fetch_row($res))
	{
		print "<option value=$row[0]>  $row[1] </row>"; 

}




?>
                  </select>
</div></td>
                <td><strong>DE BAJA:</strong></td>
                <td><select name="DE_BAJA" id="DE_BAJA">
                  <option value="NO">NO </option>
                  <option value="SI">SI </option>
                </select>
				
              </tr>
              <tr>
                <td><div align="left"></div></td>
                <td>
                  <div align="left">                  </div></td>
                <td><p>
                  <label></label>
                  
                  <br>
                  <label>                  </label>
                  <br>
                </p></td>
                <td><p>
              
                  <br>
                </p></td>
              </tr>
            </table>
	        <p>&nbsp;</p>
	        <p>&nbsp;	        </p>
	        <p>&nbsp;	        </p>
	        <p>&nbsp;	        </p>
	        <p>&nbsp;</p>
	        <p>&nbsp;	        </p>
	        <p>
	          <input name="cmd_guardar" type="button"onClick="Validar(this.form)" id="cmd_guardar" value="Guardar" >    
  </p>
</form>
         <div align="right">      <a href="encabezado1.php?cmd=resetall" class="Estilo4"> <img src="imagenes/VOLVER.GIF" width="50" height="31" >

MENU</a></div>


</body>
</html>


