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
							echo "<div class='cajitasIzq'>";
								echo "<div class='caja_foto'>";
									echo "<img src='../imagenes/noticias/".$noticia['imagen']."' height='150' width='100' />";
								echo "</div>";
								echo "<div class='caja_texto'>";
									echo "<p>21-03-2013<span style='float:right;'><a href='borrarNoticia.php?parametro=".$id."'><img src='../imagenes/delete.png' title='Borrar la noticia ".$noticia['titulo']."' style='width:17px;height:17px;'  /></a><a href='verNoticia.php?parametro=".$id."'><img src='../imagenes/modify.png' title='Modificar la noticia ".$noticia['titulo']."' style='width:15px;height:15px;' /></a></span></p>";
									echo "<h4>".$noticia['titulo']."</h4>";
									echo "<p>".$noticia['desc']."..</p>";
								echo "</div>";
							echo "</div>";
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
							echo "<div class='cajitasIzq'>";
								echo "<div class='caja_foto'>";
									echo "<img src='../imagenes/peliculas/".$pelicula['imagen']."' height='150' width='100' />";
								echo "</div>";
								echo "<div class='caja_texto'>";
									echo "<p>".$pelicula['anio']."<span style='float:right;'><a href='borrarPelicula.php?parametro=".$id."'><img src='../imagenes/delete.png' title='Borrar la pelicula ".$pelicula['titulo']."' style='width:17px;height:17px;'  /></a><a href='verPelicula.php?parametro=".$id."'><img src='../imagenes/modify.png' title='Modificar la pelicula ".$pelicula['titulo']."' style='width:15px;height:15px;' /></a></span></p>";
									echo "<h4>".$pelicula['titulo']."</h4>";
									echo "<p>".$pelicula['desc']."..</p>";
								echo "</div>";
							echo "</div>";
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
							echo "<div class='cajitasIzq'>";
								echo "<div class='caja_foto'>";
									echo "<img src='../imagenes/actores/".$actor['imagen']."' height='150' width='100' />";
								echo "</div>";
								echo "<div class='caja_texto'>";
									$fech = $actor['f_nac'];
									$fecha = explode("-", $fech);
									$dia = $fecha[2];
									$mes = $fecha[1];
									$anno = $fecha[0];
									echo "<p>".$dia."-".$mes."-".$anno." <span style='float:right;'><a href='borrarActor.php?parametro=".$id."'><img src='../imagenes/delete.png' title='Borrar a ".$actor['nombre']."' style='width:17px;height:17px;'  /></a><a href='verActor.php?parametro=".$id."'><img src='../imagenes/modify.png' title='Modificar a ".$actor['nombre']."' style='width:15px;height:15px;' /></a></span></p>";
									echo "<h4>".$actor['nombre']."</h4>";
									echo "<p>".$actor['desc']."..</p>";
								echo "</div>";
							echo "</div>";
						}
						echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
					}
					
					
					if(empty($IDS_NOTICIAS) && empty($IDS_PELIS) && empty($IDS_ACTORES)){
						echo "<div class='cajitasIzq'>";
							echo "<p>Lo sentimos, no hay ninguna busqueda relacionada</p>";
						echo "</div>";
						echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
					}
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