<?php
    session_start();
    include("../funciones/funciones.php");
    include("../funciones/top.php");
    include("../funciones/estadisticas.php");
    
    $idActor=$_POST['hIdActor'];
    $nombreApe=$_POST['tNombreApe'];
    $fechaNac=$_POST['datepicker'];
        //Convertir la fecha al formato de MySQL
        $fech = $fechaNac;
	$fecha = explode("-", $fech);
	$dia = $fecha[0];
	$mes = $fecha[1];
	$anno = $fecha[2];
        $fechaConvertida=$anno."-".$mes."-".$dia;
    $nacionalidad=$_POST['tNacionalidad'];
    $carrera=$_POST['tAreaCarrera'];
    $carreraConvertida=str_replace("'","\"", $carrera);
    $peliculas=$_POST['selPeliculas'];
    $pel=array();
    $i=0;
    for($j=0;$j<count($peliculas);$j++){
        $pel[$i]=$peliculas[$j];
        $i++;
    }
    $fotoActual=$_POST['hFotoActual'];
    
    if(!empty($_FILES['fFotoActor']['name'])){
	if(is_uploaded_file($_FILES['fFotoActor']['tmp_name'])){
	    $nombreImagen=$_FILES['fFotoActor']['name'];
	    $nombreTemporalImagen=$_FILES['fFotoActor']['tmp_name'];
	    move_uploaded_file($nombreTemporalImagen, "../imagenes/actores/".$nombreImagen);
	    modificarActores($idActor, $nombreImagen, $nombreApe, $fechaConvertida, $nacionalidad, $carreraConvertida, $pel);
	}
    }
    else{
	$nombreImagen=$fotoActual;
	modificarActores($idActor, $nombreImagen, $nombreApe, $fechaConvertida, $nacionalidad, $carreraConvertida, $pel);
    }

?>