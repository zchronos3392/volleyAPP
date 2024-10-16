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
		<style>

			.dialogo
			{
				width:50%;
			 flex-direction:row;
				 background-color:#e8ae17;
			    color:#fff;
			}

			.dialogo BUTTON
			{
				height: 2em;
				border: 1px solid #000000;
				-moz-border-radius: 7px;
				-webkit-border-radius: 7px;
				background: #452e03;
				color: #fff;
				text-decoration: none;
				font-size: 10px;
				font: icon;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				top: 0px;

			}

			.dialogo::backdrop,.dialogo::backdrop
			{
			background-color: rgba(0,0,0,.55);

			}

			.xsmodrenglon1,.xsmodrenglon2,.xsmodrenglon3{
				display:flex;
				 flex-direction:row;
				 justify-content: space-between;
			}

			.XSModales
			{
			 display:flex;
			 flex-direction:column;
			 justify-content: space-between;
				 background-color:#e8ae17;
			    color:#fff;
			}

			.XSModales BUTTON
			{
				height: 2em;
				border: 1px solid #000000;
				-moz-border-radius: 7px;
				-webkit-border-radius: 7px;
			
				background: #f99;
				color: #fff;
				text-decoration: none;
				font-size: 10px;
				font: icon;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				top: 0px;

			}

			.XSModales SELECT
			{
				height: 3em;
				width: 6em;
			}

			.XSModales input[type="number"]
			{
				height: 3em;
				width: 50%;
			}
			@media (max-width: 450px)
			{
				.dialogo
				{
					width:100%;
					flex-direction:row;
					background-color:#e8ae17;
					color:#fff;
				}
			}


		</style>
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	   <!--SCRIPTS-->
		<script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO
//+++++++++++++++ CREAMOS LOS VECTORES GLOBALES DESDE DONDE RE CARGAREMOS INFINITAMENTE LOS COMBOS..
		var vPuestos = new Array();
		var unJugadorDatos = new Array();

function actualizarPuesto(modoDB,idnumero){

//	alert('MODO '+ modoDB+' , id '+ idnumero);

var parametros = {
			"ianio":$("#idunanio_"+idnumero).val(),
			"idjugador":$("#idjugador_"+idnumero).val(),
			"iclubescab": $("#idclub_"+idnumero).val(),
			"icate":$("#idcategoria_"+idnumero).val(),
			"indice":idnumero,
			"remeranum":$("#xRemeraNum2_"+idnumero).val(),
			"puestocate":$("#sxjugadorpuesto_"+idnumero).val(),
		};
$.ajax({ 
            url:   './abms/api_puestosjugador.php',
            type:  'GET',
            dataType: 'json',
			data:parametros,
			async:false,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
				location.reload();
			},
             error: function (xhr, ajaxOptions, thrownError) {}
        }); // FIN funcion ajax CLUBES		

if(modoDB == 'INS'){
	//$idjugador,$indice,$fecha,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab)
    	//idjugador	idpuestoJug	FechaPuestoAlta	FechaPuestoMod	remeraNum	pjcategoria,puestoxcat
    	//idjugador es autonumerico..
    	// $comando = "INSERT INTO vapppuestojugador (idjugador,idpuestoJug,anioEquipo,idclub,FechaPuestoAlta,FechaPuestoMod,remeraNum,pjcategoria,puestoxcat) ".
		// " VALUES ( $idjugador,$indice,$ianio,$iclubescab,$fecha,$fecha,$remeraNum,$icate,$puestoCate ) " ;   

}

if(modoDB == 'UPD'){


	
}



}

function cerrarModal(){

	const puestosADD =
				document.querySelector("#modalPuestosAdd");
				puestosADD.close();

}		

function cargarPuestosStart(){


	var ipuestoss = new Array();

	$.ajax({ 
            url:   './abms/obtener_puestos.php',
            type:  'GET',
            dataType: 'json',
			async:false,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
				ipuestoss = Object.values(r['Posiciones']);
			},
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax CLUBES		
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
 
  return ipuestoss;				
}		
// +++++++++++++++++ FUNCIONES EXTRA ++++++++++++++++++++++++++++++++++++++


function cargarCategorias(){
		// TRAMPITA PARA OBTENER EL VALOR 
		// DE UN CHECK CON JQUERY:
		// DEJO UN FLAG ESCONDIDO PARA SABER EL ULTIMO VALOR
		// DEPENDIENDO DE ESO, LE ASIGNO AL parametros
		// SI O NO...
		//pero, encontre otra forma:
			var verTodos = 0;
	        // Hacer algo si el checkbox ha sido seleccionado
			if( $("#todxs").is(':checked') ) verTodos = 1;
			console.log('llamando a categorias');		
		     var parametros = {"ianio":$("#ianio").val(),"todxscat":verTodos,"iclub": $('#iclubescab').val()};
	         $.ajax({ 
	            url:   './abms/obtener_categorias.php',
	            type:  'GET',
	            dataType: 'json',
				data:parametros,
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
	            beforeSend: function (){
					// Bloqueamos el SELECT de los cursos
					$("#icatcab").empty('');
	    			$("#icatcab").prop('disabled', true);
	    		},
	            done: function(data){
						//console.log(data);	
				},
	            success:  function (r){
	            	$(r['Categorias']).each(function(i, v)
	                { // indice, valor
						if(typeof v.CategoriaId == 'undefined')
						{
								if (! $('#icatcab').find("option[value='" + v.idcategoria + "']").length)
								{
									$("#icatcab").append('<option name="'+v.idcategoria+'" value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
								}
						}
						else
						{	
	                	if (! $('#icatcab').find("option[value='" + v.CategoriaId + "']").length)
	        	        	{
								$("#icatcab").append('<option name="'+v.ConJugadores+'" value="' + v.CategoriaId + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
							}
					    }		
	                });
	                $("#icatcab").prop('disabled', false);
	            },
	             error: function (xhr, ajaxOptions, thrownError)
	             {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						$("#icatcab").append('<option value="' + '9999' + '">' + 'JQERY:Tabla CATEGORIAS vacia' + '</option>');
						$("#icatcab").val('9999');
						$("#icatcab").prop('disabled', false);
				 }
	            }); // FIN funcion ajax categorias
}
function ObtenerJugadoresParm(paginaPedida,quienLLama,iclubescab,icatcab){
	vPuestos = cargarPuestosStart();
		//alert($("#icatcab").val());
	if(icatcab == null || (typeof catcab == 'undefined') )  vicatcab = $("#icatcab").val();
	else vicatcab = icatcab;
var parametros = {"iclubescab1" : iclubescab,
				  "icatcab1" : vicatcab,
				  "ianio":$("#ianio").val(),
				  "pag":paginaPedida,
				  "xnombre":"9999",
				  "xnomAll" : "9999"
				  };

$.ajax({ 
url:   './abms/obtener_jugadores.php',
type:  'GET',
data: parametros,
dataType: 'text json',
async:false,

// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
beforeSend: function (){
	$("#cargajug").empty('');
	$("#regsj").empty('');
	$("#contador").val(0);	
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
				'<div class="regjug122">Accion</div>'+
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
		//eliminarJugador  = '<div class="EliminarJugClass">';
				eliminarJugador  += '<button  name="eliminarJugador" title="eliminarJugador" class="butSquareEqOrang" onClick="eliminarJugadorX('+v.idclub+','+v.idjugador+','+v.anioEquipo+','+v.categoria+');" >(X)</button>';
		//eliminarJugador  += '</div>';
	var modificaJugador  = '';	
		modificaJugador  = '<div class="ModificarJug">';
		modificaJugador  += '<button  name="modificaJugador" title="Modificar Jugador" class="butSquareEqBlu" onClick="modifcarJugadorX('+v.idclub+','+v.idjugador+','+v.anioEquipo+','+v.categoria+');" >Modif.</button></div>';

	var agregaPuestoJugador  = '';	
		agregaPuestoJugador = '<div class="PuestoJug">';
		agregaPuestoJugador  += '<button  name="agregapuestoJugador" title="Puesto Add" class="butSquareEqRedRackam" onClick="agregarPuestoJugadorX('+v.idclub+','+v.idjugador+','+v.anioEquipo+','+v.categoria+',\''+v.CategoriaActual+'\',\''+v.nombre+'\');" >Puesto++</button></div>';		
				//$("#GridControlPaginador").css("display","none");
			var jugadotrActivo = '<div id="regridjug1" class="regridjug1">';
			
			if(v.FechaEgreso != null)
			{
				jugadotrActivo = '<div id="regridjug1" class="regridjug1 BAJA">';
				
			}
			
			$("#regsj").append(
				jugadotrActivo +
				'<div class="regjug11">'+eliminarJugador+'</div>'+
				'<div class="regjug12">'+modificaJugador+'</div>'+
				'<div class="regjug122">'+agregaPuestoJugador+'</div>'+
				'<div class="regjug13"><select id=\'sjugadorp_'+v.idjugador+'\' name=\'sjugadorp_'+v.idjugador+'\' disabled=\'true\'></select>'+'<input type="hidden" id="numero1" name="nume" value="'+v.numero+'" ></input><input type="hidden" id="nombre1" name="nom1" value="'+v.nombre+'" ></input></div>'+
				'<div class="regjug135">'+v.ClubNombre+'</div>'+
				'<div class="regjug14">'+v.numero+'</div>'+
				'<div class="regjug15">'+v.nombre+'</div>'+
				'<div class="regjug16">'+v.CategoriaInicio+'</div>'+
				'<div class="regjug17">'+v.CategoriaActual+'</div>'+
				'<div class="regjug175">'+v.anioEquipo+'</div>'+	
				'</div>');
				creaspuestos(v.idjugador,v.puestoxcat,vPuestos);
		Ultima = r['TotalPaginas'];
//		if( ! $("#ijugclub option").length > 0)
		if( quienLLama != "ijugclub")
				$("#ijugclub").append('<option value="' + v.nombre + '">' +v.nombre + '</option>');

	});
	if( quienLLama != "ijugclub")
			$("#ijugclub").val('9999');
	//alert(r['TotalPaginas']);
	//armar links paginador...
	var tamanioPaginar = r['tamanio'];
	pagActual=0;
	if(r['TotalPaginas'] > 1 && ( (contadorRegistros > tamanioPaginar) || !(pagActual == Ultima) ) )
	{
		$("#GridControlPaginador").css("display","grid");
		if(paginaPedida != 0)
				pagActual = paginaPedida;
		else pagActual = r['paginaPedida'];
		
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


function ObtenerJugadores(paginaPedida,quienLLama){
// la funcion phph obtener_jugadores necesita: 
// valor del campo iclubescab,
// valor del campo ianio
// valor del campo icatcab	
	vPuestos = cargarPuestosStart();
var parametros = {"iclubescab1" : $("#iclubescab").val(),"icatcab1" : $("#icatcab").val(),"ianio":$("#ianio").val(),"pag":paginaPedida,"xnombre":$("#ijugclub").val(),"xnomAll" : $("#ijugclubAll").val() };

	// console.log("pagina pedida: "+ paginaPedida +" " +$("#iclubescab").val());
	// console.log("pagina pedida: "+ paginaPedida +" " +$("#icatcab").val());
	// console.log("pagina pedida: "+ paginaPedida +" " +$("#ianio").val());		
    // console.log("pagina pedida: "+ paginaPedida +" " +$("#ijugclub").val());

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
				'<div class="regjug122">Accion</div>'+
				'<div class="regjug13">Puesto</div>'+
				'<div class="regjug135">Club</div>'+
				'<div class="regjug14">Numero</div>'+
				'<div class="regjug15">Nombre jugador</div>'+
				'<div class="regjug16">Categoria Inicio</div>'+
				'<div class="regjug17">Categoria Actual</div>'+	
				'<div class="regjug175">Año</div>'+	
				'</div>');
	//$("#contador").val($("#icatcab").find('option:selected').attr("name"));
	if( r['Jugadores'])
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
		//eliminarJugador  = '<div class="EliminarJugClass">';
				eliminarJugador  += '<button  name="eliminarJugador" title="eliminarJugador" class="butSquareEqOrang" onClick="eliminarJugadorX('+v.idclub+','+v.idjugador+','+v.anioEquipo+','+v.categoria+');" >(X)</button>';
		//eliminarJugador  += '</div>';
	var modificaJugador  = '';	
		modificaJugador  = '<div class="ModificarJug">';
		modificaJugador  += '<button  name="modificaJugador" title="Modificar Jugador" class="butSquareEqBlu" onClick="modifcarJugadorX('+v.idclub+','+v.idjugador+','+v.anioEquipo+','+v.categoria+');" >(/)</button></div>';

		var agregaPuestoJugador  = '';	
		agregaPuestoJugador = '<div class="PuestoJug">';
		agregaPuestoJugador  += '<button  name="agregapuestoJugador" title="Puesto Add" class="butSquareEqRedRackam" onClick="agregarPuestoJugadorX('+v.idclub+','+v.idjugador+','+v.anioEquipo+','+v.categoria+',\''+v.CategoriaActual+'\',\''+v.nombre+'\');" >Puesto++</button></div>';				
		
		//$("#GridControlPaginador").css("display","none");
			var jugadotrActivo = '<div id="regridjug1" class="regridjug1">';
			
			if(v.FechaEgreso != null)
			{
				jugadotrActivo = '<div id="regridjug1" class="regridjug1 BAJA">';
				//console.log(v.FechaEgreso);
			}
			
			$("#regsj").append(
				jugadotrActivo +
				'<div class="regjug11">'+eliminarJugador+'</div>'+
				'<div class="regjug12">'+modificaJugador+'</div>'+
				'<div class="regjug122">'+agregaPuestoJugador+'</div>'+
				'<div class="regjug13"><select id=\'sjugadorp_'+v.idjugador+'\' name=\'sjugadorp_'+v.idjugador+'\' disabled=\'true\'></select><input type="hidden" id="numero1" name="nume" value="'+v.numero+'" ></input><input type="hidden" id="nombre1" name="nom1" value="'+v.nombre+'" ></input></div>'+
				'<div class="regjug135">'+v.ClubNombre+'</div>'+
				'<div class="regjug14">'+v.numero+'</div>'+
				'<div class="regjug15">'+v.nombre+'</div>'+
				'<div class="regjug16">'+v.CategoriaInicio+'</div>'+
				'<div class="regjug17">'+v.CategoriaActual+'</div>'+
				'<div class="regjug175">'+v.anioEquipo+'</div>'+	
				'</div>');
			creaspuestos(v.idjugador,v.puestoxcat,vPuestos);
		//	
		Ultima = r['TotalPaginas'];
//		if( ! $("#ijugclub option").length > 0)
		if( quienLLama != "ijugclub")
				$("#ijugclub").append('<option value="' + v.nombre + '">' +v.nombre + '</option>');

	});
	if( quienLLama != "ijugclub")
			$("#ijugclub").val('9999');
	//alert(r['TotalPaginas']);
	//armar links paginador...
	var tamanioPaginar = r['tamanio'];
	pagActual=0;
	if(r['TotalPaginas'] > 1 && ( (contadorRegistros > tamanioPaginar) || !(pagActual == Ultima) ) )
	{
		$("#GridControlPaginador").css("display","grid");
		if(paginaPedida != 0)
				pagActual = paginaPedida;
		else pagActual = r['paginaPedida'];
		
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

function creaspuestosDialogo(objetoID,vPuestos){

	// esto arreglo el tema del alta triplle..
		$(vPuestos).each(function(i, v)
                { // indice, valor
						$(objetoID).append('<option value="' + v.idPosicion + '" label="'+v.nombre+'">' +v.nombre +'</option>');
					//alert(selectPuesto);
				});		

}

function creaspuestos(idjugador,puesto,vPuestos){
	//alert('jugador que llega: '+idjugador+' valor del puesto: '+puesto);

	var inombre = "";
        // esto arreglo el tema del alta triplle..
		$(vPuestos).each(function(i, v)
                { // indice, valor
					inombre = v.nombre ;
                	if(puesto != 0 && v.idPosicion == puesto )
                		$("#sjugadorp_"+idjugador).append('<option value="' + v.idPosicion + '" label="'+v.nombre+'" selected>' +v.nombre +'</option>');
                	else
						$("#sjugadorp_"+idjugador).append('<option value="' + v.idPosicion + '" label="'+v.nombre+'">' +v.nombre +'</option>');
					//alert(selectPuesto);
				});		
	if(puesto == null)
			$("#sjugadorp_"+idjugador).append('<option value="99" label="Sin puesto aun" selected>Sin puesto aun</option>');

}


function eliminarJugadorX(unclub,unjugador,unanio,unacategoria){			
					// alert('un club: '+ unclub);
					// alert("jugador id interno: "+ ijugador);
					// alert("anio: "+ anioEqu);					
					// alert("categoria actual: "+ categoria);			
//********************* FIN funcion ajax ELIMINAR JUGADOR					***************************
		var salvoClubEstado = $('#iclubescab').val();
		var salvoAnioEstado = $("#ianio").val();
		var salvoCateEstado = $('#icatcab').val();
			var parametros = {"unclub" : unclub,"unjugador" : unjugador, "unanio" : unanio, "unacategoria" : unacategoria};		         
		//		data: parametros,
		 // FUNCION ajax CLUBES		
         $.ajax({ 
            url:   './abms/eliminar_jugador.php',
            type:  'POST',
            dataType: 'json',
		    data: parametros,					   
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){// Bloqueamos el SELECT de los cursos    			
    			event.preventDefault();
    		},
            done: function(data){},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"]
						$('#iclubescab').val(salvoClubEstado);
						$("#ianio").val(salvoAnioEstado);
						$('#icatcab').val(salvoCateEstado);
						$('#icatcab').click();
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//console.log(xhr.responseText);
				//console.log(thrownError);
			}
            }); 
//********************* FIN funcion ajax ELIMINAR JUGADOR					**************************
		};
		
		function getdatosPuestoJugador(clubJugador,aniojugador,jugadorId){
			var unjugador = new Array();

			var parametros = {"idjugador": jugadorId,"ianio":aniojugador,"iclubescab":clubJugador};
					 $.ajax({ 
						url:   './abms/obtener_puestojug.php',
						type:  'GET',
						data: parametros,
						dataType: 'text json',
						async:false,
						// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
						beforeSend: function (){},
						done: function(data){},
						success:  function (r){
							if(r['PuestosJug'] != undefined )
									unjugador =  Object.values(r['PuestosJug']);

						},
			             error: function (xhr, ajaxOptions, thrownError) {}
            			}); // FIN funcion ajax jugador
	
		return unjugador;

		}


		function agregarPuestoJugadorX(unclub,unjugador,unanio,unacategoria,laCategoria,elNombre){			

		const puestosADD =
				document.querySelector("#modalPuestosAdd");
				$("#modalPuestosAdd").html('<button id="btn-cerrar-modal" onclick="cerrarModal();" >X</button>');

		var estructuraDialogo =	'';
			
			unJugadorDatos = getdatosPuestoJugador(unclub,unanio,unjugador);
			//v.nombreJug+"</div>"+v.idpuestoJug+v.pjcategoria+v.remeraNum+v.idpuestoJug+v.puestoxcat+v.FechaPuestoAlta
			var iremera = ipuestocategoria = 0 ;
			var	iFchAlta =	'';
			var conteoRenglonPuestos = 0;
			var f=new Date();
						var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
						,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
						,"27","28","29","30","31");
						var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
						var xfechaDIA = f.getFullYear() + "-" + meses[f.getMonth()] + "-" +dias[(f.getDate()-1)] ;
			var Fechatoday = '';	
			if(unJugadorDatos.length > 0 ){
			$(unJugadorDatos).each(function(i, v)
                { // indice, valor
					iremera  = v.remeraNum ;
					iFchAlta =	v.FechaPuestoAlta;
					ipuestocategoria = v.puestoxcat;
					//conteoRenglonPuestos++;
					// CARGAMOS LA FECHA DEL DIA O LA DE PRIMERA INSERCION
						// EL FORMATO SIEMPRE TIENE QUE SER YYYY-MM-DD 
						if(iFchAlta == '')
							Fechatoday =xfechaDIA;
						else
							Fechatoday =iFchAlta;
					estructuraDialogo ='<div  class="XSModales">'+ 
										'	<div class="xsmodrenglon1">'+
										'		<div  id="xNombre_'+v.idpuestoJug+'" name="xNombreJugador_'+v.idpuestoJug+'" >'+elNombre+'</div>'+
										'		<input type="hidden" id="idjugador_'+v.idpuestoJug+'" value="'+unjugador+'">'+
										'		<input type="hidden" id="idclub_'+v.idpuestoJug+'" value="'+unclub+'">'+
										'		<input type="hidden" id="idunanio_'+v.idpuestoJug+'" value="'+unanio+'">'+
										'		<input type="hidden" id="idcategoria_'+v.idpuestoJug+'" value="'+unacategoria+'">'+
										'		<div  id="xCategoriaJugador_'+v.idpuestoJug+'" name="xCategoriaJugador_'+v.idpuestoJug+'" >'+v.descCat+'</div>'+
										'		<button id="btn-guardaPuesto_'+v.idpuestoJug+'" onclick="actualizarPuesto(\'UPD\','+v.idpuestoJug+');">'+
										'			<span class="icon-cloud"></span>'+
										'		</button>'+
										'	</div>'+	
										'	<div class="xsmodrenglon2">'+
										'		<div  id="xRemeraNum" name="xRemeraNum"  >Remera Nro </div>'+
										'		<input type="number" id="xRemeraNum2_'+v.idpuestoJug+'" name="xRemeraNum2_'+v.idpuestoJug+'" value="'+iremera+'" ></input>'+
										'		<select id="sxjugadorpuesto_'+v.idpuestoJug+'" name="sxjugadorpuesto_'+v.idpuestoJug+'" ></select>'+
										'	</div>'+
										'	<div class="xsmodrenglon3">	'+
										'		<input type="date" id="xFechaInicioPuesto_'+v.idpuestoJug+'" name="xFechaInicioPuesto_'+v.idpuestoJug+'"  value="'+Fechatoday+'"></input>'+
										'	</div>'	+
										'</div>' ; 
						$("#modalPuestosAdd").append(estructuraDialogo);
						creaspuestosDialogo('#sxjugadorpuesto_'+v.idpuestoJug,vPuestos);
						$('#sxjugadorpuesto_'+v.idpuestoJug).val(ipuestocategoria);
				});	
			}
			else
			{
			//  cargo formulario vacio para agregar puesto
				conteoRenglonPuestos++;
				//(unclub,unjugador,unanio,unacategoria,laCategoria,elNombre)
				estructuraDialogo ='<div  class="XSModales">'+ 
										'	<div class="xsmodrenglon1">'+
										'		<div  id="xNombre_'+conteoRenglonPuestos+'" name="xNombreJugador_'+conteoRenglonPuestos+'" >'+elNombre+'</div>'+
										'		<div  id="xCategoriaJugador_'+conteoRenglonPuestos+'" name="xCategoriaJugador_'+conteoRenglonPuestos+'" >'+laCategoria+'</div>'+
										'		<input type="hidden" id="idjugador_'+conteoRenglonPuestos+'" value="'+unjugador+'">'+
										'		<input type="hidden" id="idclub_'+conteoRenglonPuestos+'" value="'+unclub+'">'+
										'		<input type="hidden" id="idunanio_'+conteoRenglonPuestos+'" value="'+unanio+'">'+
										'		<input type="hidden" id="idcategoria_'+conteoRenglonPuestos+'" value="'+unacategoria+'">'+
										'		<button id="btn-guardaPuesto_'+conteoRenglonPuestos+'" onclick="actualizarPuesto(\'INS\','+conteoRenglonPuestos+');" >'+
										'			<span class="icon-cloud"></span>'+
										'		</button>'+
										'	</div>'+	
										'	<div class="xsmodrenglon2">'+
										'		<div  id="xRemeraNum" name="xRemeraNum"  >Asignar nro remera </div>'+
										'		<input type="number" id="xRemeraNum2_'+conteoRenglonPuestos+'" name="xRemeraNum2_'+conteoRenglonPuestos+'" value="" ></input>'+
										'		<select id="sxjugadorpuesto_'+conteoRenglonPuestos+'" name="sxjugadorpuesto_'+conteoRenglonPuestos+'" ></select>'+
										'	</div>'+
										'	<div class="xsmodrenglon3">	'+
										'		<input type="date" id="xFechaInicioPuesto_'+conteoRenglonPuestos+'" name="xFechaInicioPuesto_'+conteoRenglonPuestos+'"  value="'+xfechaDIA+'"></input>'+
										'	</div>'	+
										'</div>' ; 
						$("#modalPuestosAdd").append(estructuraDialogo);
							// lo creo vacio
							creaspuestosDialogo('#sxjugadorpuesto_'+conteoRenglonPuestos,vPuestos);
						//$('#sxjugadorpuesto_'+conteoRenglonPuestos).val(ipuestocategoria);
			}		
			puestosADD.showModal();
            			
			// window.location.href='ABMjugadores.php?MODO=UPD&unjugador='+unjugador+'&ianio='+unanio+'&iclubescab='+unclub+'&icatcab='+unacategoria;

//********************* FIN funcic ajax ELIMINAR JUGADOR					**************************
		};		


		function modifcarJugadorX(unclub,unjugador,unanio,unacategoria){			
			//alert('llamamos a modificar');
			//option A
            //$("#altajugador").submit(function(e){e.preventDefault();});			
			window.location.href='ABMjugadores.php?MODO=UPD&unjugador='+unjugador+'&ianio='+unanio+'&iclubescab='+unclub+'&icatcab='+unacategoria;

//********************* FIN funcic ajax ELIMINAR JUGADOR					**************************
		};		
		
		$(document).ready(function(){
			vPuestos = cargarPuestosStart();

			$('[name="ijugclubFull"]').hide();
			
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
				// stopwatchjquery
						
			
		var iclubescab = parametroURL('iclubescab');	
		var icatcab    = parametroURL('icatcab');

		
		$("#todxs").attr('checked', false);
		$("#todxscat").attr('checked', false);
		
		
		$("#migrarEquipo").on("click",function(e){
				e.preventDefault();
				$(location).attr('href','MigrarCatjugadores.php');
			}); // fin evento AGREGAREG ON CLICK		

		$("#Agregar").on("click",function(e){
				e.preventDefault();
				var anio = $("#ianio").val();
				$(location).attr('href','ABMjugadores.php?MODO=INS&ianio='+anio);
			}); // fin evento AGREGAREG ON CLICK		


// INSERT EN LA TABLA **********************************************
	       $("#altaGenerica").on("click",function(e){
		    	//e.preventDefault();
	    	//QUE SE RECARGUE CUANDO PRESIONO CLICK..
	    	//$("#altajugador").submit(function(e){e.preventDefault();});			//BORRAR
			//	e.preventDefault();
	    	
	    	//

	    	var parametros =  $("#altajugador").serialize();
	    	//console.log(parametros);
	  			//EL SERIALIZE RESUMEN TODO LO QUE SIGUE
	  			//var parametros =  {
	  			//		"iclubescab" : $("#iclubescab").val(),
				////		"icatcab" : $("#icatcab").val(),        	
				//		"numero" : $("#numero").serialize(),
				//		"nombre" : $("#nombre").serialize(),
				//		"edad" : $("#edad").serialize(),
				//		"altagen" :	$("#altagen").val(),
				//		"gencuantos" :	$("#gencuantos").val()
		         //}
		         
		    	//e.preventDefault();
		         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		            url:   './abms/insertar_jugador.php',
		            type:  'GET',
		            data: parametros,
		            beforeSend: function (){
						//console.log(parametros);
						alert('Alta concedida....');
		            },
		            success:  function (r){
							//console.log(r);
							//alert('Alta concedida....');
							iclubescab = parametroURL('iclubescab');
							icatcab    = parametroURL('icatcab');
							// // // if(iclubescab != null && icatcab != null )
							// // // 	location.href='Cjugadores.php?icatcab='+icatcab+'&iclubescab='+iclubescab;
							// // // else
							// // // 	location.href='Cjugadores.php';
							//recargar la grilla...de Jugadores...
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
		    	//e.preventDefault();		            
		    
				}); // parentesis el .CLICK ALTAP
				


// ***** Obtener todos los nombres de jugadores que tenemos..**************************
         $.ajax({ 
            url:   './abms/obtener_jugadoresALL.php',
            type:  'GET',
            dataType: 'json',
            data:parametros,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#ijugclubAll").prop('disabled', true);
    		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['JugadoresX']).each(function(i, v)
                { // indice, valor
              	if (! $('#ijugclubAll').find("option[value='" + v.nombre + "']").length)
                	{
						$("#ijugclubAll").append('<option value="' + v.nombre + '">' +v.nombreComp +' ('+v.apariciones +')'+'</option>');
					}		
                });
                $("#ijugclubAll").prop('disabled', false);
                //alert(iclubescab);
//                if(iclubescab != 0 && iclubescab != null) $("#iclubescab").val(iclubescab);
//                else $("#iclubescab").val('9999');
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#ijugclubAll").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#ijugclubAll").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#ijugclubAll").prop('disabled', false);
			}
            }); 
// ***** FIN Obtener todos los nombres de jugadores que tenemos..**************************



		//	var parametros = {"CPartido" : "S"};		         
		//		data: parametros,
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
                //alert(iclubescab);
                if(iclubescab != 0 && iclubescab != null) $("#iclubescab").val(iclubescab);
                else $("#iclubescab").val('9999');
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
			
//************************ CATEGORIAS *************************************************              
		 parametros= {"activas" : "1"};
		
         $.ajax({ 
            url:   './abms/obtener_categorias.php',
            type:  'GET',
            dataType: 'json',
            data:parametros,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icatcab").prop('disabled', true);
    		},
            done: function(data){
					console.log(data);	
			},
            success:  function (r){
            	$(r['Categorias']).each(function(i, v)
                { // indice, valor
                	if (! $('#icatcab').find("option[value='" + v.idcategoria + "']").length)
                	{
						$("#icatcab").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
					}		
                });
                $("#icatcab").prop('disabled', false);
                if(icatcab != 0 && icatcab != null) $("#icatcab").val(icatcab);
                else  $("#icatcab").val('9999');
                
                //$("#icatcab").click(); // APAGO EVENTO CLICK DE CATEGORIA CUANDO ESTOY RECARGANDO LA PAGINA..
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icatcab").append('<option value="' + '9999' + '">' + 'JQERY:Tabla CATEGORIAS vacia' + '</option>');
			$("#icatcab").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#icatcab").prop('disabled', false);
			}
            }); // FIN funcion ajax categorias
//************************ CATEGORIAS *************************************************              			

			$("#agregaReg").on("click",function(e){
				e.preventDefault();
			//alert('agreho');
				$("#renglonesAltaMasiva").append('<div id="regsj" class="regsjugadoreMass">'+
					'<div name="" id="" class="regjug1"><input type="text" id="numero" name="numero[]" value="num"></input></div>'+
					'<div name="" id="" class="regjug2"><input type="text" id="nombre" name="nombre[]" value="nombre"></input></div>'+
					'<div name="" id="" class="regjug3"><input type="text" id="edad" name="edad[]" value="edad"></input></div>'+
					'<div name="" id="" class="regjug4"></div>'+
					'<div name="" id="" class="regjug5"></div>'+
					'</div>');
			}); // fin evento AGREGAREG ON CLICK
//************************ CATEGORIAS 001 ************************************************* 


//************************ CREAR DETALLE ************************************************* 

			$("#crearDetalle").on("click",function(e){
				e.preventDefault();

		         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		            url:   './abms/crea_jugadordetalle.php',
		            type:  'POST',
		            data: parametros,
		            beforeSend: function (){
						//console.log(parametros);
		            },
		            success:  function (r){
							//alert(r['mensajes']);
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
				}); // fin evento AGREGAREG ON CLICK

//************************ CREAR DETALLE ************************************************* 


			$("#altagen").on('click',function()
			{
				if($("#altagen").prop('checked'))
						$("#gencuantos").removeAttr('disabled','true');
				else{
					$("#gencuantos").val(0);
					$("#gencuantos").attr('disabled','true');
					}
			});
			
			var f=new Date();
			var fechapartido = f.getFullYear()-1 ;
			fechainicial = fechapartido -10;
			fechaFinal   = fechapartido +1;
			for (var i = fechainicial; i < fechaFinal; i++) 
			{
				if(i == fechapartido) {$("#ianio").prepend('<option selected>' + (i + 1) + '</option>');$("#anioactivo").val(i + 1);}
				else  $("#ianio").prepend('<option>' + (i + 1) + '</option>');
			}
			
			//$("#ianio").prop('disabled', true);
			
			if(icatcab > 0 && icatcab != null ){
				pagPedida=0;
				ObtenerJugadoresParm(pagPedida,'ijugclub',iclubescab,icatcab);
			}
			
			$("#ijugclubAll").on("click change",function(){
				pagPedida=0;
				$('[name="ijugclubFull"]').hide();
				//alert('ijugClub nombre');
				ObtenerJugadores(pagPedida,'ijugclubAll');
			});
			
			
			$("#ijugclub").on("click change",function(){
				pagPedida=0;
				//alert('ijugClub nombre');
				ObtenerJugadores(pagPedida,'ijugclub');
			});
			
			$("#icatcab").on("click change",function(){
				pagPedida=0;
				//alert('icatcab');
				ObtenerJugadores(pagPedida,'icatcab');
			});
			// al clickear en clubes, limpio el checK
			$('#iclubescab').on("click change",function(){
//buscar jugadores solo por club...y o año				
				pagPedida=0;
				//alert('iclubescab');
				ObtenerJugadores(pagPedida,'iclubescab');
				cargarCategorias();
				
//UNIFIQUE TODO EN UN SOLO CHECK: CON JUGADORES...	
//			$("#todxscat").attr('checked', false);
			});			

			
			$('#ianio').on("click change",function(){
			//buscar jugadores solo por AÑO, SIN CLUB NI CATEGORIA...(trae todos)
				pagPedida=0;
				//console.log('ianio');
				ObtenerJugadores(pagPedida,'ianio');
			});			

			
			$("#todxs").on("click",function(){
				
				var verTodos = $("#activo").val();
				if(verTodos == 0 ) $("#activo").val(1);
				else $("#activo").val(0);
				
		        var parametros = {"ianio":$("#ianio").val(),"todxs":$("#activo").val()};
				 $.ajax({ 
					url:   './abms/obtener_clubes.php',
					type:  'GET',
					dataType: 'json',
					data:parametros,
					// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
					beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
						$("#iclubescab").prop('disabled', true);
						$("#iclubescab").empty();
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
			});
			//**************************CATEGORIAS CARGADAS DEL CLUB*/

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

		}); // parentesis del READY

		</script>
    </head>
    <body>

		<?php include('includes/newmenu.php'); ?>

<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->
		<form id="altajugador" class="altajugador" name="altajugador" >
			<!-- CABECERA DE SELECCION DE VALORES IGUALES-->
			<div class="x23GridControlJugador">
			<!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->
				<div id="" class="x23itemcontrolju1" >Año Actual </div>
				<div class="x23itemcontrolju2">
						<select id="ianio" name="ianio" class="ianio">
						  <option value="9999">Seleccionar año...</option>
						</select>
				</div>
				<div id="" class="x23itemcontrolju3" >Clubes</div>
				<div id="" class="x23itemcontrolju4" >
					<input type="text" id="itextbuscar" name="itext" class="inputSearch">
				</div>
				<div id="" class="x23itemcontrolju5" >
					<select id="iclubescab" name="iclubescab" class="iclubescab">
							<option value="9999">Seleccionar club</option>
					</select>
				</div>
				<div id="" class="x23itemcontrolju6" >
					<input type="checkbox" id="todxs"><span>Con jugadores..</span></input>
						<input type="hidden" id="anioactivo" name="anioactivo" val="0"></input>
						<input type="hidden" id="activo" val="0"></input>
				</div>	
				<div id="" class="x23itemcontrolju7" >Categorias</div>
				<div id="" class="x23itemcontrolju8" >
 					<select id="icatcab" name="icatcab" class="icatcab">
						<option value="9999">Seleccionar categoria</option>
					</select>
				</div>		
				<div id="" class="x23itemcontrolju9" >
					<input type="text"  value="" id="contador" readonly="true"/>
				</div>
			</div>
			<div class="GridControlJugador SINTOPE">
			<!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->
  			    <div id="" class="itemcontrolju1" >TODOS LOS JUGADORES</div>

				<div id="" class="itemcontrolju2" >
					<select id="ijugclubAll" name="ijugclubAll" class="ijugclub">
				 	  <option value="9999">Seleccionar nombre jugador</option>
					 </select>
				</div>

				<div id="" class="itemcontrolju3" name="ijugclubFull" >
				  Jugadores <select id="ijugclub" name="ijugclub" class="ijugclub">
				 					<option value="9999">Seleccionar nombre jugador</option>
							</select>
				</div>
					
				<div id="" class="itemcontrolju4" >
				</div>
				<div id="" class="itemcontrolju5" >
				</div>		
			</div>
						
			<div class="gridControlEquipo">					
				<div class="controlEq1">
					<span class="TituloEqControl">ACCIONES</span>
				</div>
				<div class="controlEq2">
					<button id="Agregar" name="Agregar" class="butControlEqRed" title="Agregar Jugador">Agrega Jugador</button>
				</div>
				<div class="controlEq3">
					<button id="migrarEquipo" name="agregaReg" class="butControlEqBlu left" title="migrar equipo">Migrar Categ.</button>
					<!--<button id="altajug" name="altajug" class="butControlEq" title="agregar registros">Alta Masiva</button>-->	
				</div>
				<div id="" class="controlEq4" >	
					<button id="agregaReg" name="agregaReg" class="butControlEq" title="nuevo registro">+renglon</button>
					<!--<button id="crearDetalle" name="crearDetalle" class="butControlEq" title="Crear Detalle">Detalle</button>-->
				</div>
				<div id="" class="controlEq5" >
						Gen.<input type="checkbox" name="altagen" id="altagen" value="checked"></input>
				</div>
				<div id="" class="controlEq6" >	
					<select class="numeros" id="gencuantos" name="gencuantos" disabled="true">
						<option class="CantidadJugadores" value="0" selected>Seleccionar...</option>
						<option class="CantidadJugadores"  value="1">1</option>
						<option class="CantidadJugadores"  value="2">2</option>
						<option class="CantidadJugadores"  value="3">3</option>
						<option class="CantidadJugadores"  value="4">4</option>
						<option class="CantidadJugadores"  value="5">5</option>
						<option class="CantidadJugadores"  value="6">6</option>
						<option class="CantidadJugadores"  value="7">7</option>
						<option class="CantidadJugadores"  value="8">8</option>
						<option class="CantidadJugadores"  value="9">9</option>
						<option class="CantidadJugadores"  value="10">10</option>
						<option class="CantidadJugadores"  value="11">11</option>
						<option class="CantidadJugadores"  value="12">12</option>
						<option class="CantidadJugadores"  value="13">13</option>
						<option class="CantidadJugadores"  value="14">14</option>
						<option class="CantidadJugadores"  value="15">15</option>
						<option class="CantidadJugadores"  value="16">16</option>
						<option class="CantidadJugadores"  value="17">17</option>
						<option class="CantidadJugadores"  value="18">18</option>
						<option class="CantidadJugadores"  value="19">19</option>
						<option class="CantidadJugadores"  value="20">20</option>
					</select>		
					<!--<input type="number" name="gencuantos" id="gencuantos" class="gencuantos" value="0" readonly></input>-->
				</div>
				<div id="" class="controlEq7" >	
						<button id="altaGenerica" name="altaGenerica" class="butControlEq" title="Alta generica">MassAlta</button>
				</div>	
				
			</div> <!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->			

			<div class="GridControlPaginador" id="GridControlPaginador">
			<!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->
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
		</form>					
		<div id="regsj"></div>
		<div id="renglonesAltaMasiva"></div>


<dialog id="modalPuestosAdd" class="dialogo">
	<button id="btn-cerrar-modal" onclick="cerrarModal();">X</button>
</dialog>		
			
			
<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->


<!-- ********************************************************************************* -->
<!-- **********************LADO DE VISTA DE JUGADORES********************************* -->
<!-- ********************************************************************************* -->

			   <!-- GRILLA DE JUGADORES FILTRADA POR CLUB Y CATEGORIA-->		
<!-- *********************************************************************************-->
<!-- **********************LADO DE VISTA DE JUGADORES********************************* -->
<!-- ********************************************************************************* -->
          <!-- GRILLA FORMULARIO DE ALTA DE JUGADORES Y DE LISTADO DE LOS MISMOS....-->		
</body>
</html>