<?php
    session_start();
	include("../funciones/funciones.php");
        if(empty($_GET['parametro'])){
		$mensaje="NO ha introducido ningun parametro";
		header("Location:respuesta.php?txt=$mensaje");	
	}else{
		$idActor=$_GET['parametro']; 
		nuevaConexionBd();			
		$sentencia="DELETE FROM ACTORES WHERE ID_ACTOR=$idActor;";
        $resultado=mysql_query($sentencia);
        header('Location: verActores.php');
		}
    ?>