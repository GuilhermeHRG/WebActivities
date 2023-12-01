<?php
// require 'C:\wamp\www\bolso-cheio\vendor/autoload.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Aqui você deve validar se o email existe no seu banco de dados
    // e, se existir, gerar um token exclusivo para esta solicitação.

    // Exemplo simples de geração de token:
    $token = bin2hex(random_bytes(16));

    // Simule a inserção do token no banco de dados junto com o email

    // Envie o email com o link de recuperação
    require 'vendor/autoload.php'; // Caminho do PHPMailer

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'seu_servidor_smtp';
    $mail->SMTPAuth = true;
    $mail->Username = 'seu_email_smtp';
    $mail->Password = 'sua_senha_smtp';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('seu_email_smtp', 'Seu Nome');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Recuperação de Senha';
    $mail->Body = "Clique no link para recuperar sua senha: <a href='http://seusite.com/reset.php?email={$email}&token={$token}'>Recuperar Senha</a>";

    if ($mail->send()) {
        $_SESSION['message'] = 'Email de recuperação enviado com sucesso. Verifique sua caixa de entrada.';
    } else {
        $_SESSION['message'] = 'Erro ao enviar o email de recuperação. Tente novamente mais tarde.';
    }

    header('Location: reset.php');
} else {
    header('Location: reset.php');
}
