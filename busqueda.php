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
		
			<section style='min-height: 700px;'>
				<?php
				if(empty($_GET['s'])){
					echo "No hay ningún resultado para tu busqueda";	
				}
				else{
					$busqueda=$_GET['s'];
					echo "<br/><p>Resultados para la busqueda: <b>".$busqueda."</b></p>";
					//PARA BUSCAR NOTICIAS
					$consulta="SELECT DISTINCT(N.ID_NOTICIA) FROM NOTICIAS N, PELICULAS P WHERE N.ID_PELICULA=P.ID_PELICULA AND P.TITULO LIKE '%$busqueda%' OR N.TITULO LIKE '%$busqueda%' OR N.DESCRIPCION LIKE '$busqueda%' OR N.TEXTO_NOTICIA LIKE '$busqueda%';";
					$i=0;
					$IDS_NOTICIAS=array();
					nuevaConexionBd();
					$resultado=mysql_query($consulta);
					while($fila=mysql_fetch_array($resultado)){
						$IDS_NOTICIAS[$i]=$fila[0];
						$i++;
					}
					
					if(!empty($IDS_NOTICIAS)){
						echo "<h1>Noticias relacionadas</h1><hr />";
						foreach($IDS_NOTICIAS as $j=>$id){
							$noticia=obtenerDescNoticia($id);
							echo "<a href='verNoticia.php?parametro=$id'><div class='cajitasIzq'>";
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
						echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
					}
					
					//PARA BUSCAR PELICULAS
					$consulta="SELECT DISTINCT(P.ID_PELICULA) FROM PELICULAS P, ACTORES A, ACTUA AC WHERE P.ID_PELICULA=AC.ID_PELICULA AND AC.ID_ACTOR=A.ID_ACTOR AND A.NOMBRE_APE LIKE '%$busqueda%' OR P.TITULO LIKE '%$busqueda%' OR P.DESCRIPCION LIKE '%$busqueda%' OR P.CRITICA LIKE '%$busqueda%' OR P.DIRECTOR LIKE '%$busqueda%' OR P.PAIS LIKE '%$busqueda%';";
					$i=0;
					$IDS_PELIS=array();
					nuevaConexionBd();
					$resultado=mysql_query($consulta);
					while($fila=mysql_fetch_array($resultado)){
						$IDS_PELIS[$i]=$fila[0];
						$i++;
					}
					
					if(!empty($IDS_PELIS)){
						echo "<h1>Peliculas relacionadas</h1><hr />";
						foreach($IDS_PELIS as $j=>$id){
							$pelicula=obtenerDescPeli($id);
							echo "<a href='verPelicula.php?parametro=$id'><div class='cajitasIzq'>";
								echo "<div class='caja_foto'>";
									echo "<img src='imagenes/peliculas/".$pelicula['imagen']."' height='150' width='100' />";
								echo "</div>";
								echo "<div class='caja_texto'>";
									echo "<p>21-03-2013</p>";
									echo "<h4>".$pelicula['titulo']."</h4>";
									echo "<p>".$pelicula['desc']."..</p>";
								echo "</div>";
							echo "</div></a>";
						}
						echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
					}
					
					//PARA BUSCAR ACTORES
					$consulta="SELECT DISTINCT(A.ID_ACTOR) FROM ACTORES A, PELICULAS P, ACTUA AC WHERE P.ID_PELICULA=AC.ID_PELICULA AND AC.ID_ACTOR=A.ID_ACTOR AND P.TITULO LIKE '%$busqueda%' OR A.NOMBRE_APE LIKE '%$busqueda%' OR A.DESCRIPCION LIKE '%$busqueda%' OR A.CARRERA LIKE '%$busqueda%';";
					$i=0;
					$IDS_ACTORES=array();
					nuevaConexionBd();
					$resultado=mysql_query($consulta);
					while($fila=mysql_fetch_array($resultado)){
						$IDS_ACTORES[$i]=$fila[0];
						$i++;
					}
					
					if(!empty($IDS_ACTORES)){
						echo "<h1>Actores relacionados</h1><hr />";
						foreach($IDS_ACTORES as $j=>$id){
							$actor=obtenerDescActor($id);
							echo "<a href='verActor.php?parametro=$id'><div class='cajitasIzq'>";
								echo "<div class='caja_foto'>";
									echo "<img src='imagenes/actores/".$actor['imagen']."' height='150' width='100' />";
								echo "</div>";
								echo "<div class='caja_texto'>";
									echo "<p>21-03-2013</p>";
									echo "<h4>".$actor['nombre']."</h4>";
									echo "<p>".$actor['desc']."..</p>";
								echo "</div>";
							echo "</div></a>";
						}
						echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
					}
					
					if(empty($IDS_NOTICIAS) && empty($IDS_PELIS) && empty($IDS_ACTORES)){
						echo "<div class='cajitasIzq'>";
							echo "<p>Lo sentimos, no hay ninguna busqueda relacionada</p>";
						echo "</div>";
						echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
					}
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