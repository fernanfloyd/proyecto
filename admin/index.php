<?php
	session_start();
	include ("../funciones/funciones.php");
	include("../funciones/top.php");
	include("../funciones/estadisticas.php");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link href="../imagenes/faviconA.ico" rel="shortcut icon" />
		<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
		<link href='http://fonts.googleapis.com/css?family=Homenaje' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css' />		
		<link rel='stylesheet' id='camera-css'  href='estilos/camera.css' type='text/css' media='all'>
		<link rel='stylesheet' type='text/css' href='estilos/index.css' media='all' />
		<script type='text/javascript' src='../funciones/jquery.min.js'></script>
		<script type='text/javascript' src='../funciones/jquery.mobile.customized.min.js'></script>
		<script type='text/javascript' src='../funciones/jquery.easing.1.3.js'></script> 
		<script type='text/javascript' src='../funciones/camera.min.js'></script>
		<script type='text/javascript' src='../funciones/funciones.js'></script>
		<script type='text/javascript' src='../funciones/comprar.js'></script>
		<title>ImpactFilm | Todo el cine a tu alcance</title>
	</head>
	<body>
					
			<header>
				<a href="index.php"><img src="../imagenes/logo-cabecera.png" title="ImpactFilm | Todo el cine a tu alcance" /></a>
				<div class="saludo"> 
					<?php
						if(empty($_SESSION['usuario'])){
							header( 'Location: ../index.php' ) ;
						}else{
							$idU=extraerIdUsuario($_SESSION['usuario']);
							echo "Bienvenido: ".$_SESSION['usuario']." "."<br/><br/><a href='../logout.php'>Salir</a>";
						}
					?>
				</div>
			</header>
		<nav>
		<div class="menu">
			<div class="wrapper">
				<ul class="nav">
					<li><a href="index.php"><img src="../imagenes/homeA.png" /></a></li>
					<li><a href="verNoticias.php">Noticias</a></li>
					<li><a href="verUsuarios.php">Usuarios</a></li>
					<li><a href="verPeliculas.php">Peliculas</a></li>
					<li><a href="verActores.php">Actores<!--<b></b>--></a></li>
					<li><a href="verComentarios.php">Comentarios</a></li>
					<li><a href="verEstadisticas.php">Estadisticas</a></li>
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
				<h1>Dashboard</h1>
				<hr />
				<a href="verUsuarios.php"><div class="cajitasIzq">
					<div class="caja_foto">
						<img src='../imagenes/iconos/users.png' height='150' width='100' />
					</div>
					<div class="caja_texto">
						<p></p>
						<h4>Administrar Usuarios</h4>
						<p>Eliminar, modificar o insertar un nuevo usuario</p>
					</div>
				</div></a>
				<a href="verPeliculas.php"><div class="cajitasIzq">
					<div class="caja_foto">
						<img src='../imagenes/iconos/films.png' height='150' width='100' />
					</div>
					<div class="caja_texto">
						<p></p>
						<h4>Administrar Peliculas</h4>
						<p>Eliminar, modificar o insertar una nueva pelicula</p>
					</div>
				</div></a>
				<a href="verActores.php"><div class="cajitasIzq">
					<div class="caja_foto">
						<img src='../imagenes/iconos/actors.png' height='150' width='100' />
					</div>
					<div class="caja_texto">
						<p></p>
						<h4>Administrar Actores</h4>
						<p>Eliminar, modificar o insertar un nuevo actor</p>
					</div>
				</div></a>
				<a href="verNoticias.php"><div class="cajitasIzq">
					<div class="caja_foto">
						<img src='../imagenes/iconos/news.png' height='150' width='100' />
					</div>
					<div class="caja_texto">
						<p></p>
						<h4>Administrar Noticias</h4>
						<p>Eliminar, modificar o insertar una nueva noticia</p>
					</div>
				</div></a>
				<a href="verEstadisticas.php"><div class="cajitasIzq">
					<div class="caja_foto">
						<img src='../imagenes/iconos/statistics.png' height='150' width='100' />
					</div>
					<div class="caja_texto">
						<p></p>
						<h4>Ver Estadisticas</h4>
						<p>Estadiscas sobre ventas, comentarios, accesos, ...</p>
					</div>
				</div></a>
				<a href="verComentarios.php"><div class="cajitasIzq">
					<div class="caja_foto">
						<img src='../imagenes/iconos/comments.png' height='150' width='100' />
					</div>
					<div class="caja_texto">
						<p></p>
						<h4>Ver Comentarios</h4>
						<p>Borrar y cesurar comentarios</p>
					</div>
				</div></a>
				
			</section>
				
				
			<aside>
				<h1>Estadisticas</h1>
				<hr />
				<ul class="asiEstadisticas" style="list-style:disc;-webkit-padding-start: 20px;line-height: 1.5em;">
					<li>Usuarios: <?php echo numUsuarios(); ?></li>
					<li>Peliculas: <?php echo numPeliculas(); ?></li>
					<li>Actores: <?php echo numActores(); ?></li>
					<li>Noticias: <?php echo numNoticias(); ?></li>
					<li>Ventas: <?php echo numVentas(); ?></li>
				</ul>
			</aside>	
				
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
		<footer><a href="index.php"><img src="../imagenes/logo-pie.png" title="ImpactFilm | Todo el cine a tu alcance" /></a></footer>
	</body>
</html>