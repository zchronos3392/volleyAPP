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
			                var alta='<a href="VerCSets.php?id='+v.idPartido+'&setmax='+v.setsnmax+'&fecha='+v.Fecha+'&llama=index';
					  			alta+='"><input type="button" id="nuevoset" name="nuevoset" class="btnVerSet_21 Naranja " value="(0/)" title="Revisar valores del Set"></input></a>';
							
							if(v.descripcion.includes('SUSPENDIDO')) var img = './img/PartidoSSPND.png';
			                if(v.descripcion.includes('PROGR')) var img = './img/PartidoONOFFSQR.png';
			                if(v.descripcion.includes('LLUVI')) var img = './img/rain-icon-png.jpg';
			                if(v.descripcion.includes('FIN'))   var img = './img/PartidoOFFSQR.jpg';		
			                if(v.descripcion.includes('CURSO')) var img = './img/PartidoONSQR.png';
			                	
			                if(! v.descripcion.includes('FIN'))  alta=''; 


			               
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
			               var Ver = '<a href="TableroGrandev20.php?id='+v.idPartido+'&fecha='+v.Fecha+'">';
								Ver +=  '<input type="button" id="verset" name="verset" class="btnVerSet_21" value="(ver)" title="Re-veer set"></input>';
								 Ver +=  '</a>';

	$("#grid-ListaPart21").append('<section class="grid-ListaPart21" id="grid-ListaPart21">'+
									'<section class="agrid-LPReg21" id="grid-LPReg21">'+
				  						divClubA+
									  '<div class="ilp212">'+v.ClubARes+'</div>'+
									    divClubB+
									  '<div class="ilp214">'+v.ClubBRes+'  '+v.Inicio+'</div>'+
									  '<div class="imgdiv ilp215">'+
									  		'<img id="imgEstadoIndex_21" src="'+img+'" class="imgEstadoIndex_21" title="'+v.descripcion+'" alt="'+v.descripcion+'"></img>'+
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
									  '<div class="ilp2110"></div>'+
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
			
			
				//filtrar();
				$("#icomp").on("change click",function() {filtrar();});
				$("#ietats").append('<option value="0" label="Estados..">Estados..</option>');
				$("#ietats").val(0);
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
						 var fechapartido = (f.getFullYear()) + "-" + meses[f.getMonth()] + "-" +dias[(0)] ;
				$("#fecDde").val(fechapartido);
				$("#fecHta").on("change",function() {filtrar();});
						 var f2=new Date();
						 var dias2 = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
						 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
						 				,"27","28","29","30","31");
						 var meses2 = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
						 var fechapartido2 = f.getFullYear() + "-" + meses2[11] + "-" +dias2[(30)] ;
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
				<div class="itemBusc6"><select id="iclub" class="iclubes"><option value="0">Clubes...</option></select></div> 
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
	 </div> 

   
<!--<section id="medio">-->    
  <section class="grid-ListaPartTit21" id="grid-ListaPartTit">
  <!-- ENCABEZADOS DE LA GRIILLA-->
  <div id="grid-LPReg" class="grid-Titulos21">
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
  </div>
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
			   		  <a href="TableroGrandev20.php?id=3&fecha=2019-11-08">
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

