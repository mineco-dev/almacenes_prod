<?
/*session_start();

	// Comprueba que hubo inicio de sesion
	
	if ($_SESSION['Bandera'] != "SI")
	{
		header("Location: test.php");
		exit;
	}*/
require('ff/fpdf.php');
include("conectarse.php");


$link=conectarse("mp");

/*   $q = $_GET['q'];
   $fe = $_GET['fe'];
   $fi = $_GET['fi'];
   $ff = $_GET['ff'];*/

function muestra_fecha3(&$fe)
{
//	$dia=date("l");
  if ( (!isset($_POST['fecha_final'])) || ($_POST['fecha_final'] == '') )
   {
//	$dia=date("l");
	$dia=date("l");
	if ($dia=="Monday") $dia="LUNES";
	if ($dia=="Tuesday") $dia="MARTES";
	if ($dia=="Wednesday") $dia="MIERCOLES";
	if ($dia=="Thursday") $dia="JUEVES";
	if ($dia=="Friday") $dia="VIERNES";
	if ($dia=="Saturday") $dia="SABADO";
	if ($dia=="Sunday") $dia="DOMINGO";
   }
  else
   {
   $dia='';
   }
	
//	$dia2=date("d");
	$dia2=substr($fe,0,2);
	
//	$mes=date("F");	
	$mes=substr($fe,3,2);
/*	if ($mes=="January") $mes="ENERO";
	if ($mes=="February") $mes="FEBRERO";
	if ($mes=="March") $mes="MARZO";
	if ($mes=="April") $mes="ABRIL";
	if ($mes=="May") $mes="MAYO";
	if ($mes=="June") $mes="JUNIO";
	if ($mes=="July") $mes="JULIO";
	if ($mes=="August") $mes="AGOSTO";
	if ($mes=="September") $mes="SEPTIEMBRE";
	if ($mes=="October") $mes="OCTUBRE";
	if ($mes=="November") $mes="NOVIEMBRE";
	if ($mes=="December") $mes="DICIEMBRE";*/
	
	if ($mes=="01") $mes="ENERO";
	if ($mes=="02") $mes="FEBRERO";
	if ($mes=="03") $mes="MARZO";
	if ($mes=="04") $mes="ABRIL";
	if ($mes=="05") $mes="MAYO";
	if ($mes=="06") $mes="JUNIO";
	if ($mes=="07") $mes="JULIO";
	if ($mes=="08") $mes="AGOSTO";
	if ($mes=="09") $mes="SEPTIEMBRE";
	if ($mes=="10") $mes="OCTUBRE";
	if ($mes=="11") $mes="NOVIEMBRE";
	if ($mes=="12") $mes="DICIEMBRE";

//	$ano=date("Y");
	$ano=substr($fe,6,4);

	$fe = "$dia $dia2 DE $mes DEL $ano";
}


function muestra_fechas2(&$fe)
{
	$dia=date("l",$fe);
//	$dia=substr($fe,9,2);
	if ($dia=="Monday") $dia="LUNES";
	if ($dia=="Tuesday") $dia="MARTES";
	if ($dia=="Wednesday") $dia="MIËRCOLES";
	if ($dia=="Thursday") $dia="JUEVES";
	if ($dia=="Friday") $dia="VIERNES";
	if ($dia=="Saturday") $dia="SABADO";
	if ($dia=="Sunday") $dia="DOMINGO";
	
	$dia2=substr($fe,8,2);
	
	$mes=substr($fe,5,2);
/*	if ($mes=="January") $mes="ENERO";
	if ($mes=="February") $mes="FEBRERO";
	if ($mes=="March") $mes="MARZO";
	if ($mes=="April") $mes="ABRIL";
	if ($mes=="May") $mes="MAYO";
	if ($mes=="June") $mes="JUNIO";
	if ($mes=="July") $mes="JULIO";
	if ($mes=="August") $mes="AGOSTO";
	if ($mes=="September") $mes="SEPTIEMBRE";
	if ($mes=="October") $mes="OCTUBRE";
	if ($mes=="November") $mes="NOVIEMBRE";
	if ($mes=="December") $mes="DICIEMBRE";*/
	
	if ($mes=="01") $mes="ENERO";
	if ($mes=="02") $mes="FEBRERO";
	if ($mes=="03") $mes="MARZO";
	if ($mes=="04") $mes="ABRIL";
	if ($mes=="05") $mes="MAYO";
	if ($mes=="06") $mes="JUNIO";
	if ($mes=="07") $mes="JULIO";
	if ($mes=="08") $mes="AGOSTO";
	if ($mes=="09") $mes="SEPTIEMBRE";
	if ($mes=="10") $mes="OCTUBRE";
	if ($mes=="11") $mes="NOVIEMBRE";
	if ($mes=="12") $mes="DICIEMBRE";
	$ano=substr($fe,0,4);

//	$fe = "$dia $dia2 DE $mes DEL $ano";
	$fe = "$dia2 DE $mes DEL $ano";
}
   
	
 function fecha_std_inv($fecha_std)
  {
	$fechard= substr($fecha_std,8,2);
//		echo $fechard."<br>";
	$fecharm= substr($fecha_std,5,2);
//		echo $fecharm."<br>";
	$fechara= substr($fecha_std,0,4);
//		echo $fechara."<br>";
	$hora = substr($fecha_std,12,10);
//		echo $hora."<br>";
	$fechar_in = $fechard."/".$fecharm."/".$fechara." ".$hora;
//		echo "-$fechar_in-";
    return $fechar_in;
  }

 function fecha_std($fecha_std)
  {
	$fechard= substr($fecha_std,0,2);
//		echo $fechard."<br>";
	$fecharm= substr($fecha_std,3,2);
//		echo $fecharm."<br>";
	$fechara= substr($fecha_std,6,4);
//		echo $fechara."<br>";
	$hora = substr($fecha_std,10,10);
//		echo $hora."<br>";
	$fechar_in = $fechara."/".$fecharm."/".$fechard." ".$hora;
//		echo "-$fechar_in-";
    return $fechar_in;
  }

/*  $querysede = "select id_sede from municipio where defa = 1";
  $resede = mysql_query($querysede);
  while ($row = mysql_fetch_array($resede))
   {
    $id_sede_caso = $row['id_sede'];
   }					
  if ($id_sede_caso == null)				   
   {
	error_msg('El Municipio asignado como Default no tiene una Sede asignada, \n por favor vaya al catalogo de Sedes, Generela y asignela al Municipio');
   }*/
include("defa_sede.php");



class PDF extends FPDF
 {
  //Cabecera de página
  function Header()
   {
/*    $q = $_GET['q'];
   $fe = $_GET['fe'];
   $fi = $_GET['fi'];
   $ff = $_GET['ff'];*/
   //Logo
//	$this->Image('images/iconos/escudo.jpg',10,8,10);
	//Arial bold 15
	$this->SetFont('Arial','B',10);
	//Movernos a la derecha
//	$this->Cell(80);
	$this->Cell(1);
	//Título
	//Salto de línea
//	$this->Ln(10);
	$this->Cell(0,3,'MINISTERIO PUBLICO',0,1,'C');
	$this->Cell(0,3,'UNIDAD DE ESPECIALISTAS EN ESCENA DEL CRIMEN',0,1,'C');
	$this->Cell(0,3,'DIRECCION DE INVESTIGACIONES CRIMINALISTICAS',0,1,'C');
	$this->SetFont('Arial','',10);	
	$this->Ln(10);	 
	$selef="select a.fiscalia, c.agencia, b.expe_fisc, b.anio, b.no_expediente from fiscalias a, agencias c, caso b where b.id_caso = '$_GET[num]' and b.id_fiscalia = a.id_fiscalia and c.id_agencia = b.id_agencia";
	$result=mysql_query($selef);
	while ($row = mysql_fetch_array($result))
	 {
	  $fiscalia = $row['fiscalia'];
	  $agencia = $row['agencia'];	  
	  $ref_mp = $row['expe_fisc'].'-'.$row['anio'].'-'.$row['no_expediente'];	  	  
	 }
	 mysql_free_result();

   if ( (!isset($_POST['fecha_final'])) || ($_POST['fecha_final'] == '')  )
    {
  	 $hoy = date('d/m/Y');
//	$this->Cell(0,4,'No existe el post, '.$hoy,0,1,'R');		
	}
   else
    {
     $hoy = $_POST['fecha_final'];
//     $hoy = fecha_std_inv($_POST['fecha_final']);
//	$this->Cell(0,4,'Si existe el Post, '.$hoy,0,1,'R');	
	}
	//	$hoy = date('d/m/Y');
	$hhoy = muestra_fecha3($hoy);
	include("defa_sede.php");
/*	$this->Cell(0,4,'GUATEMALA, '.$_POST['fecha_final'],0,1,'R');	
	$this->Cell(0,4,'GUATEMALA, '.$hoy,0,1,'R');		*/
//	$this->Cell(0,4,'GUATEMALA, '.$hoy.' '.$hhoy,0,1,'R');	
	$this->Cell(0,4,$muni.', '.$hoy.' '.$hhoy,0,1,'R');	
	$this->Cell(0,4,'INFORME No. '.$_GET['num'],0,1,'R');		
	$this->Cell(0,4,'REFERENCIA '.$ref_mp,0,1,'R');			
	$this->Ln(10);	 	
	
//	$this->Cell(0,3,'BOLETA DE RECEPCION PARA ALMACENAMIENTO FISICO',0,1,'C');
//	$this->Cell(0,3,$mes_act.' '.$ac,0,1,'C');
//	 pdf_show($p, "DEL ".fecha_std_inv($fi)." AL ".fecha_std_inv($ff));
/*	if ($fe != 0 )
	 {
		$this->Cell(0,3,'DEL '.fecha_std_inv($fi).' AL '.fecha_std_inv($ff),0,1,'C');		 	 
//	  pdf_show($p, "DEL ".fecha_std_inv($fi)." AL ".fecha_std_inv($ff));
	 }
	else
	 {
	 	$this->Cell(0,3,'GENERAL',0,1,'C');		 
	 }*/
	$this->SetFont('Arial','',10);
   }

  //Pie de página
  function Footer()
   {
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',10);
	//Número de página
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'L');
//	$this->Cell(0,10,'Generado el '.date('d/m/Y H:i'),0,0,'R');
	$hoy = date('d/m/Y');
	$hhoy = muestra_fecha2($hoy);
//	$this->Cell(0,10,'Generado: '.$hoy.' '.$hhoy,0,0,'R');
   }
 } // termina class pdf

if (empty($_POST['puesto']))
	 { 
	  $puesto = "AUXILIAR FISCAL";			
	 }
	else
	 {
	  $puesto = $_POST['puesto'];			
	 }
if ( (isset($_POST['inf_final'])) && ( $_POST['inf_final'] == 1) )
 {
  if  ( (isset($_POST['fecha_final'])) && ($_POST['fecha_final'] == "") )
   {
    $queryup = "update detalle_caso set status = 2, id_saludo = '$_POST[titulo]', dirigido_a = '$_POST[dirigido]', personal_eec = '$_POST[personal]', actividades = '$_POST[actividades]', fecha_informe = now(), puesto_dirigido = '$puesto' where id_caso = '$_GET[num]' and nip = '$_POST[nip_us]'";
   }
  else
   {
    $fechainf = fecha_std($_POST['fecha_final']);
    $queryup = "update detalle_caso set status = 2, id_saludo = '$_POST[titulo]', dirigido_a = '$_POST[dirigido]', personal_eec = '$_POST[personal]', actividades = '$_POST[actividades]', fecha_informe = '$fechainf', puesto_dirigido = '$puesto' where id_caso = '$_GET[num]' and nip = '$_POST[nip_us]'";
   }
  $resup = mysql_query($queryup);
  mysql_fetch_array($resup);
 }
else
 {
  $queryup = "update detalle_caso set id_saludo = '$_POST[titulo]', dirigido_a = '$_POST[dirigido]', personal_eec = '$_POST[personal]', actividades = '$_POST[actividades]', fecha_informe = now(), puesto_dirigido = '$puesto' where id_caso = '$_GET[num]' and nip = '$_POST[nip_us]' ";
  $resup = mysql_query($queryup);
  mysql_fetch_array($resup);
 } 
 
if ( (isset($_POST['medicof'])) && ($_POST['medicof'] == 1) )
 {
  $queryper = "update persona set chkmedicof = '$_POST[medicof]' where id_caso = '$_GET[num]'";
  $resuper = mysql_query($queryper);
  mysql_fetch_array($resuper);
 }
else
 {
  $queryper = "update persona set chkmedicof = 0 where id_caso = '$_GET[num]'";
  $resuper = mysql_query($queryper);
  mysql_fetch_array($resuper);
 }
//Creación del objeto de la clase heredada
$pdf=new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->AliasNbPages();
$margen = 1;
	$selef="select a.fiscalia, c.agencia, b.expe_fisc, b.anio, b.no_expediente from fiscalias a, agencias c, caso b where b.id_caso = '$_GET[num]' and b.id_fiscalia = a.id_fiscalia and c.id_agencia = b.id_agencia";
	$result=mysql_query($selef);
	while ($row = mysql_fetch_array($result))
	 {
	  $fiscalia = $row['fiscalia'];
	  $agencia = $row['agencia'];	  
	  $ref_mp = $row['expe_fisc'].'-'.$row['anio'].'-'.$row['no_expediente'];	  	  
	 }
	 mysql_free_result();
	$selsal = "select saludo from saludo where id_saludo = ".$_POST['titulo'];
	$resal = mysql_query($selsal);
	while ($row = mysql_fetch_array($resal))
	 {
	  if ($margen = 1) { $pdf->Cell(5); }
	  $pdf->Cell(0,4,$row['saludo'],0,1,'L');		  
	 }
    if ($margen = 1) { $pdf->Cell(5); }	 
	$pdf->Cell(0,4,$_POST['dirigido'],0,1,'L');
	if (empty($_POST['puesto']))
	 { 
 	  if ($margen = 1) { $pdf->Cell(5); }
	  $pdf->Cell(0,4,"AUXILIAR FISCAL",0,1,'L');			
	 }
	else
	 {
 	  if ($margen = 1) { $pdf->Cell(5); }
	  $pdf->Cell(0,4,$_POST['puesto'],0,1,'L');			
	 }
//	$pdf->Cell(0,4,$agencia,0,1,'L');		
    if ($margen = 1) { $pdf->Cell(5); }
	$pdf->MultiCell(100,4,$fiscalia.' - '.$agencia,0,1,'L');		
    if ($margen = 1) { $pdf->Cell(5); }
	$pdf->Cell(0,4,'MINISTERIO PÚBLICO',0,1,'L');		
	$pdf->Ln(2);
/*    if ($margen = 1) { $pdf->Cell(5); }	
	$pdf->Cell(0,4,"CORDIAL SALUDO:",0,1,'L');		*/
//	$pdf->Ln(4);
//	$pdf->Cell(0,4, $contenido,0,0,'C');	
    if ($margen = 1) { $pdf->Cell(5); }
	$pdf->Cell(0,8,"DE MANERA ATENTA ME DIRIJO A USTED CON EL PROPÓSITO DE INFORMARLE LO SIGUIENTE:",0,1,'L');		
	$sele_per = "SELECT a.id_caso, a.fecha_suceso, a.direccion_hecho, a.zona, a.id_colonia, b.colonia, c.municipio, d.departamento, 
				e.victima, e.edad, e.detalle_edad, e.sexo, e.id_ocupacion, o.ocupacion, e.id_nacionalidad, n.nacionalidad, e.id_tipo_docto, e.id_persona,
				t.tipo_docto_identificacion, e.reg_docto, r.orden_cedula, e.ord_docto, e.nombre_identifica, e.caracteristicas_fisicas, e.vestuario,
				e.cicatrices, e.tatuajes, e.valores, e.lesiones, cm.complexion, c_tez.colortez c_tez, c_cab.color c_cab, c_oj.color c_oj, cab.cabello, e.estatura,
				causa.causa_muerte, g.grupo, e.nombre_padre, e.nombre_madre, e.datos_obtenidos, e.en_vehiculo, e.informacion, e.chkinfo, e.residencia, e.estado_civil, 
				a.fecha_aviso, a.direccion_procedencia, e.chkfeto, e.chkmedicof, a.fecha_fin, a.aviso
			 	FROM municipio c, departamento d, tipo_docto_identificacion t, complexion cm, colortez c_tez, color c_cab, color c_oj, 
				cabello cab, causa_muerte causa, grupo g,
				caso a left outer join colonia as b on (b.id_colonia = a.id_colonia),
				persona e left outer join ocupacion as o on (e.id_ocupacion = o.id_ocupacion) 
				left outer join nacionalidad as n on (e.id_nacionalidad = n.id_nacionalidad) 
				left outer join departamento as r on (e.reg_docto = r.id_departamento)
				where a.id_municipio = c.id_municipio and c.id_departamento = d.id_departamento and a.id_caso = '$_GET[num]' and e.id_caso = a.id_caso 
				and e.id_tipo_docto = t.id_tipo_docto_identificacion and e.id_complexion = cm.id_complexion and e.id_colortez = c_tez.id_colortez and e.id_color_cabello = c_cab.id_color 
				and e.id_color_ojos = c_oj.id_color and e.id_cabello = cab.id_cabello and e.id_causa_muerte = causa.id_causa_muerte and a.id_grupo = g.id_grupo
				order by id_persona";

/*				 FROM caso a, colonia b, municipio c, departamento d, persona e, ocupacion o, nacionalidad n, tipo_docto_identificacion t, departamento r
				 where a.id_municipio = c.id_municipio and c.id_departamento = d.id_departamento and a.id_caso = '$_GET[num]' and e.id_caso = a.id_caso and a.id_colonia = b.id_colonia and e.id_ocupacion = o.id_ocupacion and e.id_nacionalidad = n.id_nacionalidad and e.id_tipo_docto = t.id_tipo_docto_identificacion and e.reg_docto = r.id_departamento
				 order by id_caso";*/
//				echo $sele_per;
//	$pdf->MultiCell(0,4,"$sele_per",0,1,'L');	  
  	$result = mysql_query($sele_per);
	if (mysql_num_rows($result) > 1 )
	 {
	  $el_los = 'DONDE SE ENCONTRABAN LOS CADÁVERES DE:';
	 }
	else
	 {
	  $el_los = 'DONDE SE ENCONTRABA EL CADÁVER DE:';
	 }
	$a=0;
	while ($row = mysql_fetch_array($result))
	 {
	 $a++;
	  $fecha_suceso = $row['fecha_suceso'];
	  $dir_hecho = $row['direccion_hecho'];
	  $zona = $row['zona'];
	  $id_col = $row['id_colonia'];	  
	  $colonia = $row['colonia'];
	  $municipio = $row['municipio'];
	  $departamento = $row['departamento'];
	  $victima = $row['victima'];
	  $edad = $row['edad'];
	  $det_edad = $row['detalle_edad'];	  
	  $sexo = $row['sexo'];
	  $id_ocupacion = $row['id_ocupacion'];
	  $ocupacion = $row['ocupacion'];	  
	  $id_nacionalidad = $row['id_nacionalidad'];
	  $nacionalidad = $row['nacionalidad'];	  
	  $id_tipo_docto = $row['id_tipo_docto'];
	  $tipo_docto_id = $row['tipo_docto_identificacion'];
	  $reg_docto = $row['reg_docto'];
	  $orden_cedula = $row['orden_cedula'];
	  $ord_docto = $row['ord_docto'];
	  $identifico =	$row['nombre_identifica'];
	  $grupo = $row['grupo'];
	  $nom_padre = $row['nombre_padre'];
	  $nom_madre = $row['nombre_madre'];	  
  	  $datos = $row['datos_obtenidos'];
	  $envehiculo = $row['en_vehiculo'];
	  $info = $row['informacion'];
	  $dir_procedencia = $row['direccion_procedencia'];
	  $residencia = $row['residencia'];
	  $estado_civil = $row['estado_civil'];
	  $fecha_aviso = $row['fecha_aviso'];	  
	  $chk_bebe = $row['chkfeto'];
	  $chk_medicof = $row['chkmedicof'];
	  $fecha_fin = $row['fecha_fin'];
	  $hora_fin = substr($row['fecha_fin'],11,10);
	  $aviso = $row['aviso'];
  	  $idpertemp = $row['id_persona'];	  


//	  $fecha_s = date('d/m/Y');
	  $fecha_ss = muestra_fechas2($fecha_suceso);
	  $fecha_av = muestra_fechas2($fecha_aviso);
	  $fecha_f = muestra_fechas2($fecha_fin);
	  
	  if ($edad > 0) // para mostrar la edad si es mayor que 0
	   { 
	     if ($id_tipo_docto == 1)
		  {
		   $ed_an = ' APROXIMADAMENTE '.$edad.' AÑOS';  
		  }
		 else
		  {
		   $ed_an = $edad.' AÑOS';  
		  }
	     if ($det_edad != null )  // para mostrar detalle de edad si existe
		  { 
		   $ed_an = $ed_an." ".$det_edad; 
		  }
	   }
      else { if ($det_edad != null ) { $ed_an = $det_edad;} } // si la edad es 0 entonces mostrar detalle de edad 
	  if ($zona != 0)  { $zonas = ', ZONA '.$zona.', '; } else { $zonas = ''; } //para mostrar la zona si existe
	  if ($id_col == 1)	   { $col = ''; } else	{ $col = 'COLONIA '.$colonia.', '; } // para mostrar la colonia si existe
	  if ($sexo == 'M')	  { $sex = "MASCULINO"; } else { if ($sexo == 'F')	 { $sex = "FEMENINO"; } else { $sex = "DESCONOCIDO"; } } // para mostrar el sexo de la victima
	  if ($id_tipo_docto == 1) // si la victima tiene documento de identfiicacion
//  	   { $tip_doc = ' quien no portaba documento de identificación'; } 
	   { $tip_doc = ' QUIEN NO PORTABA DOCUMENTO DE IDENTIFICACIÓN '; } 
	  else  // si no tiene documento de identificacion
	   { 
	    if ($id_tipo_docto == 2)  // si el documento es cedula
		 { $tip_doc = ' A QUIEN SE PUDO IDENTIFICAR CON DOCUMENTO '.$tipo_docto_id.' No. DE ORDEN '. $orden_cedula.' Y REGISTRO '.$ord_docto; }
		else		 // si es otro documento
		 { $tip_doc = ' A QUIEN SE PUDO IDENTIFICAR CON DOCUMENTO '.$tipo_docto_id.', '.$ord_docto; }		 
	   }
	  if ($identifico != null) { $nom_ident = ' Y FUE IDENTIFICADO POR '.$identifico."."; } else { $nom_ident = ''; }	  // si fue identificado por alguien
	  
	  if ($datos != null) { $datos_de = ' DATOS OBTENIDOS DE '.$datos; } else { $datos_de = ''; }
	  if ($nom_padre != null ) // si tiene datos del nombre de padre 
	   {
		if ($nom_madre != null) // si tiene datos del nombre de madre 
		 {
//   		  $padres = ' HIJO(A) DE '.$nom_padre.' Y '.$nom_madre.", ".$datos_de;
   		  $padres = ' HIJO(A) DE '.$nom_padre.' Y '.$nom_madre.",";
		 }
		else // si no tiene datos del nombre de la madre
		 {
//   		  $padres = ' HIJO(A) DE '.$nom_padre.", ".$datos_de;
   		  $padres = ' HIJO(A) DE '.$nom_padre.", ";		  
		 }
	   }
	  else // si no tiene datos del nombre de padre
	   {
  		if ($nom_madre != null) // si tiene datos el nombre de madre
		 {
//		  $padres = ' HIJO(A) DE '.$nom_madre.", ".$datos_de;
		  $padres = ' HIJO(A) DE '.$nom_madre.", ";		  
		 }
		else // no tiene datos del padre ni de madre
		 {		
	      $padres = '';
		 }
	   }
	   
	  if ($envehiculo != null)
	   {
	    $enveh = ' EL CADAVER SE ENCONTRO '.$envehiculo;
	   }
	  else
	   {
	    $enveh = '';
	   }
	   
	  if ($dir_procedencia != '')
	   {
	    $dir_proce = 'VICTIMA CON PROCEDENCIA '.$dir_procedencia.', ';
	   }
	  else
	   {
   	    $dir_proce = '';
	   }

	  if ($residencia != '')
	   {
	    $resi = 'CON RESIDENCIA EN '.$residencia.', ';
	   }
	  else
	   {
   	    $resi = '';
	   }

      switch ($estado_civil)
	   {
	     case 1:
		     $estciv = 'ESTADO CIVIL DESCONOCIDO,';		 
			 break;
	     case 2:
		     $estciv = 'ESTADO CIVIL SOLTERO,';		 
			 break;
	     case 3:
		     $estciv = 'ESTADO CIVIL CASADO,';		 
			 break;
	     case 4:
		     $estciv = 'ESTADO CIVIL VIUDO,';		 
			 break;
	     case 5:
		     $estciv = 'ESTADO CIVIL DIVORCIADO,';		 
			 break;
	     case 6:
		     $estciv = 'ESTADO CIVIL UNION DE HECHO,';		 
			 break;
		  default:			 
		     $estciv = '';		 
	   }
	   
	  if ($a == 1)
	   {
     	if ($margen == 1) { $pdf->Cell(5); }
//	    $pdf->MultiCell(0,4,"EL DIA $fecha_suceso, APROXIMADAMENTE A LAS ".substr($row['fecha_suceso'],11,10)." HORAS, POR AVISO DE LA SECCION DE MONITOREO DE ESTE MINISTERIO, NOS DIRIGIMOS A ".$dir_hecho." ".$zonas." ".$col." DEL MUNICIPIO DE $municipio, DEPARTAMENTO DE $departamento, $el_los");
		if (substr($row['fecha_aviso'],0,10) != substr($row['fecha_suceso'],0,10) )
		 {
		  $mismo_dia = 'DEL DIA '.$fecha_suceso.', ';
		 }
		else
		 {
		  $mismo_dia = '';
		 }
		if ($id_sede_caso == 1)
		 {
 	      $pdf->MultiCell(0,4,"EL DIA $fecha_aviso, APROXIMADAMENTE A LAS ".substr($row['fecha_aviso'],11,10).", POR AVISO DE LA SECCION DE MONITOREO DE ESTE MINISTERIO, NOS DIRIGIMOS A ".$dir_hecho." ".$zonas." ".$col." DEL MUNICIPIO DE $municipio, DEPARTAMENTO DE $departamento, ARRIBANDO APROXIMADAMENTE A LAS ".substr($row['fecha_suceso'],11,10)." HORAS, $mismo_dia $el_los ");
		 }
		else
		 {  
		  $pdf->MultiCell(0,4,"EL DIA $fecha_aviso, APROXIMADAMENTE A LAS ".substr($row['fecha_aviso'],11,10).", POR AVISO DE ".$aviso.", NOS DIRIGIMOS A ".$dir_hecho." ".$zonas." ".$col." DEL MUNICIPIO DE $municipio, DEPARTAMENTO DE $departamento, ARRIBANDO APROXIMADAMENTE A LAS ".substr($row['fecha_suceso'],11,10)." HORAS, $mismo_dia $el_los ");
		 }
	    $pdf->Ln(4);		  
	   }
/*	  if ($margen == 1) { $pdf->Cell(5); }	   
	  $pdf->MultiCell(0,4,$a.". $victima, DE ".$ed_an.", SEXO ".$sex." OCUPACIÓN ".$ocupacion.", NACIONALIDAD ".$nacionalidad.", ".$estciv.' '.$resi.' '.$tip_doc.' '.$padres." ".$datos_de." ".$nom_ident." ".$enveh.".");	  
	  $pdf->Ln(4);		*/
	  
	if ($chk_bebe == 1)
	 {
	  if ($margen == 1) { $pdf->Cell(5); }	   
	  $pdf->MultiCell(0,4,$a.". $victima, DE ".$ed_an.", SEXO ".$sex.", NACIONALIDAD ".$nacionalidad.", ".$resi.' '.$tip_doc.' '.$padres." ".$datos_de." ".$nom_ident." ".$enveh.".");	  
	  $pdf->Ln(4);			 
      if ($margen == 1) { $pdf->Cell(5); }	   
	  $pdf->MultiCell(0,4,"CARACTERISTICAS FISICAS: LAS CORRESPONDIENTES A SU EDAD.");	  	  
	  $pdf->Ln(4);		
	 }
	else
	 {
	  if ($margen == 1) { $pdf->Cell(5); }	   
	  $pdf->MultiCell(0,4,$a.". $victima, DE ".$ed_an.", SEXO ".$sex." OCUPACIÓN ".$ocupacion.", NACIONALIDAD ".$nacionalidad.", ".$estciv.' '.$resi.' '.$tip_doc.' '.$padres." ".$datos_de." ".$nom_ident." ".$enveh.".");	  
	  $pdf->Ln(4);			 

	  if ($row['caracteristicas_fisicas'] != null)  
	   {
		  if ($margen == 1) { $pdf->Cell(5); }	   
	    $pdf->MultiCell(0,4,"CARACTERISTICAS FISICAS: ".$row['caracteristicas_fisicas']." COMPLEXION ".$row['complexion'].", ESTATURA ".$row['estatura'].
		" MTS., COLOR DE TEZ ".$row['c_tez'].", COLOR DE OJOS ".$row['c_oj'].", COLOR DE CABELLO ".$row['c_cab'].", TIPO DE CABELLO ".$row['cabello'].".");	  	  

// Código agregado por Mario Hernández para mostrar algunas características físicas de la víctima.
	$sele_temp = "SELECT id_nariz, id_frente, id_boca, id_labios, id_cejas, id_bigote, id_barba FROM persona
					WHERE id_persona = $idpertemp";

	$resulttemp = mysql_query($sele_temp);
	if ($rowtemp = mysql_fetch_array($resulttemp))
	{
		$idnariz = $rowtemp['id_nariz'];
		$idfrente = $rowtemp['id_frente'];
		$idboca = $rowtemp['id_boca'];
		$idlabios = $rowtemp['id_labios'];
		$idcejas = $rowtemp['id_cejas'];
		$idbigote = $rowtemp['id_bigote'];
		$idbarba = $rowtemp['id_barba'];

		$tiponariz = '';
		$tipofrente = '';
		$tipoboca = '';
		$tipolabios = '';
		$tipocejas = '';
		$tipobigote = '';
		$tipobarba = '';
		$sele_temp = "SELECT nariz FROM tipo_nariz WHERE id_nariz = $idnariz";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tiponariz = $rowtemp2['nariz'];
		}

		$sele_temp = "SELECT frente FROM tipo_frente WHERE id_frente = $idfrente";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipofrente = $rowtemp2['frente'];
		}

		$sele_temp = "SELECT boca FROM tipo_boca WHERE id_boca = $idboca";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipoboca = $rowtemp2['boca'];
		}

		$sele_temp = "SELECT labios FROM tipo_labios WHERE id_labios = $idlabios";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipolabios = $rowtemp2['labios'];
		}

		$sele_temp = "SELECT cejas FROM tipo_cejas WHERE id_cejas = $idcejas";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipocejas = $rowtemp2['cejas'];
		}

		$sele_temp = "SELECT bigote FROM tipo_bigote WHERE id_bigote = $idbigote";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipobigote = $rowtemp2['bigote'];
		}

		$sele_temp = "SELECT barba FROM tipo_barba WHERE id_barba = $idbarba";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipobarba = $rowtemp2['barba'];
		}

		$caract_fisicas = '';
		if ($tiponariz != '')
		{	$caract_fisicas .= " NARIZ ".$tiponariz.",";	}
		if ($tipofrente != '')
		{	$caract_fisicas .= " FRENTE ".$tipofrente.",";	}
		if ($tipoboca != '')
		{	$caract_fisicas .= " BOCA ".$tipoboca.",";	}
		if ($tipolabios != '')
		{	$caract_fisicas .= " LABIOS ".$tipolabios.",";	}
		if ($tipocejas != '')
		{	$caract_fisicas .= " CEJAS ".$tipocejas.",";	}
		if ($tipobigote != '')
		{	$caract_fisicas .= " BIGOTE ".$tipobigote.",";	}
		if ($tipobarba != '')
		{	$caract_fisicas .= " BARBA ".$tipobarba.".";	}

		if ($caract_fisicas != '')
		{
			if ($margen == 1) { $pdf->Cell(5); }	   
			$pdf->MultiCell(0,4,$caract_fisicas);
		}
	}

	    $pdf->Ln(4);		  		
	   }
	  else
	   {
    	if ($margen == 1) { $pdf->Cell(5); }	   
	    $pdf->MultiCell(0,4,"CARACTERISTICAS FISICAS: COMPLEXION ".$row['complexion'].", ESTATURA ".$row['estatura'].
		" MTS., COLOR DE TEZ ".$row['c_tez'].", COLOR DE OJOS ".$row['c_oj'].", COLOR DE CABELLO ".$row['c_cab'].", TIPO DE CABELLO ".$row['cabello'].".");	  	  

// Código agregado por Mario Hernández para mostrar algunas características físicas de la víctima.
	$sele_temp = "SELECT id_nariz, id_frente, id_boca, id_labios, id_cejas, id_bigote, id_barba FROM persona
					WHERE id_persona = $idpertemp";

	$resulttemp = mysql_query($sele_temp);
	if ($rowtemp = mysql_fetch_array($resulttemp))
	{
		$idnariz = $rowtemp['id_nariz'];
		$idfrente = $rowtemp['id_frente'];
		$idboca = $rowtemp['id_boca'];
		$idlabios = $rowtemp['id_labios'];
		$idcejas = $rowtemp['id_cejas'];
		$idbigote = $rowtemp['id_bigote'];
		$idbarba = $rowtemp['id_barba'];

		$tiponariz = '';
		$tipofrente = '';
		$tipoboca = '';
		$tipolabios = '';
		$tipocejas = '';
		$tipobigote = '';
		$tipobarba = '';
		$sele_temp = "SELECT nariz FROM tipo_nariz WHERE id_nariz = $idnariz";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tiponariz = $rowtemp2['nariz'];
		}

		$sele_temp = "SELECT frente FROM tipo_frente WHERE id_frente = $idfrente";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipofrente = $rowtemp2['frente'];
		}

		$sele_temp = "SELECT boca FROM tipo_boca WHERE id_boca = $idboca";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipoboca = $rowtemp2['boca'];
		}

		$sele_temp = "SELECT labios FROM tipo_labios WHERE id_labios = $idlabios";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipolabios = $rowtemp2['labios'];
		}

		$sele_temp = "SELECT cejas FROM tipo_cejas WHERE id_cejas = $idcejas";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipocejas = $rowtemp2['cejas'];
		}

		$sele_temp = "SELECT bigote FROM tipo_bigote WHERE id_bigote = $idbigote";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipobigote = $rowtemp2['bigote'];
		}

		$sele_temp = "SELECT barba FROM tipo_barba WHERE id_barba = $idbarba";
		$resulttemp2 = mysql_query($sele_temp);
		if ($rowtemp2 = mysql_fetch_array($resulttemp2))
		{
			$tipobarba = $rowtemp2['barba'];
		}

		$caract_fisicas = '';
		if ($tiponariz != '')
		{	$caract_fisicas .= " NARIZ ".$tiponariz.",";	}
		if ($tipofrente != '')
		{	$caract_fisicas .= " FRENTE ".$tipofrente.",";	}
		if ($tipoboca != '')
		{	$caract_fisicas .= " BOCA ".$tipoboca.",";	}
		if ($tipolabios != '')
		{	$caract_fisicas .= " LABIOS ".$tipolabios.",";	}
		if ($tipocejas != '')
		{	$caract_fisicas .= " CEJAS ".$tipocejas.",";	}
		if ($tipobigote != '')
		{	$caract_fisicas .= " BIGOTE ".$tipobigote.",";	}
		if ($tipobarba != '')
		{	$caract_fisicas .= " BARBA ".$tipobarba.".";	}

		if ($caract_fisicas != '')
		{
			if ($margen == 1) { $pdf->Cell(5); }	   
			$pdf->MultiCell(0,4,$caract_fisicas);
		}
	}

	    $pdf->Ln(4);		  		
	   } // termina $row['caracteristicas_fisicas'] != null)  
	  } // termina chk_bebe   
	  
	  if ($row['vestuario'] != null)
	   {
   	  if ($margen == 1) { $pdf->Cell(5); }
	    $pdf->MultiCell(0,4,"VESTUARIO: ".$row['vestuario'].".");	  	  	  
	    $pdf->Ln(4);				
	   }
	  if ($row['cicatrices'] != null)	   
	   {
    	if ($margen == 1) { $pdf->Cell(5); }
  	    $pdf->MultiCell(0,4,"CICATRICES: ".$row['cicatrices'].".");	  	  	  
	    $pdf->Ln(4);				
	   }
	  if ($row['tatuajes'] != null)	   
	   {
 	 	if ($margen == 1) { $pdf->Cell(5); }	   
  	    $pdf->MultiCell(0,4,"TATUAJES: ".$row['tatuajes'].".");	  	  	  
	    $pdf->Ln(4);				
	   }

	  if ($row['valores'] != null)	   
	   {
     	if ($margen == 1) { $pdf->Cell(5); }
  	    $pdf->MultiCell(0,4,"VALORES: ".$row['valores'].".");	  	  	  
	    $pdf->Ln(4);				
	   }
	   	   
	  if ($row['lesiones'] != null)	   
	   {
/*	   	$pdf->SetFont('Arial','B',8);
	    $pdf->Cell(0,4,'LESIONES',0,1);
		$pdf->SetFont('Arial','',8);*/
 	    if ($margen == 1) { $pdf->Cell(5); }		
		  if ($chk_medicof == 1)    // si asistio medico forense
		   {  
			$pdf->MultiCell(0,4,"LESIONES EXTERNAS Y/O HALLAZGOS: SEGUN INDICACIONES DEL MEDICO FORENSE DEL MINISTERIO PUBLICO, INDICA QUE PRESENTA LAS SIGUIENTES: ".$row['lesiones'].".");	  	  	  
			$pdf->Ln(4);				
		   } 
		  else // no asistio medico forense
		   {
     	    $pdf->MultiCell(0,4,"LESIONES EXTERNAS Y/O HALLAZGOS: PRESENTA LAS SIGUIENTES: ".$row['lesiones'].".");	  	  	  
  	    	$pdf->Ln(4);				
		   }
	   }
	  else
	   {
	    if ($margen == 1) { $pdf->Cell(5); }		
		 if ($chk_medicof == 1)    // si asistio medico forense
		   {  
  	    	$pdf->MultiCell(0,4,"LESIONES EXTERNAS Y/O HALLAZGOS: SEGUN INDICACIONES DEL MEDICO FORENSE DEL MINISTERIO PUBLICO, SE ESTABLECE QUE NO PRESENTA LESIONES.");	  	  	  
		    $pdf->Ln(4);				
		   }
		 else  // no asistio medico forense
		  {
 		   $pdf->MultiCell(0,4,"LESIONES EXTERNAS Y/O HALLAZGOS: SE ESTABLECE QUE NO PRESENTA LESIONES.");	  	  	  
		   $pdf->Ln(4);				
		  }
	   }
  	    if ($margen == 1) { $pdf->Cell(5); }	   
		 if ($chk_medicof == 1)    // si asistio medico forense
		   {  
  	    	$pdf->MultiCell(0,4,"POSIBLE CAUSA DE MUERTE: DE ACUERDO A LA EVALUACIÓN DEL MÉDICO FORENSE DEL MINISTERIO PÚBLICO: ".$row['causa_muerte'].".");	  	  	  
	    	$pdf->Ln(4);					   
		   }
		 else
		  {  
  	    	$pdf->MultiCell(0,4,"POSIBLE CAUSA DE MUERTE: DE ACUERDO A LA EVALUACIÓN: ".$row['causa_muerte'].".");	  	  	  
	    	$pdf->Ln(4);					   
		   }		   
	  if($row['informacion'] != null)
	   {
     	if ($margen == 1) { $pdf->Cell(5); }
	    $pdf->MultiCell(0,4,"INFORMACION: ".$row['informacion'].".");	  	  	  
	    $pdf->Ln(4);					   
	   }
	 }
	 ////*
   $pdf->Ln(4); 
/* 	if ($margen == 1) { $pdf->Cell(5); }   
   $pdf->SetFont('Arial','B',10);	   
   $pdf->MultiCell(0,4,"VEHICULOS"); 
   $pdf->SetFont('Arial','',10);		
   $pdf->Ln(4); */

   $selveh = "SELECT a.id_caso, a.id_vehiculo, a.placa, b.color, c.marca_vehiculo, t.tipo_placa, t.literal, tp.tipo_vehiculo, a.modelo, a.chasis,
			  a.motor, a.cilindros, l.linea, a.observaciones, a.partes_veh
			  from vehiculo a, color b, marca_vehiculo c, tipo_placa t, tipo_vehiculo tp, linea l, caso ca
			  where a.id_caso = '$_GET[num]' and ca.id_caso = a.id_caso and a.id_color = b.id_color and a.id_marca_vehiculo = c.id_marca_vehiculo and t.id_tipo_placa = a.id_tipo_placa
			  and tp.id_tipo_vehiculo = a.id_tipo_vehiculo and l.id_linea = a.id_linea and ca.id_sede_caso = $id_sede_caso";
//  echo $selveh;
   $resveh = mysql_query($selveh);
   $v = 0;
   if (mysql_num_rows($resveh) == 0)
    {
     $pdf->SetFont('Arial','B',10);	   
  //   if ($margen == 1) { $pdf->Cell(5); }	
//     $pdf->MultiCell(0,4,"ESTE CASO NO TIENE VEHICULOS REGISTRADOS");	 	 
//     $pdf->SetFont('Arial','',10);	   	 
//	$pdf->Ln(4);		 
	}
   else
    {
     $pdf->MultiCell(0,4,"VEHICULOS"); 
     while ($rowv = mysql_fetch_array($resveh))
      {
	   $caso = $rowv['id_caso'];
	   if ($rowv['marca_vehiculo'] != null ) { $marca = 'MARCA '.$rowv['marca_vehiculo'].','; } else { $marca = ''; }
	   if ($rowv['tipo_placa'] != null ) {$tipo_p = 'PLACA '.$rowv['literal'].'-'.$rowv['placa'].','; }	else { $tipo_p = ''; }
	   if ($rowv['tipo_vehiculo'] != null ) {$tipo_v = 'TIPO '.$rowv['tipo_vehiculo'].','; }	else { $tipo_v = ''; }	 
	   if ($rowv['modelo'] == '0') { $modelo = 'MODELO DESCONOCIDO,'; } else { $modelo = 'MODELO '.$rowv['modelo'].','; } //else { $modelo = ''; }	 
	   if ($rowv['chasis'] != null) { $chasis = 'CHASIS '.$rowv['chasis'].','; } else { $chasis = ''; }	 	 
	   if ($rowv['motor'] != null) { $motor = 'MOTOR '.$rowv['motor'].','; } else { $motor = ''; }	 	 
	   if ($rowv['cilindros'] != null) { $cilindros = 'CILINDROS '.$rowv['cilindros'].','; } else { $cilindros = ''; }	 	 
	   if ($rowv['linea'] != null) { $linea = 'LINEA '.$rowv['linea']; } else { $linea = ''; }	 	 	 	 	 
	   if ($rowv['color'] != null) { $color = 'COLOR '.$rowv['color'].','; } else { $color = ''; }	 
	   if ($rowv['partes_veh'] == 0) 
	    {
		   $v++;
		   if ($rowv['observaciones'] != null) { $observa = 'OBSERVACIONES '.$rowv['observaciones']; } else { $observa = ''; }	 	   		
		   $desc_veh = "VEHICULO No. $v, ".$marca." ".$tipo_p." ".$color." ".$tipo_v." ".$modelo." ".$chasis." ".$motor." ".$cilindros." ".$linea.". ".$observa.".";
		}		   
	   else
	    {
	     if ($rowv['observaciones'] != null) { $observa = 'PARTES DE VEHICULO: '.$rowv['observaciones']; } else { $observa = ''; }	 	   		
	     $desc_veh = $observa.".";		
		}
       $pdf->Cell(5);
	   $pdf->MultiCell(0,4,$desc_veh);	 	 
	   $pdf->Ln(2);		
     }
   }
//   if ($fecha_fin != null)
   if (substr($fecha_fin,0,2) != '00')
    {
       $pdf->Cell(5);
	   $pdf->MultiCell(0,4,'LA FINALIZACION DEL PROCEDIMIENTO FUE EL DIA '.$fecha_fin.' A LAS '.$hora_fin.' HORAS.');	 	 
	   $pdf->Ln(4);		
	}
/*   else
    {
	   $pdf->Cell(5);
	   $pdf->MultiCell(0,4,'LA FINALIZACION DEL PROCEDIMIENTO FUE APROXIMADAMENTE '.$fecha_fin);	 	 
	   $pdf->Ln(4);		
	}*/

	 ////*
	$pdf->SetFont('Arial','B',10);
    if ($margen == 1) { $pdf->Cell(5); }	
	$pdf->MultiCell(0,4,'PERSONAL PRESENTE EN EL LUGAR');				 
	$pdf->SetFont('Arial','',10);	
    if ($margen == 1) { $pdf->Cell(5); }	
	$pdf->MultiCell(0,4,$_POST['personal']);			
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',10);		
    if ($margen == 1) { $pdf->Cell(5); }	
	$pdf->MultiCell(0,4,"POR PARTE DE LA UNIDAD DE ESPECIALISTAS EN ESCENA DEL CRIMEN ".$grupo.", SE REALIZARON LAS SIGUIENTES ACTIVIDADES:");				 
	$pdf->SetFont('Arial','',10);	
    if ($margen == 1) { $pdf->Cell(5); }	
	$pdf->MultiCell(0,4,$_POST['actividades']);			
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',10);			
    if ($margen == 1) { $pdf->Cell(5); }	
	$pdf->MultiCell(0,4,'MIEMBROS DEL GRUPO E.E.C. '.$grupo.' PRESENTES EN EL LUGAR:');				 
	$pdf->SetFont('Arial','',10);
//	$pdf->MultiCell(0,4,$_POST['personal'],0,1,'L');			
	$pdf->Ln(4);	

//	$seleg="SELECT a.nip, b.nombre, a.rol_coord, a.rol_adic FROM detalle_caso a, empleado b where a.id_caso = '$_GET[num]' and a.nip = b.nip";	
	$seleg="SELECT a.nip, b.nombre, a.rol_coord, a.rol_adic, b.id_puesto, p.puesto FROM detalle_caso a, empleado b, puesto p where a.id_caso = '$_GET[num]' and a.nip = b.nip and b.id_puesto = p.id_puesto order by rol_coord desc, rol_adic";	
	$resg=mysql_query($seleg);
	while ($row = mysql_fetch_array($resg))
	 {
	  if ($row['rol_coord'] == 1)
	   {
	    $coo = 'COORDINADOR';
		$puestog = $row['puesto'];		
	   }
	  else
	   {
	    $coo = '';
	   }
	  if ($row['rol_adic'] == 1)
	   {
	    $rolad = 'FOTOGRAFO';
	   }
	  else
	   {
  	    if ($row['rol_adic'] == 2)
	     {
	      $rolad = 'EMBALADOR';
	     }
	    else
		 {
	 	  if ($row['rol_adic'] == 3)
	       {
	        $rolad = 'PLANIMETRISTA';
	       }
		 } 
	   }
	  if ($row['rol_coord'] == 1)	   
	   {
 	    if ($margen == 1) { $pdf->Cell(5); }	   
	    $pdf->Cell(0,4,$row['nombre'].' - '.$coo.' - '.$rolad,0,1,'L');	  
       }
	  else
	   {
    	if ($margen == 1) { $pdf->Cell(5); }	   
	    $pdf->Cell(0,4,$row['nombre'].' - '.$rolad,0,1,'L');	  
       }
	 }
	$pdf->Ln(4);	
    if ($margen == 1) { $pdf->Cell(5); }	
	$pdf->Cell(0,4,"SIN OTRO PARTICULAR ME SUSCRIBO DE USTED,",0,1,'L');
	$pdf->Ln(4);
    if ($margen == 1) { $pdf->Cell(5); }	
	$pdf->Cell(0,4,"DEFERENTEMENTE,",0,1,'L');	
	$pdf->Ln(8);	
	$Nombre = $_POST['nom_us'];
    if ($margen == 1) { $pdf->Cell(5); }	
	$pdf->Cell(0,4,$Nombre,0,1,'C');	
//	$pdf->Cell(0,4,"TECNICO EN INVESTIGACIONES CRIMINALISTICAS I",0,1,'C');		
    if ($margen == 1) { $pdf->Cell(5); }
	$pdf->Cell(0,4,$puestog,0,1,'C');		
    if ($margen == 1) { $pdf->Cell(5); }	
	$pdf->Cell(0,4,"COORDINADOR ".$grupo,0,1,'C');		

$pdf->Output();	

?>
