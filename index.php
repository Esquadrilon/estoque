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

  <title>Estoque</title>
</head>

<body>
  <?php
  include_once('./includes/navbar.php');
  include_once('./db/connection.php');
  include_once('./includes/toast.php');
  ?>
  <main class="container-fluid d-flex justify-content-center align-items-center my-3 w-100 flex-column">
    <div>
      <a href="./pages/Entradas/create.php" class="btn btn-success mx-3 text-white fs-6 fw-bold">
        <i class="bi bi-clipboard2-plus-fill"></i> Cadastrar Entrada
      </a>
      <a href="./pages/Listas/" class="btn btn-info mx-3 text-white fs-6 fw-bold">
        <i class="bi bi-card-checklist"></i> Buscar Lista
      </a>
      <a href="./pages/Saidas/create.php" class="btn btn-danger mx-3 text-white fs-6 fw-bold">
        <i class="bi bi-clipboard2-minus-fill"></i> Cadastrar Saída
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
            <label for="filtroTamanho" class="form-label">Tamanho</label>
            <input type="text" class="form-control" id="filtroTamanho" name="filtroTamanho" placeholder="Tamanho">
          </div>
          <div class="col mb-3">
            <label for="filtroCor" class="form-label">Cor</label>
            <input type="text" class="form-control" id="filtroCor" name="filtroCor" placeholder="Nome da Cor">
          </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col">
            <a class="btn btn-primary" onclick="filtrar(event)">
              <i class="bi bi-filter"></i>
              Aplicar Filtros
            </a>
          </div>
          <div class="col">
            <p class="fs-4 d-flex justify-content-end align-items-center">
              Peso Total: <span id="pesoTotal">0</span>
            </p>
          </div>
        </div>
        
      </form>
    </div>
    <div class="wrapper w-75 my-4 p-4" id="Items">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col fs-3 fw-bold">Obra</div>
          <div class="col fs-3 fw-bold">Perfil</div>
          <div class="col fs-3 fw-bold">Tamanho</div>
          <div class="col fs-3 fw-bold">Cor</div>
          <div class="col fs-3 fw-bold">Saldo</div>
          <div class="col fs-3 fw-bold">Peso</div>
          <div class="col-1 fs-3 fw-bold"></div>
        </div>
    </div>
  </main>
  <footer>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    document.querySelector("form").addEventListener("keydown", function (event) {
      event.keyCode === 13
      ?filtrar(event)
      : null;
      
    });
    
    function filtrar(event) {
      event.preventDefault();
      let div = document.getElementById("Items");
      
      while (div.children.length > 1) {
        div.removeChild(div.lastChild);
      }
      
      let obra = document.getElementById("filtroObra").value;
      let perfil = document.getElementById("filtroPerfil").value;
      let tamanho = document.getElementById("filtroTamanho").value;
      let cor = document.getElementById("filtroCor").value;
      let pesoTotal = 0;
      let erros = [];
    
      let URL = `/estoque/pages/lista_estoque.php?obra=${obra}&perfil=${perfil}&tamanho=${tamanho}&cor=${cor}`
    
      fetch(URL)
        .then(response => response.json())
        .then(data => {
          console.log(data);
          data.forEach(row => {
            if(row.saldo != 0){
              newRow(row);
              pesoTotal = pesoTotal + parseFloat(row.peso);
            }
            if(row.saldo < 0){
              erros.push(row);
            }
          });

          console.log('Peso Total: ',pesoTotal.toFixed(2))
          document.getElementById('pesoTotal').innerHTML = pesoTotal.toFixed(2);
        })
        .catch(error => console.error('Erro ao buscar os perfis: ' + error));
        
        console.log("Saldos menores que zero: ", erros);
    }

    function newRow(data) {
      let row = document.createElement("div");
      row.className = "row rounded mt-2 py-2 d-flex justify-content-center align-items-center";
      row.style.backgroundColor = "rgba(3, 3, 3, 0.3)";

      row.innerHTML = `
        <div class="col fw-semibold">${data.obra}</div>
        <div class="col fw-semibold">${data.perfil}</div>
        <div class="col fw-semibold">${data.tamanho}</div>
        <div class="col fw-semibold">${data.cor}</div>
        <div class="col fw-semibold">${data.saldo}</div>
        <div class="col fw-semibold">${data.peso}</div>
        <div class="col-1 fw-semibold">
          <a href="detalhes.php?obra=${data.obra}&perfil=${data.perfil}&tamanho=${data.tamanho}&cor=${data.cor}" class="btn btn-primary">
            <i class="bi bi-eye-fill"></i>
          </a>
        </div>
      `;

      let container = document.getElementById("Items");
      container.appendChild(row);
    }
  </script>
</body>

</html>