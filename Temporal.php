<?PHP
  require('requisiciones/includes/cnn/in_header_2.inc');
  $dbms=new DBMS(conectardb($almacen)); 
  $dbms->bdd=$database_cnn;
  require('requisiciones/includes/funcion.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="requisiciones/HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="requisiciones/estilos/style.css" rel="stylesheet" type="text/css" media="screen" />


      <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>
   


</head>
<body oncontextmenu="return false">
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <div class="container">
<table  class="table table-responsive">
  <tr>
    <td><table width="100%"  class="grey table-responsive">
      <tr>
        <td><strong> Solicitudes al <?PHP print get_formatofecha(date("d")."-".date("m")."-".date("Y")); ?></strong></td> 
      </tr>
    </table>
    <br>
      <table width="95%"  class="table table-resposive">
        <tr>
          <td>
          <?PHP
        $mensaje = "";
            if ($ver==1) $mensaje = "<img src=\"requisiciones/imagenes/temporal.png\" width=\"100\" height=\"100\" > requisiciones Temporales";
            if ($ver==2) $mensaje = "<img src=\"requisiciones/imagenes/led_circle_orange.png\"> Aprobadas";
            if ($ver==3) $mensaje = "<img src=\"requisiciones/imagenes/led_circle_yellow.png\"> Autorizadas";
        if ($ver==4) $mensaje = "<img src=\"requisiciones/imagenes/led_circle_green.png\"> Despachadas";
      if ($ver==5) $mensaje = "<img src=\"requisiciones/imagenes/led_circle_grey.png\"> Anuladas";
      print $mensaje;
      ?>          </td>
        </tr>
        <tr>
          <td>
          <?php
            if ($ver==1) $mtstatus = "3";     
            if ($ver==2) $mtstatus = "4";      
            if ($ver==3) $mtstatus = "5";     
      if ($ver==4) $mtstatus = "6";     
      if ($ver==5) $mtstatus = "0";     
      
       include("requisiciones/temporales.php"); 
          ?>          </td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </td>
  </tr>
</table>
</div>

</form>

</body>
</html>
