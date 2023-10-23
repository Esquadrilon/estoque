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

  <title>Lista Clientes</title>
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
        <i class="bi bi-person-fill-add"></i> Cadastrar Cliente
      </a>
    </div>
    <div class="wrapper w-100 p-4">
      <div class="row d-flex justify-content-center align-items-center p-1 border-bottom border-2 border-white">
        <div class="col-2 fs-3 fw-bold">Nome</div>
        <div class="col-2 fs-3 fw-bold">E-mail</div>
        <div class="col-1 fs-3 fw-bold">Telefone</div>
        <div class="col-2 fs-3 fw-bold">Endereço</div>
        <div class="col   fs-3 fw-bold">Cidade</div>
        <div class="col-2 fs-3 fw-bold">Observações</div>
        <div class="col   fs-3 fw-bold"></div>
      </div>

      <?php
      $sql = 
      "SELECT
        c.id,
        c.nome,
        c.email,
        c.telefone, 
        c.endereco, 
        cidades.nome as cidade,
        c.observacoes 
      from 
        clientes c
      left join
        cidades
      on
        cidades.id  = c.cidade_id";
      $res = $conn->query($sql);

      if ($res->num_rows > 0) {
        $clientes = $res->fetch_all(MYSQLI_ASSOC);

        foreach ($clientes as $cliente) {
          echo '
          <div class="row mt-2 d-flex justify-content-center align-items-center p-1 rounded">
            <div class="col-2 fw-semibold"> ' . $cliente['nome'] . ' </div>
            <div class="col-2 fw-semibold"> ' . $cliente['email'] . ' </div>
            <div class="col-1 fw-semibold"> ' . $cliente['telefone'] . ' </div>
            <div class="col-2 fw-semibold"> ' . $cliente['endereco'] . ' </div>
            <div class="col   fw-semibold"> ' . $cliente['cidade'] . ' </div>
            <div class="col-2 fw-semibold"> ' . $cliente['observacoes'] . ' </div>
            <div class="col   fw-semibold">
              <a href="./update.php?id=' . $cliente['id'] . '" class="btn btn-primary">
                <i class="bi bi-pencil-fill"></i>
              </a>
              <a href="./controller.php?id=' . $cliente['id'] . '&acao=deletar" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir esse cliente?\');">
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