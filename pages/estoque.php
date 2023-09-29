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

  <title>Lista Cores</title>
</head>

<body>
  <?php
  include_once('../includes/navbar.php');
  include_once('../db/connection.php');
  include_once('../includes/toast.php');
  ?>
  <main class="container-fluid d-flex justify-content-center align-items-center my-3 w-100 flex-column">
    <div>
      <a href="./Entradas/create.php" class="btn btn-success">
        <i class="bi bi-plus"></i> Cadastrar Entrada
      </a>
      <a href="./Saidas/create.php" class="btn btn-danger">
        <i class="bi bi-plus"></i> Cadastrar Saída
      </a>
    </div>

    <div class="w-75 mt-3">
      <form method="POST">
        <div class="row fs-2">
          <div class="col mb-3">
            <label for="filtroObra" class="form-label">Obra</label>
            <input type="text" class="form-control" id="filtroObra" name="filtroObra" placeholder="Nome da Obra">
          </div>
          <div class="col mb-3">
            <label for="filtroPerfil" class="form-label">Perfil</label>
            <input type="text" class="form-control" id="filtroPerfil" name="filtroPerfil" placeholder="Codigo do Perfil">
          </div>
          <div class="col mb-3">
            <label for="filtroCor" class="form-label">Cor</label>
            <input type="text" class="form-control" id="filtroCor" name="filtroCor" placeholder="Nome da Cor">
          </div>
          <div class="col mb-3">
            <label for="filtroTamanho" class="form-label">Tamanho</label>
            <input type="text" class="form-control" id="filtroTamanho" name="filtroTamanho" placeholder="Tamanho">
          </div>
          </div>
          <a class="btn btn-primary" onclick="filtrar(event)">Aplicar Filtros</a>
      </form>
    </div>
    <div class="wrapper w-75 my-4 p-4" id="Items">
        <div class="row row-cols-6">
          <div class="col fs-3 fw-bold text-center border-end border-1 border-white">Obra</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Perfil</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Tamanho</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Cor</div>
          <div class="col fs-3 fw-bold text-center border-start border-end border-1 border-white">Saldo</div>
          <div class="col fs-3 fw-bold text-center border-start border-1 border-white">Peso</div>
        </div>
    </div>
  </main>
  <footer>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    function filtrar(event) {
      event.preventDefault();
      var div = document.getElementById("Items");
      
      while (div.children.length > 1) {
        div.removeChild(div.lastChild);
      }

      var obra = document.getElementById("filtroObra").value;
      var perfil = document.getElementById("filtroPerfil").value;
      var tamanho = document.getElementById("filtroTamanho").value;
      var cor = document.getElementById("filtroCor").value;
      
      var URL = `http://localhost/estoque/pages/lista_estoque.php?obra=${obra}&perfil=${perfil}&tamanho=${tamanho}&cor=${cor}`
      
      fetch(URL)
        .then(response => response.json())
        .then(data => {
          console.log(data);
          data.forEach(row => {
            newRow(row);
          });
        })
        .catch(error => console.error('Erro ao buscar os perfis: ' + error));
    }

    function newRow(data) {
      var row = document.createElement("div");
      row.className = "row row-cols-6 rounded mt-2 py-2";
      row.style.backgroundColor = "rgba(3, 3, 3, 0.3)";

      row.innerHTML = `
        <div class="col fw-semibold text-center border-end border-1 border-white">${data.obra}</div>
        <div class="col fw-semibold text-center border-start border-end border-1 border-white">${data.perfil}</div>
        <div class="col fw-semibold text-center border-start border-end border-1 border-white">${data.tamanho}</div>
        <div class="col fw-semibold text-center border-start border-end border-1 border-white">${data.cor}</div>
        <div class="col fw-semibold text-center border-start border-end border-1 border-white">${data.saldo}</div>
        <div class="col fw-semibold text-center border-start border-1 border-white">${data.peso}</div>
      `;

      var container = document.getElementById("Items");
      container.appendChild(row);
    }
  </script>
</body>

</html>