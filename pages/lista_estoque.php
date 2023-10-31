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
  SUM(e.total_entrada) - COALESCE(SUM(s.total_saida), 0) - COALESCE(SUM(r.total_reserva), 0) AS saldo,
  ROUND(p.peso * (e.tamanho / 1000) * (SUM(e.total_entrada) - COALESCE(SUM(s.total_saida), 0)), 2) AS peso
FROM 
  obras o
LEFT JOIN (
SELECT
  obra_id,
  perfil_codigo,
  cor_id,
  tamanho,
  COALESCE(SUM(quantidade), 0) AS total_entrada
FROM
  entradas
GROUP BY
  obra_id,
  perfil_codigo,
  cor_id,
  tamanho
) e ON o.id = e.obra_id
LEFT JOIN (
SELECT
  obra_id,
  perfil_codigo,
  cor_id,
  tamanho,
  COALESCE(SUM(quantidade), 0) AS total_saida
FROM
  saidas
GROUP BY
  obra_id,
  perfil_codigo,
  cor_id,
  tamanho
) s ON e.obra_id = s.obra_id
  AND e.perfil_codigo = s.perfil_codigo
  AND e.cor_id = s.cor_id
  AND e.tamanho = s.tamanho
LEFT JOIN (
SELECT
  obra_id,
  perfil_codigo,
  cor_id,
  tamanho,
  COALESCE(SUM(quantidade), 0) AS total_reserva
FROM
  itens_reserva
GROUP BY
  obra_id,
  perfil_codigo,
  cor_id,
  tamanho
) r ON e.obra_id = r.obra_id
  AND e.perfil_codigo = r.perfil_codigo
  AND e.cor_id = r.cor_id
  AND e.tamanho = r.tamanho
LEFT JOIN 
  cores c 
ON e.cor_id = c.id
LEFT JOIN 
  perfis p 
ON e.perfil_codigo = p.codigo
WHERE
  (o.nome LIKE '%$obra%')
  AND (e.perfil_codigo LIKE '%$perfil%')
  AND (e.tamanho LIKE '%$tamanho%')
  AND (c.nome LIKE '%$cor%')
GROUP BY 
  o.nome,
  e.perfil_codigo,
  c.nome,
  e.tamanho
ORDER BY
  o.nome,
  e.tamanho,
  c.nome";

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
