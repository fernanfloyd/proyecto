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
				<h1>Peliculas</h1>
				<hr />
				<div class="cajaSeleccion" style='background-color: white;'>
					<p><a href="nuevaPelicula.php"><input type='button' class='botonRojo' name='bNuevaPelicula' id='bNuevaPelicula' value='Nueva película' /></a></p>
				</div>
				<div class="cajaSeleccion">
					<div class="dentro"><a href="verPeliculas.php"><p class="men">Todas</p></a></div>
					<div class="dentro"><a href="verPeliculas.php?parametro=2013"><p class="men">2013</p></a></div>
					<div class="dentro"><a href="verPeliculas.php?parametro=2012"><p class="men">2012</p></a></div>
					<div class="dentro"><a href="verPeliculas.php?parametro=2011"><p class="men">2011</p></a></div>
					<div class="dentro"><a href="verPeliculas.php?parametro=2010"><p class="men">2010 y ant</p></a></div>
				</div>
				<?php
					if(empty($_GET['parametro'])){
						$consulta="SELECT ID_PELICULA FROM peliculas;";
					}else{
						$a=$_GET['parametro'];
						if($_GET['parametro']=="2013"){
							$consulta="SELECT ID_PELICULA FROM peliculas WHERE anio='$a';";
						}
						if($_GET['parametro']=="2012"){
							$consulta="SELECT ID_PELICULA FROM peliculas WHERE anio='$a';";
						}
						if($_GET['parametro']=="2011"){
							$consulta="SELECT ID_PELICULA FROM peliculas WHERE anio='$a';";
						}
						if($_GET['parametro']=="2010"){
							$consulta="SELECT ID_PELICULA FROM peliculas WHERE anio<'$a';";
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
							echo "<div class='cajitasIzq'>";
								echo "<div class='caja_foto'>";
									echo "<img src='../imagenes/peliculas/".$pelicula['imagen']."' height='150' width='100' />";
								echo "</div>";
								echo "<div class='caja_texto'>";
									echo "<p>".$pelicula['anio']."<span style='float:right;'><a href='borrarPelicula.php?parametro=".$id."' onclick='return deletePeliculaConfirm()'><img src='../imagenes/delete.png' title='Borrar la pelicula ".$pelicula['titulo']."' style='width:17px;height:17px;'  /></a><a href='verPelicula.php?parametro=".$id."'><img src='../imagenes/modify.png' title='Modificar la pelicula ".$pelicula['titulo']."' style='width:15px;height:15px;' /></a></span></p>";
									echo "<h4>".$pelicula['titulo']."</h4>";
									echo "<p>".$pelicula['desc']."..</p>";
								echo "</div>";
							echo "</div>";
						}
					}else{
						echo "<div class='cajitasIzq'>";
						echo "<p>No hay peliculas en esta categoria</p>";
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