<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type='text/javascript' src="js/jquery.min.js"></script>
<script src="js/jquery.form.js"></script> 
<style>
	table, tr, td, th {
    border: 1px solid black;
}
</style>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<form id = "ElForm">
<select id = "idMes" name = "idMes">
	<option value = "01">Enero</option>
	<option value = "02">Febrero</option>
	<option value = "03">Marzo</option>
	<option value = "04">Abril</option>
	<option value = "05">Mayo</option>
	<option value = "06">Junio</option>
	<option value = "07">Julio</option>
	<option value = "08">Agosto</option>
	<option value = "09">Septiembre</option>
	<option value = "10">Octubre</option>
	<option value = "11">Noviembre</option>
	<option value = "12">Diciembre</option>
</select>
<select id = "idAnio" name = "idAnio">
	<option value = "2017">2017</option>
	<option value = "2016">2016</option>
	<option value = "2015">2015</option>
	<option value = "2014">2014</option>
	<option value = "2013">2013</option>
	<option value = "2012">2012</option>
	<option value = "2011">2011</option>
	<option value = "2010">2010</option>
	<option value = "2009">2009</option>
	<option value = "2008">2008</option>
</select>
<br />
<input type = "button" id = "elboton" value = "Crear consulta" />
<br />
<br />
<div id = "caeContenido">
</div>
</form>
<script>
		$(document).ready(function(){
			
			$("#elboton").click(function(){
				$.ajax({
					url: 'CargaTablaPeriodoCantidad.php',
					type: 'POST',
					data: {idAnio: $("#idAnio").val(), idMes: $("#idMes").val() },
					success: function(data){
						$("#caeContenido").empty();
						$("#caeContenido").append(data);
					}
				});
			});
							
		});
</script>
</body>
</html>
