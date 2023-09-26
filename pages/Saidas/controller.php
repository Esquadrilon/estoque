<?php
$data = array(
    'obra_id',
    'cor_id',
    'origem',
    'destino',
    'nota',
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

$items = array();

$perfil = $_POST['perfil'];
$tamanho = $_POST['tamanho'];
$cor_perfil = $_POST['cor_perfil'];
$quantidade = $_POST['quantidade'];

$numItems = count($perfil);

for ($i = 0; $i < $numItems; $i++) {
$item = array(
    'perfil' => $perfil[$i],
    'tamanho' => $tamanho[$i],
    'cor' => $cor_perfil[$i],
    'quantidade' => $quantidade[$i]
);

// Adicione o item ao array de items
$items[] = $item;
print_r($item);
print "<br> ";
}

echo "<h2>Valores Recebidos:</h2>";
echo "<p>Obra ID: $obra_id</p>";
echo "<p>Cor ID: $cor_id</p>";
echo "<p>Origem: $origem</p>";
echo "<p>Destino: $destino</p>";
echo "<p>Nota Fiscal: $nota</p>";
echo "<p>Responsável: $responsavel</p>";
echo "<p>Placa do Caminhão: $caminhao</p>";
echo "<p>Motorista: $motorista</p>";
echo "<p>Observações: $observacoes</p>";
?>
