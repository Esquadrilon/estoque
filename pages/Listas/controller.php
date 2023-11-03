<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/estoque/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/estoque/node_modules/bootstrap-icons/font/bootstrap-icons.css">

  <link rel="stylesheet" href="/estoque/css/estilo.css">

  <title>Cadastrando Reserva</title>
</head>

<body>
  <?php
    include_once('../../includes/navbar.php');
    include_once('../../db/connection.php');
    include_once('../../includes/toast.php');

    $obra = isset($_POST['obra']) ? $perfil = $_POST['obra'] : [];
    $perfil = isset($_POST['perfil']) ? $perfil = $_POST['perfil'] : [];
    $tamanho = isset($_POST['tamanho']) ? $_POST['tamanho'] : [];
    $cor = isset($_POST['cor']) ? $_POST['cor'] : [];
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : [];
  ?>
  <main class="container-fluid d-flex justify-content-center align-items-center my-3">
    <div class="wrapper p-3 my-1 w-25 fs-4">
      <h1 class="text-center fs-1">Reservando...</h1>
      <form action="#" method="post" id="form">
        <div class="row mt-2">
          <div class="col">
            <label for="romaneio">Romaneio</label>
            <input type="text" name="romaneio" id="romaneio" class="form-control" placeholder="Erick" required>
          </div>
        </div>

        <div class="col mt-2">
          <label for="observacoes">Observações</label>
          <textarea class="form-control" name="observacoes" id="observacoes" cols="50" rows="3" placeholder="Se necessário"></textarea>
        </div>

        <div class="d-flex justify-content-end mt-4">
          <button type="submit" class="btn btn-primary text-white w-50 fs-5 fw-bold">
            <i class="bi bi-box-seam"></i> Reservar 
          </button>
        </div>
      </form>
    </div>
  </main>
  <footer>
  </footer>
</body>

</html>
<?php
  $redirect_success = "./index.php";
  $redirect_error = "./index.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $romaneio = isset($_POST['romaneio']) ? $perfil = $_POST['romaneio'] : 42224;
    $observacoes = '';
    if($romaneio != null){
      include_once('../../db/connection.php');

      echo "Romaneio: $romaneio <br> Observações: $observacoes";

      try{
        $data = [];

        $success_message = "Reserva cadastrada com sucesso!";
        $error_message = "Erro ao tentar cadastrar reserva!";

        for ($i = 0; $i < count($perfil); $i++) {
          $sql_obra = "SELECT id FROM obras WHERE nome = '$obra[$i]'";
          $res_obra = $conn->query($sql_obra);
          
          $sql_perfil = "SELECT codigo FROM perfis WHERE codigo = '$perfil[$i]'";
          $res_perfil = $conn->query($sql_perfil);
          
          $sql_cor = "SELECT id FROM cores WHERE nome = '$cor[$i]'";
          $res_cor = $conn->query($sql_cor);
          
          if($obra[$i] == null && $perfil[$i] == null && $tamanho[$i] == null && $cor[$i] == null){
            $error_message = 'Certifique se os campos necessários estão preenchidos corretamente!';
            throw new Exception($error_message);
          };

          $item = array(
            $res_obra,
            $res_perfil,
            $tamanho[$i],
            $res_cor,
            $quantidade[$i]
          );
          echo json_encode($item);
          array_push($data, $item);
        };
        

        // $sql_reserva = "INSERT INTO reservas (id, observacoes) VALUES ('$romaneio', '$observacoes')";
        // $conn->query($sql_reserva);


        // for ($i = 0; $i < count($perfil); $i++) {
          

        //   $sql_item_reserva = 
        //   "INSERT INTO itens_reserva 
        //     (reserva_id, obra_id, perfil_codigo, tamanho, cor_id, quantidade)
        //   VALUES
        //     ('$romaneio',)";
        // }

        // $res === true
        // ? print "<script>location.href = '$redirect_success?success_message=$success_message'</script>"
        // : throw new Exception("Erro na consulta SQL: " . $conn->error);
        
      } catch (Exception $e) {
        print "<script>alert('Erro: " . $e->getMessage() . "')</script>";
        print "<script>location.href = '$redirect_error?error_message=$error_message '</script>";
      } finally {
        echo 'dados';
        echo json_encode($data);
      }
    }
  }
?>

<!-- <?php  
  

  try {
    switch ($_REQUEST["acao"]) {
      case 'cadastrar':
        
        
        for ($i = 0; $i < count($perfil); $i++) {
          if($perfil[$i] != null && $tamanho[$i] != null && $cor[$i] != null && $quantidade[$i] != null){
            $sql = 
            "INSERT INTO entradas 
              (obra_id, perfil_codigo, cor_id, tamanho, quantidade, nota, origem, destino, caminhao, motorista, responsavel, observacoes)
            VALUES
              ('$obra_id', '{$perfil[$i]}', '{$cor[$i]}', '{$tamanho[$i]}', '{$quantidade[$i]}', '$nota', '$origem', '$destino', '$caminhao', '$motorista', '$responsavel', '$observacoes')";

            $res = $conn->query($sql);
          }
        };

        $success_message = "Entrada cadastrada com sucesso!";
        $error_message = "Erro ao tentar cadastrar entrada!";
        break;

      case 'editar':
        
        $success_message = "Entrada editada com sucesso!";
        $error_message = "Erro ao tentar editar entrada!";
        break;

      case 'deletar':
        if (isset($_REQUEST['id'])) {
          $res = $conn->query("DELETE FROM entradas WHERE id = $_REQUEST[id]");
          
        }
        $success_message = "Entrada deletada com sucesso!";
        $error_message = "Erro ao tentar deletar entrada!";
        break;
    }

  $res === true
    ? print "<script>location.href = '$redirect_success?success_message=$success_message'</script>"
    : throw new Exception("Erro na consulta SQL: " . $conn->error);
    
  } catch (Exception $e) {
    print "<script>alert('Erro: " . $e->getMessage() . "')</script>";
    print "<script>location.href = '$redirect_error?error_message=$error_message '</script>";
  }
?> -->