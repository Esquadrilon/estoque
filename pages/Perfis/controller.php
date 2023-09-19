<?php
include_once('../../db/connection.php');

$data = array(
  'codigo',
  'descricao',
  'peso',
  'nativo',
  'linha',
  'referencia',
);

foreach ($data as $input_name) {
  isset($_POST[$input_name])
    ? ${$input_name} = $_POST[$input_name]
    : ${$input_name} = "";
};

try {
  switch ($_REQUEST["acao"]) {
    case 'cadastrar':
      $sql = "INSERT INTO clientes (codigo, descricao, peso, nativo, linha, referencia) VALUES ('$codigo', '$descricao', '$peso', '$nativo', '$linha', '$referencia')";
      $res = $conn->query($sql);
      $redirect_success = "./read.php";
      $redirect_error = "./create.php";
      $success_message = "Cliente cadastrado com sucesso!";
      $error_message = "Erro ao tentar cadastrar cliente!";
      break;

    case 'editar':
      $sql = "UPDATE clientes SET codigo = '$codigo', descricao = '$descricao', peso = '$peso', nativo = '$nativo', linha = '$linha', referencia = '$referencia'
      WHERE 
      id = $_REQUEST[id]";

      $res = $conn->query($sql);

      $redirect_success = "./read.php";
      $redirect_error = "./edit.php?codigo={$_REQUEST['codigo']}";
      $success_message = "Cliente editado com sucesso!";
      $error_message = "Erro ao tentar editar cliente!";
      break;

    case 'deletar':
      if (isset($_REQUEST['codigo'])) {
        $sql = "DELETE FROM clientes WHERE codigo = $_REQUEST[codigo]";
        $res = $conn->query($sql);
        $redirect_success = "./read.php";
        $redirect_error =  "./read.php";
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
