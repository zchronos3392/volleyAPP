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
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	   <!--SCRIPTS-->
	   <script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO
		
function  buscarImagenClub(){
 var parametros = {"idClub" : $("#iclubescab").val()};	
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
        	  $("#imagenclub").attr("src","img/escudos/"+re['escudo']);
        	
    },
     error: function (xhr, ajaxOptions, thrownError) 
     {
	 }
    });
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

function creascategorias(idjugador,categoria){
        // esto arreglo el tema del alta triplle..
      var selectPuesto = "";
		     
         $.ajax({ 
            url:   './abms/obtener_categorias.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
                $(r['Categorias']).each(function(i, v)
                { // indice, valor
                	//alert(v.descripcion);
                	if(categoria != 0 && v.idcategoria == categoria)
	                	$("#sdesccat_"+idjugador).append('<option value="' + v.idcategoria + '" selected>' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
                	else
					$("#sdesccat_"+idjugador).append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
				});		
             },
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax CLUBES	
return 	selectPuesto ;
}


function creaspuestos(idjugador,puesto){
	var selectPuesto = "";
        // esto arreglo el tema del alta triplle..
         $.ajax({ 
            url:   './abms/obtener_puestos.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
                $(r['Posiciones']).each(function(i, v)
                { // indice, valor
                	//alert(v.codigo);
                	if(puesto != 0 && v.idPosicion == puesto )
                		$("#sjugadorp_"+idjugador).append('<option value="' + v.idPosicion + '" label="'+v.nombre+'" selected>' +v.nombre +'</option>');
                	else
						$("#sjugadorp_"+idjugador).append('<option value="' + v.idPosicion + '" label="'+v.nombre+'">' +v.nombre +'</option>');

					//alert(selectPuesto);
				});		
             },
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax PUESTOS
	

return 	selectPuesto ;
}

function eliminar(idpuesto,jugadorId,club,ianio){

		$("#jugadorABM").submit(function(e){e.preventDefault();});	
		 var parametros = {"ianio":ianio,"club":club,"puesto":idpuesto,"jugadorid":jugadorId};
         $.ajax({ 
            url:   './abms/delete_puesto_catjugador.php',
            type:  'GET',
            dataType: 'json',
            data:parametros,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
					alert(r['mensaje']);
					location.reload();
             },
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax CLUBES			

}


		$(document).ready(function(){
				//$("#ultimoRegPuestos").val(0);			
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
// SELECCION DE CLUBES


		//		data: parametros,
// TRAER IMAGEN DEL CLUB
         $("#iclubescab").on("change click",function()
         {
         	buscarImagenClub();

          });//change del ICLUB		
// TRAER IMAGEN DEL CLUB
		
		
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
			
			
// SELECCION DE CLUBES
//**SELECCION DE CATEGORIAS    *************************************************              
         $.ajax({ 
            url:   './abms/obtener_categorias.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icatcab").prop('disabled', true);
    			$("#icatcabini").prop('disabled', true);
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
                	if (! $('#icatcabini').find("option[value='" + v.idcategoria + "']").length)
                	{
						$("#icatcabini").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
					}							
					
                });
                $("#icatcab").prop('disabled', false);
                $("#icatcabini").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icatcab").append('<option value="' + '9999' + '">' + 'JQERY:Tabla CATEGORIAS vacia' + '</option>');
			$("#icatcab").val('9999');
			$("#icatcabini").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#icatcab").prop('disabled', false);
				$("#icatcabini").prop('disabled', false);
			}
            }); // FIN funcion ajax categorias
//************************ CATEGORIAS *************************************************              			

// ACTUALIZAR EL REGISTRO **********************************************/
			// insert en la tabla
	       $("#Actualizar").on("click",function(e){
	    	//QUE SE RECARGUE CUANDO PRESIONO CLICK..
	    	var parametros =  $("#jugadorABM").serialize();
	  			/*EL SERIALIZE RESUMEN TODO LO QUE SIGUE
	  			var parametros =  {
	  					"iclubescab" : $("#iclubescab").val(),
						"icatcab" : $("#icatcab").val(),        	
						"numero" : $("#numero").serialize(),
						"nombre" : $("#nombre").serialize(),
						"edad" : $("#edad").serialize(),
						"altagen" :	$("#altagen").val(),
						"gencuantos" :	$("#gencuantos").val()
		         }
		         */
		    	e.preventDefault();
		         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		            url:   './abms/modificar_jugadorabm.php',
		            type:  'POST',
		            data: parametros,
		            beforeSend: function (){
						//console.log(parametros);
		            },
		            success:  function (r){
							console.log(r);
							//window.location.reload();
							iclubescab = parametroURL('iclubescab');
							icatcab    = parametroURL('icatcab');
							location.href='Cjugadores.php?icatcab='+icatcab+'&iclubescab='+iclubescab;
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
				}); // parentesis el .CLICK ALTAP


// INSERT EN LA TABLA **********************************************
	       $("#AltaJugador").on("click",function(e){
	    	//QUE SE RECARGUE CUANDO PRESIONO CLICK..
	    	var parametros =  $("#jugadorABM").serialize();
	  			/*EL SERIALIZE RESUMEN TODO LO QUE SIGUE
	  			var parametros =  {
	  					"iclubescab" : $("#iclubescab").val(),
						"icatcab" : $("#icatcab").val(),        	
						"numero" : $("#numero").serialize(),
						"nombre" : $("#nombre").serialize(),
						"edad" : $("#edad").serialize(),
						"altagen" :	$("#altagen").val(),
						"gencuantos" :	$("#gencuantos").val()
		         }
		         */
		    	e.preventDefault();
		         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		            url:   './abms/insertar_jugadorabm.php',
		            type:  'POST',
		            data: parametros,
		            beforeSend: function (){
						//console.log(parametros);
		            },
		            success:  function (r){
							//console.log(r);
							alert('Alta concedida....');
							//iclubescab = parametroURL('iclubescab');
							//icatcab    = parametroURL('icatcab');
							location.href='Cjugadores.php?icatcab='+icatcab+'&iclubescab='+iclubescab;
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
				}); // parentesis el .CLICK ALTAP


			$("#Volver").on("click",function(e){
					e.preventDefault();
					iclubescab = parametroURL('iclubescab');
					icatcab    = parametroURL('icatcab');
					$(location).attr('href','Cjugadores.php?icatcab='+icatcab+'&iclubescab='+iclubescab);
				}); // fin evento AGREGAREG ON CLICK		


		/*********************************+obtener jugador***************************/				
		var modo = parametroURL('MODO');
		var jugadorId = parametroURL('unjugador');
		var anio = parametroURL('ianio');
		
		var clubjugador = parametroURL('iclubescab');
		var categoriajugador = parametroURL('icatcab');
		//alert(modo);
		//alert(jugadorId);
		$("#ianio").val(anio);
		if(modo == 'INS') {
				$("#Actualizar").prop('disabled', true);	
				$("#Actualizar").css("background-color","#8c94a6");

		};
		
		if(modo == 'UPD'){

			$("#AltaJugador").prop('disabled', true);	
			$("#AltaJugador").css("background-color","#8c94a6");


			var parametros = {"ianio":anio,"jugadorUn": jugadorId,"modo": modo,"iclubescab1" :clubjugador ,"icatcab1":categoriajugador};
					 $.ajax({ 
						url:   './abms/obtener_jugadores.php',
						type:  'GET',
						data: parametros,
						dataType: 'text json',
						// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
						beforeSend: function (){
							
						},
						done: function(data){
								
						},
						success:  function (r){
							$(r['Jugadores']).each(function(i, v)
							{ // indice,0 valor
								$("#nombreJugador").val(v.nombre);
									$("#idjugador").val(jugadorId);
								
								$("#icatcab").val(v.categoria);
								$("#icatcabini").val(v.categoriaInicio);
								//Fecha de Ingreso a la categoria..								
		 						var fechaBase = v.ingresoClub.split("-");
		 						var mes = 0;
		 						var dia = 0;
		 						var anio =0;
		 						$.each(fechaBase, function (ind, elem) { 
  										if(ind == 0) anio = elem;
  										if(ind == 1) mes = elem;
  										if(ind == 2) dia = elem;
  										//alert('¡Hola : indice: '+ind+' valor '+elem+'!'); 
								});
								 var now=new Date(anio,mes,dia,0,0,0,0);

									var day = ("0" + now.getDate()).slice(-2);
									var month = ("0" + (now.getMonth() + 1)).slice(-2);

									var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
								$("#inicioEnclub").val(today);
								$("#inicioEnclub").attr("readonly",true);
								$("#inicioEnclub").css("color","#061331");
								//Fecha de Ingreso a la categoria..
								
								//Fecha de EGRESO a la categoria..								
								//podria venir NULL....
								if(v.FechaEgreso != null){
		 						var fechaBaseE = v.FechaEgreso.split("-");
		 						var mes = 0;
		 						var dia = 0;
		 						var anio =0;
		 						$.each(fechaBaseE, function (ind, elem) { 
  										if(ind == 0) anio = elem;
  										if(ind == 1) mes = elem;
  										if(ind == 2) dia = elem;
  										//alert('¡Hola : indice: '+ind+' valor '+elem+'!'); 
								});
								 var now=new Date(anio,mes,dia,0,0,0,0);

									var day = ("0" + now.getDate()).slice(-2);
									var month = ("0" + (now.getMonth() + 1)).slice(-2);

									var EgresoEs = now.getFullYear()+"-"+(month)+"-"+(day) ;
								$("#egresoEnclub").val(EgresoEs);
								//$("#egresoEnclub").attr("readonly",true);
								$("#egresoEnclub").css("color","#f89807");
								//Fecha de EGRESO a la categoria..
								}
								
								$("#NumeroEnClub").val(v.numero);
								$("#iclubescab").val(v.idclub);
								$("#edadJugador").val(v.edad);
								buscarImagenClub();
							});	
						},
			             error: function (xhr, ajaxOptions, thrownError) {}
            			}); // FIN funcion ajax jugador
		} // FIN MODO UPD
			var clubJugador = parametroURL('iclubescab'); 
			var aniojugador = parametroURL('ianio');
				jugadorId   = parametroURL('unjugador');			
			var parametros = {"idjugador": jugadorId,"ianio":aniojugador,"iclubescab":clubJugador};
					 $.ajax({ 
						url:   './abms/obtener_puestojug.php',
						type:  'GET',
						data: parametros,
						dataType: 'text json',
						// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
						beforeSend: function (){
								$("#dnijug4").empty();
								$("#dnijug4").append("");					
						},
						done: function(data){
				
						},
						success:  function (r){
							$(r['PuestosJug']).each(function(i, v)
							{ // indice,0 valor

										
							var claves = "<input type='hidden' id='idjugador' name='idjugador' />"
							var eliminaPuesto="<button id='Elimidjugador' name='Elimidjugador'  onclick=eliminar("+v.idpuestoJug+","+jugadorId+","+clubJugador+","+aniojugador+"); class='botonrenglon'>Eliminar</button>";
							var modificarPuesto="<button id='Modificajugador' name='Modificajugador'  onclick=modificar("+v.idpuestoJug+","+jugadorId+","+clubJugador+","+aniojugador+"); class='botonrenglon'>Modificar</button>";
										
							$("#dnijug4").append("<div class='gridPuestos'>"+
													"<div class='puestos1'>"+eliminaPuesto+"</div>"+
													"<div class='puestos2'>"+modificarPuesto+"</div>"+
													"<div class='puestos3'>Nombre</div>"+
													"<div class='puestos4'>"+v.nombreJug+"</div>"+
													"<div class='puestos5'>Categoria</div>"+
													"<div class='puestos6'><select id='sdesccat_"+v.idpuestoJug+"' name='sdesccat_"+v.idpuestoJug+"'></select>"+creascategorias(v.idpuestoJug,v.pjcategoria)+"</div>"+
													"<div class='puestos7'>Remera Nro</div>"+
													"<div class='puestos8'><input type='number' name='remenum_"+v.idpuestoJug+"' id='remenum_"+v.idpuestoJug+"' value='"+v.remeraNum+"' ></input></div>"+
													"<div class='puestos9'>Puesto</div>"+
													"<div class='puestos10'><select id='sjugadorp_"+v.idpuestoJug+"' name='sjugadorp_"+v.idpuestoJug+"'></select>"+creaspuestos(v.idpuestoJug,v.puestoxcat)+"</div>"+
													"<div class='puestos11'>Fch Ini Puesto</div>"+
													"<div class='puestos12'><input type='date' name='fechalta_"+v.idpuestoJug+"' id='fechalta_"+v.idpuestoJug+"' value='"+v.FechaPuestoAlta+"'></input></div>"+											
												"</<div>");								
//SELECT a.idpuestoJug,a.FechaPuestoAlta,a.remeraNum,b.descripcion,c.nombre,d.nombre
//FROM vapppuestojugador a,vappcategoria b,vappposicion c,vappequipo d  			
							var valorNumero = Number(v.idpuestoJug);
							//valorNumero +=1;
							$("#ultimoRegPuestos").val(valorNumero);

							});	
						},
			             error: function (xhr, ajaxOptions, thrownError) {}
            			}); // FIN funcion ajax jugador

			$("#agregaReg").on("click",function(e){
				e.preventDefault();
				
				var jugadorId = Number($("#ultimoRegPuestos").val());
				jugadorId += 1;
				//alert(jugadorId);
				$("#ultimoRegPuestos").val(jugadorId);
				var ahora=new Date();
				var day = ("0" + ahora.getDate()).slice(-2);
				var month = ("0" + (ahora.getMonth() + 1)).slice(-2);

				var hoy = ahora.getFullYear()+"-"+(month)+"-"+(day) ;

				$("#dnijug4").append("<div class='gridPuestos'>"+
										"<div class='puestos1'><button id='accion1_"+jugadorId+"' name='accion1_"+jugadorId+"' class='botonrenglon'>+</button></div>"+
										"<div class='puestos2'><button id='accion1_"+jugadorId+"' name='accion2_"+jugadorId+"'  class='botonrenglon'>-</button></div>"+
										"<div class='puestos3'>Nombre</div>"+
										"<div class='puestos4'>"+$("#nombreJugador").val()+"</div>"+
										"<div class='puestos5'>Categoria</div>"+
										"<div class='puestos6'><select id='sdesccat_"+jugadorId+"' name='sdesccat_"+jugadorId+"'></select>"+creascategorias(jugadorId,$("#icatcab").val())+"</div>"+
										"<div class='puestos7'>Remera #</div>"+
										"<div class='puestos8'><input type='number' name='remenum_"+jugadorId+"' id='remenum_"+jugadorId+"' ></input></div>"+
										"<div class='puestos9'>Puesto</div>"+
										"<div class='puestos10'><select id='sjugadorp_"+jugadorId+"' name='sjugadorp_"+jugadorId+"'></select>"+creaspuestos(jugadorId,0)+"</div>"+
										"<div class='puestos11'>Fch Ini Puesto</div>"+
										"<div class='puestos12'><input type='date' name='fechalta_"+jugadorId+"' id='fechalta_"+jugadorId+"' value='"+hoy+"'></input></div>"+											
										"</<div>");								

			}); // fin evento AGREGAREG ON CLICK
		/*********************************+obtener jugador***************************/	
			
		}); // parentesis del READY

		</script>
    </head>
    <body>
		<?php include('includes/newmenu.php'); ?>
    
<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->
		<form id="jugadorABM" class="altajugador" name="altajugador" >
		<div class="DNIControlJugador">					
			<div class="ControlJug1"><input id="ianio" name="ianio" value="" readonly></input></div>
			<div class="ControlJug2">
				<button id="AltaJugador" name="AltaJugador" class="butControlEqBlu" title="Alta">Alta Jugador</button>
			</div>
			<div class="ControlJug3">
				<button id="Actualizar" name="Actualizar" class="butControlEqRed" title="Actualizar">Actualizar</button>
			</div>
			<div class="ControlJug33">
				<button id="agregaReg" name="agregaReg" class="butControlEq" title="nuevo registro">+renglon</button>				</div>
			<div class="ControlJug4">
				<button id="Volver" name="Volver" class="butControlEq" title="Volver"> << </button>
			</div>
		</div>
		
		<div class="DNIJugador">					
				<div class="dnijug1">
					<img  src="img/jugadorGen.png" class="imgjugador"></img>
				</div>
				<div class="dnijug2">
					<!--aca hay otra grilla...de tres -->
						<div class="grillaDatosJu">
							<div class="datosju1">
									<input type="hidden" name="idjugador" id="idjugador"></input>
									<input type="hidden" name="NumeroEnClub" id="NumeroEnClub"></input>
									<span class="TituloEqControl">NOMBRE</span>
							</div>
							<div class="datosju2"><input type="text" name="nombreJugador" id="nombreJugador"></input></div>
							<div class="datosju3"><span class="TituloEqControl">CATEGORIAS</span></div> 
							<div class="datosju4">
							  <div class="datosju4_A">
							  <div class="datosju4_A1">Cat. Inicial</div>
							  <div class="datosju4_A2">
								  	<select id="icatcabini" name="icatcabini" class="icatcab">
										<option value="9999">Seleccionar...</option>
									</select>
								</div>
							   <div class="datosju4_A3">Cat. Actual</div>
							   <div class="datosju4_A4">
								   <select id="icatcab" name="icatcab" class="icatcab">
										<option value="9999">Seleccionar categoria</option>
									</select>
								</div>
  							  </div>
							</div>
							<div class="datosju5"><span class="TituloEqControl">Edad</span></div>
							<div class="datosju6"><input type="number" name="edadJugador" id="edadJugador"></input></div>
							<div class="datosju7"><span class="TituloEqControl">Inicio en Club</span></div>
							<div class="datosju8"><input type="date" name="inicioEnclub" id="inicioEnclub"></input></div>
							<div class="datosju7B"><span class="TituloEqControl">Egreso en Club</span></div>
							<div class="datosju8B"><input type="date" name="egresoEnclub" id="egresoEnclub"></input></div>
							
							<div class="datosju9">
								<span class="TituloEqControl">Club</span> 
							</div>
							<div class="datosju10">
								<div class="iescudo">
									<div class="iescudo1">
										<select id="iclubescab" name="iclubescab" class="dniclub">
										<option value="9999">Seleccionar club</option>
										</select>
									</div>
									<div class="iescudo2">
										<img  src="img/jugadorGen.png" class="imgjugador" id="imagenclub"></img>
									</div>
								</div>
						    </div>
						</div>
				</div> <!-- fin grilla DNIJUGADOR2-->		
				<div class="dnijug4" id="dnijug4">
					<div class="gridPuestos">
						<div class="puestos1">X</div>
						<div class="puestos2">M</div>
						<div class="puestos3">Nombre</div>
						<div class="puestos4">Xxxxxxxxxx</div>
						<div class="puestos5">Categoria</div>
						<div class="puestos6">sub17 blahh</div>
						<div class="puestos7">Remera #</div>
						<div class="puestos8">12</div>
						<div class="puestos9">Puesto</div>
						<div class="puestos10">libero</div>
						<div class="puestos11">Fch Ini Puesto</div>
						<div class="puestos12">marzo 2018</div>		
					</div>
				</div>
		</div>		
		<input type="hidden" id="ultimoRegPuestos" name="ultimoRegPuestos" value="0"></input>			
		</form>		
	</body>
</html>