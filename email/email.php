<?php
// include ('PHPMailer/class.phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


//Instantiation and passing `true` enables exceptions

$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$mensagem = $_POST["mensagem"];

// //Server settings
$mail = new PHPMailer(true);
// $mail->SMTPDebug = 3;
$mail->setLanguage('br');
$mail->CharSet = 'UTF-8';
$mail->isSMTP();                                            //Send using SMTP
$mail->Host = 'smtp.gmail.com';                       //Set the SMTP server to send through
$mail->SMTPAuth = true;                                   //Enable SMTP authentication
$mail->Username = 'makpeliculas@gmail.com';             //SMTP username
$mail->Password = 'ajbrknfxnvcoqmnf';                           //SMTP password
$mail->SMTPSecure = 'tls';                                  //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port = 587;
// $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true)); //Específico para Hostgator

//Recipients
$mail->From = 'makpeliculas@gmail.com';
$mail->FromName = 'contato';
$mail->addAddress('makpeliculas@gmail.com', 'Formulário do site');     //Add a recipient
$mail->addReplyTo($email);

$Body = " 
Nome: {$nome} <br>
Email: {$email} <br>
Telefone: {$telefone} <br>  
Mensagem: {$mensagem} <br>
";

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Contato';
$mail->Body = $Body;


if (!$mail->send()) {

  echo 'A mensagem não pode ser enviada';

  echo 'Mensagem de erro: ' . $mail->ErrorInfo;
} else {

  echo "
  <script type='text/javascript'>
    alert('Mensagem enviada com sucesso.')
    javascript:window.location='" . $_SERVER['HTTP_REFERER'] . "'
  </script>";
}
