<?php 

// OBTENER NUMERO DE PELICULAS
function numPeliculas(){
	nuevaConexionBd();
	$num="";
	$consulta="SELECT COUNT(*) FROM PELICULAS;";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
		$num=$fila[0];
	}
	return $num;
}

// OBTENER NUMERO DE USUARIOS
function numUsuarios(){
	nuevaConexionBd();
	$num="";
	$consulta="SELECT COUNT(*) FROM USUARIOS WHERE ROL='registrado';";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
		$num=$fila[0];
	}
	return $num;
}
// OBTENER NUMERO DE VENTAS
function numVentas(){
	nuevaConexionBd();
	$num="";
	$consulta="SELECT COUNT(*) FROM VENTAS GROUP BY FECHA_HORA;";
	$resultado=mysql_query($consulta);
	$num=mysql_num_rows($resultado);
	return $num;
}
// OBTENER NUMERO DE NOTICIAS
function numNoticias(){
	nuevaConexionBd();
	$num="";
	$consulta="SELECT COUNT(*) FROM NOTICIAS;";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
		$num=$fila[0];
	}
	return $num;
}// OBTENER NUMERO DE ACTORES
function numActores(){
	nuevaConexionBd();
	$num="";
	$consulta="SELECT COUNT(*) FROM ACTORES;";
	$resultado=mysql_query($consulta);
	while($fila=mysql_fetch_array($resultado)){
		$num=$fila[0];
	}
	return $num;
}