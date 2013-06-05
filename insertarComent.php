<?php
	session_start();
	include("funciones/funciones.php");
	nuevaConexionBd();
	$id_pelicula=$_GET['parametro'];
	$nick=$_SESSION['usuario'];
	
	$hoy = date("Y-m-d H:i:s");
	$comentario=$_POST['coment'];
	$id_usuario=extraerIdUsuario($nick);
	
	
	$consultaInsert="INSERT INTO COMENTARIOS (ID_USUARIO,ID_PELICULA,FECHA_COMENT,COMENTARIO) VALUES ('".$id_usuario."','".$id_pelicula."','".$hoy."','".$comentario."');";
	$inserccionComentario=mysql_query($consultaInsert) or die("error al introducir comentario nuevo: ".mysql_error());
	header("Location: verPelicula.php?parametro=$id_pelicula");
	
	
	
?>