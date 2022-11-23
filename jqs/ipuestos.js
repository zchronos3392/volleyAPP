// JavaScript Document PARA EL banner que crece automaticamente...
		// cuando PRESIONO CLICK , LO ACTUALIZO

function cargarPosicion(idpuesto){
	
			var parametros = {"idpuesto" : idpuesto};	
		
	         $.ajax({ 
            url:   './abms/obtener_puestos.php',
            type:  'GET',
            dataType: 'json',
	        data: parametros,            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
               $(r['Posiciones']).each(function(i, v)
                { // indice, valor
			    	$("#posicion").val(v.nombre);
			    	$("#codigo").val(v.codigo);
			    	$("#colorPuesto").val(v.color);
				});
            },
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax PUESTOS
	
}


$(document).ready(function(){
    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
         $("#ietats").empty();
        // esto arreglo el tema del alta triplle..
         $.ajax({ 
            url:   './abms/obtener_puestos.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#select_puestos").prop('disabled', true);
       		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Posiciones']).each(function(i, v)
                { // indice, valor
                		//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#select_puestos').find("option[value='" + v.idPosicion + "']").length)
                	{
                		'('+v.idPosicion+')'+
						$("#select_puestos").append('<option value="' + v.idPosicion + '" label="('+v.idPosicion+')'+v.codigo+'-'+v.nombre+'">' +v.codigo+'-'+v.nombre + '</option>');
					}		
                });
                $("#select_puestos").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#select_puestos").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#select_puestos").val('9999');
			$("#select_puestos").prop('disabled', false);
			}
            }); // FIN funcion ajax CLUBES
//**************** POSICIONES *********************************************/   

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$("#ModPos").click(function(){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de POSICIONES
        if(($("#posicion").val() != ''))
        {
		var parametros = {
        	"posicion" : $("#posicion").val(),
        	"codigo" : $("#codigo").val(),
        	"color"  :  $("#colorPuesto").val(),
        	"idposicion": $("#select_puestos").val()
		};		         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/modifica_posicion.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){},            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    				location.reload();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#select_puestos").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
            
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
    }); // parentesis el .CLICK BTNINGRESO

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//**************** POSICIONES *********************************************/            
$("#AltaPos").click(function(){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        if(($("#posicion").val() != ''))
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
        //alert($("#colorPuesto").val());
		var parametros = {
        	"posicion" : $("#posicion").val(),
        	"codigo" : $("#codigo").val(),
        	"color"  :  $("#colorPuesto").val()
		};		         

 
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_posicion.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#select_puestos").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#select_puestos").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#select_puestos").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
            
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
    }); // parentesis el .CLICK BTNINGRESO


//**************** CLUBES *********************************************/            
$("#BajaPos").click(function(){ 
		var parametros = {
        	"posicion" : $("#select_puestos").val()
		};		         
         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/eliminar_posicion.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#select_puestos").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#select_puestos").prop('disabled', false);
    			window.location.reload();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#select_puestos").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax

    }); // parentesis el .CLICK BTNINGRESO


$("#select_puestos").on("click change",function(){ 

			cargarPosicion($("#select_puestos").val());

}); // parentesis el .CLICK BTNINGRESO
         
}); // parentesis del READY



    
