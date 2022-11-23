<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="./scripts/nsanz_script.js"></script 
	   <!--SCRIPTS-->
	   <script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO
		$(document).ready(function(){
		    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
		        var iclubes = $("#iclub");
		        //	data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		        //	el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		         //sin embargo la direccion final queda: http://localhost/volleyAPP/equipos.php?abms/obtener_clubes.php
		         // y eso esta mal !!!	
		         $.ajax({ 
		            url:   './abms/obtener_clubes.php',
		            type:  'GET',
		            dataType: 'json',
					// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		            beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
		    			$("#iclub").prop('disabled', true);
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
						//console.log(r["Clubes"]);// es un vector
						
						//console.log(r['estado']);
						//console.log(r['Clubes']);
						
		                $(r['Clubes']).each(function(i, v)
		                { // indice, valor
		                		//console.log(v);
		                    $("#iclub").append('<option value="' + v.clubabr + '">'+v.clubabr+'-'+ v.nombre + '</option>');
		                });
		                $("#iclub").prop('disabled', false);
		            },
		             error: function (xhr, ajaxOptions, thrownError) {
        				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
        				$("#iclub").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
        				$("#iclub").val('9999');
        				//console.log(xhr.status);
						console.log(xhr.responseText);
						console.log(thrownError);
						$("#iclub").prop('disabled', false);
					}
		            }); // FIN funcion ajax
		            
		            
		 	// CARGAMOS EL BOTON INGRESO Y SUS FUNCIONES
		 	$("#btnIngreso").click(function(){ 
		    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
		    	//alert('Submit activado');
		        // Guardamos el select de cursos
		        if( ($("#nombre").val() != '') &&  ($("#clubabr").val() != '') )
		        {
		        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
		        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
				var parametros = {
                	"nombre" : $("#nombre").val(),
                	"clubabr" : $("#clubabr").val(),
                	"escudo"  : $("#escudo").val()
        		};		         
		         
		         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		            url:   './abms/insertar_club.php',
		            type:  'POST',
		            data: parametros,
		            beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
		    			$("#iclub").prop('disabled', true);
		            },
		            
		            success:  function (r){
		               	// DESBloqueamos el SELECT de los cursos
		    			$("#iclub").prop('disabled', false);
		            },
		            //error: function() {
					error: function (xhr, ajaxOptions, thrownError) {
        				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
		            }
		            }); // FIN funcion ajax
		        } // else THIS.VAL <> ''
		        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
		        {
		        }
		    }); // parentesis el .CLICK
		}); // parentesis del READY

		</script>
    </head>
    <body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php //include('includes/menuConfig.php');; ?>
    </header>
       
 <section id="medio">    
 <div class="wrapper">
      <h3>Ingreso de datos</h3>	
		<form id="formClubes" name="formClubes"  class="form1">
			<p><!-- el POST SOLO VE LO QUE TIENE NAME, sino no lo ve.-->
				<label for="nombre">Nombre club</label>
				<input id="nombre" name="nombre" type="text">
			</p>
			<p>
				<label for="clubabr">abreviatura</label>
				<input id="clubabr"	name="clubabr" "text">
			</p>
			<p>
				<button id="btnIngreso"   name="btnIngreso" value="sape" class="btnIngreso">Sape...</button>
			</p>
		</form>
</div>

<div id="iclubes"	class="clubesWide">
	 	<form>
		<label for="iclub">Clubes cargados</label>
            <select id="iclub" class="SelList"> 
                <option value="1" selected>Seleccione un CLUB</option>
            </select>
        </form> 
</div>
</section>
</body>
</html>

