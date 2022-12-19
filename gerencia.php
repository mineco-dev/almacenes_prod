<style type="text/css">
<!--
.Estilo1 {font-size: xx-large}
.Estilo2 {font-size: medium}
-->
</style>
<?
	session_register('subgerencia');
	$_SESSION['subgerencia'] =10;
	header("Location: index.php"); 
?>
