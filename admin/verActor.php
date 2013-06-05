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
		<script>
			jQuery(function($){
				$.datepicker.setDefaults( $.datepicker.regional[ "es" ] );
				$( "#datepicker" ).datepicker();
			});
		</script>
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
				if(empty($_GET['parametro'])){
					echo "NO hay ningun actor seleccionada";	
				}else{
					echo "<form enctype='multipart/form-data' id='formModActor' name='formModActor' action='modificarActor.php' method='post' onsubmit='return modifyActorConfirm()'>";
					$id=$_GET['parametro'];
					$actor=obtenerTodoActor($id);
					//esto va sin formato, solo los datos
					echo "<h1>".$actor['nombre']."</h1><hr />";
					echo "<div class='cajaMostrar'>";
					echo "<div class='cajaFoto'>";
						echo "<img src='../imagenes/actores/".$actor['imagen']."' height='300' width='200' />";
						echo "<input type='hidden' name='hFotoActual' id='hFotoActual' value='".$actor['imagen']."' />";
						echo "<div class='custom-input-file'><input type='file' name='fFotoActor' id='fFotoActor' size='1' class='input-file' />Cambiar foto</div>";
					echo "</div>";
					echo "<div class='cajaDatos'>";
						echo "<p><b>Nombre y apellidos:</b> <input type='text' name='tNombreApe' id='tNombreApe' value='".$actor['nombre']."' maxlength='50' required /></p>";
						$fech = $actor['anio'];
						$fecha = explode("-", $fech);
						$dia = $fecha[2];
						$mes = $fecha[1];
						$anno = $fecha[0];
						echo "<p><b>Fecha Nacimiento:</b> <input type='text' name='datepicker' id='datepicker' value='".$dia."-".$mes."-".$anno."' required /></p>";
						echo "<p><b>Nacionalidad:</b> <input type='text' name='tNacionalidad' id='tNacionalidad' value='".$actor['pais']."' maxlength='30' required /></p>";
						echo "<p><b>Carrera:</b> </p>";
						echo "<p><textarea name='tAreaCarrera' id='tAreaCarrera' required>".$actor['carrera']."</textarea></p>";
						$peliculas=obtenerPeliculas($id);
						echo "<p><b>Peliculas registradas actualmente para este actor: </b>";
						foreach($peliculas as $i=>$p){
							$nombre=obtenerNombrePelicula($p);
							echo "<a href='verPelicula.php?parametro=".$p."'>".$nombre."</a>, ";
						}
						echo "</p>";
						$todasPeliculas=obtenerNombreIdPeliculas();
						echo "<p style='color: red;font-size:13px;'>*Si no quieres que las peliculas que tiene registradas este actor en este momento se borren, debes seleccionarla tambien en la lista de abajo cuando quieras añadir más peliculas.</p>";
						echo "<p><b>Añadir más peliculas: </b> </p><select name='selPeliculas[]' id='selPeliculas[]' multiple size='8' required>";
							while($fila=mysql_fetch_array($todasPeliculas)){
								echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
							}
						echo "</select><br/>";
						echo "<input type='hidden' name='hIdActor' id='hIdActor' value='".$id."' />";
						echo "<input type='submit' name='bModActor' id='bModActor' value='Confirmar modificación' class='botonRojo' style='margin-top: 20px;' />";
					echo "</div>";
					echo "</div>";
					echo "</form>";
					
					$consulta="SELECT ID_NOTICIA  FROM NOTICIAS where ID_ACTOR=$id;";	
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
									echo "<img src='../imagenes/noticias/".$noticia['imagen']."' height='150' width='100' />";
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