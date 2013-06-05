<?php
    session_start();
    include("../funciones/funciones.php");
    include("../funciones/top.php");
    include("../funciones/estadisticas.php");
    
    $nombreApe=$_POST['tNombreApe'];
    $nacionalidad=$_POST['tNacionalidad'];
    $fechaNac=$_POST['datepicker'];
    //Convertir la fecha al formato de MySQL
        $fech = $fechaNac;
	$fecha = explode("-", $fech);
	$dia = $fecha[0];
	$mes = $fecha[1];
	$anno = $fecha[2];
        $fechaConvertida=$anno."-".$mes."-".$dia;
	
	
	
    $pel=array();
    $i=0;
    if(isset($_POST['selPeliculas'])){
        $peliculas=$_POST['selPeliculas'];
        for($j=0;$j<count($peliculas);$j++){
            $pel[$i]=$peliculas[$j];
            $i++;
        }
    }
    $carrera=$_POST['tAreaCarrera'];
    $carreraConvertida=str_replace("'","\"", $carrera);
    
    $errorTipo=false;
    $errorTamanio=false;
    
    # MIME types permitidos
    $mime = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');
    # Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
    if(!in_array($_FILES['fFotoActor']['type'], $mime )){
        $errorTipo=true;
        //$mensaje="El archivo que estas subiendo no es válido, solo se aceptan imágenes con extensión JGP, JPEG, GIF y PNG";
	//header("Location:respuesta.php?txt=$mensaje");
    }
    # Indicamos hasta que peso de archivo puede subir el usuario.
    if($_FILES['fFotoActor']['size']>60000){
        $errorTamanio=true;
        //$mensaje="El archivo que estas subiendo es demasiado grande. Como mucho puede ser de 60Kb";
	//header("Location:respuesta.php?txt=$mensaje");
    }
    # Si el archivo cumple con las expectativas quiere decir que la variable $error viene vacia y se ejecutará la función que colocaremos ahí
    if($errorTipo==false && $errorTamanio==false){
	$nombreImagen=$_FILES['fFotoActor']['name'];
	$nombreTemporalImagen=$_FILES['fFotoActor']['tmp_name'];
	if(is_uploaded_file($_FILES['fFotoActor']['tmp_name'])){
	    move_uploaded_file($nombreTemporalImagen, "../imagenes/actores/".$nombreImagen);
	}
	insertarActor($nombreApe, $nacionalidad, $fechaConvertida, $pel, $carreraConvertida, $nombreImagen);
    }
    else{
	$mensaje="El archivo que estas subiendo es demasiado grande (como mucho puede ser de 60Kb) o es de un tipo desconocido (solo admite JGP, JPEG, GIF o PNG)";
	header("Location:respuesta.php?txt=$mensaje");
    }
    
    

?>