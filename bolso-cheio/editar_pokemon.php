<?php
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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados. Por favor, tente novamente mais tarde.");
}

$mensagem = ''; // Inicializa a mensagem

// Processamento do formulário de cadastro apenas se o método de requisição for POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $tipo = $_POST["tipo"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pokemon_id = $_POST["pokemon_id"];
        $nome = $_POST["nome"];
        $tipo = $_POST["tipo"];
    
        // Validação básica dos dados do formulário
        if (empty($nome) || empty($tipo)) {
            $mensagem = "Por favor, preencha todos os campos do formulário.";
        } else {
            // Proteção contra SQL Injection
            $atualizarPokemon = "UPDATE pokedex SET nome = ?, tipo = ? WHERE id = ?";
            $stmt = $conn->prepare($atualizarPokemon);
            $stmt->bind_param("ssi", $nome, $tipo, $pokemon_id);
    
            if ($stmt->execute()) {
                $mensagem = "Edição de Pokémon realizada com sucesso!";
            } else {
                $mensagem = "Erro na edição. Por favor, tente novamente mais tarde.";
            }
    
            $stmt->close();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edição de pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body, html {
            height: 100%;
        }
    </style>
</head>
<body class="container d-flex align-items-center justify-content-center bg-success text-green" style="height: 100vh;">
    <div class="col-md-6 bg-light rounded p-4">
        <h1 class="mb-3" style="text-align: center">Edição de cadastro de Pokemon <br>Ϟ(๑⚈ ․̫ ⚈๑)</h1>
        <form action="cadastroPoke.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <input type="hidden" name="pokemon_id" value="<?php echo $pokemon_id; ?>">

            <div style="display: flex; justify-content: center; align-items: center;">
  <button type="submit" class="btn btn-primary">Editar ✅</button>
</div>

        </form>
    </div>
</body>
</html>