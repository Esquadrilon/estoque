<?php
include_once('../../db/connection.php');

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

switch ($_REQUEST["acao"]) {
  case 'cadastrar':
    $sql = "INSERT INTO clientes (nome, email, telefone, cpf_cnpj, endereco, cidade_id, estado_id, cep, observacoes) VALUES ('{$nome}', '{$email}', '{$telefone}', '{$cpf_cnpj}', '{$endereco}', '{$cidade_id}', '{$estado_id}', '{$cep}', '{$observacoes}')";
    $res = $conn->query($sql);
    $redirect_success = "./read.php";
    $redirect_error = "./create.php";
    $success_message = "Cliente cadastrado com sucesso!";
    $error_message = "Erro ao tentar cadastrar cliente!";
    break;

  case 'editar':
    $sql = "UPDATE cliente SET 
      nome = '{$nome}',
      email = '{$email}',
      telefone = '{$telefone}',
      cpf_cnpj = '{$cpf_cnpj}',
      endereco = '{$endereco}',
      cidade_id = '{$cidade_id}',
      estado_id = '{$estado_id}',
      cep = '{$cep}',
      observacoes = '{$observacoes}'
    WHERE 
    id = $_REQUEST[id]";

    $res = $conn->query($sql);

    $redirect_success = "./read.php";
    $redirect_error = "./edit.php?id=$id";
    $success_message = "Cliente editado com sucesso!";
    $error_message = "Erro ao tentar editar cliente!";
    break;

  case 'deletar':
    if (isset($_REQUEST['id'])) {
      $id = $_REQUEST['id'];
      $sql = "DELETE FROM clientes WHERE id = $id";
      $redirect_success = "./read.php";
      $success_message = "Cliente deletado com sucesso!";
    }
    break;
}
if ($res == true) {
  print "<script>alert('$success_message')</script>";
  print "<script>location.href = '$redirect_success'</script>";
} else {
  print "<script>alert('$error_message')</script>";
  print "<script>location.href = '$redirect_error'</script>";
}
