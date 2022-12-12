<?php
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	.tres a {
		font-family:  Arial;
		font-size: 12px;
		font-weight: 900;
		background-color: #93C6F9;
		text-decoration: none;
		color: #000000;
		border-top-width: 3px;
		border-right-width: 3px;
		border-bottom-width: 3px;
		border-left-width: 3px;
		border-top-style: solid;
		border-right-style: solid;
		border-bottom-style: solid;
		border-left-style: solid;
		border-top-color: #E9E9E9;
		border-right-color: #666666;
		border-bottom-color: #666666;
		border-left-color: #E9E9E9;
	}
	.tres a:hover {
		font-family:  Arial;
		font-size: 12px;
		font-weight: 900;
		background-color: #449DF6;
		text-decoration: none;
		color: FFFFFF;
		border-top-width: 3px;
		border-right-width: 3px;
		border-bottom-width: 3px;
		border-left-width: 3px;
		border-top-style: solid;
		border-right-style: solid;
		border-bottom-style: solid;
		border-left-style: solid;
		border-top-color: #999999;
		border-right-color: #E9E9E9;
		border-bottom-color: #E9E9E9;
		border-left-color: #999999;
	}
	</style>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Puede buscar por nombre, apellido, extensión o dependencia"); 
	form.txt_buscar.focus(); 
	return;
  }  
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
form.submit();
}
</script>
<link href="css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {font-size: 9px}
-->
</style>
</head>

<body>
<div align="left">


    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"></td>
              <td width="72%"><div align="center" class="legal1"></div></td>
              
              <td width="15%"><div align="center"><img src="mineco.JPG" width="107" height="113"></div></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
<?PHP
$conn = conectardb($almacen);
$id=$_POST['id'] ;
$ing=$_POST['ing'];
$dep=$_POST['dep'];
$entrada=$_POST['entrada'];
$salida=$_POST['salida'];
$saldo=$_POST['saldo'];
$promedio=$_POST['Promedio'];
$factura=$_POST['costo_factura'];
$mov=$_POST['Mov'];
$ext=$_POST['costo_total'];
$sql ="update tb_kardex  set entrada='$entrada', salida='$salida', saldo='$saldo', costo_promedio='$promedio', costo_factura='$factura',costo_movimiento ='$mov',costo_total='$ext' where codigo_kardex ='$id'";
$result = @mssql_query($sql, $conn);
$row = @mssql_fetch_array($result);
	if($result>0){
?>
				
				<center><h1>Registro Modificado</h1></center>

				     
      <h1>Valores modificados</h1>
	 <table class="tborder" cellpadding="2" cellspacing="1" border="0" width="100%" id="table17">     
      <tr>
        <td colspan="2"></thead>
    <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
	      <?PHP if ($ing >1) { ?>
          <td width="6%"><strong>Entrada</strong></td>
		  <?PHP } else { ?>
		  <td width="6%"><strong>Salida</strong></td>
		  <?PHP } ?>
		  <td width="6%"><strong>Saldo</strong></td>
          <td width="6%"><strong>Promedio</strong></td>
		  <?PHP if ($ing >1) { ?>
          <td width="6%"><strong>Factura</strong></td>
		  <?PHP } else { ?>
		  <?PHP } ?>
          <td width="6%"><strong>Mov</strong></td>
          <td width="6%"><strong>Ext</strong></td>
		  </tr>
		  <tr>
		  <?PHP if ($ing >1) { ?>
		  <td><?PHP echo $entrada;?></td>
		  <?PHP } else { ?>
		  <td><?PHP echo $salida;?></td>
		  <?PHP } ?>
		  <td><?PHP echo $saldo;?></td>
		  <td><?PHP echo $promedio;?></td>
		  <?PHP if ($ing >1){ ?>
		  <td><?PHP echo $factura;?></td>
		  <?PHP } else { ?>
		  <?PHP } ?>
		  <td><?PHP echo $mov;?></td>
		  <td><?PHP echo $ext;?></td>
		  </tr>
		  </table>
		  
		  
					<?php }else{ ?>
				
				<center><h1>Error al Modificar Registro</h1></center>
				
			<?php } ?>		
			
		 <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />    
			<div align="left"></div>
			<div class="tres">
	<a href="javascript:history.go(-1);"> regresar </a><a href="javascript:history.go(-2);"> regresar al Kardex actualizar </a>
	</div>
 
</body>

</html>