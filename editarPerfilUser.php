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
		<link rel="stylesheet" type="text/css" href="estilos/registro.css" media="all"/>
		<script type='text/javascript' src='funciones/jquery.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.mobile.customized.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.easing.1.3.js'></script> 
		<script type='text/javascript' src='funciones/comprar.js'></script>
		<script type='text/javascript' src='funciones/registro.js'></script>
		<script type='text/javascript' src='funciones/funciones.js'></script>
		<script language="javaScript" src="funciones/funciones.js"></script>
		<link rel='stylesheet' id='camera-css'  href='estilos/camera.css' type='text/css' media='all'> 
		
		<title>ImpactFilm | Editar perfil de usuario</title>
	</head>
	<body onload="carga_inicial_pais();">
					
			<header>
				<a href="index.php"><img src="imagenes/logo-cabecera.png" title="ImpactFilm | Todo el cine a tu alcance" /></a>
				<div class="saludo"> 
					<?php 
						if(empty($_SESSION['usuario'])){
							
						}else{
							if($_SESSION['rol']=="administrador"){
								header("Location:admin/index.php");
							}	
							$idU=extraerIdUsuario($_SESSION['usuario']);
							echo "Bienvenido: ".$_SESSION['usuario']." "."<br/><a href='editarPerfilUser.php?idUser=".$idU."'>Editar perfil</a><br/><a href='logout.php'>Salir</a>";
						}
					?>
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
				if(empty($_GET['idUser'])){
					echo "No hay ningún usuario seleccionado";	
				}else{
					$id=$_GET['idUser'];
					$datos=obtenerTodoUsuario($id);
					//esto va sin formato, solo los datos
					echo "<h1>Datos de registro</h1><hr />";
					echo "<div class='cajaMostrar'>";
						echo "<div class='cajaDatos'>";
							echo "<form name='formModPass' method='post' action='modificarU.php'>";
								echo "<div class='reg_izq'>";
									echo "<p class='caja3'>";
										echo "<label for='nombreUsuario'><b>Nombre usuario:</b></label><br />";
										echo "<label for='contraseña'><b>Contraseña actual:</b></label><br />";						
										echo "<label for='nuevaContraseña'><b>Nueva contraseña :</b></label><br />";
										echo "<label for='confNuevaContraseña'><b>Confirmar contraseña:</b></label><br />";
									echo "</p>";
								echo "</div>";
								echo "<div class='reg_der'>";
									echo "<p class='caja4'>";
										echo $datos['nick']."&nbsp;<br/>";
										echo "<input type='hidden' name='nickUsuario' value='".$datos['nick']."' />";
										echo "<input type='hidden' name='idUsuario' value='".$id."' />";
										echo "<input type='hidden' name='modificandoClave' value='modificandoClave' />";
										echo "<input type='password' name='pwdActual' size='12' maxlength='12' id='pwdActual' required />&nbsp;<br />";
										echo "<input type='password' name='pwdNueva' size='12' maxlength='12' id='pwdNueva' required />&nbsp;<br />";
										echo "<input type='password' name='conPwdNueva' size='12' maxlength='12' id='conPwdNueva' required />&nbsp;<br/>";
										echo "<input type='submit' name='modPass' id='modPass' value='Modificar contraseña' onclick='' class='botonCompra' />&nbsp;";
									echo "</p>";
								echo "</div>";
							echo "</form>";
						echo "</div>";
					echo "</div>";
					echo "<h1>Datos personales</h1><hr />";
					echo "<div class='cajaMostrar'>";
						echo "<div class='cajaDatos'>";
							echo "<form name='formModDatosPer' method='post' action='modificarU.php'>";
								echo "<div class='reg_izq'>";
									echo "<p class='caja3'>";
										echo "<label for='nombre'><b>Nombre:</b></label><br />";
										echo "<label for='apellidos'><b>Apellidos:</b></label><br />";
										echo "<label for='telefono'><b>Teléfono actual:</b></label><br />";
										echo "<label for='telefonoNuevo'><b>Teléfono nuevo:</b></label><br />";
										echo "<label for='mail'><b>Email actual:</b></label><br />";						
										echo "<label for='mailNuevo'><b>Email nuevo:</b></label><br />";
										echo "<label for='pais'><b>País actual:</b></label><br />";
										echo "<label for='pais'><b>País nuevo:</b></label><br />";
										echo "<label for='pais'><b>Fecha de nacimiento:</b></label><br />";
									echo "</p>";
								echo "</div>";
								echo "<div class='reg_der'>";
									echo "<p class='caja4'>";
										echo "<input type='hidden' name='nickUsuario' value='".$datos['nick']."' />";
										echo "<input type='hidden' name='idUsuario' value='".$id."' />";
										echo "<input type='hidden' name='modificandoDatosPersonales' value='modificandoDatosPersonales' />";
										echo $datos['nombre']."&nbsp;<br/>";
										echo $datos['apellidos']."&nbsp;<br/>";
										echo $datos['telefono']."&nbsp;<br/>";
										echo "<input type='text' name='telefonoNuevo' size='20' maxlength='15' id='txttelefono' />&nbsp;<br />";
										echo $datos['email']."&nbsp;<br/>";
										echo "<input type='email' name='correo' size='20' maxlength='40' id='txtmail' onblur='comprobarMailEnBD()' />&nbsp;<br />";
										echo $datos['pais']."&nbsp;<br/>";
										echo "<select name='pais' style='width: 190px' id='pais'></select>&nbsp;<br/>";
										$fech = $datos['f_nac'];
										$fecha = explode("-", $fech);
										$dia = $fecha[2];
										$mes = $fecha[1];
										$anno = $fecha[0];
										echo $dia."-".$mes."-".$anno."&nbsp;<br/>";
										echo "<input type='submit' name='modDatPer' id='modDatPer' value='Modificar datos personales' onclick='' class='botonCompra' />&nbsp;";
									echo "</p>";
								echo "</div>";
							echo "</form>";
						echo "</div>";
					echo "</div>";
					echo "<h1>Datos de envío y pago</h1><hr />";
					echo "<div class='cajaMostrar'>";
						echo "<div class='cajaDatos'>";
							if($datos['n_tarjeta']==""){
								echo "<p>No hay ningún número de tarjeta asociado a esta cuenta de usuario</p>";
								echo "<p>Añade una tarjeta ahora para poder realizar compras en ImpactFilm</p>";
								echo "<br/>";
								echo "<form name='formAnadirDatosEnvPag' method='post' action='modificarU.php'>";
									echo "<div class='reg_izq'>";
										echo "<p class='caja3'>";
											echo "<label for='direccion'><b>Dirección:</b></label><br />";
											echo "<label for='ciudad'><b>Ciudad:</b></label><br />";
											echo "<label for='cod'><b>Código postal:</b></label><br />";
											echo "<label for='tar'><b>Número de tarjeta:</b></label><br />";
										echo "</p>";
									echo "</div>";
									echo "<div class='reg_der'>";
										echo "<p class='caja4'>";
											echo "<input type='hidden' name='idUsuario' value='".$id."' />";
											echo "<input type='hidden' name='anadiendoDatosEnvio' value='anadiendoDatosEnvio' />";
											echo "<input type='text' name='dir' size='20' id='dire' required />&nbsp;<br />";
											echo "<input type='text' name='ciu' size='20' id='ciudad' required />&nbsp;<br />";
											echo "<input type='text' name='cod' size='20' id='codPos' required />&nbsp;<br />";
											echo "<input type='text' name='tar' size='20' id='nTarj' required />&nbsp;<br />";
											echo "<input type='submit' name='modDatPer' id='modDatEnvPag' value='Añadir datos de envío y pago' onclick='' class='botonCompra' />&nbsp;";
										echo "</p>";
									echo "</div>";
								echo "</form>";
							}
							else{
								echo "<form name='formModDatosEnvPag' method='post' action='modificarU.php'>";
									echo "<div class='reg_izq'>";
										echo "<p class='caja3'>";
											echo "<label for='direccion'><b>Dirección actual:</b></label><br />";
											echo "<label for='direccionNueva'><b>Dirección nueva:</b></label><br />";
											echo "<label for='ciudad'><b>Ciudad:</b></label><br />";
											echo "<label for='ciudadNueva'><b>Ciudad nueva:</b></label><br />";
											echo "<label for='cod'><b>Código postal:</b></label><br />";
											echo "<label for='codNuevo'><b>Código postal nuevo:</b></label><br />";
											echo "<label for='tar'><b>Número de tarjeta:</b></label><br />";
											echo "<label for='tarNueva'><b>Número de tarjeta nuevo:</b></label><br />";
										echo "</p>";
									echo "</div>";
									echo "<div class='reg_der'>";
										echo "<p class='caja4'>";
											echo "<input type='hidden' name='idUsuario' value='".$id."' />";
											echo "<input type='hidden' name='modificandoDatosEnvio' value='modificandoDatosEnvio' />";
											echo $datos['direccion']."&nbsp;<br/>";
											echo "<input type='text' name='dir' size='20' id='dire' />&nbsp;<br />";
											echo $datos['ciudad']."&nbsp;<br/>";
											echo "<input type='text' name='ciu' size='20' id='ciudad' />&nbsp;<br />";
											echo $datos['cod_postal']."&nbsp;<br/>";
											echo "<input type='text' name='cod' size='20' id='codPos' />&nbsp;<br />";
											echo $datos['n_tarjeta']."&nbsp;<br/>";
											echo "<input type='text' name='tar' size='20' id='nTarj' />&nbsp;<br />";
											echo "<input type='submit' name='modDatPer' id='modDatEnvPag' value='Modificar datos de envío y pago' onclick='' class='botonCompra' />&nbsp;";
										echo "</p>";
									echo "</div>";
								echo "</form>";
							}
						echo "</div>";
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