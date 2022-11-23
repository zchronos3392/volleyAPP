<?php include('sesioner.php'); ?>
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Updates varios
		</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   
	   <link rel="stylesheet" href="./css/nsanz_style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!--<script type="text/javascript" src="./css/nsanz_script.js"></script> -->
		<script type="text/javascript" src="./scripts/delupd.js"></script> 
<!--SCRIPTS-->
	   <script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO


function abreventana(boton)
{
	var arraids = boton.id.split('_');
		var idclub = arraids[1] ;
	nombreclub = $("#nombreclub_"+idclub).html();	
			//alert(nombreclub);
	var objeto_window_referencia;
	var configuracion_ventana = "Width=750 , Height= 500, Scrollbars=yes";
		objeto_window_referencia = window.open("https://www.google.com/search?q="+nombreclub+"&client=ms-google-coop&cx=0e7979155b7270dbd&sxsrf=AOaemvJ1GF5gCecMZdhhTOW0X8lGt0QtNw:1635430924344&source=lnms&tbm=isch&sa=X&ved=2ahUKEwjy3bL6pu3zAhW-qZUCHf2PBjUQ_AUoAnoECAEQBA&biw=1536&bih=726&dpr=1.25", "Buscar sugerencias", configuracion_ventana);
}


function cargarimagenes(nombre)
{
	var objeto_window_referencia;
	var configuracion_ventana = "Width=750 , Height= 500, Scrollbars=yes";
	var ubicacion =	"./img/imagenes.php?nombre="+nombre;
		objeto_window_referencia = window.open(ubicacion,"Cargar escudo nuevo",configuracion_ventana);
		
}



		$(document).ready(function()
		{
			 $("#SearchCompetencia").animate({width: "hide"},500);	
			
			// Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
			<?php
			require_once('./abms/SesionTabla.php');
			$ingreso='';
			$graboSesion = SesionTabla::getsession("'".$_SERVER['REMOTE_ADDR']."'");
			if ((int)$graboSesion["sesid"] !=0) {
				echo('var sesion =1;');
				$_SESSION['INGRESO'] ="SI";
			} else {

				$_SESSION['INGRESO'] ="";
				echo('var sesion =0;');
			}
			?>

			if (sesion == 0 )
				location.href='index.php';
			
			$("#iescudosclub").on("change click",function(){
				if($("#iescudosclub").val() == '9999')
					$("#escudo").attr("src","img/jugadorGen.png");
				else
					$("#escudo").attr("src","img/escudos/"+$("#iescudosclub").val());
				});
			

				 $("#btnBuscarLogosVacios").click(function()
				 {
							  event.preventDefault();
							  //alert('analizando clubes sin escudo....');

					         //var parametros = {"idClub" : $("#icluba").val()};	
					         $.ajax({ 
					            url:   './abms/obtener_club_escudosvacios.php',
					            type:  'GET',
					            //data: parametros ,
					            datatype:   'text json',
								// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
					            beforeSend: function (){
									
					    		},
					            done: function(data){
					            	
								},
					            success:  function (r){
									var re = JSON.parse(r);
									$(re['clubes']).each(function(i, v)
									{
										//console.log(v.nombre);	
					var cabecera='<div id="grillasinescudos" name="grillasinescudos"  class="grillasinescudos">';
					var botonSugerir='<div class="grillasinescudositem2"><button id="botonsugerir_'+v.idclub+'" class="btnBuscar" onclick="abreventana(this);">Sugerir</button></div>';
					//var nombreclub = $("#nombreclub_"+v.idclub).html();

					var botonCargar='<div class="grillasinescudositem3">'+
							'<button id="botoncargar_'+v.idclub+'" class="btnBuscar"'+
							' onclick="cargarimagenes(\''+v.clubabr+' \'); " >Cargar</button></div>';
					var imagenpegada='';
//					var imagenpegada='<div class="grillasinescudositem4"><img src="" title="imagenpegada"  ></img></div>';
					var filepegado='';
//					var filepegado='<div class="grillasinescudositem5"><input type="file"></input></div>';					
					$("#grillasinescudosContent").append(cabecera+'<div class="grillasinescudositem1"><div id="nombreclub_'+v.idclub+'" class="nombreclub">'+v.nombre+'</div></div>'+botonSugerir+botonCargar+imagenpegada+filepegado+'</div>');

									});	
					            },
					             error: function (xhr, ajaxOptions, thrownError) 
					             {
								 }
					            });			
							  
							  
				});	
				
				
		  event.preventDefault();
		// ACTUALIZACION DE TABLAS..			
		 $("#ActualizaClub").click(function()
		 {
			 var parametros = {
				 "idClub" : $("#icluba").val(),
					"nombre" : $("#nombre").val(),
					"ciudad" : $("#iciudadclub").val(),
					"clubabr" : $("#clubabr").val(),
					"escudo"  : $("#iescudosclub").val()
				 };	
				 
			 $.ajax({ 
				url:   './abms/actualiza_club.php',
				type:  'POST',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){
					location.reload();
					},
				error: function (xhr, ajaxOptions, thrownError){console.log(thrownError);}
				});
				
		  });//actualiza del ICLUB
		  
		 $("#ActualizaCiudad").click(function()
		 {
			 var parametros = {
				 "idciudad" : $("#icity").val(),
					"ciudadnom" : $("#ciudad").val(),
					"provnom" : $("#provCity").val()
				 };	
			 $.ajax({ 
				url:   './abms/actualiza_ciudad.php',
				type:  'POST',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){location.reload();},
				error: function (xhr, ajaxOptions, thrownError){console.log(thrownError);}
				});
		 });//actualiza del ICIUDAD
		 
		 $("#ActualizaSede").click(function()
		 {
			 var parametros = {
				 "idsede" : $("#isede2").val(),
				 "idclub" : $("#iclubb").val(),
					"snom" : $("#sedenom").val(),
					"direccion" : $("#direxsede").val()
				 };	
			 $.ajax({ 
				url:   './abms/actualiza_sede.php',
				type:  'POST',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){location.reload();},
				error: function (xhr, ajaxOptions, thrownError){console.log(thrownError);}
				});
	     });//actualiza del ISEDE

		 $("#ActualizaComp").click(function()
		 {
			 var parametros = {
				 "idcomp" : $("#icomp").val(),
					"cnombre" : $("#cnombre").val(),
					"setnmax" : $("#SetMaxCate").val()
				 };	
			 $.ajax({ 
				url:   './abms/actualiza_competencia.php',
				type:  'POST',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){location.reload();},
				error: function (xhr, ajaxOptions, thrownError){console.log(thrownError);}
				});
	     });//actualiza del ICOMP			 

		 $("#ActualizaCancha").click(function()
		 {
			 var parametros = {
				 "idsede" : $("#isede3").val(),
				 "idclub" : $("#iclubd").val(),
				 "idcancha" : $("#icancha").val(),
					"ncancha" : $("#nomcancha").val(),
					"direccion" : $("#direc_can").val(),
					"dimensiones" : $("#dimcan").val()
				 };	
			 $.ajax({ 
				url:   './abms/actualiza_cancha.php',
				type:  'POST',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){location.reload();},
				error: function (xhr, ajaxOptions, thrownError){console.log(thrownError);}
				});
		  });//actualiza del ICANCHAS			 
// FIN DE LA ACTUALIZACION DE TABLAS..		 

		 $("#btnBuscarRegClub").click(function()
		 {
		 	 //escondo los otros menues:
		 	 $("#CiudadForm").animate({width: "hide"},200);
			 $("#formCiudad").animate({width: "hide"},200);	
			 $("#Sedesf").animate({width: "hide"},200);
			 $("#Sedessearchf").animate({width: "hide"},200);
			 $("#Competencias").animate({width: "hide"},500);
			 $("#SearchCompetencia").animate({width: "hide"},500);			 
			 $("#Canchasearch").animate({width: "hide"},500);	
			 $("#Canchas").animate({width: "hide"},500);	

			 
			 $("#ClubForm").animate({width: "show"},500);
			 $("#ClubForm").css("display","grid");
				 $("grillasinescudosContent").animate({width: "show"},500);	
				 $("#grillasinescudosContent").css("background-color","#fff");
//				 $("#grillasinescudosContent").css("display","grid");
				 
			 $("#formConfig").animate({width: "show"},500);	
			 $("#ClubForm").css("background-color","#fff");
			 $("#formConfig").css("background-color","#fff");
			 
			 
			 //mantengo el color dorado en este y apago los otros..
			 $("#btnBuscarRegClub").css("background-color","gold");
			 $("#btnBuscarRegCity").css("background-color","#99c2ff");
			 $("#btnBuscarRegCancha").css("background-color","#99c2ff");
			 $("#btnBuscarRegComp").css("background-color","#99c2ff");
			 $("#btnBuscarRegSede").css("background-color","#99c2ff");

			 	
		 });	
		 
		 $("#btnIngresoClub").click(function()
		 {
			 $("#ClubForm").animate({width: "hide"},500);			
			 $("#formConfig").animate({width: "hide"},500);		
		 });	
		 
		 $("#btnBuscarRegCity").click(function()
		 {
		 	// escondo los otros menues:
		 	 $("#ClubForm").animate({width: "hide"},200);			
			 $("#formConfig").animate({width: "hide"},200);
			$("grillasinescudosContent").animate({width: "hide"},500);	
			 
			 $("#Sedesf").animate({width: "hide"},200);
			 $("#Sedessearchf").animate({width: "hide"},200);			 
			 $("#Competencias").animate({width: "hide"},500);
			 $("#SearchCompetencia").animate({width: "hide"},500);	
			 $("#Canchasearch").animate({width: "hide"},500);	
			 $("#Canchas").animate({width: "hide"},500);				 		 
			 
			 $("#CiudadForm").animate({width: "show"},500);
			 $("#formCiudad").animate({width: "show"},500);	
			 
			 $("#CiudadForm").css("background-color","#fff");
			 $("#formCiudad").css("background-color","#fff");
			 
			 
			 //mantengo el color dorado en este y apago los otros..
			 $("#btnBuscarRegClub").css("background-color","#99c2ff");
			 $("#btnBuscarRegCity").css("background-color","gold");
			 $("#btnBuscarRegCancha").css("background-color","#99c2ff");
			 $("#btnBuscarRegComp").css("background-color","#99c2ff");
			 $("#btnBuscarRegSede").css("background-color","#99c2ff");

			 		
		 });	
		 
		 $("#btnBuscarRegCancha").click(function()
		 {
			 $("#ClubForm").animate({width: "hide"},500);			
			 $("#formConfig").animate({width: "hide"},500);
			 					$("grillasinescudosContent").animate({width: "hide"},500);	
		 	 $("#CiudadForm").animate({width: "hide"},200);
			 $("#formCiudad").animate({width: "hide"},200);	
			 $("#Sedesf").animate({width: "hide"},200);
			 $("#Sedessearchf").animate({width: "hide"},200);
			 $("#Competencias").animate({width: "hide"},500);
			 $("#SearchCompetencia").animate({width: "hide"},500);			 		 	
		 	
		 	
			 $("#Canchasearch").animate({width: "show"},500);	
			 $("#Canchas").animate({width: "show"},500);	
			 
			 $("#Canchasearch").css("background-color","#fff");
			 $("#Canchas").css("background-color","#fff");

			 
			 $("#btnBuscarRegClub").css("background-color","#99c2ff");
			 $("#btnBuscarRegCity").css("background-color","#99c2ff");
			 $("#btnBuscarRegCancha").css("background-color","gold");
			 $("#btnBuscarRegComp").css("background-color","#99c2ff");
			 $("#btnBuscarRegSede").css("background-color","#99c2ff");

			 
		 });	
		 
		 $("#btnBuscarRegComp").click(function()
		 {
			 $("#ClubForm").animate({width: "hide"},500);			
			 $("#formConfig").animate({width: "hide"},500);
			$("grillasinescudosContent").animate({width: "hide"},500);				 		
		 	 $("#CiudadForm").animate({width: "hide"},200);
			 $("#formCiudad").animate({width: "hide"},200);	
			 $("#Sedesf").animate({width: "hide"},200);
			 $("#Sedessearchf").animate({width: "hide"},200);
			 $("#Canchasearch").animate({width: "hide"},500);	
			 $("#Canchas").animate({width: "hide"},500);			 	
		 	
			 $("#Competencias").animate({width: "show"},500);
			 $("#SearchCompetencia").animate({width: "show"},500);
			 
			 $("#Competencias").css("background-color","#fff");
			 $("#SearchCompetencia").css("background-color","#fff");
			 

			 
			 $("#btnBuscarRegClub").css("background-color","#99c2ff");
			 $("#btnBuscarRegCity").css("background-color","#99c2ff");
			 $("#btnBuscarRegCancha").css("background-color","#99c2ff");
			 $("#btnBuscarRegComp").css("background-color","gold");
			 $("#btnBuscarRegSede").css("background-color","#99c2ff");

			 			
		 });	
		 
		 $("#btnBuscarRegSede").click(function()
		 {
			 $("#ClubForm").animate({width: "hide"},200);			
			 $("#formConfig").animate({width: "hide"},200);
			$("grillasinescudosContent").animate({width: "hide"},500);				 
		 	 $("#CiudadForm").animate({width: "hide"},200);
			 $("#formCiudad").animate({width: "hide"},200);	
			 $("#Competencias").animate({width: "hide"},500);
			 $("#SearchCompetencia").animate({width: "hide"},500);
			 $("#Canchasearch").animate({width: "hide"},500);	
			 $("#Canchas").animate({width: "hide"},500);	
		 	
		 	
			 $("#Sedesf").animate({width: "show"},500);
			 $("#Sedessearchf").animate({width: "show"},500);	
			 $("#Sedesf").css("background-color","#fff");
			 $("#Sedessearchf").css("background-color","#fff");

			 
			 
			 $("#btnBuscarRegClub").css("background-color","#99c2ff");
			 $("#btnBuscarRegCity").css("background-color","#99c2ff");
			 $("#btnBuscarRegCancha").css("background-color","#99c2ff");
			 $("#btnBuscarRegComp").css("background-color","#99c2ff");
			 $("#btnBuscarRegSede").css("background-color","gold");

		 });	
		 
		 $("#btnBuscarRegCat").click(function()
		 {
			 $("#CategForm").animate({width: "show",},500);					 
		 });
		 	
         $("#icluba").on("change click",function()
         {
         var parametros = {"idClub" : $("#icluba").val()};	
         $.ajax({ 
            url:   './abms/obtener_club_por_id.php',
            type:  'GET',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				
    		},
            done: function(data){
            	
			},
            success:  function (r){
				var re = JSON.parse(r);
                	$("#nombre").val(re['nombre']);
                	$("#clubabr").val(re['clubabr']);
                	$("#iciudadclub").val(re['idciudad']);
                	$("#iescudosclub").val(re['escudo']);
                	  $("#escudo").attr("src","img/escudos/"+re['escudo']);
                	
            },
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });
          });//change del ICLUB
          		 	

         $.ajax({ 
            url:   './abms/obtener_ciudades.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icity").prop('disabled', true);
    			$("#iciudadclub").prop('disabled', true);
    			$("#iciudadclub").empty();
    			$("#iciudadclub").append('<option value="' + '0' + '">' + 'Seleccione Ciudad' + '</option>');
            },
            done: function(data){
			},
            success:  function (r){
                $(r['Ciudades']).each(function(i, v)
                { // indice, valor
                    if (! $('#icity').find("option[value='" + v.idCiudad + "']").length)
                	{		
                    $("#icity").append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
					}
                    if (! $('#iciudadclub').find("option[value='" + v.idCiudad + "']").length)
                	{		
                    $("#iciudadclub").append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
					}
					
                });
                $("#icity").prop('disabled', false);
    			$("#iciudadclub").prop('disabled', false);

            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icity").append('<option value="' + '9999' + '">' + 'JQERY:Tabla Ciudades vacia' + '</option>');
			$("#iciudadclub").append('<option value="' + '9999' + '">' + 'JQERY:Tabla Ciudades vacia' + '</option>');			
			$("#icity").val('9999');
				$("#icity").prop('disabled', false);
			$("#iciudadclub").val('9999');
				$("#iciudadclub").prop('disabled', false);				
			}
          }); // FIN funcion ajax para CIUDADES
          
		  // on change icity		 		 
         $("#icity").on("change click",function()
         {
         var parametros = {"idcity" : $("#icity").val()};	
         $.ajax({ 
            url:   './abms/obtener_ciudad_por_id.php',
            type:  'GET',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				
    		},
            done: function(data){
            	
			},
            success:  function (r){
    			var re = JSON.parse(r);
				$("#ciudad").val(re["nombre"]);
	            $("#provCity").val(re["provincia"]);
				
            },
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });
          });//change del ICLUB		 		 
		 		 
//**************** COMPETENCIAS *********************************************/            
         $.ajax({ 
            url:   './abms/obtener_comps.php',
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
                $(r['Competencias']).each(function(i, v)
                { // indice, valor
                	if (! $('#icomp').find("option[value='" + v.idcomp + "']").length)
                	{
						$("#icomp").append('<option value="' + v.idcomp + '">' + v.cnombre + '</option>');
					}		
                });
           },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icomp").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#icomp").val('9999');
			}
            }); // FIN funcion ajax COMPETENCIAS
            
         $("#icomp").on("change click",function()
         {
         var parametros = {"idcomp" : $("#icomp").val()};	
         $.ajax({ 
            url:   './abms/obtener_comp_por_id.php',
            type:  'GET',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				
    		},
            done: function(data){
            	
			},
            success:  function (r){
    			var re = JSON.parse(r);
				$("#cnombre").val(re["cnombre"]);
	            $("#SetMaxCate").val(re["se  tnmax"]);
	            if(competenciaActiva == 1)
	            	$("#SetActivo").attr(' checked', true);
				
            },
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });
          });//change del Icomp	            
            		 		 
         $("#isede2").on("change click",function()
         {
         var parametros = {"idsede" : $("#isede2").val(),"idclub" : $("#iclubb").val()};	
         $.ajax({ 
            url:   './abms/obtener_sede_por_id.php',
            type:  'GET',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				
    		},
            done: function(data){
            	
			},
            success:  function (r){
    			var re = JSON.parse(r);
				$("#iclubc").val($("#iclubb").val());
	            $("#sedenom").val(re["extras"]);
	            $("#direxsede").val(re["direccion"]);
				
            },
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });
          });//change del ISEDE2 // SEDES
          		 		 
//**************** CANCHAS OBTENER *********************************************/            
// necesito traer las canchas !!!!						 
// canchas seleccion y carga en campos						 
$("#isede3").on("change click",function()
{
	//console.log('llamando a $("#isede3").on("change click"');
	$("#icancha").empty();
	 var parametros = {"idsede" : $("#isede3").val(),"idclub" : $("#iclubd").val()};	
	 $.ajax({ 
			url:   './abms/obtener_cancha_sede.php',
			type:  'GET',
			dataType: 'json',
			data:parametros,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
			beforeSend: function (){},
			done: function(data){},
			success:  function (r){
				//var re = JSON.parse(r);
				//console.log(r);
				$(r['Canchas']).each(function(i, v)
				{ // indice, valor
				  if (! $('#icancha').find("option[value='" + v.idcancha + "']").length)
					{
						//console.log(v.idcancha+' '+v.clubabr+' - '+ v.extras+' - '+ v.nombre);
					  $("#icancha").append(
					  '<option value="' + v.idcancha + '">' +
					  		v.clubabr+' - '+ v.extras+' - '+ v.nombre +
					   '</option>');
					}
				});
				$("#icancha").prop('disabled', false);
		   },
			 error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icancha").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#icancha").val('9999');
			}
		}); // FIN funcion ajax CANCHAS todas:						 
});//change del ISedes3 - para cargar las canchas de la sede

// falta el seleccion de la cancha, para cargar los campos..icancha
         $("#icancha").on("change click",function()
         {
         	 var parametros = {"idsede" : $("#isede3").val(),"idclub" : $("#iclubd").val(),"idcancha" : $("#icancha").val()};	
         $.ajax({ 
            url:   './abms/obtener_cancha.php',
            type:  'GET',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				
    		},
            done: function(data){
            	
			},
            success:  function (r){
    			var re = JSON.parse(r);
				if(re.nombre != 'Sin categorias aun')
				{
					$("#nomcancha").val((re['Canchas']["nombre"]));
		            $("#direc_can").val((re['Canchas']["ubicacion"]));
					$("#dimcan").val((re['Canchas']["dimensiones"]));
				}
				
            },
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });
          });//change del icancha

// falta el seleccion de la cancha, para cargar los campos..		  
   });//document ready
		 
		</script>		
		
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>

<section id="acciones" name="acciones" class="acciones">
	<div id="ren" name="ren" class="ren"><input type="button" id="btnBuscarRegClub"   name="btnBuscarRegClub" value="Club" class="btnBuscar2" /></div>
	<div id="ren" name="ren" class="ren"><input type="button" id="btnBuscarRegCity"   name="btnBuscarRegCity" value="Ciudad" class="btnBuscar2"></input></div>
	<div id="ren" name="ren" class="ren"><input type="button" id="btnBuscarRegCancha"   name="btnBuscarRegCancha" value="Cancha" class="btnBuscar2"></input></div>
	<div id="ren" name="ren" class="ren"><input type="button" id="btnBuscarRegComp"   name="btnBuscarRegComp" value="Competencia" class="btnBuscar2"></input></div>
	<div id="ren" name="ren" class="ren"><input type="button" id="btnBuscarRegSede"   name="btnBuscarRegSede" value="Sede" class="btnBuscar2"></input></div>
</section>	
<section class="gridClub2 hidden">
<div class="icc12">
	<!-- visualizacion de carga -->		
	<form id="formConfig" name="formClubess" class="hidden">

	<section id="busque" name="busque" class="busque2">
		<div class="busqueitem1"><label for="itextbuscar">Buscar</label></div>	
		<div class="busqueitem2"><input type="text" id="itextAbuscar" name="itextAbuscar" class="inputSearch"/></div>
	 	<div class="busqueitem3"></div>
	 	<div  class="busqueitem4"><button id="btnEliminaClub"   name="btnEliminaClub" value="..." class="btnDel">-</button></div>
	 	<div class="busqueitem5"><button id="btnBuscarLogosVacios"   name="btnBuscarLogosVacios" value="Buscar clubes sin escudo" class="btnBuscar grande">Escudos Vacios</button></div>
		<div class="busqueitem6"><label for="icluba">Clubes cargados</label></div>
		<div class="busqueitem7" id="busqueitem7">    <select id="icluba" name="icluba" class="selectitem7"></select></div>
	</section>
	 	
	</form> 



	<!-- visualizacion de carga -->		
<div  id="ClubForm" name="ClubForm" class="hidden"><!-- clubes -->
 <div class="ffclubes">
		<div class="ffclubes1"><label for="escudo">Escudo</label></div>
		<div class="ffclubes2">
				<select id="iescudosclub" name="iescudosclub">
				<option value="9999">Seleccionar escudo</option>
				<?php 
					$imagenEncontrada = scandir('./img/escudos/');
					
					foreach($imagenEncontrada as $indice => $valor)
						if($valor != "." && $valor != ".." && $valor != "" )
					  			echo "<option value='$valor'>$valor</option>";
				?>
			</select>
		</div>	
		<div class="ffclubes3">
			<img  src="img/jugadorGen.png" class="imgjugador" id="escudo"></img>
	    </div>		
	<div class="ffclubes4">
		<label for="nombre">Nombre club</label>
	</div>	
	<div class="ffclubes5">
		<input id="nombre" name="nombre" type="text"></input>
	</div>
		<div class="ffclubes51">
			<label for="iciudadclub">ciudad</label>
		</div>
		<div class="ffclubes52">
			<select id="iciudadclub" name="iciudadclub"  class="SelList"></select>
		</div>				
	<div class="ffclubes6"><label for="clubabr">abreviatura</label></div>
	<div class="ffclubes7"><input id="clubabr"	name="clubabr" type="text"></input></div>
	<div class="ffclubes8">
		<button id="ActualizaClub"   name="ActualizaClub" value="Actualiza" class="btnBuscar">(+/-)</button>
	</div>
 </div>
</div>	 

<!-- LISTADO DE CLUBES SIN ESCUDO... -->	
<div id="grillasinescudosContent" name="grillasinescudosContent"  class="grillasinescudosContent"></div>

</div>

</section>		

<section class="gridClub2 hidden">
  <div class="icc12">
<!-- visualizacion de carga -->		
 	<form id="formCiudad" name="formCiudad" class="formCiudad hidden">
 	<section id="busque"  class="busque">
	 	<div><label for="itext2">Buscar</label></div>	
	 	<div><input type="text" id="itext2" name="itext2" class="inputSearch"/></div>
	 	<div><button id="btnBuscarCity"   name="btnBuscarCity" value="..." class="btnBuscar">Sape...</button></div>
	 	<div><button id="btnEliminaCity"   name="btnEliminaCity" value="..." class="btnDel">Eliminar...</button></div>
 	</section>
	<div>
		<label for="icity">Ciudades cargadas</label>
		<select id="icity" class="SelList"></select>
	</div>
 	</form>
 	<div id="CiudadForm" name="CiudadForm" class="formConfig hidden">
    <label for="ciudad"  class="">Ciudad</label>
    	<input id="ciudad"  name="ciudad" type="text">
	<label for="provCity" class="">Provincia</label>
    	<input id="provCity" name="provCity" type="text">
    	<!--<select name="provCity" class="SelListC"><option value="000">Sel provincia</option></select>-->
<button id="ActualizaCiudad" name="ActualizaCiudad" class="btnIngreso">Actualiza Ciudad</button>	
	</div>
	
</div>
</section>
<!-- SEDES -->
<section class="gridClub2 hidden top">
  <div class="icc12">
<!-- visualizacion de carga -->		
 	<form id="Sedessearchf" name="Sedessearchf" class="formSedes hidden">
	<section id="busque" name="busque" class="busque">
	 	<div><label for="itext3">Buscar</label></div>	
	 	<div><input type="text" id="itext3" name="itext3" class="inputSearch"></div>
	 	<div><button id="btnBuscarSedes" name="btnBuscarSedes" value="..." class="btnBuscar">Sape...</button></div>
 	</section>	
    <label for="iclubb">Club</label>
	    <select id="iclubb" name="iclubb" class="SelList"> 
	        <option value="9999" selected="">Seleccione un club</option>
	    </select>
	<button id="btnBuscarSede"   name="btnBuscarSede" value="..." class="btnBuscar">Sape...</button>
	<button id="btnEliminaSede"   name="btnEliminaSede" value="..." class="btnBuscar">Eliminar...</button>
	
	<div>
	<label for="isede2">Sedes cargadas</label>
	    <select id="isede2" name="isede2" class="SelList"> 
	        <option value="9999" selected="">Seleccione una Sede</option>
	    </select>
    </div>
  </form>
	 	
 	<div id="Sedesf" name="Sedesf" class="formConfig hidden">
		<p>
		<label for="iclubc">Club</label>
		<select id="iclubc" class="SelList"></select>
    	</p>
		<p><!-- el POST SOLO VE LO QUE TIENE NAME, sino no lo ve.-->
			<label for="sedenom">Nombre sede</label>
			<input id="sedenom" name="sedenom" type="text">
		</p>
		<p>
			<label for="direxsede">direccion</label>
			<input id="direxsede" name="direxsede" "text"="">
		</p>
		<p>
			<button id="ActualizaSede" name="ActualizaSede" value="actualiza sede" class="btnIngreso">Actualiza sede...</button>
		</p>	
	</div>
		
</div>
</section>
<!-- SEDES -->

<!-- COMPETENCIAS -->
<section class="gridClub2 hidden top">
<div class="icc2">
	<form id="Competencias" name="Competencias" class="hidden">
		<section id="busque" class="busque">
		<div><label for="itext4">Buscar</label></div>	
		<div><input type="text" id="itext4" name="itext4" class="inputSearch"></div>
		<div><button id="btnBuscarComp" name="btnBuscarComp" value="..." class="btnBuscar">Sape...</button></div>
	</section>
	<select id="icomp" class="SelList"> 
		<option value="999" selected="">Seleccione una Competencia</option>
	</select>
	</form>


<!-- 	<div id="SearchCompetencia" name="SearchCompetencia" >-->
	  <section id="SearchCompetencia">	
	  	  <h3>Ingreso de Competencias</h3>
	 	<form id="formConfig" name="formCategoria" class="formCategoria" enctype='multipart/form-data'>
			<button type="submit" id="AltaComp" name="AltaComp" >+</button>
	    	<label for="cnombre"  class="">Nombre</label>
	    	<input id="cnombre"  name="cnombre" type="text">
	    	 <p>
	    	 <div class="GridConfigCompes">
		    	 <div class="gridcCompesIt1">
			    	 Max Cant. Sets
		    	 </div>	
		    	<div class="gridcCompesIt2">
		    		<input type="text" id="SetMaxCate" name="SetMaxCate" class="inputSets" />
		        </div>
		        <div class="gridcCompesIt3">
		    	 	Activo
		    	 </div>
		        <div class="gridcCompesIt4">
		    	 	<input type="checkbox" id="SetActivo" name="SetActivo" class="inputSets" />
		    	 </div>
		        <div class="gridcCompesIt5">

				<div class="grillaFormularioHojas">
					<div  class="itemform1">Seleccionar logo<input type="file" value="" name="miLogo" id="miLogo"/>
					</div>
				</div>
		    	 </div>
	    	 </div>
	    	 </p>
		</form>
	</section>
<!--	</div> -->
		
</div>
</section>

<!--COMPETENCIAS -->

<!-- CANCHAS-->
  <section class="gridClub2 hidden top">	
		<form id="Canchasearch" name="Canchasearch" class="hidden">
		<section id="busque" name="busque" class="busque">
		 	<div><label for="itext5">Buscar</label></div>	
		 	<div><input type="text" id="itext5" name="itext5" class="inputSearch"/></div>
		 	<div><button id="btnBuscarCancha"   name="btnBuscarCancha" value="..." class="btnBuscar">Sape...</button></div>
	 	</section>	
		
			<label for="iclubd" class="">Club</label>
			<select id="iclubd" name="iclubd" class="SelList"> 
		        	<option value="9999" selected>Seleccione un club</option>
			</select> 
		    <p></p><label for="isede3" class="">Sedes</label></p>
		    <select id="isede3" name="isede3" class="SelList"> 
		        <option value="9999" selected>Seleccione una Sede</option>
		    </select>     
				<p>
					<select id="icancha" name="icancha" class="SelList">
						<option value="9999" selected>
							Seleccione una Cancha...
						</option>
					</select>
				</p>
		</form>
		<div id="Canchas" name="Canchas" class="formCanchas hidden">	
			<label for="nomcancha" class="">Cancha nombre</label>
			<input id="nomcancha" name="nomcancha"   type="text">
			<label for="direc_can" class="">Ubicación</label>
			<input id="direc_can" name="direc_can" type="text">
			<label for="dimcan" class="">Dimensiones</label>
			<input id="dimcan" name="dimcan" type="text">
		<button id="ActualizaCancha" name="ActualizaCancha">Act. Cancha</button>
		</div>
		
</section>

<!-- CANCHAS-->



</body>
</html>

