<?	
$grupo_id=5;
include("../restringir.php");	
?>
<html>
<head>
  <script LANGUAGE="JavaScript">
  function Validar(form)
  {
    if (form.txt_contrasena.value == "")
    { 
     alert("Ingrese su nueva contraseña"); 
     form.txt_contrasena.focus(); 
     return;
   }
   if (form.txt_verificar.value == "")
   { 
     alert("Debe verificar la contraseña ingresada"); 
     form.txt_contrasena.focus(); 
     return;
   } 
   if ((form.txt_contrasena.value)!=(form.txt_verificar.value))
   { 
     alert("La contraseña ingresada no coincide"); 
     form.txt_contrasena.focus(); 
     return;
   }
   form.submit();
 }
 function Refrescar(form)
 {
    
    window.location="../index.php";
    
   

 }
 </script>
 <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
 

 <meta http-equiv="Content-Type" content="text/html" charset="utf-8_spanish_ci" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

 <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
 <link rel="stylesheet" href="stylecambiopwd/css/style.css">
</head>

<body>

  <div class="pen-title">
    <h1>Cambio de Contrase&ntilde;a</h1>
  </div>
  <!-- Form Module-->
  <div class="module form-module">
    <div class="toggle">
      
    </div>
    <div class="form">
      <h2>Cambiar Password</h2>
      <form name="form" method="post" action="gcambiar_pwd.php">
        <input name="txt_contrasena" type="password" id="txt_contrasena2" size="20"  placeholder="Nueva Contrase&ntilde;a"/>
        <input name="txt_verificar" type="password" id="txt_verificar" size="20"  placeholder="Verificar Contrase&ntilde;a"/>
        <button name="bt_guardar" onClick="Validar(this.form)"  id="bt_guardar3">Cambiar</button>
        <input type="button" class="button" name="bt_cancelar" onClick="Refrescar(this.form)"  id="bt_cancelar3" value="Cancelar">
      </form>

    </div>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script >
(function() {
  var button, buttonStyles, materialIcons;

  materialIcons = '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';

  buttonStyles = ' <link rel="stylesheet" href="stylecambiopwd/css/style.css">';

  button = '<a href="http://www.google.com" class="at-button"><img src="stylecambiopwd/img/Logo.png"  class="logo" /></a>';

  document.body.innerHTML += materialIcons + buttonStyles + button;

}).call(this);
  </script>

  <script src="stylecambiopwd/js/index.js"></script>

</body>











<!--   <form name="form" method="post" action="gcambiar_pwd.php" class="form-horizontal">
    <div class="">
      <table width="100%" border="0" bordercolor="#0000FF">
        <tr> 
          <td><div align="center"><strong>Cambiar contrase&ntilde;a </strong></div></td>
        </tr>
        <tr> 
          <td><center>
            <table width="33%" border="4" cellspacing="5" bordercolor="#CCCCCC">
              <tr>
                <td width="49%" bgcolor="#C9CDED">Nueva contrase&ntilde;a:</td>
                <td width="100%" bgcolor="#99CCFF"><input class="form-control " style="width:100%;" name="txt_contrasena" type="password" id="txt_contrasena2" size="20"></td>
              </tr>
              <tr>
                <td bgcolor="#C9CDED">Verificar contrase&ntilde;a: </td>
                <td bgcolor="#99CCFF"><input class="form-control " style="width:100%;" name="txt_verificar" type="password" id="txt_verificar" size="20"></td>
              </tr>
              <tr> 
                <td bgcolor="#C9CDED">
                  <div align="right">
                    <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar3" value="Guardar">
                  </div></td>
                  <td bgcolor="#99CCFF">
                    <div align="left">
                      <input name="bt_cancelar" onClick="Refrescar(this.form)" type="button" id="bt_cancelar3" value="Cancelar">
                    </div>                  <div align="center">
                  </div></td>
                </tr>
              </table>
            </center></td>
          </tr>
          <tr> 
            <td><div align="center">
            </div></td>
          </tr>
        </table>
      </div>
    </form> -->


</html>
