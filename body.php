<?
	session_start();
	$opcion=$_SESSION['subgerencia'];
	header("Location: main$opcion.php"); 
	
	include("almacen.php");
?>
