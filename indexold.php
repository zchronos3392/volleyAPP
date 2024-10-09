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
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="./scripts/nsanz_script.js"></script>
		<script type="text/javascript" src="./jqs/ietats.js">
		</script>		
		<script type="text/javascript">
		
		function filtrar(){
			
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
				"icate" : $("#icate").val(),
				"iclub" : $("#iclub").val(),
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
							var alta='';
			                if(v.descripcion.includes('PROGR')) var img = './img/PartidoONOFFSQR.png';
			                if(v.descripcion.includes('FIN'))   var img = './img/PartidoOFFSQR.png';		
			                if(v.descripcion.includes('CURSO')) var img = './img/PartidoONSQR.png';

			$("#grid-ListaPart21").append('<section class="agrid-LPReg21" id="grid-LPReg21">'+
				  '<div class="ilp22_21" >'+v.ClubA+'</div>'+
				  '<div class="ilp22_21">'+v.ClubARes+'</div>'+
				  '<div class="ilp22_21">'+v.ClubB+'</div>'+
				  '<div class="ilp22_21">'+v.ClubBRes+'</div>'+
				  '<div class="ilp22_2_21">Competencia: '+v.cnombre+'</div>'+
				  '<div class="ilp22_2_21">'+v.CatDesc+'</div>'+
				  '<div class="ilp22_2_21">'+v.Fecha+'</div>'+
				  '<div class="ilp22_2_21 ">'+v.Inicio+'</div>'+
				  '<div class="imgdiv ilp22_21">'+
				  '<img id="imgEstadoIndex_21" src="'+img+'" class="imgEstadoIndex_21" title="'+v.descripcion+'" alt="'+v.descripcion+'"></img>'+
				  '</div>'+
		 		  '<div class="21_ilp11">'+
				  '<input type="hidden" name="PARTIDO2019-11-0803" />'+
				  '<a href="Tablero.php?id='+v.idPartido+'&fecha='+v.Fecha+'">'+
				  '<input type="button" id="verset" name="verset" class="btnVerSet_21" value="(ver)" title="Re-veer set"></input>'+
				  '</a>'+
				   alta+
				   '<input type="hidden" id="fechaxpartido" value="'+v.Fecha+'" />'+
					'<input type="hidden" id="idxpartido" value="'+v.idPartido+'" />'+
				   '</div></section>');
						};
					  });
		            },
 		            
		             error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					}
		            }); // FIN funcion ajax CLUBES
		}; 

		$(document).ready(function(){
			
			
				//filtrar();
				$("#icomp").on("change click",function() {filtrar();});
				$("#ietats").append('<option value="" label="Estados..">Estados..</option>');
				$("#ietats").on("change click",function() {filtrar();});				
				$("#fecDdeAscDsc").on("change click",function() {filtrar();});
				$("#fecDdeAscDsc2").on("change click",function() {filtrar();});				
				$("#icate").on("change click",function() {filtrar();});
					$("#icate").append('<option value="' + '' + '">' + 'Categorias...' + '</option>');
					$("#icate").val('');
					
				$("#iclub").on("change click",function() {filtrar();});
					$("#iclub").append('<option value="' + '' + '">' + 'Clubes...' + '</option>');
					$("#iclub").val('');
				$("#fecDde").on("change",function() {filtrar();});
						 var f=new Date();
						 var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
						 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
						 				,"27","28","29","30","31");
						 var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
						 var fechapartido = (f.getFullYear()-1) + "-" + meses[f.getMonth()] + "-" +dias[(f.getDate()-1)] ;
				$("#fecDde").val(fechapartido);
				$("#fecHta").on("change",function() {filtrar();});
						 var f2=new Date();
						 var dias2 = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
						 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
						 				,"27","28","29","30","31");
						 var meses2 = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
						 var fechapartido2 = f.getFullYear() + "-" + meses2[f.getMonth()] + "-" +dias2[(f.getDate()-1)] ;
				$("#fecHta").val(fechapartido2);
				
				$("#icity").on("change click",function() {filtrar();});
					$("#icity").append('<option value="' + '' + '">' + 'Ciudades...' + '</option>');
					$("#icity").val('');

					$("#icity2").on("change click",function() {filtrar();});
					
				filtrar();					
		}); // end of DOCUMENT.READY 	
		</script>
    </head>
    <body>
   	<header>
			<?php include('includes/newmenu.php'); ?>
<!--		<Section class="LogoApp">
			<img  class="LogoApp" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png" />	
		</Section>	

		<section id="headerbar" name="headerbar" class="headerbar">
			
        <button class="botonMenu">
		  <a href="ingreso.php">            
			<img class="contener" src="./img/contrasenia.svg"></img>
		   </a>	
        </button>
		</section>
-->
</header>
 <section id="busqueda" name="busqueda" class="busqueda"><!--normal: 1070,<768:3288  -->
		<div id="formbuscar" name="formbuscar" class="formbuscar"><!--normal 1077,<768:3295 -->
				<label for="icomp" class="lblbusqueda">Competencias</label>
					<select id="icomp"><option value="9999">Competencias...</option></select>
				<label for="icate" class="lblbusqueda">Categorias</label>					
					<select id="icate"><option value="9999">Categorias...</option></select>
				<label for="iclub" class="lblbusqueda">Local</label>					
					<select id="iclub" class="iclubes"><option value="0">Clubes...</option></select>
			<div id="frmbuscardate" name="frmbuscardate" class="frmbuscardate"><!--normal 1088,<768:3306 -->
				<label for="fecDde" class="LabelTxtDate">Desde </label>
					<input type="date" id="fecDde" class="fecha"/>
				<label for="fecHta" class="LabelTxtDate">Hasta </label>
						<input type="date" id="fecHta" class="fecha"/>
					<input type="checkbox" id="fecDdeAscDsc2" class="fecDdeAscDsc2" />
			</div>  
			<div id="frmbuscarotros" name="frmbuscarotros" class="frmbuscarotros"><!--normal 1088,<768:3306 -->
				<label for="fecDdeAscDsc" class="lblbusqueda">Orden</label>								
					<input type="checkbox" id="fecDdeAscDsc" class="fecDdeAscDsc" />
				<label for="icity" class="lblbusqueda">Ciudades</label>					
					<select id="icity"><option value="9999">Ciudades...</option></select>
			</div>  
			    <label class="lblbusqueda" for="ietats">Estado</label>
				   <select id="ietats" class="SelList"><option value="9999" selected>Estados..</option></select>
				<label for="icity" class="lblbusqueda2">Ciudades</label>					
					<select id="icity2" class="icity2"><option value="9999">Ciudades...</option></select>				</div> 
				    
 </section>   
<!--<section id="medio">-->    
  <section class="grid-ListaPartTit21" id="grid-ListaPartTit">
  <!-- ENCABEZADOS DE LA GRIILLA-->
  <div id="grid-LPReg" class="agrid-LPReg21 grid-LPReg21">
	  <div class="ilp22">Club Local</div>
	  <div class="ilp22">Pto Loc.</div>
	  <div class="ilp22">Club Vis.</div>
	  <div class="ilp22">Pto Vis.</div>
	  <div class="ilp22">Comp</div>
	  <div class="ilp22">Cat</div>
	  <div class="ilp22">Fecha</div>
	  <div class="ilp22">Hr Ini</div>
	  <div class="ilp22">Estado</div>
	  <div class="ilp22">F(x</div>
  </div>
<!-- CONTENIDO DE LA GRILLA-->
		  <section class="grid-ListaPart21" id="grid-ListaPart21">
				  <section class="agrid-LPReg21" id="grid-LPReg21">
				  <div class="ilp22_21" >HACOAJ</div>
				  <div class="ilp22_21">3</div>
				  <div class="ilp22_21">fERRO</div>
				  <div class="ilp22_21">2</div>
				  <div class="ilp22_2_21">Competencia: SuperFecha #Sub15 #2019</div>
				  <div class="ilp22_2_21">SUB15.[CAB]</div>
				  <div class="ilp22_2_21">2019-11-08</div>
				  <div class="ilp22_2_21">01:14</div>
				  <div class="imgdiv ilp22_21">
				  		<img id="imgEstadoIndex_21" src="./img/PartidoONSQR.png" class="imgEstadoIndex_21" title="aCTIVO" alt="ACTIVO"></img>
				 </div>
 			  	 <div class="21_ilp11">
			  		<input type="hidden" name="PARTIDO2019-11-0803" />
			   		  <a href="Tablero.php?id=3&fecha=2019-11-08">
			   				<input type="button" id="verset" name="verset" class="btnVerSet_21" value="(ver)" title="Re-veer set"></input>
			   		  </a>
					 <input type="hidden" id="fechaxpartido" value="2019-11-08" />
					 <input type="hidden" id="idxpartido" value="3" />
			 	 </div>		
		</section>
		   <!-- -->
		   </section> 
</section> 
<!--</section>-->

</body>
</html>

