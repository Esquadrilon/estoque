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

  <title>Lista de Obras</title>
</head>

<body>
  <?php
  include_once('/estoque/db/connection.php');
  include('/estoque/includes/navbar.php');
  ?>
  <main class="container-fluid d-flex justify-content-center align-items-center my-3 w-100 flex-column">
    <div class="text-center mb-4">
      <a href="./create.php" class="btn btn-success">
        <i class="bi bi-plus"></i> Cadastrar Obra
      </a>
    </div>
    <div class="wrapper w-100 p-4">
      <div class="row">
        <div class="col-2 fs-3 fw-bold text-center border-end border-1 border-white">Nome</div>
        <div class="col-2 fs-3 fw-bold text-center border-start border-end border-1 border-white">Cliente</div>
        <div class="col-1 fs-3 fw-bold text-center border-start border-end border-1 border-white">Situação</div>
        <div class="col-2 fs-3 fw-bold text-center border-start border-end border-1 border-white">Endereço</div>
        <div class="col-1 fs-3 fw-bold text-center border-start border-end border-1 border-white">Cidade</div>
        <div class="col-2 fs-3 fw-bold text-center border-start border-end border-1 border-white">Observações</div>
        <div class="col fs-3 fw-bold text-center border-start border-1 border-white"></div>
      </div>
      <?php
      $sql = "SELECT * FROM obras";
      $res = $conn->query($sql);

      if ($res->num_rows > 0) {
        $obras = $res->fetch_all(MYSQLI_ASSOC);

        foreach ($obras as $obra) {
          echo '
          <div class="row mt-2">
            <div class="col-2 text-center border-end border-1 border-white">' . $obra['nome'] . '</div>
            <div class="col-2 text-center border-start border-end border-1 border-white">' . $obra['cliente_id'] . '</div>
            <div class="col-1 text-center border-start border-end border-1 border-white">' . $obra['situacao'] . '</div>
            <div class="col-2 text-center border-start border-end border-1 border-white">' . $obra['endereco'] . '</div>
            <div class="col-1 text-center border-start border-end border-1 border-white">' . $obra['cidade_id'] . '</div>
            <div class="col-2 text-center border-start border-end border-1 border-white">' . $obra['observacoes'] . '</div>
            <div class="col text-center border-start border-1 border-white">
              <a href="./update.php?id=' . $obra['id'] . '" class="btn btn-primary">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="./controller.php?id=' . $obra['id'] . '&acao=deletar" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir essa obra?\');">
                <i class="bi bi-trash"></i>
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