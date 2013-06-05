<?php
    //NUEVA CONEXION
    function nuevaConexionBd(){
        $conexion=mysql_connect('localhost','adminImpact','adminImpact')or die("error a la conexión de la BD");
        $select=mysql_select_db('PROYECTO',$conexion)or die("error al seleccionar la BD");
    }
            
    //CREAR SESION
    function crearSesion($nick){
	session_start();
	$_SESSION['usuario']=$nick;
	$_SESSION['rol']="registrado";
    }
    
    //CREAR ACCESO
    function crearAcceso($nick){
	$fecha=fechaHora();
	$idUsuario=extraerIdUsuario($nick);
	nuevaConexionBd();
	$consulta="INSERT INTO ACCESO (FECHA, ID_USUARIO, NICK) VALUES ('$fecha', '$idUsuario', '$nick');";
	mysql_query($consulta);
    }
    
    //CONSEGUIR FECHA Y HORA DE ACCESO
    function fechaHora(){
	return date("Y-m-d H:i:s");
    }
    
    //CONSEGUIR ID DEL USUARIO
    function extraerIdUsuario($nick){
	nuevaConexionBd();
	$id;
	$consulta="SELECT ID_USUARIO FROM USUARIOS WHERE NICK='$nick';";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
	    $id=$fila[0];
	}
	return $id;
    }
    
    //OBTENER TODOS LOS DATOS DEL USUARIO
    function obtenerTodoUsuario($id){
	nuevaConexionBd();
	$datos=array();
	$consulta="SELECT U.NICK, D.NOMBRE, D.APELLIDOS, D.TELEFONO, D.EMAIL, D.CIUDAD, D.DIRECCION, D.COD_POSTAL, D.PAIS, D.FECHA_NAC, D.SEXO, D.N_TARJETA
	FROM USUARIOS U, DATOS D
	WHERE U.ID_USUARIO=D.ID_USUARIO
	AND U.ID_USUARIO='$id';";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
	    $datos['nick']=$fila[0];
	    $datos['nombre']=$fila[1];
	    $datos['apellidos']=$fila[2];
	    $datos['telefono']=$fila[3];
	    $datos['email']=$fila[4];
	    $datos['ciudad']=$fila[5];
	    $datos['direccion']=$fila[6];
	    $datos['cod_postal']=$fila[7];
	    $datos['pais']=$fila[8];
	    $datos['f_nac']=$fila[9];
	    $datos['sexo']=$fila[10];
	    $datos['n_tarjeta']=$fila[11];
	}
	return $datos;
    }
    
	//OBTENER MAIL USUARIO
	function obtenerMail($id){
	nuevaConexionBd();
	$mail="";
	$consulta="SELECT EMAIL FROM DATOS WHERE ID_USUARIO='$id';";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
	    $mail=$fila[0];
	}
	return $mail;
    }
	
	//OBTENER DESCRIPCION PELICULA
	function obtenerDescPeli($id){
		nuevaConexionBd();
		$peli=array();
		$consulta="SELECT titulo, descripcion, imagen, precio, duracion, anio FROM peliculas WHERE id_pelicula='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$peli['titulo']=$fila[0];
			$peli['desc']=$fila[1];
			$peli['imagen']=$fila[2];
			$peli['prec']=$fila[3];
			$peli['durac']=$fila[4];
			$peli['anio']=$fila[5];
		}
		return $peli;
	}
	//OBTENER TODO PELICULA
	function obtenerTodoPelicula($id){
		nuevaConexionBd();
		$peli=array();
		$consulta="SELECT * FROM peliculas WHERE id_pelicula='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$peli['titulo']=$fila[1];
			$peli['critica']=$fila[3];
			$peli['anio']=$fila[4];
			$peli['duracion']=$fila[5];
			$peli['director']=$fila[6];
			$peli['pais']=$fila[7];
			$peli['imagen']=$fila[8];
			$peli['video']=$fila[9];
			$peli['estreno']=$fila[10];
			$peli['precio']=$fila[11];
		}
		return $peli;
	}
	//OBTENER ID GENEROS
	function obtenerGeneros($id){
		nuevaConexionBd();
		$generos=array();
		$i=0;
		$consulta="SELECT ID_GENERO FROM GEN_PEL WHERE id_pelicula='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$generos[$i]=$fila[0];
			$i++;
		}
		return $generos;
	}
	//OBTENER nombre GENEROS
	function obtenerNombreGeneros($id){
		nuevaConexionBd();
		$nombre="";
		$i=0;
		$consulta="SELECT NOM_GENERO FROM GENEROS WHERE ID_GENERO='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$nombre=$fila[0];
		}
		return $nombre;
	}
	//OBTENER TODOS LOS GENEROS CON SU ID
	function obtenerTodoGeneros(){
	    nuevaConexionBd();
	    $consulta="SELECT * FROM GENEROS ORDER BY NOM_GENERO;";
	    $resultado=mysql_query($consulta) or die("Ha fallado la consulta de los generos y sus ids por el siguiente error: ".mysql_error()."<br/>");
	    return $resultado;
	}
	
	//OBTENER ID ACTOR
	function obtenerActores($id){
		nuevaConexionBd();
		$actores=array();
		$i=0;
		$consulta="SELECT ID_ACTOR FROM ACTUA WHERE ID_PELICULA ='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$actores[$i]=$fila[0];
			$i++;
		}
		return $actores;
	}
	//OBTENER NOMBRE ACTOR
	function obtenerNombreActor($id){
		nuevaConexionBd();
		$actor="";
		$consulta="SELECT NOMBRE_APE FROM ACTORES WHERE ID_ACTOR='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$actor=$fila[0];
			}
		return $actor;
	}
	//OBTENER ID Y NOMBRE DE TODOS LOS ACTORES ORDENADOS ALFABETICAMENTE
	function obtenerNombreIdActores(){
	    nuevaConexionBd();
	    $consulta="SELECT ID_ACTOR, NOMBRE_APE FROM ACTORES ORDER BY NOMBRE_APE;";
	    $resultado=mysql_query($consulta) or die("No se pueden obtener los actores por el siguiente error: ".mysql_error()."<br/>");
	    return $resultado;
	}
	//OBTENER DESCRIPCION PELICULA
	function obtenerDescActor($id){
		nuevaConexionBd();
		$actor=array();
		$consulta="SELECT nombre_ape, descripcion, imagen, fecha_nac FROM actores WHERE id_actor='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$actor['nombre']=$fila[0];
			$actor['desc']=$fila[1];
			$actor['imagen']=$fila[2];
			$actor['f_nac']=$fila[3];
		}
		return $actor;
	}
	//OBTENER TODO ACTOR
	function obtenerTodoActor($id){
		nuevaConexionBd();
		$actor=array();
		$consulta="SELECT * FROM ACTORES WHERE ID_ACTOR='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$actor['nombre']=$fila[1];
			$actor['pais']=$fila[2];
			$actor['anio']=$fila[3];
			$actor['carrera']=$fila[5];
			$actor['imagen']=$fila[6];
			
		}
		return $actor;
	}
	//OBTENER ID PELICULA
	function obtenerPeliculas($id){
		nuevaConexionBd();
		$peliculas=array();
		$i=0;
		$consulta="SELECT ID_PELICULA FROM ACTUA WHERE ID_ACTOR ='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$peliculas[$i]=$fila[0];
			$i++;
		}
		return $peliculas;
	}
	//OBTENER NOMBRE PELICULA
	function obtenerNombrePelicula($id){
		nuevaConexionBd();
		$peli="";
		$consulta="SELECT TITULO FROM PELICULAS WHERE ID_PELICULA='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$peli=$fila[0];
			}
		return $peli;
	}
	
	//OBTENER ID Y NOMBRE DE TODAS LAS PELICULAS ORDENADAS POR TITULO DE PELICULA
	function obtenerNombreIdPeliculas(){
	    nuevaConexionBd();
	    $consulta="SELECT ID_PELICULA, TITULO FROM PELICULAS ORDER BY TITULO;";
	    $resultado=mysql_query($consulta) or die("No se pueden obtener las peliculas por el siguiente error: ".mysql_error()."<br/>");
	    return $resultado;
	}
	//OBTENER DESCRIPCION NOTICIA
	function obtenerDescNoticia($id){
		nuevaConexionBd();
		$noti=array();
		$consulta="SELECT titulo, descripcion, imagen FROM noticias WHERE id_noticia='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$noti['titulo']=$fila[0];
			$noti['desc']=$fila[1];
			$noti['imagen']=$fila[2];
		}
		return $noti;
	}
	//OBTENER TODO NOTICIA
	function obtenerTodoNoticia($id){
		nuevaConexionBd();
		$noti=array();
		$consulta="SELECT * FROM NOTICIAS WHERE ID_NOTICIA='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$noti['titulo']=$fila[1];
			$noti['desc']=$fila[2];
			$noti['t_not']=$fila[3];
			$noti['imagen']=$fila[4];
			$noti['video']=$fila[5];
			$noti['fecha']=$fila[6];
			$noti['id_pel']=$fila[7];
			$noti['id_act']=$fila[8];
		}
		return $noti;
	}
	// OBTENER NICK USUARIO
	function obtenerNickUsuario($id){
		nuevaConexionBd();
		$nick="";
		$consulta="SELECT nick FROM usuarios WHERE id_usuario='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$nick=$fila[0];
		}
		return $nick;
	}
	// OBTENER COMENTARIOS
	function obtenerComentarios($id){
		nuevaConexionBd();
		$coment=array();
		$consulta="SELECT CO.FECHA_COMENT, CO.COMENTARIO, US.NICK, CO.ID_COMENTARIO FROM COMENTARIOS AS CO LEFT JOIN USUARIOS AS US ON CO.ID_USUARIO = US.ID_USUARIO WHERE ID_PELICULA ='$id';";
		$resultado=mysql_query($consulta);
		$i=0;
		while($fila=mysql_fetch_array($resultado)){
			$coment[$i]['fecha']=$fila[0];
			$coment[$i]['coment']=$fila[1];
			$coment[$i]['nick']=$fila[2];
			$coment[$i]['id']=$fila[3];
			$i++;
		}
		return $coment;
	}
	//CORRECTO
	function correcto(){
			$mensaje="Usuario registrado con exito";
			//include 'respuesta.php';
			header("Location:respuesta.php?txt=$mensaje");
			//header('refresh:3; url=http://localhost:8080/proyecto/index.php');
	}
	
    //FUNCION PARA MODIFICAR LOS DATOS DE LOS ACTORES Y LAS PELICULAS EN LAS QUE APARECE
    function modificarActores($idActor, $imagen, $nombreApe, $fechaConvertida, $nacionalidad, $carrera, $pel){
	nuevaConexionBd();
	/*
	*MOSTRAR LOS DATOS QUE RECIBE A MODO DE PRUEBA
	echo "Id del actor/a: ".$idActor."<br/><br/>";
	echo "Nombre de la imagen: ".$imagen."<br/><br/>";
	echo "Nombre: ".$nombreApe."<br/><br/>";
	echo "Fecha: ".$fechaConvertida."<br/><br/>";
	echo "Nacionalidad ".$nacionalidad."<br/><br/>";
	echo "Carrera: <br/>";
	echo $carrera."<br/><br/>";
	echo "Peliculas: <br/><br/>";
	for($j=0;$j<count($pel);$j++){
	    echo $pel[$j]."<br/>";
	}*/

	$consulta="UPDATE ACTORES SET NOMBRE_APE='$nombreApe', NACIONALIDAD='$nacionalidad', FECHA_NAC='$fechaConvertida', DESCRIPCION='$carrera', CARRERA='$carrera', IMAGEN='$imagen' WHERE ID_ACTOR='$idActor';";
	$resultado=mysql_query($consulta) or die("Ha fallado la modificación de los datos del actor por el siguiente error: ".mysql_error()."<br/>");
	
	$consulta="DELETE FROM ACTUA WHERE ID_ACTOR='$idActor';";
	$resultado=mysql_query($consulta) or die("Ha fallado la sentencia de borrado en la tabla actua para posteriormente asignar peliculas al actor por el siguiente error: ".mysql_error()."<br/>");
	
	for($i=0;$i<count($pel);$i++){
	    $consulta="INSERT INTO ACTUA (ID_ACTOR, ID_PELICULA) VALUES ('$idActor', '$pel[$i]');";
	    $resultado=mysql_query($consulta) or die("Ha fallado la sentencia de inserción en la tabla actua para asignar peliculas al actor por el siguiente error: ".mysql_error()."<br/>");
	}
	
	header("Location: verActor.php?parametro=".$idActor."");
    }
    
    function modificarPeliculas($idPelicula, $titulo, $estreno, $anio, $duracion, $director, $pais, $gen, $act, $criticaConvertida, $trailer, $precio, $imagen){
	nuevaConexionBd();
	/*
	*MOSTRAR LOS DATOS QUE RECIBE A MODO DE PRUEBA
	echo "Id de la pelicula: ".$idPelicula."<br/><br/>";
	echo "Titulo: ".$titulo."<br/><br/>";
	echo "Estreno: ".$estreno."<br/><br/>";
	echo "Año: ".$anio."<br/><br/>";
	echo "Duracion ".$duracion."<br/><br/>";
	echo "Director: ".$director."<br/><br/>";
	echo "Pais: ".$pais."<br/><br/>";
	echo "Critica: ".$criticaConvertida."<br/><br/>";
	echo "Trailer: ".$trailer."<br/><br/>";
	echo "Precio: ".$precio."<br/><br/>";
	echo "Generos elegidos: <br/>";
	for($j=0;$j<count($gen);$j++){
	    echo $gen[$j]."<br/>";
	}
	echo "<br/><br/>";
	echo "Actores elegidos: <br/>";
	for($j=0;$j<count($act);$j++){
	    echo $act[$j]."<br/>";
	}*/
	
	$consulta="UPDATE PELICULAS SET TITULO='$titulo', DESCRIPCION='$criticaConvertida', CRITICA='$criticaConvertida', ANIO='$anio', DURACION='$duracion', DIRECTOR='$director', PAIS='$pais', VIDEO='$trailer', ESTRENO='$estreno', PRECIO='$precio', IMAGEN='$imagen' WHERE ID_PELICULA='$idPelicula';";
	$resultado=mysql_query($consulta) or die("Ha fallado la sentencia de modificación de los datos de la pelicula por el siguiente error: ".mysql_error()."<br/>");
	
	$consulta="DELETE FROM GEN_PEL WHERE ID_PELICULA='$idPelicula';";
	$resultado=mysql_query($consulta) or die("Ha fallado la sentencia de borrado de los generos para posteriormente volver a asignar los nuevos por el siguiente error: ".mysql_error()."<br/>");
	
	for($i=0;$i<count($gen);$i++){
	    $consulta="INSERT INTO GEN_PEL (ID_GENERO, ID_PELICULA) VALUES ('$gen[$i]', '$idPelicula');";
	    $resultado=mysql_query($consulta) or die("Ha fallado la sentencia de inserción en la tabla gen_pel para asignar los generos a la pelicula por el siguiente error: ".mysql_error()."<br/>");
	}
	
	$consulta="DELETE FROM ACTUA WHERE ID_PELICULA='$idPelicula';";
	$resultado=mysql_query($consulta) or die("Ha fallado la sentencia de borrado de los actores relacionados con la pelicula para posteriormente volver a asignar los nuevos actores por el siguiente error: ".mysql_error()."<br/>");
	
	for($i=0;$i<count($act);$i++){
	    $consulta="INSERT INTO ACTUA (ID_ACTOR, ID_PELICULA) VALUES ('$act[$i]', '$idPelicula');";
	    $resultado=mysql_query($consulta) or die("Ha fallado la sentencia de inserción en la tabla actua para asignar los actores a la pelicula por el siguiente error: ".mysql_error()."<br/>");
	}
	
	header("Location: verPelicula.php?parametro=".$idPelicula."");
    }
    
    function modificarNoticias($idNoticia, $titulo, $fecha, $descripcion, $noticia, $actor, $pelicula, $imagen){
	nuevaConexionBd();
	/*
	*MOSTRAR LOS DATOS QUE RECIBE A MODO DE PRUEBA
	echo "Id de la noticia: ".$idNoticia."<br/><br/>";
	echo "Titulo: ".$titulo."<br/><br/>";
	echo "Fecha: ".$fecha."<br/><br/>";
	echo "Descripcion: ".$descripcion."<br/><br/>";
	echo "Noticia: ".$noticia."<br/><br/>";
	echo "Actor: ".$actor."<br/><br/>";
	echo "Pelicula: ".$pelicula."<br/><br/>";*/
	
	if(empty($pelicula) && empty($actor)){
	    $consulta="UPDATE NOTICIAS SET TITULO='$titulo', DESCRIPCION='$descripcion', TEXTO_NOTICIA='$noticia', FECHA='$fecha', ID_PELICULA=null, ID_ACTOR=null, IMAGEN='$imagen' WHERE ID_NOTICIA='$idNoticia';";
	    $resultado=mysql_query($consulta) or die("Ha fallado la actualización de datos de la noticia por el siguiente error: ".mysql_error()."<br/>");
	}
	else{
	    if(empty($pelicula)){
		$consulta="UPDATE NOTICIAS SET TITULO='$titulo', DESCRIPCION='$descripcion', TEXTO_NOTICIA='$noticia', FECHA='$fecha', ID_PELICULA=null, ID_ACTOR='$actor', IMAGEN='$imagen' WHERE ID_NOTICIA='$idNoticia';";
		$resultado=mysql_query($consulta) or die("Ha fallado la actualización de datos de la noticia por el siguiente error: ".mysql_error()."<br/>");
	    }
	    else{
		if(empty($actor)){
		    $consulta="UPDATE NOTICIAS SET TITULO='$titulo', DESCRIPCION='$descripcion', TEXTO_NOTICIA='$noticia', FECHA='$fecha', ID_PELICULA='$pelicula', ID_ACTOR=null, IMAGEN='$imagen' WHERE ID_NOTICIA='$idNoticia';";
		$resultado=mysql_query($consulta) or die("Ha fallado la actualización de datos de la noticia por el siguiente error: ".mysql_error()."<br/>");
		}
		else{
		    $consulta="UPDATE NOTICIAS SET TITULO='$titulo', DESCRIPCION='$descripcion', TEXTO_NOTICIA='$noticia', FECHA='$fecha', ID_PELICULA='$pelicula', ID_ACTOR='$actor', IMAGEN='$imagen' WHERE ID_NOTICIA='$idNoticia';";
		    $resultado=mysql_query($consulta) or die("Ha fallado la actualización de datos de la noticia por el siguiente error: ".mysql_error()."<br/>");
		}
	    }
	}
	
	header("Location: verNoticia.php?parametro=".$idNoticia."");
    }
    
    function insertarActor($nombreApe, $nacionalidad, $fechaConvertida, $pel, $carrera, $nombreImagen){
	/*echo "NOMBRE: ".$nombreApe."<br/><br/>";
	echo "NACIONALIDAD: ".$nacionalidad."<br/><br/>";
	echo "FECHA DE NACIMIENTO: ".$fechaConvertida."<br/><br/>";
	echo "PELICULAS EN LAS QUE APARECE: <br/>";
	for($j=0;$j<count($pel);$j++){
	    echo $pel[$j]."<br/>";
	}
	echo "<br/>";
	echo "CARRERA: <br/>";
	echo $carrera;
	echo "<br/><br/>";
	echo $nombreImagen;*/
	
	nuevaConexionBd();
	$consulta="INSERT INTO ACTORES (NOMBRE_APE, NACIONALIDAD, FECHA_NAC, DESCRIPCION, CARRERA, IMAGEN) VALUES ('$nombreApe', '$nacionalidad', '$fechaConvertida', '$carrera', '$carrera', '$nombreImagen');";
	$resultado=mysql_query($consulta) or die("Ha fallado la insercion del actor por el siguiente error: ".mysql_error()."<br/>");
	
	
	if(!empty($pel)){
	    $idActor="";
	    $consulta="SELECT ID_ACTOR FROM ACTORES WHERE NOMBRE_APE='$nombreApe';";
	    $resultado=mysql_query($consulta) or die("Ha fallado la consulta para recuperar el id del actor recien insertado por el siguiente error: ".mysql_error()."<br/>");
	    while($fila=mysql_fetch_array($resultado)){
		$idActor=$fila[0];
	    }
	    
	    for($j=0;$j<count($pel);$j++){
		$consulta="INSERT INTO ACTUA (ID_ACTOR, ID_PELICULA) VALUES ('$idActor', '$pel[$j]');";
		$resultado=mysql_query($consulta) or die("Ha fallado la insercion para asignarle peliculas a un actor recien insertado por el siguiente error: ".mysql_error()."<br/>");
	    }
	}
	
	header("Location: verActores.php");
    }
    
    function insertarPelicula($titulo, $pais, $anio, $duracion, $director, $trailer, $precio, $estreno, $act, $criticaConvertida, $nombreCartel, $gen){
	/*echo "TITULO: ".$titulo."<br/><br/>";
	echo "PAIS: ".$pais."<br/><br/>";
	echo "AÑO: ".$anio."<br/><br/>";
	echo "DURACION: ".$duracion."<br/><br/>";
	echo "DIRECTOR: ".$director."<br/><br/>";
	echo "TRAILER: ".$trailer."<br/><br/>";
	echo "PRECIO: ".$precio."<br/><br/>";
	echo "ESTRENO: ".$estreno."<br/><br/>";
	echo "ACTORES DE ESTA PELICULA: <br/>";
	for($j=0;$j<count($act);$j++){
	    echo $act[$j]."<br/>";
	}
	echo "<br/>";
	echo "CRITICA: <br/>";
	echo $criticaConvertida;
	echo "<br/><br/>";
	echo "NOMBRE DEL CARTEL: ".$nombreCartel;*/
	
	nuevaConexionBd();
	$consulta="INSERT INTO PELICULAS (TITULO, DESCRIPCION, CRITICA, ANIO, DURACION, DIRECTOR, PAIS, IMAGEN, VIDEO, ESTRENO, PRECIO) VALUES ('$titulo', '$criticaConvertida', '$criticaConvertida', '$anio', '$duracion', '$director', '$pais', '$nombreCartel', '$trailer', '$estreno', '$precio');";
	$resultado=mysql_query($consulta) or die("Ha fallado la insercion de la pelicula por el siguiente error: ".mysql_error()."<br/>");
	
	$consulta="SELECT ID_PELICULA FROM PELICULAS WHERE TITULO='$titulo';";
	$resultado=mysql_query($consulta) or die("Ha fallado la consulta para recuperar el id de la pelicula recien insertada por el siguiente error: ".mysql_error()."<br/>");
	$idPelicula="";
	while($fila=mysql_fetch_array($resultado)){
	    $idPelicula=$fila[0];
	}
	for($j=0;$j<count($gen);$j++){
	    $consulta="INSERT INTO GEN_PEL (ID_GENERO, ID_PELICULA) VALUES ('$gen[$j]', '$idPelicula');";
	    $resultado=mysql_query($consulta) or die("Ha fallado la insercion para asignar generos a la pelicula por el siguiente error: ".mysql_error()."<br/>");
	}
	
	if(!empty($act)){
	    for($j=0;$j<count($act);$j++){
		$consulta="INSERT INTO ACTUA (ID_ACTOR, ID_PELICULA) VALUES ('$act[$j]', '$idPelicula');";
		$resultado=mysql_query($consulta) or die("Ha fallado la insercion para asignar actores a la pelicula por el siguiente error: ".mysql_error()."<br/>");
	    }
	    
	}
	
	header("Location: verPeliculas.php");
    }

    function insertarNoticia($titulo, $fechaConvertida, $idActor, $idPelicula, $descripcionConvertida, $textoNoticiaConvertida, $nombreImagen){
	/*echo "TITULO: ".$titulo."<br/><br/>";
	echo "FECHA: ".$fechaConvertida."<br/><br/>";
	echo "ID ACTOR: ".$idActor."<br/><br/>";
	echo "ID PELICULA: ".$idPelicula."<br/><br/>";
	echo "DESCRIPCION: ".$descripcionConvertida."<br/><br/>";
	echo "TEXTO NOTICIA: ".$textoNoticiaConvertida."<br/><br/>";
	echo "NOMBRE IMAGEN: ".$nombreImagen."<br/><br/>";*/
	
	nuevaConexionBd();
	if(empty($idActor) && empty($idPelicula)){
	    $consulta="INSERT INTO NOTICIAS (TITULO, DESCRIPCION, TEXTO_NOTICIA, IMAGEN, FECHA) VALUES ('$titulo', '$descripcionConvertida', '$textoNoticiaConvertida', '$nombreImagen', '$fechaConvertida');";
	    $resultado=mysql_query($consulta) or die("Ha fallado la insercion de la noticia por el siguiente error: ".mysql_error()."<br/>");
	}
	else{
	    if(empty($idActor)){
		$consulta="INSERT INTO NOTICIAS (TITULO, DESCRIPCION, TEXTO_NOTICIA, IMAGEN, FECHA, ID_PELICULA) VALUES ('$titulo', '$descripcionConvertida', '$textoNoticiaConvertida', '$nombreImagen', '$fechaConvertida', '$idPelicula');";
		$resultado=mysql_query($consulta) or die("Ha fallado la insercion de la noticia por el siguiente error: ".mysql_error()."<br/>");
	    }
	    else{
		if(empty($idPelicula)){
		    $consulta="INSERT INTO NOTICIAS (TITULO, DESCRIPCION, TEXTO_NOTICIA, IMAGEN, FECHA, ID_ACTOR) VALUES ('$titulo', '$descripcionConvertida', '$textoNoticiaConvertida', '$nombreImagen', '$fechaConvertida', '$idActor');";
		    $resultado=mysql_query($consulta) or die("Ha fallado la insercion de la noticia por el siguiente error: ".mysql_error()."<br/>");
		}
		else{
		    $consulta="INSERT INTO NOTICIAS (TITULO, DESCRIPCION, TEXTO_NOTICIA, IMAGEN, FECHA, ID_PELICULA, ID_ACTOR) VALUES ('$titulo', '$descripcionConvertida', '$textoNoticiaConvertida', '$nombreImagen', '$fechaConvertida', '$idPelicula', '$idActor');";
		    $resultado=mysql_query($consulta) or die("Ha fallado la insercion de la noticia por el siguiente error: ".mysql_error()."<br/>");
		}
	    }
	}
	
	header("Location: verNoticias.php");
	
    }
    function contadorVentas(){
	nuevaConexionBd();
	$consulta="SELECT COUNT(*) FROM VENTAS GROUP BY FECHA_HORA";
	$resultado=mysql_query($consulta);
	$num=mysql_num_rows($resultado);
	return $num;
}
