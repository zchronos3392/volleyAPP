// JavaScript Document PARA EL banner que crece automaticamente...
		// cuando PRESIONO CLICK , LO ACTUALIZO

$(document).ready(function(){
    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
         $("#iclub").empty();
        var iclubes = $("#iclub");
        // esto arreglo el tema del alta triplle..
         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclub").prop('disabled', true);
    			$("#icity").prop('disabled', true);
    		},
            done: function(data){
            	console.log('DONE: ');
				console.log(data);	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
                		//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#iclub').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclub").append('<option value="' + v.idclub + '">' +v.clubabr+'-'+v.nombre + '</option>');
					}		
                });
                $("#iclub").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iclub").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#iclub").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
				$("#iclub").prop('disabled', false);
			}
            }); // FIN funcion ajax CLUBES
//**************** CLUBES *********************************************/            
}); // parentesis del READY



    
