<?php

include_once "../../ops/db.php";

$id_voo = $_POST['flightID'];
$request = $_POST['request'];

if ($request == 'voo') {
    $query_voos = "SELECT voo.*, 
            cidade_origem.nome_cidade AS cidade_origem, 
            origem.nome AS aero_origem, origem.sigla AS sigla_origem,
            cidade_destino.nome_cidade AS cidade_destino,
            destino.nome AS aero_destino, destino.sigla AS sigla_destino,
            aviao.*
            FROM voo
            JOIN aeroporto AS origem ON voo.origem = origem.id_aeroporto
            JOIN cidade AS cidade_origem ON origem.fk_cidade = cidade_origem.id_cidade
            JOIN aeroporto AS destino ON voo.destino = destino.id_aeroporto
            JOIN cidade AS cidade_destino ON destino.fk_cidade = cidade_destino.id_cidade
            INNER JOIN assento ON assento.id_assento = voo.fk_assento
            INNER JOIN aviao ON aviao.id_aviao = voo.aviao
            WHERE voo.id_voo = $id_voo";

    $result = mysqli_fetch_assoc(mysqli_query($conn, $query_voos));

    $array = [
        'title' => 'Detalhes do voo de ida',
        'duration' => 'Duração da viagem - '. $result['duracao']. 'h',
        'idVoo' => 'Nº Vôo: ' . $result['id_voo'],
        'travelFromLocation' => $result['cidade_origem'].' - '. $result['aero_origem'] .'/' .$result['sigla_origem'],
        'travelFromDatetime' => $result['data_ida'],
        'goingToLocation' => $result['cidade_destino'].' - '. $result['aero_destino'] .'/' .$result['sigla_destino'],
        'goingToDatetime' => $result['data_chegada'],
        'airPlaneInfo' =>   $result['matricula'] . ' - Nº MAT: '. $result['modelo']
    ];
} elseif ($request == 'assento') {
    
    $query_assento = "SELECT assento.preco_economico AS economico, assento.preco_premium AS premium FROM voo
    INNER JOIN assento
    ON assento.id_assento = voo.fk_assento
    WHERE id_voo = $id_voo";

    $result = mysqli_fetch_assoc(mysqli_query($conn, $query_assento));

    $array = [
        'economico' => $result['economico'],
        'premium' => $result['premium']
    ];
} 

echo (json_encode($array));

?>