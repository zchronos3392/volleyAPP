<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>VOLLEY.APP</title>
        <meta name="title" content="volley all app, partido.">
        <meta name="ROBOTS" content="INDEX,FOLLOW">
        <meta http-equiv="Content-Language" content="es">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- ESTILOS -->
  <link rel="stylesheet" href="./css/nsanz_style.css">
  <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
<script src="./css/jquery.min.js.descarga"></script
<script type="text/javascript" src="./scripts/nsanz_script.js.descarga"></script>
<style>

#mostrar-modal {
/*oculto el boton de ver modal , porque empieza viendose el MODAL, con este boton oculto.*/
 display: none;
}	
#modal { 
/*fondo de la pantalla MODAL, GRIS OSCURO , TODA LA PANTALLA UTIL
este es el div que genera la pantalla MODAL*/
 background: rgba(0, 0, 0, 0.9);
 color: #fff;
 position: fixed;
 top: -100vh;
 left: 0;
 height: 100vh; /*TODO EL ALTO DEL VIEWPORT*/
 width: 100vw; /*TODO EL ANCHO DEL VIEWPORT*/
 transition: all .5s; 
}

#modal label {
/*CONTENIDO DE LA PANTALLA MODAL...
PUEDE TOMAR CUALQUIER FORMA Y COLOR...*/	
 width: 60%;
 height: 40%;
 position: absolute;
 top: 0;
 left: 0;
 bottom: 0;
 right: 0;
 margin: auto;
 font-size: 1.5em;
 padding:0em;
 text-align: center;
}

#modal select {
/*CONTENIDO DE LA PANTALLA MODAL...*/	
 width: 90%;
 height: 15%;
 position: absolute;
 top: 0;
 left: 0;
 bottom: 0;
 right: 0;
 margin: auto;
 font-size: 1.5em;
 text-align: center;
}	
/*ANIMACIONES PARA LOS BOTONES Y LA APARICION DE LA PANTALLA MODALL*/
#mostrar-modal + label {
 background: steelblue;
 border-radius: 30%; /*boton circular*/
 display: table;
 margin: auto;
 color: #fff;
 line-height: 3;
 padding: 0 1em;
 text-transform: uppercase;
 cursor: pointer;
}
#mostrar-modal + label:hover {
/*el label cambia de color cuando le pasamos el mouse por arriba, como simulando un BOTON...*/
 background: #38678f;
}
/*ANIMACIONES PARA LOS BOTONES Y LA APARICION DE LA PANTALLA MODALL*/
#mostrar-modal:checked ~ #modal {
 top: 0;
}
/**************** estilo boton cerrar **************************/
#cerrar-modal {
/*OCULTAMOS EL BOTON, DE CERRAR PORQUE EMPIEZA OCULTO EL MODAL..
HASTA PICAR EN EL ENLACE*/
 display: none;
}

#cerrar-modal + label {
/*CONFIGURAMOS EL INPUT DE CERRAR MODAL, PARA QUE PAREZCA UN BOTON X ENCERRADO..*/
display: none;
 position: absolute;
 top: 1em;
 right: 1em;
 z-index: 100;
 color: #fff;
 font-weight: bold;
 cursor: pointer;
 background: tomato;
 line-height: 5px;
 text-align: center;
  border-radius: 25%;
 transition: all .5s;
 
}
#cerrar-modal:checked ~ #modal {
/*CUANDO LO CHEQUEMOS, LE HACEMOS CLICK, EL CSS OCULA AL TEXT*/
 top: -100vh;
}	

#mostrar-modal:checked ~ #cerrar-modal + label {
 display: block;
}
#cerrar-modal:checked + label {
 display: none;
}	
label{
	padding: 0.5em 0.5em 0.5em 0.5em ;
}
/**************** estilo boton cerrar **************************/
</style>
</head>
<body>
   	<header>

   <link rel="stylesheet" href="./css/font-awesome.min.css">
<section class="LogoApp">
<a href="index.php">
  <!-- <img class="LogoApp" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png"> -->
</a>
</section>	
<section id="headerbar" name="headerbar" class="headerbar">
<label for="mostrar-modal"> Ver modal </label>
<input id="mostrar-modal" name="modal" type="radio" /> 

<input id="cerrar-modal" name="modal" type="radio" /> 
<label for="cerrar-modal"> X </label> 
<div id="modal">
<p>
<label for="">ESTADOS CARGADOS</label>
            <select id="" class=""><option value="1">PROGRAMADO</option><option value="2">FINALIZADO</option><option value="3">PAUSADO</option><option value="4">EN CURSO</option><option value="5">CONFIGURACION INICIAL</option></select>
</p>
</div>

<!--</section>-->




</body></html>