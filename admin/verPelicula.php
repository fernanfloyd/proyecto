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
		<title>ImpactFilm | Pelicula</title>
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
					echo "NO hay ninguna peli seleccionada";	
				}else{
					echo "<form enctype='multipart/form-data' id='formModPelicula' name='formModPelicula' action='modificarPelicula.php' method='post' onsubmit='return modifyPeliculaConfirm()'>";
					$id=$_GET['parametro'];
					$pelicula=obtenerTodoPelicula($id);
					echo "<h1>".$pelicula['titulo']."</h1><hr />";
					echo "<div class='cajaMostrar'>";
					echo "<div class='cajaFoto'>";
						echo "<img src='../imagenes/peliculas/".$pelicula['imagen']."' height='300' width='200' />";
						echo "<input type='hidden' name='hFotoActual' id='hFotoActual' value='".$pelicula['imagen']."' />";
						echo "<div class='custom-input-file'><input type='file' name='fFotoPelicula' id='fFotoPelicula' size='1' class='input-file' />Cambiar foto</div>";
					echo "</div>";
					echo "<div class='cajaDatos'>";
						echo "<p><b>Título:</b> <input type='text' name='tTitulo' id='tTitulo' value='".$pelicula['titulo']."' maxlength='50' required /></p>";
						if($pelicula['estreno']==0){
							echo "<p><b>Estreno:</b> <select name='selEstreno' id='selEstreno' required><option value='no'>No</option><option value='si'>Si</option></select></p>";
						}
						else{
							echo "<p><b>Estreno:</b> <select name='selEstreno' id='selEstreno' required><option value='si'>Si</option><option value='no'>No</option></select></p>";
						}
						echo "<p><b>Año:</b> <input type='text' name='tAnio' id='tAnio' value='".$pelicula['anio']."' maxlength='4' size='3' required /></p>";
						echo "<p><b>Duracion:</b> <input type='text' name='tDuracion' id='tDuracion' value='".$pelicula['duracion']."' maxlength='3' size='2' required /> min</p>";
						echo "<p><b>Director:</b> <input type='text' name='tDirector' id='tDirector' value='".$pelicula['director']."' maxlength='50' required /></p>";
						echo "<p><b>Pais:</b> <input type='text' name='tPais' id='tPais' value='".$pelicula['pais']."' maxlength='30' required /></p>";
						$generos=obtenerGeneros($id);
						$longGeneros=count($generos);
						$actores=obtenerActores($id);
						$longActores=count($actores);
						echo "<p><b>Generos registrados actualmente:</b> ";
						
						foreach($generos as $i=>$g){
							
							if($i==$longGeneros-1){
								$nombre=obtenerNombreGeneros($g);
								echo $nombre;
							}else{
								$nombre=obtenerNombreGeneros($g);
								echo $nombre.", ";
							}
							
						}
						echo "</p>";
						$todosGeneros=obtenerTodoGeneros();
						echo "<p style='color: red;font-size:13px;'>*Si no quieres que los géneros que tiene registrados esta película en este momento se borren, debes seleccionar esos géneros tambien en la lista de abajo cuando quieras añadir más géneros.</p>";
						echo "<p><b>Añadir mas géneros:</b></p><select name='selGeneros[]' id='selGeneros[]' multiple size='8' required>";
							while($fila=mysql_fetch_array($todosGeneros)){
								echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
							}
						echo "</select><br/>";
						echo "<p><b>Actores registrados actualmente: </b>";
						
						foreach($actores as $i=>$a){
							
							if($i==$longActores-1){
								$nombre=obtenerNombreActor($a);
								echo "<a href='verActor.php?parametro=".$a."'>".$nombre."</a>";
							}else{
								$nombre=obtenerNombreActor($a);
								echo "<a href='verActor.php?parametro=".$a."'>".$nombre."</a>, ";
							}
							
						}
						echo "</p>";
						$todosActores=obtenerNombreIdActores();
						echo "<p style='color: red;font-size:13px;'>*Si no quieres que los actores que tiene registrados esta película en este momento se borren, debes seleccionar a esos actores tambien en la lista de abajo cuando quieras añadir más actores.</p>";
						echo "<p><b>Añadir mas actores:</b></p><select name='selActores[]' id='selActores[]' multiple size='8' required>";
							while($fila=mysql_fetch_array($todosActores)){
								echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
							}
						echo "</select><br/>";
						
						echo "<p><b>Critica:</b></p>";
						echo "<p><textarea name='tAreaCritica' id='tAreaCritica' required>".$pelicula['critica']."</textarea></p>";
						echo "<p><b>Url de Youtube del trailer:</b> <input type='text' name='tTrailer' id='tTrailer' value='".$pelicula['video']."' maxlength='42' size='45' required /></p>";
						echo "<p><b>Precio de venta al público:</b> <input type='text' name='tPrecio' id='tPrecio' value='".$pelicula['precio']."' maxlength='5' size='4' required /></p>";
						
						echo "<input type='hidden' name='hIdPelicula' id='hIdPelicula' value='".$id."' />";
						echo "<input type='submit' name='bModPelicula' id='bModPelicula' value='Confirmar modificación' class='botonRojo' style='margin-top: 20px;' />";
					echo "</div>";
					echo "</div>";
					echo "</form>";
					
					$consulta="SELECT ID_NOTICIA  FROM NOTICIAS where ID_PELICULA=$id;";	
					$IDS=array();
					nuevaConexionBd();
					$resultado=mysql_query($consulta);
					while($fila=mysql_fetch_array($resultado)){
						$IDS[$i]=$fila[0];
						$i++;
						}
					if(!empty($IDS)){
					echo "<div class='cajaMostrar'>";
						echo "<h1>Noticias Relacionadas</h1>";
						echo "<hr />";
						
						foreach($IDS as $j=>$idN){
							$noticia=obtenerDescNoticia($idN);
							
							echo "<a href='verNoticia.php?parametro=$idN'><div class='cajitasIzq'>";
								echo "<div class='caja_foto'>";
									echo "<img src='imagenes/noticias/".$noticia['imagen']."' height='150' width='100' />";
								echo "</div>";
								echo "<div class='caja_texto'>";
									echo "<p>21-03-2013</p>";
									echo "<h4>".$noticia['titulo']."</h4>";
									echo "<p>".$noticia['desc']."..</p>";
								echo "</div>";
							echo "</div></a>";
						}
						echo "</div>";
					}
					echo "<div class='cajaMostrar'>";
						
						$comentarios=obtenerComentarios($id);
							
							if(!empty($comentarios)){
								echo "<h1>Comentarios</h1>";
								echo "<hr />";
								for($i=0;$i<count($comentarios);$i++){
									echo "<div class='cajaComent'>";
										echo "<div class='titularComent'>";
											echo "<p>Por <b>".$comentarios[$i]['nick']."</b> el ".$comentarios[$i]['fecha']."<a href='eliminarComentario.php?param=".$comentarios[$i]['id']."' style='float:right' ><img src='../imagenes/delete.png' style='width:17px;height:17px;'  /></a></p>";
										echo "</div>";
										echo "<div class='contenidoComent'>";
											echo "<p>".$comentarios[$i]['coment']."</p><br />";
										echo "</div>";
									echo "</div>";
								}
							}
							
							
							
						
						
						
						echo "</div>";
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