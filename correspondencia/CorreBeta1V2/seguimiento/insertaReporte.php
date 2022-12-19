<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
body {
	background-image: url();
}
.Estilo7 {color: #FFFF00; font-weight: bold; }
.Estilo2 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #FFFFFF;
}
-->
</style>
<? 
				     session_start();
					require ('../conexion.inc');
					$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
					mysql_select_db($BASE_DATOS,$db);
						$SQL = "SELECT docu,titulo from doc where docu = $docu ";
						$result = mysql_query($SQL);
							/* Insercion con exito*/	
						 $encabezado = mysql_fetch_row($result);
				  
?>
<script language="javascript">
function regresar(form)
{
 form.action = "../center.php");
 return true;
}
</script>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table15">
  <TBODY>
    <TR>
      <TD height=15 bgcolor="#000000" style="font-size: 10pt; font-family: verdana,arial"><div align="center"><span class="Estilo1"><strong>Detalle de la Correspondencia </strong></span></div></TD>
    </TR>
    <TR align="center" valign="middle">

      <TD width="72%" align="center" valign="middle" style="font-size: 10pt; font-family: verdana,arial"><TABLE borderColor=#000000 cellSpacing=0 cellPadding=40 width="100%" 
      border=2 id="table16">
          <TBODY>
            <TR>
              <TD width="100%" align="center" bgColor=#ffffff style="font-size: 10pt; font-family: verdana,arial"><div align="center">
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="38%" bgcolor="#000000"><div align="left"><span class="Estilo7">Codigo</span></div></td>
                        <td width="62%" bgcolor="#000000"><div align="right"><span class="Estilo1"><? print $encabezado[0]; ?></span></div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#000000"><div align="left"><span class="Estilo7">Titulo</span></div></td>
                        <td bgcolor="#000000"><div align="right"><span class="Estilo1"><? print $encabezado[1]; ?></span></div></td>
                      </tr>
                  </table>
              </div>              <p align="center">&nbsp;                  </p>
                  <form name="form1" method="post" action="inAcceso.php">
                    <div align="center">
                      <TABLE width="480" 
                        border=0 align=center cellPadding=0 cellSpacing=10 id="table18">
                        <TBODY>
                          <TR>
                            <TD width="74"><span lang="es-gt">Seguimiento</span></TD>
                            <TD>&nbsp;</TD>
                            <TD><span lang="es-gt"> <span lang="es-gt">
                            <textarea name="txtDescripcion" cols="45" rows="5"></textarea>
  </span></span></TD>
                          </TR>
                          <tr>
                            <TD>&nbsp;</TD>
                            <TD>&nbsp;</TD>
                            <TD><span lang="es-gt">
                            </span></TD>
                          </tr>
                          <TR>
                            <TD width="74"></TD>
                          </TR>
                        </TBODY>
                      </TABLE>
                    </div>
                    <p align="center">
                      <input name="docu" type="hidden" id="txtlenguaje" value=<? echo $docu; ?> >                      
                      <input name="btnInsertar" type="submit" id="btnInsertar" value="Insertar">
</p>
                    <p align="center"><a href="../center.php">Regresa  /a> </p>
                    <hr align="center" size="1">
                    <p align="center">&nbsp;</p>
                </form>
                  <p align="center">&nbsp;</p>
                  <div align="center">
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                      <tr bgcolor="#000000">
                        <td width="53"><div align="center"><span class="Estilo1">Codigo</span></div></td>
                        <td width="171"><div align="center"><span class="Estilo1">Usuario</span></div></td>
					    <td width="171"><div align="center"><span class="Estilo1">Descripci&oacute;n</span></div></td>
					    <td width="171"><div align="center"><span class="Estilo1">Fecha</span></div></td>
                      </tr>
					  
<?php
							 
				   $SQL = "select d.dd,e.user,d.descr,concat(right(d.fecha,2),'/',month(d.fecha),'/',year(d.fecha)) FROM detalle_documento d,empleados e WHERE d.idempleado = e.idempleado and d.docu=$docu ";
				   //print $SQL;
				   $result = mysql_query($SQL);
							
					while ($row = mysql_fetch_row($result))
					{								
		                   echo " <tr>";
                      echo " <td>$row[0]</td>";
                      echo " <td>$row[1]</td>";
					  echo " <td>$row[2]</td>";
					  echo " <td>$row[3]</td>";
                      
					  
                    echo " </tr>";
					}
					mysql_close($db);
?>
					  
                  
                    </table>
                  </div>                  <p align="center">&nbsp;</p>
                  <p align="center">&nbsp;</p>
                  <p align="center">&nbsp;</p>
                  <p align="center">&nbsp;</p>
              <p align="center">&nbsp; </p></TD>
            </TR>
          </TBODY>
      </TABLE></TD>
    </TR>
    <TR>
      <TD style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>
<hr>
<p align="center" style="margin-top: 0; margin-bottom: 0"><b> <font face="Verdana" size="2" color="#FFFFFF">7a. Avenida 7-61 Zona 4, Edificio del Registro Mercantil, Tercer Nivel.</font></b></p>
<p align="center" style="margin-top: 0; margin-bottom: 0"><b> <font face="Verdana" size="2" color="#FFFFFF">Tel&eacute;fonos: 2361-0782, 2361-215, 2361-0778, 2361-0772</font></b></p>
<p align="center"><b><font face="Verdana" size="1"><font color="#FFFFFF">Power by: </font><a href="http://www.datatechla.com"><font color="#FFFFFF"> www.datatechla.com</font></a></font></b></p>
</body>
</html>
