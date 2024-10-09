<?php include('sesioner.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::ver info de Sets
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
	   <!-- ESTILOS -->
	   <style>
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

		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			if (results==null){
			   return null;
			}
			else{
			   return decodeURI(results[1]) || 0;
			}
		};

		function EliminarSet(idpartido,setnumero){};

		function updatehora(partido,setnum,sechrini,sechrfin){
			
				$("#horai_"+partido+'_'+setnum+'_'+sechrini).prop('disabled', true);
				$("#horaf_"+partido+'_'+setnum+'_'+sechrfin).prop('disabled', true);

var parametros =
			    {
				 "fechapart"   : <?php echo("'".$_GET['fecha']."'"); ?>,
				 "id" : <?php echo($_GET['id']); ?>	,
				 "setnumero" : setnum,
				 "secuenciahoraini" : sechrini,				 
				 "secuenciahorafin" : sechrfin,
				 "horainicio": $("#horai_"+partido+'_'+setnum+'_'+sechrini).val(),
				 "horafin"   : $("#horaf_"+partido+'_'+setnum+'_'+sechrfin).val(),
				 "funcion"   : "CAMBIOHORAS"
			
				};
				$.ajax({ 
						url:   './abms/updateDATA_set.php',
						type:  'GET',
						data: parametros,
						dataType: 'text json',
						beforeSend: function (){},
						done: function(data){},
						success:  function (r){
							location.reload();
						},
						error: function (xhr, ajaxOptions, thrownError) {
								// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
								console.log(thrownError);
								console.log(xhr.responseText);
								}
						}); // FIN funcion ajax obtener_partido
};    

function updatepuntos(partido,setnum,sechrini,sechrfin){
			
			$("#puntoLocal_"+partido+'_'+setnum+'_'+sechrfin).prop('disabled', true);
			$("#puntoVisitante_"+partido+'_'+setnum+'_'+sechrfin).prop('disabled', true);

var parametros =
			{
			 "fechapart"   : <?php echo("'".$_GET['fecha']."'"); ?>,
			 "id" : <?php echo($_GET['id']); ?>	,
			 "setnumero" : setnum,
			 "secuenciahoraini" : sechrini,				 
			 "secuenciahorafin" : sechrfin,
			 "nuevopuntolocal": $("#puntoLocal_"+partido+'_'+setnum+'_'+sechrfin).val(),
			 "nuevopuntovisita"   : $("#puntoVisitante_"+partido+'_'+setnum+'_'+sechrfin).val(),
			 "funcion"   : "CAMBIOPUNTOS"
		
			};
			$.ajax({ 
					url:   './abms/updateDATA_set.php',
					type:  'GET',
					data: parametros,
					dataType: 'text json',
					beforeSend: function (){},
					done: function(data){},
					success:  function (r){
						location.reload();
					},
					error: function (xhr, ajaxOptions, thrownError) {
							// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
							console.log(thrownError);
							console.log(xhr.responseText);
							}
					}); // FIN funcion ajax obtener_partido
};    

		function activarhora(control,preid,partido,setnum,secuencia){
			if ($(control).is(":checked")) 
				// it is checked
				$("#"+preid+partido+'_'+setnum+'_'+secuencia).prop('disabled', false);
			else
				$("#"+preid+partido+'_'+setnum+'_'+secuencia).prop('disabled', true);
		};    

		// FUNCION CARGA CREA NUEVO SET GENÉRICO  					
		function crearSet(){	
			// antes de cargar todo , verifico que el partido no haya que cerrarlo !!			
				var setmax = <?php echo($_GET['setmax']); ?>;
				<?php 
					require_once('./abms/Set.php');
					$idpartido = (int) $_GET['id'];
					$partidofecha = "'".$_GET['fecha']."'";
					$ultimoSet = Sett::ultSetNum($idpartido,$partidofecha);
					$idnewset=0;
					if($ultimoSet > 0)
								$idnewset =(int) $ultimoSet['setnumero']; 

					if(!$idnewset)$idnewset=1;
						else $idnewset++; 
			?>
			var setActualSig = <?php echo($idnewset);?>;
				console.log("proximo set seria: " +setActualSig);
				console.log("y el máximo número de sets son: " + setmax);
				//alert();
			if( setActualSig <= setmax ) 
			{
				$("#numerosetNuevo").val(setActualSig);
				setActualSig
			//var setActualSig = <?php echo($idnewset);?>;
				var parametros =
					{
						"idpartido" : <?php echo($_GET['id']); ?>,
						"idset"     : $("#numerosetNuevo").val(),
						"resa"      : 0,
						"resb"      : 0,
						"fechas"    : <?php echo("'".$_GET['fecha'])."'"; ?>,
						"horas"     : $("#stopwatch").text(),
						"saque"     : 0,
						"anioEquipo": $("#ianio").val() ,
						"mensajeAlta" : 'Csets2::CrearSetESTADISTICAS',
						"estadoset"			  : 2,
						"COPIARJUGADORES":	1 
					};
				//console.log(parametros);

				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
				url:   './abms/insertar_sets.php',
				type:  'POST',
				data: parametros,
				beforeSend: function (){
					
				},
				success:  function (r){
					//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
						location.reload();
						$("#comptext").append(r);	
				},
				//error: function() {
				error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA				
						console.log(thrownError);
				}
				});

			}
			else { $("#comptext").append('<br>Máximo numero de sets alcanzado..');};
			};  
			// FIN DE LA FUNCION CARGA CREA NUEVO SET GENÉRICO  


		idclubuno = 0;
		idclubdos = 0;
		function cerrarPartido(){
			// en esta pantalla de visualizacion, solo deshabilito el boton de CREAR
			$("#nuevoset2").prop('disabled', true);
			alert('SE DESHABILITÓ EL BOTON PARA CREAR SETS, PORQUE YA HUBO GANADOR CON LOS DATOS CARGADOS..');

		};  
		
		$(document).ready(function(){
			
			var f=new Date();
			var fechapartido = f.getFullYear()-1 ;
			fechainicial = fechapartido -10;
			fechaFinal   = fechapartido +10;
			for (var i = fechainicial; i < fechaFinal; i++) 
			{
				if(i == fechapartido) $("#ianio").prepend('<option selected>' + (i + 1) + '</option>');
				else  $("#ianio").prepend('<option>' + (i + 1) + '</option>');
			}
			$("#ianio").prop('disabled', true);
		
			
			
		var dt = new Date();
//		var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
	    var tiempo = {
	        hora: dt.getHours(),
	        minuto: dt.getMinutes(),
	        segundo: dt.getSeconds()
	    };

    	var tiempo_corriendo = null;

		tiempo_corriendo = setInterval(function(){
        // Segundos
        tiempo.segundo++;
        if(tiempo.segundo >= 60)
        {
        	tiempo.segundo = 0;
            tiempo.minuto++;
        }      

        // Minutos
        if(tiempo.minuto >= 60)
        {
        	tiempo.minuto = 0;
            tiempo.hora++;
        }

		var tiempoTxtHora = tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora;
		var tiempoTxtMin  = tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto;
		var tiempoTxtSeg  = tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo;
		
		var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin +':' + tiempoTxtSeg ;
				
		$("#stopwatch").text(tiempoTxt);

		}, 1000); //funcion setinterval..
					
			
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
						beforeSend: function (){
							
						},
						done: function(data){
								
						},
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
								$("#categoriaDescripcion").append(v.DescCate);
								$("#categoriaPartido").val(categoriapartido);
								var anioNum = 0;
								<?php echo("var anioNum = ".substr($_GET['fecha'],0,4).";"); ?>
								$("#ianio").val(anioNum);
								
								// agregado para guardar el id partido y tenerlo disponible..
								$("#clubANombre").val(v.ClubA);
								$("#clubBNombre").val(v.ClubB);
								
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
											beforeSend: function (){
												
											},
											done: function(data){
													
											},
											success:  function (r){
//												console.log(r['ganador']);
												if( r['ganador'] != -1 ) cerrarPartido();
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
				$idnewset = 1;
				if($ultimoSet > 0)
					$idnewset =(int) $ultimoSet['setnumero']; 
				 if(!$idnewset)$idnewset=1;
					 else $idnewset++; 
		   ?>
		   var setActualSig = <?php echo($idnewset);?>;
			//alert("proximo set seria: " +setActualSig);
			//alert("y el maximo numero de sets son: " + setmax);
			
			$("#nuevoset").prop('disabled', true);
			
			
			$("#nuevoset").css("background","#A9AAC5");
			
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
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){
			
			},
            success:  function (r){
				// aca agregamos la logica para pegar los botones de trabajo con SET
				if(r['estado'] != 1){
					if(r['nombre'].includes('Sin set data'))
					{ 
						$("#comptext").append(r['nombre']+ '<br>Agregar datos genéricos set ->> ');
						var boton = '<input type="button" id="nuevoset2" title="Agregar Set" name="nuevoset" class="btnSet btnAmarillo" onclick="crearSet();" value="(*)">';
						$("#comptext").append(boton);
					}
				}	
				else
				{
					$(r['Sets']).each(function(i, v)
					{ // indice, valor
					var accion='';
					var altajugadorea='';
					var altajugadoreb='';
					var cargaPosicionA='';
					var cargaPosicionB='';
					var eliminarSet = '';
					var llamador = $.urlParam('llama');
					var BtnActHr = '<button  id="horainiciofin" onclick="updatehora('+v.idpartido+','+v.setnumero+','+v.primseq+','+v.ultmseq+');" >update</button>';
					// CONTROLES DE PUNTOS
					var puntoLocal = '<input type="number" id="puntoLocal_'+v.idpartido+'_'+v.setnumero+'_'+v.ultmseq +'" name="puntoLocal_'+v.idpartido+'_'+v.setnumero+'_'+v.ultmseq +'" value="'+v.puntoa+'" disabled></input>';
					var puntoVisitante = '<input type="number" id="puntoVisitante_'+v.idpartido+'_'+v.setnumero+'_'+v.ultmseq +'" name="puntoVisitante_'+v.idpartido+'_'+v.setnumero+'_'+v.ultmseq +'" value="'+v.puntob+'" disabled></input>';
					var accionUpdatePuntos = '<button  class="puntosAB" id="puntosAB" onclick="updatepuntos('+v.idpartido+','+v.setnumero+','+v.primseq+','+v.ultmseq+');" >update puntos</button>';

					if(llamador == 'index') BtnActHr='';
				
					if(llamador == 'index')  $("#volverLinx").attr("href", 'index.php');	
					
					eliminarSet  = '<div class="grillahsset"><div class="grillahssetitem1">Inicio</div>'+
								'<div class="grillahssetitem2"><input type=checkbox id="horainicio" onclick="activarhora(this,\''+'horai_\','+v.idpartido+','+v.setnumero+','+v.primseq+');" /></div>'+
									'<div class="grillahssetitem3">'+
										'<input type="time" id="horai_'+v.idpartido+'_'+v.setnumero+'_'+v.primseq+'" name="horai_'+v.idpartido+'_'+v.setnumero+'_'+v.primseq+'" value="'+v.horainicio+'"/></div>'+
									'<div class="grillahssetitem4">Fin</div>'+
									'<div class="grillahssetitem5"><input type=checkbox id="horafin" onclick="activarhora(this,\''+'horaf_\','+v.idpartido+','+v.setnumero+','+v.ultmseq+');"/></div>'+								
									'<div class="grillahssetitem6">'+
										'<input type="time" id="horaf_'+v.idpartido+'_'+v.setnumero+'_'+v.ultmseq+'" name="horaf_'+v.idpartido+'_'+v.setnumero+'_'+v.ultmseq+'" value="'+v.horafin+'"/></div>'+
									'<div class="grillahssetitem7">'+BtnActHr+'</div>'+		
									'<div class="grillahssetitem81"><span>Local</span><input type=checkbox id="horainicio" onclick="activarhora(this,\''+'puntoLocal_\','+v.idpartido+','+v.setnumero+','+v.ultmseq+');" /></div>'+		
									'<div class="grillahssetitem8">'+puntoLocal+'</div>'+		
									'<div class="grillahssetitem91"><span>Vte.</span><input type=checkbox id="horainicio" onclick="activarhora(this,\''+'puntoVisitante_\','+v.idpartido+','+v.setnumero+','+v.ultmseq+');" /></div>'+	
									'<div class="grillahssetitem9">'+puntoVisitante+'</div>'+									
									'<div class="grillahssetitem10">'+accionUpdatePuntos+'</div>'+	
									'</div>';			

					var nombrelocal = v.NombreClubA;
					var nombrevisitante = v.NombreClubB;
					altajugadorea = '<div class="gcsets4">'+'<a href="CargarJugadores.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubA+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&idcate='+ v.categoria+'" >';
					altajugadorea += '<button id="jugadoresA" name="jugadoresA" title="cargar jugadores equipo A" class="btnPop2" >Jugadores '+nombrelocal+'</button></a></div>';
					//console.log(altajugadorea);
					altajugadoreb = '<div class="gcsets5">'+'<a href="CargarJugadores.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubB+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&idcate='+ v.categoria+'" >';
					altajugadoreb += '<button id="jugadoresB" name="jugadoresB" title="cargar jugadores equipo B" class="btnPop2">Jugadores '+nombrevisitante+'</button></a></div>';
					cargaPosicionA = '<div class="gcsets6">'+'<a href="VerPosiciones.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubA+'&set='+v.setnumero+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>+'&ver=S&anio='+<?php echo(substr($_GET['fecha'],0,4)); ?>+'&idcate='+ v.categoria+'">';
					cargaPosicionA += '<button id="posicionesA" name="posicionesA" title="cargar posiciones equipo A" class="btnPop2">Pos.Ini. '+nombrelocal+'</button></a></div>';
					cargaPosicionB = '<div class="gcsets7">'+'<a href="VerPosiciones.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubB+'&set='+v.setnumero+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>+'&ver=S&anio='+<?php echo(substr($_GET['fecha'],0,4)); ?>+'&idcate='+ v.categoria+'" >';
					cargaPosicionB += '<button id="posicionesB" name="posicionesB" title="cargar posiciones equipo B" class="btnPop2">Pos.Ini. '+nombrevisitante+'</button></a></div>';
					//console.log(cargaPosicionB);

					if(v.DescEstado.includes('PROGR')) {var img = './img/PartidoONOFFSQR.png';}
					if(v.DescEstado.includes('LLUVI')){ var img = './img/rain-icon-png.jpg';}

					if(v.DescEstado.includes('FIN'))
					{
							var img = './img/PartidoOFFSQR.jpg';
							//accion ='<a href="TableroGrande.php?id='+v.idpartido+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&set='+v.setnumero+'"><input type="button" id="verset" name="verset"';                		
							// accion ='<a href="TableroGrandev25.php?id='+v.idpartido+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&set='+v.setnumero+'"><input type="button" id="verset" name="verset"';
							// accion +=' class="btnVerSet" value="(ver)" title="Re-veer set"></input></a>';
							accionTablero ='<input type="button" id="verset" name="verset"';
							accionTablero +=' class="btnTablero" value="Tablero" title="Tablero" onclick="';
							accionTablero +='TableroGrandev25.php?id='+v.idpartido+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&set='+v.setnumero+'"></input>';

							altajugadorea='';
							altajugadoreb='';
							//cargaPosicionA='';
							//cargaPosicionB='';
					}
					if(v.DescEstado.includes('CURSO'))
					{
							var img = './img/PartidoONSQR.png';
							accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
							accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';

							accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
							accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';						
							accion +='<input type="button" id="verset" name="verset" class="btnPop2" value="(Continuar)" title="Continuar set(redux)"></input></a>';                		
					}

					if(v.DescEstado.includes('INICIAL'))
					{
							var img = './img/PartidoONOFFSQR.png';
							accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
							accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';

							accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
							accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';						
							accion +='<input type="button" id="verset" name="verset" class="btnPop2" value="(Continuar)" title="Continuar set(redux)"></input></a>';                		
					}
					verComp++;
					if(verComp == 1){
						$("#comptext").append(v.cnombre);

					// DEJO A LA VISTA EL BOTÓN DE CREAR PARA AGREGAR DATA DE LOS OTROS SETS
					$("#comptext").append('<br>Agregar datos genéricos set ->> ');
						var boton = '<input type="button" id="nuevoset2" title="Agregar Set" name="nuevoset" class="btnSet btnAmarillo" onclick="crearSet();" value="(*)">';
						$("#comptext").append(boton);
					// DEJO A LA VISTA EL BOTÓN DE CREAR PARA AGREGAR DATA DE LOS OTROS SETS

					}	
							
					var ganador ="";
		//             console.log("PUNTO EQUIPO A: "+v.puntoa+" PUNTOS EQUIPO B: "+v.puntob);
					var restaPuntos =  (v.puntoa - v.puntob);
		//       	  console.log("difrernca: " + restaPuntos);    
					if(restaPuntos > 0) ganador = ' Gano este set ' + nombrelocal;
						else 
							if(restaPuntos < 0) ganador = ' Gano este set ' + 	nombrevisitante;
									else ganador = ' Empatados  ' + nombrelocal + ' y ' +  nombrevisitante;

							
							
					$("#CSet211").append('<div id="grid-CSet211"  class="grid-VerSets211"><div class="gcsets1">'+
					'Set'+v.setnumero+' L: '+v.puntoa+' V: '+v.puntob+ganador+'</div>'+'<div class="imgdiv gcsets2"><img src="'+img+'" class="imgEstado" title="'+v.DescEstado+'"></img>'+'</div>'+
					'<div class="gcsets8">'+eliminarSet+'</div><div class="gcsets3">'+accionTablero+'</div>'+altajugadorea+cargaPosicionA+altajugadoreb+cargaPosicionB+'<div class="gcsets9"></div></div>');		

						$("#horai_"+v.idpartido+'_'+v.setnumero+'_'+v.primseq).prop('disabled', true);
						$("#horaf_"+v.idpartido+'_'+v.setnumero+'_'+v.ultmseq).prop('disabled', true);
				});
			}
			
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			}
            }); // FIN funcion ajax CLUBES
		}); 	


		
		
		$("#jugadoresA").click(function(){
//			var clubaid = $("#idcluba").val();
//			window.location='CargarJugadores.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubaid+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>;
						//altajugadorea = '<a href="CargarJugadores.php?idpartido='+v.idpartido+'&idclub='+idclubuno+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>;
			//alert(idclubuno);
		});
		
		$("#jugadoresB").click(function(){
			// var clubbid = $("#idclubb").val();
			// window.location='CargarJugadores.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubbid+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
						//altajugadoreb = '<a href="CargarJugadores.php?idpartido='+v.idpartido+'&idclub='+idclubdos+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>;
			//alert(idclubdos);
		});

		$("#posicionesA").click(function(){

		});
		
		$("#posicionesB").click(function(){
		});

		
		</script>
    </head>
<body>
<?php include('includes/newmenu.php'); ?>
<?php 
	require_once('abms/Set.php'); 
	$idpartido = (int) $_GET['id'];
	$partidofecha = "'".$_GET['fecha']."'";

//		 $newset = Sett::ultSetNum($idpartido);
	 $newset = Sett::ultSetNum($idpartido,$partidofecha);
	 //echo "VALOR CONSULTA :$newset <BR>";
	 	$idnewset = 1;
		if($newset)
			$idnewset =(int) $newset['setnumero']; 
		if(!$idnewset)$idnewset=1;
			else $idnewset++; 
?>	
  <input type="hidden" value="ingresa valor"/>
  <input type="hidden" id="idclubA" value="ingresa valor"/>
  <input type="hidden" id="idclubB" value="ingresa valor"/>
  <input type="hidden" id="clubANombre" value="ingresa valor"/>
  <input type="hidden" id="clubBNombre" value="ingresa valor"/>  
  <input type="hidden" id="numerosetNuevo" value="nuevo set"/>
  <input type="hidden" id="categoriaPartido" value="categoria"/>

  <div ><span id="stopwatch" style="display: none;"></span></div>
  <div id="grid-CSets"	class="grid-CSets21">
	  <div class="gcset1">
	  	<div  class="ggcset11">
	  			<span class="hache3">Sets</span>
	  		  	<span>
		  			<select id="ianio" name="ianio" class="ianio">
						<option value="9999">Seleccionar año...</option>
					</select>
				</span>
		</div>
	  </div>
	  <div class="gcset2">
	  	<a  id='volverLinx' name='volverLinx' href="AdministrarAPP.php"><input type="button" id="volver" title="volver a partidos" name="volver" class="btnSet2021" value="<<"></input></a>
		<span id="categoriaDescripcion" class="DescripcionesGrande"></span>
	  </div>
	  <div class="gcset3">
			<a href="NovedadesSet.php?id=<?php echo $idpartido; ?>&setid=<?php echo $idnewset;?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>&continuar=0"><input type="button" id="nuevoset" title="Agregar Set" name="nuevoset" class="btnSet2021 btnRojoCereza" value="Set(cont)"></input></a>
	  </div>
	  <div class="gcset4" id="comptext">Competencia : </div>
<!--	  <div class="gcset5">
	  	<input type="button" id="nuevoset2" title="Agregar Set" name="nuevoset" class="btnSet btnGris" onclick="crearSet();" value="(*)" disabled="true"></input>
	  </div>
-->	  
</div> 
  <div id="CSet211"	class="CSets211">
  </div>
</body>
</html>

