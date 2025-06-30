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
    $link = "http://localhost/Site.TemporalAges/Site.TemporalAges/SitePAP/reset_password.php?email=" . urlencode($email) . "&token=$token";
    $mail->Subject = 'Redefinir Password';
    $mail->Body    = "Clique <a href='$link'>aqui</a> para redefinir a sua password.";
    $mail->token   = $token;
    $mail->send();
    echo "<script>alert('Email Enviado');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"5; url=index.html\">";
} catch (Exception $e) {
    echo "Erro ao enviar: {$mail->ErrorInfo}";
}
