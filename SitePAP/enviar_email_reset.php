<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
 $email = $_POST['email'];
try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username = 'temporalages@gmail.com'; 
        $mail->Password = 'evag pngt tvod jdbh';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;


    $mail->setFrom('TemporalAges@gmail.com', 'Temportal Ages');
    $mail->addAddress($email);
    $token = bin2hex(random_bytes(16));
    $mail->isHTML(true);
    $link = "http://localhost/Site.TemporalAges/Site.TemporalAges/SitePAP/reset_password.php?email=" . urlencode($email);
    $mail->Subject = 'Redefinir Password';
    $mail->Body    = "Clique <a href='$link'>aqui</a> para redefinir a sua password.";
    $mail->token   = $token;
    $mail->send();
    echo 'Email enviado!';
} catch (Exception $e) {
    echo "Erro ao enviar: {$mail->ErrorInfo}";
}
