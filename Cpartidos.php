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
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
<!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="./scripts/partido_script.js"></script> 
<!--SCRIPTS-->
	   <script type="text/javascript">
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
		 	$("#FormPartidoC").submit(function(e){e.preventDefault();});			
		 	
		 
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
		 

//**************** CANCHAS OBTENER *********************************************/            
/*
         $.ajax({ 
            url:   './abms/obtener_canchas.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icancha").prop('disabled', true);
    		},
            done: function(data){
			},
            success:  function (r){
            	//var re = JSON.parse(r);
                $(r['Canchas']).each(function(i, v)
                { // indice, valor
                	//if (! $('#icancha').find("option[value='" + v.idcancha + "']").length)
                	//{
						$("#icancha").append('<option value="' + v.idcancha + '">' +v.clubabr+' - '+ v.extras+' - '+ v.nombre + '</option>');
					//}		
                });
                $("#icancha").prop('disabled', false);
           },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icancha").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#icancha").val('9999');
			$("#icancha").prop('disabled', false);
			}
            }); // FIN funcion ajax CANCHAS todas:
*/
			$("#iclub").on("keypress, keydown, keyup", function(e) {
  				var code = e.keyCode || e.which;
  					//if ( code == 13 || code == 9 ) {
    				//$("input[name=btn]").trigger("click");
 				//alert('cargando canchas del club LOCAL');  
 						buscarCanchasClub($("#iclub").val(),"icancha");
						//asignar la ciudad del club...
			});
			$("#iclub").on("click change", function(e) {
  				var code = e.keyCode || e.which;
  					//if ( code == 13 || code == 9 ) {
    				//$("input[name=btn]").trigger("click");
 				//alert('cargando canchas del club LOCAL');  
 						buscarCanchasClub($("#iclub").val(),"icancha");
			});			
/*	
	$("#btnBuscarClubA").click(function(){ 
        var textoSearch =	$("#itextA").val().toUpperCase();
        if(textoSearch != ''){
		$("#iclub option:contains("+textoSearch+")").each(function(){
    			$(this).attr('selected', true).css({"font-size":"40px","color":"red"});
		});
		} else
		$("#iclub option:contains("+textoSearch+")").each(function(){
    			$(this).attr('selected', true).css("");
		});
		return false;
	}); // parentesis el .CLICK buscar club

	$("#btnBuscarClubB").click(function(){ 
        var textoSearch =	$("#itextB").val().toUpperCase();
        if(textoSearch != ''){
		$("#iclubb option:contains("+textoSearch+")").each(function(){
    			$(this).attr('selected', true).css({"font-size":"40px","color":"red"});
		});
		} else
		$("#iclubb option:contains("+textoSearch+")").each(function(){
    			$(this).attr('selected', true).css("");
		});
		return false;
	}); // parentesis el .CLICK buscar club
	*/
//**************** PARTIDPS *********************************************/ 
   // AJAX DE CARGA POR set maximos por categoria
 //********************************/change del ICate
  
         $("#icate").on("click onchange",function()
         {
         var parametros = {"idcate" : $("#icate").val()};	
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
					$("#SetMaxCat").val(re['SetMaxCat1'].setMax);
			},
            error: function (xhr, ajaxOptions, thrownError)
             {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			}
            });// CIERRE DEL AJAX
          });//change del ICate
//********************************/change del ICate
//********************************/change del ICate
  		 $("#icomp").on("click onchange",function()
         {
         if($("#icomp").val() != 9999)
         {
		 		
         var parametros = {"idcomp" : $("#icomp").val()};	
         $.ajax({ 
            url:   './abms/setcomp.php',
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
					$("#SetMaxComp").val(re['SetMaxComp1']);
			},
            error: function (xhr, ajaxOptions, thrownError)
             {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			}
            });// CIERRE DEL AJAX

		 }

		});//change del ICate
//********************************/change del IComp
			
		}); // parentesis del READY

		</script>
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>

	<form name="FormPartidoC" id="FormPartidoC" class="PartidoCab">
	   <div class="botonesAltaPartido">	
		<div><h3>Partido Cabecera</h3></div>
		  <div><A href="AdministrarAPP.php">
				<input type="button" id="nuevop" name="nuevop" class="btnNew" value="<"></input>
			</A>
		  </div>
		<select id="ianio" name="ianio" class="ianio">
				<option value="9999">Seleccionar año...</option>
		</select>
		 </div> 
			<div class="gridPartido">
				<div class="ipp1">
				<label for="dscp">DESCRIPCION / CODIGO </label>
						<input type="text" id="dscp" name="dscp"/>
				</div>
				<div class="ipp1">
					<label for="fechap">FECHA</label>
						<input type="date" id="fechap" name="fechap"/>
					<label for="horai">Hora inicio</label>
						<input type="time" id="horai" name="horai"/>
				</div>

				 <div class="minigrilla">
					<div class="ipp1_0">
						<label for="valfinset">Valor Final de Set</label>
							<input class="inputmg" type="text" id="valfinset" name="valfinset" value="25"/>
					</div>
					<div class="ipp1_0">		
						<label for="valtbset">Valor TB</label>
							<input type="text" id="valtbset" name="valtbset" value="15"/>
					</div>
				</div>	
								
				<div class="ipp1">		
					<label for="icate">Categoria</label>
						<select name="icate" id="icate">
							<option value="999">Seleccione una categoria</option>
						</select>
					<br><label>Sets maximos por categoria </label>
						<input type="text" id="SetMaxCat" name="SetMaxCat" class="inputSets"/>
				</div>
				<div class="ipp1">
					<label for="icomp">Competencia</label>
					<select name="icomp" id="icomp">
						<option value="9999">Seleccione una competencia</option>
					</select>
					<br><label>Sets maximos por competencia</label> <input type="text" id="SetMaxComp" name="SetMaxComp" class="inputSets" />
				</div>								
			<div class="ipp1">
					<label for="iclub">Equipo A</label>
						<section id="busque" name="busque" class="busque">
							<div><label for="itext">Buscar</label></div>	
							<div><input type="text" id="itextA" name="itextA" class="inputSearch" onkeyup="buscarClub(this.id,'iclub');" /></div>
							<div><!--<button id="btnBuscarClubA"   name="btnBuscarClubA" value="..." class="btnBuscar">Sape...</button>--></div>
						</section>
					<select name="iclub" id="iclub">
						<option value="999">Seleccione un club</option>
					</select>
			</div>
			<div class="ipp1">		
					<label for="iclubb">Equipo B</label>
					<section id="busque"  class="busque">
						<div><label for="itext">Buscar</label></div>	
						<div><input type="text" id="itextB" name="itextB" class="inputSearch" onkeyup="buscarClub(this.id,'iclubb');"/></div>
						<div><!--<button id="btnBuscarClubB"   name="btnBuscarClubB" value="..." class="btnBuscar">Sape...</button>--></div>
					</section>

					<select name="iclubb" id="iclubb">
						<option value="999">Seleccione un club</option>
					</select>	  					
			</div>
			<div class="ipp1">
					<label for="icancha">Canchas cargadas</label>
					<select id="icancha" name="icancha" class="SelList"> 
						<option value="9999" selected>Seleccione una cancha</option>
					</select>

					<br><label for="icity">Ciudades cargadas</label>
					<select id="icity" name="icity" class="SelList"> 
						<option value="999" selected>Seleccione una Ciudad</option>
					</select>
				<span><button  id="altap" name="altap" value="altap" class="btnIngreso">Alta partido</button></span>	
			</div>				
			<div id="mensaje" name="mensaje"></div>			
		</div><!-- <div class="gridPartido"> -->
	</form><!-- FormPartidoC-->
<!-- </section>	medio -->
</body>
</html>

