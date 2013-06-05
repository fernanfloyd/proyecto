<?php
    session_start();
	include("../funciones/funciones.php");
        if(empty($_GET['parametro'])){
		$mensaje="NO ha introducido ningun parametro";
		header("Location:respuesta.php?txt=$mensaje");	
	}else{
		$idNoticia=$_GET['parametro'];
		nuevaConexionBd();		
        $sentencia="DELETE FROM NOTICIAS WHERE ID_NOTICIA=$idNoticia;";
        $resultado=mysql_query($sentencia);
        header('Location: verNoticias.php');
		}