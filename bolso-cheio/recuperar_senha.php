<?php
// recuperar_senha.php
session_start();

// Inclua a biblioteca PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'caminho/para/PHPMailer/src/Exception.php';
require 'caminho/para/PHPMailer/src/PHPMailer.php';
require 'caminho/para/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $email = $_POST["email"];

    // Conecte-se ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pokemon";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifique a conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Consulta SQL para verificar se o email existe
    $sql = "SELECT id, nome FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Email encontrado, você pode implementar a lógica de recuperação aqui (por exemplo, enviar um email com um link de recuperação de senha)

        // Gere um token único para a recuperação de senha (pode ser implementado de maneira mais segura)
        $token = md5(uniqid(rand(), true));

        // Atualize o token no banco de dados
        $updateTokenSql = "UPDATE usuarios SET token_recuperacao = ? WHERE email = ?";
        $updateTokenStmt = $conn->prepare($updateTokenSql);
        $updateTokenStmt->bind_param("ss", $token, $email);
        $updateTokenStmt->execute();
        $updateTokenStmt->close();

        // Envie o e-mail com o link de recuperação
        $mail = new PHPMailer(true);

        try {
            //Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.seuservidor.com'; // Substitua pelo seu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'seuemail@dominio.com'; // Substitua pelo seu e-mail
            $mail->Password = 'suasenha'; // Substitua pela sua senha
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Configurações do e-mail
            $mail->setFrom('seuemail@dominio.com', 'Seu Nome');
            $mail->addAddress($email, $user["nome"]);
            $mail->isHTML(true);

            //Conteúdo do e-mail
            $mail->Subject = 'Recuperação de Senha';
            $mail->Body    = 'Clique no link a seguir para redefinir sua senha: <a href="http://seusite.com/redefinir_senha.php?token=' . $token . '">Redefinir Senha</a>';

            $mail->send();

            echo "<p>Um email de recuperação de senha foi enviado para " . $email . "</p>";
        } catch (Exception $e) {
            echo "Erro ao enviar o email: {$mail->ErrorInfo}";
        }
    } else {
        // Email não encontrado
        echo "<p>O email fornecido não está registrado em nossa base de dados.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
