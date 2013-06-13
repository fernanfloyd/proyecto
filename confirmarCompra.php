<?php
	session_start();
	include("funciones/funciones.php");
	include("funciones/top.php");
	
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link href="imagenes/favicon.ico" rel="shortcut icon" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Homenaje' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css' />		
		<link rel="stylesheet" type="text/css" href="estilos/index.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="estilos/estrenos.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="estilos/tienda.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="estilos/registro.css" media="all"/>
		
		<script language="javaScript" src="funciones/funciones.js"></script>
		
		<link rel='stylesheet' id='camera-css'  href='estilos/camera.css' type='text/css' media='all'> 
		 
		<script type='text/javascript' src='funciones/jquery.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.mobile.customized.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.easing.1.3.js'></script> 
		<script type='text/javascript' src='funciones/camera.min.js'></script>
		<script type='text/javascript' src='funciones/funciones.js'></script>
		<script type='text/javascript' src='funciones/comprar.js'></script>
		<script type='text/javascript' src='funciones/resumen.js'></script>
		<script type="text/javascript" src="funciones/jquery.alerts.js"></script>  
		<link href="estilos/jquery.alerts.css" rel="stylesheet" type="text/css" /> 

    	
		<script>
			jQuery(function($){
			
				$('#ini').on("click",function(){
					$('#logA').fadeToggle(600, "linear");
				});

			});
		</script>

		<title>ImpactFilm | Todo el cine a tu alcance</title>
	</head>
	<body>
					
			<header>
				<a href="index.php"><img src="imagenes/logo-cabecera.png" title="ImpactFilm | Todo el cine a tu alcance" /></a>
				<div class="saludo"> 
					<?php 
						if(empty($_SESSION['usuario'])){
							echo "<div id='ini' style='margin:10px 50px;cursor:pointer;'><img src='imagenes/login.png' width='15' heigth='15' style='margin:0 8px 0 0;vertical-align: middle;' />Iniciar sesión<img class='flechita' src='imagenes/down_arrow.png' width='20' heigth='20' style='margin:0 0 0 8px;vertical-align: middle;' /></div>";
						}else{
							if($_SESSION['rol']=="administrador"){
								header("Location:admin/index.php");
							}	
							$idU=extraerIdUsuario($_SESSION['usuario']);
							echo "Bienvenido: ".$_SESSION['usuario']." "."<br/><a href='editarPerfilUser.php?idUser=".$idU."'>Editar perfil</a><br/><a href='logout.php'>Salir</a>";
						}
					?>
					<div class="cajalogin" id="logA" hidden>
						<form method='POST' action='login.php' name='lg'>
							<input type="text" placeholder="usuario" name='tUsuario' id='tUsuario' /><br />
							<input type="password" placeholder="contraseña" name='pClave' id='pClave' /><br />
							<input type="submit" value="Iniciar sesión" name='bLogin' id='bLogin' /><br />
							<p style="text-align:center;background-color:#DCD6D6;margin-bottom:15px;"><a href='registro.php' style="">regístrate aquí</a></p>
						</form>
					</div>
				</div>
			</header>
		<nav>
		<div class="menu">
			<div class="wrapper">
				<ul class="nav">
					<li><a href="index.php"><img src="imagenes/home.png" /></a></li>
					<li><a href="verNoticias.php">Noticias</a></li>
					<li><a href="verEstrenos.php">Estrenos</a></li>
					<li><a href="verPeliculas.php">Peliculas</a></li>
					<li><a href="verActores.php">Actores<!--<b></b>--></a></li>
					<li><a href="tienda.php">Tienda</a></li>
				</ul>
				<div class="buscador">
					<form id="search" name="search" method="get" action="busqueda.php" autocomplete="off">
						<input name="s" type="text" id="s" placeholder="Buscar..." />
					</form>
				</div>
			</div>
		</div>
		
		</nav>
		
		<div class="contenedor margen_contenedor">
		
			<section>
				<h1>Resumen Pedido</h1>
				<hr />
				<div id="pedido"></div>
				<h1>Datos cliente</h1>
				<hr />
				<div id="cliente">
					<?php
						echo "<div class='cajaMostrar' style='min-height:220px;'>";
							echo "<div class='cajaDatos'>";
							$datos=obtenerTodoUsuario($idU);
							if($datos['n_tarjeta']==""){
								echo "<p>No hay ningún número de tarjeta asociado a esta cuenta de usuario</p>";
								echo "<p>Añade una tarjeta ahora para poder realizar compras en ImpactFilm</p>";
								echo "<br/>";
									echo "<div class='reg_izq'>";
										echo "<p class='caja3'>";
											echo "<label for='direccion'><b>Dirección:</b></label><br />";
											echo "<label for='ciudad'><b>Ciudad:</b></label><br />";
											echo "<label for='cod'><b>Código postal:</b></label><br />";
											echo "<label for='tar'><b>Número de tarjeta:</b></label><br />";
										echo "</p>";
									echo "</div>";
									echo "<div class='reg_der'>";
										echo "<p class='caja4'>";
											echo "<input type='hidden' name='idUsuario' value='".$idU."' />";
											echo $datos['direccion']."&nbsp;<br/>";
											echo $datos['ciudad']."&nbsp;<br/>";
											echo $datos['cod_postal']."&nbsp;<br/>";
											echo "<input type='text' name='tar' size='20' id='nTarj' value='".$datos['n_tarjeta']."' />&nbsp;<input type='button' id='botonTar' value='Guardar Tarjeta' disabled />&nbsp;<br />";
										echo "</p>";
									echo "</div>";
							}
							else{
								echo "<p>Estos son los datos de envío y pago que tienes asociados.</p>";
								echo "<p>Si son correctos, haz click en <b>'Confirmar compra'</b> y procederemos a enviar el pedido. Sino, puedes modificar los datos desde <a href='editarPerfilUser.php?idUser=".$idU."'>aquí</a>.</p>";
									echo "<div class='reg_izq'>";
										echo "<p class='caja3'>";
											echo "<b>Dirección actual:</b><br />";
											echo "<b>Ciudad:</b><br />";
											echo "<b>Código postal:</b><br />";
											echo "<b>Número de tarjeta:</b><br />";
										echo "</p>";
									echo "</div>";
									echo "<div class='reg_der'>";
										echo "<p class='caja4'>";
											echo "<input type='hidden' name='idUser' value='".$idU."' />";
											echo $datos['direccion']."&nbsp;<br/>";
											echo $datos['ciudad']."&nbsp;<br/>";
											echo $datos['cod_postal']."&nbsp;<br/>";
											echo $datos['n_tarjeta']."&nbsp;<br />";
										echo "</p>";
									echo "</div>";
							}
							echo "</div>";
						echo "</div>";
					
					?>
				</div>
				<hr />
				<div id="pedidoTotal"></div>
				
			</section>
				
			<?php 
						if(!empty($_SESSION['usuario'])){
							echo "<aside>";
							echo "<h1><img src='imagenes/cesta.png' /> Tu cesta</h1>";
							echo "<hr />";
							echo "<div class='cesta'>";
							echo "</div>";
							echo "</aside>";
						}
				?>
			<!--<aside class="top10ventas">
				<h1>Proximos estrenos</h1>
				<hr />
				<ul  class="asiEstadisticas" style="list-style:disc;-webkit-padding-start: 20px;line-height: 1.5em;">
					<li>A todo gas 6</li>
					<li>El ultimo testigo</li>
					<li>Star Trek: En la oscuridad</li>
					<li>R3sacón</li>
					<li>Antes del anochecer</li>
					<li>Epic: El reino secreto</li>
					<li>After Earth</li>
				</ul>
			</aside>-->
			<aside class="top10ventas">
				<h1>Top 10 ventas</h1>
				<hr />
				<ol style="-webkit-padding-start: 20px;">
					<?php
					$top = top();
					
						for($i=0;$i<count($top); $i++){
							$topi = $top[$i];
							if($top[$i]["id_pelicula"]!=null){
								echo "<li><a href='verPelicula.php?parametro=".$top[$i]['id_pelicula']."'>".$topi['titulo']."</a></li>";
							}else{
								echo "<li>".$topi['titulo']."</li>";
							}
						}	
					?>
				</ol>
			</aside>
		</div>
		<footer><a href="index.php"><img src="imagenes/logo-pie.png" title="ImpactFilm | Todo el cine a tu alcance" /></a></footer>
	</body>
</html>