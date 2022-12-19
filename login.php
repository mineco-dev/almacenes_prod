
<html>
<head>
	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
  <style type="text/css">
  <!--
  .Estilo1 {color: #000066}
  .EStilo1 input{

  }
  .Estilo2 {font-size: small;
    font-family:Arial, Helvetica, sans-serif; 
  }
  .Estilo3 {
   color: #000000;
   font-weight: bold;
 }
 .Estilo4 {font-size: small}
 .Estilo5 {font-weight: bold; color: #0066CC; font-family: Verdana, Arial, Helvetica, sans-serif;}
 .Estilo6 {font-family: Verdana, Arial, Helvetica, sans-serif; }
 a:link {
   color: #000000;
 }


 /*login*/
 @import url(https://fonts.googleapis.com/css?family=Roboto:300);

 .login-page {
  width: 360px;
  padding: 50% 0 0;
  margin: 0 auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #1883ba;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #41A4D6;
}


.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
/* color de letra de vinculos #006699*/
-->
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<meta http-equiv="Content-Type" content="text/html" charset="utf-8_spanish_ci" />

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body bgcolor="white">

  <table width="155" align="center">
    <tr>
     <td width="212" class="Estilo1 Estilo2">



      <?
//if no cookie is set then display the form
      if(!isset($_SESSION["this_cookie"]))
      {
	// echo '<div align="center" class="login"><form action="validate.php" method="post">';
	// echo 'Usuario  :<br><input type="text" name="username"><br>';
	// echo 'Contrase�a : <input type="password" name="password"><br>';
	// echo '<input type="submit" value="Entrar"></form></div>';


       echo "


       <div class='login-page'>
       <div class='form'>
       <form class='login-form' action='validate.php' method='post'>
       <input type='text' placeholder='Usuario' name='username'/>
       <input type='password' placeholder='password' name='password'/>
       <button>Entrar</button>
       </form>
       </div>
       </div>
       ";

     }
     else
     {
       $nombre=($_SESSION["name"]);
       echo "<div align='center' style='position: fixed; top: 0px; right: 0px;font-size:12px'> Bienvenido: $nombre <br><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i>
<a href='logout.php' target='_parent' >SALIR</a></span><br><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>
<a href='almacenes_prod/cambio_password.php' target='_parent'>Cambiar Contrase�a</a></div>";	
       echo "";
       $dia_numero= date("d");
       $dia_letras = date('D');
     }
     ?>


   </td>
 </tr>
</table>
</body>
</html>