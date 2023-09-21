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

  <title>Atualizando Perfil</title>
</head>

<body>
  <?php
  include_once('../../includes/navbar.php');
  include_once('../../db/connection.php');
  include_once('../../includes/toast.php');

  if (isset($_GET['perfil'])) {
    $sql = "SELECT * FROM perfis WHERE codigo = '" . $_REQUEST['perfil'] . "'";


    $res = $conn->query($sql);

    $row = $res->fetch_object();
  }
  ?>
  <main class="container d-flex justify-content-center align-items-center my-5">
    <div class="wrapper p-4 my-1 w-75 fs-4">
      <h1 class="text-center fs-1">Perfil</h1>
      <form action="./controller.php?id='<?php echo $_REQUEST['perfil'] ?>'" method="post">
        <input type="hidden" name="acao" value="editar">


        <div class="row mt-2">
          <div class="col">
            <label for="codigo">Codigo</label>
            <input type="text" name="codigo" id="codigo" value="<?php print $row->codigo ?>" class="form-control" placeholder="PER-MP347" disabled>
          </div>

          <div class="col">
            <label for="peso">Peso / Metro</label>
            <input type="" name="peso" id="peso" step="0.01" value="<?php print $row->peso ?>" class="form-control" placeholder="0.728 Kg">
          </div>
        </div>

        <div class="col mt-2">
          <label for="descricao">Descrições</label>
          <textarea class="form-control" name="descricao" id="descricao" cols="50" rows="3" placeholder="Lambri"><?php print $row->descricao ?></textarea>
        </div>

        <div class="row  mt-2">
          <div class="col">
            <label for="nativo">Pré-Nativo</label>
            <input type="text" name="nativo" id="nativo" value="<?php print $row->nativo ?>" class="form-control" placeholder="Gradline - S">
          </div>

          <div class="col">
            <label for="linha">Linha</label>
            <input type="text" name="linha" id="linha" class="form-control" value="<?php print $row->linha ?>" placeholder="Gradline">
          </div>
        </div>

        <div class="col mt-2">
          <label for="referencia">Referência</label>
          <input type="text" name="referencia" id="referencia" value="<?php print $row->referencia ?>" class="form-control" placeholder="Perfil Aluminio">
        </div>

        <div class="row mt-4">
          <div class="col w-50">
            <button type="button" class="btn btn-outline-danger w-100 fs-5 fw-semibold" onclick="clearData()">Limpar</button>
          </div>

          <div class="col w-50">
            <button type="submit" class="btn btn-outline-success w-100 fs-5 fw-bold">Atualizar</button>
          </div>
        </div>

      </form>
    </div>
  </main>
  <footer></footer>
  <script>
    function clearData() {
      document.getElementById('peso').value = '';
      document.getElementById('nativo').value = '';
      document.getElementById('linha').value = '';
      document.getElementById('referencia').value = '';
      document.getElementById('descricao').value = '';
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>