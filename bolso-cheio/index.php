<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
         body {
            margin: auto;
            padding: 0;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            width: auto;
            margin:  auto;
        }

    </style>
</head>
<body class="container d-flex align-items-center justify-content-center bg-secondary text-light" style="height: 100vh;">
    <div class="col-md-6 bg-dark rounded p-4">
        <h1 class="mb-3 bg-success rounded p-4" style="text-align: center">Cadastro de Usuário</h1>
        <form action="processar_cadastro.php" method="POST">
            <div class="mb-3 bg-secondary rounded p-2">
                <label for="nome" class="form-label">🙎Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3 bg-secondary rounded p-2">
                <label for="email" class="form-label">✉️ Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3 bg-secondary rounded p-2">
                <label for="senha" class="form-label">🔒 Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-success" style="display: flex; justify-content: center; align-items: center;">Cadastrar-se 📝</button>
            <p class="mt-5">Já tem uma conta? <a href="login.php" class="text-info">👉Faça login aqui👈</a></p>
           

        </form>
    </div>
</body>
</html>
