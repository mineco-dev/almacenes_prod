<?php
ob_start();
?>
<?PHP
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($almacen));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
	// header('Content-Type: text/html; charset=UTF-8');
	header('Content-Type: text/html; charset=UTF-8'); 
?>
<?PHP
if (isset($_REQUEST["txt_id"]))
{			

        $codigo=$_REQUEST["txt_id"];
		$no_ingreso=$_REQUEST["txt_no_ingreso"];
        $nombre_usuario=$_SESSION["user_name"];
		  $observacion2=utf8_decode($_REQUEST["txt_observacion2"]);
		conectardb($almacen);
	$qry_actualiza="UPDATE tb_ingreso_enc SET usuario_modifico='$nombre_usuario', observaciones='$observacion2' 
	 WHERE no_ingreso='$no_ingreso'";
		//print($qry_actualiza);
		$query($qry_actualiza);				
				
					  echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
	echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Se actualizó el ingreso</span></center></TD></TR>';

		 
} // cierre del if

		
?>
<?php
ob_end_flush();
?>