<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require('Partido.php');

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(isset($_GET['ListaPartidosAjuste'])){

        $items = $_GET['ListaPartidosAjuste'];
        for($i=0;$i<count($items);$i++)
        {
            $idPartido    = $items[$i]['idPartido']; 
            $Fecha        = $items[$i]['fechaPartido']; // debe llevar comillas
            $s = $Fecha." 00:00:00";
            $idclubSede   = $items[$i]['nuevoclubSede'];
            
            $retorno = Partido::actualizaClubSede($idPartido,$Fecha,$idclubSede);
    
        };	
        
    }
    if ($retorno) {
        // Codigo de exito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        // Codigo de falla
		echo $retorno;
    }

}
?>