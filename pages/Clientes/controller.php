<?php
include_once('/estoque/db/connection.php');

$data = array(
  'nome',
  'email',
  'telefone',
  'cpf_cnpj',
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
      $sql = "INSERT INTO clientes (nome, email, telefone, cpf_cnpj, endereco, cidade_id, estado_id, cep, observacoes) VALUES ('$nome', '$email', '$telefone', '$cpf_cnpj', '$endereco', '$cidade_id', '$estado_id', '$cep', '$observacoes')";

      $res = $conn->query($sql);

      $redirect_error = "./create.php";
      $success_message = "Cliente cadastrado com sucesso!";
      $error_message = "Erro ao tentar cadastrar cliente!";
      break;

    case 'editar':
      $sql = "UPDATE clientes SET nome = '$nome', email = '$email', telefone = '$telefone', cpf_cnpj = '$cpf_cnpj', endereco = '$endereco', cidade_id = '$cidade_id', estado_id = '$estado_id', cep = '$cep', observacoes = '$observacoes' WHERE  id = $_REQUEST[id]";

      $res = $conn->query($sql);

      $redirect_error = "./update.php?id={$_REQUEST['id']}";
      $success_message = "Cliente editado com sucesso!";
      $error_message = "Erro ao tentar editar cliente!";
      break;

    case 'deletar':
      if (isset($_REQUEST['id'])) {
        $sql = "DELETE FROM clientes WHERE id = $_REQUEST[id]";
        
        $res = $conn->query($sql);

        $success_message = "Cliente deletado com sucesso!";
        $error_message = "Erro ao tentar deletar cliente!";
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
