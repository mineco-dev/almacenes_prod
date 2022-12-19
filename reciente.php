<!DOCTYPE html>
<html>
<head>
<link href="helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo5 {color: #FFFFFF}
.Estilo8 {
	color: #000000;
	font-size: x-small;
}
.Estilo9 {font-size: x-large}
.Estilo10 {font-size: x-small}
.Estilo11 {font-size: large}
-->
</style>
</head>

<body>
<table width="100%" border="5" bordercolor="#FFFFFF">
  <tr bgcolor="#69696B">
    <!--td bgcolor="#4CC451"><div align="center"-->
	 <td bgcolor="#000099"><div align="center">
      <p class="Estilo10"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><span class="Estilo11">- ASEGGYS - <br>ANUNCIOS DEL D&Iacute;A</span></font><br>
      </p>
      </div></td>
  </tr>   
<?
	session_start();
	$size_notificado=count($_SESSION['notificado']);
  	require_once('connection/helpdesk.php');				
	$j=1;
	$i=1;
	while ($j<=$size_notificado)
	{	
		$notificacion=$_SESSION["notificado"]["$j"];
		$consulta = "Select a.palabras_clave, b.nombre_dependencia from publicacion a inner join dependencia b on a.codigo_dependencia=b.codigo_dependencia where codigo_archivo=$notificacion";
		$result=mssql_query($consulta);	
		while($row=mssql_fetch_array($result))
		{		
		$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}			
       		echo '<tr class='.$clase.'><td>'.$row["palabras_clave"].'&nbsp;Por&nbsp;'.$row["nombre_dependencia"].'</td></tr>';			
		}
		$j++;
		$i++;
	}
	$close($s);
?>
   
  <tr bgcolor="#666666">
    <!--td bgcolor="#FFCC66"><div align="center"--> 
	    <td bgcolor="#3399FF"><div align="center">  
      <p class="Estilo5"><span class="Estilo8"><font face="Arial, Helvetica, sans-serif">&iexcl;Gracias por utilizar este sistema! </FONT> </span></p>
      </div></td>
  </tr>
</table>
</body>
</html>
