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
				<?php
				if(empty($_GET['parametro'])){
					echo "NO hay ningun actor seleccionada";	
				}else{
					echo "<form enctype='multipart/form-data' id='formModNoticia' name='formModNoticia' action='modificarNoticia.php' method='post' onsubmit='return modifyNoticiaConfirm()'>";
						$id=$_GET['parametro'];
						$noticia=obtenerTodoNoticia($id);
						echo "<h1>".$noticia['titulo']."</h1><hr />";
						echo "<div class='cajaMostrar'>";
							echo "<div class='cajaFoto'>";
								echo "<img src='../imagenes/noticias/".$noticia['imagen']."' height='300' width='200' />";
								echo "<input type='hidden' name='hFotoActual' id='hFotoActual' value='".$noticia['imagen']."' />";
								echo "<div class='custom-input-file'><input type='file' name='fFotoNoticia' id='fFotoNoticia' size='1' class='input-file' />Cambiar foto</div>";
							echo "</div>";
						echo "<div class='cajaDatos'>";
							echo "<p><b>Título de la noticia:</b> <input type='text' name='tTitulo' id='tTitulo' value='".$noticia['titulo']."' maxlength='50' size='50' required /></p>";
							$fech = $noticia['fecha'];
							$fecha = explode("-", $fech);
							$dia = $fecha[2];
							$mes = $fecha[1];
							$anno = $fecha[0];
							echo "<p><b>Fecha de la publicación: </b> <input type='text' name='datepicker' id='datepicker' value='".$dia."-".$mes."-".$anno."' required /></p>";
							echo "<p><b>Descripción: </b> <input type='text' name='tDescripcion' id='tDescripcion' value='".$noticia['desc']."' maxlength='140' size='69' /></p>";
							echo "<p><b>Noticia: </b></p>";
							echo "<textarea name='tAreaNoticia' id='tAreaNoticia'>".$noticia['t_not']."</textarea></p>";
							if(!empty($noticia['video'])){
								echo "<p>Video: ".$noticia['video']."</p>";
							}
							$todosActores=obtenerNombreIdActores();
							if(!empty($noticia['id_act'])){
								echo "<p><b>Esta noticia esta relacionada con el actor: </b>";
								$nombre=obtenerNombreActor($noticia['id_act']);
								echo "<a href='verActor.php?parametro=".$noticia['id_act']."'>".$nombre."</a><br></p>";
								echo "<p style='color: red;font-size:13px;'>*Si no quieres que el actor que tiene registrado esta noticia en este momento se borre, debes seleccionar a ese actor tambien en la lista de abajo.</p>";
								echo "<p><b>Cambiar o eliminar actor relacionado: </b></p><select name='selActorRel' id='selActorRel'>";
								echo "<option value='null'>Ningún actor relacionado</option>";
								while($fila=mysql_fetch_array($todosActores)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
								echo "</select><br/>";
							}
							else{
								echo "<p><b>Añadir actor relacionado: </b></p><select name='selActorRel' id='selActorRel'>";
								echo "<option value='null'>Ningún actor relacionado</option>";
								while($fila=mysql_fetch_array($todosActores)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
								echo "</select><br/>";
							}
							$todasPeliculas=obtenerNombreIdPeliculas();
							if(!empty($noticia['id_pel'])){
								echo "<p><b>Esta noticia esta relacionada con la siguiente pelicula: </b>";
								$nombre=obtenerNombrePelicula($noticia['id_pel']);
								echo "<a href='verPelicula.php?parametro=".$noticia['id_pel']."'>".$nombre."</a><br></p>";
								echo "<p style='color: red;font-size:13px;'>*Si no quieres que la película que tiene registrada esta noticia en este momento se borre, debes seleccionar esa película tambien en la lista de abajo.</p>";
								echo "<p><b>Cambiar o eliminar película relacionada: </b></p><select name='selPeliculaRel' id='selPeliculaRel'>";
								echo "<option value='null'>Ninguna película relacionada</option>";
								while($fila=mysql_fetch_array($todasPeliculas)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
								echo "</select><br/>";
							}
							else{
								echo "<p><b>Añadir película relacionada: </b></p><select name='selPeliculaRel' id='selPeliculaRel'>";
								echo "<option value='null'>Ninguna película relacionada</option>";
								while($fila=mysql_fetch_array($todasPeliculas)){
									echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
								}
								echo "</select><br/>";
							}
							echo "<input type='hidden' name='hIdNoticia' id='hIdNoticia' value='".$id."' />";
							echo "<input type='submit' name='bModNoticia' id='bModNoticia' value='Confirmar modificación' class='botonRojo' style='margin-top: 20px;' />";
						echo "</div>";
						echo "</div>";
					echo "</form>";
				}
				?>
									
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