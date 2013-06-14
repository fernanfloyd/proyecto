<?php
	session_start();
	include("funciones/funciones.php");
	if(empty($_SESSION['usuario'])){
		$mensaje="Debe iniciar sesion para poder comprar";
		header("Location:respuesta.php?txt=$mensaje");
	}else{
		if(empty($_GET['parametro'])){
			$mensaje="Error. No ha introducido ningun producto";
			header("Location:respuesta.php?txt=$mensaje");
		}else{
			$id=$_GET['parametro'];
			$datos=datosPeli($id);
			$titulo=$datos['titulo'];
			$imagen=$datos['imagen'];
			$precio=$datos['precio'];
			echo "<script type='text/javascript' src='funciones/comprar.js'></script>";
			echo "<script>";
			echo "anadirPro('$titulo','$imagen','$precio','$id');";
			echo "</script>";
		}
	}

	function datosPeli($id){
		nuevaConexionBd();
		$datos=array();
		$consulta="SELECT TITULO, IMAGEN, PRECIO FROM PELICULAS WHERE ID_PELICULA ='$id';";
		$resultado=mysql_query($consulta);
		while($fila=mysql_fetch_array($resultado)){
			$datos['titulo']=$fila[0];
			$datos['imagen']=$fila[1];
			$datos['precio']=$fila[2];
		}
		return $datos;
	}
	
