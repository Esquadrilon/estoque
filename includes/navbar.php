<header class="w-100 bg-green">
  <nav class="navbar navbar-expand d-flex justify-content-evenly py-0 my-0">
    <button class="btn fs-3 text-white" id="btn-volta-pagina">
      <i class="bi bi-arrow-left"></i>
    </button>

    <ul class="navbar-nav fs-4 fw-semibold d-flex flex-wrap gap-4">
      <li class="nav-item">
        <a class="nav-link text-white-50" href="\estoque\"><i class="bi bi-house-fill"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white-50" href="\estoque\pages\Entradas\read.php"><i class="bi bi-clipboard2-plus-fill"></i> Entradas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white-50" href="\estoque\pages\Saidas\read.php"><i class="bi bi-clipboard2-minus-fill"></i> Saídas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white-50" href="\estoque\pages\Saidas\read.php"><i class="bi bi-card-checklist"></i> Reservas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white-50" href="\estoque\pages\Obras\read.php"><i class="bi bi-building-fill"></i> Obras</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white-50" href="\estoque\pages\Clientes\read.php"><i class="bi bi-person-fill"></i> Clientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white-50" href="\estoque\pages\Perfis\read.php"><i class="bi bi-code"></i> Perfis</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white-50" href="\estoque\pages\Cores\read.php"><i class="bi bi-palette2"></i> Cores</a>
      </li>
    </ul>

    <button class="btn fs-3 text-white" id="btn-avanca-pagina">
      <i class="bi bi-arrow-right"></i>
    </button>
  </nav>
  <script>
    document.getElementById('btn-volta-pagina').addEventListener('click', function() {
      window.history.back();
    });

    document.getElementById('btn-avanca-pagina').addEventListener('click', function() {
      window.history.forward();
    });
  </script>
</header>