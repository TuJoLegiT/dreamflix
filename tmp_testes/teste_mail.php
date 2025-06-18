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
    $mail->addAddress('gvbpereirap@gmail.com', 'Guilherme Perna');

    // Conteúdo
    $mail->isHTML(true);
    $mail->Subject = 'Assunto do e-mail';
    $mail->Body    = 'ALOOOO, cade voce meu amigo. Estou te esperando pra me ajudar com ideias. rsrsrs<b>HTML</b>';
    $mail->AltBody = 'Corpo do e-mail em texto plano';

    $mail->send();
    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar: {$mail->ErrorInfo}";
}
