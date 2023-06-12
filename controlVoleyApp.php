<?php include('sesioner.php'); ?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Administrar volleyAPP</title>
        <meta name="Control Anual vAPP" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link rel="stylesheet" href="./css/tableroControl_style.css">
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
		<style>
			
		</style>	
		<script type="text/javascript">

//+++++++++++++++ CREAMOS LOS VECTORES GLOBALES DESDE DONDE RE CARGAREMOS INFINITAMENTE LOS COMBOS..
		var vCategorias = new Array();
		var vEquipos = new Array();
		var vCanchas = new Array();
		var vSedes   = new Array();
		var vCiudades = new Array();
		var vCompetencias = new Array();
// +++++++++++++++++ FUNCIONES EXTRA ++++++++++++++++++++++++++++++++++++++


function cargarItems(){
	var TotalItems = $("#conteopartidos").val();
	var itemsLista= new Array(TotalItems);
	
	if(TotalItems != '' && TotalItems != '0'){
		for(var i=1;i<=TotalItems;i++){

			itemsLista.push( {
								"fechap":$("#fechap_"+i).val(),
								"dscp":$("#dscp_"+i).val(),
								"horai":$("#horai_"+i).val(),
								"icate":$("#icate_"+i).val(),
								"isede":$("#isede_"+i).val(),
								"SetMaxCat":$("#SetMaxCat_"+i).val(),
								"valtbset":$("#valtbset_"+i).val(),
								"valfinset": $("#valfinset_"+i).val(),
								"icluba":$("#icluba_"+i).val(),
								"iclubb": $("#iclubb_"+i).val(),
								"icancha" : $("#icancha_"+i).val(),
								"icity" : $("#icity_"+i).val(),
								});
		}
	}
return 	itemsLista;
};

function CargaFechaDefecto(item)
{

	var f=new Date();
		 var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
		 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
		 				,"27","28","29","30","31");
		 var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
		 var fechapartido = f.getFullYear() + "-" + meses[f.getMonth()] + "-" +dias[(f.getDate()-1)] ;
		 	//alert(fechapartido);
		 	// EL FORMATO SIEMPRE TIENE QUE SER YYYY-MM-DD 
			//fechapartido = '2018-10-16';
$("#fechap_"+item).val(fechapartido);


}


function TraeSetMaxCompetencia()
{

if($("#icompetencia").val() != 9999)
{

	var parametros = {"idcomp" : $("#icompetencia").val()};	
	$.ajax({ 
		url:   './abms/setcomp.php',
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
			$("#SetMaxComp").val(re['SetMaxComp1']);
		},
		error: function (xhr, ajaxOptions, thrownError)
		{
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
		}
	});// CIERRE DEL AJAX

}

}

function TraeSetMaxCategoria(itemNumero){
    var icategoriaElegida =0;
	icategoriaElegida = $("#icate_"+itemNumero).val();
	var parametros = {"idcate" :icategoriaElegida };	
    if(icategoriaElegida != 9999)
	{    
		$.ajax({ 
				url:   './abms/setcate.php',
				type:  'GET',
				data: parametros ,
				datatype:   'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){
					// Bloqueamos el SELECT de los cursos
					//$("#isede2").prop('disabled', true);
				},
				done: function(data){
					
				},
				success:  function (r){
					var re = JSON.parse(r);
					//console.log(re);
					// vuelve del POST, con un json que no es un array aun,
					// es necesario convertirlo a array
						$("#SetMaxCat_"+itemNumero).val(re['SetMaxCat1'].setMax);
				},
				error: function (xhr, ajaxOptions, thrownError)
				{
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				}
				});// CIERRE DEL AJAX
	}
}

// cuando PRESIONO CLICK , LO ACTUALIZO
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

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function quitarRenglonesPartidos(contadorRenglones,destinoId,estructuraNombre){
// elimino siempre el ultimo agregado

	var generaIdItem=0;

	generaIdItem = parseInt( $(contadorRenglones).val() );

	if(generaIdItem != 0)
	{
	$(estructuraNombre+generaIdItem).remove();

	generaIdItem -=1;

	$(contadorRenglones).val(generaIdItem);
	}
	else alert('No hay mas partidos para borrar, no insista...');
}

function crearRenglonesPartidos(contadorRenglones,destinoId,estructuraNombre){
//	crearRenglonesPartidos'#conteopartidos','#DatosPartidoDetalle','#DatosPartido_item_')
var generaIdItem=0;
generaIdItem =  parseInt($(contadorRenglones).val());
generaIdItem +=1;
	$(contadorRenglones).val(generaIdItem);

	var CadenaHTML='';
CadenaHTML +='<section id="DatosPartido_item_'+generaIdItem+'" class="itemDatosPartidoDetalle">'+
			'<div class="fechapartido">'+
			'	<label for="fechap">FECHA X</label>'+
			'	<input type="date" id="fechap_'+generaIdItem+'" name="fechap_'+generaIdItem+'" onfocus="CargaFechaDefecto('+generaIdItem+');">'+
			'</div>'+
			 '	<div class="renglonHoraCat">'+
				'		<div class="renHC1"><label for="dscp">CODIGO </label></div>'+
				'	<div class="renHC2"><input type="text" id="dscp_'+generaIdItem+'" name="dscp_'+generaIdItem+'" /></div>'+
				'	<div class="renHC3"><label for="horai">Hora inicio</label></div>'+
				'	<div class="renHC4"><input type="time" id="horai_'+generaIdItem+'" name="horai_'+generaIdItem+'" onfocus="Ahora(this);"></div>'+
				'	<div class="renHC5"><label for="icate">Categoria</label></div>'+
				'	<div class="renHC6">'+
					'			<select name="icate_'+generaIdItem+'" id="icate_'+generaIdItem+'" onchange="TraeSetMaxCategoria('+generaIdItem+');">'+
						'			<option value="9999">Seleccione una categoria</option>'+
						'	</select>'+
						'</div>'+
						'<div class="renHC7"><label>Sets </label></div>'+
						'<div class="renHC8"><input type="text" id="SetMaxCat_'+generaIdItem+'" name="SetMaxCat_'+generaIdItem+'" class="inputSets" disabled></div>'+
						'<div class="renHC9"><label>Ptos Fin TBreak</label></div>'+
						'<div class="renHC91"><input type="text" id="valtbset_'+generaIdItem+'" name="valtbset_'+generaIdItem+'" class="inputSets" value="15"></div>'+
						'<div class="renHC10"><label>Ptos Fin Set</label></div>'+
						'<div class="renHC101"><input type="text" id="valfinset_'+generaIdItem+'" name="valfinset_'+generaIdItem+'" class="inputSets"  value="25"></div>'+
						'</div>'+
				'<div class="renglonEquipos">'+
					'<div class="renEQ1"><label for="iclub">Local</label></div>'+
					'<div class="renEQ2"><input type="text" id="itextA'+generaIdItem+'" name="itextA" class="inputSearch"  onkeyup="buscarClub(this.id,\'icluba_'+generaIdItem+'\');"></div>'+
					'<div class="renEQ3"><select name="icluba_'+generaIdItem+'" id="icluba_'+generaIdItem+'"  onchange="SeleccionaClubLocal(this.id,'+generaIdItem+');" onclick="SeleccionaClubLocal(this.id,'+generaIdItem+');"><option value="9999">Seleccione un Club...</option></select></div>'+
					'<div class="renEQ4"><label for="iclub">Local</label></div>'+
					'<div class="renEQ5"><input type="text" id="itextB'+generaIdItem+'" name="itextB" class="inputSearch" onkeyup="buscarClub(this.id,\'iclubb_'+generaIdItem+'\');"></div>'+
					'<div class="renEQ6"><select name="iclubb_'+generaIdItem+'" id="iclubb_'+generaIdItem+'"  ><option value="9999">Seleccione un Club...</option></select></div>'+
				'</div>'+
				'<div class="renglonUbicacion">'+
				   '<div class="renUB10"><label for="icancha">Sedes</label></div>'+
					'<div class="renUB11">'+
					      '<select id="isede_'+generaIdItem+'"  name="isede_'+generaIdItem+'"  class="SelList" onchange="SeleccionaCancha(this.id,'+generaIdItem+');" onclick="SeleccionaCancha(this.id,'+generaIdItem+');"  >'+
							'<option value="9999" selected="">Seleccione una sede</option></select>'+
					'</div>'+
					'<div class="renUB1"><label for="icancha">Canchas</label></div>'+
					'<div class="renUB2"><select id="icancha_'+generaIdItem+'"  name="icancha_'+generaIdItem+'"  class="SelList">'+
								'		<option value="9999" selected="">Seleccione una cancha</option>'+
									'</select></div>'+
					'<div class="renUB3"><label for="icity">Ciudades cargadas</label></div>'+
					'<div class="renUB4"><select id="icity_'+generaIdItem+'" name="icity_'+generaIdItem+'" class="SelList">'+
							'<option value="9999">Seleccione una ciudad</option>'+
							'</select></div>'+
					'</div>'+
				'</section>';
	$("#DatosPartidoDetalle").append(CadenaHTML);

		creaCategoriasx('icate',generaIdItem);
		
		creaEquiposx("icluba",generaIdItem);
		creaEquiposx("iclubb",generaIdItem);

		creaCanchasx('icancha',generaIdItem);
		creasCiudadesx('icity',generaIdItem);

		creasSedesx('isede',generaIdItem)


}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function SeleccionaCancha(objetoSede,item)
{
	var idClub_sede = $("#"+objetoSede).val();
		var idClub=idClub_sede.split('_')[0];
		var idSede=idClub_sede.split('_')[1];
		$(vCanchas).each(function(j, w)
		{ // indice, valor
			if( (w.idsede == idSede ) && (w.idclub == idClub)  )
			{
				$("#icancha_"+item).val(w.idcancha);
				return true; //	solo lo hace una vez
			}
		});
}

function SeleccionaClubLocal(objetoClubID,item)
{
	var clubOrigen = $("#"+objetoClubID).val();
	//console.log(vSedes);
	// borro objeto Cancha 
	// recorro objeto cancha, si encontré alguna, le asigno el valor de la primera que encuentro
	// necesito recorrer las sedes !!!!
	$(vSedes).each(function(i, v)
	{
		//console.log('club: '+ 	v.idclub + ' y sede: ' + v.idsede);
		if (v.idclub == clubOrigen ){
			$(vCanchas).each(function(j, w)
			{ // indice, valor
				if( ( w.idclub == v.idclub ) && (w.idsede == v.idsede) )
				{
					//alert('encontre una cancha del club, me ubico ahi..club: '+ v.idclub +' cancha id ' +w.idcancha+ ' sede: '+w.idsede);
					$("#isede_"+item).val(v.idclub+"_"+v.idsede);
					//$("#icancha_"+item).val(w.idcancha);
					return true; //	solo lo hace una vez
					// return true; SIGUE CORRIENDO
				}
			});
		}
	}); 

	$(vEquipos).each(function(i, v)
		{ // indice, valor
				if( v.idclub == clubOrigen && v.idciudad != 0)
				{
					//alert('el club tenia ciudad..:');
					$("#icity_"+item).val(v.idciudad);	
				}
		});		

}

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

function creaCategoriasx(nombreObj,idpartido){
	// console.log('crear Categoria para : ' + "#"+nombreObj+"_"+idpartido );
	var selectCats = "";
			// esto arreglo el tema del alta triplle..

		$(vCategorias).each(function(i, v)
		{ // indice, valor
				// console.log('Datos categoria: '+v.descripcion);
				$("#"+nombreObj+"_"+idpartido).append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
		});		
	
	return 	selectCats ;
	};


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

function creaEquiposx(nombreObj,idpartido){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	var selectEquipos = "";
			// esto arreglo el tema del alta triplle..
		$(vEquipos).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj+"_"+idpartido).append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
		});		
	
	return 	selectEquipos ;
	};

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

function creaCanchasx(nombreObj,idpartido){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	var selectCanchas = "";
			// esto arreglo el tema del alta triplle..
		$(vCanchas).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj+"_"+idpartido).append('<option value="' + v.idcancha + '">' +v.clubabr+' - '+ v.extras+' - '+ v.nombre + '</option>');
		});		
	
	return 	selectCanchas ;
	};

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

	function creasCiudadesx(nombreObj,idpartido){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	// Nombre:"Banfield"
	// idCiudad:"13"
	// provincia:"Buenos Aires"	
		var selectCiudad = "";
			// esto arreglo el tema del alta triplle..
		$(vCiudades).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj+"_"+idpartido).append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
			//alert(selectPuesto);
		});		
		
	return 	selectCiudad ;
	};


function creasSedesx(nombreObj,idpartido)
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
					$("#"+nombreObj+"_"+idpartido).append('<option value="' + v.idclub+"_"+v.idsede + '"> ( ' + clubNombreAbr+' )'+ v.direccion + '-'+v.extras +'</option>');
		});		
		
	return 	selectSede ;

}

function agregarPartido(ESTADO,v)
{
	
	if (! $('#grid-ListaPart21').find("[name='PARTIDO"+v.Fecha+v.idPartido+"']").length)
	{
	    var alta='';
		//'<a href="VerCSets.php?id='+v.idPartido+'&setmax='+v.setsnmax+'&fecha='+v.Fecha+'&llama=index';
			//alta+='"><input type="button" id="nuevoset" name="nuevoset" class="btnVerSet_21 Naranja " value="(0/)" title="Revisar valores del Set"></input></a>';
			  var img ='';
		if(v.descripcion.includes('SUSPENDIDO')) var claseColor = '';
	    if(v.descripcion.includes('PROGR')) var claseColor = 'amarillo';
	    if(v.descripcion.includes('LLUVI')) var claseColor = '';
	    if(v.descripcion.includes('FIN'))   var claseColor = 'rojoCereza';		
	    if(v.descripcion.includes('CURSO')) var claseColor = 'verdeControl';
	    	
	    //if(! v.descripcion.includes('FIN')) 
		 alta=''; 


	   
	    var divClubA='<div class="ilp211" >'+
	    				'<div class="ilp211x" >'+
	        				'<div class="ilp211A" >'+
	        					v.ClubA+
	        				'</div>'+
	        				'<div class="ilp211B" id="ilp211B_'+v.Fecha+v.idPartido+'">'+
	        				'</div>'+
	        			'</div>'+
	    			'</div>';
	    			
	    var divClubB='<div class="ilp213" >'+
	    				'<div class="ilp213x" >'+
	        				'<div class="ilp213A" >'+
	        					v.ClubB+
	        				'</div>'+
	        				'<div class="ilp213B" id="ilp213B_'+v.Fecha+v.idPartido+'">'+
	        				'</div>'+
	    			    '</div>'+
	    			'</div>';			                			
	   
	   //var Ver = '<a href="TableroGrande.php?id='+v.idPartido+'&fecha='+v.Fecha+'">';
	   var Ver = '<a href="TableroGrandev25.php?id='+v.idPartido+'&fecha='+v.Fecha+'&vuelve=CONTROL">';
			Ver +=  '<input type="button" id="verset" name="verset" class="btnVerSet_21 '+ claseColor +'" value="(ver)" title="Re-veer set"></input>';
			 Ver +=  '</a>';

	if(ESTADO == 'PROGRAMADO')
	{
	$("#grid-ListaPart21").append('<section class="grid-ListaPart21" id="grid-ListaPart21">'+
				'<section class="agrid-LPReg21" id="grid-LPReg21">'+
					divClubA+
				  '<div class="ilp212">'+v.ClubARes+'</div>'+
				    divClubB+
				  '<div class="ilp214">'+v.ClubBRes+'</div>'+
				  '<div class="imgdiv ilp215">'+
				  		'</div>'+
		  	 '<div class="ilp2116">'+
			  		'<input type="hidden" name="PARTIDO'+v.Fecha+v.idPartido+'" />'+
			  			alta+Ver+
					 '<input type="hidden" id="fechaxpartido" value="'+v.Fecha+'" />'+
					 '<input type="hidden" id="idxpartido" value="'+v.idPartido+'" />'+
			 	 '</div>'+
				  '<div class="ilp217">Competencia: '+v.cnombre+'</div>'+
				  '<div class="ilp218">'+v.CatDesc+'</div>'+
				  '<div class="ilp219">'+v.Fecha+'</div>'+
				  '<div class="ilp2110">'+v.Inicio+'</div>'+
			   '</section>'+
		   '</section>');
		obtenerEscudo(v.idcluba,'#ilp211B_'+v.Fecha+v.idPartido);
		obtenerEscudo(v.idclubb,'#ilp213B_'+v.Fecha+v.idPartido);
	}
	else
		{
			$("#grid-ListaPart21Otros").append('<section class="grid-ListaPart21" id="grid-ListaPart21Otros">'+
					'<section class="agrid-LPReg21" id="grid-LPReg21">'+
						divClubA+
					  '<div class="ilp212">'+v.ClubARes+'</div>'+
					    divClubB+
					  '<div class="ilp214">'+v.ClubBRes+'</div>'+
					  '<div class="imgdiv ilp215">'+
					  		'</div>'+
			  	 '<div class="ilp2116">'+
				  		'<input type="hidden" name="PARTIDO'+v.Fecha+v.idPartido+'" />'+
				  			alta+Ver+
						 '<input type="hidden" id="fechaxpartido" value="'+v.Fecha+'" />'+
						 '<input type="hidden" id="idxpartido" value="'+v.idPartido+'" />'+
				 	 '</div>'+
					  '<div class="ilp217">Competencia: '+v.cnombre+'</div>'+
					  '<div class="ilp218">'+v.CatDesc+'</div>'+
					  '<div class="ilp219">'+v.Fecha+'</div>'+
					  '<div class="ilp2110">'+v.Inicio+'</div>'+
				   '</section>'+
			   '</section>');
			obtenerEscudo(v.idcluba,'#ilp211B_'+v.Fecha+v.idPartido);
			obtenerEscudo(v.idclubb,'#ilp213B_'+v.Fecha+v.idPartido);
		}	
	};
};

function Ahora(objeto)
{
	var dt = new Date();
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
			
		$("#"+objeto.id).val(tiempoTxt);

}

$(document).ready(function(){


	// esta linea aca y luego en partido_script.js frenan el submit 
	  	$("#FormPartidosMulti").submit(function(e){e.preventDefault();});			

// COIGO PARA ANIMAR LA HAMBURGUESA
	var win = $(this); //this = window
	$("#medidas").val('RESPONSIVE DATA:W: ' + win.width()+' - H: '+ win.height());

	// COIGO PARA ANIMAR LA HAMBURGUESA
	$(window).on('resize', function(){
			var win = $(this); //this = window
			$("#medidas").val('RESPONSIVE DATA:W: ' + win.width()+' - H: '+ win.height());
	});				

	<?php
			require_once('./abms/SesionTabla.php');
			$ingreso='';
			$graboSesion = SesionTabla::getsession("'".$_SERVER['REMOTE_ADDR']."'");
            if(isset($graboSesion["sesid"]))
	            if ((int)$graboSesion["sesid"] !=0) {
						echo('var sesion =1;');
						$_SESSION['INGRESO'] ="SI";
				} else
				{
					$_SESSION['INGRESO'] ="";
					echo('var sesion =0;');
				}
			else
				 echo('var sesion =0;');
		?>		

if (sesion == 0 )
	location.replace='index.php'; 


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




// carga inicial de la pantalla:
	pedirCarpetas(FechaHoy,'#carpetasfs'); //lee la carpeta de ese año o fall
	//	parametros: anio de analisis, nodo destino ID, club especifico en caso de tener valor
	controlEquiposActivos(FechaHoy,"#grillaEquipos22"); //trae los equipos que tienen jugadores para ese año o vacio.
	pedirPartidos(FechaHoy);
	pedirEquiposAnio(FechaHoy);

	vCategorias = cargarCategoriasStart();
	vEquipos = cargarEqupoStart();
	vCanchas = cargarCanchasStart();
	vSedes   = cargarSedesStart();
	vCiudades = cargarCiudadesStart();
	vCompetencias = cargarCompetenciasStart();
	creasCompetenciasx("icompetencia");
	creasCompetenciasx("icompanio");

	$(".itemAcceso1").hide();
	$(".itemAcceso1A").hide();
	$(".itemAcceso2").hide();
	$(".itemAcceso3").hide();
	$(".itemAcceso4").hide();	
	$(".itemAcceso6").hide();

//+++++++++++++++++++++++++++++++LLAMADA AL GET+++++++++++++++++++++++++++++++++++++++++++++++++++++


$("#ianio").on("change",function(){

pedirCarpetas($("#ianio").val(),'#carpetasfs'); //lee la carpeta de ese año o fall
	//	parametros: anio de analisis, nodo destino ID, club especifico en caso de tener valor
	
controlEquiposActivos($("#ianio").val(),"#grillaEquipos22"); //trae los equipos que tienen jugadores para ese año o vacio.
pedirPartidos($("#ianio").val());
pedirEquiposAnio($("#ianio").val());

$("#icanchas").val(9999);


});

$("#icompanio").on("change",function(){

	pedirEquiposAnio($("#ianio").val());


});

$("#crearRenglonesPartidos").on("click",function()
{
	crearRenglonesPartidos('#conteopartidos','#DatosPartidoDetalle','#DatosPartido_item_');
});

$("#quitarRenglonesPartidos").on("click",function()
{
	quitarRenglonesPartidos('#conteopartidos','#DatosPartidoDetalle','#DatosPartido_item_');
});

$("#agregarclub").on("click",function()
{
	var parametros={"llamador":'controlador',"funcion":'agregarclubanio',"ianio":$("#ianio").val(),"iclub":$("#seleccionclubes").val(),"equipoanioID":0};

	$.ajax({ 
    url:   './abms/abm_clubesporanio.php',
    type:  'GET',
    data: parametros ,
    datatype:   'text json',
	// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
    beforeSend: function (){},
    done: function(data){},
    success:  function (re){
		//idpersona, usuariopersona, nombrepersona, tipopersona         	  
		//var r = JSON.parse(re);
			pedirEquiposAnio($("#ianio").val());
    },
    error: function (xhr, ajaxOptions, thrownError)
    	{
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$(".errores").append(xhr);
		}
    });	

});

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/   
$("#buscarequipo").keyup(function()
	//	on("keyup keydown",function()
         {   
			var parametros = {
	        	"llamador" : "CONTROLAPP",
	        	"funcion" : "buscarclub",			
	        	"filtro" : $("#buscarequipo").val(),
	        	"ianio" : $("#ianio").val()		
				};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#seleccionclubes").empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#seleccionclubes').find("option[value='" + v.idclub + "']").length)
                	{
						$("#seleccionclubes").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
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
		$(".icono1").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").toggle();
			$(".itemAcceso1A").hide();
				$(".itemAcceso2").hide();
				$(".itemAcceso3").hide();
				$(".itemAcceso4").hide();
				$(".itemAcceso6").hide();
		});
		
		$(".icono2").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").hide();
			$(".itemAcceso1A").toggle();
				$(".itemAcceso2").hide();
				$(".itemAcceso3").hide();
				$(".itemAcceso4").hide();
				$(".itemAcceso6").hide();
		});
		$(".icono3").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").hide();
			$(".itemAcceso1A").hide();
				$(".itemAcceso2").toggle();
				$(".itemAcceso3").hide();
				$(".itemAcceso4").hide();
				$(".itemAcceso6").hide();
		});

		$(".icono4").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").hide();
			$(".itemAcceso1A").hide();
				$(".itemAcceso2").hide();
				$(".itemAcceso3").toggle();
				$(".itemAcceso4").hide();
				$(".itemAcceso6").hide();
		});
		
		$(".icono5").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").hide();
			$(".itemAcceso1A").hide();
				$(".itemAcceso2").hide();
				$(".itemAcceso3").hide();
				$(".itemAcceso4").toggle();
				$(".itemAcceso6").hide();
		});

		$(".icono6").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").hide();
			$(".itemAcceso1A").hide();
				$(".itemAcceso2").hide();
				$(".itemAcceso3").hide();
				$(".itemAcceso4").hide();
				$(".itemAcceso5").hide();
				$(".itemAcceso6").toggle();
		});		


		$("#altapm").on('click', function(e){

			iPartidos = new Array();
			iPartidos = cargarItems();
			var parametros = {
				"icompetencia": $("#icompetencia").val(), 
				 "SetMaxComp" : $("#SetMaxComp").val(),
				 "ianio"      :$("#ianio").val(),
				"listapartidos" :iPartidos	
			} 
			
	        $.ajax({
	            type: 'POST',
				url:   './abms/insertar_multi_partido.php',
		        data: parametros,
				beforeSend: function (){},
            	success:  function (r){
    				// $("#FormPartidoC").submit(function(e){e.preventDefault();});			
					 window.location='controlVoleyApp.php';
            	},
				error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					//$("#isede").append('<option value="9998">' + 'SUBMIT:: Error en el servidor Tabla Sedes..</option>');
					console.log("errorrrr");
				}
            }); // FIN funcion ajax	
	 });

		//  $("#sede").on("keypress, keydown, keyup", function(e) {
  		// 		var code = e.keyCode || e.which;
		// 		 var idClub_sede = $(this).val();
		// 			 var idClub=idClub_sede.split('_')[0];
		// 			 var idSede=idClub_sede.split('_')[1];
		// //			 alert('club: ' + idClub + ' sede: ' + idSede);	
		// 		 // la forma de llegar a la cancha, es atraves de la sede
		// 		$(vCanchas).each(function(j, w)
		// 		{ // indice, valor
		// 			if( (w.idsede == idSede ) && (w.idclub == idClub)  )
		// 			{
		// 				$("#icancha").val(w.idcancha);
		// 				return true; //	solo lo hace una vez
		// 			}
		// 		});
		// 	});

		// 	$("#isede").on("click change", function(e) {
  		// 		var code = e.keyCode || e.which;
				 
		// 		  var idClub_sede = $(this).val();
		// 			  var idClub=idClub_sede.split('_')[0];
		// 			 var idSede=idClub_sede.split('_')[1];
		// //				alert('club: ' + idClub + ' sede: ' + idSede);	
		// 		 // la forma de llegar a la cancha, es atraves de la sede
		// 		$(vCanchas).each(function(j, w)
		// 		{ // indice, valor
		// 			if( (w.idsede == idSede ) && (w.idclub == idClub)  )
		// 			{
		// 				$("#icancha").val(w.idcancha);
		// 				return true; //	solo lo hace una vez
		// 			}
		// 		});

		// 	});		


}); // parentesis del READY

function SeleccionarSede(isede,canchaid)
{

	var sedeSeleccionada = $("#"+isede.id).val();
	//console.log("sede seleccionada: "+sedeSeleccionada +' ' +isede.id);
		$("#icanchas").val($("#icanchas [name ='canchasede_"+sedeSeleccionada+"_"+canchaid+"']").val() );	
};


function eliminaClubAnio(equipoanioID){
	var parametros={"llamador":'controlador',"funcion":'borrarclubanio',"ianio":$("#ianio").val(),"iclub":0,"equipoanioID":equipoanioID};

	$.ajax({ 
    url:   './abms/abm_clubesporanio.php',
    type:  'GET',
    data: parametros ,
    datatype:   'text json',
	// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
    beforeSend: function (){},
    done: function(data){},
    success:  function (re){
		//idpersona, usuariopersona, nombrepersona, tipopersona         	  
		//var r = JSON.parse(re);
			pedirEquiposAnio($("#ianio").val());
    },
    error: function (xhr, ajaxOptions, thrownError)
    	{
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$(".errores").append(xhr);
		}
    });	

};

function pedirCarpetas(anio,destinoId)
{	 
	var parametros={"llamador":'controlador',"funcion":'CarDirectorios',"ianio":anio}
 	$.ajax({ 
    url:   './abms/obtener_varios.php',
    type:  'GET',
    data: parametros ,
    datatype:   'text json',
	// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
    beforeSend: function (){$(destinoId).empty();},
    done: function(data){},
    success:  function (re){
			//idpersona, usuariopersona, nombrepersona, tipopersona         	  
		var r = JSON.parse(re);
		//alert(r['estado']);
//       if(r['estado'] == 1) 
//	    {
				$(destinoId).val(r['Carpetas']);
//		}
//		else
//		 {			
//				$(destinoId).append('<option value="' + r['estado'] + '">' +r['Carpetas']+ '</option>');
//				//$(".errores").append(r['Carpetas']);
//		};
    },
    error: function (xhr, ajaxOptions, thrownError)
    	{
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$(".errores").append(xhr);
		}
    });
}
// ****************************************************************
function  cargarCategorias(vCategoriasClub,clubAnalisis){

	var divCategorias="";

	$(vCategoriasClub).each(function(i, v)
	{ // indice, valor
		if(v.idclub == clubAnalisis)
				divCategorias += '<div class="gridcatnomcatnit"> '+v.descripcion+' ( '+v.ConJugadores+' ) </div>';
	});

return	divCategorias;

}								

	
function controlEquiposActivos(ianiocargado,destinoID)
{
	//
	    var categoriasCargadas='';

		var parametros = {"ianio":ianiocargado,"todxs":1,"CategoriasXargadas":1};
				 $.ajax({ 
					url:   './abms/obtener_clubes.php',
					type:  'GET',
					dataType: 'json',
					data:parametros,
					// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
					beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
							 $(destinoID).empty(); 
					},
					done: function(data){
						
					},
					success:  function (r){
						// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
						// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"]
						//if($(r['Clubes']).length > 0) $("#equiposcargados").empty();

						if($(r['Clubes']).length > 0) $(destinoID).empty(); 
						else   $(destinoID).append(r['nombre']);


						$(r['Clubes']).each(function(i, v)
						{ // indice, valor
						if (! $('#equiposcargados').find("option[value='" + v.idclub + "']").length)
							{
								//$("#equiposcargados").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
								categoriasCargadas="";
								categoriasCargadas = cargarCategorias(r['Categorias'],v.idclub);
								$(destinoID).append(
									'<div class="grillaEquipos22">'+	
									'<div class="itgReQ1" id="nombreEquipo">'+v.clubabr+'</div>'+
										'<div class="itgReQ2" >'+
											'<div class="GridCatNomCant">'+
												categoriasCargadas+
											'</div>'+
										   '</div>'+											
										'</div>'); 
							}		
						});
					},
					 error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					$("#equiposcargados").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
					$("#equiposcargados").val('9999');
						//console.log(xhr.responseText);
						//console.log(thrownError);
					}
					}); 
					// FIN funcion ajax CONTROLEQUIPOSACTIVOS		

}

function asignarFecha(fechaAnio,mes,dia){
	fechapartido='';
	var f=new Date();
		var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
						 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
						 				,"27","28","29","30","31");
		var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
return fechapartido = (fechaAnio) + "-" + meses[mes] + "-" +dias[(dia)] ;
}

/** FUNCION QUE TRAE LOS EQUIPOS ANOTADOS ESE AÑO PARA JUGAR...asi se puede controlar que les falta agregar*/
function pedirEquiposAnio(ianioVer)
{
	var icompetencia = $("#icompanio").val();
	var parametros = 
			{
				"ianio" : ianioVer,
				"icompetencia" : icompetencia
			};		  
		/*se agregan los parametros a la llamada a este objeto...*/	
		         $.ajax({ 
		            url:   './abms/obtener_clubesporanio.php',
		            type:  'GET',
		            dataType: 'json',
		            data: parametros,
		            beforeSend: function (){$("#equiposAnio").html('');},
		            done: function(data){},
		            success:  function (r){
					var v_sedes = '';
					var v_canchas = '<select id="icanchas"><option value="9999">Sin canchas</option></select>';
					var v_categorias='';
					var escudoClub = '';

					if($(r['Clubes']).length > 0) 
					{ //1
						$(r['Clubes']).each(function(i, v)
						 { //2
						//v.nombre EQUIPONOMBRE
						 	if(v.escudo !='')
								escudoClub = '<img  src="'+"img/escudos/"+v.escudo+
											    '" class="imgjugadorindex"></img>'; 
							else            	
								escudoClub = '<img  src="img/jugadorGen.png" class="imgjugadorindex" ></img>';
								
						vClubes = '<div class="itemAccesoEquipos1A">'+
								   '<div class="itequipo1A" name="'+v.nombre+'">'+
									v.nombre+escudoClub+'</div><div class="itequipo2A">';
								 	//var CategoriasData = controlEquiposActivos(ianiocargado,destinoID,idclub);

									 /************************** agregar lista de categorias con los datos de la cantida de jugadores: *********/
								if($(v.Categorias).length > 0)
								{//3
									v_categorias = '<div class="GridCatNomCant">';//porque si viene vacia, ya la armo con el mensaje de VACIA			
									$(v.Categorias).each(function(j, z){//4
										//cargo categorias
										v_categorias+='<div class="gridcatnomcatnit"> '+z.descripcion+' ( '+z.ConJugadores+' [error @puestos '+ z.PuestosError+'] ) </div>' ;
									});//4
									v_categorias+= '</div>';
								}//3		
								else v_categorias= '<div class="GridCatNomCant"><div class="gridcatnomcatnit">Sin Categorias</div></div>';

							var canchasX = new Array();
							 
							if($(v.Sedes).length > 0)
							{//3
								v_sedes = '<select id="isedes" >';//porque si viene vacia, ya la armo con el mensaje de VACIA			

							$(v.Sedes).each(function(j, z){//4
										//cargo isedes
								v_sedes+='<option value="'+z.idsede +'" >(sede: '+z.idsede+')'+z.direccion+' '+z.extras+'</option>' ;
										if($(z.Canchas).length > 0)
										{//5
											$(z.Canchas).each(function(x, y){
												var cancha = [{"ciudad":y.extras,"nombre":y.nombre,"idsede":z.idsede,"idcancha":y.idcancha}];
												canchasX.push( cancha);
											});
										}//5
										else
										 {
										   var cancha = [{"ciudad":" cancha","nombre":" sin ","idsede":z.idsede,"idcancha":"0"}];
														canchasX.push( cancha);
										 };														
								  });//4		
								v_sedes+= '</select>';
							}//3		
							else v_sedes= '<select id="isedes"><option>'+v.Sedes+'</option></select>';
						//recorrer CANCHAS GUARDADAS EN VECTOR
							  //console.log(canchasX);
							v_canchas = '<select id="icanchas">'+
											'<option value="9999">Seleccionar...</option>';							
							$(canchasX).each(function(a, b){
								$(b).each(function(c, d){
									//console.log(d.ciudad);
											v_canchas+='<option name="canchasede_'+d.idsede+'" value="'+
													d.idcancha +'" >(sede:'+d.idsede+')'+d.nombre+'-'+d.ciudad+'</option>' ;
								});  
							});
							v_canchas+= '</select>';
							
						//recorrer CANCHAS GUARDADAS EN VECTOR						
						vClubes +=v_sedes+'</div><div class="itequipo3A">'+v_canchas+'</div>'+
									  '<div class="itequipo4A"><button class="botonPequenio" id="eliminarclub" onclick="eliminaClubAnio('+v.idequipoanio+'); ">-</button></div>'+
									  '<div class="itequipo5A">'+v_categorias+'</button></div>';
						if (! $('#equiposAnio').find("[name='"+v.nombre+"']").length)	
									$("#equiposAnio").append(vClubes);

						});
					}
					else $("#equiposAnio").html( r['Clubes'] );

				
				},
		             error: function (xhr, ajaxOptions, thrownError) {}
		            }); // FIN funcion ajax CLUBES x AÑO
}
/** FUNCION QUE TRAE LOS EQUIPOS ANOTADOS ESE AÑO PARA JUGAR...asi se puede controlar que les falta agregar*/


function pedirPartidos(ianioVer){
			
	        var FechaDesde= asignarFecha(ianioVer,0,0);
			var FechaHasta= asignarFecha(ianioVer,11,30);
			//icomp=9999&icate=&icity=&icity2=9999&iclub=&fdesde=2021-01-01&fdesdeOrden=1&fhasta=2021-12-31&estado=0
			//console.log('fechas desde '+FechaDesde);
			//console.log('fecha hasta '+FechaHasta);
			var parametros = 
			{
	        	"icomp" : 9999,
	        	"icate" : '',
				"icity" : '',
				"icity2" : 9999,
				"icate" : '',
				"iclub" : '',
				"fdesde" : FechaDesde,
				"fdesdeOrden" : 1,
				"fhasta" : FechaHasta,
				"estado" : 0
			};		  
			//"fhasta" : $("#fecHta").val(),
		/*se agregan los parametros a la llamada a este objeto...*/	
		         $.ajax({ 
		            url:   './abms/obtener_partidos.php',
		            type:  'GET',
		            dataType: 'json',
		            data: parametros,
		            beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
						$("#grid-ListaPart21").empty();
						$("#grid-ListaPart21Otros").empty();
		    		},
		            done: function(data){
						
					},
		            success:  function (r){

//						if($(r['Partidos']).length > 0)
//						{
//							 $("#grid-ListaPart21").empty();
//							 $("#grid-ListaPart21Otros").empty();
//						}						 
 						//else   $("#grid-ListaPart21").append(r['nombre']);
						
						
		                $(r['Partidos']).each(function(i, v)
		                { // indice, valor				
						
						if(v.descripcion.includes('PROGR')){
							agregarPartido('PROGRAMADO',v);
						}
						else {
							agregarPartido('OTROS',v);
						}
					  });
		            },
 		            
		             error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					}
		            }); // FIN funcion ajax CLUBES
}; 


function obtenerEscudo(idClub,idobjeto){
	//console.log(idobjeto);
	//var iEscudo='';
	//var re='' ;	
         var parametros = {"idClub" : idClub};	
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
				//console.log(re['escudo']);
				if(re['escudo'] !='')
					$(idobjeto).html('<img  src="'+"img/escudos/"+re['escudo']+'" class="imgjugadorindex"></img>'); 
    			else            	
    				$(idobjeto).html('<img  src="img/jugadorGen.png" class="imgjugadorindex" ></img>'); 

    		},
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });

 	}

	
</script>
 </head>
    <body>
		<?php 
			require_once('abms/SesionTabla.php');
			$graboSesion = SesionTabla::getsession("'".$_SERVER['REMOTE_ADDR']."'");
			if (isset($graboSesion))
				if ($graboSesion !=0)
						include('includes/newmenu.php');
			else{
				//echo("no trae sesion...");	
				include('includes/newmenu.php');
				}
	 	?>
    
<!--normal: 1070,<768:3288  -->


<div class="errores"></div>
  <div class="listaAccesos">

<div class="grillaTitulo">
 	<div class="itemtitulo1">
	   <A>Administracion Configuracion VolleyaPP</A>
 	</div>
 	<div class="itemtitulo2">
		<input type="text" id="medidas" name="medidas" value="" disabled/>
 	</div>
	<div class="itemtitulo3">
	<div class="iconosFunciones">
		<div class="icono1">
			<span class="icon-cloud-check" title="fotos carpeta"></span>
			<span>Fotos</span>
		</div>	
		<div class="icono2">
			<span class="icon-clipboard" title="equipos"></span>
			<span>Equipos</span>
		</div>
		<div class="icono3">
			<span class="icon-stats-bars2" title="categorias"></span>
			<span>Categorias</span>
		</div>
		<div class="icono4">
			<span class="icon-play3" title="Partidos sin jugar"></span>
			<span>P.Programados</span>
		</div>
		<div class="icono5">
			<span class="icon-filter" title="partidos jugados"></span>
			<span>P.Jugados</span>
		</div>
		<div class="icono6">
			<span class="" title="Carga partidos"></span>
			<span>Carga partidos</span>
		</div>
		<div class="icono7"><span class="" title=""></span></div>
		<div class="icono8"><span class="" title=""></span></div>
		<div class="icono9"><span class=""></span></div>
		<div class="icono10"><span class=""></span></div>
	</div>
		
	</div>
</div>

	
  <div class="grillaCambioAnio">
 	<div class="itemcambioanio1">
	   <A>Año control</A>
 	</div>
 	<div class="itemcambioanio2">
		<select id="ianio" name="ianio" class="ianio">
				<option value="9999">Seleccionar año...</option>
		</select>	
 	</div>

 	<div class="itemcambioanio31">
	   <A>Competencia control</A>
 	</div>
 	<div class="itemcambioanio4">
		<select id="icompanio" name="icompanio" class="ianio">
				<option value="9999">Seleccionar Competencia...</option>
		</select>	
 	</div>

</div>
<div class="grillAcciones"></div>

<div class="itemAcceso1" id="AdmUsuario">
	<div class="itfotos1">Carpeta de Fotos</div>
	<div class="itfotos2">
	<input type="text" id="carpetasfs" disabled/>
	</div>
	<div class="itfotos3">
		<button class="botonPequenio" id="AgregaCarpeta" />+
	</div>  		   

</div>  		  

<div class="itemAcceso1A" id="AdmEquipos">
	<div class="ita1A">Equipos</div>
	<div class="ita2A">
	<input type="text" id="buscarequipo" />
	</div>
	<div class="ita22A">
		<select id="seleccionclubes"><option></option></select>
		</div>
	<div class="ita3A">
		<button class="botonPequenio" id="agregarclub" />+
	</div>  		   
	<div class="ita4A" id="equiposAnio">
	</div>  		

</div>  		  


<div class="itemAcceso2"  id="AdmCarpetas">
	<div  class="itequipo1">Categorias por Equipo</div>
	<div  class="itequipo2">
	<!--	<select id="equiposcargados" class="colegioSel">
			<option value="9999">Equipos...</option>
		</select>
	-->	
	</div>
	<div  class="itequipo3">
		<button class="botonPequenio" id="AgregaEquipo" />+
	</div>
	<div  class="itequipo4">

		<div class="grillaEquipos22Cab" id="grillaEquipos22">
		</div>
	</div>	
</div> <!-- INFORMACION DE EQUIPOS....-->

<div class="itemAcceso3"  id="AdmCarpetas">
<section class="grid-ListaPart21" id="grid-ListaPart21">
	<section class="agrid-LPReg21" id="grid-LPReg21">
	  <div class="ilp211" >Eq Local</div>
	  <div class="ilp212">##</div>
	  <div class="ilp213">Eq Visitante</div>
	  <div class="ilp214">##</div>
	  <div class="imgdiv ilp215">
	 </div>
		<div class="ilp216">
		  <input type="hidden" name="PARTIDO2019-11-0803" />
			<!--<a href="TableroGrande.php?id=3&fecha=2019-11-08">-->
		 <input type="hidden" id="fechaxpartido" value="2019-11-08" />
		 <input type="hidden" id="idxpartido" value="3" />
	  </div>		
	  <div class="ilp217">Competencia</div>
	  <div class="ilp218">Categoria</div>
	  <div class="ilp219">Fecha</div>
	  <div class="ilp2110">Hora</div>
   </section>
</section> 
</div>

<div class="itemAcceso4"  id="AdmCarpetas">
<section class="grid-ListaPart21" id="grid-ListaPart21Otros">
	<section class="agrid-LPReg21" id="grid-LPReg21">
	  <div class="ilp211" >Eq Local</div>
	  <div class="ilp212">##</div>
	  <div class="ilp213">Eq Visitante</div>
	  <div class="ilp214">##</div>
	  <div class="imgdiv ilp215">
	 </div>
		<div class="ilp216">
		  <input type="hidden" name="PARTIDO2019-11-0803" />
			<!--<a href="TableroGrande.php?id=3&fecha=2019-11-08">-->
		 <input type="hidden" id="fechaxpartido" value="2019-11-08" />
		 <input type="hidden" id="idxpartido" value="3" />
	  </div>		
	  <div class="ilp217">Competencia</div>
	  <div class="ilp218">Categoria</div>
	  <div class="ilp219">Fecha</div>
	  <div class="ilp2110">Hora</div>
   </section>
</section> 
</div>

<div class="itemAcceso6"  id="AdmCarpetas">
 <section class="ForMultiplesPartidos">
	<form  action="" method="post" name="FormPartidosMulti" id="FormPartidosMulti"  enctype="multipart/form-data" class="PartidoCab">
		<section class="Botonera">
			<span>Alta Partidos</span>
			<button class="btnCabecera"	id="altapm" name="altapm" value="altap">(A+)</button>
		</section>
		<section class="Cabecera">
			<div>Competencia</div>
			<select id="icompetencia" name="icompetencia" onchange="TraeSetMaxCompetencia();">
				<option value="9999">Seleccione una competencia</option>
			</select>
			<div class="SetMaximosGrid">
				<label>Sets</label>
				 <input type="text" id="SetMaxComp" name="SetMaxComp" class="inputSets" disabled/>
			</div>	
		</section>

		<div class="DatosPartido">	
			<section class="Botonera">
				<span>Cant partidos</span>	
				<input type="number" id="conteopartidos" name="conteopartidos" value="0" disabled />
				<button class="btnNoCabecera" id="crearRenglonesPartidos" >+ Partido</button>
				<button class="btnNoCabecera" id="quitarRenglonesPartidos">- Form Partido</button>
			</section>

			<section class="DatosPartidoDetalle" ID="DatosPartidoDetalle" NAME="DatosPartidoDetalle">
			</section> <!-- fin del item datos partido-->											
			</section>		
		</div>
  </form>
</section>
</div>

 </div> <!-- lista accesos -->


  <!-- grilla de novedades, ultimos cargados -->
	<div class="grillaNovedades">
		<div class="novedad1">
			<div class="n1_item1"></div>
			<div class="n1_item1"></div>
			<div class="n1_item1"></div>
			<div class="n1_item1"></div>
			<div class="n1_item1"></div>
			<div class="n1_item1"></div>
		</div>
	</div>

</body>
</html>