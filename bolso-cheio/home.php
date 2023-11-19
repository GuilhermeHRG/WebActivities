<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de pokemon</title>
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
        <h1 class="mb-3" style="text-align: center">Cadastro de pokemon <br>Ϟ(๑⚈ ․̫ ⚈๑)</h1>
        <form action="cadastroPoke.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <div style="display: flex; justify-content: center; align-items: center;">
  <button type="submit" class="btn btn-primary">Cadastrar ✅</button>
</div>

        </form>
    </div>
</body>
</html>