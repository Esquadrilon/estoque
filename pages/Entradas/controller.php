<?php
if ($_REQUEST["acao"] == "cadastrar") {
    // Receba os valores dos campos gerais
    $acao = $_POST["acao"];
    $obra_id = $_POST["obra_id"];
    $cor_id = $_POST["cor_id"];
    $origem = $_POST["origem"];
    $destino = $_POST["destino"];
    $nota = $_POST["nota"];
    $responsavel = $_POST["responsavel"];
    $caminhao = $_POST["caminhao"];
    $motorista = $_POST["motorista"];
    $observacoes = $_POST["observacoes"];

    // Processamento dos campos dos itens
    $itens = array();

    if (isset($_POST["itens"]) && is_array($_POST["itens"])) {
        foreach ($_POST["itens"] as $item) {
            $perfil = $item["perfil"];
            $tamanho = $item["tamanho"];
            $cor_id_item = $item["cor_id"];
            $quantidade = $item["quantidade"];

            $itens[] = array(
                "perfil" => $perfil,
                "tamanho" => $tamanho,
                "cor_id" => $cor_id_item,
                "quantidade" => $quantidade
            );
        }
    }

    // Agora você pode processar os valores recebidos conforme necessário, como inseri-los em um banco de dados ou realizar outras ações.

    // Exemplo de saída para depuração:
    echo "<h2>Valores Recebidos:</h2>";
    echo "<p>Ação: $acao</p>";
    echo "<p>Obra ID: $obra_id</p>";
    echo "<p>Cor ID: $cor_id</p>";
    echo "<p>Origem: $origem</p>";
    echo "<p>Destino: $destino</p>";
    echo "<p>Nota Fiscal: $nota</p>";
    echo "<p>Responsável: $responsavel</p>";
    echo "<p>Placa do Caminhão: $caminhao</p>";
    echo "<p>Motorista: $motorista</p>";
    echo "<p>Observações: $observacoes</p>";
    echo "<h2>Itens da Entrada:</h2>";
    foreach ($itens as $item) {
        echo "<p>Perfil: {$item['perfil']}, Tamanho: {$item['tamanho']}, Cor ID: {$item['cor_id']}, Quantidade: {$item['quantidade']}</p>";
    }

    // Agora você pode realizar as operações necessárias com esses valores, como inseri-los em um banco de dados.
}
?>
