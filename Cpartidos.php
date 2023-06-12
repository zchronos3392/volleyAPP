<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C2//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP::Configurar Partidos</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link rel="stylesheet" href="./css/tableroControl_style.css">

	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
<!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="./scripts/partido_script.js"></script> 
<!--SCRIPTS-->
	   <script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO

//+++++++++++++++ CREAMOS LOS VECTORES GLOBALES DESDE DONDE RE CARGAREMOS INFINITAMENTE LOS COMBOS..
		var vCategorias = new Array();
		var vEquipos = new Array();
		var vCanchas = new Array();
		var vSedes   = new Array();
		var vCiudades = new Array();
		var vCompetencias = new Array();
// +++++++++++++++++ FUNCIONES EXTRA ++++++++++++++++++++++++++++++++++++++


// +++++++++++++++++ FUNCIONES START DE VECTORES  ++++++++++++++++++++++++++++++++++++++
// TRAIGO UNA VEZ VECTOR DE CATEGORIAS, EQUIPOS PARA LOCA Y VISITANTE,CANCHAS Y CIUDADES			
function cargarCategoriasStart(){
	// EdadFin: "22"
	// EdadInicio: "16"
	// categoriaActiva: "1"
	// descripcion: "SUB 21[CAB]"
	// idcategoria: "20"
	// setMax: "5"	
	iCategorias = new Array();
	$.ajax({ 
		 url:   './abms/obtener_categorias.php',
		 type:  'GET',
		 dataType: 'json',
		 async:false,
		 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		 beforeSend: function (){},
		 done: function(data){},
		 success:  function (r){
			iCategorias = Object.values(r['Categorias']);
			 //console.log(iPosiciones);
		  },
		  error: function (xhr, ajaxOptions, thrownError) {}
		 }); // FIN funcion ajax	
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
 //alert(iPosiciones);	
  return iCategorias;				
}


function cargarEqupoStart(){
// clubabr:"77FC"
// escudo: ""
// idciudad: "0"
// idclub: "2"
// nombre: "77 FUTBOL CLUB"	
	iEquipos = new Array();
	$.ajax({ 
		 url:   './abms/obtener_clubes.php',
		 type:  'GET',
		 dataType: 'json',
		 async:false,
		 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		 beforeSend: function (){},
		 done: function(data){},
		 success:  function (r){
			iEquipos = Object.values(r['Clubes']);
			 //console.log(iPosiciones);
		  },
		  error: function (xhr, ajaxOptions, thrownError) {}
		 }); // FIN funcion ajax	
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
 //alert(iPosiciones);	
  return iEquipos;			
}

function cargarSedesStart(){
	// NO FUNCIONABA PORQUE NO LA COPIÉ TAL CUAL LAS OTRAS 
	// QUE TIENEN QUE TENER SI O SI EL 		 async:false,
	// SINO NO VAN A ESTAR CARGADAS PARA CUANDO SE NECESITEN !!!!
	iSedes = new Array();
	$.ajax({ 
            url:   './abms/obtener_sedes.php',
            type:  'GET',
            dataType: 'json',
			async:false,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
               // $(r['Sedes']).each(function(i, v)
			   iSedes = Object.values(r['Sedes']);

			},
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax SEDES
			iSedes.sort(function(a, b)
			{
				return a.idclub - b.idclub;
			});

return iSedes;	
}	

function cargarCanchasStart(){
	// 	clubabr:"B.VISTA"
	// dimensiones:"Ok"
	// extras:"BELLA VISTA"
	// foto:null
	// idcancha:"12"
	// idclub:"20"
	// idsede:"1"
	// nombre:"Gimnasio Central"
	// ubicacion "ENTRE RIOS 854"	
	iCanchas = new Array();
	$.ajax({ 
		 url:   './abms/obtener_canchas.php',
		 type:  'GET',
		 dataType: 'json',
		 async:false,
		 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		 beforeSend: function (){},
		 done: function(data){},
		 success:  function (r){
			iCanchas = Object.values(r['Canchas']);
			 //console.log(iPosiciones);
		  },
		  error: function (xhr, ajaxOptions, thrownError) {}
		 }); // FIN funcion ajax	
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
 //alert(iPosiciones);	
  return iCanchas;		
}

function cargarCompetenciasStart()
{
	iCompetencias = new Array();
	$.ajax({ 
		url:   './abms/obtener_comps.php',
		 type:  'GET',
		 dataType: 'json',
		 async:false,
		 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		 beforeSend: function (){},
		 done: function(data){},
		 success:  function (r){
			iCompetencias = Object.values(r['Competencias']);
			 //console.log(iPosiciones);
		  },
		  error: function (xhr, ajaxOptions, thrownError) {}
		 }); // FIN funcion ajax	
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
 return iCompetencias;	
}

function cargarCiudadesStart(){

iCiudades = new Array();
$.ajax({ 
	 url:   './abms/obtener_ciudades.php',
	 type:  'GET',
	 dataType: 'json',
	 async:false,
	 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
	 beforeSend: function (){},
	 done: function(data){},
	 success:  function (r){
		iCiudades = Object.values(r['Ciudades']);
		 //console.log(iPosiciones);
	  },
	  error: function (xhr, ajaxOptions, thrownError) {}
	 }); // FIN funcion ajax	
// TRAIGO UNA VEZ VECTOR DE PUESTOS			
//PROBANDO LA CARGA UNICA DE LAS POSICIONES
//alert(iPosiciones);	
return iCiudades;	
}

// +++++++++++++++++ FUNCIONES START DE VECTORES  ++++++++++++++++++++++++++++++++++++++

// +++++++++++++++++ FUNCIONES CREAR COMBOS SEGUN VECTORES EN MEMORIA  ++++++++++++++++++++++++++++++++++++++
function creaCategoriasx(nombreObj){
	// console.log('crear Categoria para : ' + "#"+nombreObj+"_"+idpartido );
	var selectCats = "";
			// esto arreglo el tema del alta triplle..

		$(vCategorias).each(function(i, v)
		{ // indice, valor
				// console.log('Datos categoria: '+v.descripcion);
				$("#"+nombreObj).append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
		});		
	
	return 	selectCats ;
	};

function buscarCiudadClub(clubOrigen)
{
	var selectEquipoCiudad = 0;
	$(vEquipos).each(function(i, v)
		{ // indice, valor
			if( v.idclub == clubOrigen)
				selectEquipoCiudad = v.idciudad;
		});		
	
	return 	selectEquipoCiudad ;

}

	function creaEquiposx(nombreObj){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	var selectEquipos = "";
			// esto arreglo el tema del alta triplle..
		$(vEquipos).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
		});		
	
	return 	selectEquipos ;
	};

	function creaCanchasx(nombreObj){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	var selectCanchas = "";
			// esto arreglo el tema del alta triplle..
		$(vCanchas).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idcancha + '">' +v.clubabr+' - '+ v.extras+' - '+ v.nombre + '</option>');
		});		
	
	return 	selectCanchas ;
	};

	function creasCompetenciasx(nombreObj)
{
	var selectCompetencia = "";
			// esto arreglo el tema del alta triplle..
		$(vCompetencias).each(function(i, v)
		{ // indice, valor
			if(v.competenciaActiva == 1)
				$("#"+nombreObj).append('<option value="' + v.idcomp + '">' + v.cnombre + '</option>');

		});		
		
	return 	selectCompetencia ;
}

function creasCiudadesx(nombreObj){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	// Nombre:"Banfield"
	// idCiudad:"13"
	// provincia:"Buenos Aires"	
		var selectCiudad  = "";
			// esto arreglo el tema del alta triplle..
		$(vCiudades).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
			//alert(selectPuesto);
		});		
		
	return 	selectCiudad ;
};

function creasSedesx(nombreObj)
{
	var selectSede = "";
	var clubNombreAbr = "";

	// esto arreglo el tema del alta triplle..
		$(vSedes).each(function(i, v)
		{ // indice, valor

				$(vEquipos).each(function(u, w)
				{ // indice, valor
					 if (v.idclub == w.idclub) clubNombreAbr =  w.clubabr;
				});		
				// guardo la clave doble en el option value : v.idclub+"_"v.idsede	
				$("#"+nombreObj).append('<option value="' + v.idclub+"_"+v.idsede + '"> ( ' + clubNombreAbr+' )'+ v.direccion + '-'+v.extras +'</option>');
			//alert(selectPuesto);
		});		
		
	return 	selectSede ;

}
// +++++++++++++++++ FUNCIONES CREAR COMBOS SEGUN VECTORES EN MEMORIA  ++++++++++++++++++++++++++++++++++++++


// +++++++++++++++++++++++ FUNCIONES EN GENERAL +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function SeleccionaClubLocal(objetoClubID)
{
	var clubOrigen = $("#"+objetoClubID).val();
	//console.log(vSedes);
	// borro objeto Cancha 
	// recorro objeto cancha, si encontré alguna, le asigno el valor de la primera que encuentro
	// necesito recorrer las sedes !!!!
	$(vSedes).each(function(i, v)
	{
		// la forma de llegar a la cancha, es atraves de la sede
		if (v.idclub == clubOrigen )
		{
			$(vCanchas).each(function(j, w)
			{ // indice, valor
				if( ( w.idclub == v.idclub ) && (w.idsede == v.idsede) )
				{
					//alert('encontre una cancha del club, me ubico ahi..club: '+ v.idclub +' cancha id ' +w.idcancha+ ' sede: '+w.idsede);
					$("#isede").val(v.idclub+"_"+v.idsede);
					//$("#icancha").val(w.idcancha);
					//asignar la ciudad tambien..
					ciudadCancha = buscarCiudadClub(clubOrigen);
					$("#icity").val(ciudadCancha);	
					//asignar la ciudad tambien..
					return true; //	solo lo hace una vez
					// return true; SIGUE CORRIENDO
				}
			});
		}
	}); 
}	
// +++++++++++++++++++++++ FUNCIONES EN GENERAL +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function buscarClub(origen,destinoId){
	
	var parametros = {
    	"llamador" : "CPartidos",
    	"funcion" : "buscarclub",			
    	"filtro" : $("#"+origen).val(),
		};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#"+destinoId).empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $("#"+destinoId).find("option[value='" + v.idclub + "']").length)
                	{
						$("#"+destinoId).append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					}		
                });
             },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			 console.log(xhr);
			 console.log(thrownError);
			}
            }); // FIN funcion ajax CANCIONES todas:
};
//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 
function buscarCanchasClub(clubOrigen,destinoId){
	
	var parametros = {
    	"llamador" : "CPartidos",
    	"funcion" : "buscarcancha",			
    	"filtro" : clubOrigen,
		};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#"+destinoId).empty();
    		},
            done: function(data){
			},
            success:  function (r){
 				
 				if($(r['estado'])!= 99){
                $(r['Canchas']).each(function(i, v)
                { // indice, valor
						$("#"+destinoId).append('<option value="' + v.idcancha + '">' +v.clubabr+' - '+ v.extras+' - '+ v.nombre + '</option>');
				if(v.idciudad != 0)		
	                $("#icity").val(v.idciudad);
	            else
	            {
              	if (! $("#icity").find("option[value='0']").length)
                {
		             $("#icity").append('<option value="0">Club sin ciudad asignada aun..</option>');
					 $("#icity").val(v.idciudad);
				 } 
				}
                });
 				}	
 				else
 					$("#"+destinoId).append('<option value="' + r['estado'] + '">' +r['Canchas'] + '</option>');
             },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			 console.log(xhr);
			 console.log(thrownError);
			}
            }); // FIN funcion ajax CANCIONES todas:
};
		
		
		var parametros = {"CPartido" : "S"};		         

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
		 	
		 	// esta linea aca y luego en partido_script.js frenan el submit 
		 	$("#FormPartidosMulti").submit(function(e){e.preventDefault();});			
		 	
		 
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
				// stopwatchjquery
		 
		 
		 var f=new Date();
		 var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
		 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
		 				,"27","28","29","30","31");
		 var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
		 var fechapartido = f.getFullYear() + "-" + meses[f.getMonth()] + "-" +dias[(f.getDate()-1)] ;
		 	//alert(fechapartido);
		 	// EL FORMATO SIEMPRE TIENE QUE SER YYYY-MM-DD 
			//fechapartido = '2018-10-16';
		 $("#fechap").val(fechapartido);

		 vCategorias = cargarCategoriasStart();
		 vEquipos = cargarEqupoStart();
		 vCanchas = cargarCanchasStart();
		 vSedes   = cargarSedesStart();
		 vCiudades = cargarCiudadesStart();
		 vCompetencias = cargarCompetenciasStart();

		//CREAMOS LOS COMBOS EN BASE A LOS VECTORES..		
		 	creasCompetenciasx("icomp");
			creaCategoriasx('icate');
			creaEquiposx("iclub");
			creaEquiposx("iclubb");
		    creaCanchasx('icancha');
		    creasCiudadesx('icity');
			creasSedesx('isede');		
		

			$("#iclub").on("keypress, keydown, keyup", function(e) {
  				var code = e.keyCode || e.which;
						 SeleccionaClubLocal("iclub");
			});
			$("#iclub").on("click change", function(e) {
  				var code = e.keyCode || e.which;
				 		SeleccionaClubLocal("iclub");  
			});			

			$("#sede").on("keypress, keydown, keyup", function(e) {
  				var code = e.keyCode || e.which;
				 var idClub_sede = $(this).val();
					 var idClub=idClub_sede.split('_')[0];
					 var idSede=idClub_sede.split('_')[1];
		//			 alert('club: ' + idClub + ' sede: ' + idSede);	
				 // la forma de llegar a la cancha, es atraves de la sede
				$(vCanchas).each(function(j, w)
				{ // indice, valor
					if( (w.idsede == idSede ) && (w.idclub == idClub)  )
					{
						$("#icancha").val(w.idcancha);
						return true; //	solo lo hace una vez
					}
				});
			});

			$("#isede").on("click change", function(e) {
  				var code = e.keyCode || e.which;
				 
				  var idClub_sede = $(this).val();
					  var idClub=idClub_sede.split('_')[0];
					 var idSede=idClub_sede.split('_')[1];
		//				alert('club: ' + idClub + ' sede: ' + idSede);	
				 // la forma de llegar a la cancha, es atraves de la sede
				$(vCanchas).each(function(j, w)
				{ // indice, valor
					if( (w.idsede == idSede ) && (w.idclub == idClub)  )
					{
						$("#icancha").val(w.idcancha);
						return true; //	solo lo hace una vez
					}
				});

			});			



//**************** PARTIDPS *********************************************/ 
   // AJAX DE CARGA POR set maximos por categoria
 //********************************/change del ICate
  
         $("#icate").on("click onchange",function()
         {
			var categoriaELegida = $("#icate").val();	
			$(vCategorias).each(function(i, v)
			{ // indice, valor
				if(v.idcategoria == categoriaELegida )
					$("#SetMaxCat").val(v.setMax);
			});		

          });//change del ICate
//********************************/change del ICate

//********************************/change del icomt
$("#icomp").on("click onchange",function()
         {
         if($("#icomp").val() != 9999)
         {
			var competenciaElegida = $("#icomp").val();	
			$(vCompetencias).each(function(i, v)
				{ // indice, valor
					if(v.idcomp == competenciaElegida)
						$("#SetMaxComp").val(v.setnmax);
			    });		
		 }

	});//change del ICate
//********************************/change del IComp
			
		}); // parentesis del READY

		</script>
    </head>
<body>
    <?php include('includes/newmenu.php'); ?>

<section class="FormCargaPartidos">
	<form action="" method="post" name="FormPartidosMulti" id="FormPartidosMulti" enctype="multipart/form-data" class="PartidoCab">
		<section class="Botonera">
			<span>Alta Partidos</span>
			<button class="btnCabecera" id="altap" name="altap" value="altap">(A+)</button>
			<a href="AdministrarAPP.php"><input type="button" id="volver" title="volver a partidos" name="volver" class="btnSet2021" value="<<"></input></a>
		</section>
		<section class="Cabecera">
			<div>Competencia</div>
			<select id="icomp" name="icomp">
				<option value="9999">Seleccione una competencia</option>
			</select>
			<div class="SetMaximosGrid">
				<label>Sets</label>
				 <input type="text" id="SetMaxComp" name="SetMaxComp" class="inputSets" disabled="">
			</div>	
		</section>

		<div class="DatosPartido">	
			<section class="DatosPartidoDetalle" id="DatosPartidoDetalle" name="DatosPartidoDetalle">
				<section id="DatosPartido_item" class="itemDatosPartidoDetalle">
					<div class="fechapartido">
					<label for="fechap">FECHA X</label>
					<input type="date" id="fechap" name="fechap"></div>
					<div class="renglonHoraCat">
						<div class="renHC1">
							<label for="dscp">CODIGO </label>
						</div>
						<div class="renHC2">
							<input type="text" id="dscp" name="dscp">
						</div>
						<div class="renHC3">
							<label for="horai">Hora inicio</label>
						</div>
						<div class="renHC4">
							<input type="time" id="horai" name="horai"></div>
						<div class="renHC5">
							<label for="icate">Categoria</label>
						</div>
						<div class="renHC6">
								<select name="icate" id="icate">
											<option value="9999">Seleccione una categoria</option>
								</select>
						</div>
						<div class="renHC7">
							<label>Sets </label>
						</div>
						<div class="renHC8">
							<input type="text" id="SetMaxCat" name="SetMaxCat" class="inputSets" disabled="">
						</div>
						<div class="renHC9">
							<label>Ptos Fin TBreak</label>
						</div>
						<div class="renHC91">
							<input type="text" id="valtbset" name="valtbset" class="inputSets" value="15">
						</div>
						<div class="renHC10">
							<label>Ptos Fin Set</label>
						</div>
						<div class="renHC101">
							<input type="text" id="valfinset" name="valfinset" class="inputSets" value="25">
						</div>
					</div>
					<div class="renglonEquipos">
						<div class="renEQ1">
							<label for="iclub">Local</label>
						</div>
						<div class="renEQ2">
							<input type="text" id="itextA" name="itextA" class="inputSearch" onkeyup="buscarClub(this.id,'iclub');">
						</div>
						<div class="renEQ3">
							<select name="iclub" id="iclub">
								<option value="9999">Seleccione un Club...</option>
							</select>
						</div>
						<div class="renEQ4">
								<label for="iclubb">Visitante</label>
						</div>
						<div class="renEQ5">
								<input type="text" id="itextB" name="itextB" class="inputSearch" onkeyup="buscarClub(this.id,'iclubb');">
						</div>
						<div class="renEQ6">
								<select name="iclubb" id="iclubb">
										<option value="9999">Seleccione un Club...</option>
								</select>
						</div>																		
				    </div>
					<div class="renglonUbicacion">
							<div class="renUB10">
									<label for="icancha">Sedes</label>
							</div>
							<div class="renUB11">
							<select id="isede" name="isede" class="SelList">
											<option value="9999" selected="">Seleccione una sede</option>
									</select>
							</div>
							<div class="renUB1">
									<label for="icancha">Canchas</label>
							</div>
							<div class="renUB2">
									<select id="icancha" name="icancha" class="SelList">
											<option value="9999" selected="">Seleccione una cancha</option>
									</select>
							</div>
							<div class="renUB3">
									<label for="icity">Ciudades cargadas</label>
							</div>
							<div class="renUB4">
									<select id="icity" name="icity" class="SelList">
											<option value="9999">Seleccione una ciudad</option>
									</select>
							</div>
					</div>
			    </section>
			</section> <!-- fin del item datos partido-->											
		</div>
	</form>
</section>
</body>
</html>

