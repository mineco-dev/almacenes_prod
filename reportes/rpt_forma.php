<?PHP
require('../includes/cnn/inc_header.inc');
$dbms=new DBMS(conectardb($uipopera));
$dbms->bdd=$database_cnn;
require('../includes/funciones.php');

function get_forma($query)
{
	$col[0] = "#FF0F00";
	$col[1] = "#FF6600";
	$col[2] = "#FF9E01";
	$col[3] = "#FCD202";
	$col[3] = "#F8FF01";
	$col[4] = "#B0DE09";
	$col[5] = "#04D215";
	
	global $dbms;
	$dbms->sql=$query;
	$dbms->Query();
	$texto = "<pie>";
	$cnt = 0;
	while ($Fields=$dbms->MoveNext())
	{
		$texto = $texto."<slice title='".$Fields["nombre"]."' color='$col[$cnt]'>".$Fields["canti"]."</slice>";
		$cnt ++;
	}
	$texto = $texto."</pie>";
	return $texto;
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<!-- saved from url=(0013)about:internet -->
<!-- ampie script-->
<?PHP
$query1 = "select ts.nombre, count(*) canti
				 from
					tbl_solicitud s, tbl_tiposolicitud ts
				 where
				 	s.idtiposolicitud = ts.idtiposolicitud and 
					s.idstatus <> 6
				group by ts.nombre
				order by canti";
?>
<script type="text/javascript" src="ampie/swfobject.js"></script>
	<div id="flashcontent">
		<strong>Necesita actualizar el flash player</strong>
	</div>

	<script type="text/javascript">
		// <![CDATA[		
		var so = new SWFObject("ampie/ampie.swf", "ampie", "620", "340", "8", "#FFFFFF");
		so.addVariable("path", "ampie/");
		so.addVariable("settings_file", encodeURIComponent("ampie_settings2.xml"));
		so.addVariable("chart_data", encodeURIComponent("<?PHP print get_forma($query1);?>"));
		so.write("flashcontent");
		// ]]>
	</script>
<!-- end of ampie script -->
</body>
</html>
