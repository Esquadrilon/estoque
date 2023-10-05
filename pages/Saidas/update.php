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

  <title>Editar Saída</title>
</head>

<body>
  <?php
  include_once('../../includes/navbar.php');
  include_once('../../db/connection.php');
  include_once('../../includes/toast.php');

  if (isset($_GET['id'])) {
    $sql = "SELECT * FROM saidas WHERE id = " . $_REQUEST['id'];
    
    $res = $conn->query($sql);

    $row = $res->fetch_object();
  }
  ?>
  <main class="container d-flex justify-content-center align-items-center my-5">
    <div class="wrapper p-4 my-1 w-100 fs-4">
      <h1 class="text-center fs-1">Saída</h1>
      <form action="./controller.php" method="post" id="form">
        <input type="hidden" name="acao" value="cadastrar">

        <div class="row mt-2">
          <div class="col">
            <label for="obra_id">Obra</label>
            <select name="obra_id" id="obra_id" class="form-select" required>
              <option value="" selected>Selecione...</option>
              <?php
              $obras = $conn->query("SELECT * FROM obras");
              while ($obra = $obras->fetch_object()) {
                $obra->id == $row->obra_id
                  ? print "<option value=\"$obra->id\" selected> $obra->nome </option>"
                  : print "<option value=\"$obra->id\"> $obra->nome </option>";
              }
              ?>
            </select>
          </div>
        </div>
        
        <div class="row mt-2">
          <div class="col">
            <label for="origem">Origem</label>
            <input type="text" name="origem" id="origem" value="<?php echo $row->origem?>" class="form-control" placeholder="Perfil Aluminio" required>
          </div>

          <div class="col">
            <label for="destino">Destino</label>
            <input type="text" name="destino" id="destino" value="<?php echo $row->destino?>" class="form-control" placeholder="1 Lote Torre">
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <label for="romaneio">Romaneio</label>
            <input type="text" name="romaneio" id="romaneio" value="<?php echo $row->romaneio?>" class="form-control" placeholder="NF 16341">
          </div>

          <div class="col">
            <label for="responsavel">Responsável</label>
            <input type="text" name="responsavel" id="responsavel" value="<?php echo $row->responsavel ?>" class="form-control" placeholder="Erick" required>
          </div>
        </div>
        
        <div class="row mt-2">
          <div class="col">
            <label for="caminhao">Placa do Caminhão</label>
            <input type="text" name="caminhao" id="caminhao" value="<?php $row->caminhao?>" class="form-control" placeholder="BCP3B29">
          </div>

          <div class="col">
            <label for="motorista">Motorista</label>
            <input type="text" name="motorista" id="motorista" value="<?php $row->motorista?>" class="form-control" placeholder="Fábio">
          </div>
        </div>

        <div class="col mt-2">
          <label for="observacoes">Observações</label>
          <textarea class="form-control" name="observacoes" id="observacoes" cols="50" rows="3" placeholder="Se necessário"><?php $row->observacoes?></textarea>
        </div>

        <div class="row mt-2">
          <div class="col">
            <label for="perfil">Perfil</label>
            <select name="perfil" class="form-select">
              <option value="" selected>Selecione...</option>
              <?php
              $perfis = $conn->query("SELECT * FROM perfis");
              while ($perfil = $perfis->fetch_object()) {
                $perfil->codigo == $row->perfil_codigo
                  ? print "<option value=\"$perfil->codigo\" selected> $perfil->codigo </option>"
                  : print "<option value=\"$perfil->codigo\"> $perfil->codigo </option>";
              }
              ?>
            </select>
          </div>

          <div class="col">
            <label for="tamanho">Tamanho</label>
            <input type="number" name="tamanho" min="1000" max="9999" value="<?php echo $row->tamanho?>" class="form-control" placeholder="6000mm">
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <label for="cor_id">Cor</label>
            <select name="cor_id" class="form-select">
              <option value="" selected>Selecione...</option>
              <?php
              $cores = $conn->query("SELECT * FROM cores");
              while ($cor = $cores->fetch_object()) {
                $cor->id == $row->cor_id
                  ? print "<option value=\"$cor->id\" selected> $cor->nome </option>"
                  : print "<option value=\"$cor->id\"> $cor->nome </option>";
              }
              ?>
            </select>
          </div>

          <div class="col">
            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" min="1" value="<?php echo $row->quantidade?>" class="form-control" placeholder="1">
          </div>
        </div>

        <div class="row mt-4">
          <div class="col w-50">
            <button type="button" class="btn btn-danger w-100 fs-5 fw-semibold" onclick="window.location.href = './read.php'">Cancelar</button>
          </div>

          <div class="col w-50">
            <button type="submit" class="btn btn-success w-100 fs-5 fw-bold">Cadastrar</button>
          </div>
        </div>

      </form>
    </div>
  </main>
  <footer>

  </footer>
  <script>
    document.getElementById("form").addEventListener("keydown", function (event) {
      event.keyCode === 13
        ?event.preventDefault()
        : null;
    });

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>