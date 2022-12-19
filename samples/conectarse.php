<?
// Conexion a la base de datos
//include('menu_barra.html');


// muestra un mensaje de error y corta la acción
function error_msg($msg)
{
	echo("<script language='JavaScript'>");
	echo("alert('$msg');");
	echo("history.back();");
	echo("</script>");
	exit(-1);
}

// muestra un mensaje cualquiera
function envia_msg($msg)
{
	echo("<script language='JavaScript'>");
	echo("alert('$msg');");
	echo("</script>");
}

function caracteres_html($texto)
{ 
  return utf8_encode($texto);  
}



// Funcion para abrir una nueva direccion
function cambiar_ventana($window)
{
	print "<script language=\"JavaScript\">";
	print "window.location = '$window' ";
	print "</script>";
}

// Muestra la fecha actual
function muestra_fecha()
{
	$dia=date("l");
	if ($dia=="Monday") $dia="Lunes";
	if ($dia=="Tuesday") $dia="Martes";
	if ($dia=="Wednesday") $dia="Miércoles";
	if ($dia=="Thursday") $dia="Jueves";
	if ($dia=="Friday") $dia="Viernes";
	if ($dia=="Saturday") $dia="Sabado";
	if ($dia=="Sunday") $dia="Domingo";
	
	$dia2=date("d");
	
	$mes=date("F");
	if ($mes=="January") $mes="Enero";
	if ($mes=="February") $mes="Febrero";
	if ($mes=="March") $mes="Marzo";
	if ($mes=="April") $mes="Abril";
	if ($mes=="May") $mes="Mayo";
	if ($mes=="June") $mes="Junio";
	if ($mes=="July") $mes="Julio";
	if ($mes=="August") $mes="Agosto";
	if ($mes=="September") $mes="Septiembre";
	if ($mes=="October") $mes="Octubre";
	if ($mes=="November") $mes="Noviembre";
	if ($mes=="December") $mes="Diciembre";

	$ano=date("Y");

	echo "$dia $dia2 de $mes del $ano";
}

function muestra_fecha2(&$fe)
{
	$dia=date("l");
	if ($dia=="Monday") $dia="Lunes";
	if ($dia=="Tuesday") $dia="Martes";
	if ($dia=="Wednesday") $dia="Miércoles";
	if ($dia=="Thursday") $dia="Jueves";
	if ($dia=="Friday") $dia="Viernes";
	if ($dia=="Saturday") $dia="Sabado";
	if ($dia=="Sunday") $dia="Domingo";
	
	$dia2=date("d");
	
	$mes=date("F");
	if ($mes=="January") $mes="Enero";
	if ($mes=="February") $mes="Febrero";
	if ($mes=="March") $mes="Marzo";
	if ($mes=="April") $mes="Abril";
	if ($mes=="May") $mes="Mayo";
	if ($mes=="June") $mes="Junio";
	if ($mes=="July") $mes="Julio";
	if ($mes=="August") $mes="Agosto";
	if ($mes=="September") $mes="Septiembre";
	if ($mes=="October") $mes="Octubre";
	if ($mes=="November") $mes="Noviembre";
	if ($mes=="December") $mes="Diciembre";

	$ano=date("Y");

	$fe = "$dia $dia2 de $mes del $ano";
}

// Conversion de Fechas
function conversion_fecha(&$fe)
{
	$patterns = array ("/(19|20)(\d{2})-(\d{1,2})-(\d{1,2})/","/^\s*{(\w+)}\s*=/");
	$replace = array ("\\4/\\3/\\1\\2", "$\\1 =");
	$s_fec = preg_replace($patterns, $replace, $fe); 
	$fe = ereg_replace( "00:00:00", " ", $s_fec );
}

function conversion_fecha_inv(&$fe)
{
	$patterns = array ("/(\d{1,2})\/(\d{1,2})\/(19|20)(\d{2})/","/^\s*{(\w+)}\s*=/");
	$replace = array ("\\3\\4-\\2-\\1", "$\\1 =");
	$s_fec = preg_replace($patterns, $replace, $fe); 
	$fe = ereg_replace( "00:00:00", " ", $s_fec );
}
?>