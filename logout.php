<?php
	session_start();
	session_destroy();
	echo "<script type='text/javascript' src='funciones/comprar.js'></script>";
	echo "<script>";
		echo "elimLista();";
	echo "</script>";
?>