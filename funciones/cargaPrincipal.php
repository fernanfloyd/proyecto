<?php 

include("funciones/funciones.php");

function peli($i){
nuevaConexionBd();
						$peli=array();
						$consulta="SELECT id_pelicula, titulo, descripcion, imagen FROM peliculas WHERE id_pelicula='$i';";
						$resultado=mysql_query($consulta);
						while($fila=mysql_fetch_array($resultado)){
							$peli['id']=$fila[0];
							$peli['titulo']=$fila[1];
							$peli['desc']=$fila[2];
							$peli['imagen']=$fila[3];
						}
	return $peli;
}
function actor($i){
nuevaConexionBd();
						$actor=array();
						$consulta="SELECT id_actor, nombre_ape, descripcion, imagen FROM actores WHERE id_actor='$i';";
						$resultado=mysql_query($consulta);
						while($fila=mysql_fetch_array($resultado)){
							$actor['id']=$fila[0];	
							$actor['nombre']=$fila[1];
							$actor['desc']=$fila[2];
							$actor['imagen']=$fila[3];
						}
	return $actor;
}
function noticia($i){
nuevaConexionBd();
						$noti=array();
						$consulta="SELECT id_noticia, titulo, descripcion, imagen FROM noticias WHERE id_noticia='$i';";
						$resultado=mysql_query($consulta);
						while($fila=mysql_fetch_array($resultado)){
							$noti['id']=$fila[0];
							$noti['titulo']=$fila[1];
							$noti['desc']=$fila[2];
							$noti['imagen']=$fila[3];
						}
	return $noti;
}
function all_peli(){
	$i=0;
	$IDS=array();
	nuevaConexionBd();
	$consulta="SELECT ID_PELICULA FROM peliculas;";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
		$IDS[$i]=$fila[0];
		$i++;
	}
	return $IDS;
}

function all_actor(){
	$i=0;
	$IDS=array();
	nuevaConexionBd();
	$consulta="SELECT ID_ACTOR  FROM ACTORES;";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
		$IDS[$i]=$fila[0];
		$i++;
	}
	return $IDS;
}
function all_noti(){
	$i=0;
	$IDS=array();
	nuevaConexionBd();
	$consulta="SELECT ID_NOTICIA FROM NOTICIAS;";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
		$IDS[$i]=$fila[0];
		$i++;
	}
	return $IDS;
}

?>