<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/estoque/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/estoque/node_modules/bootstrap-icons/font/bootstrap-icons.css">
  <script src="/estoque/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="shortcut icon" href="/estoque/img/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="/estoque/css/estilo.css">

  <title>Lista Saídas</title>
</head>

<body>
  <?php
  include_once('../../includes/navbar.php');
  include_once('../../db/connection.php');
  include_once('../../includes/toast.php');
  ?>
  <main class="container-fluid d-flex justify-content-center align-items-center my-3 w-100 flex-column">
    <div class="text-center mb-4">
      <a href="./create.php" class="btn btn-danger">
        <i class="bi bi-clipboard2-minus-fill"></i> Cadastrar Saída
      </a>
    </div>
    <div class="wrapper w-100 p-4">
        <div class="row row-cols-10 d-flex justify-content-center align-items-center p-1 border-bottom border-2 border-white">
          <div class="col fs-3 fw-bold">Obra</div>
          <div class="col fs-3 fw-bold">Perfil</div>
          <div class="col fs-3 fw-bold">Tamanho</div>
          <div class="col fs-3 fw-bold">Cor</div>
          <div class="col fs-3 fw-bold">Quantidade</div>
          <div class="col fs-3 fw-bold">Data</div>
          <div class="col fs-3 fw-bold">Destino</div>
          <div class="col fs-3 fw-bold">Romaneio</div>
          <div class="col fs-3 fw-bold">Responsável</div>
          <div class="col fs-3 fw-bold"></div>
        </div>
      <?php
      $sql = 
      "SELECT 
        s.id,
        o.nome as obra,
        s.perfil_codigo as perfil,
        s.tamanho,
        c.nome as cor,
        s.destino,
        s.quantidade,
        s.romaneio,
        s.responsavel,
        s.criado
      from 
        saidas s
      left join
        obras o 
      on
      s.obra_id = o.id
      left join
        cores c 
      on
      s.cor_id  = c.id";

      $res = $conn->query($sql);

      if ($res->num_rows > 0) {
        $saidas = $res->fetch_all(MYSQLI_ASSOC);
        
        foreach ($saidas as $saida) {
          echo '
          <div class="row row-cols-10 mt-2 d-flex justify-content-center align-items-center p-1 rounded">
            <div class="col fw-semibold"> ' . $saida['obra'] . '</div>
            <div class="col fw-semibold"> ' . $saida['perfil'] . ' </div>
            <div class="col fw-semibold"> ' . $saida['tamanho'] . ' </div>
            <div class="col fw-semibold"> ' . $saida['cor'] . ' </div>
            <div class="col fw-semibold"> ' . $saida['quantidade'] . ' </div>
            <div class="col fw-semibold"> ' . date("d/m/Y", strtotime($saida['criado'])) . ' </div>
            <div class="col fw-semibold"> ' . $saida['destino'] . ' </div>
            <div class="col fw-semibold"> ' . $saida['romaneio'] . ' </div>
            <div class="col fw-semibold"> ' . $saida['responsavel'] . ' </div>
            <div class="col fw-semibold">
              <a href="./update.php?id=' . $saida['id'] . '" class="btn btn-primary">
                <i class="bi bi-pencil-fill"></i>
              </a>
              <a href="./controller.php?id=' . $saida['id'] . '&acao=deletar" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir essa saída?\');">
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
</body>

</html>