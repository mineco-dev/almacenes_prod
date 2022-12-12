

<?PHP 
//require("conexion.php");

require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

conectardb($almacen);

$id=$_GET['id']; 
 $dep= $_GET['dep'];
$ing=$_GET['ing'];
$sql = "select entrada, salida, saldo, costo_promedio, costo_factura, costo_movimiento ,costo_total  from tb_kardex where codigo_kardex='$id'";
$result = mssql_query($sql);
$row = mssql_fetch_array($result);








 









	
?>
<html>
<head>
<style type="text/css">
	.tres a {
      		text-shadow: 0px 1px rgba(0, 0, 0, 0.2);
            text-align:center;
            text-decoration: none;
      		font-family: 'Helvetica Neue', Helvetica, sans-serif;
      		display:inline-block;
            color: #FFF;
            background: #7F8C8D;
            padding: 6px 30px;
            white-space: nowrap;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin: 10px 5px;
            -webkit-transition: all 0.2s ease-in-out;
            -ms-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            -o-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
	}

	.boton{
		text-shadow: 0px 1px rgba(0, 0, 0, 0.2);
            text-align:center;
            text-decoration: none;
      		font-family: 'Helvetica Neue', Helvetica, sans-serif;
      		display:inline-block;
            color: #FFF;
            background: #7F8C8D;
            padding: 6px 30px;
            white-space: nowrap;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin: 10px 5px;
            -webkit-transition: all 0.2s ease-in-out;
            -ms-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            -o-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
	}

	.bHover{
		    background: #0090FF;
  border: 1px solid #2980B9;
	}
	.bHover:hover{
		background: #39a0e5;
	}
.grey a{
    background: #0090FF;
  border: 1px solid #2980B9;
}



.grey a:hover{
  background: #39a0e5;
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
              <td width="72%"><div align="center" class="legal1">Modificar Registros </div></td>
              
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
	
    	<form name="modificar_usuario" method="POST" action="mob_assegiz.php">

			
		<table class="tborder" cellpadding="2" cellspacing="1" border="0" width="100%" id="table17">     
      <tr>
        <td colspan="2"></thead>
    <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
			 <?PHP if ($ing>1){ ?>
			 <td width="6%"><strong>Entrada</strong></td>
			 <?PHP } else {?>
			 <td width="6%"><strong>Salida</strong></td>
			 <?PHP } ?>
			 <td width="6%"><strong>Saldo</strong></td>
			  <td width="6%"><strong>Promedio</strong></td>
			  <?PHP if ($ing>1) { ?>
			  <td width="6%"><strong>Factura</strong></td>
			  <?PHP } else { ?>
			  <?PHP } ?>
			  <td width="6%"><strong>Mov</strong></td>
			  <td width="6%"><strong>Ext</strong></td>
			  <td></td>
		  <tr>
				<?PHP if($ing>1){?>
				<h1>Numero de ingreso:  <?PHP	print($ing);?></h1>
				<?PHP } else { ?>
				<h1>Numero de despacho:  <?PHP	print($dep);?></h1>
				<?PHP }?>
					
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="hidden" name="ing" value="<?php echo $ing; ?>">
					<input type="hidden" name="dep" value="<?php echo $dep; ?>">
					<?PHP if ($ing>1) { ?>	
					<td><input type="text" name="entrada" size="20"value="<?php echo $row['entrada']; ?>" ></td>
					<?PHP } else { ?>
					<td><input type="text" name="salida" size="20"value="<?php print $row['salida']; ?>" ></td>
	                <?PHP } ?>
					<td><input type="text" name="saldo" size="20"value="<?php echo $row['saldo']; ?>" ></td>
			        <td><input type="text" name="Promedio" size="20" value="<?php echo $row['costo_promedio']; ?>" /></td>
					<?PHP if ($ing>1) { ?>
				    <td><input type="text" name="costo_factura" size="20" value="<?php echo $row['costo_factura']; ?>" /></td>
					<?PHP } else { ?>
					<input type="hidden" name="costo_factura" value="<?php echo $row['costo_factura']; ?>">
					<?PHP }?>	 
					<td><input type="text" name="Mov" size="20"value="<?php echo $row['costo_movimiento']; ?>" /></td>
					<td><input type="text" name="costo_total" size="20"value="<?php echo $row['costo_total']; ?>" /></td>
			
				<td colspan="2">
				  <input type="submit" class="boton bHover" name="Guardar" value="Guardar" />
		  </tr>
				
	  </table>
    </form>
		<div class="tres grey">
	<a href="javascript:history.go(-1);"> regresar al Kardex actualizar </a>
	</div>	
    <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>

			
            
</body>

</html>