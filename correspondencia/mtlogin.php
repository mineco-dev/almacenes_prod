<?
//session_start();	
//$_SESSION['folder'] = "";
//$_SESSION['usr_val'] = "N";
session_unregister('usr_val');
session_register('usr_val');
session_register('nivel');
session_unregister('user');
session_unregister('psswd');
session_unregister('stratado');
session_unregister('sidtratado');
session_unregister('empleado');
session_unregister('codigoUsuario');
session_unregister('pagina');
session_unregister('folder');
session_unregister('iso_registro');

$usr_val = 'N';
$nivel = 1;

//session_start('');
?>

<!DOCTYPE html>
<html>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo4 {color: #FF0000}
.Estilo8 {color: #FF9900; font-family: Georgia, "Times New Roman", Times, serif; }
.Estilo9 {color: #333399; font-size: 36px;}
--> 
</style>

<script type="text/javascript">


var formInUse = false;

function setFocus()
{
 if(!formInUse) {
  document.form1.mtusuario.focus();
 }
}
</script>



<body onload="setFocus()">

<form name="form1" method="post" action="mtconfirma.php">

  <table width="973" border="0" cellspacing="0" bgcolor="" >
    <tr>
      <td width="874" valign="middle">
	  	<table width="108%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <!--td width="387" rowspan="2" valign="top"><img src="logo_mineco.jpg" width="125" height="87"></td-->
		  <td width="387" rowspan="2" valign="top"><img src="logo_mineco.jpg" width="97" height="87"></td>
          <!--td rowspan="2" valign="top" ><img src="imagen/toplog.jpg" height="87"></td-->
          <!--td  width="53" rowspan="2" valign="top"><!--img src="imagen/topmidspace.jpg" width="57" height="87"></td-->
          <td width="25000" background="imagen/topbg.jpg" valign="top"><img src="imagen/topbg.jpg" width="200" height="54"></td>
		  <td rowspan="2" valign="top"><img src="correspondencia.png" width="200" height="87" > </td>
        </tr>
        <tr>
          <td background="imagen/topnavbg.jpg" valign="top" height="1"  >
		  	<table width="166%" border="0"><tr><td></td></tr>
            </table>
		  </td>
        </tr>
      </table>        
      </td>
    </tr>
  </table>
  <p align="center"><span class="Estilo3"><strong><span class="Estilo9">  <BR> </span></strong></span></p>
  <table width="970" border="0">
    <tr>
      <td width="226" rowspan="4"><!--img src="calculadora_web_150.jpg" width="226" height="150"--></td>
      <td colspan="3"><div align="left" class="Estilo3"><span class="Estilo8">Ingreso de usuarios</span> </div></td>
    </tr>
    <tr>
      <td width="93">&nbsp;</td>
      <td width="93"><span class="Estilo3">Usuario</span></td>
      <td width="540"><input type="text" name="mtusuario" >
      <span class="Estilo3">        </span></td>
    </tr>
    <tr>
      <td valign="top" class="Estilo3">&nbsp;</td>
      <td height="30" valign="top" class="Estilo3">password</td>
      <td valign="top"><input type="password" name="mtpassword">
      <span class="Estilo3">      </span></td>
    </tr>
    <tr>
      <td valign="top" class="Estilo3">&nbsp;</td>
      <td height="85" valign="top" class="Estilo3">&nbsp;</td>
      <td valign="top"><p class="Estilo3">
        <input type="submit" name="Submit" value="Ingresar">
        </p>
        <p class="Estilo3"><strong><strong><span class="Estilo4"><? if (isset($mtcadena)) { print $mtcadena; }?></span></strong></strong></p>
      <p class="Estilo3">&nbsp;</p></td>
    </tr>
  </table>
</form>
</body>
</html>
