<?php
		session_start();
		include("funciones/funciones.php");
		include("MPDF/mpdf.php");
		include_once('PHPMailer/class.phpmailer.php'); //incluimos la ruta a la clase phpmailer
		include_once('PHPMailer/class.smtp.php');
		
		$pedido=json_decode($_GET['pedido'],true);
		$pedido=json_decode($pedido,true);
		$nick=$_SESSION['usuario'];
		$id=extraerIdUsuario($nick);
		$fecha=fechaHora();
		$precioT=0;
		$cadena=Array();
		$x=0;
		foreach($pedido as $i){
			$peli=obtenerNombrePelicula($i['id']);
			 insertarVenta($i['id'], $id, $peli, $nick, $fecha, $i['cantidad']);
			 $cadena[$x]['pelicula']=$peli;
			 $cadena[$x]['cantidad']=$i['cantidad'];
			 $cadena[$x]['precio']=$i['precio'];
			 $precioT=$precioT+floatval($i['precio']);
			 $x++;
		}
		$cuerpo=crearHTML($cadena, $precioT, $fecha, $id);
		$mail=obtenerMail($id);
		enviarmail($cuerpo,$mail, $fecha,$nick);
	
		echo "<script type='text/javascript' src='funciones/comprar.js'></script>";
		echo "<script>";
			echo "elimLista();";
		echo "</script>";
		
		function crearHTML($cadena, $precioT, $fecha, $id){
			$datos=obtenerTodoUsuario($id);
			$fecha=substr($fecha,0,10);
			$fecha = explode ("-", $fecha);
			$dia = $fecha[2];
			$mes = $fecha[1];
			$anio = $fecha[0];
			$peliculas="";
			foreach($cadena as $i){
				$peliculas.='<tr><td>'.$i["cantidad"].'</td><td>'.utf8_decode($i["pelicula"]).'</td><td>'.$i["precio"].'</td></tr>';
			}
			$cuerpo = '
		<style>
		header{
			width: 100%;
			height: 75px;
			background: #a50200;
			background: -o-linear-gradient(top, #3871C2, #21477E);
			background: -webkit-linear-gradient(top, #3871C2, #21477E);
			background: -moz-linear-gradient(top, #3871C2, #21477E);
			background: -ms-linear-gradient(top, #3871C2, #21477E);
			background:  linear-gradient(top, #3871C2, #21477E);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#a50200", endColorstr="#f20800",GradientType=0 );
			font-family: "Aldrich", sans-serif;
			font-weight: 400;
			color: white;
			margin-bottom: 10px;
			padding-top: 8px;
		}
		header p{
		    margin: 0 auto;
		}
		.cabecera{
			margin-bottom: 15px;
			width:100%;
			text-align:center;
			color:white;
			background: -o-linear-gradient(top, #3871C2, #21477E);
			background: -webkit-linear-gradient(top, #3871C2, #21477E);
			background: -moz-linear-gradient(top, #3871C2, #21477E);
			background: -ms-linear-gradient(top, #3871C2, #21477E);
			background:  linear-gradient(top, #3871C2, #21477E);
		}
		
		.separador{
			width:100%;
			height:5;
			text-align:center;
			color:white;
			background: -o-linear-gradient(top, #3871C2, #21477E);
			background: -webkit-linear-gradient(top, #3871C2, #21477E);
			background: -moz-linear-gradient(top, #3871C2, #21477E);
			background: -ms-linear-gradient(top, #3871C2, #21477E);
			background:  linear-gradient(top, #3871C2, #21477E);
		}
		
		table{
			width:100%;
			margin-top:2;
		}
		
		.titulos{
			color:white;
			background: -o-linear-gradient(top, #3871C2, #21477E);
			background: -webkit-linear-gradient(top, #3871C2, #21477E);
			background: -moz-linear-gradient(top, #3871C2, #21477E);
			background: -ms-linear-gradient(top, #3871C2, #21477E);
			background:  linear-gradient(top, #3871C2, #21477E);
			text-align:left;
			text-transform: uppercase;
			padding: 2px;
		}
		
		</style>
		
		<body>
		<header><p style="width:250px;height:70px;"><img src="imagenes/logo-cabecera.png" ></p></header>
		<div class="cabecera"><h3>Orden de compra</h3></div>
		<b>Nombre: </b>'.$datos['nombre'].'<br />
		<b>Apellidos: </b>'.$datos['apellidos'].'<br />
		<b>Email: </b>'.$datos['email'].'<br />
		<b>Telefono: </b>'.$datos['telefono'].'<br />
		<b>Ciudad: </b>'.$datos['ciudad'].'<br />
		<b>Codigo postal: </b>'.$datos['cod_postal'].'<br />
		<b>Direccion: </b>'.$datos['direccion'].'<br />
		<div class="cabecera" style="margin-top:20;"><h3>Detalle de la compra</h3></div>
		<table>
			<tr>
				<th class="titulos">Cantidad</th><th class="titulos">Producto</th><th class="titulos">Precio</th>
			</tr>
			'.$peliculas.'
		</table>
		<div class="cabecera" style="margin-top:20;"><h3>Opciones de Pago</h3></div>
		Pago con Tarjeta
		<br />
		<div class="separador" style="margin-top:20;"></div>
		<p style="text-align:right;width:100%;"><b>Total: </b>'.$precioT.'</p>
		<div class="cabecera" style="margin-top:20;"></div>
		</body>
		
		
		</div>
		
		';
			return $cuerpo;
		}
		
		
		function enviarmail($cuerpo,$mail, $fecha, $nick){
				 $archivo=crearPdf($cuerpo, $fecha, $nick);
				 $email = new PHPMailer();
				 $email->IsSMTP();// envío vía SMTP
				 $email->SMTPAuth = true; // turn on SMTP authentication
				 //$email->SMTPDebug = 1;
				 $email->SMTPSecure = "tls"; // sets the prefix to the server
				 $email->Host = 'smtp.gmail.com';
				 $email->Port = 25;
				 $email->Username = 'impactfilmweb@gmail.com'; // SMTP username
				 $email->Password = 'proyectodaw';// SMTP password
				 $email->IsHTML(true); // send as HTML
				 $email->Body="<h1>Disfrute de su compra</h1>Aqui tiene toda la informacion sobre ella<br/>".$cuerpo;  // cuerpo del mensaje
				 $email->From = "impactfilmweb@gmail.com";  // se puede usar la misma cuenta u otra
				 $email->FromName = "ImpactFilm";//Asunto
				 $email->Subject = "Resumen Compra";
				 // y los destinatarios del mensaje. Podemos especificar más de un destinatario
				 $email->AddAddress($mail,$nick);
				 $email->AddAttachment($archivo);// adjuntamos un imagen o un file opcional
				 if(!$email->Send()) {
					echo "Error de envío: " . $email->ErrorInfo;
				 }else{
					echo "El mensaje ha sido enviado con éxito";
				 }
		}
		
		function insertarVenta($idPeli, $idUsu, $peli, $nick, $fecha, $cantidad){
			nuevaConexionBd();
			$consulta="INSERT INTO VENTAS (ID_PELICULA, ID_USUARIO, PELICULA, NICK, FECHA_HORA,CANTIDAD) VALUES ('$idPeli', '$idUsu', '$peli', '$nick', '$fecha', '$cantidad');";
			mysql_query($consulta);
		}
		

		
	
	function crearPdf($cuerpo, $fecha, $nick){
		$mpdf=new mPDF('c','A4'); 
		$fecha=substr($fecha,0,10);
			$fecha = explode ("-", $fecha);
			$dia = $fecha[2];
			$mes = $fecha[1];
			$anio = $fecha[0];
		//$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetHeader('Factura de compra ImpactFilm||'.$dia.'-'.$mes.'-'.$anio);
		$mpdf->SetFooter('{1}');	/* defines footer for Odd and Even Pages - placed at Outer margin */
		
		$mpdf->WriteHTML($cuerpo);	// Separate Paragraphs  defined by font
		$num=contadorVentas();
		$archivo="pdfs/venta".$nick."_".$num.".pdf";
		$mpdf->Output($archivo);

		//exit;
		
		return $archivo;			
		}
		
	?>
