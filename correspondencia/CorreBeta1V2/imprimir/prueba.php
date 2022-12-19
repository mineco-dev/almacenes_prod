<?php
require('../../fpdf/fpdf.php');
//include('../../conectarse.php');

//include('../../INCLUDES/inc_header.inc');

include('../../INCLUDES/inc_conexion.inc');
//include('../../INCLUDES/inc_dbms.inc');
//		$dbms=new DBMS($conexion); 
		include('../../conectarse.php');




$pdf=new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->Cell(0,0,'Ministerio de Economía, Guatemala',0,1,'C');
$pdf->Ln(4);
$pdf->Cell(0,1,'Correspondencia',0,1,'C');
$pdf->SetFont('Arial','',8);



/*function Conectarse($base)
{
//	if (!($link=@mysql_connect('172.17.1.28','escena','scn')))
	if (!($link=mssql_connect('SERVER_APPL','msjharry','cortes')))
	{
		//echo "Error conectando a la base de datos.";
$pdf->Cell(0,1,'Error conectando a la base de datos.',0,1,'C');

		//exit();
	}

	if (!mssql_select_db($base,$link))
	{
		//echo "Error seleccionando la base de datos.";
$pdf->Cell(0,1,'Error seleccionando a la base de datos.',0,1,'C');

		//exit();
	}
	return $link;
}

$link =Conectarse('RRHH');*/

		
//$usuario = $_SESSION['codigoUsuario'];


//// descomentar esta aopcion cuando se pruebe que ya hay datos en seguimiento
$SQL = "UPDATE seguimiento SET status = 1 WHERE docu = $docu";
$result = mssql_query($SQL); // elimina informacion temporal

$SQL = "SELECT c.idcorrespondencia,
				c.titulo,
				c.quien,
				c.insti,
				c.descr,
				c.ref,
				c.fechaenvio,
				c.correlativo,
				c.correlativoinicial
		FROM correspondencia c
		WHERE c.idcorrespondencia = $docu";
//			print $SQL;

$result = mssql_query($SQL); // elimina informacion temporal
$row = mssql_fetch_row($result);

$pdf->Ln(4);
$pdf->SetFillColor(250 , 250, 0); 
$pdf->cell(0,4,'',0,1,'L');
$pdf->Cell(50,4,'',1,0,'L',0,1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,4,'Correspondencia',1,1,'L',1);

$pdf->Cell(50,4,'Titulo',1,0,'L',0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[1],1,1,'L');
$pdf->Cell(50,4,'',1,0,'L',0,1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,4,'Documento',1,1,'L',1);

$pdf->Cell(50,4,'Codigo Documento ',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[7],1,1,'L');
$pdf->Cell(50,4,'',1,0,'L',0,1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,4,'Detalle del Documento',1,1,'L',1);

$pdf->Cell(50,4,'Quien Envìa',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[2],1,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'Institución',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[3],1,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'Descripción',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,4,substr($row[4],0,150),1,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'Referencia',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[5],1,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'Fecha Ingreso',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[6],1,1,'L');

$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(130,4,'Transferir a: _______________________________________     Coordinador ',0,0,'L');
$pdf->cell(5,4,'',1,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(22,4,'Observación: _______________________________________     Recibe: _____________________',0,1,'L');

$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(88,4,'__________________________________________________',0,0,'L');

$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(88,4,'__________________________________________________',0,0,'L');


$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(88,4,'__________________________________________________',0,1,'L');




//AQUI EMPIEZA DE NUEVO PARA LA COPIA
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
//$pdf->cell(0,4,'',0,1,'L');


if (strlen($row[4]) < 80)
	{
		$pdf->cell(0,4,'',0,1,'L');
		$pdf->cell(0,0,'',1,1,'L');
//		$pdf->cell(0,4,'',0,1,'L');
	}
else
	{
		$pdf->cell(0,0,'',1,1,'L');
//		$pdf->cell(0,4,'',0,1,'L');
	}


//$pdf->cell(0,0,'',1,1,'L');

$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0,'Ministerio de Economía, Guatemala',0,1,'C');
$pdf->Ln(4);
$pdf->Cell(0,1,'Correspondencia',0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');

$pdf->Cell(50,4,'',1,0,'L',0,1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,4,'Correspondencia',1,1,'L',1);
$pdf->Cell(50,4,'Titulo',1,0,'L',0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[1],1,1,'L');
$pdf->Cell(50,4,'',1,0,'L',0,1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,4,'Documento',1,1,'L',1);

$pdf->Cell(50,4,'Codigo Documento ',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[7],1,1,'L');
$pdf->Cell(50,4,'',1,0,'L',0,1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,4,'Detalle del Documento',1,1,'L',1);

$pdf->Cell(50,4,'Quien Envìa',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[2],1,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'Institución',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[3],1,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'Descripción',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,4,substr($row[4],0,150),1,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'Referencia',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[5],1,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'Fecha Ingreso',1,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[6],1,1,'L');

$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(130,4,'Transferir a: _______________________________________     Coordinador ',0,0,'L');
$pdf->cell(5,4,'',1,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(22,4,'Observación: _______________________________________     Recibe: _____________________',0,1,'L');

$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(88,4,'__________________________________________________',0,0,'L');

$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(88,4,'__________________________________________________',0,0,'L');


$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(88,4,'__________________________________________________',0,0,'L');




$pdf->SetTextColor('asd','sd','firma del interesado'); 

$SQL12 = "SELECT da,nombre,descripcion,path FROM doc_adj WHERE   docu = $row[0]";
$result = mssql_query($SQL12); // elimina informacion temporal
while ($row1 = mssql_fetch_row($result))
 {
	$pdf->Cell(0,4,$row[0],1,1);
	$pdf->Cell(0,4,$row[1],1,1);
	$pdf->Cell(0,4,$row[2],0,1);
}


$pdf->Output(); 

?>