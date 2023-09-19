<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="\estoque\img\logo.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo.css">

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
                    <li>Clientes? <a href="./pages/Clientes/read.php">Clique aqui</a></li>
                    <li>Obras? <a href="">Clique aqui</a></li>
                    <li>Perfis? <a href="./pages/Perfis/read.php">Clique aqui</a></li>
                    <li>Cores? <a href="./pages/Cores/read.php">Clique aqui</a></li>
                    <li>Entradas? <a href="">Clique aqui</a></li>
                    <li>Saídas? <a href="">Clique aqui</a></li>
                    <li>Filtrar estoque? <a href="">Clique aqui</a></li>
                </ul>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>