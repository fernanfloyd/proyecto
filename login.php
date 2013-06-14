<?php
		include("funciones/funciones.php");
	$error="";
	if(!empty($_POST['tUsuario']) && !empty($_POST['pClave'])){
			$usuario=$_POST['tUsuario'];
			$datos=obtenerDatosUsuario($usuario);
			if(comprobarPass($datos)){
				iniciarSesion($datos);
				crearAcceso($usuario);
				if($_SESSION['rol'] =="administrador"){
					header( 'Location: admin/index.php' ) ;
				}
				echo "<script type='text/javascript' src='funciones/comprar.js'></script>";
				echo "<script>";
					echo "elimLista();";
				echo "</script>";
			}else{
				$mensaje="El password es incorrecto";
				header("Location:respuesta.php?txt=$mensaje");

			}
		}else{
			$mensaje="Debe introducir el usuario y el password";
			header("Location:respuesta.php?txt=$mensaje");
			
		}

	function obtenerDatosUsuario($nombreUsuario){
		$conexion = mysql_connect('localhost','adminImpact','adminImpact')or die("error");
		mysql_select_db('PROYECTO')or die("error");
		$query = "SELECT NICK, CLAVE, ROL FROM USUARIOS WHERE NICK='".$nombreUsuario."';";
		$result = mysql_query($query)or die("error");
		$datosUsuario;
		if(mysql_num_rows($result)==1){
			while ($row = mysql_fetch_array($result)) {
				$datosUsuario["nombre"] = $row[0];
				$datosUsuario["password"] = $row[1];
				$datosUsuario["rol"]=$row[2];
				mysql_close($conexion);
			}
		}else{
			$mensaje="El usuario no existe";
			header("Location:respuesta.php?txt=$mensaje");
			die();
		}
		return $datosUsuario;
	}

	function comprobarPass($datosUsuario){
		$passCorrecta = false;
		$user=$datosUsuario["nombre"];
		$passUsuario = $datosUsuario["password"];
		$salt = substr ($user, 0, 2);
		$passIntroducida=crypt($_POST['pClave'], $salt);
		if($passUsuario == $passIntroducida){
			$passCorrecta = true;
		}
		return $passCorrecta;
	}

	function iniciarSesion($datosUsuario){
		session_start();
		$_SESSION['usuario'] = $datosUsuario["nombre"];
		$_SESSION['rol'] = $datosUsuario["rol"];
	}

