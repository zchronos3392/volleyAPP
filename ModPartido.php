<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C2//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP:: modificar partido</title>
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
		var parametros = {"CPartido" : "S"};		         

	<?php 
			if(isset($_GET["id"])) $partidoid = (int) $_GET["id"];
			else $partidoid = (int) $_POST["id"];
			
			$esNovedades=0;
						if(isset($_GET["novedad"])) $esNovedades = (int) $_GET["novedad"];
						else if(isset($_POST["novedad"])) $esNovedades = (int) $_POST["novedad"];
						
			$fecpartido="''";// sera string 
			if(isset($_GET["fechapart"])) $fecpartido = "'".$_GET["fechapart"]."'";
			else $fecpartido = "'".$_POST["fechapart"]."'";
			
	?>	
		var partidoID =0;
		var fechaPartido='';
		partidoID    = <?php echo $partidoid ?>;
		fechaPartido = <?php echo $fecpartido ?>;
		$("#fechap").val(fechaPartido);
		var vieneDeNovedad = 0;
		vieneDeNovedad = <?php echo $esNovedades; ?>;
    
	function modificar(){
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
			"idpartido":partidoID ,
        	"fechap" : $("#fechap").val(),
        	"icate" : $("#icate").val(),
        	"iclub" : $("#iclub").val(),
        	"iclubb" : $("#iclubv").val(),
        	"icancha" : $("#icancha").val(),
        	"icomp" : $("#icomp").val(),
        	"icity" : $("#icity").val(),
        	"horai" : $("#horai").val(),
        	"SetMaxCat" : $("#SetMaxCat").val(),
        	"SetMaxComp" : $("#SetMaxComp").val(),
			"valtbset":$("#valtbset").val(),
			"valfinset":$("#valfinset").val(),
			"ResA":$("#valRESULTADOA").val(),
			"ResB":$("#valRESULTADOB").val(),
			"descripcionp":$("#dscp").val()
	};		         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/modificar_partido.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#isede").prop('disabled', true);
    			//console.log(parametros);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#isede").prop('disabled', false);
    			//$("mensaje").append('Partido ingresado');
					console.log(r);
    				if(vieneDeNovedad == 1){
						window.location='NovedadesSet.php?'+'id='+partidoID+'&setid='+
							<?php 
								$setID=0;
							    if(isset($_GET['setid'])) $setID = (int) $_GET['setid'];
								echo($setID );
							?>+'&setmax='+
						<?php 
							$setMAX =0;
							if(isset($_GET['setmax'])) $setMAX = (int) $_GET['setmax'];
							echo($setMAX);
						?>+'&fecha='+<?php echo("'".$_GET['fechapart'])."'"; ?>+'&continuar=0';	
					}
					else
    				{window.location='AdministrarAPP.php';};
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#isede").append('<option value="9998">' + 'SUBMIT:: Error en el servidor Tabla Sedes..</option>');
            	//console.log("errorrrr");
            }
            }); // FIN funcion ajax		
	};
	
	function volver(){
		refe='';
			if(vieneDeNovedad == 1){
					window.location='NovedadesSet.php?'+'id='+partidoID+'&setid='+
					<?php 
					$setID=0;
					if(isset($_GET['setid'])) $setID = (int) $_GET['setid'];
					echo($setID );
					?>+'&setmax='+
					<?php 
					$setMAX =0;
					if(isset($_GET['setmax'])) $setMAX = (int) $_GET['setmax'];
					echo($setMAX);
					?>+'&fecha='+<?php echo("'".$_GET['fechapart'])."'"; ?>+'&continuar=0';	
			}
			else
					{window.location='AdministrarAPP.php';};
		
	};
		
		
	$("#modip").click(function(){ 
//    QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	// alert('Submit activado');
        // Guardamos el select de cursos
        // data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
			"idpartido":partidoID ,
        	"fechap" : $("#fechap").val(),
        	"icate" : $("#icate").val(),
        	"iclub" : $("#iclub").val(),
        	"iclubb" : $("#iclubv").val(),
        	"icancha" : $("#icancha").val(),
        	"icomp" : $("#icomp").val(),
        	"icity" : $("#icity").val(),
        	"horai" : $("#horai").val(),
        	"SetMaxCat" : $("#SetMaxCat").val(),
        	"SetMaxComp" : $("#SetMaxComp").val(),
			"valtbset":$("#valtbset").val(),
			"valfinset":$("#valfinset").val(),
			"ResA":$("#valRESULTADOA").val(),
			"ResB":$("#valRESULTADOB").val(),
			"descripcionp":$("#dscp").val()
	};		         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/modificar_partido.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			// $("#isede").prop('disabled', true);
    			// console.log(parametros);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			// $("#isede").prop('disabled', false);
    			// $("mensaje").append('Partido ingresado');
					console.log(r);
    				if(vieneDeNovedad == 1){
						window.location='NovedadesSet.php?'+'id='+partidoID+'&setid='+
							<?php 
								$setID=0;
							    if(isset($_GET['setid'])) $setID = (int) $_GET['setid'];
								echo($setID );
							?>+'&setmax='+
						<?php 
							$setMAX =0;
							if(isset($_GET['setmax'])) $setMAX = (int) $_GET['setmax'];
							echo($setMAX);
						?>+'&fecha='+<?php echo("'".$_GET['fechapart'])."'"; ?>+'&continuar=0';	
					}
					else
    				{window.location='AdministrarAPP.php';};
            },
            // error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				// $("#isede").append('<option value="9998">' + 'SUBMIT:: Error en el servidor Tabla Sedes..</option>');
            	// console.log("errorrrr");
            }
            }); // FIN funcion ajax
    }); // parentesis el .CLICK alta partido
//**************** PARTIDO: CABECERA *********************************************/
		$(document).ready(function(){
	
		
		 $("#fechap").val(fechaPartido);
		 
		 //NECESITO CARGAR EL COMBO CON LOS CLUBES ANTES DE ELEGIRLO
         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
            data: parametros,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclubv").prop('disabled', true);
    			$("#iclub").prop('disabled', true);    			
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
              	if (! $('#iclubv').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclubv").append('<option value="' + v.idclub + '">'+v.clubabr+'-'+  v.nombre + '</option>');
					}		
              	if (! $('#iclub').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclub").append('<option value="' + v.idclub + '">'+v.clubabr+'-'+  v.nombre + '</option>');
					}		
					
                });
                $("#iclubv").prop('disabled', false);
                $("#iclub").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iclubv").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#iclubv").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#iclubv").prop('disabled', false);
			}
            }); // FIN funcion ajax CLUBES
            
//**************** CANCHAS OBTENER *********************************************/            
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

$("#itextbuscarLocal").keyup(function()
	//	on("keyup keydown",function()
         {   
			var parametros = {
	        	"llamador" : "CONTROLAPP",
	        	"funcion" : "buscarclub",			
	        	"filtro" : $("#itextbuscarLocal").val(),
				};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#iclub").empty();
				//$("#iclubb").empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#iclub').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclub").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
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
       
       
$("#itextbuscarVisita").keyup(function()
	//	on("keyup keydown",function()
         {   
			var parametros = {
	        	"llamador" : "CONTROLAPP",
	        	"funcion" : "buscarclub",			
	        	"filtro" : $("#itextbuscarVisita").val(),
				};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#iclubv").empty();
				//$("#iclubb").empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#iclubv').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclubv").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
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
			var parametros = 
			{
	        	"id" : partidoID,				
	        	"fechapart" : fechaPartido
			};		  

		         $.ajax({ 
		            url:   './abms/obtener_partidoCab.php',
		            type:  'GET',
		            dataType: 'json',
		            data: parametros,
		            beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
		    		},
		            done: function(data){
						
					},
		            success:  function (r){
		                $(r['Partido']).each(function(i, v)
		                { // indice, valor	
							$("#fechap").prop('disabled', true);
							$("#horai").prop('disabled', true);

							$("#valfinset").val(v.valFinSet);
							$("#valtbset").val(v.valTBSet);
							$("#icate").val(v.idcat);	
							$("#SetMaxCat").val(v.CatSetMax);
							$("#dscp").val(v.descripcionp);	
								$("#horai").val(v.Inicio);

							$("#valRESULTADOA").val(v.ClubARes);
							$("#valRESULTADOB").val(v.ClubBRes);
							
							$("#icomp").val(v.competencia);	
								$("#SetMaxComp").val(v.setsnmax);
							$("#iclubv").val(v.idclubb);
							$("#iclub").val(v.idcluba);
							$("#icancha").val(v.CanchaId);
							$("#icity").val(v.ciudad);	
						});},
		             error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					}
		            }); // FIN funcion ajax CLUBES					

					
		}); // parentesis del READY

		</script>
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>

	<form name="FormPartidoC" id="FormPartidoC" class="PartidoCab" onSubmit="modificar();">
	   <div class="botonesAltaPartido">	
		<div><h3>Partido Cabecera</h3></div>
		  <div><A id="volver" name="volver" onclick="volver();">
				<input type="button" id="nuevop" name="nuevop" class="btnNew" value="<"></input>
			</A>
		  </div>
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
							<input class="inputmg" type="text" id="valfinset" name="valfinset"/>
					</div>
					<div class="ipp1_0">		
						<label for="valtbset">Valor TB</label>
							<input type="text" id="valtbset" name="valtbset"/>
					</div>
				</div>	
								
				 <div class="minigrilla">
					<div class="ipp1_0">
						<label for="valRESULTADOA">RESULTADO EQUIPO A</label>
							<input class="inputmg" type="text" id="valRESULTADOA" name="valRESULTADOA">
					</div>
					<div class="ipp1_0">		
						<label for="valRESULTADOB">RESULTADO EQUIPO A</label>
							<input type="text" id="valRESULTADOB" name="valRESULTADOB">
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
							<div><label for="itextbuscarLocal">Buscar</label></div>	
							<div><input type="text" id="itextbuscarLocal" name="itextbuscarLocal" class="inputSearch"/></div>
							<div></div>
						</section>
					<select name="iclub" id="iclub">
						<option value="999">Seleccione un club</option>
					</select>
			</div>
			<div class="ipp1">		
					<label for="iclubv">Equipo B</label>
					<section id="busque"  class="busque">
						<div><label for="itextbuscarVisita">Buscar</label></div>	
						<div><input type="text" id="itextbuscarVisita" name="itextbuscarVisita" class="inputSearch"/></div>
						<div></div>
					</section>

					<select name="iclubv" id="iclubv">
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
				<span><button  id="modip" name="modip" value="modip" class="btnIngreso">Modifica partido</button></span>	
			</div>				
			<div id="mensaje" name="mensaje"></div>			

			<input id="id" type="hidden" val="<?php 
						$partidoCLAVEACCESO = 0;
						if(isset($_GET["id"])) $partidoCLAVEACCESO = (int) $_GET["id"];
						else $partidoCLAVEACCESO = (int) $_POST["id"];
						echo $partidoCLAVEACCESO;
				?>" />
			
			
			<input id="fechapart" type="hidden" val="<?php
							$fecpartidoCLAVE="''";// sera string 
							if(isset($_GET["fechapart"])) $fecpartidoCLAVE = "'".$_GET["fechapart"]."'";
							else $fecpartidoCLAVE = "'".$_POST["fechapart"]."'";
							echo $fecpartidoCLAVE;
				?>" />
		</div><!-- <div class="gridPartido"> -->
	</form><!-- FormPartidoC-->
<!-- </section>	medio -->
</body>
</html>

