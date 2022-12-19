<script language="javascript" type="text/javascript">
function nuevoAjax(){ 
	var xmlhttp=false; 
	try { 
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e) { 
		try { 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}
function mostrarPagina(pagina){
   pantalla = document.getElementById('formulario');
   
   //alert(pagina);
   
   ajax=nuevoAjax();
   
   ajax.open("GET",pagina,true);
   ajax.onreadystatechange = function(){
     		if (ajax.readyState == 4 && ajax.status == 200) {
			   pantalla.innerHTML = ajax.responseText;
   		}
   	}
   ajax.send(null);
}
</script>