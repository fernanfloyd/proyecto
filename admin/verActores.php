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
		<title>ImpactFilm | Ver Actores</title>
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
				<h1>Administrar actores</h1>
				<hr />
				<div class="cajaSeleccion" style='background-color: white;'>
					<p><a href="nuevoActor.php"><input type='button' class='botonRojo' name='bNuevoActor' id='bNuevoActor' value='Nuevo actor' /></a></p>
				</div>
				<?php
					if(empty($_GET['parametro'])){
						$consulta="SELECT ID_ACTOR  FROM ACTORES;";
					}else{
						$a=$_GET['parametro'];
						if($_GET['parametro']=="1"){
							$consulta="SELECT ID_ACTOR FROM ACTORES WHERE ABS(TRUNC(MONTHS_BETWEEN(FECHA_NAC,SYSDATE)/12))<'60';";
						}
						if($_GET['parametro']=="2"){
							$consulta="SELECT ID_ACTOR FROM ACTORES WHERE ABS(TRUNC(MONTHS_BETWEEN(FECHA_NAC,SYSDATE)/12)) BETWEEN '59' AND '40';";
						}
						if($_GET['parametro']=="3"){
							$consulta="SELECT ID_ACTOR FROM ACTORES WHERE anio='$a';";
						}
						if($_GET['parametro']=="4"){
							$consulta="SELECT ID_ACTOR FROM ACTORES WHERE anio<'$a';";
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
									echo "<p>".$dia."-".$mes."-".$anno." <span style='float:right;'><a href='borrarActor.php?parametro=".$id."' onclick='return deleteActorConfirm()'><img src='../imagenes/delete.png' title='Borrar a ".$actor['nombre']."' style='width:17px;height:17px;'  /></a><a href='verActor.php?parametro=".$id."'><img src='../imagenes/modify.png' title='Modificar a ".$actor['nombre']."' style='width:15px;height:15px;' /></a></span></p>";
									echo "<h4>".$actor['nombre']."</h4>";
									echo "<p>".$actor['desc']."..</p>";
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