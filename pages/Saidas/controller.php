<?php
include_once('../../db/connection.php');

$data = array(
    'obra_id',
    'origem',
    'destino',
    'romaneio',
    'responsavel',
    'caminhao',
    'motorista',
    'observacoes'
);

foreach ($data as $input_name) {
    isset($_POST[$input_name])
        ? ${$input_name} = $_POST[$input_name]
        : ${$input_name} = "";
};
  
$redirect_success = "./read.php";
$redirect_error = "./read.php";

try {
  switch ($_REQUEST["acao"]) {
    case 'cadastrar':

        $perfil = $_POST['perfil'];
        $tamanho = $_POST['tamanho'];
        $cor = $_POST['cor_id'];
        $quantidade = $_POST['quantidade'];

        for ($i = 0; $i < count($perfil); $i++) {
            $item = array(
                'perfil' => $perfil[$i],
                'tamanho' => $tamanho[$i],
                'cor' => $cor[$i],
                'quantidade' => $quantidade[$i]
            );
            print_r($item);
            $sql = 
            "INSERT INTO saidas 
                (obra_id, perfil_codigo, cor_id, tamanho, quantidade, romaneio, origem, destino, caminhao, motorista, responsavel, observacoes)
            VALUES
                ('$obra_id', '{$perfil[$i]}', '{$cor[$i]}', '{$tamanho[$i]}', '{$quantidade[$i]}', '$romaneio', '$origem', '$destino', '$caminhao', '$motorista', '$responsavel', '$observacoes')";
            $res = $conn->query($sql);
        }

        $success_message = "Saída cadastrada com sucesso!";
        $error_message = "Erro ao tentar cadastrar saída!";
        break;

    case 'editar':
        $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : null;
        $tamanho = isset($_POST['tamanho']) ? $_POST['tamanho'] : 6000;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : null;
        $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : null;

        $sql = 
            "UPDATE saidas 
            SET 
                obra_id = '$obra_id',
                perfil_codigo = '$perfil',
                tamanho = '$tamanho',
                cor = '$cor',
                quantidade = '$quantidade',
                origem = '$origem',
                destino = '$destino',
                romaneio = '$romaneio',
                responsavel = '$responsavel',
                caminhao = '$caminhao',
                motorista = '$motorista',
                observacoes = '$observacoes'
            WHERE id = $_REQUEST[id]
            ";

        if ($perfil != null && $cor != null){
           $res = $conn->query($sql); 
        }

        $redirect_error = "./update.php?id={$_REQUEST['id']}";
        $success_message = "Entrada editada com sucesso!";
        $error_message = "Erro ao tentar editar entrada!";
        break;

    case 'deletar':
        if (isset($_REQUEST['id'])) {
            $res = $conn->query("DELETE FROM saidas WHERE id = $_REQUEST[id]");
            
            $success_message = "Saída deletada com sucesso!";
            $error_message = "Erro ao tentar deletar saída!";
        }
        break;
  }

  $res === true
    ? print "<script>location.href = '$redirect_success?success_message=$success_message'</script>"
    : throw new Exception("Erro na consulta SQL: " . $conn->error);
    
} catch (Exception $e) {
  print "<script>alert('Erro: " . $e->getMessage() . "')</script>";
  print "<script>location.href = '$redirect_error?error_message=$error_message'</script>";
}
?>
