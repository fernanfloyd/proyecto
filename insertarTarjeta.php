<?php
session_start();
include("funciones/funciones.php");

if(empty($_GET['tar'])){
	$mensaje="Error. No ha introducido ningun numero de tarjeta";
	header("Location:respuesta.php?txt=$mensaje");
}else{
	$tarjeta=$_GET['tar'];
	$nick=$_SESSION['usuario'];
	$id=extraerIdUsuario($nick);
	insertarTarjeta($tarjeta,$id);
	header("Location:confirmarCompra.php");
}	

function insertarTarjeta($tarjeta,$id){
	nuevaConexionBd();
	$consulta="UPDATE DATOS SET N_TARJETA='$tarjeta' WHERE ID_USUARIO='$id';";
	mysql_query($consulta) or die(header("Location:respuesta.php?txt=Error al introducir el numero de tarjeta"));
}