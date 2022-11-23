<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP:: configuracion de sets</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
	   
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript">

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
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
               }
		   		});
		   					
			
		};

		function crearSet(){	

		// antes de cargar todo , verifico que el partido no haya que cerrarlo !!			
			var setmax = <?php echo($_GET['setmax']); ?>;
			<?php 
				require_once('./abms/Set.php');
				$idpartido = (int) $_GET['id'];
				$partidofecha = "'".$_GET['fecha']."'";
				//$ultimoSet = Sett::ultSetNum($idpartido);
				$ultimoSet = Sett::ultSetNum($idpartido,$partidofecha);
					$idnewset =(int) $ultimoSet['setnumero']; 
				 if(!$idnewset)$idnewset=1;
					 else $idnewset++; 
		   ?>
		   var setActualSig = <?php echo($idnewset);?>;
			console.log("proximo set seria: " +setActualSig);
			console.log("y el maximo numero de sets son: " + setmax);
			
	if( setActualSig <= setmax ) 
	    {
			$("#numerosetNuevo").val(setActualSig);
		   //var setActualSig = <?php echo($idnewset);?>;
		   //if( setActualSig > setmax ) {$("#nuevoset").prop('disabled', true); $("#nuevoset").css("background","#A9AAC5");};
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
					"COPIARJUGADORES":	1 
				};
    		console.log(parametros);

    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_sets.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    		//cargaCancha();
					location.reload();
					//console.log(r);
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
		function cerrarPartido()
	        {
			    var parametros =
			    {
				 "fecha"   : <?php echo("'".$_GET['fecha']."'"); ?>,
				 "partido" : <?php echo($_GET['id']); ?>	
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
	            }); // FIN funcion ajax CLUBES
			
				
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
					
			descripcionCat = "";
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
								descripcionCat = v.DescCate;
								// agregado para guardar el id partido y tenerlo disponible..
								$("#idclubA").val(iclubA);
								$("#idclubB").val(iclubB);
								$("#categoriaPartido").val(categoriapartido);
								$("#categoriaDsc").val(descripcionCat);
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
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){
			
			},
            success:  function (r){
				// aca agregamos la logica para pegar los botones de trabajo con SET
				console.log(r);
                $(r['Sets']).each(function(i, v)
                { // indice, valor
				var accion='';
				var altajugadorea='';
				var altajugadoreb='';
				var cargaPosicionA='';
				var cargaPosicionB='';
				var eliminarSet = '';

				eliminarSet  = '<div class="EliminarSetClass">';
				//'<a href="eliminarSet.php?idpartido='+v.idpartido+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&setnum='+v.setnumero+'" >';
				eliminarSet  += '<button id="EliminarSet" name="EliminarSet" title="Eliminar Set" class="btnPop4" onClick="EliminarSet('+v.idpartido+','+v.setnumero+')" >(X)</button></div>';
								
				var nombrelocal = v.NombreClubA;
				var nombrevisitante = v.NombreClubB;
				altajugadorea = '<div>'+'<a href="CargarJugadores.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubA+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&idcate='+ v.categoria+'" >';
				altajugadorea += '<button id="jugadoresA" name="jugadoresA" title="cargar jugadores equipo A" class="btnPop2" >Jugadores '+nombrelocal+'</button></a></div>';
				//console.log(altajugadorea);
				altajugadoreb = '<div>'+'<a href="CargarJugadores.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubB+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&idcate='+ v.categoria+'" >';
				altajugadoreb += '<button id="jugadoresB" name="jugadoresB" title="cargar jugadores equipo B" class="btnPop2">Jugadores '+nombrevisitante+'</button></a></div>';
				cargaPosicionA = '<div>'+'<a href="CargarPosiciones.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubA+'&set='+v.setnumero+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>+'" >';
				cargaPosicionA += '<button id="posicionesA" name="posicionesA" title="cargar posiciones equipo A" class="btnPop2">Pos.Ini. '+nombrelocal+'</button></a></div>';
				cargaPosicionB = '<div>'+'<a href="CargarPosiciones.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubB+'&set='+v.setnumero+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>+'" >';
                cargaPosicionB += '<button id="posicionesB" name="posicionesB" title="cargar posiciones equipo B" class="btnPop2">Pos.Ini. '+nombrevisitante+'</button></a></div>';
				//console.log(cargaPosicionB);
				if(v.DescEstado.includes('PROGR')) {var img = './img/PartidoONOFF.png';}
                if(v.DescEstado.includes('FIN'))
                {
                		var img = './img/PartidoOFF.png';
//               			accion='<a href="CSets.php?id='+v.idpartido+'&setnumero='+v.setnumero;
//			  			accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'">';
//			  			accion +='<input type="button" id="verset" name="verset" class="btnVerSet" value="(ver)" title="Re-veer set"></input></a>';
//						accion ='<a href="TableroGrande.php?id='+v.idpartido+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'"><input type="button" id="verset" name="verset"';
						accion ='<a href="TableroGrandev20.php?id='+v.idpartido+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'"><input type="button" id="verset" name="verset"';						
						accion +=' class="btnVerSet" value="(ver)" title="Re-veer set"></input></a>';
						altajugadorea='';
						altajugadoreb='';
						cargaPosicionA='';
						cargaPosicionB='';
				}
                if(v.DescEstado.includes('CURSO'))
                {
                		var img = './img/PartidoON.png';
					    accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
					    accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';

					    accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
					    accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';						
					    accion +='<input type="button" id="verset" name="verset" class="btnVerSet btnCeleste" value="(Continuar)" title="Continuar set(redux)"></input></a>';                		
                }

                if(v.DescEstado.includes('INICIAL'))
                {
                		var img = './img/PartidoONOFF.png';
					    accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
					    accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';

					    accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
					    accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';						
					    accion +='<input type="button" id="verset" name="verset" class="btnVerSet btnCeleste" value="(Continuar)" title="Continuar set(redux)"></input></a>';                		
                }

				
				
             verComp++;
             if(verComp == 1)$("#comptext").append(v.cnombre);
             		
			$("#grid-CSets").append('<div class="ilp2 margen"><section class="grid-LPRSet" id="grid-LPRSet">'+
			  '<div class="ilp22" >'+'Set'+v.setnumero+'</div>'+'<div class="ilp22">'+v.puntoa+'</div>'+'<div class="ilp22">'+v.puntob+'</div>'+'<div class="imgdiv ilp22"><img src="'+img+'" class="imgEstado" title="'+v.DescEstado+'"></img>'+eliminarSet+'</div>'+
			  '<div class="ilp22">'+accion+'</div><section id="tablaBotones" class="tablaBotones">'+altajugadorea+cargaPosicionA+altajugadoreb+cargaPosicionB+'</section><div class="ilp22"></div>'+
			  '</section></div><div class="ilp11">'+
			  '</div>');		
			});
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
			// var clubaid = $("#idcluba").val();
			// var idset   = $("#numSet").text();
			// window.location='CargarPosiciones.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubaid+'&set='+idset+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
		});
		
		$("#posicionesB").click(function(){
			// var clubbid = $("#idclubb").val();
			// var idset   = $("#numSet").text();
			// window.location='CargarPosiciones.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubbid+'&set='+idset+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
		});

		
		</script>
    </head>
    <body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php 
			//include('includes/menuConfig.php');; 
			require_once('abms/Set.php'); 
			$idpartido = (int) $_GET['id'];
			$partidofecha = "'".$_GET['fecha']."'";
	 
	//		 $newset = Sett::ultSetNum($idpartido);
			 $newset = Sett::ultSetNum($idpartido,$partidofecha);
				$idnewset =(int) $newset['setnumero']; 
				if(!$idnewset)$idnewset=1;
					else $idnewset++; 
		?>	
    </header>
  <input type="hidden" value="ingresa valor"/>
  <input type="hidden" id="idclubA" value="ingresa valor"/>
  <input type="hidden" id="idclubB" value="ingresa valor"/>
  <input type="hidden" id="clubANombre" value="ingresa valor"/>
  <input type="hidden" id="clubBNombre" value="ingresa valor"/>  
  <input type="hidden" id="numerosetNuevo" value="nuevo set"/>
  <input type="hidden" id="categoriaPartido" value="categoria"/>

  <div ><span id="stopwatch" style="display: none;"></span></div>
  <section id="grid-CSets"	class="grid-CSets">
  <div class="ilp1"><h3>Sets
  <span style="padding-left: 1em;"><select id="ianio" name="ianio" class="ianio">
			<option value="9999">Seleccionar año...</option>
		</select>
  </span></h3>
<!--    <section id="lineaCSetJug" class="cronocontrolesCAB">
 		<button id="jugadoresA" name="jugadoresA" title="cargar jugadores equipo A" class="btnPop2" >Jugadores Equipo Local</button>
		<button id="posicionesA" name="posicionesA" title="cargar posiciones equipo A" class="btnPop2">POS INI. E.LOCAL</button>
		<button id="jugadoresB" name="jugadoresB" title="cargar jugadores equipo B" class="btnPop2">Jugadores Equipo Visitante</button>
    	<button id="posicionesB" name="posicionesB" title="cargar posiciones equipo B" class="btnPop2">POS INI. E.VISTANTE</button>		
    </section>
  -->
  </div>
  <div class="ilp1">
  	<a href="AdministrarAPP.php"><input type="button" id="volver" title="volver a partidos" name="volver" class="btnSet" value="<<"></input></a>
  </div>
  <div class="ilp11">
					<!--<a href="NovedadesSet20.php?id=<?php echo $idpartido; ?>&setid=<?php echo $idnewset;?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>&continuar=0"><input type="button" id="nuevoset" title="Agregar Set" name="nuevoset" class="btnSet btnAzulFrancia" value="Set(+)"></input></a>-->
					<a href="NovedadesSet.php?id=<?php echo $idpartido; ?>&setid=<?php echo $idnewset;?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>&continuar=0"><input type="button" id="nuevoset" title="Agregar Set" name="nuevoset" class="btnSet btnRojoCereza" value="Set(++)"></input></a>
</div>
  <div class="ilp1" id="comptext">Competencia : </div>
  <div class="ilp1" id="categoriaDsc"></div>
  <div class="ilp1"><input type="button" id="nuevoset2" title="Agregar Set" name="nuevoset" class="btnSet btnAmarillo" onclick="crearSet();" value="(*)"></input></div>
  <!--
  href="NovedadesSet20.php?id=<?php echo $idpartido; ?>&setid=<?php echo $idnewset;?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>&continuar=0"
  -->
  <div class="ilp11"></div>

  
</section> 


</body>
</html>

