$(document).ready(function() {
	$("select").one("click",function(event) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200)
			{
				/*var data = JSON.parse(xmlhttp.responseText);
				for(var i = 1; i <= data.length; i++)
				{
					alert("resultado = "data[i]);
       				document.getElementById('Departamento').value = data[i];
				}	*/
				document.getElementById("Departamento").innerHTML = xmlhttp.responseText;
		    }
		};
		xmlhttp.open("POST", "PHP/Carga_Departamento.php", true);
		xmlhttp.send()					
	});
});	