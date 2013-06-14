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
		
		<link rel="stylesheet" type="text/css" href="estilos/tienda.css" media="all"/>
		<script language="javaScript" src="funciones/funciones.js"></script>
		
		<link rel='stylesheet' id='camera-css'  href='estilos/camera.css' type='text/css' media='all'> 
		 
		<script type='text/javascript' src='funciones/jquery.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.mobile.customized.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.easing.1.3.js'></script> 
		<script type='text/javascript' src='funciones/camera.min.js'></script>
		<script type='text/javascript' src='funciones/funciones.js'></script>
		<script type='text/javascript' src='funciones/comprar.js'></script>
		
    	<style>
			.cajitasIzq{
				width: 360px;
				height: 150px;
				/*border: 1px solid black;*/
				float: left;
				/*padding: 10px;*/
				margin-bottom: 30px;
					
			}
			.cajitasDer{
				width: 360px;
				height: 150px;
				/*border: 1px solid black;*/
				float: right;
				/*padding: 10px;*/
				margin-bottom: 30px;
					
			}
			.cajitasIzq:hover{
				background-color: #D7D2D2;	
			}
			.cajitasDer:hover{
				background-color: #D7D2D2;	
			}
			h4{
				color: grey;
				margin-bottom: 4px;
				margin-top: 4px;			
			}
			p{
				margin-top: 0px;
				margin-bottom: 0px;	
			}
			.caja_foto{
				
				width: 100px;
				float: left;
			}
			.caja_texto{
				width: 250px;
				float: left;
				padding: 5px;
				padding-top: 0;
			}
		</style>
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

			<section class="tienda">
				<h1>Tienda</h1>
				<hr />
				<div class="cajaSeleccion">
					<p>
						<div class="dentro"><a href="tienda.php"><p class="men">Todas</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=accion"><p class="men">Acción</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=thriller"><p class="men">Thriller</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=aventuras"><p class="men">Aventuras</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=cienciaFiccion"><p class="men">Ciencia ficción</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=terror"><p class="men">Terror</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=drama"><p class="men">Drama</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=fantastico"><p class="men">Fantástico</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=romance"><p class="men">Romance</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=belico"><p class="men">Bélico</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=intriga"><p class="men">Intriga</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=comedia"><p class="men">Comedia</p></a></div>
						<div class="dentro"><a href="tienda.php?parametro=western"><p class="men">Western</p></a></div>
					</p>
				</div>
				
				<?php
					echo "<br/><br/><br/>";
					if(empty($_GET['parametro'])){
						echo "<h3>Todas</h3>";
						$consulta="SELECT ID_PELICULA FROM peliculas WHERE ESTRENO=0 ORDER BY TITULO;";
					}else{
						$a=$_GET['parametro'];
						switch($a){
							case "accion":
								echo "<h3>Acción</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=1 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "thriller":
								echo "<h3>Thriller</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=2 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "aventuras":
								echo "<h3>Aventuras</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=3 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "cienciaFiccion":
								echo "<h3>Ciencia ficción</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=4 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "terror":
								echo "<h3>Terror</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=5 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "drama":
								echo "<h3>Drama</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=6 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "fantastico":
								echo "<h3>Fantástico</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=7 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "romance":
								echo "<h3>Romance</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=8 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "belico":
								echo "<h3>Bélico</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=9 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "intriga":
								echo "<h3>Intriga</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=10 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "comedia":
								echo "<h3>Comedia</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=11 AND ESTRENO=0 ORDER BY TITULO;";
								break;
							case "western":
								echo "<h3>Western</h3>";
								$consulta="SELECT P.ID_PELICULA FROM PELICULAS P, GENEROS G, GEN_PEL GP WHERE P.ID_PELICULA=GP.ID_PELICULA AND G.ID_GENERO=GP.ID_GENERO AND G.ID_GENERO=12 AND ESTRENO=0 ORDER BY TITULO;";
								break;
						}

					}
					$i=0;
					$IDS=array();
					nuevaConexionBd();
					$resultado=mysql_query($consulta);
					while($fila=mysql_fetch_array($resultado)){
						$IDS[$i]=$fila[0];
						$i++;
						}
					if(!empty($IDS)){
						foreach($IDS as $j=>$id){
							$pelicula=obtenerDescPeli($id);
							echo "<a href='verPelicula.php?parametro=$id'><div class='cajitasTienda'>";
								echo "<div class='caja_foto_tienda'>";
									echo "<img src='imagenes/caratulas/".$pelicula['imagen'].".png' height='150' width='100' />";
								echo "</div>";
								echo "<div class='caja_texto_tienda'>";
									echo "<h4>".$pelicula['titulo']."</h4>";
									echo "<p class='precio'><h4 class='azul'>".$pelicula['prec']."€</h4></p>";
								echo "</div>";
								echo "<div class='caja_texto_duracion_tienda'>";
									echo "<p class='precio'><h4>".$pelicula['durac']." minutos</h4></p>";
								echo "</div>";
								echo "<div class='caja_carrito'>";
									echo "<p class='carrito'><a href='comprar.php?parametro=".$id."'><img src='imagenes/shopcart.png' title='Añadir al carrito' /></a></p>";
								echo "</div>";
							echo "</div></a>";
						}
					}else{
						echo "<div class='cajitasIzq'>";
						echo "<p>No hay peliculas de este género</p>";
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