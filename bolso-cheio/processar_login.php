<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

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

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Autenticação bem-sucedida
        $_SESSION["username"] = $user["nome"];
        echo "Login bem-sucedido. Bem-vindo, " . $_SESSION["username"] . "!";
        header("Location: home.php");
    } else {
        // Credenciais incorretas
        echo "Credenciais incorretas. Por favor, tente novamente.";
    }

    $stmt->close();
    $conn->close();
}
?>
