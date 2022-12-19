<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
if (isset($_REQUEST["id"]))
{	
		$rowid=$_REQUEST["id"];
		conectardb($almacen);
		$latabla="cat_producto";
		$campo_condicion="rowid";
		$qry_producto="select * from $latabla where $campo_condicion=$rowid";
		$res_qry_producto=$query($qry_producto);
		while($row=$fetch_array($res_qry_producto))
		{				
			$producto=utf8_encode($row["producto"]);
			$marca=$row["marca"];
			$subcategoria=$row["codigo_subcategoria"];
			$categoria=$row["codigo_categoria"];
			$medida=$row["codigo_medida"];
			
			$estado=$row["codigo_estado"];
			$uso=$row["uso"];					
		}
	
}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_producto.value == "")
  { 
  	alert("Debe ingresar el nombre del producto"); 
	form.txt_producto.focus(); 
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
      <td width="7%"><a href="producto.php"><img src="../images/iconos/ico_izquierda.gif" alt="Volver a pantalla anterior" width="58" height="30" border="0"></a></td>
      <td width="93%"><div align="center"><span class="titulocategoria">Modificaci&oacute;n de Productos</span></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><img src="../images/linea.gif" width="100%" height="6"></div></td>
    </tr>
  </table>
  <form name="form1" method="post" action="geditar_producto.php">
    <table width="90%" border="0" align="center" bordercolor="#ECE9D8">
      <tr>
        <td><center>
            <table width="80%" border="0" align="center" cellspacing="5">
              <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Realice las correcciones que correspondan</span></td>
              </tr>
              <tr>
                <td width="26%" height="25"><span class="titulomenu">Producto</span></td>
                <td colspan="2"><input name="txt_producto" type="text" id="txt_categoria2" value="<?PHP echo $producto; ?>" size="53"></td>
              </tr>
              <tr>
                <td height="25"><span class="titulomenu">Categoria</span></td>
                <td colspan="2"><?PHP
				  	conectardb($almacen);														   			   
					$qry_subcategoria="SELECT * FROM cat_categoria WHERE codigo_categoria='$categoria'";	

					$res_qry_categoria=$query($qry_subcategoria);	
					while($row_categoria=$fetch_array($res_qry_categoria))
					{
						$nombre_categoria=$row_categoria["categoria"];
						
					}
					$qry_subcategoria="SELECT s.codigo_categoria, s.codigo_subcategoria, s.subcategoria FROM cat_subcategoria s
									  inner join tb_categoria_x_bodega c
									  on c.codigo_categoria=s.codigo_categoria and c.codigo_subcategoria=s.codigo_subcategoria
									  WHERE activo=1 and c.codigo_bodega='$bodega' and s.codigo_subcategoria<>'$subcategoria' and s.codigo_categoria='$categoria' ORDER BY subcategoria";																		
					$res_qry_subcategoria=$query($qry_subcategoria);	
					echo('<select name="cbo_categoria">');					
					echo'<option value="0">'.$nombre_subcategoria.'</option>';
					while($row_subcategoria=$fetch_array($res_qry_subcategoria))
					{
						echo'<option value="'.$row_subcategoria["codigo_subcategoria"].'">'.$row_subcategoria["subcategoria"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_subcategoria);
				?></td>
              </tr>
              <tr>
                <td height="25"><span class="titulomenu">Subcategoria</span></td>
                <td height="25" colspan="2"><span class="tituloproducto">
                <?PHP
				  	conectardb($almacen);														   			   
					$qry_subcategoria="SELECT * FROM cat_subcategoria WHERE codigo_subcategoria='$subcategoria' and codigo_categoria='$categoria'";										
					$res_qry_subcategoria=$query($qry_subcategoria);	
					while($row_subcategoria=$fetch_array($res_qry_subcategoria))
					{
						$nombre_subcategoria=$row_subcategoria["subcategoria"];
					}
					$qry_subcategoria="SELECT s.codigo_categoria, s.codigo_subcategoria, s.subcategoria FROM cat_subcategoria s
									  inner join tb_categoria_x_bodega c
									  on c.codigo_categoria=s.codigo_categoria and c.codigo_subcategoria=s.codigo_subcategoria
									  WHERE activo=1 and c.codigo_bodega='$bodega' and s.codigo_subcategoria<>'$subcategoria' and s.codigo_categoria='$categoria' ORDER BY subcategoria";																		
					$res_qry_subcategoria=$query($qry_subcategoria);	
					echo('<select name="cbo_subcategoria">');					
					echo'<option value="0">'.$nombre_subcategoria.'</option>';
					while($row_subcategoria=$fetch_array($res_qry_subcategoria))
					{
						echo'<option value="'.$row_subcategoria["codigo_subcategoria"].'">'.$row_subcategoria["subcategoria"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_subcategoria);
				?>
</span></td>
              </tr>
              <tr>
                <td height="25"><span class="titulomenu">Presentaci&oacute;n</span></td>
                <td height="25"><span class="tituloproducto">
                <?PHP
				  	conectardb($almacen);
					$qry_medida="SELECT * FROM cat_medida WHERE codigo_medida='$medida'";										
					$res_qry_medida=$query($qry_medida);	
					while($row_medida=$fetch_array($res_qry_medida))
					{
						$unidad_medida=$row_medida["unidad_medida"];
					}
					$qry_medida="SELECT * FROM cat_medida WHERE codigo_medida<>'$medida' and activo=1 ORDER BY unidad_medida";										
					$res_qry_medida=$query($qry_medida);	
					echo('<select name="cbo_medida">');					
					echo'<option value="0">'.$unidad_medida.'</option>';
					while($row_medida=$fetch_array($res_qry_medida))
					{
						echo'<option value="'.$row_medida["codigo_medida"].'">'.$row_medida["unidad_medida"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_medida);
				?>
</span></td>
                <td><span class="titulomenu">Marca<span class="tituloproducto">
                  <input name="txt_marca" type="text" id="txt_marca" value="<?PHP echo $marca; ?>" size="26">
                </span></span></td>
              </tr>
             
              <tr>
                <td height="25"><span class="titulomenu">Estado</span></td>
                <td height="25"><span class="tituloproducto">
                <?PHP
				  	conectardb($almacen);
					$qry_estado="SELECT * FROM cat_estadoproducto WHERE codigo_estado=$estado";										
					$res_qry_estado=$query($qry_estado);	
					while($row_estado=$fetch_array($res_qry_estado))
					{
						$nombre_estado=$row_estado["estado_producto"];
					}
					$qry_estado="SELECT * FROM cat_estadoproducto WHERE codigo_estado<>$estado and activo=1 ORDER BY estado_producto";										
					$res_qry_estado=$query($qry_estado);	
					echo('<select name="cbo_estado">');					
					echo'<option value="0">'.$nombre_estado.'</option>';
					while($row_estado=$fetch_array($res_qry_estado))
					{
						echo'<option value="'.$row_estado["codigo_estado"].'">'.$row_estado["estado_producto"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_estado);
				?>
</span></td>
                <td>&nbsp;</td>
              </tr>
              <tr align="center">
                <td height="25" colspan="3"><span class="titulomenu">código de catálogo MINFIN</span>                <textarea name="txt_uso" cols="70" id="txt_uso"><?PHP echo $uso; ?></textarea></td>
              </tr>
              <tr>
                <td height="25"><input name="bt_actualizar" onClick="Validar(this.form)" type="button" id="bt_actualizar3" value="Actualizar"></td>
                <td width="17%" height="25"><span class="tituloproducto">
                </span></td>
                <td width="57%"><input name="txt_id" type="hidden" id="txt_id2" value="<?PHP echo $rowid; ?>">                
                  <input name="txt_subcategoria" type="hidden" id="txt_subcategoria" value="<?PHP echo $subcategoria; ?>">
                <input name="txt_medida" type="hidden" id="txt_medida" value="<?PHP echo $medida; ?>">
                <input name="txt_estado" type="hidden" id="txt_estado" value="<?PHP echo $estado; ?>"></td>
              </tr>
            </table>
        </center></td>
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
            <?PHP  include("abcregistro.php"); ?>
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
