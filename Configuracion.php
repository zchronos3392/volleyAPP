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
		<script type="text/javascript" src="./scripts/nsanz_script.js"></script>
		<script type="text/javascript">
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
			$("#grid-ListaPart").append(
			  '<div class="ilp2 margen"><section class="grid-LPReg" id="grid-LPReg">'+
			  '<div>'+v.ClubA+'</div>'+'<div>'+v.ClubARes+'</div>'+'<div>'+v.ClubB+'</div>'+'<div>'+v.ClubBRes+'</div>'+'<div>'+v.descripcion+'</div>'+'</section></div><div class="ilp1"><a href="CSets2.php?id='+v.idPartido+
			  '"><input type="button" id="nuevoset" name="nuevoset" class="btnSet" value="+"></input></a>'+
				'<a href="CSets2.php?id='+v.idPartido+'"><input type="button" id="verset" name="verset"'+
				' class="btnVerSet" value="(0:0)"></input></a></div>');		
			});
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			}
            }); // FIN funcion ajax CLUBES
		}); 	
		</script>
    </head>
    <body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php //include('includes/menuConfig.php');; ?>
    </header>
<section id="medio">    
  <section class="grid-ListaPart" id="grid-ListaPart">
  <div class="ilp1"><h3>Carga Partidos</h3></div>
  <div class="ilp1"></div>
  <div class="ilp1"></div>
  <div class="ilp1">Competencia</div>
  <div class="ilp1"></div>
  <div class="ilp1">
  	<A href="CPartidos.php"><button id="nuevop" name="nuevop" class="btnNew" >+</button></A>
</div>
 
</section> 

</section>

</body>
</html>

