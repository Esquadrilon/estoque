<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">

    <title>Home</title>
</head>

<body>
    <?php
    include('./includes/navbar.php')
    ?>
    <div class="conteudo medio">
        <h1>O que deseja olhar?</h1>
        <div class="lista">
            <p></p>
            <span>Clientes? <a href="./pages/Cliente/create.php">Clique aqui</a></span>
            <p></p>
            <span>Obras? <a href="">Clique aqui</a></span>
            <p></p>
            <span>Perfis? <a href="">Clique aqui</a></span>
            <p></p>
            <span>Cores? <a href="">Clique aqui</a></span>
            <p></p>
            <span>Tamanhos? <a href="">Clique aqui</a></span>
            <p></p>
            <span>Entradas? <a href="">Clique aqui</a></span>
            <p></p>
            <span>Saídas? <a href="">Clique aqui</a></span>
            <p></p>
            <span>Filtrar estoque? <a href="">Clique aqui</a></span>
            <p></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>