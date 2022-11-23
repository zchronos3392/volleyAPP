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
		<script type="text/javascript">

		function cerrarPartido()
        {
		    var parametros =
		    {
			 "fecha"   : $("#fechaxpartido").val(),
			 "partido" : $("#idxpartido").val()	
			};

		    //alert($("#fechaxpartido").val());
		    //alert($("#idxpartido").val());
		     
		    $.ajax({ 
            url:   './abms/cerrar_partido.php',
            type:  'POST',
            data:  parametros,
            dataType: 'json',
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){
						
			},
            success:  function (r){
			},
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			}
            }); // FIN funcion ajax CLUBES
		
			
		};  


		$(document).ready(function(){
			
			
         $.ajax({ 
            url:   './abms/obtener_partidos.php',
            type:  'GET',
            dataType: 'json',
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){
				
			},
            success:  function (r){

                $(r['Partidos']).each(function(i, v)
                { // indice, valor				
				
                if (! $('#grid-ListaPart').find("[name='PARTIDO"+v.Fecha+v.idPartido+"']").length)
				{
					var alta='<input type="button" id="volver" title="Cerrar partido" name="volver"'+
						 	 ' class="btnFinPArtido" '+
							 'value="X" onclick="cerrarPartido();"></input>';
	                if(v.descripcion.includes('PROGR')) var img = './img/PartidoONOFF.png';
	                if(v.descripcion.includes('FIN')){ 
	                		var img = './img/PartidoOFF.png';
	                		alta='';
					}	
					if(v.descripcion.includes('SUSPENDIDO')) var img = './img/PartidoSSPND.png';
		            if(v.descripcion.includes('CURSO')) var img = './img/PartidoON.png';
					$("#grid-ListaPart").append(
					  '<div class="ilp2 margen"><section class="grid-LPReg" id="grid-LPReg">'+
					  '<div class="ilp22" >'+v.ClubA+'</div>'+'<div class="ilp22">'+v.ClubARes+'</div>'+'<div class="ilp22">'+v.ClubB+'</div>'+'<div class="ilp22"> '+v.ClubBRes+'</div>'+
					  '<div class="imgdiv ilp22"><img src="'+img+'" class="imgEstado" title="'+v.descripcion+'"></img></div>'+
					  '<div id	="ilp22_2">'+'Competencia: '+v.cnombre+'('+v.CatDesc+')'+' Fecha: '+v.Fecha+' - '+v.Inicio+'</div>'+
					  '</section></div><div class="ilp11"><input type="hidden" name="PARTIDO'+v.Fecha+v.idPartido+'" />'+
					  '<a href="CSets2.php?id='+v.idPartido+'&setmax='+v.setsnmax+'&fecha='+v.Fecha+
					  '"><input type="button" id="nuevoset" name="nuevoset" class="btnSet" value="+" title="Nuevo set"></input></a>'+
						'<a href="CSets2.php?id='+v.idPartido+'&setmax='+v.setsnmax+'&fecha='+v.Fecha+'"><input type="button" id="verset" name="verset"'+
						' class="btnVerSet" value="(ver)" title="Re-veer set"></input></a>'+
						alta+
						'<input type="hidden" id="fechaxpartido" value="'+v.Fecha+'" />'+
						'<input type="hidden" id="idxpartido" value="'+v.idPartido+'" />'+
						'</div>');		
				};
			  });
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			}
            }); // FIN funcion ajax CLUBES
            
		}); // end of DOCUMENT.READY 	
		</script>
    </head>
    <body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php ////include('includes/menuConfig.php');; ?>
    </header>
    
<!--<section id="medio">-->    
  <section class="grid-ListaPart" id="grid-ListaPart">
  <div class="ilp1"><h3>Carga Partidos</h3></div>
  <div class="ilp1"></div>
  <div class="ilp11"></div>
  <div class="ilp1"></div>
  <div class="ilp1"></div>
  <div class="ilp11">
  	<A href="Cpartidos.php"><button id="nuevop" name="nuevop" class="btnNew" title="Nuevo partido">+</button></A>
  </div>
<!-- -->
</section> 

<!--</section>-->

</body>
</html>

