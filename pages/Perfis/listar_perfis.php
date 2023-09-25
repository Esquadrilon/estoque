<?php

include_once('../../db/connection.php');

$result = $conn->query("SELECT * FROM perfis");

if ($result) {
    $perfis = [];
    // Obtenha os dados dos perfis
    while ($row = $result->fetch_assoc()) {

        $item[] = $row;

        $perfis = $item;
    }
    
    echo json_encode($perfis);
} else {
    echo json_encode([]);
}
?>
