<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/estoque/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/estoque/node_modules/bootstrap-icons/font/bootstrap-icons.css">

  <link rel="stylesheet" href="/estoque/css/estilo.css">

  <title>Lista</title>
</head>

<body>
  <?php
  include_once('../../includes/navbar.php');
  include_once('../../db/connection.php');
  include_once('../../includes/toast.php');

  $data = isset($_POST['perfil']) ? $data = $_POST['perfil'] : [];
  $perfis = [];
  foreach($data as $perfil){
    if($perfil != null) array_push($perfis,$perfil);
  }
  ?>
  <main class="container my-3 w-75">
    <div class="mt-4" id="lista">
    </div>
    <div class="d-flex justify-content-end mt-4">
      <button type="button" class="btn btn-primary text-white w-25 fs-5 fw-bold" onclick="listar(event)">
        <i class="bi bi-card-list"></i> Exibir 
      </button>
    </div>
  </main>
  <footer>

  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    let wrapper = document.createElement('div');
    wrapper.className = "wrapper px-4 py-3";

    let perfis = <?php echo json_encode($perfis); ?>;
    perfils = perfis.sort();
    
    let pesquisas = [];

    // parte 1.1
    perfis.forEach(function(perfil) {
      let div = document.createElement('div');
      div.className = "mb-4 mx-auto";
      div.id = perfil;

      let titulo = document.createElement('h3');
      titulo.innerHTML = perfil;

      wrapper.innerHTML = `
        <div class="row d-flex justify-content-center align-items-center p-1 border-bottom border-2 border-white">
          <div class="col fs-3 fw-bold">Obra</div>
          <div class="col fs-3 fw-bold">Tamanho</div>
          <div class="col fs-3 fw-bold">Cor</div>
          <div class="col fs-3 fw-bold">Saldo</div>
          <div class="col-1 fs-3 fw-bold"></div>
        </div>
      `;

      let URL = `/estoque/pages/lista_estoque.php?perfil=${perfil}`;
      
      fetch(URL)
        .then(response => response.json())
        .then(data => {
          pesquisas.push(data);
          data.forEach(row => {
            if(row.saldo > 0 && row.perfil == perfil) {
              createRow(row, wrapper);
            }
          });
        })
        .catch(error => console.error('Erro ao buscar os perfis: ' + error));
        
      div.appendChild(titulo);
      div.appendChild(wrapper);
      document.querySelector('#lista').appendChild(div);
    })
    console.log("Pesquisas", pesquisas)

    // parte 1.2
    function createRow(data, wrapper) {
      let row = document.createElement("div");
      row.className = "row rounded mt-2 py-2 d-flex justify-content-center align-items-center";
      row.style.backgroundColor = "rgba(3, 3, 3, 0.25)";

      row.innerHTML = `
        <div class="col fw-semibold">${data.obra}</div>
        <div class="col fw-semibold">${data.tamanho}</div>
        <div class="col fw-semibold">${data.cor}</div>
        <div class="col fw-semibold">${data.saldo}</div>
        <div class="col-1 form-check form-switch">
          <input 
            type="checkbox" 
            id="${data.obra.replace(/ /g, "-")}_${data.perfil}_${data.tamanho}_${data.cor.replace(/ /g, "-")}"
            class="form-check-input" 
            role="switch" 
            value="${data.obra},${data.perfil},${data.tamanho},${data.cor},${data.saldo}">
        </div>
      `;

      wrapper.appendChild(row);
    }

    // parte 2
    function listar(e){
      e.preventDefault()
      
      let data = document.querySelectorAll("input[type=checkbox]:checked");
      let itens = [];
      for(let i=0; i<data.length; i++){
        item = data[i].value.split(",")
        
        itens.push(item);
      }
      console.log(itens)

      let main = document.querySelector("main");
      while (main.children.length >= 1) {
        main.removeChild(main.lastChild);
      }

      let form = document.createElement('form');
      form.action = './controller.php';
      form.method = "POST";

      wrapper.innerHTML = `
        <div class="row fs-3 fw-bold d-flex justify-content-center align-items-center p-1 border-bottom border-2 border-white">
          <div class="col">Obra</div>
          <div class="col">Perfil</div>
          <div class="col">Tamanho</div>
          <div class="col">Cor</div>
          <div class="col">Saldo</div>
          <div class="col">Separar</div>
        </div>
      `;
      
      itens.forEach(function (data) {
        let div = document.createElement('div');
        div.className = "row d-flex justify-content-center align-items-center rounded mt-2 py-2";
        div.style.backgroundColor = "rgba(3, 3, 3, 0.3)";
  
        div.innerHTML = `
          <div class="col">
            <input type="text" class="form-control p-1 fs-5 fw-semibold text-white shadow-none bg-transparent border-0" name="obra[]" value="${data[0]}" disabled readonly>
          </div>

          <div class="col">
            <input type="text" class="form-control p-1 fs-5 fw-semibold text-white shadow-none bg-transparent border-0" name="perfil[]" value="${data[1]}" disabled readonly>
          </div>

          <div class="col">
            <input type="text" class="form-control p-1 fs-5 fw-semibold text-white shadow-none bg-transparent border-0" name="tamanho[]" value="${data[2]}" disabled readonly>
          </div>

          <div class="col">
            <input type="text" class="form-control p-1 fs-5 fw-semibold text-white shadow-none bg-transparent border-0" name="cor[]" value="${data[3]}" disabled readonly>
          </div>

          <div class="col fs-5 fw-semibold">${data[4]}</div>

          <div class="col">
            <input type="number" class="form-control fs-5 fw-semibold w-75" name="quantidade" max="${parseInt(data[4])}" min="1" placeholder="1" onfocus="newRow()">
          </div>`;
  
        form.appendChild(div);
      })
      let btn = document.createElement('div');
      btn.className = "d-flex justify-content-end mt-4";
      btn.innerHTML = `
        <button type="submit" class="btn btn-primary text-white w-25 fs-5 fw-bold">
          <i class="bi bi-box-seam"></i> Reservar 
        </button>
      `;
      form.appendChild(btn);
      wrapper.appendChild(form);
      main.appendChild(wrapper);
    }
  </script>
</body>

</html>