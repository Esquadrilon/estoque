<?php
include_once('../db/connection.php');

$data = array(
  'obra',
  'perfil',
  'cor',
  'tamanho'
);

foreach ($data as $input_name) {
  isset($_GET[$input_name])
    ? ${$input_name} = $_GET[$input_name]
    : ${$input_name} = "";
};

$sql = 
"SELECT 
  o.nome AS obra,
  e.perfil_codigo as perfil,
  c.nome AS cor,
  e.tamanho,
  SUM(e.quantidade) - COALESCE(SUM(s.quantidade), 0) AS saldo,
  ROUND(p.peso * (e.tamanho / 1000) * (SUM(e.quantidade) - COALESCE(SUM(s.quantidade), 0)), 3) AS peso
FROM 
  entradas e
LEFT JOIN
  saidas s
ON
  e.obra_id = s.obra_id
  AND e.perfil_codigo = s.perfil_codigo
  AND e.cor_id = s.cor_id
  AND e.tamanho = s.tamanho
LEFT JOIN
  obras o
ON
  e.obra_id = o.id
LEFT JOIN
  cores c
ON
  e.cor_id = c.id
LEFT JOIN
  perfis p
ON
  e.perfil_codigo = p.codigo
WHERE
  (o.nome LIKE '%$obra%')
  AND (e.perfil_codigo LIKE '%$perfil%')
  AND (e.tamanho LIKE '%$tamanho%')
  AND (c.nome LIKE '%$cor%')
GROUP BY 
  o.nome,
  e.perfil_codigo,
  c.nome,
  e.tamanho";

$res = $conn->query($sql);

if ($res) {
  $estoques = [];
  while ($row = $res->fetch_assoc()) {
    $item[] = $row;
    $estoques = $item;
  }
  header('Content-Type: application/json');
  echo json_encode($estoques);
} else {
  echo json_encode([]);
}
?>
