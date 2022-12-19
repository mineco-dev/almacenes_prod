<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
if (isset($_REQUEST["id"]))
{	
		$rowid=$_REQUEST["id"];
		conectardb($almacen);
		$latabla="tb_proveedor";
		$campo_condicion="rowid";
		$qry_producto="select * from $latabla where $campo_condicion='$rowid'";
		$res_qry_producto=$query($qry_producto);
		while($row=$fetch_array($res_qry_producto))
		{				
			$no=$row["rowid"];
			$nit=$row["nit"];
			$nombre=$row["nombre"];
			$direccion=$row["direccion"];
			$telefonos=$row["telefonos"];
			$correo=$row["corrreo"];
		$contacto=$row["contacto"];	
		}
}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_nombre.value == "")
  { 
  	alert("Debe ingresar el nombre del proveedor"); 
	form.txt_nombre.focus(); 
	return;
  }
  if (form.txt_nit.value == "")
  { 
  	alert("Debe ingresar el nit"); 
	form.txt_nit.focus(); 
	return;
  }
   if (form.txt_direccion.value == "")
  { 
  	alert("Debe ingresar la direccion"); 
	form.txt_direccion.focus(); 
	return;
  }
  
  function numerico(valor)
{ 
	   campo=valor.toString();
	   var nuLongitud = campo.length;
	   var i= 0;
	   var bobandera = "TRUE";
	   for(i=0;i<nuLongitud;i++)
	   {
		  switch(campo.charAt(i))
		  {
				case '1': case '2': case '3':
				case '4': case '5': case '6':
				case '7': case '8': case '9': case '0':
				bobandera = "TRUE";
				break;
				default:
				bobandera = "FALSE";				
		  } //end switch           
	   }//end for
	   if (bobandera == "FALSE") return false
	   else return true;      
}
    form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_producto.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>
<div align="left">
  <table width="100%"  border="0">
    <tr>
      <td width="7%"></td>
      <td width="93%"><div align="center"><span class="titulocategoria">Modificaci&oacute;n de Articulos</span></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><img src="../images/linea.gif" width="100%" height="6"></div></td>
    </tr>
  </table>
  <form name="form1" method="post" action="geditar_proveedor.php">
    <table width="90%" border="0" align="center" bordercolor="#ECE9D8">
      <tr>
        <td><center>
            <table width="80%" border="0" align="center" cellspacing="5">
              <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Realice las correcciones que correspondan</span></td>
              </tr>
              <tr>
                <td width="26%" height="25"><span class="titulomenu">Proveedor</span></td>
                <td colspan="2"><input name="txt_nombre" type="text" id="txt_categoria2" value="<?PHP echo $nombre; ?>" size="53"></td>
              </tr>
             <tr>
                <td width="26%" height="25"><span class="titulomenu">Nit</span></td>
                <td colspan="2"><input name="txt_nit" type="text" id="txt_categoria2" value="<?PHP echo $nit; ?>" size="53"></td>
              </tr>
             <tr>
                <td width="26%" height="25"><span class="titulomenu">Direccion</span></td>
                <td colspan="2"><input name="txt_direccion" type="text" id="txt_categoria2" value="<?PHP echo $direccion; ?>" size="70"></td>
              </tr>
              <tr>
                <td width="26%" height="25"><span class="titulomenu">Telefonos</span></td>
                <td colspan="2"><input name="txt_telefonos" type="text" id="txt_categoria2" value="<?PHP echo $telefonos; ?>" size="53"></td>
              </tr>
             <tr>
                <td width="26%" height="25"><span class="titulomenu">Correo</span></td>
                <td colspan="2"><input name="txt_correo" type="text" id="txt_categoria2" value="<?PHP echo $correo; ?>" size="53"></td>
              </tr>
              <tr>
                <td width="26%" height="25"><span class="titulomenu">Contacto</span></td>
                <td colspan="2"><input name="txt_contacto" type="text" id="txt_categoria2" value="<?PHP echo $contacto; ?>" size="53"></td>
              </tr>
              <tr>
                <td height="25"><input name="bt_actualizar" onClick="Validar(this.form)" type="button" id="bt_actualizar3" value="Actualizar"></td>
                <td width="17%" height="25"><span class="tituloproducto">
                </span></td>
            <td width="57%"><input name="txt_id" type="hidden" id="txt_id2" value="<?PHP echo $no; ?>">                
                 
              </tr>
            </table>
                </center></td>
      </tr>
    </table>
    <div align="left">
<!--       <table width="100%"  border="0">
        <tr>
          <td><div align="center"><span class="titulocategoria">Control de cambios</span></div></td>
        </tr>
        <tr>
          <td><div align="center"><img src="../images/linea.gif" width="100%" height="6"></div></td>
        </tr>
        <tr>
          <td><div align="center"><span class="Estilo1">
            <?PHP  include("abcregistro.php"); ?>
          </span></div></td>
        </tr>
      </table> -->
      <p><span class="Estilo1">
      </span></p>
    </div>
    <!-- /forum rules and admin links -->
  </form>
  <p align="center"><br />
  </p>
</div>
<div align="center"></div>
</body>

</html>
