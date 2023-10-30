<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/estoque/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/estoque/node_modules/bootstrap-icons/font/bootstrap-icons.css">
  
  <link rel="stylesheet" href="/estoque/css/estilo.css">

  <title>Lista de Perfis</title>
</head>

<body>
  <?php
  include_once('../../includes/navbar.php');
  include_once('../../db/connection.php');
  include_once('../../includes/toast.php');
  ?>
  <main class="container-fluid px-5 my-3 w-100">
    <div class="text-center mb-4">
      <a href="./create.php" class="btn btn-success">
        <i class="bi bi-code"></i> Cadastrar Perfil
      </a>
    </div>
    <div class="wrapper px-4 py-1">
      <div class="row fs-3 fw-bold d-flex align-items-center p-1 border-bottom border-2 border-white">
        <div class="col">Código</div>
        <div class="col-3">Descrição</div>
        <div class="col">Peso</div>
        <div class="col">Pré-Nativo</div>
        <div class="col">Linha</div>
        <div class="col">Referência</div>
        <div class="col-1"></div>
      </div>
      
      <?php
      $sql = "SELECT * FROM perfis";
      $res = $conn->query($sql);

      if ($res->num_rows > 0) {
        $perfis = $res->fetch_all(MYSQLI_ASSOC);

        foreach ($perfis as $perfil) {
          echo '
          <div class="row fs-5 fw-medium my-2 d-flex align-items-center p-1 rounded" style="background-color: rgba(3, 3, 3, 0.25)">
            <div class="col"> ' . $perfil['codigo'] . ' </div>
            <div class="col-3"> ' . $perfil['descricao'] . ' </div>
            <div class="col"> ' . $perfil['peso'] . ' </div>
            <div class="col"> ' . $perfil['nativo'] . ' </div>
            <div class="col"> ' . $perfil['linha'] . ' </div>
            <div class="col"> ' . $perfil['referencia'] . ' </div>
            <div class="col-1 text-end">
              <a href="./update.php?perfil=' . $perfil['codigo'] . '" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem">
                <i class="bi bi-pencil-fill"></i>
              </a>
              <a href="./controller.php?perfil=' . $perfil['codigo'] . '&acao=deletar" class="btn btn-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem" onclick="return confirm(\'Tem certeza que deseja excluir esse perfil?\');">
                <i class="bi bi-trash-fill"></i>
              </a>
            </div>
          </div>';
        };
      } else {
        echo "<p class='alert alert-danger text-center'>Nenhum resultado foi encontrado!</p>";
      }
      ?>


    </div>
  </main>
  <footer></footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>