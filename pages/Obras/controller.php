<?php
include_once('../../db/connection.php');

$data = array(
  'nome',
  'situacao',
  'website',
  'cliente_id',
  'endereco',
  'cidade_id',
  'estado_id',
  'cep',
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
      $sql = "INSERT INTO obras (nome, situacao, website, cliente_id, endereco, cidade_id, estado_id, cep, observacoes) VALUES ('$nome', '$situacao', '$website', '$cliente_id', '$endereco', '$cidade_id', '$estado_id', '$cep', '$observacoes')";

      $res = $conn->query($sql);

      $redirect_error = "./create.php";
      $success_message = "Obra cadastrada com sucesso!";
      $error_message = "Erro ao tentar cadastrar obra!";
      break;

    case 'editar':
      $sql = "UPDATE obras SET nome = '$nome', situacao = '$situacao', website = '$website', cliente_id = '$cliente_id', endereco = '$endereco', cidade_id = '$cidade_id', estado_id = '$estado_id', cep = '$cep', observacoes = '$observacoes' WHERE  id = $_REQUEST[id]";

      $res = $conn->query($sql);

      $redirect_error = "./update.php?id={$_REQUEST['id']}";
      $success_message = "Obra editada com sucesso!";
      $error_message = "Erro ao tentar editar obra!";
      break;

    case 'deletar':
      if (isset($_REQUEST['id'])) {
        $sql = "DELETE FROM obras WHERE id = $_REQUEST[id]";

        $res = $conn->query($sql);

        $success_message = "Obra deletada com sucesso!";
        $error_message = "Erro ao tentar deletar obra!";
      }
      break;
  }

  if ($res === false) {
    throw new Exception("Erro na consulta SQL: " . $conn->error);
  }

  print "<script>alert('$success_message')</script>";
  print "<script>location.href = '$redirect_success'</script>";
} catch (Exception $e) {
  print "<script>alert('Erro: " . $e->getMessage() . "')</script>";
  print "<script>location.href = '$redirect_error'</script>";
}
