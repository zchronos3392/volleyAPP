ABMJUGADORES:-moz-anyhttp://localhost/volleyAPP_desa/ABMJugadores.php?MODO=UPD&unjugador=41&ianio=2021&iclubescab=32&icatcab=16

CONTROLAR QUE PASA CUANDO FUNCIONA MAL EL ALTA DEL JUGADOR EN CADA SET:
1 CREAR PARTIDO: CPARTIDOS.PHP, BOTON "ALTA PARTIDO"->#altap, en script css/partido_script.js
2 altap llama a : 
		var parametros = {
        	"fechap" : $("#fechap").val(),
        	"icate" : $("#icate").val(),
        	"iclub" : $("#iclub").val(),
        	"iclubb" : $("#iclubb").val(),
        	"icancha" : $("#icancha").val(),
        	"icomp" : $("#icomp").val(),
        	"icity" : $("#icity").val(),
        	"horai" : $("#horai").val(),
        	"SetMaxCat" : $("#SetMaxCat").val(),
        	"SetMaxComp" : $("#SetMaxComp").val(),
			"valtbset":$("#valtbset").val(),
			"valfinset":$("#valfinset").val(),
			"descripcionp":$("#dscp").val(),
			"ianio":$("#ianio").val()

	};		         
    url:   './abms/insertar_partido.php',
3 INSERTAR PARTIDO: 
	* inserta la cabecera del partido.ok
	* luego, con el anio y el id del partido recien insertado, vamos a agregar por defecto a los jugadores
		 de cada equipo de la categoria del partido.

   	$jugadores = jugador::getJugadorPartidoInsert
   		parametros: ($idpartido,$Fecha,$ClubA,$categoria,$anioEq,$jugador,$categoria); 
	--------------------------------------
	ESTA FUNCION TIENE EL SIGUIENTE QUERY:
	--------------------------------------
    $filtrojugador ="";	
    if($jugador != 0) $filtrojugador = " and vappequipo.idjugador =$jugador";	
	$consulta = " SELECT vappequipo.idclub,vappequipo.categoria,numero,nombre,vappequipo.idjugador,jugp.jugador ,
					pj.puestoxcat puesto ,pj.remeraNum remera
					FROM vappequipo 
					left join vappjugpartido jugp on jugp.idclub = vappequipo.idclub 
												 and jugp.idcategoria = vappequipo.categoria 
												 and jugp.jugador = vappequipo.idjugador
												 and jugp.idpartido=$partido 
												 and jugp.Fecha=$fecha
				       left join vapppuestojugador pj 
				              on pj.idjugador = vappequipo.idjugador 
				             and (pj.pjcategoria = vappequipo.categoria ) 
		 				     and pj.idclub = vappequipo.idclub and pj.anioEquipo = vappequipo.anioEquipo				             
					where vappequipo.idclub = $club and 
					      vappequipo.categoria = $categoria and 
					      vappequipo.anioEquipo =$anio 
					      $filtrojugador ";
	// ESTO ESTA ANDANDO BIEN, TRAYENDO LOS JUGADORES QUE SON DE ESA CATEGORIA..
	// SI ESTAN CARGADOS Y CON UN PUESTO CARGADO TAMBIEN PARA TENER LA REMERA DE LA CATEGORIA..					      
	LUEGO INSERTAMOS A LOS JUGADORES POR DEFECTO : 
	partjugCab::insert
		for($contador=0; $contador < count($jugadores);$contador++ )
		{ // recorro vector de jugadores del equipo A
				$jugadorJuega = $jugadores[$contador]['idjugador']; 
				$puesto = $jugadores[$contador]['puesto'];
				$mensajeAlta = "'".$mensajePre." INSERTAR_SETS::INSERT jugadores default club Local' ";
				$retornoCat = partjugCab::insert($idpartido,$Fecha,$ClubA,$categoria,$jugadorJuega,$puesto,$mensajeAlta);
				//echo "<br>$retornoCat<br>";
		};
	+tabla: vappjugpartidocab
	+ VERIFICAMOS QUE SE HAYA DADO DE ALTA A LOS JUGADORES POR DEFECTO EN LA BASE DE JUG PARTIDO CABECERA
----------------------------------------------------------------------------------------------------
VAMOS A ENTRAR A CREAR SET....		 
CUANDO LLEGAMOS A CSETS2, tenemos la opcion CREAR NUEVO SET :
previamente, chequeamos que hayan jugadores seleccionados en cada equipo, lo que significa
que se grabó bien en la tabla vappjugpartidocab, DE LA QUE SACAREMOS AL EQUIPO AL CREAR CADA SET.
-----------------------------------------------------------------
CSETS::function crearSet()::/abms/insertar_sets.php'
 parms: 
	"idpartido" : <?php echo($_GET['id']); ?>,
	"idset"     : $("#numerosetNuevo").val(),
	"resa"      : 0,
	"resb"      : 0,
	"fechas"    : <?php echo("'".$_GET['fecha'])."'"; ?>,
	"horas"     : $("#stopwatch").text(),
	"saque"     : 0,
	"anioEquipo": $("#ianio").val() ,
	"mensajeAlta" : 'Csets2::CrearSet',
	"COPIARJUGADORES":	1 
  $jugsA = partjug::getJugSetLoad($idpartido,$fecha2,$clublocalA,$anioEq,$setnumero);
http://localhost/volleyAPP_desa/CSets2.php?id=4&setmax=5&fecha=2021-03-20	
	SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,vappjugpartido.idclub,vappjugpartido.posicion,vappjugpartido.Libero,ptos.puestoxcat,
					vappjugpartido.secuencia
				 FROM vappjugpartido
               inner join vappequipo eq
               on eq.idclub = vappjugpartido.idclub
                  and eq.idjugador = vappjugpartido.jugador    
                left JOIN vapppuestojugador ptos
                   on ptos.idjugador = eq.idjugador
                   and ptos.pjcategoria = eq.categoria
                    and ptos.idclub = eq.idclub
                    and ptos.anioEquipo = eq.anioEquipo                   
                WHERE vappjugpartido.idpartido=4  and eq.anioEquipo=2021 and vappjugpartido.Fecha='2021-03-20' 
                and vappjugpartido.idclub=83 and (vappjugpartido.setnumero=1)
					and entraSale <> 99
NO DEVUELVE NADA EN EL PRIMER SET...ver los otros..
------------------------------------------------------------------
------------------------------------------------------------------
luego vamos a CARGARPOSICIONES:
------------------------------------------------------------------

$("#cargaSetjugadores").on("click")
PARMS: 
	var parametros =
		{
	    "idpartido" : $.urlParam('idpartido'),
		"iclub" : $.urlParam('idclub'),
		"fechapartido": $.urlParam('fecha'),
		"setdata" : $.urlParam('set'),
		"ianio"   : $("#ianio").val(),
		"categoria" : $.urlParam('idcate')
		};

  LLAMA A './abms/insertar_jugadores_sets.php',
recibe:
	$idpartido = (int) $_POST['idpartido'];
	$setnumero =  (int) $_POST['setdata'];
	$anioEq = 0 ;
	$anioEq =  (int) $_POST['ianio'];
	$clublocal = (int) $_POST['iclub'];
	$fecha2 = "'".$_POST['fechapartido']."'";
	$icategoriaPartido = (int) $_POST['categoriapartido'];
Y BUSCA LA LISTA INICIAL DE JUGADORES:
$jugsA = partjugCab::getJugListaInicio($idpartido,$fecha2,$clublocal,$anioEq,$icategoriaPartido);
QUERY:
SELECT eq.numero as 'EQ.NUM',eq.nombre as 'EQ.NOM',eq.categoria as 'EQ.CAT',eq.idjugador as 'EQ.IDJUG',
		vappjugpartidocab.idclub as 'VAPPJPAERTIDCAB.CLUB',vappjugpartidocab.jugador as 'VAPPJPAERTIDCAB.JUGADOR',
		vappjugpartidocab.posicion as 'VAPPJPAERTIDCAB.POS', 
		ptos.puestoxcat as 'PUESTOS.PUESTO EN CAT',ptos.remeraNum as 'PUESTOS.REMERA EN CAT'
	 FROM vappequipo eq
   	 right join	vappjugpartidocab
   			on vappjugpartidocab.idclub = eq.idclub 
      			and vappjugpartidocab.jugador = eq.idjugador
      			and vappjugpartidocab.idpartido=4	
      			and vappjugpartidocab.Fecha='2021-03-20'
                and vappjugpartidocab.entraSale=99
    left JOIN vapppuestojugador ptos
       	on ptos.idjugador = eq.idjugador
        and ptos.pjcategoria = 16
        and ptos.idclub = eq.idclub
        and ptos.anioEquipo = eq.anioEquipo                    
    WHERE 
    eq.idclub=83
	and eq.anioEquipo=2021
/*PARA CONSULTAR EL QUERY	$consulta = "SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,
					vappjugpartidocab.idclub,vappjugpartidocab.jugador,vappjugpartidocab.posicion, 
					ptos.puestoxcat
				 FROM vappequipo eq
               	 right join	vappjugpartidocab
               			on vappjugpartidocab.idclub = eq.idclub 
                  			and vappjugpartidocab.jugador = eq.idjugador
                  			and vappjugpartidocab.idpartido=$partido	
                  			and vappjugpartidocab.Fecha=$fecha
                            and vappjugpartidocab.entraSale=99
                left JOIN vapppuestojugador ptos
                   	on ptos.idjugador = eq.idjugador
                    and ptos.pjcategoria = $icategoriaPartido
                    and ptos.idclub = eq.idclub
                    and ptos.anioEquipo = eq.anioEquipo                    
                WHERE 
                eq.idclub=$iclub
				and eq.anioEquipo=$ianioe  ";
*/


ERROR DEL QUERY: cambiarlo a RIGHT JOIN LO ARREGLA, PERO EN REALIDAD NO SE ESTAN ASOCIANDO
CORRECTAMENTE LOS JUGADORES QUE SON DE OTRA CATEGORIA DESDE CARGARJUGADORES:
---------------------------------------------------------------
* CARGARJUGADORES::CHECKBOX.CLICK::
      "INSERTAR"
	      ./abms/insertar_jugador_partido.php
parametros, procesados: 
	$partido =	$_POST["idpartido"];
	$fecha	 =	"'".$_POST["fechapartido"]."'";
	$iclub	 =	$_POST["iclubescab"];
	$icate 	 =	$_POST["icatcab"];
	$jugador =	$_POST["idjugador"];
	//necesito la psicion y traer el año !!: 
	$anioEq = $_POST["ianio"];

Estaba trayendo todos los jugadores para dar de alta, no solo el que necesitabamos...
se agrego el jugador cliqueado especifico y la remera..
    and vappequipo.idjugador =96
SELECT vappequipo.idclub,vappequipo.categoria,numero,nombre,vappequipo.idjugador,
      jugp.jugador ,pj.puestoxcat puesto ,pj.remeraNum remera
    FROM vappequipo 
        left join vappjugpartido jugp 
          on jugp.idclub = vappequipo.idclub 
         and jugp.idcategoria = vappequipo.categoria 
         and jugp.jugador = vappequipo.idjugador 
         and jugp.idpartido=4 
         and jugp.Fecha='2021-03-20' 
        left join vapppuestojugador pj 
           on pj.idjugador = vappequipo.idjugador 
          and (pj.pjcategoria = vappequipo.categoria or pj.pjcategoria = 16) 
          and pj.idclub = vappequipo.idclub 
          and pj.anioEquipo = vappequipo.anioEquipo 
where vappequipo.idclub = 83 
	and vappequipo.categoria = 6 
	and vappequipo.anioEquipo =2021
    and vappequipo.idjugador =96
    
AL INSERTAR, ARMA BIEN EL QUERY, PERO EN ALGUN MOMENTO DABA CLAVE DUPLICADA Y MAMBEABA
INSERT INTO vappjugpartidocab 
        (idpartido,Fecha,idclub,idcategoria,jugador,puesto,mensajeAltaCab ) 
VALUES ( 4,'2021-03-20',83,6,96,'4',' insertar_jugador_partido::AGREGA JUGADOR DE OTRA CATEGORIA' )

INSERT INTO vappjugpartidocab 
        (idpartido,Fecha,idclub,idcategoria,jugador,puesto,mensajeAltaCab ) 
VALUES ( 4,'2021-03-20',83,6,96,'3',' insertar_jugador_partido::AGREGA JUGADOR DE OTRA CATEGORIA' )

INSERT INTO vappjugpartidocab 
        (idpartido,Fecha,idclub,idcategoria,jugador,puesto,mensajeAltaCab ) 
VALUES ( 4,'2021-03-20',83,6,96,'3',' insertar_jugador_partido::AGREGA JUGADOR DE OTRA CATEGORIA' )

( ! ) Fatal error: Uncaught PDOException: SQLSTATE[23000]: 
     Integrity constraint violation: 1062 Duplicate entry '4-2021-03-20-83-6-96-99-3' 
        for key 'PRIMARY' in C:\wamp64\www\volleyAPP_desa\abms\JugadorPartidoCab.php on line 212
( ! ) PDOException: SQLSTATE[23000]: Integrity constraint violation: 1062 
         Duplicate entry '4-2021-03-20-83-6-96-99-3' 
         for key 'PRIMARY' in C:\wamp64\www\volleyAPP_desa\abms\JugadorPartidoCab.php on line 212
Call Stack
#	Time	Memory	Function	Location
1	0.0000	409040	{main}( )	...\insertar_jugador_partido.php:0
2	0.0060	451360	partjugCab::insert( )	...\insertar_jugador_partido.php:34
3	0.0060	452984	execute ( )	...\JugadorPartidoCab.php:212





cargarjugadores
http://localhost/volleyAPP_desa/CargarJugadores.php?idpartido=4&setmax=5&idclub=83&fecha=2021-03-20&idcate=16
  http://localhost/volleyAPP_desa/abms/obtener_jugpartidoCab.php?idpartido=4&iclubescab=83&icatcab=6&ianio=2021&fechapartido=2021-03-20
  ESTA FUNCION OBTENER_JUGPARTIDOCAB TIENE QUE SER IGUAL A OBTENER_JUGPARTIDO2
    partjugCab::getJugListaInicial($partido,$fecha,$iclub,$icate,$ianio);
    Query:
	SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador, vappjugpartidocab.idclub,
	       vappjugpartidocab.jugador,vappjugpartidocab.posicion, ptos.puestoxcat 
	FROM vappequipo eq 
	   left join vappjugpartidocab 
	      on vappjugpartidocab.idclub = eq.idclub 
	     and vappjugpartidocab.jugador = eq.idjugador 
	     and vappjugpartidocab.idpartido=4 
	     and vappjugpartidocab.Fecha='2021-03-20' 
	     and vappjugpartidocab.entraSale=99 
	    left JOIN vapppuestojugador ptos 
	       on ptos.idjugador = eq.idjugador 
	      and ptos.pjcategoria = eq.categoria 
	      and ptos.idclub = eq.idclub 
	      and ptos.anioEquipo = eq.anioEquipo 
WHERE eq.idclub=83 and eq.anioEquipo=2021 and eq.categoria=6

ADMINITRAR APP:
function BorrarPartido(idpartido,fechapartido)
     './abms/borrar_partido.php',

$retorno  = Partido::delete($idpartido,$fecha); ANDA
select * FROM vapppartido WHERE idpartido=4 and Fecha='2021-03-20'
        DELETE FROM vapppartido WHERE idpartido=4 and Fecha='2021-03-20'
select * FROM vappset WHERE idpartido=4 and Fecha='2021-03-20'
		DELETE FROM vappset WHERE idpartido=4 and Fecha='2021-03-20'
$retorno2 = Sett::deleteAll($idpartido,$fecha);  ANDA
	SE MANDABA LA FECHA CON '' Y YA VIENE ASI POR PARAMETROS...
$retorno3 = partjug::deleteAll($idpartido,$fecha); NO ANDA
select * FROM vappjugpartido WHERE idpartido=4 and Fecha='2021-03-20'
		DELETE FROM vappjugpartido WHERE idpartido=4 and Fecha='2021-03-20'
select * FROM vappjugpartidocab WHERE idpartido=4 and Fecha='2021-03-20'
$retorno3 = partjugCab::deleteAllJPCab($idpartido,$fecha); NO ANDA..
        DELETE FROM vappjugpartidocab WHERE idpartido=4 and Fecha='2021-03-20'
select * FROM vapprotaciones	WHERE idpartido=4 and Fecha='2021-03-20'     
	$retorno4 = Rotaciones::deleteAll($idpartido,$fecha);    NO ANDA
		DELETE FROM vapprotaciones	WHERE idpartido=4 and Fecha='2021-03-20'     
     
insertar jugadores, en SET:
INSERT INTO vappset (idpartido, secuencia, setnumero, fecha, hora, 1A, 2A, 3A, 4A, 5A, 6A, 
    1B, 2B, 3B, 4B, 5B, 6B, estado, puntoa, puntob,saque,mensaje,CantPausaA,CantPausaB)  
VALUES (  4, 2, 1, '2021-03-20','2021-03-20 00:15:18',140,138,141,139,136,137,41,43,44,45,46,47,5,0, 0,83,'Confirmando posiciones en planilla...',2,2 )      