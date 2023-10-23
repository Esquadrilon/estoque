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

  <title>Lista Obras</title>
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
        <i class="bi bi-building-fill-add"></i> Cadastrar Obra
      </a>
    </div>
    <div class="wrapper w-100 p-4">
      <div class="row d-flex justify-content-center align-items-center p-1 border-bottom border-2 border-white">
        <div class="col-2 fs-3 fw-bold">Nome</div>
        <div class="col-2 fs-3 fw-bold">Cliente</div>
        <div class="col-1 fs-3 fw-bold">Status</div>
        <div class="col-2 fs-3 fw-bold">Endereço</div>
        <div class="col-1 fs-3 fw-bold">Cidade</div>
        <div class="col-2 fs-3 fw-bold">Observações</div>
        <div class="col   fs-3 fw-bold"></div>
      </div>
      
      <?php
      include_once('../../db/connection.php');

      $sql = 
      "SELECT
        o.id,
        o.nome,
        o.situacao,
        o.endereco,
        cl.nome as cliente,
        ci.nome as cidade,
        o.observacoes 
      FROM 
        obras o
      LEFT JOIN
        clientes cl 
      ON
        o.cliente_id = cl.id
      LEFT JOIN
        cidades ci
      ON
        o.cidade_id = ci.id";
      
      $res = $conn->query($sql);

      if ($res->num_rows > 0) {
        $obras = $res->fetch_all(MYSQLI_ASSOC);
        
        foreach ($obras as $obra) {
          $clientes = $conn->query("SELECT * FROM clientes")->fetch_all(MYSQLI_ASSOC);
          echo '
          <div class="row mt-2 d-flex justify-content-center align-items-center p-1 rounded">
            <div class="col-2 fw-semibold"> ' . $obra['nome'] . ' </div>
            <div class="col-2 fw-semibold"> ' . $obra['cliente'] . ' </div>
            <div class="col-1 fw-semibold"> ' . $obra['situacao'] . ' </div>
            <div class="col-2 fw-semibold"> ' . $obra['endereco'] . ' </div>
            <div class="col-1 fw-semibold"> ' . $obra['cidade'] . ' </div>
            <div class="col-2 fw-semibold"> ' . $obra['observacoes'] . ' </div>
            <div class="col   fw-semibold">
              <a href="./update.php?id=' . $obra['id'] . '" class="btn btn-primary">
                <i class="bi bi-pencil-fill"></i>
              </a>
              <a href="./controller.php?id=' . $obra['id'] . '&acao=deletar" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir essa obra?\');">
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