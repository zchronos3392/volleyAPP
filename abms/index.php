<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<link rel=”shortcut icon” type=”image/png” href=”./img/favicons/favicon.ico”/>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link rel="stylesheet" href="./css/bootstrap.css">
	   <!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="./scripts/nsanz_script.js"></script 
    </head>
    <body>
    
	<?php include('includes/newmenu.php'); ?>
	<?php include('abms/mysql_login.php'); ?>
    <!-- si partido recibe un numero de partido, se puede usar la misma pagina para seguir uno especifico-->
    <!-- tambien en la pagina de inicio se pueden seguir varios -->
    <!-- se puede elegir cual partido seguir, y cual actualizar -->
        <!-- Cuando das de alta un partido, aparece listado en la paguna principal para SEGUIR -->
  
<div class="" > <!--navbar navbar-inverse navbar-fixed-top  role="navigation"-->
<div id="body-results">
    <div class="container under-menu front-container">
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-12 col-sm-12 bloque">
                <div class="row">
                    <div style="margin-top:20px;" class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                    <div class="title-box-result"><strong>NOMBRE CLUB A - NOMMBRE CLUB B &nbsp;&nbsp;|&nbsp;&nbsp;
            FECHAPARTIDO - HORAPARTIDO</strong>
                </div>
                <div class="box-result">
                    <table align="center">
                        <thead><tr><th></th><th>Resultado</th><th style="width=200px!important;">Sets</th><th>Saque</th></tr></thead>
                        <tr style="height: 30px;">
                            <td  class="nombre-club"><strong><img src="./img/river.png" class="img-logo-club-front">&nbsp;CLUBABR A</strong></td>
                            <!--<td class="col-res">18</td>-->
                            <td class="col-res">ResultadoA</td>
                            <td style="width=200px!important;">SET1A&nbsp;&nbsp;SET2A&nbsp;&nbsp;<span style="color:orange">SET3A</span></td>
                            <td class="col-res"><span >&nbsp;&nbsp;</span></td>
                        </tr>
                        <tr style="height: 30px;">
                            <td class="nombre-club"><strong><img src="./img/hacoaj.png" class="img-logo-club-front">&nbsp;CLUBABR B</strong></td>
                            <!--<td class="col-res">15</td>-->
                            <td class="col-res">ResultadoB</td>
                            <td style="width=200px!important;">SET1B&nbsp;&nbsp;SET2B&nbsp;&nbsp;<span style="color:orange">SET3B</span></td>
                            <td class="col-res"><span class="saque">&nbsp;&nbsp;</span></td>
                        </tr>
                    </table>
                </div>
            </div></a>
                </div>
            </div>
        </div>
    </div>
</div><!--fin-->

   	
</body>
</html>

