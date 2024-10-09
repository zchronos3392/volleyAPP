<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require ('Jugador.php');
require_once ('Numeros.php');
	
  $tabla = "'CJUGPAG'";	
  $paginas = Numeros::getPaginas($tabla);
 
//   print_r($paginas);
   
  $TAMANO_PAGINA = $paginas['ultnumero'];
  
  //echo "paginas a dividir la consulta: $TAMANO_PAGINA <BR>";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar peticion GET
	$club = 0;
	if(isset($_GET['iclubescab1'])) $club = (int)  $_GET['iclubescab1'];

	$anio = 0;
	if(isset($_GET['ianio'])) $anio = (int)  $_GET['ianio'];	

	$categoria = 0;
	if(isset($_GET['icatcab1'])) $categoria = (int)  $_GET['icatcab1'];
	
	$modo = "";
	if(isset($_GET['modo'])) $modo =  $_GET['modo'];
	$unJugador = 0;
	if(isset($_GET['jugadorUn'])) $unJugador = (int)  $_GET['jugadorUn'];


	$paginaPedida=0;
	if(isset($_GET['pag'])) $paginaPedida = (int)  $_GET['pag'];
	

	
	$xnombre = "";
	if(isset($_GET['xnombre'])) $xnombre = $_GET['xnombre'];

	$xnomAll = "";
	if(isset($_GET['xnomAll'])) $xnomAll = $_GET['xnomAll'];

	if($xnomAll != 9999)
		$xnombre = $xnomAll;
		
	//echo "<br>parametros que llegan : club: $club, anio : $anio, categoria: $categoria, modo: $modo<br>";

if($modo == "UPD")
{
   $jugadores = jugador::getByIdABM($anio,$unJugador,$club,$categoria); // " select * from vappjugadores where idclub = ? and categoria = ? "
   if ($jugadores)
	    {
	        $datos["estado"] = 1;
	        $datos["Jugadores"] = $jugadores;//es un array
	        print json_encode($datos);
	    };
}
else
 {
	// agregar metodo contar que devuelve count(*)
	$registros = jugador::contarConsulta($club,$categoria,$anio,$xnombre);
    $num_total_registros = (int) $registros["0"]["count(*)"];
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
    if( $num_total_registros > 0)
     {
     	if($num_total_registros <= $TAMANO_PAGINA) $TAMANO_PAGINA = $num_total_registros;
     		
			if (!$paginaPedida) {
			    $inicio = 0;
			    $paginaPedida=1;
			}
			else {
			    $inicio = ($paginaPedida - 1) * $TAMANO_PAGINA;
			}     	


			//calculo el total de páginas
			$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

			//pongo el número de registros total, el tamaño de página y la página que se muestra
			
			//echo "Número de registros encontrados: " . $num_total_registros . "<br>";
			//echo "Se muestran páginas de " . $TAMANO_PAGINA . " registros cada una<br>";
			//echo "Mostrando la página " . $paginaPedida . " de " . $total_paginas . "<p>";     	

     	// todas
     	//ahora podria venir: 
     	 //anio = 9999 o año X
     	 //club = 9999 o club X
     	 //categoria = 9999 o categoria X 
//     	 $totalTrabajo = 
//comentado : 22/05		if($categoria == 9999) {$jugadores = jugador::getJugadorxClub($club,$anio);} // " select * from vappjugadores where idclub = ? "
//comentado : 22/05		else {
			$jugadores = jugador::getJugadorxClubCate($club,$categoria,$anio,$inicio,$TAMANO_PAGINA,$xnombre);
//comentado : 22/05			} 
		//print_r($jugadores);
	    if ($jugadores)
	    {
//	    	$partido =	$_GET["idpartido"];
//			$fecha	 =	"'".$_GET["fechapartido"]."'";
// 			$jugadores = partjug::getJugadoresLoad($partido,$fecha,$club,$categoria); // " select * from vappjugadores where idclub = ? and categoria = ? "
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Jugadores"] = $jugadores;//es un array
	        $datos["TotalPaginas"] = $total_paginas;//es un array
	        $datos["paginaPedida"] = $paginaPedida;//es un array
	        $datos["tamanio"] = $TAMANO_PAGINA;
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else  {	print json_encode(array("id" => 2,"nombre" => "Sin jugadores cargados"));  }
  	}
	else    print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
 }
}

?>
