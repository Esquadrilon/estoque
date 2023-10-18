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

  <title>Lista Cores</title>
</head>

<body>
  <?php
  include_once('../../includes/navbar.php');
  include_once('../../db/connection.php');
  include_once('../../includes/toast.php');
  ?>
  <main class="container-fluid d-flex justify-content-center align-items-center my-3 w-100 flex-column">
    <div class="text-center mb-4">
      <a href="./create.php" class="btn btn-success">
        <i class="bi bi-palette2"></i> Cadastrar Cor
      </a>
    </div>
    <div class="wrapper w-50 p-4">
        <div class="row row-cols-4 d-flex justify-content-center align-items-center p-1 rounded">
          <div class="col fs-3 fw-bold text-center border-end border-1 border-white">Id</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Nome</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Código RAL</div>
          <div class="col fs-3 fw-bold text-center border-start border-1 border-white"></div>
        </div>
      <?php
      $sql = "SELECT * FROM cores";
      $res = $conn->query($sql);

      if ($res->num_rows > 0) {
        $cores = $res->fetch_all(MYSQLI_ASSOC);

        foreach ($cores as $cor) {

          echo '
          <div class="row row-cols-4 mt-2 d-flex justify-content-center align-items-center p-1 rounded mt-2">
            <div class="col fw-semibold text-center border-end border-1 border-white"> ' . $cor['id'] . ' </div>
            <div class="col fw-semibold text-center border-start border-end border-1 border-white"> ' . $cor['nome'] . ' </div>
            <div class="col fw-semibold text-center border-start border-end border-1 border-white"> ' . $cor['codigo'] . ' </div>
            <div class="col fw-semibold text-center border-start border-1 border-white">
              <a href="./update.php?id=' . $cor['id'] . '" class="btn btn-primary">
                <i class="bi bi-pencil-fill"></i>
              </a>
              <a href="./controller.php?id=' . $cor['id'] . '&acao=deletar" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir essa cor?\');">
                <i class="bi bi-trash-fill"></i>
              </a>
            </div>
          </div>';
        };
      } else {
        echo "<p class='alert alert-danger'>Nenhum resultado foi encontrado!</p>";
      }
      ?>
    </div>
  </main>
  <footer></footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>