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
				<h1>Estadisticas</h1>
				<hr />
				<?php
					// Standard inclusions   
					include("pChart/pChart/pData.class");
					include("pChart/pChart/pChart.class");
				        nuevaConexionBd();
				        $consulta1="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='1' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado1=mysql_query($consulta1) or die("Ha fallado la consulta 1");
					$nombreGenero1="";
					$cantGenero1="";
					while($fila=mysql_fetch_array($resultado1)){
						$nombreGenero1=$fila[0];
						$cantGenero1=$fila[1];
					}
					$consulta2="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='2' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado2=mysql_query($consulta2) or die("Ha fallado la consulta 2");
					$nombreGenero2="";
					$cantGenero2="";
					while($fila=mysql_fetch_array($resultado2)){
						$nombreGenero2=$fila[0];
						$cantGenero2=$fila[1];
					}
					$consulta3="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='3' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado3=mysql_query($consulta3) or die("Ha fallado la consulta 3");
					$nombreGenero3="";
					$cantGenero3="";
					while($fila=mysql_fetch_array($resultado3)){
						$nombreGenero3=$fila[0];
						$cantGenero3=$fila[1];
					}
					$consulta4="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='4' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado4=mysql_query($consulta4) or die("Ha fallado la consulta 4");
					$nombreGenero4="";
					$cantGenero4="";
					while($fila=mysql_fetch_array($resultado4)){
						$nombreGenero4=$fila[0];
						$cantGenero4=$fila[1];
					}
					$consulta5="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='5' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado5=mysql_query($consulta5) or die("Ha fallado la consulta 5");
					$nombreGenero5="";
					$cantGenero5="";
					while($fila=mysql_fetch_array($resultado5)){
						$nombreGenero5=$fila[0];
						$cantGenero5=$fila[1];
					}
					$consulta6="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='6' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado6=mysql_query($consulta6) or die("Ha fallado la consulta 6");
					$nombreGenero6="";
					$cantGenero6="";
					while($fila=mysql_fetch_array($resultado6)){
						$nombreGenero6=$fila[0];
						$cantGenero6=$fila[1];
					}
					$consulta7="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='7' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado7=mysql_query($consulta7) or die("Ha fallado la consulta 7");
					$nombreGenero7="";
					$cantGenero7="";
					while($fila=mysql_fetch_array($resultado7)){
						$nombreGenero7=$fila[0];
						$cantGenero7=$fila[1];
					}
					$consulta8="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='8' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado8=mysql_query($consulta8) or die("Ha fallado la consulta 8");
					$nombreGenero8="";
					$cantGenero8="";
					while($fila=mysql_fetch_array($resultado8)){
						$nombreGenero8=$fila[0];
						$cantGenero8=$fila[1];
					}
					$consulta9="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='9' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado9=mysql_query($consulta9) or die("Ha fallado la consulta 9");
					$nombreGenero9="";
					$cantGenero9="";
					while($fila=mysql_fetch_array($resultado9)){
						$nombreGenero9=$fila[0];
						$cantGenero9=$fila[1];
					}
					$consulta10="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='10' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado10=mysql_query($consulta10) or die("Ha fallado la consulta 10");
					$nombreGenero10="";
					$cantGenero10="";
					while($fila=mysql_fetch_array($resultado10)){
						$nombreGenero10=$fila[0];
						$cantGenero10=$fila[1];
					}
					$consulta11="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='11' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado11=mysql_query($consulta11) or die("Ha fallado la consulta 11");
					$nombreGenero11="";
					$cantGenero11="";
					while($fila=mysql_fetch_array($resultado11)){
						$nombreGenero11=$fila[0];
						$cantGenero11=$fila[1];
					}
					$consulta12="SELECT GEN.NOM_GENERO, COUNT(GP.ID_GENERO) FROM GEN_PEL GP, GENEROS GEN WHERE GP.ID_GENERO='12' AND GEN.ID_GENERO=GP.ID_GENERO GROUP BY GP.ID_GENERO;";
					$resultado12=mysql_query($consulta12) or die("Ha fallado la consulta 12");
					$nombreGenero12="";
					$cantGenero12="";
					while($fila=mysql_fetch_array($resultado12)){
						$nombreGenero12=$fila[0];
						$cantGenero12=$fila[1];
					}
				       
					// Dataset definition 
					$DataSet = new pData;
					$DataSet->AddPoint(array($cantGenero1,$cantGenero2,$cantGenero3,$cantGenero4,$cantGenero5,$cantGenero6,$cantGenero7,$cantGenero8,$cantGenero9,$cantGenero10,$cantGenero11,$cantGenero12),"Serie1");
					$DataSet->AddPoint(array($nombreGenero1,$nombreGenero2,$nombreGenero3,$nombreGenero4,$nombreGenero5,$nombreGenero6,$nombreGenero7,$nombreGenero8,$nombreGenero9,$nombreGenero10,$nombreGenero11,$nombreGenero12),"Serie2");
					$DataSet->AddAllSeries();
					$DataSet->SetAbsciseLabelSerie("Serie2");
				       
					// Initialise the graph
					$Test = new pChart(735,425);
					$Test->drawFilledRoundedRectangle(7,7,730,400,5,240,240,240);
					$Test->drawRoundedRectangle(5,5,415,245,5,230,230,230);
					$Test->createColorGradientPalette(195,204,56,223,110,41,5);
				       
					// Draw the pie chart
					$Test->setFontProperties("pChart/Fonts/tahoma.ttf",10);
					$Test->AntialiasQuality = 0;
					$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),300,200,200,PIE_PERCENTAGE_LABEL,FALSE,50,20,5);
					$Test->drawPieLegend(590,30,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
				       
					// Write the title
					$Test->setFontProperties("pChart/Fonts/MankSans.ttf",18);
					$Test->drawTitle(10,30,"Películas por géneros",0,0,0);
				       
					$Test->Render("../imagenes/estadisticas/peliculasPorGeneros.png");
				?>
				<img src='../imagenes/estadisticas/peliculasPorGeneros.png' title='Estadistica de películas por géneros' /><br/>
				
				<?
					//$DataSet = new pData;
					//Fecha actual
					$consulta="SELECT SYSDATE();";
					$resultado=mysql_query($consulta);
					$fecha0="";
					while($fila=mysql_fetch_array($resultado)){
						$fecha0=$fila[0];
					}
					$fecha0=substr($fecha0, 0, 10);
					$fech = $fecha0;
					$fecha = explode("-", $fech);
					$dia = $fecha[2];
					$mes = $fecha[1];
					$anno = $fecha[0];
					$fecha0=$fecha[2]."-".$fecha[1]."-".$fecha[0];
					
					//Cantidad fecha actual
					$consulta="SELECT COUNT(DATEDIFF(SYSDATE(),FECHA)) FROM ACCESO WHERE DATEDIFF(SYSDATE(),FECHA)=0;";
					$resultado=mysql_query($consulta);
					$cantidad0="";
					while($fila=mysql_fetch_array($resultado)){
						$cantidad0=$fila[0];
					}
					
					//Dia anterior
					$consulta="SELECT DATE_SUB(SYSDATE(), INTERVAL 1 DAY);";
					$resultado=mysql_query($consulta);
					$fecha1="";
					while($fila=mysql_fetch_array($resultado)){
						$fecha1=$fila[0];
					}
					$fecha1=substr($fecha1, 0, 10);
					$fech = $fecha1;
					$fecha = explode("-", $fech);
					$dia = $fecha[2];
					$mes = $fecha[1];
					$anno = $fecha[0];
					$fecha1=$fecha[2]."-".$fecha[1]."-".$fecha[0];
					
					//Cantidad dia anterior
					$consulta="SELECT COUNT(DATEDIFF(SYSDATE(),FECHA)) FROM ACCESO WHERE DATEDIFF(SYSDATE(),FECHA)=1;";
					$resultado=mysql_query($consulta);
					$cantidad1="";
					while($fila=mysql_fetch_array($resultado)){
						$cantidad1=$fila[0];
					}
					
					//Dos dias antes
					$consulta="SELECT DATE_SUB(SYSDATE(), INTERVAL 2 DAY);";
					$resultado=mysql_query($consulta);
					$fecha2="";
					while($fila=mysql_fetch_array($resultado)){
						$fecha2=$fila[0];
					}
					$fecha2=substr($fecha2, 0, 10);
					$fech = $fecha2;
					$fecha = explode("-", $fech);
					$dia = $fecha[2];
					$mes = $fecha[1];
					$anno = $fecha[0];
					$fecha2=$fecha[2]."-".$fecha[1]."-".$fecha[0];
					
					//Cantidad dos dias antes
					$consulta="SELECT COUNT(DATEDIFF(SYSDATE(),FECHA)) FROM ACCESO WHERE DATEDIFF(SYSDATE(),FECHA)=2;";
					$resultado=mysql_query($consulta);
					$cantidad2="";
					while($fila=mysql_fetch_array($resultado)){
						$cantidad2=$fila[0];
					}
					
					//Tres dias antes
					$consulta="SELECT DATE_SUB(SYSDATE(), INTERVAL 3 DAY);";
					$resultado=mysql_query($consulta);
					$fecha3="";
					while($fila=mysql_fetch_array($resultado)){
						$fecha3=$fila[0];
					}
					$fecha3=substr($fecha3, 0, 10);
					$fech = $fecha3;
					$fecha = explode("-", $fech);
					$dia = $fecha[2];
					$mes = $fecha[1];
					$anno = $fecha[0];
					$fecha3=$fecha[2]."-".$fecha[1]."-".$fecha[0];
					
					//Cantidad tres dias antes
					$consulta="SELECT COUNT(DATEDIFF(SYSDATE(),FECHA)) FROM ACCESO WHERE DATEDIFF(SYSDATE(),FECHA)=3;";
					$resultado=mysql_query($consulta);
					$cantidad3="";
					while($fila=mysql_fetch_array($resultado)){
						$cantidad3=$fila[0];
					}
					
					//Cuatro dias antes
					$consulta="SELECT DATE_SUB(SYSDATE(), INTERVAL 4 DAY);";
					$resultado=mysql_query($consulta);
					$fecha4="";
					while($fila=mysql_fetch_array($resultado)){
						$fecha4=$fila[0];
					}
					$fecha4=substr($fecha4, 0, 10);
					$fech = $fecha4;
					$fecha = explode("-", $fech);
					$dia = $fecha[2];
					$mes = $fecha[1];
					$anno = $fecha[0];
					$fecha4=$fecha[2]."-".$fecha[1]."-".$fecha[0];
					
					//Cantidad cuatro dias antes
					$consulta="SELECT COUNT(DATEDIFF(SYSDATE(),FECHA)) FROM ACCESO WHERE DATEDIFF(SYSDATE(),FECHA)=4;";
					$resultado=mysql_query($consulta);
					$cantidad4="";
					while($fila=mysql_fetch_array($resultado)){
						$cantidad4=$fila[0];
					}
					
					//Cinco dias antes
					$consulta="SELECT DATE_SUB(SYSDATE(), INTERVAL 5 DAY);";
					$resultado=mysql_query($consulta);
					$fecha5="";
					while($fila=mysql_fetch_array($resultado)){
						$fecha5=$fila[0];
					}
					$fecha5=substr($fecha5, 0, 10);
					$fech = $fecha5;
					$fecha = explode("-", $fech);
					$dia = $fecha[2];
					$mes = $fecha[1];
					$anno = $fecha[0];
					$fecha5=$fecha[2]."-".$fecha[1]."-".$fecha[0];
					
					//Cantidad cinco dias antes
					$consulta="SELECT COUNT(DATEDIFF(SYSDATE(),FECHA)) FROM ACCESO WHERE DATEDIFF(SYSDATE(),FECHA)=5;";
					$resultado=mysql_query($consulta);
					$cantidad5="";
					while($fila=mysql_fetch_array($resultado)){
						$cantidad5=$fila[0];
					}
					
					//Seis dias antes
					$consulta="SELECT DATE_SUB(SYSDATE(), INTERVAL 6 DAY);";
					$resultado=mysql_query($consulta);
					$fecha6="";
					while($fila=mysql_fetch_array($resultado)){
						$fecha6=$fila[0];
					}
					$fecha6=substr($fecha6, 0, 10);
					$fech = $fecha6;
					$fecha = explode("-", $fech);
					$dia = $fecha[2];
					$mes = $fecha[1];
					$anno = $fecha[0];
					$fecha6=$fecha[2]."-".$fecha[1]."-".$fecha[0];
					
					//Cantidad seis dias antes
					$consulta="SELECT COUNT(DATEDIFF(SYSDATE(),FECHA)) FROM ACCESO WHERE DATEDIFF(SYSDATE(),FECHA)=6;";
					$resultado=mysql_query($consulta);
					$cantidad6="";
					while($fila=mysql_fetch_array($resultado)){
						$cantidad6=$fila[0];
					}
					
					$DataSet = new pData;
					$DataSet->AddPoint(array($cantidad6,$cantidad5,$cantidad4,$cantidad3,$cantidad2,$cantidad1,$cantidad0),"Serie2");
					$DataSet->AddPoint(array($fecha6,$fecha5,$fecha4,$fecha3,$fecha2,$fecha1,$fecha0),"Serie3");
					$DataSet->SetAbsciseLabelSerie("Serie3");
					$DataSet->SetSerieName("Usuarios conectados","Serie2");
				       
					// Initialise the graph
					$Test = new pChart(730,230);
					$Test->drawGraphAreaGradient(240,240,240,10,TARGET_BACKGROUND);
				       
					// Prepare the graph area
					$Test->setFontProperties("pChart/Fonts/tahoma.ttf",8);
					$Test->setGraphArea(60,40,650,190);
				       
					// Initialise graph area
					$Test->setFontProperties("pChart/Fonts/tahoma.ttf",8);
				       
					// Clear the scale
					$Test->clearScale();
				       
					// Draw the 2nd graph
					$DataSet->AddSerie("Serie2");
					$DataSet->SetYAxisName("Usuarios conectados");
					$Test->drawRightScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,0,0,0,TRUE,0,0);
					$Test->drawGrid(4,TRUE,0,0,0,2);
					$Test->setShadowProperties(3,3,0,0,0,30,4);
					$Test->drawCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription());
					$Test->clearShadow();
					$Test->drawFilledCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription(),.1,30);
					$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);
				       
					// Write the legend (box less)
					$Test->setFontProperties("pChart/Fonts/tahoma.ttf",8);
					$Test->drawLegend(530,5,$DataSet->GetDataDescription(),0,0,0,0,0,0,0,0,0,FALSE);
				       
					// Write the title
					$Test->setFontProperties("pChart/Fonts/MankSans.ttf",18);
					$Test->setShadowProperties(1,1,0,0,0);
					$Test->drawTitle(0,0,"Usuarios conectados la última semana",2,2,2,660,30,TRUE);
					$Test->clearShadow();
				       
					// Render the picture
					$Test->Render("../imagenes/estadisticas/usuariosUltimaSemana.png");
				?>
				
				<img src='../imagenes/estadisticas/usuariosUltimaSemana.png' title='Estadistica de películas por géneros' /><br/>
				
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