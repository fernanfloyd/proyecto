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
		
		<title>ImpactFilm | Noticias</title>
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
		
			<section>
				<h1>Noticias</h1>
				<hr />
				<!--<div class="cajaSeleccion"><p>
					<a href="verActores.php">Tod@s</a>&nbsp;
					<a href="verActores.php?parametro=1">Mayores de 60 años</a>&nbsp;
					<a href="verActores.php?parametro=2">Entre 60 y 40 años</a>&nbsp;
					<a href="verActores.php?parametro=3">Entre 40 y 20 años</a>&nbsp;
					<a href="verActores.php?parametro=4">Menores de 20 años</a>&nbsp; 
				</p></div>-->
				<?php
					if(empty($_GET['parametro'])){
						$consulta="SELECT ID_NOTICIA  FROM NOTICIAS;";
					}else{
					//LA FECHA ME DA ERROR, MIRAR ALGUNO SI PODEIS
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
					}else{
						echo "<div class='cajitasIzq'>";
						echo "<p>No hay Noticias</p>";
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
				<h1>Proximos estrenos</h1>
				<hr />
				<ul  class="asiEstadisticas" style="list-style:disc;-webkit-padding-start: 20px;line-height: 1.5em;">
					<li>A todo gas 6</li>
					<li>El ultimo testigo</li>
					<li>Star Trek: En la oscuridad</li>
					<li>R3sacón</li>
					<li>Antes del anochecer</li>
					<li>Epic: El reino secreto</li>
					<li>After Earth</li>
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
		<footer><a href="index.html"><img src="imagenes/logo-pie.png" title="ImpactFilm | Todo el cine a tu alcance" /></a></footer>
	</body>
</html>