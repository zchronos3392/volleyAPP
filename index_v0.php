<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">    
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP</title>
        <meta name="index" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
<style>



@media (max-width: 450px)
{
.unPartido NAV 
{

	border: 1px solid #000000;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    BACKGROUND-COLOR: #fff; 
    color: #030627;
	width: auto;
}

.unPartido NAV UL
{
	display: flex;
    flex-flow: row nowrap;
    justify-content: flex-start;
    align-items: strecht;
    list-style-type: none;
    padding-inline-start: 0px;
}


.unPartido NAV LI .activarAcciones
{
	background-color: #1abde6;
    color: #fff;
	padding: 1em;
   border: 1px solid #000000;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);

}

.ubicacionLI
{
	width: 100%;

}
	 
/*esto podria ser una lista o algo asi...ver NoticiasMAG */
.partidoAcciones{
	display: grid;
	grid-template-areas: 'acc1 acc2 acc3 acc4 acc5';
	/* LE DAMOS FORMA DE BOTON */
		background-color: #1abde6;
		/* padding: 1em; */
		margin: 0 0em 0 0;
		border: 1px solid #000000;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border-radius: 7px;
		-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    /* LE DAMOS FORMA DE BOTON */

}

.accionesOcultar{
	/* display: none; */
	width: 20%;
    margin-left: 50%;
    margin-top: 5.2em;

	
	z-index: 10;
		-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	top:7%;	
	position: absolute;
    }


.partidoUbicacion{
	display: grid;
	grid-template-areas: 'ubi1 ubi2 ubi3';
	border: 0px solid #000000;
	height: 3em;
	margin:0.5rem;
	width: 100%;
}

}

@media (min-width:451px) and (max-width: 768px)
{

}

.ListaPartidos{
	display: grid;
	/* <!-- descubri que no necesitan tener un nombre para que se aplique , si la cantidad de elementos
	que dependen de la cabecera del grid, coincide con la cantidad de areas programadas aca,
	solo se acomodan sin tener que nombrarlas
	al nombrarlas, podemos personalizarlas  --> */
	grid-template-areas: 'area1'; 
	/* solo ListaPartidoItem */

	/* configuracion de la grid */
    position: relative;
    /* width: 80%; */
    /* margin-left: 5%; */
    /* margin-right: 5%; */
    /* text-align: center; */
    background: #fff;
    grid-gap: 1px;
    /* border: 1px solid #000000; */
    padding: 5px;	
	margin-top:1em;

}

.ListaPartidoItem1{
    border: 1px solid #000000;
	/* width: 90%;*/
	margin-left:5%;
	margin-right:2%;
	margin-top:2%; 
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;
	padding: 1rem;
}

.unPartido{
	display: grid;
	grid-template-areas: 'UBICACION' 'EQUIPOS';
	/* configuracion de la grid */
    background:peachpuff ;
    border: 1px solid #000000;
	margin-left:5%;
	margin-right:2%;
	margin-top:2%;

	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;

}

.unPartido NAV 
{

	border: 1px solid #000000;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    BACKGROUND-COLOR: #fff; 
    color: #030627;
	width: 100%;
}

.unPartido NAV UL
{
	display: flex;
    flex-flow: row nowrap;
    justify-content: flex-start;
    align-items: strecht;
    list-style-type: none;
    padding-inline-start: 0px;
}


.unPartido NAV LI .activarAcciones
{
	background-color: #1abde6;
    color: #fff;
	padding: 1em;
    margin: 0 1em 0 0;
    border: 1px solid #000000;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
}

.ubicacionLI
{
	width: 100%;

}
	 
/*esto podria ser una lista o algo asi...ver NoticiasMAG */
.partidoAcciones{
	display: grid;
	grid-template-areas: 'acc1 acc2 acc3 acc4 acc5';
	/* LE DAMOS FORMA DE BOTON */
		background-color: #1abde6;
		/* padding: 1em; */
		margin: 0 0em 0 0;
		border: 1px solid #000000;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border-radius: 7px;
		-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
    /* LE DAMOS FORMA DE BOTON */

}

.accionesOcultar{
	/* display: none; */
	width: 20%;
    margin-left: 50%;
    margin-top: 5.2em;
	z-index: 10;
		-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	top:6%;	
	position: absolute;
    }

.partidoUbicacion{
	display: grid;
	grid-template-areas: 'ubi1 ubi2 ubi3';
	border: 0px solid #000000;
	height: 3em;
	margin:0.5rem;
	width: 100%;

}

/* .menu_AccionesPartido{
	
} */

.partidoEquipos{
	display: grid;
	grid-template-areas: 'area1' 'area2' 'area3' 'area4';
    border: 0px solid #000000;
	margin:0.5em;

}
.Local,.Visitante{
	display:grid;
	grid-template-areas: 'Eq1 Eq2 Eq3';
    border: 1px solid #000000;
	width: 90%;
	margin-left:10%;
	height: 4em;

}
</Style>

<!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!--<script type="text/javascript" src="./scripts/nsanz_script.js"></script>-->
		<!-- <script type="text/javascript" src="./jqs/ietats.js"> -->
		</script>		
		<script type="text/javascript">


function limpiarFiltros(fechapartido,fechapartido2)
{
	$("#icomp").val('9999');
	$("#icate").val('');
	$("#icity2").val('9999');
	$("#iclub").val('');
	$("#ietats").val(0);
	$("#fecDde").val(fechapartido);
	$("#fecHta").val(fechapartido2);						
}


function getFiltros(){

		var parametros = {
			  "TEXTOCLAVE" : "FILTROSINDEX",
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
	                //"icomp":"9999","icate":"","iclub":"","ietats":"0",
	                //"icity2":"9999",
	                //"fecDde":"2022-12-01","fecHta":"2022-12-31"}}
						//alert('icomp en LEE SESION');
						$("#icomp").val(v.icomp);
						$("#icate").val(v.icate);
						$("#iclub").val(v.iclub);
									
						$("#ietats").val(v.ietats);
						
						//console.log(v.icity2);
						
						$("#icity2").val(v.icity2);

						$("#fecDde").val(v.fecDde);
							//alert(v.fecDde);
						$("#fecHta").val(v.fecHta);
							//alert(v.fecHta);
					});	
		   },
		    error: function (xhr, ajaxOptions, thrownError) {console.log(thrownError);}
	  });// falta el seleccion de la cancha, para cargar los campos..		  
	
}
	
	function guardarFiltros(){

			var parametrosFiltros = new Array();

			parametrosFiltros.push( {"icomp":$("#icomp").val()});
			parametrosFiltros.push( {"icate":$("#icate").val()});
			parametrosFiltros.push( {"iclub":$("#iclub").val()});
			
			parametrosFiltros.push( {"ietats":$("#ietats").val()});

			parametrosFiltros.push( {"icity2":$("#icity2").val()});

			parametrosFiltros.push( {"fecDde":$("#fecDde").val()});
			parametrosFiltros.push( {"fecHta":$("#fecHta").val()});

			parametrosFiltros.push( {"ClubGenerico":$("#buscarequipo").val()});


			  var parametros = {
				  "TEXTOCLAVE" : "FILTROSINDEX",
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
				  		  	
		  });// falta el seleccion de la cancha, para cargar los campos..		  
	}
	
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

		//ACCIONES DE GRILLA
		function botonAcciones(idPanelAcciones)
		{

			$("#"+idPanelAcciones).toggle();
		}
		
		function filtrar(){
			//aca grabo la sesion.
			//alert( $("#icomp").val()  );
			fechadesdeorden=0;
			if ($("#fecDdeAscDsc").is(":checked")) {
				// it is checked
				fechadesdeorden = 1;
			};
	
			if ($("#fecDdeAscDsc2").is(":checked")) {
				// it is checked
				fechadesdeorden = 1;
			};
						
						
			var parametros = 
			{
	        	"icomp" : $("#icomp").val(),
	        	"icate" : $("#icate").val(),
				"icity" : $("#icity").val(),
				"icity2" : $("#icity2").val(),
				"iclub" : $("#iclub").val(),
				"buscarClubNombre":$("#buscarequipo").val(),
				"fdesde" : $("#fecDde").val(),
				"fdesdeOrden" : fechadesdeorden,
				"fhasta" : $("#fecHta").val(),
				"estado" : $("#ietats").val()
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
		    		},
		            done: function(data){
						
					},
		            success:  function (r){
					$("#grid-ListaPart21").empty();

		                $(r['Partidos']).each(function(i, v)
		                { // indice, valor				
						
		                if (! $('#grid-ListaPart21').find("[name='PARTIDO"+v.Fecha+v.idPartido+"']").length)
						{
			                var alta='<a href="VerCSets.php?id='+v.idPartido+'&setmax='+v.setsnmax+'&fecha='+v.Fecha+'&llama=index';
					  			alta+='"><input type="button" id="nuevoset" name="nuevoset" class="btnVerSet_21 Naranja " value="(0/)" title="Revisar valores del Set"></input></a>';
							
							if(v.descripcion.includes('SUSPENDIDO')) var img = './img/PartidoSSPND.png';
			                if(v.descripcion.includes('PROGR')) var img = './img/PartidoONOFFSQR.png';
			                if(v.descripcion.includes('LLUVI')) var img = './img/rain-icon-png.jpg';
			                if(v.descripcion.includes('FIN'))   var img = './img/PartidoOFFSQR.jpg';		
			                if(v.descripcion.includes('CURSO')) var img = './img/PartidoONSQR.png';
			                	
			                if(! v.descripcion.includes('FIN'))  alta=''; 


			               
			                var divClubA='<div class="ilp211" >'+
			                				'<div class="ilp211Y" >'+
											'<div class="ylp211A" >'+
												    v.Inicio+
				                				'</div>'+
				                				'<div class="ylp211B" >'+
				                					v.ClubA+
				                				'</div>'+
				                				'<div class="ylp211C" id="ilp211B_'+v.Fecha+v.idPartido+'">'+
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
			               var Ver = '<a href="TableroGrandev25.php?id='+v.idPartido+'&fecha='+v.Fecha+'">';
								Ver +=  '<input type="button" id="verset" name="verset" class="btnVerSet_21" value="(ver)" title="Re-veer set"></input>';
								 Ver +=  '</a>';

	$("#grid-ListaPart21").append('<section class="grid-ListaPart21" id="grid-ListaPart21">'+
									'<section class="agrid-LPReg21" id="grid-LPReg21">'+
				  						divClubA+
									  '<div class="ilp212">'+v.ClubARes+'</div>'+
									    divClubB+
									  '<div class="ilp214">'+v.ClubBRes+'</div>'+
									  '<div class="imgdiv ilp215">'+
									  		'<img id="imgEstadoIndex_21" src="'+img+'" class="imgEstadoIndex_21" title="'+v.descripcion+'" alt="'+v.descripcion+'"></img>'+
									 '</div>'+
					 			  	 '<div class="ilp2116">'+
								  		'<input type="hidden" name="PARTIDO'+v.Fecha+v.idPartido+'" />'+
								  			alta+
										 '<input type="hidden" id="fechaxpartido" value="'+v.Fecha+'" />'+
										 '<input type="hidden" id="idxpartido" value="'+v.idPartido+'" />'+
								 	 '</div>'+
									  '<div class="ilp217">Competencia: '+v.cnombre+'</div>'+
									  '<div class="ilp218">'+v.CatDesc+'</div>'+
									  '<div class="ilp219">'+v.Fecha+'</div>'+
									  '<div class="ilp2110">'+Ver+'</div>'+
								   '</section>'+
							   '</section>');
							obtenerEscudo(v.idcluba,'#ilp211B_'+v.Fecha+v.idPartido);
							obtenerEscudo(v.idclubb,'#ilp213B_'+v.Fecha+v.idPartido);
						};
					  });
		            },
 		            
		             error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					}
		            }); // FIN funcion ajax CLUBES
		}; 

		$(document).ready(function(){

		$("#AccionesPartidoDIV_76").hide();	
         //$("#icomp").empty();
         $("#icate").empty();
         $("#iclub").empty();
         $("#ietats").empty();
         //$("#icity2").empty();

        var iclubes = $("#iclub");
        var icity   = $("#icity2");
        var icate   = $("#icate");
        var icomp   = $("#icomp");
        // esto arreglo el tema del alta triplle..
        //	data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
        //	el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
         //sin embargo la direccion final queda: http://localhost/volleyAPP/equipos.php?abms/obtener_clubes.php
         // y eso esta mal !!

         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
            async:false,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclub").prop('disabled', true);
    			//$("#icity").prop('disabled', true);
    		},
            done: function(data){
            	console.log('DONE: ');
				console.log(data);	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
                		//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#iclub').find("option[value='" + v.idclub + "']").length)
                	{						
    					$("#iclub").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					}		
                });
                $("#iclub").prop('disabled', false);
                //$("#icity").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iclub").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#iclub").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
				$("#iclub").prop('disabled', false);
			}
            }); // FIN funcion ajax CLUBES
            
//----------------------------
//OBTIENE CIUDADES 2
//----------------------------
         $.ajax({
				url:   './abms/obtener_ciudades.php',
				type:  'GET',
				dataType: 'json',
				async:false,
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX
				beforeSend: function () {
					// Bloqueamos el SELECT de los cursos
					$("#icity2").prop('disabled', true);

				},
				done: function(data) {
					console.log('DONE: ');
					console.log(data);
				},
				success:  function (r) {
					// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
					// DESBloqueamos el SELECT de los cursos
					// Limpiamos el select
					// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"]
					$(r['Ciudades']).each(function(i, v) { // indice, valor

						if (! $('#icity2').find("option[value='" + v.idCiudad + "']").length) {
							$("#icity2").append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
						}
					});
					$("#icity2").prop('disabled', false);

				},
				error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					$("#icity2").append('<option value="' + '9999' + '">' + 'JQERY:Tabla Ciudades vacia' + '</option>');
					$("#icity2").val('9999');
					console.log(xhr.responseText);
					console.log(thrownError);
					$("#icity2").prop('disabled', false);
				}
			}); // FIN funcion ajax para CIUDADES 2 PARA RESPONSIVO
//----------------------------
//OBTIENE CIUDADES 2
//----------------------------

//************************ CATEGORIAS *************************************************         
         $.ajax({ 
            url:   './abms/obtener_categorias.php',
            type:  'GET',
            dataType: 'json',
            async:false,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclub").prop('disabled', true);
    			$("#icity2").prop('disabled', true);
    			$("#icate").prop('disabled', true);
    		},
            done: function(data){
					console.log(data);	
			},
            success:  function (r){
            	$(r['Categorias']).each(function(i, v)
                { // indice, valor
                	if (! $('#icate').find("option[value='" + v.idcategoria + "']").length)
                	{
                		if(v.categoriaActiva==1)
							$("#icate").append('<option value="' + v.idcategoria + '">(A) ' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
						else
							$("#icate").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
					}		
                });
                $("#iclub").prop('disabled', false);
                $("#icate").prop('disabled', false);
                $("#icity2").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icate").append('<option value="' + '9999' + '">' + 'JQERY:Tabla CATEGORIAS vacia' + '</option>');
			$("#icate").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#icate").prop('disabled', false);
			}
            }); // FIN funcion ajax categorias
            
//**************** COMPETENCIAS *********************************************/            
         $.ajax({ 
            url:   './abms/obtener_comps.php',
            type:  'GET',
            dataType: 'json',
			async:false,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de las COMPETENCIAS 
				$("#icomp").prop('disabled', true);
    		},
            done: function(data){
            	console.log('DONE: ');
				console.log(data);	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Competencias']).each(function(i, v)
                { // indice, valor
						//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#icomp').find("option[value='" + v.idcomp + "']").length)
                	{
						$("#icomp").append('<option value="' + v.idcomp + '">' + v.cnombre + '</option>');
					}		
                });
                $("#icomp").prop('disabled', false);
           },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icomp").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#icomp").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
				$("#iclub").prop('disabled', false);
			}
            }); // FIN funcion ajax COMPETENCIAS

//------------------------------
// ESTADOS DEL PARTIDO
//------------------------------
        // esto arreglo el tema del alta triplle..
         $.ajax({ 
            url:   './abms/obtener_estados.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#ietats").prop('disabled', true);
       		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los ESTADOS
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Estados']).each(function(i, v)
                { // indice, valor
                		//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#ietats').find("option[value='" + v.idestado + "']").length)
                	{
						$("#ietats").append('<option value="' + v.idestado + '" label="'+v.descripcion+'">' + v.descripcion + '</option>');
					}		
                });
                $("#ietats").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#ietats").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#ietats").val('9999');
			$("#ietats").prop('disabled', false);
			}
            }); // FIN funcion ajax ESTADOS
//**************** CLUBES *********************************************/   

//------------------------------------------------------------------------
// CARGA DESDE EL READY DE LOS COMBOS....
//------------------------------------------------------------------------


//FILTROS.
				$("#icomp").on("change click",function() {
					guardarFiltros();
					filtrar();
				});

				$("#ietats").append('<option value="0" label="Estados..">Estados..</option>');
				$("#ietats").val(0);
				$("#ietats").on("change click",function() {
					guardarFiltros();
					filtrar();});

				$("#fecDdeAscDsc").on("change click",function() {
					guardarFiltros();
					filtrar();});

				$("#fecDdeAscDsc2").on("change click",function() {
					guardarFiltros();
					filtrar();});				

				$("#icate").on("change click",function() {
					guardarFiltros();
					filtrar();});
				$("#icate").append('<option value="' + '' + '">' + 'Categorias...' + '</option>');
				$("#icate").val('');

				$("#iclub").on("change click",function() {
					guardarFiltros();
					filtrar();});

				$("#buscarequipo").keyup(function() {
					guardarFiltros();
					filtrar();});


				$("#iclub").append('<option value="' + '' + '">' + 'Clubes...' + '</option>');
				$("#iclub").val('');



				$("#fecDde").on("change",function() {
					guardarFiltros();
					filtrar();});
				
						 var f=new Date();
						 var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
						 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
						 				,"27","28","29","30","31");
						 var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
						 var fechapartido = (f.getFullYear()) + "-" + meses[f.getMonth()] + "-" +dias[(0)] ;
				$("#fecDde").val(fechapartido);

				$("#fecHta").on("change",function() {
					guardarFiltros();
					filtrar();});

						 var f2=new Date();
						 var dias2 = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
						 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
						 				,"27","28","29","30","31");
						 var meses2 = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
						 var fechapartido2 = f.getFullYear() + "-" + meses2[11] + "-" +dias2[(30)] ;
				$("#fecHta").val(fechapartido2);
				

				$("#icity2").append('<option value="' + '' + '">' + 'Ciudades...' + '</option>');
				$("#icity2").val('');
				
				$("#icity2").on("change click",function() {
					guardarFiltros();
					filtrar();});
				
				$("#limpiarfiltro").on("click",function() {
					limpiarFiltros(fechapartido,fechapartido2);
					guardarFiltros();
					filtrar();});

				getFiltros();
				filtrar();		
				
		//FILTROS.	
		}); // end of DOCUMENT.READY 	
		</script>
    </head>
    <body>
<!--<header>-->
<?php include('includes/newmenu.php'); ?>
<!-- </header> -->
<!--normal: 1070,<768:3288  -->
		<div id="formbuscar" name="formbuscar" class="formbuscar"><!--normal 1077,<768:3295 -->
				<div class="itemBusc1">Competencias</div> 
				<div class="itemBusc2"><select id="icomp"><option value="9999">Competencias...</option></select></div> 
				<div class="itemBusc3">Categorias</div> 					
				<div class="itemBusc4"><select id="icate"><option value="9999">Categorias...</option></select></div> 
				<div class="itemBusc5">Local</div> 
				<div class="itemBusc6">
					<input type="text" id="buscarequipo" value="" placeholder="Nombre o porción del nombre de un club"/>
					<!-- <select id="iclub" class="iclubes"><option value="0">Clubes...</option></select> -->
				</div> 
			    <div class="itemBusc7">
			    	<div id="frmbuscardate" name="frmbuscardate" class="frmbuscardate"><!--normal 1088,<768:3306 -->
						<div class="itemBusDate1">Desde</div> 
						<div class="itemBusDate2"><input type="date" id="fecDde" class="fecha"/></div>
						<div class="itemBusDate3">Hasta</div> 
						<div class="itemBusDate4"><input type="date" id="fecHta" class="fecha"/></div>
						<div class="itemBusDate5"><input type="checkbox" id="fecDdeAscDsc2" class="fecDdeAscDsc2" /></div>
					</div>  
			    </div> 
			<div class="itemBusc8">
				<div id="frmbuscarotros" name="frmbuscarotros" class="frmbuscarotros"><!--normal 1088,<768:3306 -->
				Orden								
					<input type="checkbox" id="fecDdeAscDsc" class="fecDdeAscDsc" />
				Ciudades					
					<select id="icity"><option value="9999">Ciudades...</option></select>
			    </div>  
			</div>     
			<div class="itemBusc9">Estado</div> 
			<div class="itemBusc10"><select id="ietats" class="SelList"><option value="9999" selected>Estados..</option></select></div> 
			<div class="itemBusc11">Ciudades</div> 					
			<div class="itemBusc12"><select id="icity2" class="icity2"><option value="9999">Ciudades...</option></select></div>
			<div class="itemBusc13">Limpiar filtros</div>
			<div class="itemBusc14"></div>		
			<div class="itemBusc15"></div>		
			<div class="itemBusc16">
				<input type="button" id="limpiarfiltro" name="limpiarfiltro" class="btnBuscar2" value="Clean" title="Limpia filtros"></input>
				
			</div>								
	 </div> 

  <div class="ListaPartidos">
	<div class="ListaPartidoItem1">FECHA : 02-09-2026
		<div class="unPartido">	
			<nav>
				<ul>
				<li class="ubicacionLI">
					<section class="partidoUbicacion">	
						<div class="partidoub1">15:30</div>
						<div class="partidoub2">CANCHA DIRECCION GIMANSIO </div>
						<section class="accionesOcultar" id="AccionesPartidoDIV_76">
								<div class="partidoacc1">
										<input type="button" id="verset" name="verset" class="btnVerSet_21" value="(ver)" title="Re-veer set"></input>
								</div>
								<div class="partidoacc2">
										<input type="button" id="nuevoset" name="nuevoset" class="btnVerSet_21 Naranja " value="(0/)" title="Revisar valores del Set"></input>
								</div>
						</section>
					</section>
				</li>	
				<li  class="botonAxLI">
					<div class="menu_AccionesPartido" id="AbrirPartidoDIV_76" onclick="botonAcciones('AccionesPartidoDIV_76'); ">
						<a class="activarAcciones">
							<span class="icon-cog"></span>
						</a>
					</div>
				</li>
				</ul>
			</nav>
			<section class="partidoEquipos">	
				<div class="partidoE1">Competencia: Rueda Campeonato::Inferiores - Nivel B::Caballeros</div>
				<div class="partidoE2">SUB18[CAB]</div>
				<section class="Local">
					<div class="partidoE3">
						<img src="img/escudos/EIMM VOLLEY.png" class="imgjugadorindex" />
					</div>
					<div class="partidoE4">3</div>
					<div class="partidoE5">HACOAJ</div>		
				</section>
				<section class="Visitante">
					<div class="partidoE6">
						<img src="img/escudos/EIMM VOLLEY.png" class="imgjugadorindex" />
					</div>
					<div class="partidoE7">0</div>
					<div class="partidoE8">HACOAJ</div>
				</section>
				</section>
		</div> <!-- un partido -->
   </div> <!-- Fecha 1 de es Competencia -->

</div> <!-- ListaPartidos    -->
	 
<!--<section id="medio">-->    
  <section class="grid-ListaPartTit21" id="grid-ListaPartTit">
  <!-- ENCABEZADOS DE LA GRIILLA-->
  <!-- <div id="grid-LPReg" class="grid-Titulos21">
	  <div class="itt1">Club Local</div>
	  <div class="itt2">Pto Loc.</div>
	  <div class="itt3">Club Vis.</div>
	  <div class="itt4">Pto Vis.</div>
	  <div class="itt5">Comp</div>
	  <div class="itt6">Cat</div>
	  <div class="itt7">Fecha</div>
	  <div class="itt8">Hr Ini</div>
	  <div class="itt9">Estado</div>
	  <div class="itt10"></div>
  </div> -->
 
<!-- CONTENIDO DE LA GRILLA-->
		  <section class="grid-ListaPart21" id="grid-ListaPart21">
				<section class="agrid-LPReg21" id="grid-LPReg21">
				  <div class="ilp211" >HACOAJ</div>
				  <div class="ilp212">3</div>
				  <div class="ilp213">fERRO</div>
				  <div class="ilp214">2</div>
				  <div class="imgdiv ilp215">
				  		<img id="imgEstadoIndex_21" src="./img/PartidoONSQR.png" class="imgEstadoIndex_21" title="aCTIVO" alt="ACTIVO"></img>
				 </div>
 			  	 <div class="ilp216">
			  		<input type="hidden" name="PARTIDO2019-11-0803" />
			  		  <!--<a href="TableroGrande.php?id=3&fecha=2019-11-08">-->
			   		  <a href="TableroGrandev25.php?id=3&fecha=2019-11-08">
			   				<input type="button" id="verset" name="verset" class="btnVerSet_21" value="(ver)" title="Re-veer set"></input>
			   		  </a>
					 <input type="hidden" id="fechaxpartido" value="2019-11-08" />
					 <input type="hidden" id="idxpartido" value="3" />
			 	 </div>		
				  <div class="ilp217">Competencia: SuperFecha #Sub15 #2019</div>
				  <div class="ilp218">SUB15.[CAB]</div>
				  <div class="ilp219">2019-11-08</div>
				  <div class="ilp2110">01:14</div>
			   </section>
		   <!-- -->
		   </section> 
</section> 
<!--</section>-->

</body>
</html>

