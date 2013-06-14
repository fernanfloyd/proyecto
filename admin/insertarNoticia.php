<?php
    session_start();
    include("../funciones/funciones.php");
    include("../funciones/top.php");
    include("../funciones/estadisticas.php");
    
    $titulo=$_POST['tTitulo'];
    $fecha=$_POST['datepicker'];
    //Convertir la fecha al formato de MySQL
        $fech = $fecha;
	$fecha = explode("-", $fech);
	$dia = $fecha[0];
	$mes = $fecha[1];
	$anno = $fecha[2];
        $fechaConvertida=$anno."-".$mes."-".$dia;
    $idActor=$_POST['selActores'];
    if($idActor=="null"){
        $idActor=null;
    }
    $idPelicula=$_POST['selPeliculas'];
    if($idPelicula=="null"){
        $idPelicula=null;
    }
    $descripcion=$_POST['tAreaDescripcion'];
    $descripcionConvertida=str_replace("'","\"", $descripcion);
    $textoNoticia=$_POST['tAreaTextoNoticia'];
    $textoNoticiaConvertida=str_replace("'","\"", $textoNoticia);
    
    
    $errorTipo=false;
    $errorTamanio=false;
    
    # MIME types permitidos
    $mime = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');
    # Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
    if(!in_array($_FILES['fFotoNoticia']['type'], $mime )){
        $errorTipo=true;
        }
    # Indicamos hasta que peso de archivo puede subir el usuario.
    if($_FILES['fFotoNoticia']['size']>700000){//700Kb maximo
        $errorTamanio=true;
        }
    # Si el archivo cumple con las expectativas quiere decir que la variable $error viene vacia y se ejecutará la función que colocaremos ahí
    if($errorTipo==false && $errorTamanio==false){
	$nombreImagen=$_FILES['fFotoNoticia']['name'];
	$nombreTemporalImagen=$_FILES['fFotoNoticia']['tmp_name'];
	if(is_uploaded_file($_FILES['fFotoNoticia']['tmp_name'])){
	    move_uploaded_file($nombreTemporalImagen, "../imagenes/noticias/".$nombreImagen);
	}
	insertarNoticia($titulo, $fechaConvertida, $idActor, $idPelicula, $descripcionConvertida, $textoNoticiaConvertida, $nombreImagen);
    }
    else{
	$mensaje="El archivo que estas subiendo es demasiado grande (como mucho puede ser de 1,5Mb) o es de un tipo desconocido (solo admite JGP, JPEG, GIF o PNG)";
	header("Location:respuesta.php?txt=$mensaje");
    }
?>