<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Partidos Gestion
		</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/tableroControl_style.css">
	   <style>
		.XSModales {
			height: -webkit-fill-available;
		}
		.XModalesWaiter
			{

				background-color: rgba(255, 0, 0, .55);
    			height: -webkit-fill-available;
			}


		DIALOG {
			inset-inline-start: 0px;
			inset-inline-end: 0px;
			width: 100%;
		}

		#modalEsperar {
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

			#modalEsperar .donut {
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

        .SELLIST{
            width: auto;
        }
		.SinTope{
			margin-top:0;
		}

		.ActivarDark{
			width: 3em;
			height: 2em;
			color: #fff;
			font-weight: lighter;
			font-size: 15px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			border: 1px solid #000000;
			-moz-border-radius: 7px;
			-webkit-border-radius: 7px;
			border-radius: 7px;			
			background-color: #040c31;
		}
		.extendActivarDark{
			width: auto;
			wordwrap:none;
		}
		</style>
	   <!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!-- <script type="text/javascript" src="./scripts/nsanz_script.js"></script>  -->
		<script type="text/javascript">

		var vEquipos = new Array();
		var vCiudades = new Array();

		var vCompetencias = new Array();			
		var vCategorias = new Array();
        var vEstados    = new Array();

		var vCanchas = new Array();
		var vSedes   = new Array();		
		var iPartidos =  new Array();	

		const NombreDias = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];		


function guardarFiltros(){

var parametrosFiltros = new Array();

parametrosFiltros.push( {"icomp":$("#icompetenciaFiltro").val()});
parametrosFiltros.push( {"icate":$("#icategoriaFiltro").val()});
parametrosFiltros.push( {"iclub":$("#iclubFiltro").val()});

parametrosFiltros.push( {"ietats":$("#iestadoFiltro").val()});

//parametrosFiltros.push( {"icity2":0}); //necesito que vaya igual
	//le mando el codigo de error buscado
	parametrosFiltros.push( {"icity2":$("#ierrorFiltro").val()}); //necesito que vaya igual


parametrosFiltros.push( {"fecDde":$("#FechaDde").val()});
parametrosFiltros.push( {"fecHta":$("#FechaHta").val()});



  var parametros = {
	  "TEXTOCLAVE" : "FILTROSABMPARTIDOS",
	  "datos"		: parametrosFiltros
  };

  $.ajax({
	  url:   './abms/grabarsesion.php',
	  type:  'GET',
	  data: parametros ,
	  datatype:   'text json',
	  beforeSend: function () {},
	  done: function(data) {},
	  success:  function (r) {
		  // 
	  },
	  error: function (xhr, ajaxOptions, thrownError) {console.log(thrownError);}
					
});		  
}


function getFiltros(){

var parametros = {
	  "TEXTOCLAVE" : "FILTROSABMPARTIDOS",
};

$.ajax({
  url:   './abms/obtenersesion.php',
  type:  'GET',
  data: parametros ,
  datatype:   'text json',
  async: false,
  beforeSend: function () {},
  done: function(data) {},
  success:  function (r) {
		 var re = JSON.parse(r);

		  $(re['Filtros']).each(function(i, v)
			{


				$("#icompetenciaFiltro").val(v.icomp);
				$("#icategoriaFiltro").val(v.icate);
				$("#iclubFiltro").val(v.iclub);
							
				$("#iestadoFiltro").val(v.ietats);
				
				$("#ierrorFiltro").val(v.icity2); // reutilicé un campo


				$("#FechaDde").val(v.fecDde);
					//alert(v.fecDde);
				$("#FechaHta").val(v.fecHta);
					//alert(v.fecHta);
			});	
   },
	error: function (xhr, ajaxOptions, thrownError) {console.log(thrownError);}
});// falta el seleccion de la cancha, para cargar los campos..		  

}



/// CARGA DE VECTORES EN EL START ******************
	function cargarCanchasStart()
	{
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

// TRAIGO UNA VEZ VECTOR DE CATEGORIAS, EQUIPOS PARA LOCA Y VISITANTE,CANCHAS Y CIUDADES			
	function cargarCategoriasStart()
	{
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

	function cargarCiudadesStart()
	{
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

	function cargarEqupoStart()
	{
		// clubabr:"77FC"
		// escudo: ""
		// idciudad: "0"
		// idclub: "2"
		// nombre: "77 FUTBOL CLUB"	
		//CanchasRegistradas:"1"
		// SedesRegistradas: "1"
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

	function cargarEstadosStart()
    {
//------------------------------
// ESTADOS DEL PARTIDO
//------------------------------
    var  iEstados = new Array();
        // esto arreglo el tema del alta triplle..
        $.ajax({ 
            url:   './abms/obtener_estados.php',
            type:  'GET',
            dataType: 'json',
            async:false,            
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
                    iEstados = Object.values(r['Estados']);
            },
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax ESTADOS    

            return iEstados;				
    }		

	function cargarSedesStart()
	{
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
/// CARGA DE VECTORES EN EL START ******************

/// CREACION CON VECTORES DE CONTROLES ******************
	function creaCanchasx(nombreObj)
	{
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	var selectCanchas = "";
			// esto arreglo el tema del alta triplle..
		$(vCanchas).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idcancha + '" name="'+v.idclub+'_'+v.idsede+'_'+v.idcancha+'">' +v.clubabr+' - '+ v.extras+' - '+ v.nombre + '</option>');
		});		
	
	return 	selectCanchas ;
	};

    function creaCategoriasx(nombreObj)
    {
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

	function creasCiudadesx(nombreObj){
        //	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
        //	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
        // Nombre:"Banfield"
        // idCiudad:"13"
        // provincia:"Buenos Aires"	
            var selectCiudad = "";
                // esto arreglo el tema del alta triplle..
            $(vCiudades).each(function(i, v)
            { // indice, valor
                    $("#"+nombreObj).append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
                //alert(selectPuesto);
            });		
            
        return 	selectCiudad ;
        };		

	function creasCompetenciasx(nombreObj)
    {
        var selectCompetencia = "";
                // esto arreglo el tema del alta triplle..
            $(vCompetencias).each(function(i, v)
            { // indice, valor
                //if(v.competenciaActiva == 1)
                    $("#"+nombreObj).append('<option value="' + v.idcomp + '">' + v.cnombre + '</option>');

            });		

        return 	selectCompetencia ;
    }

	function creaEquiposx(nombreObj){
		var selectEquipos = "";
				// esto arreglo el tema del triplle..
			$(vEquipos).each(function(i, v)
			{ // indice, valor
					$("#"+nombreObj).append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
			});
		return 	selectEquipos ;
		};

	function creaErroresFiltroX(nombreObj)
    {
	// console.log('crear Categoria para : ' + "#"+nombreObj+"_"+idpartido );
	var selectErrores = "";
			// esto arreglo el tema del alta triplle..

				$("#"+nombreObj).append('<option value="15" label="VALORESNULOS">Faltan datos cabecera</option>');
	
	    return 	selectErrores ;
	};    


	function creaEstadosX(nombreObj)
    {
	// console.log('crear Categoria para : ' + "#"+nombreObj+"_"+idpartido );
	var selectEstados = "";
			// esto arreglo el tema del alta triplle..

		$(vEstados).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idestado + '" label="'+v.descripcion+'">' + v.descripcion + '</option>');
        });
	
	    return 	selectEstados ;
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
				});		
				
			return 	selectSede ;

		}		

	function obtenerEscudo(idClub)
	{
		var escudoTAG ='';
		var avanzar = 0;
		//		$(vEquipos).each(function(i, v)
		while (avanzar < vEquipos.length-1) 
		{
			if(vEquipos[avanzar]['idclub'] == idClub)
				if(vEquipos[avanzar]['escudo'] !='') 
					{
						//alert('encontré el club '+ idClub +' Y SU ESCUDO ES: '+v.escudo+ 'lo pego en '+ idobjeto);	
						// $(idobjeto).html('<img  src="'+"img/escudos/"+vEquipos[avanzar]['escudo']+'" class="imgjugadorindex"></img>'); 
						escudoTAG = '<img  src="'+"img/escudos/"+vEquipos[avanzar]['escudo']+'" class="imgjugadorlistaindex"></img>';
							avanzar = vEquipos.length+1;
					}
				else
					{            	
						//alert('NO encontré el club'+idClub + ' SU ESCUDO: '+ v.escudo);	
						// $(idobjeto).html('<img  src="img/jugadorGen.png" class="imgjugadorindex" ></img>'); 
						escudoTAG = '<img  src="img/jugadorGen.png" class="imgjugadorlistaindex" ></img>';
							avanzar = vEquipos.length+1;
					}
			avanzar++;	
		};
		return 	escudoTAG;	
	};

	function obtenerNombreClub(idClub)
	{
		var avanzar = 0;
		var vnombreClub = '';
		while (avanzar < vEquipos.length-1) 
		{
			if(vEquipos[avanzar]['idclub'] == idClub)
			{
						vnombreClub = vEquipos[avanzar]['nombre'];
						avanzar = vEquipos.length+1;
			}
			avanzar++;	
		};
		return 	vnombreClub;	
	};

function AccionOcultarControles(){
	//$(".FiltrosContenedor").toggle(); 
	$(".FiltrosContenedor").toggleClass('visible');
}


	function obtenerCiudad(idciudad){

	var ciudadNombre = 'Sin ciudad';	
		$(vCiudades).each(function(i, v)
		{ // indice, valor
				if(v.idCiudad == idciudad){
						//alert(v.Nombre+'-'+v.provincia);
						return ciudadNombre = v.Nombre+'-'+v.provincia;
				}		
			//alert(selectPuesto);
		});		
	    return ciudadNombre;
	}

	function agregar(){

        if( ($("#fechap").val() != '') && ($("#horai").val() != '')  )
        {
			var parametros = {
				"idpartido"	  :$("#IDPartido").val() ,
				"fechap"   	  :$("#xfechapartido").val(),
				 "icate"   	  :$("#icatePartido").val(),
				 "iclub"   	  :$("#iclubLocal").val(),
				 "iclubb"  	  :$("#iclubb").val(),
				 "icancha" 	  :$("#icancha").val(),
				 "isede"   	  :$("#isede").val(),
				 "icomp"   	  :$("#icompPartido").val(),
				 "icity"   	  :$("#icity").val(),
				 "horai"   	  :$("#horai").val(),
				 "SetMaxCat"  :$("#SetMaxCate").val(),
				 "SetMaxComp" :$("#SetMaxComp").val(),
				 "valtbset"   :$("#valtbset").val(),
				 "valfinset"  :$("#valfinset").val(),
				 "ResA"			:$("#valRESULTADOA").val(),
				 "ResB"			:$("#valRESULTADOB").val(),
				"descripcionp" :$("#dscp").val(),
				"IDClubSede"   	:$("#iclubsede").val(),
				"ianio"		   :$("#ianio").val()
			};		         

         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_partido.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){},
            success:  function (r){
							//alert('Partido ingresado ' + r);
							var re = JSON.parse(r);
							if(re.hasOwnProperty('estado') ){
    							alert('Partido ingresado exitosamente');
								location.reload();
							}else{
    							$("#Errores").html(r);
							}							

            },
			error: function (xhr, ajaxOptions, thrownError) {
            	alert("errorrrr");
            }
            }); // FIN funcion ajax
        } // else THIS.VAL <> ''
	};

	function modificar(){
		//QUE SE RECARGUE CUANDO PRESIONO CLICK..
			// Guardamos el select de cursos
				//  $("#iclubsede").val(v.clubSedePartido); NUEVO DATO
				//  $("#xStadopartido").val(v.estadoID); NUEVO DATO
			var parametros = {
				"idpartido"	  :$("#IDPartido").val() ,
				"fechap"   	  :$("#xfechapartido").val(),
				 "icate"   	  :$("#icatePartido").val(),
				 "iclub"   	  :$("#iclubLocal").val(),
				 "iclubb"  	  :$("#iclubb").val(),
				 "icancha" 	  :$("#icancha").val(),
				 "isede"   	  :$("#isede").val(),
				 "icomp"   	  :$("#icompPartido").val(),
				 "icity"   	  :$("#icity").val(),
				 "horai"   	  :$("#horai").val(),
				 "SetMaxCat"  :$("#SetMaxCate").val(),
				 "SetMaxComp" :$("#SetMaxComp").val(),
				 "valtbset"   :$("#valtbset").val(),
				 "valfinset"  :$("#valfinset").val(),
				 "ResA":$("#valRESULTADOA").val(),
				 "ResB":$("#valRESULTADOB").val(),
				"descripcionp" :$("#dscp").val(),
				"IDClubSede"    :$("#iclubsede").val(),
				"estadoID"     :$("#xStadopartido").val()
			};		         
			$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
				url:   './abms/modificar_partido.php',
				type:  'POST',
				data: parametros,
				beforeSend: function (){},
				success:  function (r){
					alert('Partido modificado');
						location.reload();
				},
				error: function (xhr, ajaxOptions, thrownError) {}
				}); // FIN funcion ajax		
		};

		function eliminar(){

		    var parametros =
		    {
			 "fecha"   : $("#xfechapartido").val(),
			 "partido" : $("#IDPartido").val()
			};
		    $.ajax({ 
            url:   './abms/borrar_partido.php',
            type:  'POST',
            data:  parametros,
            dataType: 'json',
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
				//location.reload();
				if(r.hasOwnProperty('estado') ){
					alert('Partido eliminado exitosamente');location.reload();
				}else{
					$("#Errores").html(r);
				}							
			},
			error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax CLUBES
		};

		function abreDialogo(modo,partidoID,FechaPartido){
			// ALTA, BAJA,MODIFICA
			//alert($("#xfechapartido").val());
		$("#Errores").html('');			
		const modalForm =
				document.querySelector("#formularioAcciones");
		if(modo == 'ALTA') $("#Titulo").html('Ingreso de Partidos');				
		$(iPartidos).each(function(i,v)
		{
			if( ( v.idPartido == partidoID ) && (v.Fecha == FechaPartido) )
			{
				//CanchaId:54,CatDesc: "SUB18[CAB]",
				//CatSetMax: 5,ClubA: "ARG",ClubARes: 3,ClubB: "ISR",ClubBRes: 0,
				//Fecha: "2024-01-02",
				//Horafin: "2024-01-02 12:00:00",Inicio: "12:00",
				//cancha: null,ciudad: 28,cnombre: "JUEGOS PANAMERICANOS MACABEOS",
				//competencia: 44,descripcion: "FINALIZADO",descripcionp: "SEMIFINAL 1",
				//idPartido: 1,idcat: 19,idcluba: 181,idclubb: 184,idsede: 1,
				//nombre: "PILAR",setsnmax: 5,valFinSet: 25,valTBSet:15
				//<input type="hidden" id="valRESULTADOA" name="valRESULTADOA">
				//<input type="hidden" id="valRESULTADOB" name="valRESULTADOB">
				$("#IDPartido").val(partidoID);
				
				
				if(modo == 'COPIAR'){
					$("#IDPartido").val('');
					$("#Titulo").html('Copiar Partido');	
				} 

				if(modo == 'BAJA') $("#Titulo").html('Eliminar Partido');
				if(modo == 'MODIFICA') $("#Titulo").html('Modifica Partido');	 

				
				 $("#ianio").val(v.Fecha.substr(0,4));	
				 $("#icompPartido").val(v.competencia);
				 $("#SetMaxComp").val(v.setsnmax);
				 //console.log(v.Fecha+' vs '+FechaJS);
				 $("#xfechapartido").val(v.Fecha);
				$("#xfechapartido").prop('disabled', false); //PUEDO CAMBIAR LA FECHA TAMBIEN ,SI LO PERMITE LA BASE
					// PORQUE LA METRO CAMBIO TODAS LAS FECHAS TODO EL TIEMPO...
					if(modo != 'ALTA')  $("#xfechapartido").prop('disabled', true);
					if(modo == 'COPIAR') $("#xfechapartido").prop('disabled', false);
				 $("#dscp").val(v.descripcionp);
				 $("#horai").val(v.Inicio);
				 $("#icatePartido").val(v.idcat);
				 $("#SetMaxCate").val(v.CatSetMax);
				 $("#valtbset").val(v.valTBSet);
				 $("#valfinset").val(v.valFinSet);
				 $("#iclubLocal").val(v.idcluba);
				 $("#iclubb").val(v.idclubb);
				 $("#iclubsede").val(v.clubSedePartido);
				 //LA SEDE SE ARMA CON DOS CLAVES:
				 var codigoEncriptado = 0;
				if(v.clubSedePartido != v.idcluba){
					$("#isede").val(v.clubSedePartido+'_'+v.idsede);
					codigoEncriptado = v.clubSedePartido+'_'+v.idsede+'_'+v.CanchaId;
				}
				else{
					$("#isede").val(v.idcluba+'_'+v.idsede);
					codigoEncriptado = v.idcluba+'_'+v.idsede+'_'+v.CanchaId;
				}
				//LA CANCHA SE ACCEDE CON NAME=CLUBID+'_'+SEDEID+'_'+CANCHAID
				//$('td[name="tcol1"]')   // Matches exactly 'tcol1'
					
				$("#icancha option[name="+ codigoEncriptado +"]").attr("selected",true);
				 //$("#icancha").val(v.CanchaId);
				 $("#icity").val(v.ciudad);
				 $("#xStadopartido").val(v.estadoID);
				 $("#valRESULTADOA").val(v.ClubARes);
				 $("#valRESULTADOB").val(v.ClubBRes);
			}
		} )
		;

		modalForm.showModal();

	}	

function partidosUI(vectorPartidos){
//******************************************************************************************************************************************* */								
// '<div></div>'+
// '<div></div>'+
// '<div>ID</div>'+
// '<div></div>'+
// '<div>Fecha</div>'+
// '<div>Inicio</div>'+
// '<div>Competencia</div>'+
// '<div>C.Local</div>'+
// '<div>Club Sede</div>'+
// '<div>Sede</div>'+
// '<div>Cancha</div>'+
// '<div>C.Visita</div>'+
// '<div>Estado</div>'+
// '<div></div>'
$(".ContieneGrillaTabla").html('');
$(".ContieneGrillaTabla").html('<div class="DetalleGrillaTablaGPartidos barraCancha">'+
								'<div><span class="icon-upload" onclick="abreDialogo(\'ALTA\',0,\'\');"></span></div>');
				var conteoUI = 0;
				var renglonPartido = '';

				var verSinSedesPartido = verSinSedesClub = 0;
				//<input id="sinSede" name="sinSede" type="checkbox" /> 

				if ($("#sinSedeClubPartido").is(":checked")) {
					// it is checked
					verSinSedesPartido = 1;
				};

				if ($("#sinSede").is(":checked")) {
					// it is checked
					verSinSedesClub = 1;
				};

				// console.log('verSinSedesPartido ES '+ verSinSedesPartido+' verSinSedesClub ES '+verSinSedesClub);
				$(vectorPartidos).each(function(i, v)
				{ // indice, valor
				// 		var escudoSpan = '';	
				// 		if(v.escudo !='')
				// 			escudoSpan = '<span><img  src="'+"img/escudos/"+v.escudo+'" style="width:2em;height:2em;"></img><span>'; 
				// 		else            	
				// 			escudoSpan = '<span><img  src="img/jugadorGen.png" class="imgjugadorTablero" name="GENERICO" style="width:2em;height:2em;"></img></span>'; 

				var escudoLocal  = obtenerEscudo(v.idcluba);
					//console.log(escudoLocal);
	 			var escudoVisita = obtenerEscudo(v.idclubb);		
				 	//console.log(escudoVisita);
				// 			var nombreCiudad = obtenerCiudad(v.idciudad);
				// 			var claseActivada = 'class="barraActiva"';
				// 			if(v.idciudad != 0)
				// 				claseActivada = ' ';

				//CanchasRegistradas:"1"
				// SedesRegistradas: "1"	
				// 			if(parametroBusqueda == 0 || parametroBusqueda == 9999)
				// 			 {	
				if(      (verSinSedesPartido == 1 && (v.clubSedePartido == 0 )) || (verSinSedesPartido == 0 ) 
					&& ( (verSinSedesClub    == 1 && (v.idsede          == 0 ))|| (verSinSedesClub    == 0))      ) 
				{								
					var dateApi = v.Fecha.split('-'); // '2018-08-27': dateApi[1] DIA
				  	var FechaJS = dateApi[2] + '-' + dateApi[1] + '-' + dateApi[0];

				  	const fechaComoCadena = v.Fecha;//"2020-03-09 23:37:22"; // día lunes
					const numeroDia = new Date(fechaComoCadena).getDay();
									//console.log('Fecha: '+fechaComoCadena+' numero obtenido de dia '+ numeroDia);
					const nombreDia = NombreDias[numeroDia];
						//CanchaId:54
						//cancha: null,
						//idsede: 1,
						//ciudad: 28,
						//cnombre: "JUEGOS PANAMERICANOS MACABEOS",
						//descripcion: "FINALIZADO",
						//idcluba: 181,idclubb: 184,
						//nombre: "PILAR"
						if(v.descripcion.includes('SUSPENDIDO')){var img = './img/PartidoSSPND.png'; colorEstado = 'Desactivado';}
						if(v.descripcion.includes('PROGR')) {var img = './img/PartidoONOFFSQR.png';colorEstado = 'Programado';}
						if(v.descripcion.includes('LLUVI')) {var img = './img/rain-icon-png.jpg';colorEstado = 'Desactivado';}
						if(v.descripcion.includes('FIN'))   {var img = './img/PartidoOFFSQR.jpg';colorEstado =' Finalizado' ;}		
						if(v.descripcion.includes('CURSO')) {var img = './img/PartidoONSQR.png';colorEstado ='Cursando' ;}

						var ClubSedeExiste = v.clubSedePartido;
						if(v.clubSedePartido == 0 ||v.clubSedePartido == null || v.clubSedePartido == undefined)
						{

							//ClubSedeExiste = 'No asignado';
							//cargamos select con posibles club sedess, por ejemplo el local
							var regularExprsn = /-/g;	//esto funciona y no genera errores !!!
							var FechaparaID=v.Fecha.replace(regularExprsn,'_');
							ClubSedeExiste ='<select id="iclubsede_'+FechaparaID+'_'+v.idPartido+'" name="iclubsede_'+FechaparaID+'_'+v.idPartido+'" class="ianio">'+
											'	<option value="-1">Seleccionar Club sede...</option>'+
											'</select>';

							//	y el click del select lo graba y recarga
						}
						else
								ClubSedeExiste = obtenerNombreClub(v.clubSedePartido);
						vnombreSede	= '';
						vnombreSede = obtenerSede(v.idcluba,v.idsede); //club local, sede asignada del club local..
							//console.log("Nombre de día de la semana: ", nombreDia);
						renglonPartido = '<div class="DetalleGrillaTablaGPartidos '+colorEstado+'">'+
														'<div  class="txtPartido">'+v.descripcionp+'</div>'+						
				 										'<div class="accionesabm"><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idPartido+',\''+v.Fecha+'\');"></span>'+
														 '			       <span class="icon-images" onclick="abreDialogo(\'COPIAR\','+v.idPartido+',\''+v.Fecha+'\');"></span>'+
														 '				   <span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idPartido+',\''+v.Fecha+'\');"></span>'+
														 '</div>'+
														 //'<div  class="IDGestionPartido">'+v.idPartido+'</div>'+
														 '<div class="algo"></div>'+
														 '<div  class="FechaHora">'+nombreDia+'&nbsp;&nbsp;'+FechaJS+'</div>'+
														 '<div  class="Hora">'+v.Inicio+'</div>'+
														 '<div  class="Competencia">'+v.cnombre+'</div>'+
														 '<div  class="Categoria">'+v.CatDesc+'</div>'+
														 '<div class="escudoLocal"><span>'+escudoLocal+'</span><span class="NomClub">'+v.ClubA+'('+v.ClubARes+')</span></div>'+
														 '<div class="escudoVisitante"><span>'+escudoVisita+'</span><span class="NomClub">'+v.ClubB+'('+v.ClubBRes+')</span></div>'+
														 '<div  class="Cancha">'+v.cancha+'</div>'+
														 '<div  class="Sede"> Club Sede: '+ClubSedeExiste+' Sede: '+vnombreSede+'</div>'+
														 '<div  class="estado">'+v.descripcion+'</div>';
								$(".ContieneGrillaTabla").append(renglonPartido);
								//DEJO SUGERIDO UN CLUB SEDE SEGUN LA CANCHA...
									var idrenglon= 'iclubsede_'+FechaparaID+'_'+v.idPartido;
									creaEquiposx(idrenglon);
									obtenerClubLocalSegunCancha(idrenglon,v.CanchaId);
				 						conteoUI++;
						}			
				 });
				 // 
				 //OBTENER UNA LISTA DE TODOS LOS SPAN icon-pie-chart y icon-cross
				 //asignarle el color opuesto al color del estado
				$("#partidosLista").val(conteoUI);
			//******************************************************************************************************************************************* */
}
function grabarClubSede(){

	var grabarSedesCargadas = 0; 
	if ($("#fijarClubSedePartido").is(":checked")) {
			// it is checked
			grabarSedesCargadas = 1;
	};
	var partidosActualizables = new Array();

	// PRIMERO RECORREMOS LOS PARTIDOS LISTADOS 
	if(grabarSedesCargadas == 1)
	{

		$('select[name^="iclubsede_"]').each(function(index, element) {
			const selectElement = $(element); // Convertir el elemento a un objeto jQuery
			const selectId 		 = selectElement.attr('id'); // Obtener el ID del elemento select
			const selectedOption = selectElement.find('option:selected'); // Buscar el option seleccionado
			const ClubSeleccionadoSede  = selectedOption.val(); // Obtener el valor del option seleccionado
			var idpartidoModifica  =  selectId.split('_')[4]; //#iclubsede_2024_05_04_1
			var fechaModifica      =  selectId.split('_')[1]+'-'+selectId.split('_')[2]+'-'+selectId.split('_')[3]; //#iclubsede_2024_05_04_1
			//	console.log(' Club seleccionado: '+ ClubSeleccionadoSede+ ' Partido Id:'+ idpartidoModifica+ ' Fecha: '+ fechaModifica);
			partidosActualizables.push( {
				"idPartido":idpartidoModifica,
				"fechaPartido":fechaModifica,
				"nuevoclubSede":ClubSeleccionadoSede
			});
		});
		alert('Registro encontrados para modificar: ' +partidosActualizables.length );
		var parametros = {
			"ListaPartidosAjuste" : partidosActualizables
		}
		
		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
			url:   './abms/actualizar_parte_partido.php',
			type:  'GET',
			data: parametros,
			beforeSend: function (){},
			success:  function (r){
				partidos(); // Recargo Partidos
			},
			error: function (xhr, ajaxOptions, thrownError) {}
		}); // FIN funcion ajax		
	}
	else
	{
		alert('No se realizará ninguna acción modificadora');
	}
		
}


	function partidos(){
		
			// waiter screen	
			const dialogoEsperarAjax = document.getElementById("modalEsperar");

			//aca grabo la sesion.
			//alert( $("#icomp").val()  );
			fechadesdeorden=0;
			if ($("#fecDdeAscDsc").is(":checked")) {
				// it is checked
				fechadesdeorden = 1;
			};
	
			// if ($("#fecDdeAscDsc2").is(":checked")) {
			// 	// it is checked
			// 	fechadesdeorden = 1;
			// };
			//Guardo en sesion los filtros:
				guardarFiltros();
			
			var parametros = 
			{
	        	"icomp" : $("#icompetenciaFiltro").val(),
	        	"icate" : $("#icategoriaFiltro").val(),
				"icity" : 0,
				"icity2" : 9999,
				"errorCodigo": $("#ierrorFiltro").val(),
				"iclub" : $("#iclubFiltro").val(),
				"buscarClubNombre":$("#itextbuscarFiltro").val(),
				"fdesde" : $("#FechaDde").val(),
				"fhasta" : $("#FechaHta").val(),
				"fdesdeOrden" : fechadesdeorden,
				"estado" : $("#iestadoFiltro").val(),
				"codigoP": $("#itextbuscarCodigo").val()
			};		  
			//"fhasta" : $("#fecHta").val(),
		/*se agregan los parametros a la llamada a este objeto...*/	
		         $.ajax({ 
		            url:   './abms/obtener_listados_partidos_xfecha.php',
		            type:  'GET',
		            dataType: 'json',
		            data: parametros,
		            beforeSend: function (){
						dialogoEsperarAjax.showModal();
					},
		            done: function(data){},
		            success:  function (r){
						dialogoEsperarAjax.close();
						if(r['estado']==1)
						{
							iPartidos = Object.values(r['Partidos']);
								partidosUI(iPartidos);
					 	}
						else
						{
							$(".ContieneGrillaTabla").html('');
							$("#partidosLista").val(0);
						}
							
		            }, 		            
		             error: function (xhr, ajaxOptions, thrownError) {}
		            }); // FIN funcion ajax PARTIDOS CON FILTRO
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


function limpiarFiltros(fechapartido,fechapartido2)
{
	$("#icompetenciaFiltro").val('9999');
	$("#icategoriaFiltro").val('');
	// $("#icity2").val('9999');
	$("#iclubFiltro").val('');
	$("#iestadoFiltro").val(0);
	$("#FechaDde").val(fechapartido);
	$("#FechaHta").val(fechapartido2);						
}

function obtenerSede(idclubDeSede,idsedeElegida){
//club local, sede asignada del club local..
var nombreSede = '';
		$(vSedes).each(function(i, v)
		{
			if( (v.idclub == idclubDeSede ) && (v.idsede == idsedeElegida) )
			{
				nombreSede = v.extras; //	solo lo hace una vez
			}
		});
return nombreSede;		
}



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
								$("#iclubsede").val(clubOrigen);
						//asignar la ciudad tambien..
						return true; //	solo lo hace una vez
						// return true; SIGUE CORRIENDO
					}
				});
			}
		}); 
	}		

	function obtenerClubLocalSegunCancha(objetoClubID,idCanchaCargada)
	{
		//var clubOrigen = $("#"+objetoClubID).val();
		// borro objeto Cancha 
		// recorro objeto cancha, si encontré alguna, le asigno el valor de la primera que encuentro
		// necesito recorrer las sedes !!!!
		// $(vSedes).each(function(i, v)
		// {
		// 	// la forma de llegar a la cancha, es atraves de la sede
		// 	if (v.idclub == clubOrigen )
		// 	{
				$(vCanchas).each(function(j, w)
				{ // indice, valor
					if( ( w.idcancha == idCanchaCargada )  )
					{
						//alert('encontre una cancha del club, me ubico ahi..club: '+ v.idclub +' cancha id ' +w.idcancha+ ' sede: '+w.idsede);
								$("#"+objetoClubID).val(w.idclub);
						return true; //	solo lo hace una vez
						// return true; SIGUE CORRIENDO
					}
				});
		// 	}
		// }); 
	}	

			$(document).ready(function() {
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


						 var f=new Date();
						 var Listadias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
						 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
						 				,"27","28","29","30","31");
						 var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
						var fechapartido = (f.getFullYear()) + "-" + meses[f.getMonth()] + "-" +Listadias[(0)] ;
						 
						var f2=new Date(f.getFullYear()+ "-" + meses[(f.getMonth()+1)] + "-" +Listadias[(0)]);
						//console.log(f2) ;
						var fechapartido2 = (f2.getFullYear()) + "-" + meses[f2.getMonth()] + "-" +Listadias[(30)] ; 
						$("#FechaDde").val(fechapartido);
						$("#FechaHta").val(fechapartido2);

			// const dialogoEsperarAjax = document.getElementById("modalEsperar");
				// stopwatchjquery
			vEquipos = cargarEqupoStart();
            vCategorias = cargarCategoriasStart();
        	vCompetencias = cargarCompetenciasStart();
            vEstados = cargarEstadosStart();
			vCiudades = cargarCiudadesStart();
			vCanchas  = cargarCanchasStart();
			vSedes    = cargarSedesStart();

			creaEquiposx('iclub');
			creaEquiposx('iclubFiltro');
			creaErroresFiltroX('ierrorFiltro');
			// FORMULARIO ALTA PARTIDO
				creaEquiposx('iclubLocal');
				creaEquiposx('iclubb');
					creaEquiposx('iclubsede');
				creasCompetenciasx('icompPartido');
            	creaCategoriasx('icatePartido');
				creasCiudadesx('icity');
				creasSedesx('isede');
				creaCanchasx('icancha');
					creaEstadosX('xStadopartido');
			// FORMULARIO ALTA PARTIDO	

            creasCompetenciasx('icompetenciaFiltro');
            creaCategoriasx('icategoriaFiltro');
            creaEstadosX('iestadoFiltro');
			creasCiudadesx('iciudadclub');			


			var f=new Date();
			var FechaHoy = f.getFullYear() ;
				fechainicial = FechaHoy -10;
				fechaFinal   = FechaHoy;
			for (var i = fechainicial; i < fechaFinal; i++) 
			{
				if(i == FechaHoy) $("#ianio").prepend('<option selected>' + (i + 1) + '</option>');
				else  $("#ianio").prepend('<option>' + (i + 1) + '</option>');
			}
			
			$("#ianio").val(FechaHoy);

		//CONTROLES Y ACCIONES CON FILTROS.				
		// AJAX DE CARGA POR ID DE CATEGORIAS
		
		$("#buscarDark").click(function()
		{   
			var filtro = $("#itextbuscarCodigo").val();
				partidos(); // traigo los partidos que se deberian ver con un load, inicial o refresco
		});


		//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#itextbuscarFiltro").keyup(function()
		{   
			var filtro = $("#itextbuscarFiltro").val();
			$("#iclubFiltro").empty();
			$(vEquipos).each(function(i, v)				
			{ // indice, valor
				
				if(( v.clubabr.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 ) || ( v.nombre.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 )) 
				{
					$("#iclubFiltro").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					
				}
			});
		});
		//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#CerrarDiagX").click(function(){
			const modalForm =
			document.querySelector("#formularioAcciones");
			modalForm.close();
		});

		$("#btnAddPartido").click(function(){
			agregar();
		});

		
		$("#btnCopPartido").click(function(){
			agregar();
		});
		

		
		$("#btnDelPartido").click(function(){
			eliminar();
		});
		
		$("#btnModPartido").click(function(){
			modificar();
		});
		
		//recuperamos los filtros que estaban antes de una actualizacion en base		
			getFiltros();		
				partidos(); // traigo los partidos que se deberian ver con un load, inicial o refresco
		//FILTROS.
		$("#iclubFiltro").on("change",function(){partidos();});//change del ICATEGORIA
		$("#icompetenciaFiltro").on("change ",function() {partidos();});
		$("#iestadoFiltro").on("change ",function() {partidos();});
		$("#fecDdeAscDsc").on("change ",function() {partidos();});
		$("#fecDdeAscDsc2").on("change ",function() {partidos();});				
		$("#icategoriaFiltro").on("change ",function() {partidos();});

		$("#sinSedeClubPartido").on("click",function() {partidos();}); 
		$("#sinSede").on("click",function() {partidos();});
		
		$("#ierrorFiltro").on("change",function() {partidos();});
		
		$("#fijarClubSedePartido").on("click",function() {
				grabarClubSede();
				partidos();

		});

		$("#FechaDde").on("click change",function() {
			//Nota: El formato mostrado puede ser diferente del value real, ya que la fecha mostrada es formateada según el idioma
			// del navegador del usuario, pero el valor analizado es siempre formateado a aaaa-mm-dd.			
			//Why does .getFullYear() return 2017 for the date "2018-01-01" [duplicate]
			//the date is in UTC, whereas .getFullYear is using your time zone
			//	SOLUCION This is probably due to your local timezone, try getUTCFullYear() instead.
			var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
		 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
		 				,"27","28","29","30","31");
			 var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
			 var mesesNombre = new Array ("Ene","Feb","Maz","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
			 MesIngresadoDde = new Date($("#FechaDde").val());
			 mesCorrecto = MesIngresadoDde.getUTCMonth();
			// console.log(mesCorrecto);
			 
			 if(mesCorrecto == 0 || mesCorrecto == 2  || mesCorrecto == 4  || mesCorrecto == 6
			 || mesCorrecto == 7 || mesCorrecto == 9  || mesCorrecto == 11)
			 	ultimoDia = 31;
			else
				if(mesCorrecto == 1) //recordar que devuelve el valor numerico del codigo del mes no es numero del mes..
					ultimoDia = 28; //no tengo en cuenta el año biciesto aun
				else
					ultimoDia = 30;
					
			//console.log(' anio capturado '+ (MesIngresadoDde.getUTCFullYear()))	;
			//mesCorrecto == 11 ? (mesCorrecto = 0) : (mesCorrecto = mesCorrecto+1);
			//console.log(' mes capturado '+ mesesNombre[(mesCorrecto)] )	;
			FinDeMes = new Date((MesIngresadoDde.getUTCFullYear())+ "-" + meses[(mesCorrecto)] + "-" +ultimoDia);	
				 $("#FechaHta").val(FinDeMes.getUTCFullYear()+ "-" + meses[(mesCorrecto)] + "-" +ultimoDia);
				 

		});
		
		$("#FechaDdeHta").on("click",function() {partidos();});
		
		$("#limpiarfiltro").on("click",function() {
					limpiarFiltros(fechapartido,fechapartido2);

					partidos();
		});
		//CONTROLES Y ACCIONES CON FILTROS.	
//	********* CONTROLES PARA FORMULARIO ABM PARTIDO	*****************
		//********************************/change del icomt
		$("#icompPartido").on("click onchange",function()
				{
				if($("#icompPartido").val() != 9999)
				{
					var competenciaElegida = $("#icompPartido").val();	
					$(vCompetencias).each(function(i, v)
						{ // indice, valor
							if(v.idcomp == competenciaElegida)
								$("#SetMaxComp").val(v.setnmax);
						});		
				}
			});//change del ICate
		//********************************/change del IComp
		// CARGAR HORA ACTUAL AL SELECCIONAR
		$("#horai").on("focus",function() 
		{
			//alert('recfibi el focus..');	
			var dt = new Date();
	//		var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
		    var tiempo = {
		        hora: dt.getHours(),
		        minuto: dt.getMinutes(),
		        segundo: dt.getSeconds()
			};
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
			var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin ; //+':' + tiempoTxtSeg 
			if($("#horai").val() == '')
			   		$("#horai").val(tiempoTxt); //SINO TIENE HORA CARGADA
		});								

		var f=new Date();
		 var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
		 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
		 				,"27","28","29","30","31");
		 var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
		var fechapartido = f.getFullYear() + "-" + meses[f.getMonth()] + "-" +dias[(f.getDate()-1)] ;
		 	// EL FORMATO SIEMPRE TIENE QUE SER YYYY-MM-DD fechapartido = '2018-10-16';
		 $("#xfechapartido").val(fechapartido);

         $("#icatePartido").on("click onchange",function()
         {
			var categoriaELegida = $("#icatePartido").val();	
			$(vCategorias).each(function(i, v)
			{ // indice, valor
				if(v.idcategoria == categoriaELegida )
					$("#SetMaxCat").val(v.setMax);
			});		
        });//change del ICate		 
		
		$("#itextA").keyup(function()
		{   
				var filtro = $("#itextA").val();
				$("#iclubLocal").empty();
				$(vEquipos).each(function(i, v)				
				{ // indice, valor

					if(( v.clubabr.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 ) || ( v.nombre.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 )) 
					{
						$("#iclubLocal").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					}
				});

		});

		$("#itextB").keyup(function()
		{   
			var filtro = $("#itextB").val();
				$("#iclubb").empty();
				$(vEquipos).each(function(i, v)				
				{ // indice, valor

					if(( v.clubabr.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 ) || ( v.nombre.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 )) 
					{
						$("#iclubb").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					}
				});

		});	


		$("#iclubLocal").on("keypress, keydown, keyup", function(e) {
  				var code = e.keyCode || e.which;
						 SeleccionaClubLocal("iclubLocal");
			});
		$("#iclubLocal").on("click change", function(e) {
  				var code = e.keyCode || e.which;
				 		SeleccionaClubLocal("iclubLocal");  
			});			

			$("#iclubsede").on("keypress, keydown, keyup", function(e) {
  				var code = e.keyCode || e.which;
						 SeleccionaClubLocal("iclubsede");
			});
			$("#iclubsede").on("click change", function(e) {
  				var code = e.keyCode || e.which;
				 		SeleccionaClubLocal("iclubsede");  
			});			



		$("#isede").on("keypress, keydown, keyup", function(e) 
		{
			var code = e.keyCode || e.which;
			var idClub_sede = $(this).val();
			var idClub=idClub_sede.split('_')[0];
			var idSede=idClub_sede.split('_')[1];
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

			$(vCanchas).each(function(j, w)
				{ // indice, valor
					//console.log('en '+j+' hay '+w);
					//v.idclub+'_'v.idsede+'_'+v.idcancha
					var codigoEncriptado = '';	
					if( (w.idsede == idSede ) && (w.idclub == idClub)  )
					{
						codigoEncriptado = idClub+'_'+idSede+'_'+w.idcancha;
						$("#icancha option[name="+ codigoEncriptado +"]").attr("selected",true);
						return true; //	solo lo hace una vez
					}
				});
			});			


//	********* CONTROLES PARA FORMULARIO ABM PARTIDO	*****************
	  });		


	</script>
		
		
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
	<dialog id="modalEsperar" class="XModalesWaiter">
		<div class="donut"></div>
	</dialog>

  <dialog id="formularioAcciones"	class="XSModales">
  <h3 id="Titulo">Ingreso de Partidos</h3>	
    <section id="Errores" name="Errores" class="Acciones"></section>
	<section id="Acciones" name="Acciones" class="Acciones">	
			<button id="btnAddPartido" name="btnAddPartido" class="butSquareEqBluFull" >ADD</button>
			<button id="btnDelPartido" name="btnDelPartido" class="butSquareEqRedRackam">DEL</button>
			<button id="btnModPartido" name="btnModPartido" class="butSquareEqOrang">MOD</button>
			<button id="btnCopPartido" name="btnCopPartido" class="butSquareEqViolett">CPY</button>
			<button id="CerrarDiagX" name="CerrarDiagX" class="butSquareEqGreen">X</button>
	</section>	
	<section class="FormCargaPartidos SinTope">
		<form action="" method="post" name="FormPartidosMulti" id="FormPartidosMulti" enctype="multipart/form-data" class="PartidoCab">
			<section class="CabeceraGestionPartido">
				<span>Año control</span>
				<select id="ianio" name="ianio" class="ianio">
					<option value="9999">Seleccionar año...</option>
				</select>	
				<div>Competencia</div>
				<select id="icompPartido" name="icompPartido">
					<option value="9999">Seleccione una competencia</option>
				</select>
				<div class="SetMaximosGrid">
					<label>Sets</label>
					<input type="text" id="SetMaxComp" name="SetMaxComp" class="inputSets" disabled="">
					<label>ID</label>
					<input type="number" id="IDPartido" name="IDPartido" class="inputSets" disabled="">					
				</div>	
			</section>

			<div class="DatosPartido">	
				<section class="DatosPartidoDetalle" id="DatosPartidoDetalle" name="DatosPartidoDetalle">
					<section id="DatosPartido_item" class="itemDatosPartidoDetalle">
						<div class="fechapartido">
							<label for="xfechapartido">FECHA X</label>
							<input type="date" id="xfechapartido" name="xfechapartido">
						</div>
						<div class="fechapartido">
							<label for="xStadopartido">Estado</label>
							<select id="xStadopartido" name="xStadopartido" ><!-- LE QUITO EL disabled -->
								<option value="9999">Seleccione un estado</option>
							</select>
						</div>
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
								<label for="icatePartido">Categoria</label>
							</div>
							<div class="renHC6">
									<select name="icatePartido" id="icatePartido">
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

							<div class="renHC11">
								<label>Resultado Local</label>
							</div>
							<div class="renHC12">
								<input type="text" id="valRESULTADOA" name="valRESULTADOA" class="inputSets" value="">
							</div>

							<div class="renHC13">
								<label>Resultado Visitante</label>
							</div>
							<div class="renHC14">
								<input type="text" id="valRESULTADOB" name="valRESULTADOB" class="inputSets" value="">
							</div>
							
						</div>
						<div class="renglonEquiposABM">
							<div class="renEQ1">
								<label for="iclubLocal">Local</label>
							</div>
							<div class="renEQ2">
								<input type="text" id="itextA" name="itextA" class="inputSearch">
							</div>
							<div class="renEQ3">
								<select name="iclubLocal" id="iclubLocal">
									<option value="9999">Seleccione un Club...</option>
								</select>
							</div>
							<div class="renEQ4">
									<label for="iclubb">Visitante</label>
							</div>
							<div class="renEQ5">
									<input type="text" id="itextB" name="itextB" class="inputSearch" >
							</div>
							<div class="renEQ6">
									<select name="iclubb" id="iclubb">
											<option value="9999">Seleccione un Club...</option>
									</select>
							</div>			
						</div>
						<div class="renglonUbicacionABM">
								<div class="renUB8">
										<label for="icancha">Club Sede</label>
								</div>
								<div class="renUB9">
								<select id="iclubsede" name="iclubsede" class="SelList">
												<option value="9999" selected="">Seleccione un club</option>
										</select>
								</div>

								<div class="renUB10">
										<label for="icancha">Sede Local</label>
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
</dialog>
	<!-- visualizacion de carga -->		
    <!-- bloque de busqueda -->    
<div class="ContieneGrillaBusqueda">

        <div class="BotonAccionSuperior">
                <button class="bt-Ocultar" id="ocultarVer" name="ocultarVer" onclick="AccionOcultarControles();" >
                    <span class="icon-cross"></span>
                </button>
        </div>       
		<section class="FiltrosContenedor">

        <div class="DetalleGrillaBusquedaPartidos">	
            <div class="barraFiltrosFechaCancha">
                <span>Desde</span>
                <input id="FechaDde" name="FechaDde" type="date"></input>
			</div>	
			<div class="barraFiltrosFechaCancha">
                <span>Hasta</span>
                <input id="FechaHta" name="FechaHta" type="date"></input>
			</div>	
			<div class="barraFiltrosFechaCancha">
				<div class="DetalleGrillaBusquedaPartidos">	
	                <span>Orden</span>
					<input type="checkbox" id="fecDdeAscDsc" class="fecDdeAscDsc" />
				</div>
                <span>Buscar</span>
                <button id="FechaDdeHta" name="FechaDdeHta" class="ActivarDark">Go</button>
			</div>
			</div>

        <div class="DetalleGrillaBusquedaPartidos">
            <div class="barraFiltrosCancha barraFiltrosCanchaDark">Club Local
                   <div>
                        <input type="text" id="itextbuscarFiltro" name="itextbuscarFiltro" class="inputSearchPartido"/>
                   </div>
                    <select id="iclubFiltro" name="iclubFiltro" class="SelList"> 
                        <option value="0" selected>Seleccione un club</option>
                    </select> 
            </div>
        </div>

		<div class="DetalleGrillaBusquedaPartidos">	
            <div class="barraFiltrosCancha barraFiltrosCanchaDark">Competencia
                <select id="icompetenciaFiltro" name="icompetenciaFiltro" class="SelList"> 
                    <option value="9999" selected>Seleccione una competencia</option> 
                </select> 
            </div>
        </div>

		<div class="DetalleGrillaBusquedaPartidos">	
            <div class="barraFiltrosCancha barraFiltrosCanchaDark">Categoria
                <select id="icategoriaFiltro" name="icategoriaFiltro" class="SelList"> 
                    <option value="0" selected>Seleccione una categoria</option> 
                </select> 
            </div>
        </div>

		<div class="DetalleGrillaBusquedaPartidos">	
            <div class="barraFiltrosCancha barraFiltrosCanchaDark">Estados
                <select id="iestadoFiltro" name="iestadoFiltro" class="SelList"> 
                    <option value="0" selected>Seleccione un estado</option> 
                </select> 
            </div>
        </div>

		<div class="DetalleGrillaBusqueda">
                <div>Partidos</div>
                <div><input type="number" id="partidosLista" name="partidosLista" disabled /></div>
        </div>

		<div class="DetalleGrillaBusquedaPartidos">	
			<div>
				<input type="text" id="itextbuscarCodigo" name="itextbuscarCodigo" class="inputSearchPartido"/>
			</div>
			<button class="ActivarDark extendActivarDark" id="buscarDark" name="buscarDark">Buscar Codigo</button>
        </div>

		<div class="DetalleGrillaBusquedaPartidos">	
            <div class="barraFiltrosCancha barraFiltrosCanchaDark">Sin sede el partido
                <input id="sinSedeClubPartido" name="sinSedeClubPartido" type="checkbox" /> 
            </div>
            <div class="barraFiltrosCancha barraFiltrosCanchaDark">Sin sede el club
                <input id="sinSede" name="sinSede" type="checkbox" /> 
            </div>

        </div>
		
		<div class="DetalleGrillaBusquedaPartidos">	
            <div class="barraFiltrosCancha barraFiltrosCanchaDark barraFiltrosOscuro">Asignar Listados Club Sede
                <input id="fijarClubSedePartido" name="fijarClubSedePartido" type="checkbox" /> 
            </div>
        </div>

		<div class="DetalleGrillaBusquedaPartidos">	
			<div class="barraFiltrosCancha barraFiltrosCanchaDark">Con errores
                <select id="ierrorFiltro" name="ierrorFiltro" class="SelList"> 
                    <option value="9999" selected>Seleccione un error</option> 
                </select> 
            </div>
        </div>


		</section>
</div>



<div class="ContieneGrillaTabla">
	<div class="barraCancha DetalleGrillaTablaGPartidos ">
			<div><span class="icon-upload" onclick="abreDialogo('ALTA',0,'');"></span></div>
			<!-- <div></div>
			<div></div>
			<div>ID</div>
			<div></div>
			<div>Fecha</div>
			<div>Inicio</div>
			<div>Competencia</div>
			<div>C.Local</div>
			<div>Club Sede</div>
			<div>Sede</div>
			<div>Cancha</div>
			<div>C.Visita</div>
			<div>Estado</div>
			<div></div> -->
	</div>	
</div>
</body>
</html>

