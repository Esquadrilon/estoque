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
        <!-- <?php
        $sql = 
        "SELECT 
          o.nome AS obra,
          e.perfil_codigo as perfil,
          c.nome AS cor,
          e.tamanho,
          SUM(e.quantidade) - COALESCE(SUM(s.quantidade), 0) AS saldo,
          p.peso * (e.tamanho / 1000) * (SUM(e.quantidade) - COALESCE(SUM(s.quantidade), 0)) AS peso
        FROM 
          entradas e
        LEFT JOIN
          saidas s
        ON
          e.obra_id = s.obra_id
          AND e.perfil_codigo = s.perfil_codigo
          AND e.cor_id = s.cor_id
          AND e.tamanho = s.tamanho
        LEFT JOIN
          obras o
        ON
          e.obra_id = o.id
        LEFT JOIN
          cores c
        ON
          e.cor_id = c.id
        LEFT JOIN
          perfis p
        ON
          e.perfil_codigo = p.codigo
        GROUP BY 
          o.nome,
          e.perfil_codigo,
          c.nome,
          e.tamanho";

        $res = $conn->query($sql);

        if ($res->num_rows > 0) {
          $estoques = $res->fetch_all(MYSQLI_ASSOC);

          foreach ($estoques as $estoque) {

            echo '
            <div class="row row-cols-6 rounded mt-2 py-2" style="background-color: rgba(3, 3, 3, 0.3)">
              <div class="col fw-semibold text-center border-end border-1 border-white">' . $estoque['obra'] . '</div>
              <div class="col fw-semibold text-center border-start border-end border-1 border-white">' . $estoque['perfil'] . '</div>
              <div class="col fw-semibold text-center border-start border-end border-1 border-white">' . $estoque['tamanho'] . '</div>
              <div class="col fw-semibold text-center border-start border-end border-1 border-white">' . $estoque['cor'] . '</div>
              <div class="col fw-semibold text-center border-start border-end border-1 border-white">' . $estoque['saldo'] . '</div>
              <div class="col fw-semibold text-center border-start border-1 border-white">' . $estoque['peso'] . '</div>
            </div>';
          };
        } else {
          echo "<p class='alert alert-danger'>Nenhum resultado foi encontrado!</p>";
        }
        ?> -->
    </div>
  </main>
  <footer>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    function filtrar(event) {
      event.preventDefault();
      var div = document.getElementById("Items");
      while (div.firstChild) {
        div.removeChild(div.firstChild);
      }

      var obra = document.getElementById("filtroObra").value;
      var perfil = document.getElementById("filtroPerfil").value;
      var tamanho = document.getElementById("filtroCor").value;
      var cor = document.getElementById("filtroTamanho").value;
      

      fetch(`./listar_estoque.php?estoque=${obra}&perfil=${perfil}&tamanho=${tamanho}&cor=${cor}`)
        .then(response => response.json())
        .then(data => {
          console.log(data);
          // Atualizar as opções do <select> de perfil com os dados obtidos
          data.forEach(row => {
            newRow(row);
          });
        })
        .catch(error => console.error('Erro ao buscar os perfis: ' + error));

    }
    function newRow(data) {
      var newRow = document.createElement("div");
      newRow.className = "row my-2";

      newRow.innerHTML = `
        <div class="row row-cols-6 rounded mt-2 py-2" style="background-color: rgba(3, 3, 3, 0.3)">
          <div class="col fw-semibold text-center border-end border-1 border-white">${data.obra}</div>
          <div class="col fw-semibold text-center border-start border-end border-1 border-white">${data.perfil}</div>
          <div class="col fw-semibold text-center border-start border-end border-1 border-white">${data.tamanho}</div>
          <div class="col fw-semibold text-center border-start border-end border-1 border-white">${data.cor}</div>
          <div class="col fw-semibold text-center border-start border-end border-1 border-white">${data.saldo}</div>
          <div class="col fw-semibold text-center border-start border-1 border-white">${data.peso}</div>
        </div>
      `;

      var container = document.getElementById("Items");
      container.appendChild(newRow);
    }
  </script>
</body>

</html>