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

  <title>Cadastro Cliente</title>
</head>

<body>
  <?php
  include_once('../../includes/navbar.php');
  include_once('../../db/connection.php');
  include_once('../../includes/toast.php');
  ?>
  <main class="container d-flex justify-content-center align-items-center my-5">
    <div class="wrapper p-4 my-1 w-75 fs-4">
      <h1 class="text-center fs-1">Cliente</h1>
      <form action="./controller.php" method="post">
        <input type="hidden" name="acao" value="cadastrar">

        <div class="col mt-2">
          <label for="nome ">Nome</label>
          <input type="text" name="nome" id="nome" class="form-control" placeholder="Lucas Alves">
        </div>

        <div class="row  mt-2">
          <div class="col">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="exemplo@exemplo.com">
          </div>

          <div class="col">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="(43) 91234-5678" minlength="11" maxlength="16">
          </div>
        </div>

        <div class="col mt-2">
          <label for="cpf_cnpj">CPF / CNPJ</label>
          <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control" placeholder="123.456.789-01 ou 12.345.678/0001-01">
        </div>

        <div class="col mt-2">
          <label for="endereco">Rua</label>
          <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Rua Sergipe, 123">
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
          <input type="text" name="cep" id="cep" class="form-control" placeholder="12345-678">
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
      document.getElementById('email').value = '';
      document.getElementById('telefone').value = '';
      document.getElementById('cpf_cnpj').value = '';
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