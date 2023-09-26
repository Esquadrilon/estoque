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
        <i class="bi bi-plus"></i> Cadastrar Cliente
      </a>
    </div>
    <div class="wrapper w-100 p-4">
      <div class="row">
        <div class="col-2 fs-3 fw-bold text-center border-end border-1 border-white">Nome</div>
        <div class="col-2 fs-3 fw-bold text-center border-start border-end border-1 border-white">E-mail</div>
        <div class="col-1 fs-3 fw-bold text-center border-start border-end border-1 border-white">Telefone</div>
        <div class="col-2 fs-3 fw-bold text-center border-start border-end border-1 border-white">Endereço</div>
        <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Cidade</div>
        <div class="col-2 fs-3 fw-bold text-center border-start border-end border-1 border-white">Observações</div>
        <div class="col fs-3 fw-bold text-center border-start border-1 border-white"></div>
      </div>

      <?php
      $sql = "SELECT * FROM clientes";
      $res = $conn->query($sql);

      if ($res->num_rows > 0) {
        $clientes = $res->fetch_all(MYSQLI_ASSOC);

        foreach ($clientes as $cliente) {
          $cidades = $conn->query("SELECT * FROM cidades")->fetch_all(MYSQLI_ASSOC);
          foreach($cidades as $cidade){
            $cliente['cidade_id'] == $cidade['id'] 
              ? $nome_cidade = $cidade['nome']
              : null; 
          };
          echo '
          <div class="row mt-2">
            <div class="col-2 text-center border-end border-1 border-white">' . $cliente['nome'] . '</div>
            <div class="col-2 text-center border-start border-end border-1 border-white">' . $cliente['email'] . '</div>
            <div class="col-1 text-center border-start border-end border-1 border-white">' . $cliente['telefone'] . '</div>
            <div class="col-2 text-center border-start border-end border-1 border-white">' . $cliente['endereco'] . '</div>
            <div class="col text-center border-start border-end border-1 border-white">' . $nome_cidade . '</div>
            <div class="col-2 text-center border-start border-end border-1 border-white">' . $cliente['observacoes'] . '</div>
            <div class="col text-center border-start border-1 border-white">
              <a href="./update.php?id=' . $cliente['id'] . '" class="btn btn-primary">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="./controller.php?id=' . $cliente['id'] . '&acao=deletar" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir esse cliente?\');">
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