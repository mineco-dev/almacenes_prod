<?php
	session_start();
	// session_register('subgerencia');
	$_SESSION['subgerencia'] =1;
	header("Location: index.php"); 
?>
