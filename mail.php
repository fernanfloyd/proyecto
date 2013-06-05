<?php
 include_once('PHPMailer/class.phpmailer.php'); //incluimos la ruta a la clase phpmailer
 $email = new PHPMailer();
 $email->IsSMTP();// envío vía SMTP
$email->SMTPAuth = true; // turn on SMTP authentication
// $email->SMTPSecure = "ssl"; // sets the prefix to the server
 $email->Host = 'smtp.gmail.com';
 $email->Port = 25;
$email->Username = 'impactfilmweb@gmail.com'; // SMTP username
$email->Password = 'proyectodaw';// SMTP password
$email->IsHTML(true); // send as HTML
$email->Body="<P>Email utilizando PHPMailer y Gmail</P> ";  // cuerpo del mensaje
 
// Introducimos la información del remitente del mensaje
 
$email->From = "impactfilmweb@gmail.com";  // se puede usar la misma cuenta u otra
 $email->FromName = "ImpactFilm";//Asunto
 $email->Subject = "Resumen Compra";
 
// y los destinatarios del mensaje. Podemos especificar más de un destinatario
 $email->AddAddress('fperezllop@gmail.com','floyd');
 $email->AddAttachment("pdfs/ventafer.pdf");// adjuntamos un imagen o un file opcional
 
// se notifica si se ha enviado o no 
if(!$email->Send()) {
 
echo "Error de envío: " . $email->ErrorInfo;
 
} else {
 
echo "El mensaje ha sido enviado con éxito";
 
}
 
?>