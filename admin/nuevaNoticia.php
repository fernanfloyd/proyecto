<?php
	session_start();
	include("../funciones/funciones.php");
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
		<script src="../funciones/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
		<link rel="stylesheet" type="text/css" href="../funciones/jquery-ui-1.10.3.custom/css/customUI/jquery-ui-1.10.3.custom.min.css" media="all"/>
		<script type='text/javascript' src='../funciones/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js'></script>
		<script src="../funciones/datepicker-es.js"></script>
		<script>
			jQuery(function($){
				$.datepicker.setDefaults( $.datepicker.regional[ "es" ] );
				$( "#datepicker" ).datepicker();
			});
		</script>
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
				<h1>Nueva noticia</h1>
				<hr />
				<div class='cajaMostrar'>
					<p style='color: red;font-size:13px;'>*Puedes relacionar la pelicula con alguno de los actores o peliculas que ya estan registrados en la base de datos, pero no es obligatorio.</p>
					<form enctype='multipart/form-data' id='formNuevaNoticia' name='formNuevaNoticia' action='insertarNoticia.php' method='post'>
						<div class='nuevoIzq'>
							<p style='text-align: right;padding-right: 30px;'>
								<b>Titulo de la noticia: </b><br/>
								<b>Imagen: </b><br/>
								<b>Fecha de publicación: </b><br/>
								<b>Relacionada con el actor: </b><br/>
								<b>Relacionada con la película: </b><br/>
								<b>Descripción: </b><br/>
							</p>
						</div>
						<div class='nuevoDer'>
							<p>
							<input type='text' name='tTitulo' id='tTitulo' maxlength='50' size='40' required />&nbsp;<br/>
							<input type='file' name='fFotoNoticia' id='fFotoNoticia' size='40' required />&nbsp;<br/>
							<input type='text' id='datepicker' name='datepicker' required />&nbsp;<br/>						
							<?php
							$todosActores=obtenerNombreIdActores();
							echo "<select name='selActores' id='selActores' style='margin-top: 1px;'>";
								echo "<option value='null'>[Selecciona actor]</option>";
								while($fila=mysql_fetch_array($todosActores)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
							echo "</select>&nbsp;<br/>";
							$todasPeliculas=obtenerNombreIdPeliculas();
							echo "<select name='selPeliculas' id='selPeliculas' style='margin-top: 1px;'>";
								echo "<option value='null'>[Selecciona pelicula]</option>";
								while($fila=mysql_fetch_array($todasPeliculas)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
							echo "</select>&nbsp;<br/>";
							?>
							<textarea name='tAreaDescripcion' id='tAreaDescripcion' style='height: 130px;max-height: 130px;min-height: 130px;' required></textarea>&nbsp;<br/>
							<textarea name='tAreaTextoNoticia' id='tAreaTextoNoticia' required></textarea>&nbsp;<br/>
							<input type='submit' name='sNuevaNoticia' id='sNuevaNoticia' value='Crear noticia' class='botonRojo' />
							</p>
						</div>
						<div class='nuevoIzq' style='margin-top: 117px;'>
							<p style='text-align: right;padding-right: 30px;'>
								<b>Texto de la noticia: </b><br/>
							</p>
						</div>
					</form>	
				</div>
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