function creaAjax(){
         var objetoAjax=false;
         try {
          //Para navegadores distintos a internet explorer
          objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
          try {
                   //Para explorer
                   objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
                   }
                   catch (E) {
                   objetoAjax = false;
          }
         }

         if (!objetoAjax && typeof XMLHttpRequest!='undefined') {
          objetoAjax = new XMLHttpRequest();
         }
         return objetoAjax;
}

 function FAjax (url,capa,valores,metodo)
{
          var ajax=creaAjax();
          var capaContenedora = document.getElementById(capa);

//Creamos y ejecutamos la instancia si el metodo elegido es POST
if(metodo.toUpperCase()=='POST'){
         ajax.open ('POST', url, true);
         ajax.onreadystatechange = function() {
         if (ajax.readyState==1) {
                          capaContenedora.innerHTML="Cargando.......";
         }
         else if (ajax.readyState==4){
                   if(ajax.status==200)
                   {
                        document.getElementById(capa).innerHTML=ajax.responseText;
                   }
                   else if(ajax.status==404)
                                             {

                            capaContenedora.innerHTML = "La direccion no existe";
                                             }
                           else
                                             {
                            capaContenedora.innerHTML = "Error: ".ajax.status;
                                             }
                                    }
                  }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         ajax.send(valores);
         return;
}
}
function enviarDatosEmpleado(){
	//donde se mostrará lo resultados
	//divResultado = document.getElementById('resultado');
	//divFormulario = document.getElementById('formulario');
	//valores de los inputs
	id=document.frmempleado.idempleado.value;
	nom=document.frmempleado.nombres.value;
	dep=document.frmempleado.departamento.value;
	//suel=document.frmempleado.sueldo.value;
	//alert("si");
	//instanciamos el objetoAjax
	ajax=creaAjax();
	//usando del medoto POST
	//archivo que realizará la operacion
	//actualizacion.php
	ajax.open("POST", "actualizacion.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar los nuevos registros en esta capa
   			      //divResultado.innerHTML = ajax.responseText
			//mostrar un mensaje de actualizacion correcta
			//divFormulario.innerHTML = "<p style=\"border:1px solid red; width:400px;\">La actualizaci&oacute;n se realiz&oacute; correctamente</p>";
			//location.href='<?php echo $url; ?>';
		}
	}
	//muy importante este encabezado ya que hacemos uso de un formulario
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idempleado="+id+"&nombres="+nom)
}

function eliminarDatosEmpleado(){
	//donde se mostrará lo resultados
	divResultado = document.getElementById('capaContenedora');
	//divFormulario = document.getElementById('formulario');
	//valores de los inputs
	id=document.frmempleado.idempleado.value;
	   //nom=document.frmempleado.nombres.value;
	   //dep=document.frmempleado.departamento.value;
	//suel=document.frmempleado.sueldo.value;
	//alert("si");
	//instanciamos el objetoAjax
	var eliminar = confirm("De verdad desea eliminar el cliente "+ id +" ?")
   if ( eliminar ) {
        	ajax=creaAjax();
        	//usando del medoto POST
        	//archivo que realizará la operacion
        	//actualizacion.php
        	ajax.open("POST", "eliminar.php",true);
        	ajax.onreadystatechange=function() {
        		if (ajax.readyState==4) {
        			//mostrar los nuevos registros en esta capa
           			      //divResultado.innerHTML = ajax.responseTextos        			//mostrar un mensaje de actualizacion correcta
        			divResultado.innerHTML = "<p style=\"border:1px solid red; width:400px;\">eliminación realizada con exito</p>";
        			//location.href='<?php echo $url; ?>';
        		}
        	}
        	//muy importante este encabezado ya que hacemos uso de un formulario
        	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        	//enviando los valores
        	ajax.send("idempleado="+id)
	}
}

function nuevoDatosEmpleado(){
        divResultado = document.getElementById('capaContenedora');
        divResultado.innerHTML = "<p style=\"border:1px solid red; width:400px;\">Buscar datos</p>";
       document.datos_empleados.campo1.value="";
       document.datos_empleados.campo2.value="";
       document.datos_empleados.campo1.focus();
}
