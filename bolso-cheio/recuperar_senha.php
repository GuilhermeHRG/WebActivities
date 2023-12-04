<?php
include 'conexao.php';

// ...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Verifique se o e-mail existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Gere um token único para a recuperação de senha
        $token = bin2hex(random_bytes(16));

        // Atualize o banco de dados com o token
        $update_sql = "UPDATE usuarios SET token = '$token' WHERE email = '$email'";
        $conn->query($update_sql);

        // Configurar as configurações de e-mail
        ini_set("SMTP", "smtp.gmail.com");
        ini_set("smtp_port", 587);
        ini_set("sendmail_from", "gguilherhenri232425@gmail.com");

        // Envie um e-mail com o link de recuperação contendo o token
        $assunto = "Recuperação de Senha";
        $mensagem = "Para recuperar sua senha, clique no seguinte link: http://seusite.com/resetar_senha.php?token=$token";
        $headers = "De: webmaster@seusite.com";

        mail($email, $assunto, $mensagem, $headers);

        // Restaurar as configurações padrão de e-mail
        ini_restore("SMTP");
        ini_restore("smtp_port");
        ini_restore("sendmail_from");

        echo "Um e-mail foi enviado com instruções para a recuperação de senha.";
    } else {
        echo "E-mail não encontrado.";
    }
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

