<?php
    session_start();
	include("../funciones/funciones.php");
        if(empty($_GET['parametro'])){
		$mensaje="NO ha introducido ningun parametro";
		header("Location:respuesta.php?txt=$mensaje");	
	}else{
		$idPelicula=$_GET['parametro'];  
		nuevaConexionBd();		
        $sentencia="DELETE FROM PELICULAS WHERE ID_PELICULA=$idPelicula;";
        $resultado=mysql_query($sentencia);
        header('Location: verPeliculas.php');
		}
    ?>