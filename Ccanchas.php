<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Canchas
		</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <style>
			.XSModales
			{
				height:	-webkit-fill-available;
			}
			DIALOG{
				inset-inline-start: 0px;
				inset-inline-end: 0px;
				width:100%;

			}

			DIALOG  INPUT{
				width:100%;

			}

	   </style>
	   <!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		 <!-- <script type="text/javascript" src="./scripts/nsanz_script.js"></script>  -->
    <script type="text/javascript">
var vSedes   = new Array();

var vCanchas = new Array();
var vEquipos = new Array();

function creaCanchasx(nombreObj,idpartido){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	var selectCanchas = "";
			// esto arreglo el tema del alta triplle..
		$(vCanchas).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj+"_"+idpartido).append('<option value="' + v.idcancha + '" name="'+v.idclub+'_'+v.idsede+'_'+v.idcancha+'">' +v.clubabr+' - '+ v.extras+' - '+ v.nombre + '</option>');
		});		
	
	return 	selectCanchas ;
	};

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
		  },
		  error: function (xhr, ajaxOptions, thrownError) {}
		 }); // FIN funcion ajax	
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
  return iCanchas;		
}

function creaEquiposx(nombreObj){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
		//console.log('club seleccionado: ' + $("#ClubLocal").val());
	var selectEquipos = "";
			// esto arreglo el tema del alta triplle..
		$(vEquipos).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
		});
	if(nombreObj == 'icluba')	
		$("#"+nombreObj+"_"+idrenglon).val( $("#ClubLocal").val()  ) ;				
	return 	selectEquipos ;
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

function creaSedeX(nombreObj)
{

	// esto arreglo el tema del alta triplle..
		$(vSedes).each(function(i, v)
		{ // indice, valor
					// guardo la clave doble en el option value : v.idclub+"_"v.idsede	
					$("#"+nombreObj).append('<option value="' + v.idclub+"_"+v.idsede + '"> ' + v.extras+'-'+v.direccion +'</option>');
		});		
		
//	return 	selectSede ;

}

	function abreDialogo(modo,clubID,sedeID,canchaID,nombreCancha,ubicacionCancha,dimensionCancha){
			// ALTA, BAJA,MODIFICA
			// v.idclub,v.idsede,v.idcancha,v.nombre,v.ubicacion,v.dimensiones
		const modalForm =
				document.querySelector("#formularioAcciones");
		if(modo == 'BAJA' || modo == 'MODIFICA')
		{
			$("#idcancha").val(canchaID);	
			$("#iclub").val(clubID);
			$("#isede2").val(clubID+'_'+sedeID); // v.idclub+"_"+v.idsede
			$("#nomcancha").val(nombreCancha);
			$("#direc_can").val(ubicacionCancha);
			$("#dimcan").val(dimensionCancha);
		}		
		modalForm.showModal();

	}	
		

	function CanchasUI(parametroBusqueda){
		var cabeceraHtml = '<div class="DetalleGrillaTabla barraCancha">'+
						   '<div><span class="icon-upload" onclick="abreDialogo(\'ALTA\',0,0,0,\'\',\'\',\'\');"></span></div>'+
						   '<div></div>'+
						   '<div></div>'+
						   '<div>Club</div>'+
						   '<div>Sede</div>'+
						   '<div>Id</div>'+
						   '<div>Club Nom.</div>'+
						   '<div>Sede Nom.</div>'+
						   '<div>Cancha</div>'+
						   '<div>Ubicación</div>'+
						   '</div>';
		$(".ContieneGrillaTabla").html(cabeceraHtml);
		var conteoUI = 0;
		var renglonCancha = '';
		if(parametroBusqueda != -1)
		{
			$(vCanchas).each(function(i, v)
			{ // indice, valor
					if(parametroBusqueda == 0 || parametroBusqueda == 999999)
					{	
						renglonCancha = '<div class="DetalleGrillaTabla">'+
										'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idclub+','+v.idsede+','+v.idcancha+',\''+v.nombre+'\',\''+v.ubicacion+'\',\''+v.dimensiones+'\');"></span></div>'+
										'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idclub+','+v.idsede+','+v.idcancha+',\''+v.nombre+'\',\''+v.ubicacion+'\',\''+v.dimensiones+'\');"></span></div>'+
										'<div>'+v.idclub+'</div>'+
										'<div>'+v.idsede+'</div>'+
										'<div>'+v.idcancha+'</div>'+
										'<div>'+v.clubabr+'</div>'+
										'<div>'+v.extras+'</div>'+
										'<div>'+v.nombre+'</div>'+
										'<div>'+v.ubicacion+'</div>'+
										'</div>';

								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
					}			

					if(parametroBusqueda != 0)
					{
						if(v.idclub == parametroBusqueda)
						{	
						renglonCancha = '<div class="DetalleGrillaTabla">'+
										'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idclub+','+v.idsede+','+v.idcancha+',\''+v.nombre+'\',\''+v.ubicacion+'\',\''+v.dimensiones+'\');"></span></div>'+
										'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idclub+','+v.idsede+','+v.idcancha+',\''+v.nombre+'\',\''+v.ubicacion+'\',\''+v.dimensiones+'\');"></span></div>'+
										'<div>'+v.idclub+'</div>'+
										'<div>'+v.idsede+'</div>'+
										'<div>'+v.idcancha+'</div>'+
										'<div>'+v.clubabr+'</div>'+
										'<div>'+v.extras+'</div>'+
										'<div>'+v.nombre+'</div>'+
										'<div>'+v.ubicacion+'</div>'+
										'</div>';


								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
						} 	
					}			
			});
			$("#icanchasLista").val(conteoUI);
		}
		else
		{
			var conteoUI = 0;
			$(vEquipos).each(function(i, v)
			{ // indice, valor
				
				$("#icanchasLista").val(conteoUI);
				var tiene = buscarCanchaClub(v.idclub,vCanchas);
				console.log('busque a '+v.clubabr);	
				if(tiene == 0){
					var escudoSpan = '';	
					if(v.escudo !='')
						escudoSpan = '<span><img  src="'+"img/escudos/"+v.escudo+'" style="width:2em;height:2em;"></img><span>'; 
					else            	
						escudoSpan = '<span><img  src="img/jugadorGen.png" class="imgjugadorTablero" name="GENERICO" style="width:2em;height:2em;"></img></span>'; 


							renglonCancha = '<div class="DetalleGrillaTabla">'+
											'<div>'+escudoSpan+'</div>'+
											'<div>'+v.idclub+'</div>'+
											'<div>'+v.clubabr+'</div>'+
											'<div>'+v.nombre+'</div>'+
											'<div></div>'+
											'<div></div>';
									$(".ContieneGrillaTabla").append(renglonCancha);
									conteoUI++;
				}					
			});		
				$("#icanchasLista").val(conteoUI);
		}	
}

function buscarCanchaClub(clubid,vCanchas){

	var tiene = 0;
	$(vCanchas).each(function(u, w){
			if(w.idclub == clubid){
				tiene = 1;
			}	
		});

	return tiene;

}

	$(document).ready(function(){
		
		// DIALOG EN CONFIGURACION START NECESITO EL QUERYSELECTOR PARA OBTENER TODO EL OBJETO
		// SINO NO FUNCIONA BIEN EL OCULTAR DEL DIALOG
		// Y LAS ACCIONES A TOMAR SIEMPRE TIENEN QUE SER ESAS
			// ventana modal en si.LA ASOCIAMOS A UNA VARIABLE A TRAVES DE QUERYSELECTOR
	// ACCIONES A TOMAR,
	// 	ON BEFORE 
	// 	modalSUPL_A.showModal(); 
	// 	ON COMPLETE O ON SUCCESS
	// 	modalSUPL_A.close();

		const modalForm =
				document.querySelector("#formularioAcciones");
		//modalForm.showModal();

		vSedes = cargarSedesStart();
		vCanchas = cargarCanchasStart();
		vEquipos = cargarEqupoStart();

		creaSedeX("isede2");
		creaEquiposx("iclub");
		creaEquiposx("iclubFiltro");

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
		
//**************** CANCHAS *********************************************/  
		CanchasUI(0);  
            		
    // AJAX DE CARGA POR ID DE SEDES...xº CLUB  
         $("#iclub").on("click",function()
         {
			var parametroBusqueda =  $("#iclub").val();	
			$("#isede2").empty();
			$(vSedes).each(function(i, v)
			{ // indice, valor
				if(v.idclub == parametroBusqueda)
				{
					$("#isede2").append('<option value="' +v.idclub+'_'+ v.idsede + '"> ' + v.extras+'-'+v.direccion + '</option>');
				}	
			});
        });//change del ICLUB
         
         $("#isede2").change(function()
         {
         	$("#direc_can").val("");	
         	$("#direc_can").val($("#isede2 option:selected").text());// direccion por DEFAULT, LA DE LA CANCHA
		 });// cambio en el isede	


/***********************************************************/
        $("#Ingcancha").click(function(){ 
        // Guardamos el select de cursos
        //alert('click detected');
		const modalForm =
				document.querySelector("#formularioAcciones");

        if( ($("#iclub").val() != '') &&  ($("#isede2").val() != '') &&  ($("#nomcancha").val() != '') )
        {
			var sedeId = $("#isede2").val().split('_');
			var idsede = sedeId[1];
		var parametros = {
        	"iclub" : $("#iclub").val(),
        	"isede2" : idsede,
        	"nomcancha" : $("#nomcancha").val(),			
        	"direc_can" : $("#direc_can").val(),
        	"dimcan" : $("#dimcan").val()
			};		         
         //alert('no eran nulos los valores');
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_cancha.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
            },
            success:  function (r){
				//var re = JSON.parse(r);
				console.log('VOLVIO a Success....');
            	console.log(r);

				console.log(r['estado']);
				console.log(r['mensaje']);
					location.reload();

				// vuelve del POST, con un json que no es un array aun,
				// es necesario convertirlo a array
				// DESBloqueamos el SELECT de los cursos
    			

			},    
   			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				console.log(xhr);
				console.log(thrownError);
				
            }
            }); // FIN funcion ajax
    	  } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        	
        }
}); // parentesis el .CLICK INGRESOcancha

/***********************************************************/		  
// 					Actualiza del ICANCHAS	
/***********************************************************/

$("#CerrarDiagX").click(function(){
	const modalForm =
				document.querySelector("#formularioAcciones");

	modalForm.close();
});

$("#Delcancha").click(function()
		 {

			var sedeId = $("#isede2").val().split('_');
			var idsede = sedeId[1];
			var parametros = {
				 "idclub" : $("#iclub").val(),
				 "idsede" : idsede,
				 "idcancha" : $("#idcancha").val(),
				 "accion"   : 'DEL'
				 };	

			 $.ajax({ 
				url:   './abms/actualiza_cancha.php',
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
		  });

$("#Modcancha").click(function()
		 {
			var sedeId = $("#isede2").val().split('_');
			var idsede = sedeId[1];

			 var parametros = {
				 "idclub" : $("#iclub").val(),
				 "idsede" : idsede,
				 "idcancha" : $("#idcancha").val(),
					"nomcancha" : $("#nomcancha").val(),
					"direc_can" : $("#direc_can").val(),
					"dim_can" : $("#dimcan").val(),
					"accion"   : 'UPD'
				 };	
			 $.ajax({ 
				url:   './abms/actualiza_cancha.php',
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
		  });
/***********************************************************/		  
// 					Actualiza del ICANCHAS	
/***********************************************************/
//**************** CATEGORIAS *********************************************/ 		 

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
	$("#itextbuscar").keyup(function()
		//	on("keyup keydown",function()
		{   
			// 	var parametros = {
			//     	"llamador" : "CONTROLAPP",
			//     	"funcion" : "buscarclub",			
			var filtro = $("#itextbuscar").val();
					// };		         
			$("#iclub").empty();
			$(vEquipos).each(function(i, v)				
			{ // indice, valor
				if( v.nombre.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 || v.clubabr.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 ) 
				{
					$("#iclub").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre +'/'+v.ciudadnombre+'</option>');
				}
			});
		});
//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
	$("#itextbuscarFiltro").keyup(function()
		{   
			// 	var parametros = {
			//     	"llamador" : "CONTROLAPP",
			//     	"funcion" : "buscarclub",			
			var filtro = $("#itextbuscarFiltro").val();
			var cargado = 0;
	 		var canchaElegible = 0;
  
			$("#iclubFiltro").empty();
			$("#iclubFiltro").append('<option value="999999">Seleccionar Club...</option>');
			$(vEquipos).each(function(i, v)				
			{ // indice, valor
				if( v.nombre.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 || v.clubabr.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 ) 
				{
					$("#iclubFiltro").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre +'/'+v.ciudadnombre+'</option>');
					 cargado++;
					 canchaElegible = v.idclub;
				}
			});
				if(filtro == '') CanchasUI(0);
					if(cargado == 1 ) CanchasUI(canchaElegible);
		});
//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	

    // AJAX DE CARGA POR ID DE SEDES...xº CLUB  
	$("#iclubFiltro").on("click",function()
         {
			var parametroBusqueda =  $("#iclubFiltro").val();	
			//$("#isede2").empty();
				CanchasUI(parametroBusqueda);
		});//change del ICLUB

	$("#isincanchaFiltro").on("click",function()
         {
			if ($("#isincanchaFiltro").is(":checked")) {
				// it is checked
				CanchasUI(-1);
			}
			else 
				CanchasUI(0);

		});//change del ICLUB



}); // cierre ready
</script>
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
  <dialog id="formularioAcciones"	class="XSModales">
  <section>
    <h3>Ingreso de Canchas</h3>
	<section id="Acciones" name="Acciones" class="Acciones">	
		<button id="Ingcancha" name="Ingcancha" class="butSquareEqBluFull" >ADD</button>
		<button id="Delcancha" name="Delcancha" class="butSquareEqRedRackam">DEL</button>
		<button id="Modcancha" name="Modcancha" class="butSquareEqOrang">MOD</button>
		<button id="CerrarDiagX" name="CerrarDiagX" class="butSquareEqGreen">X</button>
   </section>	
		<form id="formConfig" name="formCanchas" class="formCanchas">
	
		<section id="busque" name="busque" class="busque">
		 	<div><label for="itext">Buscar</label></div>	
		 	<div><input type="text" id="itextbuscar" name="itextbuscar" class="inputSearch"/></div>
		 	<div></div>
	 	</section>	
		<input type="hidden" id="idcancha" name="idcancha">	
		<label for="iclub" class="">Club</label>
		<select id="iclub" name="iclub" class="SelList"> 
			<option value="9999" selected>Seleccione un club</option>
		</select> 
		<label for="isede2" class="">Sedes</label>
		<select id="isede2" name="isede2" class="SelList"> 
			<option value="9999" selected>Seleccione una Sede</option>
		</select>     
		<label for="nomcancha" class="">Cancha nombre</label>
		<input id="nomcancha" name="nomcancha"   type="text">
		<label for="direc_can" class="">Ubicación</label>
		<input id="direc_can" name="direc_can" type="text">
		<label for="dimcan" class="">Dimensiones</label>
		<input id="dimcan" name="dimcan" type="text">
		</form>
</section>
</dialog>

<div class="ContieneGrillaBusqueda">
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">buscar CLUB</div>
			<div><input type="text" id="itextbuscarFiltro" name="itextbuscarFiltro" class="inputSearch"/></div>
	</div>
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">CLUB</div>
			<div><select id="iclubFiltro" name="iclubFiltro" class="SelList"> 
					<option value="9999" selected>Seleccione un club</option>
				 </select> 
			</div>
	</div>	
	<div class="DetalleGrillaBusqueda">
			<div class="barraFiltrosCancha">SIN Cancha</div>
			<div><input type="checkbox" id="isincanchaFiltro" name="isincanchaFiltro" /></div>
	</div>		
	<div class="DetalleGrillaBusqueda">
			<div>Canchas</div>
			<div><input type="number" id="icanchasLista" name="icanchasLista" disabled /></div>
	</div>		
</div>


<div class="ContieneGrillaTabla">
	<div class="DetalleGrillaTabla barraCancha">
			<div><span class="icon-upload" onclick="abreDialogo('ALTA',0,0,0,'','','');"></span></div>
			<div></div>
			<div></div>
			<div>Club</div>
			<div>Sede</div>
			<div>Id</div>
			<div>Club Nom.</div>
			<div>Sede Nom.</div>
			<div>Cancha</div>
			<div>Ubicación</div>
			</div>	
</div>
</body>
</html>
