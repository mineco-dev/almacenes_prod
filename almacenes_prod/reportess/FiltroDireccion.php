<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type='text/javascript' src="js/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style>
	table, tr, td {
    border: 1px solid black;
}
</style>
</head>

<body>
	<form id = "ElForm">
		<br />
		<select id = "Dependencia" name = "Dependencia" >
		</select>
		<br />
		<br /><label>Del mes de: </label>
		<select id = "mesInicio" name = "mesInicio" >
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
		<label>  del A�o:  </label>
		<select id = "anioInicio" name = "anioInicio" >
			<option value = "2000">2000</option>
			<option value = "2001">2001</option>
			<option value = "2002">2002</option>
			<option value = "2003">2003</option>
			<option value = "2004">2004</option>
			<option value = "2005">2005</option>
			<option value = "2006">2006</option>
			<option value = "2007">2007</option>
			<option value = "2008">2008</option>
			<option value = "2009">2009</option>
			<option value = "2010">2010</option>
			<option value = "2011">2011</option>
			<option value = "2012">2012</option>
			<option value = "2013">2013</option>
			<option value = "2014">2014</option>
			<option value = "2015">2015</option>
			<option value = "2016">2016</option>
			<option value = "2017">2017</option>

		</select>
		<label>&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<label>Al mes de:  </label>
		<select id = "mesFinal" name = "mesFinal" >
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
		<label> del A�o:  </label>
		<select id = "anioFinal" name = "anioFinal" >
			<option value = "2000">2000</option>
			<option value = "2001">2001</option>
			<option value = "2002">2002</option>
			<option value = "2003">2003</option>
			<option value = "2004">2004</option>
			<option value = "2005">2005</option>
			<option value = "2006">2006</option>
			<option value = "2007">2007</option>
			<option value = "2008">2008</option>
			<option value = "2009">2009</option>
			<option value = "2010">2010</option>
			<option value = "2011">2011</option>
			<option value = "2012">2012</option>
			<option value = "2013">2013</option>
			<option value = "2014">2014</option>
			<option value = "2015">2015</option>
			<option value = "2016">2016</option>
			<option value = "2017">2017</option>

		</select>
		<br />
		<br />
		<input type = "button" id = "BuscarContenido" value = "Buscar Solicitate" />
		<br />
		<br />
		
		<div id = "CaeContenido">
		
		</div>
	</form>
	
	<style>
		#CaeContenido{
			@charset 'iso-8859-15';
		}
	</style>
	
	<script charset="ISO-8859-1">
		
			$.ajax({
				url: 'CargaDependencia.php',
				data: {},
				type: 'POST',
				asinc: false,
				success: function(data){
					$("#Dependencia").append(data);
				}
			});
	
		$(document).ready(function(){
			
			$("#BuscarContenido").click(function(){
				$("#ElForm").ajaxSubmit({
					url: 'CargaTablaDireccion.php',
					type: 'POST',
					asinc: false,
					success: function(data){
						$("#CaeContenido").empty();
						$("#CaeContenido").append(data);
					}
				});
			});
							
		});
	</script>
</body>
</html>
