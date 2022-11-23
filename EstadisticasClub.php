<?php include('sesioner.php');
require ('./abms/Jugador.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Jugadores
		</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	   <!--SCRIPTS-->
	   <script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO

/*
function ObtenerJugadores(paginaPedida,quienLLama){
// la funcion phph obtener_jugadores necesita: 
// valor del campo iclubescab,
// valor del campo ianio
// valor del campo icatcab	
var parametros = {"iclubescab1" : $("#iclubescab").val(),"icatcab1" : $("#icatcab").val(),"ianio":$("#ianio").val(),"pag":paginaPedida,"xnombre":$("#ijugclub").val(),"xnomAll" : $("#ijugclubAll").val() };

	console.log("pagina pedida: "+ paginaPedida +" " +$("#iclubescab").val());
	console.log("pagina pedida: "+ paginaPedida +" " +$("#icatcab").val());
	console.log("pagina pedida: "+ paginaPedida +" " +$("#ianio").val());		
    console.log("pagina pedida: "+ paginaPedida +" " +$("#ijugclub").val());

$.ajax({ 
url:   './abms/obtener_jugadores.php',
type:  'GET',
data: parametros,
dataType: 'text json',
// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
beforeSend: function (){
	$("#cargajug").empty('');
	$("#regsj").empty('');
			if( quienLLama != "ijugclub")
			{
				 $("#ijugclub").empty('');
				 $("#ijugclub").append('<option value="9999">Seleccionar nombre jugador</option>');
			//alert(quienLLama); 
			}
},
done: function(data){
		
},
success:  function (r){
   //{"id":2,"nombre":"Sin jugadores cargados para el a\u00f1o: 9999"}
	if(r['nombre'] != 'Sin jugadores cargados') {
	$("#regsj").text('');
	$("#regsj").append('<div id="regridjug1" class="regridjug1">'+
				'<div class="regjug11">Accion</div>'+
				'<div class="regjug12">Accion</div>'+
				'<div class="regjug13">Puesto</div>'+
				'<div class="regjug135">Club</div>'+
				'<div class="regjug14">Numero</div>'+
				'<div class="regjug15">Nombre jugador</div>'+
				'<div class="regjug16">Categoria Inicio</div>'+
				'<div class="regjug17">Categoria Actual</div>'+	
				'<div class="regjug175">Año</div>'+	
				'</div>');
	//$("#contador").val($("#icatcab").find('option:selected').attr("name"));
	if( r['Jugadores'].length != 'undefined')
	{
		$("#contador").val(r['Jugadores'].length);
		var contadorRegistros = r['Jugadores'].length;
	}
	else $("#contador").val(0);
	}
	
	$(r['Jugadores']).each(function(i, v)
	{ // indice,0 valor
	    $('[name="ijugclubFull"]').show();
		var eliminarJugador = '';
		eliminarJugador  = '<div class="EliminarJugClass">';
				eliminarJugador  += '<button  name="eliminarJugador" title="eliminarJugador" class="butSquareEqOrang" onClick="eliminarJugadorX('+v.idclub+','+v.idjugador+','+v.anioEquipo+','+v.categoria+');" >(X)</button></div>';
	var modificaJugador  = '';	
		modificaJugador  = '<div class="ModificarJug">';
		modificaJugador  += '<button  name="modificaJugador" title="Modificar Jugador" class="butSquareEqBlu" onClick="modifcarJugadorX('+v.idclub+','+v.idjugador+','+v.anioEquipo+','+v.categoria+');" >(/)</button></div>';

				//$("#GridControlPaginador").css("display","none");

			$("#regsj").append(
				'<div id="regridjug1" class="regridjug1">'+
				'<div class="regjug11">'+eliminarJugador+'</div>'+
				'<div class="regjug12">'+modificaJugador+'</div>'+
				'<div class="regjug13"><select id=\'sjugadorp_'+v.idjugador+'\' name=\'sjugadorp_'+v.idjugador+'\' disabled=\'true\'></select>'+creaspuestos(v.idjugador,v.puestoxcat)+'<input type="hidden" id="numero1" name="nume" value="'+v.numero+'" ></input><input type="hidden" id="nombre1" name="nom1" value="'+v.nombre+'" ></input></div>'+
				'<div class="regjug135">'+v.ClubNombre+'</div>'+
				'<div class="regjug14">'+v.numero+'</div>'+
				'<div class="regjug15">'+v.nombre+'</div>'+
				'<div class="regjug16">'+v.CategoriaInicio+'</div>'+
				'<div class="regjug17">'+v.CategoriaActual+'</div>'+
				'<div class="regjug175">'+v.anioEquipo+'</div>'+	
				'</div>');
		//	
//		if( ! $("#ijugclub option").length > 0)
		if( quienLLama != "ijugclub")
				$("#ijugclub").append('<option value="' + v.nombre + '">' +v.nombre + '</option>');

	});
	if( quienLLama != "ijugclub")
			$("#ijugclub").val('9999');
	//alert(r['TotalPaginas']);
	//armar links paginador...
	var tamanioPaginar = r['tamanio'];
	if(r['TotalPaginas'] > 1 && ( (contadorRegistros > tamanioPaginar) || !(pagActual == Ultima) ) )
	{
		$("#GridControlPaginador").css("display","grid");
		if(paginaPedida != 0)
				pagActual = paginaPedida;
		else pagActual = r['paginaPedida'];
		
		Ultima = r['TotalPaginas'];
		pagSiguiente = pagActual + 1;
		pagAnterior = pagActual - 1;	
		if(pagActual == 1)
		{
		$("#itemcontrolpag1").html("");
		$("#itemcontrolpag2").html("");
		$("#itemcontrolpag3").html("Pag Nro "+pagActual);
		$("#itemcontrolpag4").html("<a href=\"\" title=\"Pag. Sig.\"  onclick=\"ObtenerJugadores("+pagSiguiente+","+quienLLama+");\">Siguiente ></a>");
		
		$("#itemcontrolpag5").html("<a href=\"\" title=\"Ultima pag\"  onclick=\"ObtenerJugadores("+Ultima+","+quienLLama+");\">Ultima >></a>");			
		}
		else {
					//console.log(pagActual);
				if(pagActual == Ultima)
				{
				$("#itemcontrolpag1").html("");
				$("#itemcontrolpag1").html("<a href=\"\" title=\"Primer pag\"  onclick=\"ObtenerJugadores(1,"+quienLLama+");\"><< Primero</a>");
				$("#itemcontrolpag2").html("");
				$("#itemcontrolpag2").html("<a href=\"\" title=\"Pag Ant.\"  onclick=\"ObtenerJugadores("+pagAnterior+","+quienLLama+");\">< Anterior</a>");
				$("#itemcontrolpag3").html("");
				$("#itemcontrolpag3").html("Ultima Pag ("+paginaPedida+")");
				$("#itemcontrolpag4").html("");
				$("#itemcontrolpag5").html("");
				}	
				else {
				$("#itemcontrolpag1").html("");
				$("#itemcontrolpag1").html("<a href=\"\" title=\"Primer pag\"  onclick=\"ObtenerJugadores(1"+quienLLama+");\"><< Primero</a>");
				$("#itemcontrolpag2").html("");
				$("#itemcontrolpag2").html("<a href=\"\" title=\"Pag Ant.\"  onclick=\"ObtenerJugadores("+pagAnterior+","+quienLLama+");\">< Anterior</a>");
				$("#itemcontrolpag3").html("");
				$("#itemcontrolpag3").html("Pag Nro "+paginaPedida);
				$("#itemcontrolpag4").html("");
				$("#itemcontrolpag4").html("<a href=\"\" title=\"Pag. Sig.\"  onclick=\"ObtenerJugadores("+pagSiguiente+","+quienLLama+");\">Siguiente ></a>");
				$("#itemcontrolpag5").html("");
				$("#itemcontrolpag5").html("<a href=\"\" title=\"Ultima pag\"  onclick=\"ObtenerJugadores("+Ultima+","+quienLLama+");\">Ultima >></a>");			
				}
		}
	}
	else 
	{
	 $("#GridControlPaginador").css("display","none");
	}
},
 error: function (xhr, ajaxOptions, thrownError) {
// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
	console.log(thrownError);
		console.log(xhr.responseText);
}
}); // FIN funcion ajax categorias	
event.preventDefault();
}
*/
function  buscarImagenClub(){
 var parametros = {"idClub" : $("#iclubescab").val()};	
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
        	  $("#imagenclub").attr("src","img/escudos/"+re['escudo']);
        	
    },
     error: function (xhr, ajaxOptions, thrownError) 
     {
	 }
    });
  }	
  
function obtenerStats1Club(){

var parametros = {"OPCION":'JUGENCAT',"aniofiltro":$("#ianio").val(),"clubefiltro":$("#iclubescab").val()};
	 $.ajax({ 
		url:   './abms/obtener_stats.php',
		type:  'GET',
		data: parametros,
		dataType: 'text json',
		// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		beforeSend: function (){
				$("#contenidoStats1").empty();
				$("#contenidoStats1").append("<div id='' class='eclubcats' ><div class='itemeclubcats1 subRayado' >CATEGORIA</div><div class='itemeclubcats2 subRayado' >CANTIDAD DE JUGADORES</div><div class='itemeclubcats3 subRayado' >AÑO</div></div>");					
		},
		done: function(data){

		},
		success:  function (r){
			$(r['Stats1']).each(function(i, v)
			{ // indice,0 valor
			if (! $('#contenidoStats1').find("div[value='" + v.descripcion + "']").length)			
			{ 
				$("#contenidoStats1").append("<div id='' class='eclubcats' >"+
											  "<div class='itemeclubcats1 erenglon' value='"+v.descripcion+"'>"+v.descripcion+"</div>"+	
					    					  "<div class='itemeclubcats2 erenglon'>"+v.CantJug+"</div>"+
					    					  "<div class='itemeclubcats3 erenglon' >"+$("#ianio").val()+"</div>"+					    
											   "</div>"	);								
		    }
		   });	
		},
         error: function (xhr, ajaxOptions, thrownError) {}
	}); // FIN funcion ajax jugador
        return false;
}

function obtenerStats2Club(){

//formato fecha que tiene que llegar a la consulta : 2021-12-31

	anio = $("#ianio").val();
	fdesde=anio+'-01-01';
	fhasta=anio+'-12-31';

var parametros = {"fdesde":fdesde,"fhasta":fhasta,"iclub":$("#iclubescab").val()};
	 $.ajax({ 
		url:   './abms/obtener_partidosClub.php',
		type:  'GET',
		data: parametros,
		dataType: 'text json',
		// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		beforeSend: function (){
				$("#contenidoStats2").empty();
				
				$("#contenidoStats2").append("<div id='' class='epartrats' > <div class='itemepartrats1 subRayado' >FECHA</div>"+
										"<div class='itemepartrats2 subRayado' >COMPETENCIA</div>"+	
										"<div class='itemepartrats3 subRayado' >CLUB LOCAL / VISITANTE</div>"+	
										"<div class='itemepartrats4 subRayado' >RESULTADO</div>"+
										"<div class='itemepartrats5 subRayado' >GANADOR</div></div>");		

		},
		done: function(data){

		},
		success:  function (r){

			if (! $('#contenidoStats2').find("div[value='PartidosTotal_"+r['registros']+"']").length)			
			{ 
			
			$("#contenidoStats2").append("<div id='' class='epartrats' > <div class='itemepartrats1 subRayado' value='PartidosTotal_"+r['registros']+"' > Partidos Total "+r['registros']+"</div>"+
										"<div class='itemepartrats2 subRayado' > Ganados: "+r['ganados']+"</div>"+	
										"<div class='itemepartrats3 subRayado' > Perdidos "+r['perdidos']+"</div>"+	
										"<div class='itemepartrats4 subRayado' >Otros "+r['noinfo']+"</div>"+
										"<div class='itemepartrats5 subRayado' ></div></div>");		
			}
			$(r['Stats2']).each(function(i, v)
			{ // indice,0 valor
			if (! $('#contenidoStats2').find("div[value='" +v.Fecha+'_'+ v.idPartido + "']").length)			
			{ 
			
				$("#contenidoStats2").append("<div id='' class='epartrats' >"+
											"<div class='itemepartrats1 erenglon' id='idpartido' value="+v.Fecha+'_'+v.idPartido+"></div>"+	
											"<div class='itemepartrats1 erenglon'>"+v.Fecha+"</div>"+	
											"<div class='itemepartrats2 erenglon'>"+v.cnombre+"</div>"+	
											"<div class='itemepartrats3 erenglon'>"+v.ClubA+' / '+v.ClubB+"</div>"+	
							    			"<div class='itemepartrats4 erenglon'>( "+v.ClubARes+'-'+v.ClubBRes+" )</div>"+
							    			"<div class='itemepartrats5 erenglon' >"+v.Ganador+v.descripcion+"</div></div>"
					);								
		    }
		   });	

		},
         error: function (xhr, ajaxOptions, thrownError) {}
	}); // FIN funcion ajax jugador
        return false;
}

  
function parametroURL(_par) {
  var _p = null;
  if (location.search) location.search.substr(1).split("&").forEach(function(pllv) {
    var s = pllv.split("="), //separamos llave/valor
      ll = s[0],
      v = s[1] && decodeURIComponent(s[1]); //valor hacemos encode para prevenir url encode
    if (ll == _par) { //solo nos interesa si es el nombre del parametro a buscar
      if(_p==null){
      _p=v; //si es nula, quiere decir que no tiene valor, solo textual
      }else if(Array.isArray(_p)){
      _p.push(v); //si ya es arreglo, agregamos este valor
      }else{
      _p=[_p,v]; //si no es arreglo, lo convertimos y agregamos este valor
      }
    }
  });
  return _p;
}

		
		$(document).ready(function(){
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
				// CONTROL DE SECION ACTIVA
				if (sesion == 0 )
					location.href='index.php';
				// stopwatchjquery
						
		var iclubescab = parametroURL('iclubescab');	
		var icatcab    = parametroURL('icatcab');
		
// TRAER IMAGEN DEL CLUB
			$("#iclub").on("keypress, keydown, keyup, change, click", function(e) {
  				var code = e.keyCode || e.which;
			         	buscarImagenClub();
			         	obtenerStats1Club();
						obtenerStats2Club();
						
			});

/*
         $("#iclubescab").on("change click",function()
         {

          });//change del ICLUB		
*/
// TRAER IMAGEN DEL CLUB
		
		
		 // FUNCION ajax trae CLUBES QUE TIENEN JUGADORES ESTE AÑO..
		 var parametros = {"ianio":$("#ianio").val(),"todxs":$("#todxs").val()};
         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
            data:parametros,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclubescab").prop('disabled', true);
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
              	if (! $('#iclubescab').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclubescab").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					}		
                });
                $("#iclubescab").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iclubescab").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#iclubescab").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#iclubescab").prop('disabled', false);
			}
            }); 
			// FIN funcion ajax CLUBES

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/   
$("#itextbuscar").keyup(function()
	//	on("keyup keydown",function()
         {   
			var parametros = {
	        	"llamador" : "ESTADISTICASCLUB",
	        	"funcion" : "buscarclubStats",			
	        	"filtro" : $("#itextbuscar").val(),
				"ianio":$("#ianio").val(),
				"todxs":$("#todxs").val()	        	
				};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$('#iclubescab').empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#iclubescab').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclubescab").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
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

			
			var f=new Date();
			var fechapartido = f.getFullYear()-1 ;
			fechainicial = fechapartido -10;
			fechaFinal   = fechapartido +1;
			for (var i = fechainicial; i < fechaFinal; i++) 
			{
				if(i == fechapartido) {$("#ianio").prepend('<option selected>' + (i + 1) + '</option>');$("#anioactivo").val(i + 1);}
				else  $("#ianio").prepend('<option>' + (i + 1) + '</option>');
			}
			
			
			$('#ianio').on("click change",function(){
			//buscar jugadores solo por AÑO, SIN CLUB NI CATEGORIA...(trae todos)
				pagPedida=0;
	         	obtenerStats1Club();
	         	obtenerStats2Club();
	         	return false;
				//console.log('ianio');
				//ObtenerJugadores(pagPedida,'ianio');
			});			
 
		}); // parentesis del READY

		</script>
    </head>
    <body>
		<?php include('includes/newmenu.php'); ?>
    
<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->
		<form id="estClubes" class="estClubes" name="estClubes" >
			<!-- CABECERA DE SELECCION DE VALORES IGUALES-->
			<div class="GridControlEstadisticas">
			<div id="" class="EstadA0" >
		 	<section id="busque" name="busque" class="busque">
			 	<div><label for="itext">Buscar</label></div>	
			 	<div><input type="text" id="itextbuscar" name="itext" class="inputSearch"/></div>
			 	<div></div>
			 	<div></div>
		 	</section>
			</div>
			<!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->
				<div id="" class="EstadA" >
					  <div id="" class="clubLatIzq" >
							<div class="itemclubliz1">
								<img id="imagenclub" src="img/jugadorGen.png" class="imgClub"></img>
							</div>
					  <div class="itemclubliz2"></div>
					  <div class="itemclubliz3"></div>
					</div>
				</div>
  			    <div id="" class="EstadB" ><!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
	  			      <div id="" class="clubLatDer" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..--> 
						<div class="itemclublde1" > 
							<div class="clubdata">
								<div class="clubdata1">
									Club
								</div>
								<div class="clubdata2">
							    	<select id="iclubescab" name="iclubescab" class="SelectClubStat">
										<option value="9999">Seleccionar club</option>
									</select>
								</div>
							</div>
						</div>	
					    <div class="itemclublde2" >
							<div class="clubdatb">
								<div class="clubdatb1">Año</div>	
								<div class="clubdatb2">
									<select id="ianio" name="ianio" class="ianio">
										<option value="9999">Seleccionar año...</option>
									</select>
								</div>	
					    	</div>
						</div>
						</div>		
			</div>	<!-- FIN ESTAB-->						
			</div> <!-- fin control estadisticas -->	
					
			<!-- PRIMER CONTENIDO DE ESTADISTICAS, CATEOGRIAS CON JUGADORES -->
					<div id="contenidoStats1" class="contenidoStats1">
					<div id="" class="eclubcats" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..--> 
								<div class="itemeclubcats1 subRayado" >CATEGORIA</div>	
							    <div class="itemeclubcats2 subRayado" >CANTIDAD DE JUGADORES</div>
							    <div class="itemeclubcats3 subRayado" >AÑO</div>
					</div>		    
					<div id="" class="eclubcats" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..--> 
								<div class="itemeclubcats1 erenglon">CATEGORIA LISTADA</div>	
							    <div class="itemeclubcats2 erenglon">CANTIDAD DE JUGADORES LISTADO </div>
							    <div class="itemeclubcats3 erenglon" >AÑO LISTADO </div>					    
					</div>
					</div>	
					<!-- PRIMER CONTENIDO DE ESTADISTICAS, CATEOGRIAS CON JUGADORES -->				
			
			<!-- SEGUNDO CONTENIDO DE ESTADISTICAS, PARTIDOS EMPATADOS, GANADOS , PERDIDOS -->
					<div id="contenidoStats2" class="contenidoStats2">
					<div id="" class="epartrats" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..--> 
								<div class="itemepartrats1 subRayado" >FECHA</div>	
								<div class="itemepartrats2 subRayado" >COMPETENCIA</div>	
								<div class="itemepartrats3 subRayado" >CLUB</div>	
								<div class="itemepartrats4 subRayado" >RESULTADO</div>																									
							    <div class="itemepartrats5 subRayado" >GANADOR</div>
					</div>		    
					<div id="" class="epartrats" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..--> 
								<div class="itemepartrats1 erenglon">FECHA LISTADA</div>	
								<div class="itemepartrats2 erenglon">COMPETENCIA LISTADA</div>	
								<div class="itemepartrats3 erenglon">CLUB LISTADA</div>	
							    <div class="itemepartrats4 erenglon">RESULTADO LISTADO </div>
							    <div class="itemepartrats5 erenglon" >CLUB GANADOR LISTADO </div>					    
					</div>
					</div>	
					<!-- PRIMER CONTENIDO DE ESTADISTICAS, CATEOGRIAS CON JUGADORES -->				


			<div class="GridControlPaginador" id="GridControlPaginador">
			<!--SECCION DE PAGINACION -->
				<div id="itemcontrolpag1" class="itemcontrolpag1" ><a href="" title="Primer pag"><< Primero</a>
				</div>
  			    <div id="itemcontrolpag2" class="itemcontrolpag2" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
					<a href="" title="Anterior pag">< Anterior</a>
				</div>	
				<div id="itemcontrolpag3" class="itemcontrolpag3" ><!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
					Pag: 
				</div>

				<div id="itemcontrolpag4" class="itemcontrolpag4" >
					<a href="" title="ultima pag.">Siguiente ></a>
				</div>

				<div id="itemcontrolpag5" class="itemcontrolpag5" >
					<a href="" title="ultima pag.">Ultimo >></a>
				</div>
			</div>
			<!--SECCION DE PAGINACION -->
			</form>		

			
			
<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->


<!-- ********************************************************************************* -->
<!-- **********************LADO DE VISTA DE JUGADORES********************************* -->
<!-- ********************************************************************************* -->

			   <!-- GRILLA DE JUGADORES FILTRADA POR CLUB Y CATEGORIA-->		
<!-- *********************************************************************************->
<!-- **********************LADO DE VISTA DE JUGADORES********************************* -->
<!-- ********************************************************************************* -->
          <!-- GRILLA FORMULARIO DE ALTA DE JUGADORES Y DE LISTADO DE LOS MISMOS....-->		
</body>
</html>