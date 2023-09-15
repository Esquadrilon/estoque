<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="../../css/style.css">

  <title>Home</title>
</head>

<body>
  <?php
  include_once('../../db/connection.php');
  include('../../includes/navbar.php');
  ?>
  <main>
    <div class="conteudo medio text-center">
      <h1 class="titulo">Cadastro de Cliente</h1>
      <form action="./actions.php" method="post">
        <input type="hidden" name="acao" value="cadastrar">
        <div class="col">
          <label for="nome">Nome</label>
          <input type="text" name="nome" class="form-control" placeholder="Lucas Alves">
        </div>
        <div class="row">
          <div class="col">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="exemplo@exemplo.com">
          </div>
          <div class="col">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" class="form-control" placeholder="(43) 91234-5678" minlength="11" maxlength="16" pattern="^\(?[0-9]{2}+\)? ?[9] ?[0-9]{4}+\-?+[0-9]{4}$">
          </div>
        </div>
        <div class="col">
          <label for="cpf_cnpj">CPF / CNPJ</label>
          <input type="text" name="cpf_cnpj" class="form-control" placeholder="123.456.789-01 ou 12.345.678/0001-01">
        </div>
        <div class="col">
          <label for="endereco">Rua</label>
          <input type="text" name="endereco" class="form-control" placeholder="Rua Sergipe, 123">
        </div>
        <div class="row">
          <div class="col">
            <label for="cidade">Cidade</label>
            <select name="cidade" id="cidade" class="form-select" style="padding: 0 0.625rem; width: 100%; height: 3.75rem; background-color: #DCDCDC; border: none; border-radius: 8px;">
              <option value="0" selected>Selecione...</option>
              <?php
              $res = $conn->query("select * from municipio");
              $row = $res->fetch_assoc();
              while ($row = $res->fetch_object()) {
                print "<option value=\"$row->id\"> $row->nome </option>";
              }
              ?>
            </select>
          </div>
          <div class="col">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-select" style="padding: 0 0.625rem; width: 100%; height: 3.75rem; background-color: #DCDCDC; border: none; border-radius: 8px;">
              <option value="0" selected>Selecione...</option>
              <?php
              $res = $conn->query("select * from estado");
              $row = $res->fetch_assoc();
              while ($row = $res->fetch_object()) {
                print "<option value=\"$row->id\"> $row->nome </option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col">
          <label for="cep">CEP</label>
          <input type="text" name="cep" class="form-control" placeholder="12345-678">
        </div>
        <div class="col">
          <label for="observacoes">Observações</label>
          <textarea name="observacoes" cols="30" rows="10" placeholder="Se necessário"></textarea>
        </div>
        <div class="row">
          <div class="col">
            <input type="submit" value="Cadastrar">
          </div>
        </div>
      </form>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>