<?php
    session_start();
    include("../funciones/funciones.php");
    include("../funciones/top.php");
    include("../funciones/estadisticas.php");
    
    $idNoticia=$_POST['hIdNoticia'];
    $titulo=$_POST['tTitulo'];
    $tituloConvertido=str_replace("'","\"", $titulo);
    $fecha=$_POST['datepicker'];
        //Convertir la fecha al formato de MySQL
        $fech = $fecha;
	$fecha = explode("-", $fech);
	$dia = $fecha[0];
	$mes = $fecha[1];
	$anno = $fecha[2];
        $fechaConvertida=$anno."-".$mes."-".$dia;
	
    $descripcion=$_POST['tDescripcion'];
    $descripcionConvertida=str_replace("'","\"", $descripcion);
    $noticia=$_POST['tAreaNoticia'];
    $noticiaConvertida=str_replace("'","\"", $noticia);
    $actorRelacionado=$_POST['selActorRel'];
    if($actorRelacionado=="null"){
	$actorRelacionado=null;
    }
    $peliculaRelacionada=$_POST['selPeliculaRel'];
    if($peliculaRelacionada=="null"){
	$peliculaRelacionada=null;
    }
    $fotoActual=$_POST['hFotoActual'];
    
    if(!empty($_FILES['fFotoNoticia']['name'])){
	if(is_uploaded_file($_FILES['fFotoNoticia']['tmp_name'])){
	    $nombreImagen=$_FILES['fFotoNoticia']['name'];
	    $nombreTemporalImagen=$_FILES['fFotoNoticia']['tmp_name'];
	    move_uploaded_file($nombreTemporalImagen, "../imagenes/noticias/".$nombreImagen);
	    modificarNoticias($idNoticia, $tituloConvertido, $fechaConvertida, $descripcionConvertida, $noticiaConvertida, $actorRelacionado, $peliculaRelacionada, $nombreImagen);
	}
    }
    else{
	$nombreImagen=$fotoActual;
	modificarNoticias($idNoticia, $tituloConvertido, $fechaConvertida, $descripcionConvertida, $noticiaConvertida, $actorRelacionado, $peliculaRelacionada, $nombreImagen);
    }
    

?>