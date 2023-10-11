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

  <title>Lista Entradas</title>
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
        <i class="bi bi-plus"></i> Cadastrar Entrada
      </a>
    </div>
    <div class="wrapper w-100 p-4">
        <div class="row row-cols-8 d-flex justify-content-center align-items-center p-1 rounded">
          <div class="col fs-3 fw-bold text-center border-end border-1 border-white">Obra</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Perfil</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Tamanho</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Cor</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Quantidade</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Origem</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Nota</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Responsável</div>
          <div class="col fs-3 fw-bold text-center border-start border-1 border-white"></div>
        </div>
      <?php
      $sql = 
      "SELECT 
        e.id,
        o.nome as obra,
        e.perfil_codigo as perfil,
        e.tamanho,
        c.nome as cor,
        e.origem,
        e.quantidade,
        e.nota,
        e.responsavel 
      from 
        entradas e
      left join
        obras o 
      on
      e.obra_id = o.id
      left join
        cores c 
      on
      e.cor_id  = c.id";

      $res = $conn->query($sql);

      if ($res->num_rows > 0) {
        $entradas = $res->fetch_all(MYSQLI_ASSOC);

        foreach ($entradas as $entrada) {

          echo '
          <div class="row row-cols-8 mt-2 d-flex justify-content-center align-items-center p-1 rounded">
            <div class="col fw-semibold text-center border-end border-1 border-white"> ' . $entrada['obra'] . ' </div>
            <div class="col fw-semibold text-center border-start border-end border-1 border-white"> ' . $entrada['perfil'] . ' </div>
            <div class="col fw-semibold text-center border-start border-end border-1 border-white"> ' . $entrada['tamanho'] . ' </div>
            <div class="col fw-semibold text-center border-start border-end border-1 border-white"> ' . $entrada['cor'] . ' </div>
            <div class="col fw-semibold text-center border-start border-end border-1 border-white"> ' . $entrada['quantidade'] . ' </div>
            <div class="col fw-semibold text-center border-start border-end border-1 border-white"> ' . $entrada['origem'] . ' </div>
            <div class="col fw-semibold text-center border-start border-end border-1 border-white"> ' . $entrada['nota'] . ' </div>
            <div class="col fw-semibold text-center border-start border-end border-1 border-white"> ' . $entrada['responsavel'] . ' </div>
            <div class="col fw-semibold text-center">
              <a href="./update.php?id=' . $entrada['id'] . '" class="btn btn-primary">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="./controller.php?id=' . $entrada['id'] . '&acao=deletar" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir esse cliente?\');">
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