<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];
    

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username = 'temporalages@gmail.com'; 
        $mail->Password = 'evag pngt tvod jdbh';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        
        $mail->setFrom('temporalages@gmail.com', 'Temporal Ages');
        $mail->addAddress($email, $nome);  


        $mail->isHTML(true);
        $mail->Subject = 'Recebemos o seu contacto!';
        $mail->Body    = "<p>Olá <strong>$nome</strong>,</p><p>Recebemos a sua mensagem:</p><blockquote>$mensagem</blockquote><p>Obrigado por nos contactar. Responderemos o mais breve possível.</p>";

        $mail->send();

        
        echo "
            <html lang='pt-PT'>
            <head>
                <meta charset='UTF-8'>
                <title>Obrigado pelo seu contacto</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        text-align: center;
                        padding-top: 100px;
                    }
                    .mensagem {
                        background-color: white;
                        display: inline-block;
                        padding: 40px;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    }
                    h1 { color: #333; }
                    p { color: #555; }
                </style>
            </head>
            <body>
                <div class='mensagem'>
                    <h1>Obrigado pelo seu contacto, $nome!</h1>
                    <p>Recebemos a sua mensagem e entraremos em contacto em breve.</p>
                    <meta http-equiv=\"refresh\" content=\"5; url=index.html\">
                </div>
            </body>
            </html>
        ";
    } catch (Exception $e) {
        echo "Erro ao enviar o email: {$mail->ErrorInfo}";
    }
}
?>
