<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require_once ('EquipoAnio.php');
    require_once ('Sede.php');
        require_once ('Cancha.php');
            require_once('Categoria.php');
				require_once('JugadorPuestos.php');


//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
	 $ianio = 0;
     if(isset($_GET['ianio']))  $ianio = (int)$_GET['ianio'];
     
	 $icompetencia = 0;
     if(isset($_GET['icompetencia']))  $icompetencia = (int)$_GET['icompetencia'];

	 
    $clubes = EquipoAnio::getAll($ianio,0,$icompetencia);
	    if ($clubes) {
			//Clubes":[{"idequipoanio":"1","idclub":"83","nombre":"CLUB NAUTICO HACOAJ ","clubabr":"HACOAJ","ianio":"2021"}]
            // busco las sedes del club
            $i=0;
            for($i=0; $i < count($clubes);$i++){
                $idclub = $clubes[$i]['idclub'] ;
              
                //AGREGAR LAS CATEGORIAS CARGAS DEL CLUB CON LOS 
                //JUGADORES QUE TIENE CADA UNA PARA ESE AÑO
				$categoriasClub=array();
					//echo " id ".$valor['idclub']." nombre ".$valor['clubabr']."<br>";	
				$categorias = Categoria::getAllConJugadores($ianio,$idclub);
					//print_r($categorias);
				$y=0;	
                for($z=0;$z < count($categorias); $z++)
                {
                //echo " ".$valor['idclub']." ".$valorCat['descripcion']." ".$valorCat['ConJugadores']." <br>";
                    //= array_push();
                    $categoriasClub[$y]['idclub'] = $idclub;
                    $categoriasClub[$y]['descripcion'] = $categorias[$z]['descripcion'];
                    $categoriasClub[$y]['ConJugadores'] = $categorias[$z]['ConJugadores'];
                    $icategoriaControl = $categorias[$z]['CategoriaId'];

                    $puestosCategoria = puestojugador::getControlJugPuestos($idclub,$ianio,$icategoriaControl);
                    //print_r($puestosCategoria);
					$contadorErrores =0;		
					$error="";
							foreach ($puestosCategoria  as $clave => $valor)
							{
								foreach ($valor as $clave2 => $nuevoValor)
								 {
									if( is_null($nuevoValor) )
									{
										$contadorErrores++;
										$error .= "El campo $clave2 es nulo para ".$valor['nombre']."<br>";
									} 
							     }
							}
					$categoriasClub[$y]['PuestosError'] = $contadorErrores;
                    $y++;
                }	 
                //AGREGAR LAS CATEGORIAS CARGAS DEL CLUB CON LOS 
                //JUGADORES QUE TIENE CADA UNA PARA ESE AÑO
                $clubes[$i]['Categorias']=$categoriasClub;   
                
                //AGREGAR SEDES DEL CLUB Y SUS CANCHAS..
                $sedes = sede::getSedexClub($idclub);
                //$sedes = Array ( "idclub" => "1", "direccion" => "LLEGA POR POST");
                if($sedes) 
                {
                   for($j=0; $j < count($sedes);$j++)
                   {
                        $idsede=$sedes[$j]['idsede'];
                        $canchas = Cancha::getBySede($idclub,$idsede);
                          if ($canchas) 
                             $sedes[$j]['Canchas'] = $canchas;
                          else   
                            $sedes[$j]['Canchas'] = "La sede no tiene canchas cargadas";
                   }
                $clubes[$i]['Sedes']=$sedes;
                } 
                else
                {
                $clubes[$i]['Sedes']="No tiene sedes cargadas";
                }
            }

            $datos["estado"] = 1;	        
            $datos["Clubes"] = $clubes;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
        }  
        else 
        {
            $datos["estado"] = 2;	        
            $datos["Clubes"] = "NO HAY CLUBES CARGADOS AUN";
	        print json_encode($datos);
        }

}
?>
