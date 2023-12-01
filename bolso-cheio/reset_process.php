<?php


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Verifique se as senhas coincidem
    if ($newPassword === $confirmPassword) {
        // Aqui você deve validar se o email e o token correspondem a uma solicitação válida no seu banco de dados
        
        // Atualize a senha no banco de dados e limpe o token

        $_SESSION['message'] = 'Senha redefinida com sucesso.';
    } else {
        $_SESSION['message'] = 'As senhas não coincidem. Tente novamente.';
    }

    header('Location: reset.php');
} else {
    header('Location: reset.php');
}
