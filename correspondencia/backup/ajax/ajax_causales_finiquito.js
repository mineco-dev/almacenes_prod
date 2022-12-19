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
function eliminarDatos(){
	        var nombre_causal=document.causales_finiquito.nombre_causal.value;
	        var id_cfi=document.causales_finiquito.id_cfi.value;
		    var eliminar = confirm("confirma eliminar: "+ nombre_causal +" ?");
	    
	    if ( eliminar ) {
			ajax=nuevoAjax();
			
			ajax.open("POST", "/modulos/mo_causales_finiquito.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				var var_send="op1=delete"+"&id_cfi="+id_cfi;
			
			ajax.send(var_send);

		    nuevoDatos();

		    cargaContenido("causales_finiquito","1");
	    }
} 
       
function guardarDatos(){
 			var id_cfi=document.causales_finiquito.id_cfi.value;
		c1=document.causales_finiquito.nombre_causal.value;
		c2=document.causales_finiquito.nombre_articulo.value;
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_causales_finiquito.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="id_cfi="+id_cfi+"&op1=insert&c1="+c1+"&c2="+c2;
		ajax.send(var_send);

		nuevoDatos();

		cargaContenido("causales_finiquito","1");		 
}

function nuevoDatos(){
 	   document.causales_finiquito.id_cfi.value=""
       document.causales_finiquito.nombre_causal.value="";
       document.causales_finiquito.nombre_articulo.value="";
       document.causales_finiquito.nombre_causal.focus();
       return;
}

function cargaContenido(consulta,fila){

		  var ajax=nuevoAjax();
          var capaContenedora = document.getElementById(fila);
          ajax.open ("POST","/modulos/selected.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
		                        document.getElementById(fila).innerHTML=ajax.responseText;
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="consulta="+consulta;
         ajax.send(var_send);
  return;
}

function leerDatos(){
	 var lista_causales_finiquito=document.getElementById('causales_finiquitos');
	 var id_cfi=lista_causales_finiquito.value;

		  var ajax=nuevoAjax();
          var capaContenedora = document.getElementById('d');
          ajax.open ("POST","/modulos/mo_xml.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
				                   	capaContenedora.innerHTML="";
		                       		var vari=ajax.responseXML;
		                       		document.causales_finiquito.id_cfi.value=id_cfi;
									document.causales_finiquito.nombre_causal.value = vari.getElementsByTagName('nombre').item(0).firstChild.data; 
								    document.causales_finiquito.nombre_articulo.value = vari.getElementsByTagName('articulo').item(0).firstChild.data; 
									document.causales_finiquito.nombre_causal.focus();								
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_cfi="+id_cfi+"&modulo=causales_finiquito";
         ajax.send(var_send);
  return;

}
</script>