<?php
	session_start();
	session_destroy();
	//header('Location:index.php');
	echo "<script type='text/javascript' src='funciones/comprar.js'></script>";
	echo "<script>";
		echo "elimLista();";
	echo "</script>";
?>