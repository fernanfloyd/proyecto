<?php
		session_start();
		include("funciones/funciones.php");
		require('fpdf/fpdf.php');
		include_once('PHPMailer/class.phpmailer.php'); //incluimos la ruta a la clase phpmailer

		$pedido=json_decode($_GET['pedido'],true);
		$pedido=json_decode($pedido,true);
		$nick=$_SESSION['usuario'];
		$id=extraerIdUsuario($nick);
		$fecha=fechaHora();
		
		$cadena="Texto pal mail: ";
		foreach($pedido as $i){
			$peli=obtenerNombrePelicula($i['id']);
			 insertarVenta($i['id'], $id, $peli, $nick, $fecha, $i['cantidad']);
			 $cadena.=$peli."-".$nick."-".$fecha."-".$i['cantidad']."\n";
		}
		$mail=obtenerMail($id);
		enviarmail($cadena,$mail,$id, $nick, $fecha);
		
		echo "<script type='text/javascript' src='funciones/comprar.js'></script>";
		echo "<script>";
			echo "elimLista();";
		echo "</script>";
		
		function enviarmail($cadena,$mail,$id, $nick, $fecha){
				$archivo=crearPdf($cadena, $id, $nick, $fecha);
				$email = new PHPMailer();
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
				 
				}
			
		}
		
		function insertarVenta($idPeli, $idUsu, $peli, $nick, $fecha, $cantidad){
			//echo $idPeli." ".$idUsu." ".$fecha." ".$cantidad."<br />";
			nuevaConexionBd();
			$consulta="INSERT INTO VENTAS (ID_PELICULA, ID_USUARIO, PELICULA, NICK, FECHA_HORA,CANTIDAD) VALUES ('$idPeli', '$idUsu', '$peli', '$nick', '$fecha', '$cantidad');";
			mysql_query($consulta);
		}
		

		
	
	function crearPdf($cadena, $id, $nick, $fecha){
			class PDF extends FPDF{
		// Cabecera de página
		function Header(){
			// Logo
			//$this->Image('logo_pb.png',10,8,33);
			// Arial bold 15
			$this->SetFont('Arial','B',15);
			// Movernos a la derecha
			$this->Cell(80);
			// Título
			$this->Cell(30,10,'ImpactFilm',1,0,'C');
			// Salto de línea
			$this->Ln(20);
		}
		function ChapterTitle($num, $label){
			// Arial 12
			$this->SetFont('Arial','',12);
			// Color de fondo
			$this->SetFillColor(200,220,255);
			// Título
			$this->Cell(0,6,"Capítulo $num : $label",0,1,'L',true);
			// Salto de línea
			$this->Ln(4);
		}
		// Pie de página
		function Footer(){
			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Número de página
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}
			// Creación del objeto de la clase heredada
			$pdf = new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Times','',12);
			//for($i=1;$i<=40;$i++)
			$pdf->Cell(0,10,$cadena,0,1);
			//$pdf->PrintChapter(1,'UN RIZO DE HUIDA','20k_c1.txt');	
			$num=contadorVentas();
			$archivo="pdfs/venta".$nick."_".$num.".pdf";
			$pdf->Output($archivo);
			return $archivo;
							
		}
	?>
