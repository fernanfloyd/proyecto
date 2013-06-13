<?php
	session_start();
	include("funciones/funciones.php");
	include("funciones/top.php");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link href="imagenes/favicon.ico" rel="shortcut icon" />
		<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
		<link href='http://fonts.googleapis.com/css?family=Homenaje' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css' />		
		<link rel="stylesheet" type="text/css" href="estilos/index.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="estilos/estrenos.css" media="all"/>
		<script language="javaScript" src="funciones/funciones.js"></script>
		
		<link rel='stylesheet' id='camera-css'  href='estilos/camera.css' type='text/css' media='all'> 
		 
		<script type='text/javascript' src='funciones/jquery.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.mobile.customized.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.easing.1.3.js'></script> 
		<script type='text/javascript' src='funciones/camera.min.js'></script>
		<script type='text/javascript' src='funciones/funciones.js'></script>
		<script type='text/javascript' src='funciones/comprar.js'></script>
		
		<script>
			jQuery(function($){
			
				$('#ini').on("click",function(){
					$('#logA').fadeToggle(600, "linear");
				});
				
				$("#ini").toggle(function(){
					$(".flechita").attr("src", "imagenes/up_arrow.png");
				},function(){
					$(".flechita").attr("src", "imagenes/down_arrow.png");
				});
				
			});
		</script>
		
		<title>ImpactFilm | Titulo de Pelicula</title>
	</head>
	<body>
					
			<header>
				<a href="index.php"><img src="imagenes/logo-cabecera.png" title="ImpactFilm | Todo el cine a tu alcance" /></a>
				<div class="saludo"> 
					<?php 
						if(empty($_SESSION['usuario'])){
							echo "<div id='ini' style='margin:10px 50px;cursor:pointer;'><img src='imagenes/login.png' width='15' heigth='15' style='margin:0 8px 0 0;vertical-align: middle;' />Iniciar sesi�n<img class='flechita' src='imagenes/down_arrow.png' width='20' heigth='20' style='margin:0 0 0 8px;vertical-align: middle;' /></div>";
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
							<input type="password" placeholder="contrase�a" name='pClave' id='pClave' /><br />
							<input type="submit" value="Iniciar sesi�n" name='bLogin' id='bLogin' /><br />
							<p style="text-align:center;background-color:#DCD6D6;margin-bottom:15px;"><a href='registro.php' style="">reg�strate aqu�</a></p>
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
				<?php
				if(empty($_GET['parametro'])){
					echo "NO hay ninguna peli seleccionada";	
				}else{
					$id=$_GET['parametro'];
					$pelicula=obtenerTodoPelicula($id);
					echo "<h1>".$pelicula['titulo']."</h1><hr />";
					echo "<div class='cajaMostrar'>";
					echo "<div class='cajaFoto'>";
						echo "<img src='imagenes/peliculas/".$pelicula['imagen']."' height='300' width='200' />";
					echo "</div>";
					echo "<div class='cajaDatos'>";
						echo "<p><b>A�o:</b> ".$pelicula['anio']."</p>";
						echo "<p><b>Duracion:</b> ".$pelicula['duracion']." min</p>";
						echo "<p><b>Director:</b> ".$pelicula['director']."</p>";
						echo "<p><b>Pais:</b> ".$pelicula['pais']."</p>";
						$generos=obtenerGeneros($id);
						$longGeneros=count($generos);
						$actores=obtenerActores($id);
						$longActores=count($actores);
						echo "<p><b>Generos:</b> ";
						
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
						echo "<p><b>Actores:</b> ";
						
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
						echo "<p><b>Critica:</b><br />";
						echo "<p>".$pelicula['critica']."</p>";
						echo "<p><b>Trailer:</b><br />";
						$idYoutube=substr($pelicula['video'], 31);
						echo "<p><iframe type='text/html' width='540' height='385' src='http://www.youtube.com/embed/".$idYoutube."' frameborder='0'></iframe></p>";
						
					echo "</div>";
					echo "</div>";
					
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
						
						if(empty($_SESSION['usuario'])){
							$comentarios=obtenerComentarios($id);
							
							if(!empty($comentarios)){
								echo "<h1>Comentarios</h1>";
								echo "<hr />";
								for($i=0;$i<count($comentarios);$i++){
									echo "<div class='cajaComent'>";
										echo "<div class='titularComent'>";
											echo "<p>Por <b>".$comentarios[$i]['nick']."</b> el ".$comentarios[$i]['fecha']."</p>";
										echo "</div>";
										echo "<div class='contenidoComent'>";
											//echo "<p>".$comentarios[$i]['fecha']."</p>";
											echo "<p>".$comentarios[$i]['coment']."</p><br />";
										echo "</div>";
									echo "</div>";
								}
							}
							
							
							
						}else{
							$comentarios=obtenerComentarios($id);
							
							echo "<h1>Comentarios</h1>";
							echo "<hr />";
							for($i=0;$i<count($comentarios);$i++){
								echo "<div class='cajaComent' style='margin-top:5px;'>";
									echo "<div class='titularComent'>";
										echo "<p>Por <b>".$comentarios[$i]['nick']."</b> el ".$comentarios[$i]['fecha']."</p>";
									echo "</div>";
									echo "<div class='contenidoComent'>";
									//echo "<p>".$comentarios[$i]['fecha']."</p>";
										echo "<p><span style='float:left;'><img src='imagenes/comentario.png' style='width=20px;height:20px;' /></span>".$comentarios[$i]['coment']."</p><br />";
									echo "</div>";
								echo "</div>";
								
							}
							echo "<p>Publicar un comentario de la pelicula:</p>";
							echo "<form method='POST' action='insertarComent.php?parametro=$id'>";
								echo "<textarea name='coment' id='coment' rows='10' cols='40' placeholder='Escribe tu comentario...'>";
								echo "</textarea><br />";
								echo "<input type='submit' name='bSubmit' id='bSubmit' value='Enviar' class='botonCompra' />";
							echo "</form>";
						}
						
						
						echo "</div>";
					}
				?>
									
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
			<aside class="top10ventas">
				<h1>Twitter</h1>
				<hr />
				 <a href="https://twitter.com/Impact_Film" class="twitter-follow-button" data-show-count="false" data-lang="es">Sigue a @Impact_Film</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<br/>
				<a class="twitter-timeline" height="400px" data-border-color="black" data-chrome="noscrollbar nofooter noheader" href="https://twitter.com/Impact_Film"  data-widget-id="344761264238632961">Tweets por @Impact_Film</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</aside>
			
			<!--<aside class="top10ventas">
				<h1>Proximos estrenos</h1>
				<hr />
				<ul  class="asiEstadisticas" style="list-style:disc;-webkit-padding-start: 20px;line-height: 1.5em;">
					<li>A todo gas 6</li>
					<li>El ultimo testigo</li>
					<li>Star Trek: En la oscuridad</li>
					<li>R3sac�n</li>
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
		<footer><a href="index.html"><img src="imagenes/logo-pie.png" title="ImpactFilm | Todo el cine a tu alcance" /></a></footer>
	</body>
</html>