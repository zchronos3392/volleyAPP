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

// +++++++++++++++++ FUNCIONES EXTRA ++++++++++++++++++++++++++++++++++++++
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
	   var Ver = '<a href="TableroGrandev20.php?id='+v.idPartido+'&fecha='+v.Fecha+'&vuelve=CONTROL">';
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

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(document).ready(function(){

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


	$(".itemAcceso1").hide();
	$(".itemAcceso1A").hide();
	$(".itemAcceso2").hide();
	$(".itemAcceso3").hide();
	$(".itemAcceso4").hide();	

//+++++++++++++++++++++++++++++++LLAMADA AL GET+++++++++++++++++++++++++++++++++++++++++++++++++++++


$("#ianio").on("change",function(){

pedirCarpetas($("#ianio").val(),'#carpetasfs'); //lee la carpeta de ese año o fall
	//	parametros: anio de analisis, nodo destino ID, club especifico en caso de tener valor
	
controlEquiposActivos($("#ianio").val(),"#grillaEquipos22"); //trae los equipos que tienen jugadores para ese año o vacio.
pedirPartidos($("#ianio").val());
pedirEquiposAnio($("#ianio").val());

$("#icanchas").val(9999);


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
		});
		
		$(".icono2").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").hide();
			$(".itemAcceso1A").toggle();
				$(".itemAcceso2").hide();
				$(".itemAcceso3").hide();
				$(".itemAcceso4").hide();
		});
		$(".icono3").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").hide();
			$(".itemAcceso1A").hide();
				$(".itemAcceso2").toggle();
				$(".itemAcceso3").hide();
				$(".itemAcceso4").hide();
		});

		$(".icono4").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").hide();
			$(".itemAcceso1A").hide();
				$(".itemAcceso2").hide();
				$(".itemAcceso3").toggle();
				$(".itemAcceso4").hide();
		});
		
		$(".icono5").on("click",function(){
			//CARGAR/INGRESAR GASTO...
			$(".itemAcceso1").hide();
			$(".itemAcceso1A").hide();
				$(".itemAcceso2").hide();
				$(".itemAcceso3").hide();
				$(".itemAcceso4").toggle();
		});

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
	var parametros = 
			{
				"ianio" : ianioVer
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
		<div class="icono6"><span class="" title=""></span></div>
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

 </div> <!-- lisgta accesos -->


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