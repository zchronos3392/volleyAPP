// JavaScript Document PARA EL banner que crece automaticamente...
		// cuando PRESIONO CLICK , LO ACTUALIZO

$(document).ready(function(){
         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#iclubb').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclubb").append('<option value="' + v.idclub + '">' +v.clubabr+'-'+  v.nombre + '</option>');
						$("#iclubc").append('<option value="' + v.idclub + '">' +v.clubabr+'-'+  v.nombre + '</option>');
						$("#iclubd").append('<option value="' + v.idclub + '">' +v.clubabr+'-'+  v.nombre + '</option>');
					}		
                });

            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			// CLUBES upd/del
				$("#iclubb").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
				$("#iclubb").val('9999');
			// EL CLUB DE SEDES
				$("#iclubc").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
				$("#iclubc").val('9999');
			// el club de CANCHAS
				$("#iclubd").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
				$("#iclubd").val('9999');
					console.log(xhr.responseText);
					console.log(thrownError);

			}
            }); // FIN funcion ajax CLUBES

            
$("#itextAbuscar").keyup(function()
	//	on("keyup keydown",function()
         {   
			var parametros = {
	        	"llamador" : "CONTROLAPP",
	        	"funcion" : "buscarclub",			
	        	"filtro" : $("#itextAbuscar").val(),
				};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#icluba").empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#icluba').find("option[value='" + v.idclub + "']").length)
                	{
						$("#icluba").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					}		
                });
             },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			 console.log(xhr);
			 console.log(thrownError);
			}
            }); // FIN funcion ajax CANCIONES todas:
       });

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 
         
//*****************************************************************************************
//*****************************************************************************************            
          // AJAX DE CARGA POR ID DE SEDES...xº CLUB  
         $("#iclubb").change(function()
         {
         var parametros = {"idclub" : $("#iclubb").val()};	
         $.ajax({ 
            url:   './abms/sedesxclub.php',
            type:  'POST',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#isede2").prop('disabled', true);
    			$("#isede2").empty();

    		},
            done: function(data){
            	
			},
            success:  function (r){
            	var re = JSON.parse(r);
            	
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// 		DESBloqueamos el SELECT de los cursos
				// 				Limpiamos el select
				// 					FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
				$(re['SedesXClub']).each(function(i, v)
                { // indice, valor
				  if (! $('#isede2').find("option[value='" + v.idsede + "']").length)
                	{
						$("#isede2").append('<option value="' + v.idsede + '">' + v.direccion + '</option>');
					}		
                });
                $("#isede2").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#isede2").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#isede2").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
			$("#isede2").prop('disabled', false);
			}
            });// fin del ajax dentro de CHANGE
          }); // fin del CHANGE club de sedes
//*****************************************************************************************
//*****************************************************************************************

//*****************************************************************************************
//*****************************************************************************************            
          // AJAX DE CARGA POR ID DE CANCHAS X SEDES x CLUB  
         $("#iclubd").change(function()
         {
         var parametros = {"idclub" : $("#iclubd").val()};	
         $.ajax({ 
            url:   './abms/sedesxclub.php',
            type:  'POST',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#isede3").empty();

    		},
            done: function(data){
            	
			},
            success:  function (r){
            	var re = JSON.parse(r);
            	
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// 		DESBloqueamos el SELECT de los cursos
				// 				Limpiamos el select
				// 					FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
				$(re['SedesXClub']).each(function(i, v)
                { // indice, valor
				  if (! $('#isede3').find("option[value='" + v.idsede + "']").length)
                	{
						$("#isede3").append('<option value="' + v.idsede + '">' + v.direccion + '</option>');
					}		
                });

            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#isede3").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#isede3").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
			}
            });// fin del ajax dentro de CHANGE
          }); // fin del CHANGE club de sedes
          // AJAX DE CARGA POR ID DE CANCHAS X SEDES x CLUB  		  
//*****************************************************************************************
//*****************************************************************************************

		  
		//**************** busqueda clubes con jquery *********************************************/      
		$("#btnBuscarSede").click(function(){ 
			        var textoSearch =	$("#itext").val().toUpperCase();
			        if(textoSearch != ''){
					$("#isede2 option:contains("+textoSearch+")").each(function(){
			    			$(this).attr('selected', true).css({"font-size":"40px","color":"red"});
							//else $(this).attr('selected', true).css('');
					});
					} else
					$("#isede2 option:contains("+textoSearch+")").each(function(){
			    			$(this).attr('selected', true).css("");
					});
					return false;
			}); // parentesis el .CLICK buscar club
			//**************** PARTIDPS *********************************************/ 
//**************** busqueda clubes con jquery *********************************************/      
		$("#btnBuscarClub").click(function(){ 
        var textoSearch =	$("#itextA").val().toUpperCase();
 		//alert(textoSearch);
 //               $("#iclub option:contains("+textoSearch+")").attr('selected', true).css({"font-size":"40px","color":"red"});
                //$("#iclub option:contains("+textoSearch+")").attr('selected', true).css({"font-size":"40px","color":"red"});
        if(textoSearch != ''){
		$("#icluba option:contains("+textoSearch+")").each(function(){
    			$(this).attr('selected', true).css({"font-size":"40px","color":"red"});
				//else $(this).attr('selected', true).css('');
		});
		} else
		$("#icluba option:contains("+textoSearch+")").each(function(){
    			$(this).attr('selected', true).css("");
		});
		return false;
}); // parentesis el .CLICK buscar club



//**************** ELIMINO clubes con jquery *********************************************/      
$("#btnEliminaClub").click(
	function()
	{ 
			var parametros = {"iclub" : $("#icluba option:selected").val()}
           
            $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/borrar_club.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', false);
    					//alert($("#icluba option:selected").val());
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#icomp").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
           
	}
);
//**************** ELIMINO clubes con jquery *********************************************/      


//**************** ELIMINO ciudad con jquery *********************************************/      
$("#btnEliminaCity").click(
	function()
	{ 
			var parametros = {"icity" : $("#icity option:selected").val()}
           
            $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/borrar_ciudad.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#icomp").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
           
	}
);
//**************** ELIMINO ciudad con jquery *********************************************/      


//**************** ELIMINO cancha con jquery *********************************************/      
$("#btnEliminaCancha").click(
	function()
	{ 
			var parametros = {"icancha" : $("#icancha option:selected").val()}
           
            $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/borrar_cancha.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#icomp").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
           
	}
);
//**************** ELIMINO cancha con jquery *********************************************/      

//**************** ELIMINO competencia con jquery *********************************************/      
$("#btnEliminaComp").click(
	function()
	{ 
			var parametros = {"icomp" : $("#icomp option:selected").val()}
           
            $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/borrar_comp.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#icomp").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
           
	}
);
//**************** ELIMINO competencia con jquery *********************************************/      

//**************** ELIMINO sede con jquery *********************************************/      
$("#btnEliminaSede").click(
	function()
	{ 
			var parametros = {"isede2" : $("#isede2 option:selected").val()}
           
            $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/borrar_sede.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#icomp").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
           
	}
);
//**************** ELIMINO sede con jquery *********************************************/ 

//**************** ELIMINO categoria con jquery *********************************************/      
$("#btnEliminaCat").click(
	function()
	{ 
			var parametros = {"icate" : $("#icate option:selected").val()}
           
            $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/borrar_categ.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', false);
    			location.reload();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#icomp").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
           
	}
);
//**************** ELIMINO categoria con jquery *********************************************/ 

//**************** ELIMINO categoria con jquery *********************************************/      
$("#btnActivarCat").click(
	function()
	{ 
	
			var parametros = {"icate" : $("#icate option:selected").val()}
           
            $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/activar_categoria.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', false);
    			location.reload();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#icomp").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            	
            }
            }); // FIN funcion ajax
           
	}
);
//**************** ELIMINO categoria con jquery *********************************************/ 

}); // parentesis del READY



    
