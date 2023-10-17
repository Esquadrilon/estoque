<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/estoque/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/estoque/node_modules/bootstrap-icons/font/bootstrap-icons.css">
  <script src="/estoque/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="shortcut icon" href="/estoque/img/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="/estoque/css/estilo.css">

  <title>Bootstrap Example</title>
</head>

<body>
    <?php
    include_once('./db/connection.php');
    ?>
    <main class="container d-flex justify-content-center align-items-center my-5">
        <div class="wrapper p-4 my-1 w-100 fs-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                Modal
            </button>
        </div>
    </main>
    
    <div class="modal fade" id="modal" tabindex="-1">
      <div class="modal-dialog modal-fullscreen h-100">
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">CHR026</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="h-100">
              <div class="h-50 overflow-auto bg-green rounded p-2">
                <h2 class="text-center">Entradas</h2>
                <div class="row d-flex justify-content-center align-items-center p-1 rounded w-100">
                  <div class="col fs-4 fw-bold">Obra</div>
                  <div class="col fs-4 fw-bold">Perfil</div>
                  <div class="col fs-4 fw-bold">Tamanho</div>
                  <div class="col fs-4 fw-bold">Cor</div>
                  <div class="col fs-4 fw-bold">Quantidade</div>
                  <div class="col fs-4 fw-bold">Data</div>
                  <div class="col-2 fs-4 fw-bold">Origem</div>
                  <div class="col fs-4 fw-bold">Nota</div>
                  <div class="col fs-4 fw-bold"></div>
                </div>
                  <?php
                  $sql = 
                  "SELECT 
                    e.id,
                    o.nome as obra,
                    e.perfil_codigo as perfil,
                    e.tamanho,
                    c.nome as cor,
                    e.origem,
                    e.quantidade,
                    e.nota,
                    e.criado 
                  from 
                    entradas e
                  left join
                    obras o 
                  on
                  e.obra_id = o.id
                  left join
                    cores c 
                  on
                  e.cor_id  = c.id
                  WHERE 
                  e.perfil_codigo like '%chr026%'
                  AND (c.nome like '%epris%')
                  AND (o.nome like '%essence%') ";

                  $res = $conn->query($sql);

                  if ($res->num_rows > 0) {
                    $entradas = $res->fetch_all(MYSQLI_ASSOC);

                    foreach ($entradas as $entrada) {

                      echo '
                      <div class="row row-cols-8 mt-2 d-flex justify-content-center align-items-center p-1 rounded w-100">
                        <div class="col fw-semibold"> ' . $entrada['obra'] . ' </div>
                        <div class="col fw-semibold"> ' . $entrada['perfil'] . ' </div>
                        <div class="col fw-semibold"> ' . $entrada['tamanho'] . ' </div>
                        <div class="col fw-semibold"> ' . $entrada['cor'] . ' </div>
                        <div class="col fw-semibold"> ' . $entrada['quantidade'] . ' </div>
                        <div class="col fw-semibold"> ' . date("d/m/Y", strtotime($entrada['criado'])) . ' </div>
                        <div class="col-2 fw-semibold"> ' . $entrada['origem'] . ' </div>
                        <div class="col fw-semibold"> ' . $entrada['nota'] . ' </div>
                        <div class="col fw-semibold d-flex justify-content-center align-items-center">
                          <a href="./update.php?id=' . $entrada['id'] . '" class="btn btn-primary">
                            <i class="bi bi-eye"></i>
                          </a>
                        </div>
                      </div>';
                    };
                  } else {
                    echo "<p class='alert alert-danger'>Nenhum resultado foi encontrado!</p>";
                  }
                  ?>
              </div>
              <div class="mt-3 h-50 overflow-auto bg-green rounded p-2">
                <h2 class="text-center">Saídas</h2>
                <div class="row d-flex justify-content-center align-items-center p-1 rounded w-100">
                  <div class="col fs-4 fw-bold">Obra</div>
                  <div class="col fs-4 fw-bold">Perfil</div>
                  <div class="col fs-4 fw-bold">Tamanho</div>
                  <div class="col fs-4 fw-bold">Cor</div>
                  <div class="col fs-4 fw-bold">Quantidade</div>
                  <div class="col fs-4 fw-bold">Data</div>
                  <div class="col-2 fs-4 fw-bold">Destino</div>
                  <div class="col fs-4 fw-bold">Romaneio</div>
                  <div class="col fs-4 fw-bold"></div>
                </div>
                <?php
                $sql = 
                "SELECT 
                  s.id,
                  o.nome as obra,
                  s.perfil_codigo as perfil,
                  s.tamanho,
                  c.nome as cor,
                  s.destino,
                  s.quantidade,
                  s.romaneio,
                  s.criado
                from 
                  saidas s
                left join
                  obras o 
                on
                s.obra_id = o.id
                left join
                  cores c 
                on
                s.cor_id  = c.id
                WHERE 
                s.perfil_codigo like '%chr026%'
                AND (c.nome like '%epris%')
                AND (o.nome like '%essence%') ";

                $res = $conn->query($sql);

                if ($res->num_rows > 0) {
                  $saidas = $res->fetch_all(MYSQLI_ASSOC);
                  
                  foreach ($saidas as $saida) {
                    echo '
                    <div class="row mt-2 d-flex justify-content-center align-items-center p-1 rounded w-100">
                      <div class="col fw-semibold"> ' . $saida['obra'] . '</div>
                      <div class="col fw-semibold"> ' . $saida['perfil'] . ' </div>
                      <div class="col fw-semibold"> ' . $saida['tamanho'] . ' </div>
                      <div class="col fw-semibold"> ' . $saida['cor'] . ' </div>
                      <div class="col fw-semibold"> ' . $saida['quantidade'] . ' </div>
                      <div class="col fw-semibold"> ' . date("d/m/Y", strtotime($saida['criado'])) . ' </div>
                      <div class="col-2 fw-semibold"> ' . $saida['destino'] . ' </div>
                      <div class="col fw-semibold"> ' . $saida['romaneio'] . ' </div>
                      <div class="col fw-semibold d-flex justify-content-center align-items-center">
                        <a href="./update.php?id=' . $saida['id'] . '" class="btn btn-primary">
                          <i class="bi bi-eye"></i>
                        </a>
                      </div>
                    </div>';
                  };
                } else {
                  echo "<p class='alert alert-danger'>Nenhum resultado foi encontrado!</p>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>