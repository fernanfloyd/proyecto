<?php
	session_start();
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
		<script type='text/javascript' src='funciones/registro.js'></script>
		<link rel="stylesheet" type="text/css" href="estilos/registro.css" media="all"/>
		
		<script type='text/javascript' src='funciones/jquery.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.mobile.customized.min.js'></script>
		<script type='text/javascript' src='funciones/jquery.easing.1.3.js'></script> 
		<script type='text/javascript' src='funciones/camera.min.js'></script>
		<script type='text/javascript' src='funciones/funciones.js'></script>
		
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
	<body onload="carga_inicial();carga_inicial_pais();deshabilitarCampos();">
		
		<!--<div class="contenedor">-->			
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
							<input style="cursor:pointer;" type="submit" value="Iniciar sesión" name='bLogin' id='bLogin' /><br />
							<p style="text-align:center;background-color:#DCD6D6;margin-bottom:15px;"><a href='registro.php' style="">regístrate aquí</a></p>
						</form>
					</div>
				</div>
			</header>
		<!--</div>-->
		<nav>
		<div class="menu">
			<div class="wrapper">
				<ul class="nav">
					<li><a href="index.php"><img src="imagenes/home.png" /></a></li>
					<li><a href="verNoticias.php">Noticias</a></li>
					<li><a href="verEstrenos.php">Estrenos</a></li>
					<li><a href="verPeliculas.php">Peliculas</a></li>
					<li><a href="verActores.php">Actores<!--<b></b>--></a></li>
					<li><a href="#">Tienda</a></li>
				</ul>
				<div class="buscador">
					<form id="search" name="search" method="get" action="busqueda.php" autocomplete="off">
						<input name="s" type="text" id="s" placeholder="Buscar..." />
					</form>
				</div>
			</div>
		</div>
		
		</nav>
		
		<div class="contenedor2 margen_contenedor">
		
			<section class="registro">
				<h1>Registro</h1>
				<hr/>
				<form name="formulario" action="insertarU.php" method="POST">
					<div class="caja_reg_1">
						<h3 class="reg_tit">Información registro</h3>
						<div class="reg_izq">
							<p class="caja3">
								<label for="nombreUsuario">Nombre usuario <span class="rojo">*</span>:</label><br />
								<label for="contraseña">Contraseña <span class="rojo">*</span>:</label><br />						
								<label for="confContraseña">Confirmar contraseña <span class="rojo">*</span>:</label><br />
							</p>
						</div>
						<div class="reg_der">
							<p class="caja4">
								<input type="text" name="usuario" size="12" maxlength="60" id="usuario" onfocus="deshabilitarCampos();" required />&nbsp;<input type="button" name="bComprobarNick" id="bComprobarNick" value="Comprobar nick" onclick="comprobarNickEnBD();" /><br />
								<input type="password" name="pwd" size="12" maxlength="12" id="pwd" required />&nbsp;<br />
								<input type="password" name="conpwd" size="12" maxlength="12" id="conpwd" required />&nbsp;
							</p>
						</div>
					</div>
					
					<div class="caja_reg_2">
						<h3>Información envío y pago</h3>
						<div class="reg_izq">
							<p class="caja3">
								<label for="dir">Dirección:</label><br />
								<label for="ciu">Ciudad:</label><br />
								<label for="cod">Código Postal:</label><br />
								<label for="cod">Nº Tarjeta:</label><br />
							</p>
						</div>
						<div class="reg_der">
							<p class="caja4">
								<input type="text" name="dir" size="20" id="dire"  />&nbsp;<br />
								<input type="text" name="ciu" size="20" id="ciudad"  />&nbsp;<br />
								<input type="text" name="cod" size="20" id="codPos"  />&nbsp;<br />
								<input type="text" name="tar" size="20" id="nTarj"  />&nbsp;<br />
							</p>
						</div>
					</div>
					
					<div class="caja_reg_3">
						<h3>Información personal</h3>				
						<div class="reg_izq">
							<p class="caja1">
								<label for="nombre">Nombre <span class="rojo">*</span>:</label><br />
								<label for="apellidos">Apellidos <span class="rojo">*</span>:</label><br />						
								<label for="telefono">Teléfono:</label><br />
								<label for="fecha">Fecha nacimiento:</label><br />
								<label for="pais"> País:</label><br />						
								<label for="mail">E-mail <span class="rojo">*</span>:</label><br />
								<label for="sexo">Sexo:</label><br />
							</p>
						</div>
						<div>
							<div class="reg_der">
								<p class="caja2">
									<input type="text" name="nombre" required="required" size="20" maxlength="40" id="txtnombre" placeholder="Escribe tu nombre aqui" required  />&nbsp;<br />
									<input type="text" name="apellidos" size="20" maxlength="60" id="txtapellidos" required/>&nbsp;<br />
									<input type="text" name="telefono" size="20" maxlength="15" id="txttelefono" required />&nbsp;<br />			
									<select name="dia" style="width: 50px" id="dias"></select>
									<select name="mes" style="width: 90px" id="mes"></select>
									<select name="ano" style="width: 70px" id="ano"></select>&nbsp;<br/>
									<select name="pais" style="width: 190px" id="pais"></select>&nbsp;<br/>			
									<input type="email" name="correo" size="20" maxlength="40" id="txtmail" required onblur="comprobarMailEnBD()" />&nbsp;<br />						
									<input type="radio" name="sexo" value="hombre" checked="checked" /> Hombre
									<input type="radio" name="sexo" value="mujer" /> Mujer &nbsp;<br />
								</p>
							</div>
						</div>
					</div>
					<div class="caja_reg_4">
						<hr/>
						<p>
							<p>
								<input type="checkbox" name="chkacepto" value="acepto" onChange="habilita(this.form)" /> He leido los terminos y las condiciones y las acepto<br/>
								<br />						
								<input type="button" value="Enviar" name="btnenviar" onClick="comprobarMailEnBD();validar(this.form);" disabled="disabled" /> <input type="button" value="Limpiar" name="btnlimpiar" onClick="advertencia(this.form)" /><br />
								<p class="obligatorio rojo">Los campos marcados con asterisco (*) son obligatorios</p>
							</p>
						</p>
					</div>
				</form>			
			<script language="javaScript" src="funciones/registro.js"></script>	
			</section>
			
			
		</div>
		<footer><a href="index.html"><img src="imagenes/logo-pie.png" title="ImpactFilm | Todo el cine a tu alcance" /></a></footer>
	</body>
</html>