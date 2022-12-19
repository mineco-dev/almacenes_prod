<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
  </head>
  <body>
<?php
    require "class.datepicker.php";
    $db=new datepicker();
    $db->firstDayOfWeek = 1;
    $db->dateFormat = "d/m/Y";
?>

    <input type="text" id="date">
    <input type="button" value="Click to open the date picker" onclick="<?=$db->show("date")?>">

  </body>
</html>
