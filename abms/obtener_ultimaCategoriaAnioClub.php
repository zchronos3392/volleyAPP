<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require_once ('EquipoAnio.php');
            require_once('Categoria.php');
				require_once('JugadorPuestos.php');


//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
	 $ianio = 0;
     if(isset($_GET['ianio']))  $ianio = (int)$_GET['ianio'];
     
	 $icompetencia = 0;
     if(isset($_GET['icompetencia']))  $icompetencia = (int)$_GET['icompetencia'];

     $idclub = 0;
     if(isset($_GET['iclub']))  $idclub = (int)$_GET['iclub'];

     
    //$clubes = EquipoAnio::getAll($ianio,0,$icompetencia);
    $xLastAnioCargado = Categoria::getLastCategoriasConJugadores($ianio,$idclub);
    if( !empty($xLastAnioCargado))        
        $ExCategorias = Categoria::getAllConJugadores($xLastAnioCargado['anio'],$idclub);

    //PROCESAMOS LA ULTIMA CATEGORIA CARGADA PARA EL CLUB SELECCIONADO
    if(!empty($ExCategorias) && !empty($xLastAnioCargado)){
        for($z=0;$z < count($ExCategorias); $z++)
        {
            $ExCcategoriasClub[$z]['idclub'] = $idclub;
            $ExCcategoriasClub[$z]['descripcion'] = $ExCategorias[$z]['descripcion'];
            $ExCcategoriasClub[$z]['ConJugadores'] = $ExCategorias[$z]['ConJugadores'].' jugadores en '.$xLastAnioCargado['anio'];
        }        


        $datos["estado"] = 1;	        
        $datos["Clubes"] = $ExCcategoriasClub; //es un array
        print json_encode($datos);
        //el print lo puedo usar para cuando lo llamo desde android
    }
    //PROCESAMOS LA ULTIMA CATEGORIA CARGADA PARA EL CLUB SELECCIONADA                        
    else 
    {
        $datos["estado"] = 2;	        
        $datos["Clubes"] = "CLUB SIN DATOS PREVIOS";
        print json_encode($datos);
    }

}
?>
