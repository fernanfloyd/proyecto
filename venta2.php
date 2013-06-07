<?php
		session_start();
		include("funciones/funciones.php");
		//require('fpdf/fpdf.php');
		include_once('PHPMailer/class.phpmailer.php'); //incluimos la ruta a la clase phpmailer

		$pedido=json_decode($_GET['pedido'],true);
		$pedido=json_decode($pedido,true);
		$nick=$_SESSION['usuario'];
		$id=extraerIdUsuario($nick);
		$fecha=fechaHora();
		
		$cadena="";
		foreach($pedido as $i){
			$peli=obtenerNombrePelicula($i['id']);
			 insertarVenta($i['id'], $id, $peli, $nick, $fecha, $i['cantidad']);
			 $cadena.=$peli."/".$nick."/".$fecha."/".$i['cantidad']."/";
		}
		$mail=obtenerMail($id);
		enviarmail($cadena,$mail,$id, $nick, $fecha);
		
		echo "<script type='text/javascript' src='funciones/comprar.js'></script>";
		echo "<script>";
			echo "elimLista();";
		echo "</script>";
		
		function enviarmail($cadena,$mail,$id, $nick, $fecha){
				$archivo=crearPdf($cadena, $id, $nick, $fecha);
				/*$email = new PHPMailer();
				$email->IsSMTP();// envío vía SMTP
				$email->SMTPAuth = true; // turn on SMTP authentication
				// $email->SMTPSecure = "ssl"; // sets the prefix to the server
				$email->Host = 'smtp.gmail.com';
				$email->Port = 25;
				$email->Username = 'impactfilmweb@gmail.com'; // SMTP username
				$email->Password = 'proyectodaw';// SMTP password
				$email->IsHTML(true); // send as HTML
				$email->Body="Gracias por realizar su compra en ImpactFilm<br />$cadena";  // cuerpo del mensaje
				 
				// Introducimos la información del remitente del mensaje
				 
				$email->From = "impactfilmweb@gmail.com";  // se puede usar la misma cuenta u otra
				 $email->FromName = "ImpactFilm";//Asunto
				 $email->Subject = "Resumen Compra";
				 
				// y los destinatarios del mensaje. Podemos especificar más de un destinatario
				 $email->AddAddress($mail,$nick);
				 $email->AddAttachment($archivo);// adjuntamos un imagen o un file opcional
				 
				// se notifica si se ha enviado o no 
				if(!$email->Send()) {
				 
				echo "Error de envío: " . $email->ErrorInfo;
				 
				} else {
				 
				echo "El mensaje ha sido enviado con éxito";
				 
				}*/
			
		}
		
		function insertarVenta($idPeli, $idUsu, $peli, $nick, $fecha, $cantidad){
			//echo $idPeli." ".$idUsu." ".$fecha." ".$cantidad."<br />";
			nuevaConexionBd();
			$consulta="INSERT INTO VENTAS (ID_PELICULA, ID_USUARIO, PELICULA, NICK, FECHA_HORA,CANTIDAD) VALUES ('$idPeli', '$idUsu', '$peli', '$nick', '$fecha', '$cantidad');";
			mysql_query($consulta);
		}
		

		
	
	function crearPdf($cadena, $id, $nick, $fecha){
		$dat = $cadena;
		$datos = explode("/", $dat);
		$fechaRecortada=substr($datos[2],0,10);
		$fech = $fechaRecortada;
		$fecha = explode ("-", $fech);
		$dia = $fecha[2];
		$mes = $fecha[1];
		$anio = $fecha[0];
		$textoParaTabla="";
		$consulta="SELECT NOMBRE, APELLIDOS, TELEFONO, EMAIL, CIUDAD, DIRECCION, COD_POSTAL, PAIS FROM DATOS WHERE ID_USUARIO='$id';";
		$resultado=mysql_query($consulta) or die("Ha fallado la consulta para recuperar los datos personales del usuario por el siguiente error: ".mysql_error()."<br/>");
		$datosPersonales=array();
		while($fila=mysql_fetch_array($resultado)){
				$datosPersonales['nombre']=$fila[0];
				$datosPersonales['apellidos']=$fila[1];
				$datosPersonales['telefono']=$fila[2];
				$datosPersonales['email']=$fila[3];
				$datosPersonales['ciudad']=$fila[4];
				$datosPersonales['direccion']=$fila[5];
				$datosPersonales['cod_postal']=$fila[6];
				$datosPersonales['pais']=$fila[7];
		}
		$contCantidad=3;
		$contPelicula=0;
		for($i=0;$i<(count($datos))/5;$i++){
				if($i==0){
						$textoParaTabla=$textoParaTabla."<tr><td>".$datos[3]."</td><td>".$datos[0]."</td><td>19.99</td></tr>";		
				}
				else{
						$textoParaTabla=$textoParaTabla."<tr><td>".$datos[$contCantidad+4]."</td><td>".$datos[$contPelicula+4]."</td><td>19.99</td></tr>";
						$contCantidad=$contCantidad+4;
						$contPelicula=$contPelicula+4;
				}
		}
		$html = '
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
		<div class="cabecera"><h3>Orden de compra #1</h3></div>
		<b>Nombre: </b>'.$datosPersonales['nombre'].'<br />
		<b>Apellidos: </b>'.$datosPersonales['apellidos'].'<br />
		<b>Email: </b>'.$datosPersonales['email'].'<br />
		<b>Telefono: </b>'.$datosPersonales['telefono'].'<br />
		<b>Pais: </b>'.$datosPersonales['pais'].'<br />
		<b>Ciudad: </b>'.$datosPersonales['ciudad'].'<br />
		<b>Codigo postal: </b>'.$datosPersonales['cod_postal'].'<br />
		<b>Direccion: </b>'.$datosPersonales['direccion'].'<br />
		<div class="cabecera" style="margin-top:20;"><h3>Detalle de la compra #1</h3></div>
		<table>
			<tr>
				<th class="titulos">Cantidad</th><th class="titulos">Producto</th><th class="titulos">Precio</th>
			</tr>
			'.
			$textoParaTabla
			.'
		</table>
		<div class="cabecera" style="margin-top:20;"><h3>Opciones de Pago</h3></div>
		<br />
		<br />
		<br />
		<br />
		<div class="separador" style="margin-top:20;"></div>
		<p style="text-align:right;width:100%;"><b>Total: </b>58.99€</p>
		<div class="cabecera" style="margin-top:20;"></div>
		</body>
		
		
		</div>
		
		';
		
		//==============================================================
		//==============================================================
		//==============================================================
		include("MPDF/mpdf.php");
		
		$mpdf=new mPDF('c','A4'); 
		
		//$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetHeader('Factura de compra ImpactFilm||{DATE j-m-Y}');
		$mpdf->SetFooter('{PAGENO}');	/* defines footer for Odd and Even Pages - placed at Outer margin */
		
		$mpdf->WriteHTML($html);	// Separate Paragraphs  defined by font
		$num=contadorVentas();
		$archivo="pdfs/venta".$nick."_".$num.".pdf";
		$mpdf->Output($archivo);

		//exit;
		
		return $archivo;			
		}
		
		
		
	?>
