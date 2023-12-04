<?php
include 'conexao.php';

$mensagem = ''; // Inicializa a mensagem
$nome = '';
$tipo = '';
$id = '';


session_start();

// Verifique se a sessão de usuário está presente
if (!isset($_SESSION['username'])) {
    // Sessão não encontrada, redirecione para a página de login
    header("Location: index.php");
    exit();
}


// Processamento do formulário de cadastro apenas se o método de requisição for POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nome']) && isset($_POST['tipo'])) {
        $nome = $_POST["nome"];
        $tipo = $_POST["tipo"];

        // Validação básica dos dados do formulário
        if (empty($nome) || empty($tipo)) {
            $mensagem = "Por favor, preencha todos os campos do formulário.";
        } else {
            // Proteção contra SQL Injection
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                $atualizarPokemon = "UPDATE pokedex SET nome = ?, tipo = ? WHERE id = ?";
                $stmt = $conn->prepare($atualizarPokemon);
                $stmt->bind_param("ssi", $nome, $tipo, $id);
            } else {
                $inserirPokemon = "INSERT INTO pokedex (nome, tipo) VALUES (?, ?)";
                $stmt = $conn->prepare($inserirPokemon);
                $stmt->bind_param("ss", $nome, $tipo);
            }

            if ($stmt->execute()) {
                $mensagem = "Operação realizada com sucesso!";
                header("Location: ".$_SERVER['PHP_SELF']); // Redireciona para a mesma página
                exit();
            } else {
                $mensagem = "Erro na operação. Por favor, tente novamente mais tarde.";
            }

            $stmt->close();
        }
    } elseif (isset($_POST['id_excluir'])) {
        $id = $_POST['id_excluir'];

        // Proteção contra SQL Injection
        $excluirPokemon = "DELETE FROM pokedex WHERE id = ?";
        $stmt = $conn->prepare($excluirPokemon);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $mensagem = "Pokémon excluído com sucesso!";
            header("Location: ".$_SERVER['PHP_SELF']); // Redireciona para a mesma página
            exit();
        } else {
            $mensagem = "Erro na exclusão. Por favor, tente novamente mais tarde.";
        }

        $stmt->close();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Proteção contra SQL Injection
    $selecionarPokemon = "SELECT nome, tipo FROM pokedex WHERE id = ? ORDER BY id ASC";
    $stmt = $conn->prepare($selecionarPokemon);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nome = $row['nome'];
            $tipo = $row['tipo'];
        }
    }

    $stmt->close();
}

// Consulta para obter todos os Pokémon
$sql = "SELECT id, nome, tipo FROM pokedex";
$result = $conn->query($sql);

echo '<div style="display: flex; justify-content: center; flex-direction: row; align-items: center; margin-top: 10px;">';
echo '<a href="logout.php" class="btn btn-danger">Logout ✖</a>';
echo '</div>';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Cadastro de Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            margin: auto;
            padding: 0;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100dvh;
        }
        form {
            width: auto;
            margin:  auto;
        }

        table {
            width: auto;
            }

        .container {
            margin-top: 40px;
        }
    </style>
</head>
<div class="bg-primary container d-flex rounded p-4" style="width:auto; justify-content: flex-end;">
    <span style="color: white; text-transform: uppercase ; ">logado como :  <?php echo $_SESSION['username']; ?></span>
</div>
<body class="bg-secondary text-light  flex-column" style="width:auto; display: flex; justify-content: center ; align-items: center; padding:auto">

    <div class="container d-flex flex-column rounded p-4" style="width:50dvh;">
        <div class="bg-dark rounded p-4" style="gap: 20px;">
       
            <h1 class="mb-3  rounded p-2" style="text-align: center">Cadastro de Pokémon <br>Ϟ(๑⚈ ․̫ ⚈๑)</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3 bg-secondary rounded p-2">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required maxlength="20">
                </div>
                <div class="mb-3 bg-secondary rounded p-2">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $tipo; ?>" required maxlength="20">
                </div>
                <div style="display: flex; justify-content: center; align-items: center;">
                    <button type="submit" class="btn btn-success">Salvar ✅</button>
                </div>
            </form>
        </div>
        <div class="container d-flex flex-row  align-items-center justify-content-center table-bordered"  style="gap: 10px">
            <?php
            // Verifica se a consulta foi bem-sucedida antes de tentar acessar o resultado
            if ($result !== false && $result->num_rows > 0) {
                echo '<table class="table table-hover  rounded table-dark">';
                echo '<thead class="table-dark text-info"><tr><th>ID</th><th>Nome</th><th>Tipo</th><th>Ações</th></tr></thead>';
                echo '<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["id"] . '</td>';
                    echo '<td>' . htmlspecialchars($row["nome"], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars($row["tipo"], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>';
                    echo '<a class="btn btn-primary  btn-sm" href="'.$_SERVER['PHP_SELF'].'?id=' . $row["id"] . '">Editar ✏</a> ';
                    echo '<form style="display:inline-block margin:12px;" method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit="return confirm(\' 😲😲😲Tem certeza que deseja excluir este Pokémon? 😲😲😲\')">';
                    echo '<input type="hidden" name="id_excluir" value="'.$row["id"].'">';
                    echo '<button type="submit" class="btn btn-danger btn-sm">Excluir ✖</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="alert alert-warning" role="alert">✖✖ Nenhum Pokémon encontrado ✖✖</div>';
                
            }

            // Fecha a conexão após exibir a tabela
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
