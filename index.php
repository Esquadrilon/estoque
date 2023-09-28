<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/estoque/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/estoque/node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <link rel="shortcut icon" href="/estoque/img/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="/estoque/css/estilo.css">

    <title>Home</title>
</head>

<body class="min-vh-100 min-vw-100">
    <?php
    include('./includes/navbar.php')
    ?>

    <main class="container d-flex justify-content-center align-items-center my-5 w-50">
        <div class="wrapper my-5 w-50">
            <h1 class="text-center fs-1 py-3" style="border-bottom:2px solid #00E600;">O que deseja fazer?</h1>
            <div class="fs-5 px-4">
                <ul class="d-grid list-unstyled gap-2">
                    <li><i class="bi bi-person"></i> Clientes? <a href="./pages/Clientes/read.php">Clique aqui</a></li>
                    <li><i class="bi bi-buildings"></i> Obras? <a href="./pages/Obras/read.php">Clique aqui</a></li>
                    <li><i class="bi bi-slash-lg"></i> Perfis? <a href="./pages/Perfis/read.php">Clique aqui</a></li>
                    <li><i class="bi bi-palette"></i> Cores? <a href="./pages/Cores/read.php">Clique aqui</a></li>
                    <li><i class="bi bi-plus-lg"></i> Entradas? <a href="./pages/Entradas/read.php">Clique aqui</a></li>
                    <li><i class="bi bi-dash-lg"></i> Saídas? <a href="./pages/Saidas/read.php">Clique aqui</a></li>
                    <li><i class="bi bi-inboxes"></i> Ver estoque? <a href="./pages/estoque.php">Clique aqui</a></li>
                </ul>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>