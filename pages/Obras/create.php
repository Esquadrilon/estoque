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

  <title>Cadastrando Obra</title>
</head>

<body>
  <?php
  include('/estoque/includes/navbar.php');
  ?>
  <main class="container d-flex justify-content-center align-items-center my-5">
    <div class="wrapper p-4 my-1 w-75 fs-4">
      <h1 class="text-center fs-1">Obra</h1>
      <form action="./controller.php" method="post">
        <input type="hidden" name="acao" value="cadastrar">

        <div class="col mt-2">
          <label for="nome ">Nome</label>
          <input type="text" name="nome" id="nome" class="form-control" placeholder="Atmosphere">
        </div>

        <div class="row  mt-2">
          <div class="col">
            <label for="situacao">Situacao</label>
            <input type="text" name="situacao" id="situacao" class="form-control" placeholder="Em construção">
          </div>

          <div class="col">
            <label for="website">Site</label>
            <input type="text" name="website" id="website" class="form-control" placeholder="https://exemplo.com.br/exemplo">
          </div>
        </div>

        <div class="col">
          <label for="cliente_id">Cliente</label>
          <select name="cliente_id" id="cliente_id" class="form-select">
            <option value="0" selected>Selecione...</option>
            <?php
            $clientes = $conn->query("select * from clientes");
            while ($cliente = $clientes->fetch_object()) {
              print "<option value='$cliente->id'> $cliente->nome </option>";
            }
            ?>
          </select>
        </div>

        <div class="col mt-2">
          <label for="endereco">Rua</label>
          <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Paissandu, 931">
        </div>

        <div class="row mt-2">
          <div class="col">
            <label for="cidade_id">Cidade</label>
            <select name="cidade_id" id="cidade_id" class="form-select">
              <option value="0" selected>Selecione...</option>
              <?php
              $cidades = $conn->query("SELECT * FROM municipio");
              while ($cidade = $cidades->fetch_object()) {
                print "<option value='$cidade->id'> $cidade->nome </option>";
              }
              ?>
            </select>
          </div>

          <div class="col">
            <label for="estado_id">Estado</label>
            <select name="estado_id" id="estado_id" class="form-select">
              <option value="0" selected>Selecione...</option>
              <?php
              $estados = $conn->query("SELECT * FROM estado");
              while ($estado = $estados->fetch_object()) {
                print "<option value=\"$estado->id\"> $estado->nome </option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="col mt-2">
          <label for="cep">CEP</label>
          <input type="text" name="cep" id="cep" class="form-control" placeholder="87050-130">
        </div>

        <div class="col mt-2">
          <label for="observacoes">Observações</label>
          <textarea class="form-control" name="observacoes" id="observacoes" cols="50" rows="3" placeholder="Se necessário"></textarea>
        </div>

        <div class="row mt-4">
          <div class="col w-50">
            <button type="button" class="btn btn-outline-danger w-100 fs-5 fw-semibold" onclick="clearData()">Limpar</button>
          </div>

          <div class="col w-50">
            <button type="submit" class="btn btn-outline-success w-100 fs-5 fw-bold">Cadastrar</button>
          </div>
        </div>

      </form>
    </div>
  </main>
  <footer></footer>
  <script>
    function clearData() {
      document.getElementById('nome').value = '';
      document.getElementById('situacao').value = '';
      document.getElementById('website').value = '';
      document.getElementById('cliente_id').value = '';
      document.getElementById('endereco').value = '';
      document.getElementById('cidade_id').value = '';
      document.getElementById('estado_id').value = '';
      document.getElementById('cep').value = '';
      document.getElementById('observacoes').value = '';
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>