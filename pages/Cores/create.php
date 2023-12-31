<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/estoque/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/estoque/node_modules/bootstrap-icons/font/bootstrap-icons.css">

  <link rel="stylesheet" href="/estoque/css/estilo.css">

  <title>Cadastro Cor</title>
</head>

<body>
  <?php
  include_once('../../includes/navbar.php');
  include_once('../../includes/toast.php');
  ?>
  <main class="container-fluid px-5 my-3 w-100">
    <div class="wrapper p-4 my-1 w-75 fs-4">
      <h1 class="text-center fs-1">Cor</h1>
      <form action="./controller.php" method="post">
        <input type="hidden" name="acao" value="cadastrar">

        <div class="row">
          <div class="col mt-2">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Cinza Epristinta">
          </div>

          <div class="col mt-2">
            <label for="codigo">Código RAL</label>
            <input type="text" name="codigo" id="codigo" class="form-control" placeholder="W2635">
          </div>
        </div>

        <div class="row mt-4">
          <div class="col w-50">
            <button type="button" class="btn btn-danger w-100 fs-5 fw-semibold" onclick="clearData()">Limpar</button>
          </div>

          <div class="col w-50">
            <button type="submit" class="btn btn-success w-100 fs-5 fw-bold">Cadastrar</button>
          </div>
        </div>

      </form>
    </div>
  </main>
  <footer></footer>
  <script>
    function clearData() {
      document.getElementById('nome').value = '';
      document.getElementById('codigo').value = '';
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>