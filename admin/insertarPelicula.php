<?php
    session_start();
    include("../funciones/funciones.php");
    include("../funciones/top.php");
    include("../funciones/estadisticas.php");
    
    $titulo=$_POST['tTitulo'];
    $pais=$_POST['tPais'];
    $anio=$_POST['tAnio'];
    $duracion=$_POST['tDuracion'];
    $director=$_POST['tDirector'];
    $trailer=$_POST['tTrailer'];
    $precio=$_POST['tPrecio'];
    $estreno=$_POST['selEstreno'];
    
    $gen=array();
    $i=0;
    $generos=$_POST['selGeneros'];
    for($j=0;$j<count($generos);$j++){
        $gen[$i]=$generos[$j];
        $i++;
    }

    
    
    $critica=$_POST['tAreaCritica'];
    $criticaConvertida=str_replace("'","\"", $critica);
    $nombreCartel=$_FILES['fFotoPelicula']['name'];
    $nombreTemporalCartel=$_FILES['fFotoPelicula']['tmp_name'];
    if(is_uploaded_file($_FILES['fFotoPelicula']['tmp_name'])){
	move_uploaded_file($nombreTemporalCartel, "../imagenes/peliculas/".$nombreCartel);
    }
    $nombreCarartula=$_FILES['fCaratulaPelicula']['name'];
    $nombreTemporalCaratula=$_FILES['fCaratulaPelicula']['tmp_name'];
    if(is_uploaded_file($_FILES['fCaratulaPelicula']['tmp_name'])){
	move_uploaded_file($nombreTemporalCaratula, "../imagenes/caratulas/".$nombreCarartula);
    }
    
    
    $act=array();
    $i=0;
    if(isset($_POST['selActores'])){
        $actores=$_POST['selActores'];
        for($j=0;$j<count($actores);$j++){
            $act[$i]=$actores[$j];
            $i++;
        }
    }
    
    
    insertarPelicula($titulo, $pais, $anio, $duracion, $director, $trailer, $precio, $estreno, $act, $criticaConvertida, $nombreCartel, $gen);

?>