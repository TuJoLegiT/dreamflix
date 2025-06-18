<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configurações do servidor
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'guimaraespsn1@gmail.com';            // Seu e-mail do Gmail
    $mail->Password   = 'dbau dbfq xhxy frcu';       // Senha de app, NÃO a senha normal!
    $mail->SMTPSecure = 'tls';                           // ou 'ssl'
    $mail->Port       = 587;                             // 465 se usar 'ssl'

    // Remetente e destinatário
    $mail->setFrom('guimaraespsn1@gmail.com', 'Alexandre');
    $mail->addAddress('souzapaiva5juh@gmail.com', 'Julia');

    // Conteúdo
    $mail->isHTML(true);
    $mail->Subject = 'Apenas uma email com logica backend aplicada com PHP';
    $mail->Body    = 'Segue o envio <b>HTML</b>  <br>';
    $mail->AltBody = '';

    $mail->send();
    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar: {$mail->ErrorInfo}";
}
