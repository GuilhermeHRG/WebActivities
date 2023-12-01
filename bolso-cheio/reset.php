<?php

session_start();

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
    // Aqui você deve validar se o email e o token correspondem a uma solicitação válida no seu banco de dados
} else {
    header('Location: home.php');
}
?>

<html>
<head>
    <title>Redefinir Senha</title>
</head>
<body>

<h2>Redefinir Senha</h2>

<?php
if (isset($_SESSION['message'])) {
    echo "<p>{$_SESSION['message']}</p>";
    unset($_SESSION['message']);
}
?>

<form action="reset_process.php" method="post">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <label>Nova Senha:</label>
    <input type="password" name="new_password" required><br>

    <label>Confirmar Nova Senha:</label>
    <input type="password" name="confirm_password" required><br>

    <input type="submit" value="Redefinir Senha">
</form>

</body>
</html>
