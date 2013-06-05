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
		
		<style>
			th{
				background-color: #FE5151;
				padding: 5px 40px;
			}
			td{
				text-align: center;
				padding: 10px;
			}
			.cajaTablaPeliculas{
				width: 735px;
				margin: 0 auto;
			}
		</style>
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
					echo "<h1>Comentarios</h1><hr />";
					echo "<div class='cajitasIzq'>";
							echo "<p>No ha introducido ningun parametro</p>";
					echo "</div>";		
				}else{
					$idPeli=$_GET['parametro'];
					$pelicula=obtenerDescPeli($idPeli);
					echo "<h1>Comentarios sobre ".$pelicula['titulo']."</h1><hr />";
					$consulta="SELECT * FROM comentarios WHERE id_pelicula=$idPeli;";
					$i=0;
					$IDS=array();
					nuevaConexionBd();
					$resultado=mysql_query($consulta);
					while($fila=mysql_fetch_array($resultado)){
						$IDS[$i]['idCom']=$fila[0];
						$IDS[$i]['idUsu']=$fila[1];
						$IDS[$i]['fecha']=$fila[3];
						$IDS[$i]['comentario']=$fila[4];
						$i++;
						}
					if(!empty($IDS)){
						foreach($IDS as $j){
							$nick=obtenerNickUsuario($j['idUsu']);
							echo "<div class='cajaComent'>";
								echo "<div class='titularComent'>";
									echo "<p>Por <b>".$nick."</b> el ".$j['fecha']."<a href='eliminarComentario.php?param=".$j['idCom']."&peli=".$idPeli."' style='float:right' onclick='return deleteComentarioConfirm()'><img src='../imagenes/delete.png' title='Eliminar comentario' style='width:17px;height:17px;'  /></a><a href='censurarComentario.php?param=".$j['idCom']."&peli=".$idPeli."' style='float:right' onclick='return censoreComentarioConfirm()'><img src='../imagenes/censurar.png' title='Censurar comentario' style='width:17px;height:17px;'  /></a></p>";
								echo "</div>";
								echo "<div class='contenidoComent'>";
									echo "<p>".$j['comentario']."</p><br />";
								echo "</div>";
							echo "</div>";
						}
					}else{
						header("Location:verComentarios.php");
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