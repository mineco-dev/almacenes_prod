<?php
	session_start();
	// session_register('subgerencia');
	$_SESSION['subgerencia'] =24;
	// print($_SESSION['subgerencia']);
	header("Location: index.php"); 
	exit();
?>
