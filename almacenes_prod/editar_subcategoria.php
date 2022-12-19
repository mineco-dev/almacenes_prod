<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
if (isset($_REQUEST["id"])) 
{	
		$rowid=$_REQUEST["id"];
		
		conectardb($almacen);
		$latabla="cat_subcategoria";
		$campo_condicion="rowid";
		
		$qry_categoria="select * from $latabla where $campo_condicion='$rowid'";
		$res_qry_categoria=$query($qry_categoria);
		while($row=$fetch_array($res_qry_categoria))
		{	
			$subcategoria=$row["subcategoria"];
			$categoria=$row["codigo_categoria"];
		}
}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_subcategoria.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba el nombre de la subcategor�a"); 
	form.txt_subcategoria.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_categoria.focus(); 
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
      <td width="7%"><a href="subcategoria.php"><img src="../images/iconos/ico_izquierda.gif" alt="Volver a pantalla anterior" width="58" height="30" border="0"></a></td>
      <td width="93%"><div align="center"><span class="titulocategoria">Modificaci&oacute;n de sub-categor&iacute;a de productos</span></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><img src="../images/linea.gif" width="100%" height="6"></div></td>
    </tr>
  </table>
  <form name="form1" method="post" action="geditar_subcategoria.php">
    <table width="90%" border="0" align="center" bordercolor="#ECE9D8">
      <tr>
        <td><center>
            <table width="80%" border="0" align="center" cellspacing="5">
              <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Realice las correcciones que correspondan</span></td>
              </tr>
              <tr>
                <td width="26%" height="25"><span class="titulomenu">Subcategor&iacute;a</span></td>
                <td colspan="2"><input name="txt_subcategoria" type="text" id="txt_categoria2" value="<?PHP echo $subcategoria; ?>" size="50"></td>
              </tr>
              <tr>
                <td height="25"><span class="titulomenu">Categor&iacute;a</span></td>
                <td width="49%" height="25"><span class="tituloproducto">
                  <?PHP
				  	conectardb($almacen);
					$qry_categoria="SELECT * FROM cat_categoria WHERE codigo_categoria=$categoria";										
					$res_qry_categoria=$query($qry_categoria);	
					while($row_categoria=$fetch_array($res_qry_categoria))
					{
						$nombre_categoria=$row_categoria["categoria"];
					}
					$qry_categoria="SELECT * FROM cat_categoria WHERE codigo_categoria<>$categoria and activo=1 ORDER BY categoria";										
					$res_qry_categoria=$query($qry_categoria);	
					echo('<select name="cbo_categoria">');					
					echo'<option value="0">'.$nombre_categoria.'</option>';
					while($row_categoria=$fetch_array($res_qry_categoria))
					{
						echo'<option value="'.$row_categoria["codigo_categoria"].'">'.$row_categoria["codigo_categoria"].'---'.$row_categoria["categoria"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_categoria);
				?>
                </span></td>
                <td width="25%"><input name="bt_actualizar" onClick="Validar(this.form)" type="button" id="bt_actualizar2" value="Actualizar">
                <input name="txt_id" type="hidden" id="txt_id2" value="<?PHP echo $rowid; ?>">
                <input name="txt_categoria" type="hidden" id="txt_categoria" value="<?PHP echo $categoria; ?>"></td>
              </tr>
            </table>
        </center></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center" class="Estilo1">
        </div></td>
      </tr>
    </table>
    <div align="left">
      <table width="100%"  border="0">
        <tr>
          <td><div align="center"><span class="titulocategoria">Control de cambios</span></div></td>
        </tr>
        <tr>
          <td><div align="center"><img src="../images/linea.gif" width="100%" height="6"></div></td>
        </tr>
        <tr>
          <td><div align="center"><span class="Estilo1">
         
          </span></div></td>
        </tr>
      </table>
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
