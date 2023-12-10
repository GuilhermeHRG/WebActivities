<?php

include 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'enviaemail31@gmail.com';
    $mail->Password = 'kakashihatake2016';
    $mail->SMTPSecure = 'tls'; 
    $mail->Port = 587; 

    $mail->setFrom('webmaster@seusite.com', 'Webmaster');
    $mail->addAddress('guilhermehenriqueescritorio@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Recuperação de Senha';
    $mail->Body = 'Para recuperar sua senha, clique no seguinte link: <a href="http://seusite.com/resetar_senha.php?token=23d837d7ba5c2724a5cb7a7bda0b4ac1">Recuperar Senha</a>';

    $mail->send();
    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {
    echo 'Erro ao enviar o e-mail: ', $mail->ErrorInfo;
}

$conn->close();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
</head>
<body>
    <h2>Recuperação de Senha</h2>
    <form action="recuperar_senha.php" method="post">
        <label for="email">E-mail:</label>
        <input type="email" name="email" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

