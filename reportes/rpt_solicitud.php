<?PHP

require('../includes/cnn/inc_header.inc');
$dbms=new DBMS(conectardb($uipopera));
$dbms->bdd=$database_cnn;
require('../includes/funciones.php');

function get_cantidad($ids,$ta)
{
	global $dbms;
	$dbms->sql="select count(*) canti
				 from
					tbl_solicitud s
				 where
					month(s.fechahora) = $ids and
					year(s.fechahora) = year(getdate()) and
					s.idstatus <> 6";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields["canti"];
}

function get_texto($f1,$f2,$ta)
{
	$texto = 'Enero;'.get_cantidad(1,$ta).'\n'.
			'Febrero;'.get_cantidad(2,$ta).'\n'.
			'Marzo;'.get_cantidad(3,$ta).'\n'.
			'Abril;'.get_cantidad(4,$ta).'\n'.
			'Mayo;'.get_cantidad(5,$ta).'\n'.
			'Junio;'.get_cantidad(6,$ta).'\n'.
			'Julio;'.get_cantidad(7,$ta).'\n'.
			'Agosto;'.get_cantidad(8,$ta).'\n'.
			'Septiembre;'.get_cantidad(9,$ta).'\n'.
			'Octubre;'.get_cantidad(10,$ta).'\n'.
			'Noviembre;'.get_cantidad(11,$ta).'\n'.
			'Diciembre;'.get_cantidad(12,$ta);
	return $texto;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />

</head>

<body>
<table width="98%" border="0" align="left" class="panel">
  <tr>
    <td><div align="left"><?PHP print "Del 01/01/".date("Y",time())." al 31/12/".date("Y",time());?></div></td>
  </tr>
</table>
<?PHP
if ($estado ==0)
		$ta = " events ";
	else
		$ta = " cancelevents ";
?>
<div align="center">
  <!-- saved from url=(0013)about:internet -->
  <!-- amcolumn script-->
    <script type='text/javascript' src='amcolumn/swfobject.js'></script>
</div>
<div id='flashcontent'>
	<div align="center"><strong>You need to upgrade your Flash Player</strong>
      </div>
</div>

<script type='text/javascript'>
		// <![CDATA[
		var so = new SWFObject('amcolumn/amcolumn.swf', 'amcolumn', '98%', '380', '0', '#FFFFFF,#B0DE09');
		so.addVariable('path', 'amcolumn/');
		so.addVariable('chart_data', '<?PHP echo ''.get_texto($date1,$date2,$ta).''; ?>');
		so.addVariable('chart_settings', '<settings><data_type>csv</data_type><depth>10</depth><angle>20</angle><column><spacing>1</spacing><grow_time>2</grow_time><grow_effect>strong</grow_effect><alpha>70</alpha><tick_length>40</tick_length><border_color>#FF9E01,#FFFFFF</border_color><border_alpha>5</border_alpha><balloon_text><![CDATA[{series}: {value}]]></balloon_text><gradient>vertical</gradient></column><background><color>#FF9E01,#FFFFFF</color><border_color>#FF9E01,#FFFFFF</border_color><border_alpha>5</border_alpha></background><axes><category><width>10</width></category><value><width>10</width></value><tick_length></tick_length><logarithmic></logarithmic></axes><legend><enabled>false</enabled></legend><labels><label><x>0</x><y>25</y><align>center</align><text><![CDATA[<b>TOTAL DE SOLICITUDES RECIBIDAS POR MES</b>]]></text></label></labels><graphs><graph><gradient_fill_colors>#FFFFFF,#B0DE09</gradient_fill_colors><color>#FCD202</color></graph></graphs></settings>')
		so.addVariable('preloader_color', '#999999');
		so.write('flashcontent');
		// ]]>
	</script>
<br>
</body>
</html>
