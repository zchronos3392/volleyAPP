// JavaScript Document PARA EL banner que crece automaticamente...
		// cuando PRESIONO CLICK , LO ACTUALIZO

// $(document).ready(function(){
//     // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
//          $("#ietats").empty();
//         // esto arreglo el tema del alta triplle..
//          $.ajax({ 
//             url:   './abms/obtener_estados.php',
//             type:  'GET',
//             dataType: 'json',
// 			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
//             beforeSend: function (){
// 				// Bloqueamos el SELECT de los cursos
//     			$("#ietats").prop('disabled', true);
//        		},
//             done: function(data){
            	
// 			},
//             success:  function (r){
//             	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
//                	// DESBloqueamos el SELECT de los cursos
// 				// Limpiamos el select
// 				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
//                 $(r['Estados']).each(function(i, v)
//                 { // indice, valor
//                 		//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
//                 		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
//                 	if (! $('#ietats').find("option[value='" + v.idestado + "']").length)
//                 	{
// 						$("#ietats").append('<option value="' + v.idestado + '" label="'+v.descripcion+'">' + v.descripcion + '</option>');
// 					}		
//                 });
//                 $("#ietats").prop('disabled', false);
//             },
//              error: function (xhr, ajaxOptions, thrownError) {
// 			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
// 			$("#ietats").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
// 			$("#ietats").val('9999');
// 			$("#ietats").prop('disabled', false);
// 			}
//             }); // FIN funcion ajax CLUBES
// //**************** CLUBES *********************************************/   

//**************** CLUBES *********************************************/            
$("#AltaEtats").click(function(e){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        if(($("#estados").val() != ''))
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
        	"estados" : $("#estados").val()
		};		         
         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_estado.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#ietats").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#ietats").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#ietats").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
    }); // parentesis el .CLICK BTNINGRESO




    
