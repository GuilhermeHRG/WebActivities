<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokemon";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$mensagem = ''; // Inicializa a mensagem

// Processamento do formulário de cadastro apenas se o método de requisição for POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $tipo = $_POST["tipo"];

    // Validação básica dos dados do formulário
    if (empty($nome) || empty($tipo)) {
        $mensagem = "Por favor, preencha todos os campos do formulário.";
    } else {
        // Proteção contra SQL Injection
        $inserirPokemon = "INSERT INTO pokedex (nome, tipo) VALUES (?, ?)";
        $stmt = $conn->prepare($inserirPokemon);
        $stmt->bind_param("ss", $nome, $tipo);

        if ($stmt->execute()) {
            $mensagem = "Cadastro de Pokémon realizado com sucesso!";
        } else {
            $mensagem = "Erro no cadastro. Por favor, tente novamente mais tarde.";
        }

        $stmt->close();
    }
}

// Consulta para obter todos os Pokémon
$sql = "SELECT id, nome, tipo FROM pokedex";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Realizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body, html {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            margin: 40px;
        }
    </style>
</head>
<body class="container d-flex align-items-center justify-content-center bg-success text-white" style="height: 100vh; flex-direction: column; margin:40px">
    <div class="col-md-6 bg-light rounded p-4" style="color:#000; text-align:center; font-weight:bold;">
        <?php if (!empty($mensagem)): ?>
            <p><?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
    </div>
    <div class="container d-flex align-items-center justify-content-center bg-success text-white" style="height: 100vh;flex-direction:column; ">
        <?php
        // Verifica se a consulta foi bem-sucedida antes de tentar acessar o resultado
        if ($result !== false && $result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead class="table-dark"><tr><th>ID</th><th>Nome</th><th>Tipo</th><th>Ações</th></tr></thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . htmlspecialchars($row["nome"], ENT_QUOTES, 'UTF-8') . '</td>';
                echo '<td>' . htmlspecialchars($row["tipo"], ENT_QUOTES, 'UTF-8') . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary btn-sm" href="editar_pokemon.php?id=' . $row["id"] . '">Editar</a> ';
                echo '<a class="btn btn-danger btn-sm" href="excluir_pokemon.php?id=' . $row["id"] . '" onclick="return confirm(\'Tem certeza que deseja excluir este Pokémon?\')">Excluir</a>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-info" role="alert">Nenhum Pokémon encontrado.</div>';
        }

        // Fecha a conexão após exibir a tabela
        $conn->close();
        ?>
        <a href="home.php"><button class="btn btn-primary btn-sm">Voltar ao Cadastro</button></a>
    </div>
</body>
</html>
