<?php
include("../funciones/funciones.php");
	if(empty($_GET['parametro'])){
		$mensaje="No ha introducido ningun parametro";
		header("Location:respuesta.php?txt=$mensaje");	
	}else{
		$id=$_GET['parametro'];
		nuevaConexionBd();
		$consulta="DELETE FROM DATOS WHERE ID_USUARIO=$id;";
		$resultado=mysql_query($consulta);
		nuevaConexionBd();
		$consulta="DELETE FROM USUARIOS WHERE ID_USUARIO=$id;";
		$resultado=mysql_query($consulta);
		header("Location:verUsuarios.php");
	}