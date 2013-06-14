<?php
	session_start();
	include("funciones/cargaPrincipal.php");
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
		<link rel='stylesheet' id='camera-css'  href='estilos/camera.css' type='text/css' media='all'>
		<link rel='stylesheet' type='text/css' href='estilos/index.css' media='all' />
		<script type='text/javascript' src='funciones/jquery.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.mobile.customized.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.easing.1.3.js'></script> 
		<script type='text/javascript' src='funciones/camera.min.js'></script>
		<script type='text/javascript' src='funciones/funciones.js'></script>
		<script type='text/javascript' src='funciones/comprar.js'></script>
		
    	
		<script>
			jQuery(function($){
			
				jQuery('#camera_wrap_1').camera({
					height: '375px',
					thumbnails: true
				});
				
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
							<input type="submit" value="Iniciar sesión" name='bLogin' id='bLogin' style='cursor:pointer;' /><br />
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
			<div class="fluid_container">
    	
				<div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
					<div data-thumb="imagenes/slides/thumbs/BATMAN.jpg" data-src="imagenes/slides/BATMAN.jpg" data-link="verPelicula.php?parametro=1">
						<div class="camera_caption fadeFromBottom">
							"El caballero oscuro: la leyenda renace" llega para hacer trizas la taquilla
						</div>
					</div>
					<div data-thumb="imagenes/slides/thumbs/avatar.jpg" data-src="imagenes/slides/avatar.jpg" data-link="verPelicula.php?parametro=3">
						<div class="camera_caption fadeFromBottom">
							"Avatar", la última obra maestra de James Cameron
						</div>
					</div>
					<div data-thumb="imagenes/slides/thumbs/The-Expendables-2.jpg" data-src="imagenes/slides/The-Expendables-2.jpg" data-link="verPelicula.php?parametro=2">
						<div class="camera_caption fadeFromBottom">
							Jean Claude Van Damme se incorpora al reparto de la segunda parte de "Los mercenarios"
						</div>
					</div>
					<div data-thumb="imagenes/slides/thumbs/American-Pie-Reencuentro.jpg" data-src="imagenes/slides/American-Pie-Reencuentro.jpg" data-link="verPelicula.php?parametro=12">
						<div class="camera_caption fadeFromBottom">
							¿Qué fue de los protagonistas de "American Pie"? Para Jim, Michelle y los demás, el tiempo no ha pasado en balde
						</div>
					</div>
					<div data-thumb="imagenes/slides/thumbs/iron-man-3.jpg" data-src="imagenes/slides/iron-man-3.jpg" data-link="verPelicula.php?parametro=13">
						<div class="camera_caption fadeFromBottom">
							"Iron Man 3" arrasa en su primer fin de semana en España.
						</div>
					</div>
				</div>
			</div>


			<section>
				<h1>Home</h1>
				<hr />
				<?php 
				$peliculas=all_peli();
				$numeros=array_rand($peliculas,4);
				$actores=all_actor();
				$nActores=array_rand($actores,3);
				$noticias=all_noti();
				$nNoticias=array_rand($noticias,3);
				$peli_1=peli($peliculas[$numeros[0]]);
				$peli_2=peli($peliculas[$numeros[1]]);
				$peli_3=peli($peliculas[$numeros[2]]);
				$peli_4=peli($peliculas[$numeros[3]]);
				$actor_1=actor($actores[$nActores[0]]);
				$actor_2=actor($actores[$nActores[1]]);
				$actor_3=actor($actores[$nActores[2]]);
				$noti_1=noticia($noticias[$nNoticias[0]]);
				$noti_2=noticia($noticias[$nNoticias[1]]);
				$noti_3=noticia($noticias[$nNoticias[2]]);
				?>
				<a href="verPelicula.php?parametro=<?php echo $peli_1['id']; ?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php						
							echo "<img src='imagenes/peliculas/".$peli_1['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $peli_1['titulo'];?></h4>
						<p><?php echo $peli_1['desc'];?>..</p>
					</div>
				</div></a>
				<a href="verActor.php?parametro=<?php echo $actor_1['id']; ?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php						
							echo "<img src='imagenes/actores/".$actor_1['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $actor_1['nombre'];?></h4>
						<p><?php echo $actor_1['desc'];?>..</p>
					</div>
				</div></a>
				<a href="verPelicula.php?parametro=<?php echo $peli_2['id']; ?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php						
							echo "<img src='imagenes/peliculas/".$peli_2['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $peli_2['titulo'];?></h4>
						<p><?php echo $peli_2['desc'];?>..</p>
					</div>
				</div></a>
				<a href="verActor.php?parametro=<?php echo $actor_2['id']; ?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php						
							echo "<img src='imagenes/actores/".$actor_2['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $actor_2['nombre'];?></h4>
						<p><?php echo $actor_2['desc'];?>..</p>
					</div>
				</div></a>
				
				<a href="verNoticia.php?parametro=<?php echo $noti_1['id'];?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php				
							echo "<img src='imagenes/noticias/".$noti_1['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $noti_1['titulo'];?></h4>
						<p><?php echo $noti_1['desc'];?>..</p>
					</div>
				</div></a>
				<a href="verNoticia.php?parametro=<?php echo $noti_2['id'];?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php						
							echo "<img src='imagenes/noticias/".$noti_2['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $noti_2['titulo'];?></h4>
						<p><?php echo $noti_2['desc'];?>..</p>
					</div>
				</div></a>
				
				<a href="verActor.php?parametro=<?php echo $actor_3['id']; ?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php						
						echo "<img src='imagenes/actores/".$actor_3['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $actor_3['nombre'];?></h4>
						<p><?php echo $actor_3['desc'];?>..</p>
					</div>
				</div></a>
				
				<a href="verPelicula.php?parametro=<?php echo $peli_3['id']; ?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php						
						echo "<img src='imagenes/peliculas/".$peli_3['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $peli_3['titulo'];?></h4>
						<p><?php echo $peli_3['desc'];?>..</p>
					</div>
				</div></a>
				
				<a href="verNoticia.php?parametro=<?php echo $noti_3['id'];?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php						
						echo "<img src='imagenes/noticias/".$noti_3['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $noti_3['titulo'];?></h4>
						<p><?php echo $noti_3['desc'];?>..</p>
					</div>
				</div></a>
				
				<a href="verPelicula.php?parametro=<?php echo $peli_4['id']; ?>"><div class="cajitasIzq">
					
					<div class="caja_foto">
						<?php						
						echo "<img src='imagenes/peliculas/".$peli_4['imagen']."' height='150' width='100' />";
						?>
					</div>
					<div class="caja_texto">
						<p>21-03-2013</p>
						<h4><?php echo $peli_4['titulo'];?></h4>
						<p><?php echo $peli_4['desc'];?>..</p>
					</div>
				</div></a>
				
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