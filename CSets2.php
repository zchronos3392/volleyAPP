<?php include('sesioner.php');?>
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
		<script type="text/javascript" src="./scripts/moment.js"></script> 
	   <!-- ESTILOS -->
	   <style>
		/* PANTALLA DE ESPERA */
			.XModales,.XSModales
			{
				background-color: rgba(255,0,0,.55);
				height:	-webkit-fill-available;
			}
			DIALOG{
				inset-inline-start: 0px;
				inset-inline-end: 0px;
				width:100%;

			}

			@keyframes donut-spin {
			0% {
			transform: rotate(0deg);
			}
			100% {
			transform: rotate(360deg);
			}
			}
			.donut {
			display: inline-block;
			border: 4px solid rgba(0, 0, 0, 0.1);
			border-left-color: #7983ff;
			border-radius: 50%;
			width: 30px;
			height: 30px;
			margin: 15%;		
			padding: 40%;
			animation: donut-spin 1.2s linear infinite;
			}
			/* PANTALLA DE ESPERA */

		#lineaCSetJug button {
			width:7em;
			height:4em;
			border-radius:20%;
			background:#ce1ee1;
			outline:none;
			color:#000;
			font-size:14px;
			box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
			transition:.3s;  
		}
		
		.tablaBotones {
			display: grid;
			grid-template-columns: 90% 90% 89% 73%;
			grid-template-rows: 80%;
			/*background: #00bfff;*/
		}
		.tablaBotones div {
				border:1px solid green;
		}
		
	   </style>
		<script type="text/javascript">

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

		function checkHoraSistema(){
			if($("#HoraSistema") != '') 
				updatehora('HoraSistema');
		}


		function ingresoNovedades(urlEjecutar){
			//aca tengo que grabar la hora simulada del sistema
			checkHoraSistema();

			window.location.href = 'NovedadesSet.php?'+urlEjecutar;

		}

		function ingresoPosiciones(urlEjecutar){
			//aca tengo que grabar la hora simulada del sistema
			checkHoraSistema();
			window.location.href = 'CargarPosiciones.php?'+urlEjecutar;

		}


		function limpiarhora(){

			var parametros = {
				"TEXTOCLAVE" : "HORASISTEMA",
				//   que directamente grabe la sesion
			};

			 	$.ajax({
			 		url:   './abms/salirsesion.php',
			 		type:  'POST',
			 		data:  parametros,
			 		dataType: 'json',
			 		beforeSend: function () {
			 			// Bloqueamos el SELECT de los cursos
			 		},
			 		done: function(data) {

			 		},
			 		success:  function (r) {
						//$("#HoraSistema").val('');
			 				location.reload();
			 			},
			 		error: function (xhr, ajaxOptions, thrownError) {
						console.log('Detalle errores: ');
						console.log(xhr);
						}
			 	}); // FIN funcion ajax
		};

				const convertTimeTo24h = (time12h) => {
					const [time, modifier] = time12h.split(' ');

					let [hours, minutes] = time.split(':');

					if (hours === '12') {
						hours = '00';
					}

					if (modifier === 'PM') {
						hours = parseInt(hours, 10) + 12;
					}

					return `${hours}:${minutes}`;
				}

		function getTimeDifference(startTime, endTime) {
			// Handle optional 24-hour format conversion (replace with your conversion logic)
			if (!startTime.match(/^([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/)) {
			// Convert to 24-hour format if needed
			startTime = convertTimeTo24h(startTime);
			endTime = convertTimeTo24h(endTime);
			}

			// Split times into arrays of [hours, minutes, seconds]
			const startTimeArr = startTime.split(':').map(Number);
			const endTimeArr = endTime.split(':').map(Number);

			// Calculate difference for each unit (hours, minutes, seconds)
			let hourDiff = endTimeArr[0] - startTimeArr[0];
			let minuteDiff = endTimeArr[1] - startTimeArr[1];
			let secondDiff = endTimeArr[2] - startTimeArr[2];

			// Handle negative differences (adjust as needed)
			if (secondDiff < 0) {
			minuteDiff--;
			secondDiff += 60;
			}
			if (minuteDiff < 0) {
			hourDiff--;
			minuteDiff += 60;
			}
			if (hourDiff < 0) {
			hourDiff += 24; // Assuming difference is within the same day
			}

			// Format the result (replace with your desired format)
			return hourDiff.toString().padStart(2, '0') + ':' +
			minuteDiff.toString().padStart(2, '0') + ':' +
			secondDiff.toString().padStart(2, '0');
		}

		function updatehora(preid){
			$("#"+preid).prop('disabled', true);
		// por el momento solo guardo la competencia del formulario
			var parametros = {
				"TEXTOCLAVE" : "HORASISTEMA",
				"origenrequest"		: $('#'+preid).val() //reuso clave origenrequest para
				//   que directamente grabe la sesion
			};

			$.ajax({
				url:   './abms/grabarsesion.php',
				type:  'GET',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function () {},
				done: function(data) {},
				success:  function (r) {

				},
				error: function (xhr, ajaxOptions, thrownError) {console.log(thrownError);}
								
			});// falta el seleccion de la cancha, para cargar los campos..		  
};
  

		function activarHora(control,preid){
			if ($(control).is(":checked")) {
				// it is checked
				$("#"+preid).prop('disabled', false);
				$("#horainiciofin").show();
				$("#BorrarHora").show();
			}	
			else{
				$("#"+preid).prop('disabled', true);
				$("#horainiciofin").hide();
				$("#BorrarHora").hide();
			}	
		};    


		function EliminarSet(idpartido,setnumero)
		{
			fechaS =<?php echo("'".$_GET['fecha'])."'"; ?>;	
			//console.log("partido id: " +idpartido);			
			//console.log("fecha partido: " +fechaS);
			//console.log("set num: " +setnumero);
			
		var parametros =
    		 {
    			"idpartido" : idpartido,
    			"idset"     : setnumero,
    			"fechas"    : fechaS
    		};			
			
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/eliminar_set.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    		//cargaCancha();
	    		//console.log(r);
	    				location.reload();
	    		//preventDefault();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
               }
		   		});
		   					
			
		};

		function crearSet(){	

		// SE TIENE QUE DEFINIR ANTES de USARLO
		const dialog = document.getElementById("modalEsperar");

		// antes de cargar todo , verifico que el partido no haya que cerrarlo !!			
			var setmax = <?php echo($_GET['setmax']); ?>;
			<?php 
				require_once('./abms/Set.php');
				$idpartido = (int) $_GET['id'];
				$partidofecha = "'".$_GET['fecha']."'";
				//$ultimoSet = Sett::ultSetNum($idpartido);
				$ultimoSet = Sett::ultSetNum($idpartido,$partidofecha);
				$idnewset=0;
				if(isset($ultimoSet['setnumero']))
						$idnewset =(int) $ultimoSet['setnumero']; 
				 if(!$idnewset)$idnewset=1;
					 else $idnewset++; 
		   ?>
		   var setActualSig = <?php echo($idnewset);?>;
			console.log("proximo set seria: " +setActualSig);
			console.log("y el maximo numero de sets son: " + setmax);
			//alert();
	if( setActualSig <= setmax ) 
	    {
			$("#numerosetNuevo").val(setActualSig);
			setActualSig
		   //var setActualSig = <?php echo($idnewset);?>;
		   //if( setActualSig > setmax ) {$("#nuevoset").prop('disabled', true); $("#nuevoset").css("background","#A9AAC5");};
		   var horaAUsar = '';
		   horaAUsar = ( $("#HoraSistema").val() != '') ? $("#HoraSistema").val() : $("#stopwatch").text();

			var parametros =
				 {
					"idpartido" : <?php echo($_GET['id']); ?>,
					"idset"     : $("#numerosetNuevo").val(),
					"resa"      : 0,
					"resb"      : 0,
					"fechas"    : <?php echo("'".$_GET['fecha'])."'"; ?>,
					"horas"     : horaAUsar,
					"saque"     : 0,
					"anioEquipo": $("#ianio").val() ,
					"mensajeAlta" : 'Csets2::CrearSet',
					"COPIARJUGADORES":	1 
				};
    		//console.log(parametros);

    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_sets.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
					dialog.showModal();
				// Bloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	//	    		console.log(r);
					dialog.close();
					$("#CSet211").empty();
					cargaPantalla();
						//location.reload();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA				
					console.log(thrownError);
               }
		   	});
  	
		}
		else { console.log('maximo numero de sets alcanzado..');};
	};    
					
		
		idclubuno = 0;
		idclubdos = 0;
		function cerrarPartido(idclubGanador)
	        {
			    var parametros =
			    {
				 "fecha"   : <?php echo("'".$_GET['fecha']."'"); ?>,
				 "partido" : <?php echo($_GET['id']); ?>,
				 "clubgano":idclubGanador	
				};

			    $.ajax({ 
	            url:   './abms/cerrar_partido.php',
	            type:  'POST',
	            data:  parametros,
	            dataType: 'json',
	            beforeSend: function (){
					// Bloqueamos el SELECT de los cursos
	    		},
	            done: function(data){
							
				},
	            success:  function (r){window.location.href = 'AdministrarAPP.php';},
				error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				}
	            }); // FIN funcion ajax CERRAR PARTIDO.
			};  
		

function cargaPantalla(){
	iclubA = 0;
	iclubB = 0;
	SetsMAXIMOS = 0;	
	ResultadoA = 0;
	ResultadoB = 0;	
	// antes de cargar todo , verifico que el partido no haya que cerrarlo !!	
	var parametros =
	{
		"fechapart"   : <?php echo("'".$_GET['fecha']."'"); ?>,
		"id" : <?php echo($_GET['id']); ?>	
	};

	$.ajax({ 
	url:   './abms/obtener_partidos.php',
	type:  'GET',
	data: parametros,
	dataType: 'text json',
	// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
	beforeSend: function (){},
	done: function(data){},
	success:  function (r){
	$(r['Partido']).each(function(i, v)
		{ // indice,0 valor
			iclubA = v.idcluba;
			iclubB = v.idclubb ;
			categoriapartido = v.idcat;
			SetsMax = v.setsnmax;	
			ResultadoA = v.ClubARes;
			ResultadoB = v.ClubBRes;

			// agregado para guardar el id partido y tenerlo disponible..
			$("#idclubA").val(iclubA);
			$("#idclubB").val(iclubB);

			$("#categoriaPartido").val(categoriapartido);

			// agregado para guardar el id partido y tenerlo disponible..
			$("#clubANombre").val(v.ClubA);
			$("#clubBNombre").val(v.ClubB);
			$("#comptext").html('Categoria: '+ v.DescCate+'<br> Competencia <br>'+v.cnombre +'<br> Fecha '+ v.Fecha);

			idclubuno = iclubA;
			idclubdos = iclubB;
			var paremetros =
			{
				"puntosa" : ResultadoA ,
				"puntosb" : ResultadoB ,
				"equipoa" : iclubA,
				"equipob" : iclubB,
				"setmax"  : SetsMax
			};

			$.ajax({ 
				url:   './finpartido.php',
				type:  'GET',
				data: paremetros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){
						//console.log(r['ganador']);
						if( r['ganador'] != -1 ) cerrarPartido(r['ganador']);
				},
				error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					console.log(thrownError);
					console.log(xhr.responseText);
				}
			}); // FIN funcion ajax obtener_partido
		});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			console.log(thrownError);
			console.log(xhr.responseText);
		}
	}); // FIN funcion ajax obtener_partido


	// antes de cargar todo , verifico que el partido no haya que cerrarlo !!			
	var setmax = <?php echo($_GET['setmax']); ?>;
	var fechapartido = <?php echo("'".$_GET['fecha']."'"); ?>;
	<?php 
		require_once('abms/Set.php');
		$idpartido = (int) $_GET['id'];
		$partidofecha = "'".$_GET['fecha']."'";
		//$ultimoSet = Sett::ultSetNum($idpartido);
		$ultimoSet = Sett::ultSetNum($idpartido,$partidofecha);
		$idnewset =0;
		if(isset($ultimoSet['setnumero']))		
		$idnewset =(int) $ultimoSet['setnumero']; 
		if(!$idnewset)$idnewset=1;
		else $idnewset++; 
	?>
	var setActualSig = <?php echo($idnewset);?>;
	//alert("proximo set seria: " +setActualSig);
	//alert("y el maximo numero de sets son: " + setmax);

	if( setActualSig > setmax ) {$("#nuevoset").prop('disabled', true); $("#nuevoset").css("background","#A9AAC5");};

	$("#numerosetNuevo").val(setActualSig);

	var parametros =
	{
		"idpartido" : <?php echo($_GET['id']); ?>,
		"idfecha" : <?php echo("'".$_GET['fecha'])."'"; ?>
	}	
	var verComp = 0;		
	$.ajax({ 
	url:   './abms/obtener_setinicial.php',
	type:  'GET',
	data: parametros,
	dataType: 'json',
	beforeSend: function (){},
	done: function(data){},
	success:  function (r){
	// aca agregamos la logica para pegar los botones de trabajo con SET
	//console.log(r);
	$(r['Sets']).each(function(i, v)
	{ // indice, valor
		var accion='';
		var altajugadorea='';
		var altajugadoreb='';
		var cargaPosicionA='';
		var cargaPosicionB='';
		var eliminarSet = '';

		//'<a href="eliminarSet.php?idpartido='+v.idpartido+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&setnum='+v.setnumero+'" >';
		eliminarSet  = '<button id="EliminarSet" name="EliminarSet" title="Eliminar Set" class="btnPop2 RedRackam" onClick="EliminarSet('+v.idpartido+','+v.setnumero+')" >(X)</button>';


		horaSet  = '<div class="grillahsset CSETS"><div class="grillahssetitem1">Inicio</div>'+
					'<div class="grillahssetitem2"></div>'+
					'<div class="grillahssetitem3">'+
					'<input type="time" id="horai_'+v.idpartido+'_'+v.setnumero+'_'+v.primseq+'" name="horai_'+v.idpartido+'_'+v.setnumero+'_'+v.primseq+'" value="'+v.horainicio+'" disabled="true"/></div>'+
					'<div class="grillahssetitem4">Fin</div>'+
					'<div class="grillahssetitem5"></div>'+								
					'<div class="grillahssetitem6">'+
					'<input type="time" id="horaf_'+v.idpartido+'_'+v.setnumero+'_'+v.ultmseq+'" name="horaf_'+v.idpartido+'_'+v.setnumero+'_'+v.ultmseq+'" value="'+v.horafin+'"  disabled="true"/></div>'+
					'<div class="grillahssetitem7"></div>'+								
					'</div>';			


		var nombrelocal = v.NombreClubA;
		var nombrevisitante = v.NombreClubB;

		//altajugadorea = '<div class="gcsets4">'+'<a href="CargarJugadores.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubA+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&idcate='+ v.categoria+'&setnum='+v.setnumero+'" >';
		//altajugadorea += '<button id="jugadoresA" name="jugadoresA" title="cargar jugadores equipo A" class="btnPop2" >Jugadores '+nombrelocal+'</button></a></div>';
		//console.log(altajugadorea);
		//altajugadoreb = '<div class="gcsets5">'+'<a href="CargarJugadores.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubB+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&idcate='+ v.categoria+'&setnum='+v.setnumero+'" >';
		//altajugadoreb += '<button id="jugadoresB" name="jugadoresB" title="cargar jugadores equipo B" class="btnPop2">Jugadores '+nombrevisitante+'</button></a></div>';

		// formato de los parámetros: idpartido=1&setmax=5&idclub=83&set=1&idcate=20&fecha=2022-12-14
		cargaPosicionA = '<div class="gcsets1">';
		cargaPosicionA += '<button id="posicionesA" name="posicionesA" title="cargar posiciones equipo A" class="btnPop2" ';
		cargaPosicionA += ' onclick="ingresoPosiciones(\'idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubA+'&set='+v.setnumero+'&idcate='+ v.categoria+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>+'\' );" >Pos.Ini. '+nombrelocal+'</button></div>';

		// formato de los parámetros: idpartido=1&setmax=5&idclub=83&set=1&idcate=20&fecha=2022-12-14		
		cargaPosicionB = '<div class="gcsets2">';
		cargaPosicionB += '<button id="posicionesB" name="posicionesB" title="cargar posiciones equipo B" class="btnPop2" ';
		cargaPosicionB += ' onclick="ingresoPosiciones(\'idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubB+'&set='+v.setnumero+'&idcate='+ v.categoria+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>+'\' );" >Pos.Ini. '+nombrevisitante+'</button></a></div>';
		//console.log(cargaPosicionB);

		if(v.DescEstado.includes('PROGR')) {var img = './img/PartidoONOFFSQR.png';}
		if(v.DescEstado.includes('LLUVI')){ var img = './img/rain-icon-png.jpg';}
			accionTablero ='<input type="button" id="verset" name="verset"';
			accionTablero +=' class="btnTablero" value="Tablero" title="Tablero" onclick="';
			accionTablero +='checkHoraSistema();window.location.href=\'TableroGrandev25.php?id='+v.idpartido+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'\';" ></input>';
			


		if(v.DescEstado.includes('FIN'))
		{
			var img = './img/PartidoOFFSQR.jpg';
			accion ='';
			altajugadorea='';
			altajugadoreb='';
			cargaPosicionA='';
			cargaPosicionB='';
		}
		if(v.DescEstado.includes('CURSO'))
		{
			var img = './img/PartidoONSQR.png';
			accion +='<input type="button" id="verset" name="verset" class="btnPop2" onclick="ingresoNovedades(\'id='+v.idpartido+'&setid='+v.setnumero+'&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1&catP='+v.categoria+'\');"';
			accion +=' value="(Continuar)" title="Continuar set(redux)"></input>';  
		}


		if(v.DescEstado.includes('INICIAL'))
		{
			var img = './img/PartidoONOFFSQR.png';
			accion +='<input type="button" id="verset" name="verset" class="btnPop2" onclick="ingresoNovedades(\'id='+v.idpartido+'&setid='+v.setnumero+'&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1&catP='+v.categoria+'\');"';
			accion +=' value="(Continuar)" title="Continuar set(redux)"></input>';  
		}

		//  verComp++;
		//  if(verComp == 1)$("#comptext").append(v.cnombre);
		var ganador ="";
		//             console.log("PUNTO EQUIPO A: "+v.puntoa+" PUNTOS EQUIPO B: "+v.puntob);
		var restaPuntos =  (v.puntoa - v.puntob);
		//       	  console.log("difrernca: " + restaPuntos);    
		if(restaPuntos > 0) ganador = ' Gano este set ' + nombrelocal;
		else 
		if(restaPuntos < 0) ganador = ' Gano este set ' + 	nombrevisitante;
		else ganador = ' Empatados  ' + nombrelocal + ' y ' +  nombrevisitante;

		$("#CSet211").append('<div id="grid-CSet211"  class="grid-CSets311"><div class="gcsets7">'+
		'Set'+v.setnumero+' L: '+v.puntoa+' V: '+v.puntob+ganador+'</div>'+'<div class="gcsets6"><img src="'+img+'" class="" title="'+v.DescEstado+'"></img>'+'</div>'+
		'<div class="gcsets4">'+eliminarSet+'</div><div class="gcsets8">'+accionTablero+'</div><div class="gcsets3">'+accion+'</div>'+altajugadorea+cargaPosicionA+altajugadoreb+cargaPosicionB+'<div class="gcsets5">'+horaSet+'</div></div>');		
	});
	},
	error: function (xhr, ajaxOptions, thrownError) {
	// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
	}
	}); // FIN funcion ajax CargarPantalla()
}


		$(document).ready(function(){

			//empiezan ocultos para que no sea muy desordenado lo que se vé..
				$("#BorrarHora").hide();
				$("#horainiciofin").hide();
			//empiezan ocultos para que no sea muy desordenado lo que se vé..
		// RECUPERO LA HORA DEL SISTEMA, SI ES QUE SE GUARDÓ	
		<?php
			require_once('./abms/SesionTabla.php');
			$HoraSistemaSaved =  SesionTabla::getsessionX("'HORASISTEMA'"); //texto clave
			if(isset($HoraSistemaSaved["sesorigen"])){
				echo "$('#HoraSistema').val('".$HoraSistemaSaved["sesorigen"]."');";

			}				
		?>		
		// RECUPERO LA HORA DEL SISTEMA, SI ES QUE SE GUARDÓ	

			//$("#icarpetas")
			var f=new Date();
			var fechapartido = f.getFullYear()-1 ;
			fechainicial = fechapartido -10;
			fechaFinal   = fechapartido +10;
			for (var i = fechainicial; i < fechaFinal; i++) 
			{
				if(i == fechapartido) $("#ianio").prepend('<option selected>' + (i + 1) + '</option>');
				else  $("#ianio").prepend('<option>' + (i + 1) + '</option>');
			}
			
			var FechaParametros = parametroURL('fecha');
			
			//CHATGPT Supongamos que el campo de texto tiene un ID de "miCampoTexto"
			var valorCampoTexto = FechaParametros; //$('#miCampoTexto').val();
			var fecha = new Date(valorCampoTexto);
			var anio = fecha.getFullYear();

			//alert(anio); // Mostrará el año extraído del campo de texto

			$("#ianio").prop('disabled', true);
			
				$("#ianio").val(anio);
			
// -------------------------------------------------	
// CREAR CRONOMETRO PARA TENER LA HORA A MANO
// -------------------------------------------------	
		var dt = new Date();
//		var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
	    var tiempo = {
	        hora: dt.getHours(),
	        minuto: dt.getMinutes(),
	        segundo: dt.getSeconds()
	    };

		var vHoraSistema = $("#HoraSistema").val();
		if (vHoraSistema != '')	
				var a1 = vHoraSistema.split(':'); // [18, 30, 01] -hora fingida sistema

		// FINGIENDO QUE LA HORA DE SISTEMA SIMULADA ESTA AVANZANDO MILI A MILIPILIsegundos
		if (vHoraSistema != '')	{
		var tiemposistema = {
	        hora: a1['0'],
	        minuto: a1['1'],
	        segundo: a1['2'] 
		}
			$("#BorrarHora").show();
			$("#horainiciofin").show();
		}


    	var tiempo_corriendo = null;

		tiempo_corriendo = setInterval(function(){
        // Segundos
        tiempo.segundo++;

		// MOVIENDO EL TIEMPO SIMULADO EN UN SOLO CRONOMETRO:SEGUNDOS
		if (vHoraSistema != '')
			tiemposistema.segundo++;

        if(tiempo.segundo >= 60)
        {
        	tiempo.segundo = 0;
            tiempo.minuto++;
        }      

		// MUEVO EL TIEMPO SIMULADOR TAMBIEN:SEGUNDOS+MINUTO
		if (vHoraSistema != ''){
			if(tiemposistema.segundo >= 60)
			{
				tiemposistema.segundo = 0;
				tiemposistema.minuto++;
			}      		
		}	

        // Minutos
        if(tiempo.minuto >= 60)
        {
        	tiempo.minuto = 0;
            tiempo.hora++;
        }

        // MOVIENDO TIMEPO SIMULADO: MINUTOS
		if (vHoraSistema != ''){
			if(tiemposistema.minuto >= 60)
			{
				tiemposistema.minuto = 0;
				tiemposistema.hora++;
			}
		}	

		// CRONOMETRO COMUN
		var tiempoTxtHora = tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora;
		var tiempoTxtMin  = tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto;
		var tiempoTxtSeg  = tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo;
		
		// CRONOMETRO SIMULADO
		if (vHoraSistema != ''){
		var XtiempoTxtHora = tiemposistema.hora < 10 ? '0' + tiemposistema.hora : tiemposistema.hora;
		var XtiempoTxtMin  = tiemposistema.minuto < 10 ? '0' + tiemposistema.minuto : tiemposistema.minuto;
		var XtiempoTxtSeg  = tiemposistema.segundo < 10 ? '0' + tiemposistema.segundo : tiemposistema.segundo;
		var XtiempoSinSegs = XtiempoTxtHora +':' + XtiempoTxtMin;		
			var XtiempoTxt = XtiempoTxtHora +':' + XtiempoTxtMin +':' + XtiempoTxtSeg ;
		}

		var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin +':' + tiempoTxtSeg ;

		// ACTUALIZO EL CRONOMETRO SIMULADO
		if (vHoraSistema != '')
			$("#HoraSistema").val(XtiempoTxt);

		$("#stopwatch").text(tiempoTxt);

		}, 1000); //funcion setinterval..
// -------------------------------------------------	
// CREAR CRONOMETRO PARA TENER LA HORA A MANO
// -------------------------------------------------	

					$("#CSet211").empty();
					cargaPantalla();

		$("#subirFotos").click(function(){
			$("#TablaInfoReferencial").show();
		
		});


		$("#LIMPIAR").on("click",function(e)
		{
			 $(".respuesta").html('');
			 $("#TablaInfoReferencial").hide();
		});
		
		
	    $("#fsubir").on('submit', function(e){
	        e.preventDefault();
	        $.ajax({
	            type: 'POST',
	            url:   './abms/sube_foto.php',
	            data: new FormData(this),
	            contentType: false,
	            cache: false,
	            processData:false,
		            beforeSend: function (){
		            	$("#subeFoto").val("Enviando"); // Para input de tipo button
                		$("#subeFoto").attr("disabled","disabled");
 						$('#fsubir').css("opacity",".5");
                		//$(".respuesta").html(parametros);
		            },
					complete:function(data){
	                /*
	                * Se ejecuta al termino de la petición
	                * */
	            	    $("#subeFoto").val("Sube Fotos");
    	           		$("#subeFoto").removeAttr("disabled");
        		    },		            
		            success:  function (r){
						$(".respuesta").html(r);
                		$('#fsubir').css("opacity","");
                		$("#subeFoto").attr("disabled","disabled");
						$("#TablaInfoReferencial").hide();
						
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
		});


		}); //FIN DEL READY	


		
// 		$("#jugadoresA").click(function(){
// //			var clubaid = $("#idcluba").val();
// //			window.location='CargarJugadores.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubaid+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>;
// 						//altajugadorea = '<a href="CargarJugadores.php?idpartido='+v.idpartido+'&idclub='+idclubuno+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>;
// 			//alert(idclubuno);
// 		});
		
// 		$("#jugadoresB").click(function(){
// 			// var clubbid = $("#idclubb").val();
// 			// window.location='CargarJugadores.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubbid+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
// 						//altajugadoreb = '<a href="CargarJugadores.php?idpartido='+v.idpartido+'&idclub='+idclubdos+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>;
// 			//alert(idclubdos);
// 		});

// 		$("#posicionesA").click(function(){
// 			// var clubaid = $("#idcluba").val();
// 			// var idset   = $("#numSet").text();
// 			// window.location='CargarPosiciones.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubaid+'&set='+idset+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
// 		});
		
// 		$("#posicionesB").click(function(){
// 			// var clubbid = $("#idclubb").val();
// 			// var idset   = $("#numSet").text();
// 			// window.location='CargarPosiciones.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubbid+'&set='+idset+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
// 		});

		
		</script>
    </head>
<body>
<?php include('includes/newmenu.php'); ?>
<?php 
	require_once('abms/Set.php'); 
	$idpartido = (int) $_GET['id'];
	$partidofecha = "'".$_GET['fecha']."'";
	$idnewset =0;
//		 $newset = Sett::ultSetNum($idpartido);
	 $newset = Sett::ultSetNum($idpartido,$partidofecha);
	 if($newset != "") $idnewset =(int)$newset['setnumero']; 
	  if($idnewset == 0)$idnewset=1;
			else $idnewset++; 
?>	
<dialog id="modalEsperar" class="XModales">
		<div class="donut"></div>
</dialog>

  <input type="hidden" value="ingresa valor"/>
  <input type="hidden" id="idclubA" value="ingresa valor"/>
  <input type="hidden" id="idclubB" value="ingresa valor"/>
  <input type="hidden" id="clubANombre" value="ingresa valor"/>
  <input type="hidden" id="clubBNombre" value="ingresa valor"/>  
  <input type="hidden" id="numerosetNuevo" value="nuevo set"/>
  <input type="hidden" id="categoriaPartido" value="categoria"/>

  
  <!-- <div ><span id="stopwatch" style="display: none;"></span></div> -->
  <div id="grid-CSets"	class="grid-CSets21">
	<div  class="gcset10">
				<div ><span id="stopwatch" style="display: none;"></span></div> 
				<input type="checkbox" id="CambiarHoraSistema" name="CambiarHoraSistema" onclick="activarHora(this,'HoraSistema');"/>
				<div>Hora Forzada</div>
				<input type="datetime" id="HoraSistema" name="HoraSistema" disabled />
				<!-- <time  id="HoraSistema" name="HoraSistema" disabled datetime="00:00:00" >00:00:00</time> -->
				<button  class="btnTablero" id="horainiciofin" onclick="updatehora('HoraSistema');location.reload();" >Set Hora Sistema</button>
				<button  class="btnTableroRedrackam" id="BorrarHora" onclick="limpiarhora();" >Limpia Hora</button>
	</div>		

	  <div class="gcset1">
	  	<div  class="ggcset11">
	  			<!-- <span class="hache3">Sets</span> -->
	  		  	<span>
		  			<select id="ianio" name="ianio" class="ianio">
						<option value="9999">Seleccionar año...</option>
					</select>
				</span>
	    </div>
		<div  class="ggcset12"></div>		
	  </div>
	  <div class="gcset2">
	  <?php 
	  	  require_once('abms/Partido.php');
	  	  $idpartido = (int) $_GET['id'];
		  $partidofecha = "'".$_GET['fecha']."'";
		  $partidodata = Partido::getById($idpartido,$partidofecha);

		  $idclubLocal = (int) $partidodata['idcluba'];
		  $idclubVisitante =  (int) $partidodata['idclubb'];
		  $categoriaPartido = (int) $partidodata['idcat'];
		  $setmaxs=$_GET['setmax'];
		  $fechaClean =$_GET['fecha'];
	  		echo "<a href='CargarJugadores.php?idpartido=$idpartido&setmax=$setmaxs&idclub=$idclubLocal&fecha=$fechaClean&idcate=$categoriaPartido' >";
	  	
	  	?>
	  		<button id="jugadoresA" name="jugadoresA" title="Agregar jugadores equipo Local" class="btnPop2" >Jugadores Local</button>
	  	</a>	   	
	  </div>
	  <div class="gcset3">
	  <?php 
	  	  $idpartido = (int) $_GET['id'];
		  $partidofecha = "'".$_GET['fecha']."'";
	  		echo "<a href='CargarJugadores.php?idpartido=$idpartido&setmax=$setmaxs&idclub=$idclubVisitante&fecha=$fechaClean&idcate=$categoriaPartido' >";
	  	?>	  
	  	<button id="jugadoresB" name="jugadoresB" title="Agregar jugadores equipo Visitante" class="btnPop2" >Jugadores Visitante</button>
	  	</a>	   	
	  	
	  </div>
	  <div class="gcset5">
	  	<a href="AdministrarAPP.php"><input type="button" id="volver" title="volver a partidos" name="volver" class="btnSet2021" value="<<"></input></a>
	  </div>
	  <div class="gcset6">
	  	  	<input type="button" id="nuevoset2" title="Agregar Set" name="nuevoset" class="btnSet btnAmarillo" onclick="crearSet();" value="(*)"></input>
	  </div>
	  <div class="gcset4" id="comptext">Competencia : </div>
	  <!-- <div class="gcset7">
	  	<button id="subirFotos" name="subirFotos" title="Agregar fotos al tablero" class="btnPopSubeFotos">Sube Fotos</button>
		<button   id="LIMPIAR" name="LIMPIAR" title="Limpiar mensajes" class="btnPopSubeFotos">Clear</button>
	  	<hr>
    		<p class="respuesta">
	  </div> -->
</div> 
  <div id="CSet211"	class="CSets211">
  </div>

  
<div  id="TablaInfoReferencial" class="TablaInfoReferencial">
	<form  method='POST' id='fsubir' name='fsubir' enctype='multipart/form-data' >
		<div class="itemTitulo1Ref">Subir foto para tablero del partido</div>
		<div class="itemTitulo2Ref"><input type="file" name="fotoPartido" id="fotoPartido"/></div>
		<div>
			<input type="hidden" name="partidoid"  value="<?php echo($_GET['id']); ?>"/>
			<input type="hidden" name="fechapart"  value="<?php echo($_GET['fecha']); ?>"/>			
		</div>
		<div class="itemRef0">
			<select id="icarpetas" name="icarpetas" title="carpetas de fotos" class="selectCarpetas">Carpeta destino
				<?php 
					$imagenEncontrada = scandir('./img/partidos/');
					foreach($imagenEncontrada as $indice => $valor)
						if($valor != "." && $valor != ".." && $valor != "" )
					  			echo "<option value='$valor'>$valor</option>";
				?>
			</select>
		</div>		
		<div class="itemRef">
			<button type="submit"  id="subeFoto" name="subeFoto" title="Upload foto" class="btnPopSubeFotos">Subir</button>
		</div>
	</form>
</div> 
  
</body>
</html>

