<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container d-flex align-items-center justify-content-center bg-secondary text-light" style="height: 100vh;">
    <form class="col-md-6 bg-dark rounded p-4" action="processar_login.php" method="POST">
        <h1 class="mb-4 bg-success rounded p-4" style="text-align: center">Login</h1>
        <div class="mb-3 bg-secondary rounded p-2">
            <label for="email" class="form-label">✉️ Email:</label>
            <input type="email" class="form-control p-1" id="email" name="email" required>
        </div>
        <div class="mb-3 bg-secondary rounded p-2">
            <label for="senha" class="form-label">🔒 Senha:</label>
            <input type="password" class="form-control p-1" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center">Entrar ✔️</button>
        <br>
        <a href="recuperar_senha.php" class="btn text-info ">Esqueci minha senha 😢</a>

    </form>
</body>
</html>
