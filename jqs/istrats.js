// JavaScript Document PARA EL banner que crece automaticamente...
		// cuando PRESIONO CLICK , LO ACTUALIZO

function cargarStrats(idstrat){
	
			var parametros = {"idstrat" : idstrat};	
		
	         $.ajax({ 
            url:   './abms/obtener_strats1.php',
            type:  'GET',
            dataType: 'json',
	        data: parametros,            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
               $(r['Strats1']).each(function(i, v)
                { // indice, valor
			    	$("#stratDsc").val(v.nombre);
			    	$("#stratCodigo").val(v.codigo);

				});
            },
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax PUESTOS
	
}


$(document).ready(function(){
    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
         $("#select_strats").empty();
        // esto arreglo el tema del alta triplle..
         $.ajax({ 
            url:   './abms/obtener_strats1.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#select_strats").prop('disabled', true);
       		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Strats1']).each(function(i, v)
                { // indice, valor
                		//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#select_strats').find("option[value='" + v.codigo + "']").length)
                	{
						$("#select_strats").append('<option value="' + v.codigo + '" label="('+v.codigo+')'+v.nombre+'">' +v.nombre + '</option>');
					}		
                });
                $("#select_strats").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#select_strats").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#select_strats").val('9999');
			$("#select_strats").prop('disabled', false);
			}
            }); // FIN funcion ajax CLUBES
//**************** POSICIONES *********************************************/   

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$("#ModStrat").click(function(){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de POSICIONES
        if(($("#stratCodigo").val() != ''))
        {
		var parametros = {
        	"stratCodigo" : $("#stratCodigo").val(),
        	"stratNombre" : $("#stratDsc").val(),
		};		         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/modifica_strat.php',
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
				$("#select_strats").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
            
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
    }); // parentesis el .CLICK BTNINGRESO

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//**************** POSICIONES *********************************************/            
$("#AltaStrat").click(function(){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        if(($("#stratCodigo").val() != ''))
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
        //alert($("#colorPuesto").val());
		var parametros = {
        	"nombre" : $("#stratDsc").val(),
        	"codigo" : $("#stratCodigo").val()
		};		         

 
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_strat.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#select_strats").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#select_strats").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#select_strats").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
            
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
    }); // parentesis el .CLICK BTNINGRESO


//**************** CLUBES *********************************************/            
$("#BajaStrat").click(function(){ 
		var parametros = {
        	"strategiaCodigo" : $("#select_strats").val()
		};		         
         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/eliminar_strat1.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#select_strats").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#select_strats").prop('disabled', false);
    			window.location.reload();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#select_strats").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax

    }); // parentesis el .CLICK BTNINGRESO


$("#select_strats").on("click change",function(){ 

			cargarStrats($("#select_strats").val());

}); // parentesis el .CLICK BTNINGRESO
         
}); // parentesis del READY



    
