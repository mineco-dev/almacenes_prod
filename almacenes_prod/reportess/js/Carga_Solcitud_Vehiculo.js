function Carga_Municipio(){
		var str = document.getElementById("Departamento").value;
		var xmlhttpmn = new XMLHttpRequest();
		xmlhttpmn.onreadystatechange = function(){
			if(xmlhttpmn.readyState == 4 && xmlhttpmn.status == 200)
			{
				document.getElementById("Municipio").innerHTML = xmlhttpmn.responseText;
		    }
		};
		xmlhttpmn.open("GET", "PHP/Carga_Municipio.php?idDepartamento="+str, true);
		xmlhttpmn.send();			
}	