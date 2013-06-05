<?php
	include("../funciones/funciones.php");
	if(empty($_GET['param'])){
		$mensaje="NO ha introducido ningun parametro";
		header("Location:respuesta.php?txt=$mensaje");	
	}else{
		$id=$_GET['param'];
		$peli=$_GET['peli'];
		nuevaConexionBd();
		$consulta="DELETE FROM COMENTARIOS WHERE ID_COMENTARIO=$id;";
		$resultado=mysql_query($consulta);
		header("Location:verComentario.php?parametro=$peli");
	}
