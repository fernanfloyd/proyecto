<?php
	include("funciones/funciones.php");
	include("funciones/top.php");
	
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellidos'];
	$telefono=$_POST['telefono'];
	$fechaN=$_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];
	$pais=$_POST['pais'];
	$mail=$_POST['correo'];
	$sexo=$_POST['sexo'];
	$nick=$_POST['usuario'];
	$password=$_POST['pwd'];
	$direccion=$_POST['dir'];
	$ciudad=$_POST['ciu'];
	$codPos=$_POST['cod'];
	if(!empty($_POST['tar'])){
		$nTar=$_POST['tar'];
	}
	
	
		creacionUsuario($nick,$password);
		$id=id();
		if(isset($_POST['tar'])){
		creacionDatosT($id,$nombre,$apellido,$telefono,$mail,$ciudad,$direccion,$codPos,$pais,$fechaN,$sexo,$nTar);
		}else{
		creacionDatos($id,$nombre,$apellido,$telefono,$mail,$ciudad,$direccion,$codPos,$pais,$fechaN,$sexo);
		}
		crearSesion($nick);
		crearAcceso($nick);
		correcto();
	
	//INSERTA NUEVO USUARIO EN TABLA USUARIOS
	function id(){
		nuevaConexionBd();
		$consultaID=mysql_query("SELECT MAX(ID_USUARIO) FROM USUARIOS");
		return $consultaID;
	}
	function creacionUsuario($nick,$password){
		nuevaConexionBd();
		$salt = substr ($nick, 0, 2);
		$passwordC = crypt ($password, $salt);
		$consultaInsert="INSERT INTO USUARIOS (NICK,CLAVE,ROL) VALUES ('".$nick."','".$passwordC."','registrado');";
		$insercionUsuario=mysql_query($consultaInsert)or die(msj("<br/>error al introducir usuario nuevo: ".mysql_error()));
	}
	function creacionDatosT($id,$nombre,$apellido,$telefono,$mail,$ciudad,$direccion,$codPos,$pais,$fechaN,$sexo,$nTar){
		nuevaConexionBd();
		$consultaInsert="INSERT INTO DATOS (ID_USUARIO,NOMBRE,APELLIDOS,TELEFONO,EMAIL,CIUDAD,DIRECCION,COD_POSTAL,PAIS,FECHA_NAC,SEXO,N_TARJETA) VALUES ('$id','$nombre','$apellido','$telefono','$mail','$ciudad','$direccion','$codPos','$pais','$fechaN','$sexo','$nTar');";
		$insercionDatos=mysql_query($consultaInsert)or die(msj("<br/>error al introducir datos de nuevo usuario: ".mysql_error()));
	}
	function creacionDatos($id,$nombre,$apellido,$telefono,$mail,$ciudad,$direccion,$codPos,$pais,$fechaN,$sexo){
		nuevaConexionBd();
		$consultaInsert="INSERT INTO DATOS (ID_USUARIO,NOMBRE,APELLIDOS,TELEFONO,EMAIL,CIUDAD,DIRECCION,COD_POSTAL,PAIS,FECHA_NAC,SEXO) VALUES ('$id','$nombre','$apellido','$telefono','$mail','$ciudad','$direccion','$codPos','$pais','$fechaN','$sexo');";
		$insercionDatos=mysql_query($consultaInsert)or die(msj("<br/>error al introducir datos de nuevo usuario: ".mysql_error()));
	}
	//mensaje en pagina
	function msj($texto){
		
		header("Location:respuesta.php?txt=$texto");
	}
	
	
	
	
	
	
?>