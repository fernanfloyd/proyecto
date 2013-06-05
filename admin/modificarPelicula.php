<?php
    session_start();
    include("../funciones/funciones.php");
    include("../funciones/top.php");
	include("../funciones/estadisticas.php");
    
    $idPelicula=$_POST['hIdPelicula'];
    $titulo=$_POST['tTitulo'];
    $estreno=$_POST['selEstreno'];
	//Convertir estreno a true o false
	if($estreno=='no'){
	    $estreno=0;
	}
	else{
	    $estreno=1;
	}
    $anio=$_POST['tAnio'];
    $duracion=$_POST['tDuracion'];
    $director=$_POST['tDirector'];
    $pais=$_POST['tPais'];
    $generos=$_POST['selGeneros'];
    $gen=array();
    $i=0;
    for($j=0;$j<count($generos);$j++){
	$gen[$i]=$generos[$j];
	$i++;
    }
    $actores=$_POST['selActores'];
    $act=array();
    $i=0;
    for($j=0;$j<count($actores);$j++){
	$act[$i]=$actores[$j];
	$i++;
    }
    $critica=$_POST['tAreaCritica'];
    $criticaConvertida=str_replace("'","\"", $critica);
    $trailer=$_POST['tTrailer'];
    $precio=$_POST['tPrecio'];
    $fotoActual=$_POST['hFotoActual'];
    
    
    if(!empty($_FILES['fFotoPelicula']['name'])){
	if(is_uploaded_file($_FILES['fFotoPelicula']['tmp_name'])){
	    $nombreImagen=$_FILES['fFotoPelicula']['name'];
	    $nombreTemporalImagen=$_FILES['fFotoPelicula']['tmp_name'];
	    move_uploaded_file($nombreTemporalImagen, "../imagenes/peliculas/".$nombreImagen);
	    modificarPeliculas($idPelicula, $titulo, $estreno, $anio, $duracion, $director, $pais, $gen, $act, $criticaConvertida, $trailer, $precio, $nombreImagen);
	}
    }
    else{
	$nombreImagen=$fotoActual;
	modificarPeliculas($idPelicula, $titulo, $estreno, $anio, $duracion, $director, $pais, $gen, $act, $criticaConvertida, $trailer, $precio, $nombreImagen);
    }
    
?>