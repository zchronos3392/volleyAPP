<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';

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
			inner join vappcancha cancha on cancha.idcancha = CanchaId
				inner join vappsede sedecancha 
		    		on sedecancha.idsede = cancha.idsede
		        		and sedecancha.idclub = cancha.idclub
				inner join vappclub clubsede 
		    		on clubsede.idclub = cancha.idclub
		inner join vappestado sts on sts.idestado = estado 
		ORDER BY Horafin desc, idpartido ";  
		//ORDER BY Fecha desc, idpartido desc";  
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
public static function getAllcparms($icomp, $icate, $iclub, $icity, $fecDde, $fecHta, $fecOrden,$estado)
    {
	
/*TENGO QUE ARMAR EL WHERE DE UNA*/
	$parms ='';
	$parms2='';
	$parms3='';
	$parms4='';
	$parms5='';
	$parms6='';
	$parms7='';
	$parms8=" ORDER BY Fecha , idpartido";
	$parms9='';
	
	If ($icomp <> 9999) {   $parms2 = "(competencia = $icomp)";};
	If ($icate <> 0)    { 	$parms3 = "(categoria = $icate)"; };
	If ($iclub <> 0)    { 	$parms4 = "(ClubA = $iclub)"; };
	If ($icity <> 0 && $icity <> 9999 )    { 	$parms5 = "(ciudad = $icity)"; };
	If ($fecDde <> "''"){ 	$parms6 = "(Fecha >= $fecDde)"; };
	If ($fecHta <> "''"){ 	$parms7 = "(Fecha <= $fecHta)"; };
	If ($fecOrden <> 0) {	$parms8 = " ORDER BY Horafin desc, idpartido"; };
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
				SELECT Fecha, idPartido, cates.descripcion as CatDesc, setsnmax, clubAtbl.clubabr as ClubA , 
				clubBtbl.clubabr as ClubB, 
				CONCAT(clubsede.clubabr,' - ',sedecancha.extras,' - ',cancha.nombre) as cancha, 
				comp.cnombre, city.nombre , TIME_FORMAT(HoraIni, '%H:%i') Inicio , Horafin, 
				ClubARes, ClubBRes, sts.descripcion ,ClubA as idcluba,ClubB as idclubb
				FROM vapppartido
		inner join vappclub clubAtbl on clubAtbl.idclub = ClubA
		inner join vappclub clubBtbl on clubBtbl.idclub = ClubB
		inner join vappcategoria cates on cates.idcategoria = categoria
		inner join vappcomp comp on comp.idcomp = competencia
		inner join vappciudad city on city.idciudad = ciudad
			inner join vappcancha cancha on cancha.idcancha = CanchaId
				inner join vappsede sedecancha 
		    		on sedecancha.idsede = cancha.idsede
		        		and sedecancha.idclub = cancha.idclub
				inner join vappclub clubsede 
		    		on clubsede.idclub = cancha.idclub
		inner join vappestado sts on sts.idestado = estado 
		".$parms.$parms8;
		//" ORDER BY Fecha desc, idpartido desc";  
		//echo $consulta;
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
			inner join vappcancha cancha 
			         on cancha.idcancha = CanchaId
                      and cancha.idclub in (ClubA,ClubB) 
				inner join vappsede sedecancha 
		    		on sedecancha.idsede = cancha.idsede
		        		and sedecancha.idclub = cancha.idclub
				inner join vappclub clubsede 
		    		on clubsede.idclub = cancha.idclub
		inner join vappestado sts on sts.idestado = estado 
		".$parms.$parms8;
		//" ORDER BY Fecha desc, idpartido desc";  
		//echo $consulta;
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
		$consulta = "SELECT ClubARes, ClubBRes FROM vapppartido WHERE idpartido = $idpartido and fecha=$fecha"; 

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
	$comandoID = "SELECT max(idPartido) as idFinal from  vapppartido
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
	
    /**
     * Obtiene los campos de una sede con un identificador
     * determinado
     *
     * @param $idsede Identificador de la sede
     * @return mixed
     */
    public static function getById($idpartido,$fecha )
    {
	// 29-08-2018, ver si aun funciona...    	
	$consulta = "SELECT Fecha, idPartido,descripcionp, cates.descripcion as DescCate,
				cates.idcategoria as idcat ,cates.setMax CatSetMax, clubAtbl.clubabr as ClubA ,
				 clubBtbl.clubabr as ClubB,CONCAT(clubsede.clubabr,' - ',sedecancha.extras,' - ',cancha.nombre) as cancha,comp.cnombre,comp.Logo as logocompetencia,city.nombre , 
       TIME_FORMAT(HoraIni, '%H:%i') Inicio , Horafin, ClubARes, ClubBRes, sts.descripcion as estado ,                clubAtbl.idclub as idcluba, clubBtbl.idclub as idclubb,
        setsnmax,ciudad,CanchaId,valTBSet,valFinSet,competencia ,vapppartido.idsede
				FROM vapppartido
				inner join vappclub clubAtbl on clubAtbl.idclub = ClubA
				inner join vappclub clubBtbl on clubBtbl.idclub = ClubB
				inner join vappcategoria cates on cates.idcategoria = categoria
				inner join vappcomp comp on comp.idcomp = competencia
				inner join vappciudad city on city.idciudad = ciudad
				inner join vappcancha cancha on cancha.idcancha = CanchaId
				inner join vappsede sedecancha on sedecancha.idsede = cancha.idsede 
							and sedecancha.idclub = cancha.idclub
				inner join vappclub clubsede on clubsede.idclub = cancha.idclub
				inner join vappestado sts on sts.idestado = estado
		WHERE idpartido = $idpartido and Fecha=$fecha";
		//echo($consulta);
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idpartido,$fecha));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
           // echo json_encode($row);

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
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
        $cmd->execute(array(
    $categoria,$ClubA,$ClubB,
    $CanchaClub, $CanchaSede,$CanchaId,$competencia,
    $ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,
    $Fecha,$idPartido ));

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
        $cmd->execute(array($idPartido,$fecha,$estado ));
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
        $cmd->execute(array($idPartido,$fecha,$resultadoA,$resultadoB ));
        return $cmd;
		//echo json_encode($cmd);
    }

    /**
     * Modificar parametros del partido 
     * @return PDOStatement
     */
    public static function actualiza($idPartido,$Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes ,$setmax,$tbset,$finset,$descripcionp)
    {
    try {
		$comando = "update vapppartido	".
		" set categoria=$categoria, ClubA=$ClubA, ClubB=$ClubB, CanchaId=$CanchaId, competencia=$competencia, ciudad=$ciudad, idsede=$sedeId, ClubARes=$ClubARes, ClubBRes=$ClubBRes, setsnmax=$setmax,valTBSet=$tbset,valFinSet=$finset ,descripcionp=$descripcionp ".
				" WHERE idpartido=$idPartido and fecha=$Fecha ";

	
		//return $comando;
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($idPartido,$Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes ,$setmax,$tbset,$finset,$descripcionp ));
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
    public static function insert($Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$estado ,$setmax,$tbset,$finset,$descripcionp)
    {
    try {
    	$comando = "INSERT INTO vapppartido(Fecha, categoria, ClubA, ClubB, CanchaId, competencia,idsede, ciudad, HoraIni, Horafin, ClubARes, ClubBRes, estado, setsnmax,valTBSet,valFinSet,descripcionp) ".
		" VALUES (  $Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$estado ,$setmax,$tbset,$finset,$descripcionp ) " ;    	
	
		//return $comando;
        // Preparar la sentencia
//        echo "$comando";
        
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$estado ,$setmax,$tbset,$finset,$descripcionp) );
        
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
        $comando = "DELETE FROM vapppartido WHERE idpartido=$idpartido and Fecha=$Fecha ";
		//echo $comando; 
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idpartido,$Fecha));
    }
}

?>