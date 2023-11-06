<?php
  include_once('../../db/connection.php');

  $data = [];

  $romaneio = isset($_POST['romaneio']) 
    ? $_POST['romaneio'] 
    : null;
  $observacoes = isset($_POST['observacoes']) 
    ? $_POST['observacoes'] 
    : null;

  $obra = isset($_POST['obra']) 
    ? $_POST['obra'] 
    : [];
  $perfil = isset($_POST['perfil']) 
    ? $_POST['perfil'] 
    : [];
  $tamanho = isset($_POST['tamanho']) 
    ? $_POST['tamanho'] 
    : [];
  $cor = isset($_POST['cor']) 
    ? $_POST['cor'] 
    : [];
  $quantidade = isset($_POST['quantidade']) 
    ? $_POST['quantidade'] : [];

  $redirect_success = "./read.php";
  $redirect_error = "./index.php";
  $success_message = "Reserva cadastrada com sucesso!";
  $error_message = "Erro ao tentar cadastrar reserva!";

  
  try{
    switch ($_REQUEST["acao"]) {
      case 'cadastrar':
        if ($romaneio == null) {
          $error_message = "Você deve informar o romaneio, para poder reservar o material!";
          throw new Exception($error_message);
        }
        // valida e formata os dados... para inserir no banco de dados.
        for ($i = 0; $i < count($perfil); $i++) {
          $sql_obra = $conn->query("SELECT id FROM obras WHERE nome = '$obra[$i]'");
          $res_obra = $sql_obra->fetch_assoc();
          
          $sql_perfil = $conn->query("SELECT codigo FROM perfis WHERE codigo = '$perfil[$i]'");
          $res_perfil = $sql_perfil->fetch_assoc();
          
          $sql_cor = $conn->query("SELECT id FROM cores WHERE nome = '$cor[$i]'");
          $res_cor = $sql_cor->fetch_assoc();

          if($obra[$i] == null || $perfil[$i] == null || $tamanho[$i] == null || $cor[$i] == null){
            $error_message = 'Certifique se os campos necessários estão preenchidos corretamente. Nenhum dado foi cadastrado!';
            throw new Exception($error_message);
          };

          if($sql_obra === false || $sql_perfil === false || $sql_cor === false){
            $error_message = 'Alguns dos dados fornecidos não foram encontrados. Verifique se as informações estão corretas e tente novamente.  Nenhum dado foi cadastrado!';
            throw new Exception($error_message);
          }

          if($quantidade[$i] != null){
            $item = array(
              $res_obra['id'],
              $res_perfil['codigo'],
              $tamanho[$i],
              $res_cor['id'],
              $quantidade[$i]
            );
            echo json_encode($item) . "<br>";
            array_push($data, $item);
          }
        };

        $sql_reserva = "INSERT INTO reservas (id, observacoes) VALUES ('$romaneio', '$observacoes')";
        $conn->query($sql_reserva);

        foreach($data as $registro){
          $sql = 
          "INSERT INTO itens_reserva 
            (reserva_id, obra_id, perfil_codigo, tamanho, cor_id, quantidade)
          VALUES
            ('$romaneio', '$registro[0]',  '$registro[1]',  '$registro[2]',  '$registro[3]',  '$registro[4]')
          ";

          $res = $conn->query($sql);
        }
        break;

        case 'editar':
        
          $success_message = "Entrada editada com sucesso!";
          $error_message = "Erro ao tentar editar entrada!";
          break;
  
        case 'deletar':
          if (isset($_REQUEST['id'])) {
            $conn->query("DELETE FROM itens_reserva WHERE reserva_id = $_REQUEST[id]");
            $res = $conn->query("DELETE FROM reservas WHERE id = $_REQUEST[id]");
            
          }
          $success_message = "Entrada deletada com sucesso!";
          $error_message = "Erro ao tentar deletar entrada!";
          break;
        case 'deletar_item':
          $res = (isset($_REQUEST['id']))
            ? $conn->query("DELETE FROM itens_reserva WHERE id = $_REQUEST[id]")
            : false;
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
  } finally {
    echo "Romaneio: $romaneio <br> Observações: $observacoes <br> Dados: " . json_encode($data);
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