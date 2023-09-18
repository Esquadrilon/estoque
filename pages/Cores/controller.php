<?php
include_once('../../db/connection.php');

$data = array(
  'nome',
  'codigo'
);

foreach ($data as $input_name) {
  isset($_POST[$input_name])
    ? ${$input_name} = $_POST[$input_name]
    : ${$input_name} = "";
};

try {
  switch ($_REQUEST["acao"]) {
    case 'cadastrar':
      $sql = "INSERT INTO cores (nome, codigo) VALUES ('$nome', '$codigo')";
      $res = $conn->query($sql);
      $redirect_success = "./read.php";
      $redirect_error = "./create.php";
      $success_message = "Cor cadastrada com sucesso!";
      $error_message = "Erro ao tentar cadastrar cor!";
      break;

    case 'editar':
      $sql = "UPDATE cores SET nome = '$nome', codigo = '$codigo' WHERE id = $_REQUEST[id]";

      $res = $conn->query($sql);

      $redirect_success = "./read.php";
      $redirect_error = "./edit.php?id={$_REQUEST['id']}";
      $success_message = "Cor editada com sucesso!";
      $error_message = "Erro ao tentar editar cor!";
      break;

    case 'deletar':
      if (isset($_REQUEST['id'])) {
        $sql = "DELETE FROM cores WHERE id = $_REQUEST[id]";
        $res = $conn->query($sql);
        $redirect_success = "./read.php";
        $redirect_error =  "./read.php";
        $success_message = "Cor deletada com sucesso!";
        $error_message = "Erro ao tentar deletar cor!";
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
