<?php

$chegada = $_POST['flightID'];

$array = [
    'title' => 'Detalhes do voo de ida',
    'duration' => 'Duranção da viagem - 01:12h',
    'idVoo' => 'NF 458',
    'travelFromLocation' => 'Fortaleza - FortAirport/FTA',
    'travelFromDatetime' => '26/05 ás 23:50',
    'goingToLocation' => 'Minas Gerais - MgAirport/MGA',
    'goingToDatetime' => '27/05 ás 00:58',
    'airPlaneInfo' => 'Avição: Boing 123'
];

echo(json_encode($array));

?>