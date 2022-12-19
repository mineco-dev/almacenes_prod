<!DOCTYPE html>
<script language="JavaScript" type="text/javascript" src="ajax/ajax.js"></script>
<html>
   <head>
      <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript" src="libreriaAjax.js"></script>
        <style type="text/css">
              #capaContenedora{
                border-style: groove double;
                padding: 10px;
                margin: 14px;
                border-color: blue;
                }
        </style>
    </head>
<body>
Este ejemplo enviar&aacute; datos por m&eacute;todo post y los pondr&aacute; la capa de abajo:<br><br>
    <div style="text-align: center;"> <form name="datos_empleados" method="post" onsubmit="FAjax('ajax.php','capaContenedora','campo1='+document.getElementById('campo1').value+'&amp;campo2='+document.getElementById('campo2').value,'POST'); return false" action="#">
        <div style="paddi">Campo1:<input type="text" id="campo1" value="valor1" /></div>
        <div style="text-align=top;">Campo2:<input id="campo2" value="valor2"></div>
        <div><input type="submit" value="enviar"></div>
    </form></div>
    <div id="capaContenedora">Aqui mostrar datos</div>
    <div style="text-align: center;"><a href="http://www.ajaxhispano.com" title="AJAX Hispano el portal ajax en espa&ntilde;ol">AJAX Hispano.com</a></div>
</body>
</html>

