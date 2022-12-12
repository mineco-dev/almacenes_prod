<?PHP
require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">

body {
	
	background-color: #CCCCCC;
}
.style1 {
	font-size: 9;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

</style></head>
<script type="text/javascript" src="select_dependientes_3_niveles3.js"></script>
<body>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table23">
  <TBODY>
  <?PHP
  		$fecha[] = "Enero";	
		$fecha[] = "Febrero";	
		$fecha[] = "Marzo";	
		$fecha[] = "Abril";	
		$fecha[] = "Mayo";	
		$fecha[] = "Junio";	
		$fecha[] = "Julio";	
		$fecha[] = "Agosto";	
		$fecha[] = "Septiembre";	
		$fecha[] = "Octubre";	
		$fecha[] = "Noviembre";	
		$fecha[] = "Diciembre";	

  ?>
    <TR>
      <TD colSpan=3 height=15 style="font-size: 10pt; font-family: verdana,arial"></TD>
    </TR>
    <TR>
      <TD width="1%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
      <TD width="95%" align="center" style="font-size: 10pt; font-family: verdana,arial"><TABLE width="94%" 
      border=2 cellPadding=40 cellSpacing=0 borderColor=#999999 bgcolor="#FFFFFF" id="table24">
          <TBODY>
            <TR>
              <TD width="100%" bgColor=#ffffff style="font-size: 10pt; font-family: verdana,arial" align="center"><TABLE cellSpacing=0 cellPadding=0 width="83%" border=0 id="table25">
                  <TBODY>
                    <TR>
                      <TD width="26%" height="113" style="font-size: 10pt; font-family: verdana,arial"></TD>
                      <TD width="57%" align=right vAlign=bottom style="font-size: 10pt; font-family: verdana,arial"><p align="center" class="style1">Reporte de Kardex Directo </p>                        
                        <p align="center" class="style1">Ingreso y Egreso de Productos  </p></TD>
                      <TD width="17%" align=right vAlign=bottom style="font-size: 10pt; font-family: verdana,arial"><p align="center"><img src="./images/logo_mineco.png" width="100%" style="max-width: 350px;" ></TD>
                    </TR>
                  </TBODY>
                </TABLE>
                  <p style="margin-top: 0; margin-bottom: 0"><BR clear=all>
                  </p>
                  <form name="form1" method="post" action="rep2.php" target="_blank">
                    <table cellspacing=10 cellpadding=0 
                        border=0 id="table27" width="59%">
                      <tr>
                        <td align="center" class="grey2" bordercolor="#0000FF" ><span lang="es-gt"><font color="#FFFFFF">Fecha inicial </font></span></td>
                        <td align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt"><span lang="es-gt">
                          <select name="cboDiai" size="1" id="cboDiai" onkeypress="return handleEnter(this, event)">
                            <?PHP
					   			for ($x=1; $x<=31; $x++)
								{
									if (date("j") == $x)
									{
										echo "<option value='$x' selected>$x</option>";
									}
									else
									{
					   					echo "<option value='$x'>$x</option>";
									}
								}					   	
					   ?>
                        </select>
                        </span></span><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
                        <select name="cboMesi" size="1" id="cboMesi" >
                          <?	
					  			$m = 0;
					   			for ($x=0; $x<=11; $x++)
								{
									$m++;
									if (date("n") == $m)
									{
										echo "<option value='$m' selected>$fecha[$x]</option>";
									}
									else
									{
					   					echo "<option value='$m'>$fecha[$x]</option>";
									}
								}					   	

					  ?>
                        </select>
                        </span></span></span></span><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
                        <select name="cboAnioi" size="1" id="cboAnioi">
                          <?	
					  			$m = date("Y"); //mes
								$mA = date("Y")-1;
								$mA1 = date("Y")-2;
								$mA2 = date("Y")-3;
								$mA3 = date("Y")-5; // mes anterior
								$d = date("j");
								echo "<option value='$m' selected>$m</option>";
								echo "<option value='$mA'>$mA</option>";								
								echo "<option value='$mA1'>$mA1</option>";
								echo "<option value='$mA2'>$mA2</option>";
								echo "<option value='$mA3'>$mA3</option>";
					  ?>
                        </select>
                        </span></span></span></span></span></span></span></span></td>
                      </tr>
                      <tr>
                        <td align="center" class="grey2" bordercolor="#0000FF" ><span lang="es-gt"><font color="#FFFFFF">Fecha final </font></span></td>
                        <td align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt"><span lang="es-gt">
                          <select name="cboDiaf" size="1" id="cboDiaf" onkeypress="return handleEnter(this, event)">
                            <?PHP
					   			for ($x=1; $x<=31; $x++)
								{
									if (date("j") == $x)
									{
										echo "<option value='$x' selected>$x</option>";
									}
									else
									{
					   					echo "<option value='$x'>$x</option>";
									}
								}					   	
					   ?>
                        </select>
                          <span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
                          <select name="cboMesf" size="1" id="cboMesf" >
                            <?	
					  			$m = 0;
					   			for ($x=0; $x<=11; $x++)
								{
									$m++;
									if (date("n") == $m)
									{
										echo "<option value='$m' selected>$fecha[$x]</option>";
									}
									else
									{
					   					echo "<option value='$m'>$fecha[$x]</option>";
									}
								}					   	

					  ?>
                          </select>
                          <span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
                          <select name="cboAniof" size="1" id="cboAniof">
                            <?	
					  			$m = date("Y"); //mes
								$mA = date("Y")-1;
								$mA1 = date("Y")-2;
								$mA2 = date("Y")-3;
								$mA3 = date("Y")-4; // mes anterior
								$d = date("j");
								echo "<option value='$m' selected>$m</option>";
								echo "<option value='$mA'>$mA</option>";								
								echo "<option value='$mA1'>$mA1</option>";
								echo "<option value='$mA2'>$mA2</option>";
								echo "<option value='$mA3'>$mA3</option>";
					  ?>
                          </select>
                        </span></span></span></span></span></span></span></span> </span></span></span></span> </span></span></td>
                      </tr>
                     
                     <tr>
    <td height="22" colspan="6">&nbsp;</td>
  </tr>
  <tr bgcolor="#BBC8E3">
    <td height="22" colspan="6"><span class="defaultfieldname">SELECCIONE CATEGORIA, SUBCATEGORIA Y CODIGO DE PRODUCTO</span></td>
  </tr>
  <tr>
    <td height="22" colspan="6"><?PHP
	 conectardb($almacen);
	 generaSelect(); 
	 ?>      </td>
    </tr>
  <tr>
    <td height="22" colspan="6"><div align="left">
          <select disabled="disabled" name="select2" id="select2">
            <option value="0">Seleccione Subcategoria</option>
          </select>
      </div></td>
  </tr>
  <tr>
    <td height="22" colspan="6"><div align="left">
          <select disabled="disabled" name="select3" id="select3">
            <option value="0">Seleccione producto</option>
          </select>
        </div>
        </td></tr>
  
                     <tr>
                        <td width="175" align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt"></span></td>
                        <td width="314" align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt">
                          <input type="submit" name="Submit" class="boton grey" value="Generar Reporte">
                        </span></td>
                      </tr>
                      
                      <tbody>
                        <?PHP
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */ 
		
?>
                        <tr>
                          <td width="175"></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                  <p style="margin-bottom: 0">&nbsp;</p>
              </TD>
            </TR>
          </TBODY>
      </TABLE></TD>
      <TD width="4%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>
    <TR>
      <TD colSpan=3 style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>
<hr>

</body>
<?PHP

function generaSelect()
{	
		$consulta=mssql_query("select distinct(c.codigo_categoria), c.categoria from cat_subcategoria s
	inner join cat_categoria c
	on c.codigo_categoria = s.codigo_categoria order by c.codigo_categoria");
	echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Seleccione Categoria</option>";
	while($registro=mssql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".utf8_encode($registro[0])."  ---  ".utf8_encode($registro[1]).        "</option>";
	}
	echo "</select>";
}
?>


</html>
