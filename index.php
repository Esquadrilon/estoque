<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/estoque/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/estoque/node_modules/bootstrap-icons/font/bootstrap-icons.css">

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
      <a href="./pages/Entradas/create.php" class="btn btn-success mx-3 text-white fw-bold">
        <i class="bi bi-clipboard2-plus-fill"></i> Cadastrar Entrada
      </a>
      <a href="./pages/Reservas/" class="btn btn-info mx-3 text-white fw-bold">
        <i class="bi bi-card-checklist"></i> Reservar Lista
      </a>
      <a href="./pages/Saidas/create.php" class="btn btn-danger mx-3 text-white fw-bold">
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
    <div class="d-none" id="Items">
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
    <div class="modal fade" id="modal">
      <div class="modal-dialog">
        <div class="modal-content text-dark">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal_label">Erro</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="d-flex justify-content-center align-items-center" id="modal_content">
              <p class='alert alert-danger'>Ainda não esta pronto essa funcionalidade</p>
            </div>
          </div>
        </div>
      </div>
    </div>
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
      div.className = " wrapper w-75 my-4 px-4 py-2";
      
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
      row.className = "row fw-semibold d-flex justify-content-center align-items-center mt-2 py-2 rounded";
      row.style.backgroundColor = "rgba(3, 3, 3, 0.3)";

      row.innerHTML = `
        <div class="col">${data.obra}</div>
        <div class="col">${data.perfil}</div>
        <div class="col">${data.tamanho}</div>
        <div class="col">${data.cor}</div>
        <div class="col">${data.saldo}</div>
        <div class="col">${data.peso} Kg</div>
        <div class="col-1">
          <a href="detalhes.php?obra=${data.obra}&perfil=${data.perfil}&tamanho=${data.tamanho}&cor=${data.cor}" class="btn btn-primary">
            <i class="bi bi-eye-fill"></i>
          </a>
          <button type="button" class="btn btn-secondary" data-bs-toggle="modal" onclick="updateModal('${data.perfil}')" data-bs-target="#modal">
            <i class="bi bi-camera-fill"></i>
          </button>
        </div>
      `;
      
      let container = document.getElementById("Items");
      container.appendChild(row);
    }

    function updateModal(perfil) {
      document.getElementById('modal_label').innerHTML = perfil.toString();
      let modal_content = document.getElementById('modal_content');

      let img = document.createElement('img')
      img.className = 'card-img-top w-50 h-50';
      img.src = `http://192.168.0.111:3001/_next/image?url=%2Fapi%2FprofileImage%2F${perfil}.bmp&w=128&q=100`;
      img.alt = `Imagem do perfil ${perfil}`;

      while (modal_content.children.length > 0) {
        modal_content.removeChild(modal_content.lastChild);
      }

      modal_content.appendChild(img);
    }
  </script>
</body>

</html>