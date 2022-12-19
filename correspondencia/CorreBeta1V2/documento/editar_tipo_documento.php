<?
session_start();

	session_register('PagNow');
include('../../conectarse.php');
$_SESSION['nivel']=2;

if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}

	if ( $sstipo != 1) // valida que sea un usuario administrador
	{
	 cambiar_ventana('../../mtlogin.php');
	}

	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
 

$codi = $_GET['codigo'];
$para = $_GET['paramas'];
//envia_msg($para);
 

$result2 = mssql_query ("select  id_tipo_doc, documento from tipo_documento where id_tipo_doc = $codi");
		
				while ($row = mssql_fetch_array ($result2)) 
				{
 
 
 
 
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- TemplateParam name="OptionalRegion1" type="boolean" value="true" -->
<link href="HojaEstilo.css" rel="stylesheet" type="text/css">


<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo6 {color: #FF0000}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: larger}
.Estilo22 {font-size: 11px}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo46 {color: #666666; font-weight: bold;}
.Estilo47 {color: #000000}
.Estilo61 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
}
.Estilo64 {
	color: #000000;
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
}

.Estilo28 {font-size: 12px}
.Estilo67 {font-size: 9px}
.Estilo69 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
a:link {
	color: #999999;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
-->
</style>

<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%" >
		<a href="actualiza_documento.php?paramas=<? echo $_GET['paramas']; ?>"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Regresar ]</a>
		</td>
		

	</tr>
</table>

</head>
<script LANGUAGE="JavaScript">
function Validar(form)
{


	if (confirm('�Esta seguro de actualizar estos datos?')){ 
    //  document.form.submit() 
		form.submit();
   		} 

}
</script>


<body>




<p ></p>
<table width="400" border="0" align="center" cellspacing="0">
<tr>
<th colspan="2" scope="col" align="center"><p class="Estilo3"><span class="Estilo1 Estilo8">
</span>Ministerio de Econom�a de Guatemala </p>
  <p ></p></th>

</tr>
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2">Edita Datos Tipo Documento</span></div></td>
  </tr>
  
</table>


		
				  
		  <form name="form1" method="post" action="guardar_tipo_documento.php<? print "?paramas=$para ";?> ">
		  
		  
	        <table width="300" border="0" align="center" cellspacing="0">
              			  

 <tr class="Estilo1" >
    <td class="Estilo22" align="right">Codigo<font color="#FF0000"></font></td>

						
				<td class="Estilo7">
						

						<input name="id_tipo_doc"  disabled="disabled" type="text" id="id_tipo_doc"  maxsize="1"  size="1" onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? print $row['id_tipo_doc'];  ?>">

				</td>
			  </tr>
			  

<tr class="Estilo1">
    <td class="Estilo22" align="right">Grupo<font color="#FF0000"></font></td>

                <th width="467" scope="col">
                  <div align="left">
                    <input name="documento" type="text" class="Estilo7" id="documento" maxsize="50"  size="50"   onKeyUp="javascript:this.value=this.value.toUpperCase();" value="<? print $row['documento'];  ?>">                
                  </div></th>
         
              </tr>
              </tr>
            </table>
			
			
			
			
			
			
			</table>
			
	     

	<div align="center"></div>
<p align="center" class="Estilo1 Estilo6">&nbsp;</p>

			<table border="0" width="100%" id="table3" >
                  <tr>
                    <td>
									
									
							<input type="hidden" name="codigo" value="<? print $_GET['codigo'];?>">
                      <p align="center">
                        <label>
                        <!--input type="submit" name="Submit" value="Enviar"-->
			 <input name="cmd_guardar" type="button"onClick="Validar(this.form)" id="cmd_guardar" value="Actualizar" >    
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        
                    </td>
                  </tr>
            </table>
	        <p>
	          <label></label>
	        </p>
	        <p>&nbsp;</p>
	        <p>&nbsp;            </p>
			
			
			
		
			
		  </form>
		  
		  <?
		  }
		  ?>
		  
		  
		  
		  
</blockquote>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;        </p>
</body>
</html>
