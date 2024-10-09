<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';

// function conectar() {



// 	$host = "localhost";
// 	$usr = "c0990415_voleyap"; //pp000146_nico";
// 	$pass = "kefaKA24fu";  //"Indiana456";
// 	$db = "nicolass__voleyap";
		
// 	$link = @mysqli_connect($host,$usr,$pass, $db) or
// 		die("Error conectando al servidor $host con el nombre de usuario $usr ");
// 		//@mysqli_query("SET NAMES 'utf8'");	
// 	return $link;
// 	}
	

class Partido
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vapppartido'
     *
     * @param $idsede Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
    		// armar join a tablas descriptoras
	$consulta = "SELECT Fecha, idPartido,descripcionp, cates.descripcion as CatDesc, setsnmax, clubAtbl.clubabr as ClubA , 
				clubBtbl.clubabr as ClubB, 
				CONCAT(clubsede.clubabr,' - ',sedecancha.extras,' - ',cancha.nombre) as cancha, 
				comp.cnombre, city.nombre , TIME_FORMAT(HoraIni, '%H:%i') Inicio , Horafin, 
				ClubARes, ClubBRes, sts.descripcion, ClubA as idcluba,ClubB as idclubb
				FROM vapppartido
		inner join vappclub clubAtbl on clubAtbl.idclub = ClubA
		inner join vappclub clubBtbl on clubBtbl.idclub = ClubB
		inner join vappcategoria cates on cates.idcategoria = categoria
		inner join vappcomp comp on comp.idcomp = competencia
		inner join vappciudad city on city.idciudad = ciudad

		inner join vappclub clubsede on 
					(clubsede.idclub = vapppartido.clubsedepartido and vapppartido.clubsedepartido > 0)
					or (clubsede.idclub = vapppartido.ClubA and vapppartido.clubsedepartido = 0)
				   
						left join vappsede sedecancha 
									on sedecancha.idsede = vapppartido.idsede 
								and ((sedecancha.idclub = vapppartido.clubsedepartido 
											and vapppartido.clubsedepartido >0 ) OR
									(sedecancha.idclub = vapppartido.ClubA 
										and vapppartido.clubsedepartido = 0 ) 
									)
							left join vappcancha cancha on cancha.idcancha = CanchaId 
										and cancha.idsede = sedecancha.idsede
										and cancha.idclub = clubsede.idclub

		inner join vappestado sts on sts.idestado = estado 
		ORDER BY Horafin desc, idpartido ";  
		//ORDER BY Fecha desc, idpartido desc";  
		// echo "<br>$consulta<br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }
    
/***********************************************************************************/	
public static function getAllcparms($icomp, $icate, $iclub,$ClubNombre, $icity, $fecDde, $fecHta, $fecOrden,$estado,$Segundo_estado,$codigoError,$codigoPartido)
{

//29-04-2024 SE QUITA ESTO PORQUE NO SIRVE MAS, PERO LO DEJO POR SI ME OLVIDO CMO ERA	
    // inner join vappcancha cancha on cancha.idcancha = CanchaId 
    // inner join vappsede sedecancha on sedecancha.idsede = vapppartido.idsede and sedecancha.idclub=cancha.idclub 
    // inner join vappclub clubsede on clubsede.idclub = cancha.idclub 
//29-04-2024 SE QUITA ESTO PORQUE NO SIRVE MAS, PERO LO DEJO POR SI ME OLVIDO CMO ERA	

/*TENGO QUE ARMAR EL WHERE DE UNA*/
	$parms ='';
	$parms2='';
	$parms3='';
	$parms4='';
	$parms41='';	//club por nombre
	$parms5='';
	$parms6='';
	$parms7='';
	$parms8=" ORDER BY Fecha , idpartido";
	$parms9='';
	$parms10=''; //buscando errores
	$parms11=''; //buscando por $codigoPartido o descripcion de partido
	
	If ($icomp <> 9999) {   $parms2 = "(competencia = $icomp)";};
	If ($icate <> 0)    { 	$parms3 = "(categoria = $icate)"; };
	If ($iclub <> 0)    { 	$parms4 = "(ClubA = $iclub)"; };
	// parms41 se une con OR O CON NADA
		If ($ClubNombre <> "")    { 	$parms41 = " (clubAtbl.nombre like '%$ClubNombre%'  OR clubBtbl.nombre like '%$ClubNombre%')"; };	
	If ($icity <> 0 && $icity <> 9999 )    { 	$parms5 = "(ciudad = $icity)"; };
	If ($fecDde <> "''"){ 	$parms6 = "(Fecha >= $fecDde)"; };
	If ($fecHta <> "''"){ 	$parms7 = "(Fecha <= $fecHta)"; };
	If ($fecOrden <> 0) {	$parms8 = " ORDER BY Horafin desc, idpartido"; };
	If ($estado <> 0)    
	{ 	
			$parms9 = "(estado = $estado)"; 
			if($Segundo_estado <> 99)
				$parms9 = "(".$parms9." OR (estado = $Segundo_estado))";
	};
			
	$hayFiltro = 0 ;
	
	if (($parms2 <> '')||( $parms3  <> '')|| ($parms4  <> '')||($parms41  <> '')|| ($parms5  <> '')||($parms6 <> '')  )	
				$hayFiltro = 1 ;		
//			.$parms2." AND ".$parms3." AND ".$parms4." AND ".$parms5." AND ".$parms6." AND ".$parms7;
	$parms='';
	$primero = 0;
	if($hayFiltro == 1)
	{
		If ($parms2 <> "") { if($primero == 1) $parms = $parms." AND ".$parms2;
							 else{$parms = " WHERE  ".$parms2;$primero=1;}}
		If ($parms3 <> "")  { if( $primero == 1 ) $parms = $parms." AND ".$parms3;
							 else{$parms = " WHERE  ".$parms3;$primero=1;}}
		If ($parms4 <> "")  { if( $primero == 1) $parms = $parms." AND ".$parms4;
							 else{$parms = " WHERE  ".$parms4;$primero=1;}}
		// SI NO HAY OTROS FILTROS, LO AGREGO EN EL WHERE DE UNA
		// PERO SI HAY FILTROS, LO AGREGO CON OR							 
			If ($parms41 <> "")  { if( $primero == 1) $parms = $parms." or ".$parms41;
									else{$parms = " WHERE  ".$parms41;$primero=1;}}
		// SI NO HAY OTROS FILTROS, LO AGREGO EN EL WHERE DE UNA
		// PERO SI HAY FILTROS, LO AGREGO CON OR							 
		If ($parms5 <> "")  { if( $primero == 1) $parms = $parms." AND ".$parms5;
							 else{$parms = " WHERE  ".$parms5;$primero=1;}}
		If ($parms9 <> "") { if($primero == 1) $parms = $parms." AND ".$parms9;
							 else{$parms = " WHERE  ".$parms9;$primero=1;}}
							 	
		If(($parms6 <> "") && ($parms7 <> "")){
			if( $primero == 1) $parms = $parms." AND (Fecha BETWEEN ".$fecDde." AND ".$fecHta.")";
							 else{$parms = " WHERE  (Fecha BETWEEN ".$fecDde." AND ".$fecHta.")";$primero=1;}
		}
		else {		
		If ($parms6 <> "") { if( $primero == 1) $parms = $parms." AND ".$parms6;
							 else{$parms = " WHERE  ".$parms6;$primero=1;}}
		If ($parms7 <> "") { if( $primero == 1) $parms = $parms." AND ".$parms7;
							 else{$parms = " WHERE  ".$parms7;$primero=1;}}
		}		

		//
		if($codigoError == 15){
			//VALORESNULOS en campos que podrian generar error al usar el sistema
			$parms10 = "(categoria = 0 
						 	OR ClubA	= 0 
							OR ClubB	= 0 
							OR vapppartido.idsede	= 0 
							OR CanchaId	= 0 
							OR competencia	= 0 
							OR ciudad	= 0 
							OR HoraIni	= ''
							OR Horafin	= '' 
							OR setsnmax = 0 
						)";

			if( $primero == 1) $parms = $parms." AND ".$parms10;
			else{$parms = " WHERE  ".$parms10;}
		};


		if($codigoPartido != ""){
			//VALORESNULOS en campos que podrian generar error al usar el sistema
			$parms11 = " descripcionp like '%$codigoPartido%'";

			if( $primero == 1) $parms = $parms." AND ".$parms11;
			else{$parms = " WHERE  ".$parms11;}

		};
	}	
	// tablas descriptoras

	$consulta = "
				SELECT Fecha, idPartido, cates.descripcion as CatDesc, setsnmax, clubAtbl.clubabr as ClubA , 
				clubBtbl.clubabr as ClubB, 
				CONCAT(clubsede.clubabr,' - ',sedecancha.extras,' - ',cancha.nombre) as cancha, 
				comp.cnombre, city.nombre , TIME_FORMAT(HoraIni, '%H:%i') Inicio , Horafin, 
				ClubARes, ClubBRes, sts.descripcion ,ClubA as idcluba,ClubB as idclubb,
				setsnmax,ciudad,CanchaId,valTBSet,valFinSet,competencia ,vapppartido.idsede	,
				cates.idcategoria as idcat,cates.setMax CatSetMax,descripcionp,clubSedePartido,estado as estadoID
				FROM vapppartido
				inner join vappclub clubAtbl 
				on clubAtbl.idclub = ClubA 
			inner join vappclub clubBtbl 
				on clubBtbl.idclub = ClubB 
			inner join vappcategoria cates 
				on cates.idcategoria = categoria 
			inner join vappcomp comp 
				on comp.idcomp = competencia 
			inner join vappciudad city 
				on city.idciudad = ciudad   

				inner join vappclub clubsede on 
				(clubsede.idclub = vapppartido.clubsedepartido and vapppartido.clubsedepartido > 0)
				or (clubsede.idclub = vapppartido.ClubA and vapppartido.clubsedepartido = 0)
			   
					left join vappsede sedecancha 
								on sedecancha.idsede = vapppartido.idsede 
							and ((sedecancha.idclub = vapppartido.clubsedepartido 
										and vapppartido.clubsedepartido >0 ) OR
								(sedecancha.idclub = vapppartido.ClubA 
									and vapppartido.clubsedepartido = 0 ) 
								)
						left join vappcancha cancha on cancha.idcancha = CanchaId 
									and cancha.idsede = sedecancha.idsede
									and cancha.idclub = clubsede.idclub				
			inner join vappestado sts 
					on sts.idestado = estado 
		".$parms.$parms8;
		//" ORDER BY Fecha desc, idpartido desc";  
		  //echo '<br>*********************************************************************************************************************<br>';
		  // echo $consulta;
		  //echo '<br>*********************************************************************************************************************<br>';
        try {
           
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
  }
 /***********************************************************************************/ 

 /***********************************************************************************/ 
 /* CONSULTA DE TODOS LOS PARTIDOS QUE JUGO UN CLUB EN UN A?O CON RESULTADOS EN TEXTO*/ 
 public static function getAllcparmsClub($icomp, $icate, $iclub, $icity, $fecDde, $fecHta, $fecOrden,$estado)
    {
	
/*TENGO QUE ARMAR EL WHERE DE UNA*/
	$parms ='';
	$parms2='';
	$parms3='';
	$parms4='';
	$parms5='';
	$parms6='';
	$parms7='';
	$parms8=" ORDER BY Horafin desc, idpartido";
	$parms9='';
	
	If ($icomp <> 9999) {   $parms2 = "(competencia = $icomp)";};
	If ($icate <> 0)    { 	$parms3 = "(categoria = $icate)"; };
	If ($iclub <> 0)    { 	$parms4 = "((ClubA = $iclub) or (ClubB = $iclub))"; };
	If ($icity <> 0)    { 	$parms5 = "(ciudad = $icity)"; };
	If ($fecDde <> "''"){ 	$parms6 = "(Fecha >= $fecDde)"; };
	If ($fecHta <> "''"){ 	$parms7 = "(Fecha <= $fecHta)"; };
	If ($fecOrden <> 0) {	$parms8 = " ORDER BY Fecha , idpartido"; };
	If ($estado <> 0)    { 	$parms9 = "(estado = $estado)"; };
			
	$hayFiltro = 0 ;
	
	if (($parms2 <> '')||( $parms3  <> '')|| ($parms4  <> '')||($parms5  <> '')||($parms6 <> '')  )	
				$hayFiltro = 1 ;		
//			.$parms2." AND ".$parms3." AND ".$parms4." AND ".$parms5." AND ".$parms6." AND ".$parms7;
	$parms='';
	$primero = 0;
	if($hayFiltro == 1)
	{
		If ($parms2 <> "") { if($primero == 1) $parms = $parms." AND ".$parms2;
							 else{$parms = " WHERE  ".$parms2;$primero=1;}}
		If ($parms3 <> "")  { if( $primero == 1 ) $parms = $parms." AND ".$parms3;
							 else{$parms = " WHERE  ".$parms3;$primero=1;}}
		If ($parms4 <> "")  { if( $primero == 1) $parms = $parms." AND ".$parms4;
							 else{$parms = " WHERE  ".$parms4;$primero=1;}}
		If ($parms5 <> "")  { if( $primero == 1) $parms = $parms." AND ".$parms5;
							 else{$parms = " WHERE  ".$parms5;$primero=1;}}
		If ($parms9 <> "") { if($primero == 1) $parms = $parms." AND ".$parms9;
							 else{$parms = " WHERE  ".$parms9;$primero=1;}}
							 	
		If(($parms6 <> "") && ($parms7 <> "")){
			if( $primero == 1) $parms = $parms." AND (Fecha BETWEEN ".$fecDde." AND ".$fecHta.")";
							 else{$parms = " WHERE  (Fecha BETWEEN ".$fecDde." AND ".$fecHta.")";$primero=1;}
		}
		
		else {		
		If ($parms6 <> "") { if( $primero == 1) $parms = $parms." AND ".$parms6;
							 else{$parms = " WHERE  ".$parms6;$primero=1;}}
		If ($parms7 <> "") { if( $primero == 1) $parms = $parms." AND ".$parms7;
							 else{$parms = " WHERE  ".$parms7;$primero=1;}}
		}							 							 
	};
	
	// tablas descriptoras
				// 	inner join vappcancha cancha 
				// 	on cancha.idcancha = CanchaId
				// 	 and cancha.idclub in (ClubA,ClubB) 
				// inner join vappsede sedecancha 
				//    on sedecancha.idsede = cancha.idsede
				// 	   and sedecancha.idclub = cancha.idclub
				// inner join vappclub clubsede 
				//    on clubsede.idclub = cancha.idclub

	$consulta = "				
				SELECT Fecha, idPartido, cates.descripcion as CatDesc, setsnmax, clubAtbl.clubabr as ClubA , 
				clubBtbl.clubabr as ClubB, 
				CONCAT(clubsede.clubabr,' - ',sedecancha.extras,' - ',cancha.nombre) as cancha, 
				comp.cnombre, city.nombre , TIME_FORMAT(HoraIni, '%H:%i') Inicio , Horafin, 
				ClubARes, ClubBRes, sts.descripcion 
				FROM vapppartido
		inner join vappclub clubAtbl on clubAtbl.idclub = ClubA
		inner join vappclub clubBtbl on clubBtbl.idclub = ClubB
		inner join vappcategoria cates on cates.idcategoria = categoria
		inner join vappcomp comp on comp.idcomp = competencia
		inner join vappciudad city on city.idciudad = ciudad

			inner join vappclub clubsede on 
			(clubsede.idclub  in (Cluba,ClubB,clubsedepartido)
				left join vappsede sedecancha 
							on sedecancha.idsede = vapppartido.idsede 
								and ((sedecancha.idclub in (clubsedepartido,ClubA,ClubB ))
					left join vappcancha cancha on cancha.idcancha = CanchaId 
								and cancha.idsede = sedecancha.idsede
								and cancha.idclub = clubsede.idclub				
		inner join vappestado sts on sts.idestado = estado 
		".$parms.$parms8;
		//" ORDER BY Fecha desc, idpartido desc";  
		// echo "getALL $consulta";
        try {
           
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
  }
 /***********************************************************************************/ 
 


   public static function contarStatsClub($icomp, $icate, $iclub, $icity, $fecDde, $fecHta, $fecOrden,$estado)
    {
	
/*TENGO QUE ARMAR EL WHERE DE UNA*/
	$parms ='';
	$parms2='';
	$parms3='';
	$parms4='';
	$parms5='';
	$parms6='';
	$parms7='';
	$parms8=" ORDER BY Horafin desc, idpartido";
	$parms9='';
	
	If ($icomp <> 9999) {   $parms2 = "(competencia = $icomp)";};
	If ($icate <> 0)    { 	$parms3 = "(categoria = $icate)"; };
	If ($iclub <> 0)    { 	$parms4 = "((ClubA = $iclub) or (ClubB = $iclub))"; };
	If ($icity <> 0)    { 	$parms5 = "(ciudad = $icity)"; };
	If ($fecDde <> "''"){ 	$parms6 = "(Fecha >= $fecDde)"; };
	If ($fecHta <> "''"){ 	$parms7 = "(Fecha <= $fecHta)"; };
	If ($fecOrden <> 0) {	$parms8 = " ORDER BY Fecha , idpartido"; };
	If ($estado <> 0)    { 	$parms9 = "(estado = $estado)"; };
			
	$hayFiltro = 0 ;
	
	if (($parms2 <> '')||( $parms3  <> '')|| ($parms4  <> '')||($parms5  <> '')||($parms6 <> '')  )	
				$hayFiltro = 1 ;		
//			.$parms2." AND ".$parms3." AND ".$parms4." AND ".$parms5." AND ".$parms6." AND ".$parms7;
	$parms='';
	$primero = 0;
	if($hayFiltro == 1)
	{
		If ($parms2 <> "") { if($primero == 1) $parms = $parms." AND ".$parms2;
							 else{$parms = " WHERE  ".$parms2;$primero=1;}}
		If ($parms3 <> "")  { if( $primero == 1 ) $parms = $parms." AND ".$parms3;
							 else{$parms = " WHERE  ".$parms3;$primero=1;}}
		If ($parms4 <> "")  { if( $primero == 1) $parms = $parms." AND ".$parms4;
							 else{$parms = " WHERE  ".$parms4;$primero=1;}}
		If ($parms5 <> "")  { if( $primero == 1) $parms = $parms." AND ".$parms5;
							 else{$parms = " WHERE  ".$parms5;$primero=1;}}
		If ($parms9 <> "") { if($primero == 1) $parms = $parms." AND ".$parms9;
							 else{$parms = " WHERE  ".$parms9;$primero=1;}}
							 	
		If(($parms6 <> "") && ($parms7 <> "")){
			if( $primero == 1) $parms = $parms." AND (Fecha BETWEEN ".$fecDde." AND ".$fecHta.")";
							 else{$parms = " WHERE  (Fecha BETWEEN ".$fecDde." AND ".$fecHta.")";$primero=1;}
		}
		
		else {		
		If ($parms6 <> "") { if( $primero == 1) $parms = $parms." AND ".$parms6;
							 else{$parms = " WHERE  ".$parms6;$primero=1;}}
		If ($parms7 <> "") { if( $primero == 1) $parms = $parms." AND ".$parms7;
							 else{$parms = " WHERE  ".$parms7;$primero=1;}}
		}							 							 
	};
	
	// tablas descriptoras
	$consulta = "				
				SELECT count(*) 
				FROM vapppartido
		inner join vappclub clubAtbl on clubAtbl.idclub = ClubA
		inner join vappclub clubBtbl on clubBtbl.idclub = ClubB
		inner join vappcategoria cates on cates.idcategoria = categoria
		inner join vappcomp comp on comp.idcomp = competencia
		inner join vappciudad city on city.idciudad = ciudad
       INNER join vappcancha cancha 
                       on cancha.idclub in (ClubA,ClubB)
                       and cancha.idcancha = CanchaId 
		inner join vappestado sts on sts.idestado = estado 
		".$parms.$parms8;
		//echo $consulta;		
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return $e;
        }
    }
    

   public static function contar()
    {
    		
        $consulta = "SELECT count(*) FROM vapppartido";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return $e;
        }
    }

    /**
     * Obtiene los campos Resultado de cada Equipo
     * 
     *
     * @param $idpartido Identificador del partido
     * @return mixed
     */

    public static function getResultados($idpartido,$fecha)
    {
    		// armar join a tablas descriptoras
		$consulta = "SELECT ClubARes,ClubA, ClubBRes,ClubB FROM vapppartido WHERE idpartido = $idpartido and fecha=$fecha"; 

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }

    public static function getfinset($idpartido,$fecha)
    {
    		// armar join a tablas descriptoras
		$consulta = "SELECT valFinSet, valTBSet FROM vapppartido WHERE idpartido = $idpartido and fecha=$fecha"; 

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	
    public static function getPartidoId($Fecha,$categoria,$ClubA,$ClubB,$competencia)
    {
    // armar join a tablas descriptoras
	$comandoID = "
					SELECT max(idPartido) as idFinal from  vapppartido
						where Fecha=$Fecha and categoria=$categoria and ClubA=$ClubA 
					and ClubB = $ClubB and competencia=$competencia " ;    	

        try {
            // Preparar sentencia
			 $sentenciaID = Database::getInstance()->getDb()->prepare($comandoID);

            // Ejecutar sentencia preparada
            $sentenciaID->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $sentenciaID->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	
    
    // Obtiene los campos de una sede con un identificador
    // determinado
    //
    // @param $idsede Identificador de la sede
    // @return mixed
    

    public static function getById($id,$fecParm)
    {
	// 29-08-2018, ver si aun funciona...    
	//var_dump($id,$fecParm);	
// // // // // QUERY ARMADA:
// // // // // SELECT idPartido, Fecha, descripcionp, cates.descripcion as DescCate, cates.idcategoria as idcat ,cates.setMax CatSetMax,
// // // // // 	   clubAtbl.clubabr as ClubA , clubBtbl.clubabr as ClubB,
// // // // //        CONCAT(clubsede.clubabr,' - ',sedecancha.extras,' - ',cancha.nombre) as cancha,
// // // // //        comp.cnombre,comp.Logo as logocompetencia,city.nombre ,
// // // // //        TIME_FORMAT(HoraIni, '%H:%i') Inicio , Horafin, ClubARes, ClubBRes,
// // // // //        sts.descripcion as estado , clubAtbl.idclub as idcluba, clubBtbl.idclub as idclubb, 
// // // // //        setsnmax,ciudad,CanchaId,valTBSet,valFinSet,competencia ,vapppartido.idsede
// // // // // FROM vapppartido 
// // // // // 	inner join vappclub clubAtbl on clubAtbl.idclub = ClubA 
// // // // //     inner join vappclub clubBtbl on clubBtbl.idclub = ClubB 
// // // // //     inner join vappcategoria cates on cates.idcategoria = categoria 
// // // // //     inner join vappcomp comp on comp.idcomp = competencia 
// // // // //     inner join vappciudad city on city.idciudad = ciudad 
// // // // //     inner join vappcancha cancha on cancha.idcancha = CanchaId 
// // // // //     inner join vappsede sedecancha on sedecancha.idsede = cancha.idsede and sedecancha.idclub = cancha.idclub 
// // // // //     inner join vappclub clubsede on clubsede.idclub = cancha.idclub 
// // // // //     inner join vappestado sts on sts.idestado = estado 
// // // // // WHERE idpartido=1 and Fecha='20240504';
							   
//29-04-2024 saque esto porque no servia, pero lo dejo para recordarlo por si me vuelve a servir
	// // // // // inner join vappsede sedecancha 
	// // // // // on sedecancha.idsede = vapppartido.idsede and sedecancha.idclub = ClubA
	// // // // // inner join vappcancha cancha on cancha.idcancha = vapppartido.CanchaId 
	// // // // // and cancha.idclub = ClubA and cancha.idsede = vapppartido.idsede
	// // // // // inner join vappclub clubsede on clubsede.idclub = cancha.idclub
//29-04-2024 saque esto porque no servia, pero lo dejo para recordarlo por si me vuelve a servir


	$consulta = "
				SELECT idPartido, Fecha, descripcionp, cates.descripcion as DescCate,
				cates.idcategoria as idcat ,cates.setMax CatSetMax, clubAtbl.clubabr as ClubA ,
				 clubBtbl.clubabr as ClubB,CONCAT(clubsede.clubabr,' - ',sedecancha.extras,' - ',cancha.nombre) as cancha,
				 comp.cnombre,comp.Logo as logocompetencia,city.nombre , 
       			TIME_FORMAT(HoraIni, '%H:%i') Inicio , Horafin, ClubARes, ClubBRes,
				sts.descripcion as estado ,
	   			clubAtbl.idclub as idcluba, clubBtbl.idclub as idclubb,
        		setsnmax,ciudad,CanchaId,valTBSet,valFinSet,competencia ,vapppartido.idsede,clubSedePartido,estado as estadoID
				FROM vapppartido
					inner join vappclub clubAtbl on clubAtbl.idclub = ClubA
					inner join vappclub clubBtbl on clubBtbl.idclub = ClubB
					inner join vappcategoria cates on cates.idcategoria = categoria
					inner join vappcomp comp on comp.idcomp = competencia
					inner join vappciudad city on city.idciudad = ciudad

					inner join vappclub clubsede on 
					(clubsede.idclub = vapppartido.clubsedepartido and vapppartido.clubsedepartido > 0)
					or (clubsede.idclub = vapppartido.ClubA and vapppartido.clubsedepartido = 0)
				   
						left join vappsede sedecancha 
									on sedecancha.idsede = vapppartido.idsede 
								and ((sedecancha.idclub = vapppartido.clubsedepartido 
											and vapppartido.clubsedepartido >0 ) OR
									(sedecancha.idclub = vapppartido.ClubA 
										and vapppartido.clubsedepartido = 0 ) 
									)
							left join vappcancha cancha on cancha.idcancha = CanchaId 
										and cancha.idsede = sedecancha.idsede
										and cancha.idclub = clubsede.idclub

					inner join vappestado sts on sts.idestado = estado	WHERE idpartido=$id and Fecha=$fecParm ;"; 
		//echo"<br>--------------------------------------------------------------------------------<br>";
		//		echo($consulta);
		//echo"<br>--------------------------------------------------------------------------------<br>";
        try {
            // Preparar sentencia
		//	$instancia 		= Database::getInstance();
		//	$dbMotor   		=  $instancia->getDb();
		//	$res =  mysqli_query ($dbMotor ,  $consulta);
		//	return $res;
		  //  $comando = $dbMotor->prepare($consulta);
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			// Ejecutar sentencia preparada
            // var_dump([$id, $fecParm]);
	//		$comando->execute([$id,$fecParm]);
			$comando->execute();
            // Capturar primera fila del resultado
			//$row = $comando->fetchAll(PDO::FETCH_ASSOC);
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
	            return ($e->getMessage());
	    }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *	 DEPRECADA
     * 
     */
    public static function update(
    $categoria,$ClubA,$ClubB,
    $CanchaClub, $CanchaSede,$CanchaId,$competencia,
    $ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,
    $Fecha,$idPartido )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE vapppartido" .
            " SET categoria=? , ClubA=?, " . 
            "ClubB=? , CanchaClub=?, CanchaSede=?, CanchaId=? ," .
            "competencia=?, ciudad=? , HoraIni=?, HoraFin=?, " .
            "ClubARes=? , ClubBRes=? " .
            " WHERE Fecha=? and idpartido=? ";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        //return $cmd;
		echo json_encode($cmd);

    }

    /**
     * actualizar el estado de un partido dado
     *
     * @param $idpartido      partido que se quiere actualizar
     * @param $estado nuemero que identifica al estado del partido..
     * @return PDOStatement
     */
   public static function UpdSts($idPartido,$fecha,$estado )
	{
        // Creando consulta UPDATE
        $consulta = "UPDATE vapppartido" .
            " SET estado=$estado " . 
            " WHERE idpartido=$idPartido and Fecha=$fecha";
        //echo($consulta);
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
		//$idPartido,$fecha,$estado 
        $cmd->execute();
        return $cmd;
		
    }
    


    /**
     * actualizar resultado de alguno de los equipos en un partido dado
     *
     * @param $idpartido      partido que se quiere actualizar
     * @param $resultadoA     numero que identifica al estado del partido..
     * @param $resultadoB     numero que identifica al estado del partido..
     * @return PDOStatement
     */
   public static function UpdResultados($idPartido,$fecha,$resultadoA,$resultadoB )
	{
        // Creando consulta UPDATE
			if($resultadoA != 0) $campoREs=	" SET ClubARes=$resultadoA "; 
        	else  $campoREs = " SET ClubBRes=$resultadoB "; 
        	
        	$consulta = "UPDATE vapppartido" .$campoREs.
        		" WHERE idpartido=$idPartido and fecha=$fecha ";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();
        return $cmd;
		//echo json_encode($cmd);
    }


    /**
     * Modificar parametros del partido 
     * @return PDOStatement
     */
    public static function actualiza($idPartido,$Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes ,$setmax,$tbset,$finset,$descripcionp,$idclubSede,$estadoID)
    {
    try {
		$comando = "update vapppartido	".
		" set categoria=$categoria, ClubA=$ClubA, ClubB=$ClubB, CanchaId=$CanchaId, competencia=$competencia, ciudad=$ciudad, idsede=$sedeId, ClubARes=$ClubARes, ClubBRes=$ClubBRes, setsnmax=$setmax,valTBSet=$tbset,valFinSet=$finset ,descripcionp=$descripcionp,clubSedePartido=$idclubSede,estado=$estadoID ".
				" WHERE idpartido=$idPartido and fecha=$Fecha ";

	
		//return $comando;
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute();
        } catch (PDOException $e)
         {
            return ($e->getMessage());
         }  		
    }
	

    public static function actualizaClubSede($idPartido,$Fecha,$idclubSede)
    {
    try {
		$comando = "update vapppartido	".
		" set clubSedePartido=$idclubSede".
				" WHERE idpartido=$idPartido and fecha='$Fecha' ";
//		echo "<br> $comando <br>";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute();
        } catch (PDOException $e)
         {
            return ($e->getMessage());
         }  		
    }


    /**
     * Insertar un nuevo sede
     *
     * @param $idsede      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$estado ,$setmax,$tbset,$finset,$descripcionp,$idclubSede)
    {
    try {
    	$comando = "
			INSERT INTO vapppartido(Fecha, categoria, ClubA, ClubB, CanchaId, competencia,idsede, ciudad, HoraIni, Horafin, ClubARes, ClubBRes, estado, setsnmax,valTBSet,valFinSet,descripcionp,clubSedePartido) ".
		" VALUES (  $Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$estado ,$setmax,$tbset,$finset,$descripcionp,$idclubSede ) " ;    	
	
		//return $comando;
        // Preparar la sentencia
//        echo "$comando";
        
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        // return $sentencia->execute(array($Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$estado ,$setmax,$tbset,$finset,$descripcionp) );
		return $sentencia->execute();
        
        } catch (PDOException $e)
         {
            return ($e->getMessage());
         };
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idsede identificador de la sede
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idpartido,$Fecha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vapppartido WHERE idpartido=$idpartido and Fecha='$Fecha' ";
		//echo $comando; 
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>