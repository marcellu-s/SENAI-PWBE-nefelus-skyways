<?php

include_once "../../../ops/db.php";

$id = isset($_GET['id']) ? $_GET['id'] : false; // Identificador
$op = isset($_GET['op']) ? $_GET['op'] : false; // Opção de detalhes - Aeroporto, avião, passageiro ou cadastro.

$array = [];

if ($op) {

    switch ($op) {

        case 'aeroporto': {
    
            $query = "SELECT * FROM aeroporto
            INNER JOIN cidade
            ON cidade.id_cidade = aeroporto.fk_cidade
            INNER JOIN estado
            ON estado.id_estado = cidade.fk_estado
            WHERE aeroporto.id_aeroporto = '$id'";
    
            $result = mysqli_query($conn, $query);
    
            $assoc = mysqli_fetch_assoc($result);
    
            $array = [
                'iata' => $assoc['sigla'],
                'nome' => $assoc['nome'],
                'cidade' => $assoc['nome_cidade'],
                'estado' => $assoc['nome_estado'],
                'latitude' => $assoc['latitude'],
                'longitude' => $assoc['longitude']
            ];
        
            break;
        }
    
        case 'aviao': {
    
            $query = "SELECT * FROM aviao
            INNER JOIN aeroporto
            ON aeroporto.id_aeroporto = aviao.fk_aeroporto
            WHERE aviao.id_aviao = '$id'";
    
            $result = mysqli_query($conn, $query);
    
            $assoc = mysqli_fetch_assoc($result);
    
            $array = [
                'matrícula da aeronave' => $assoc['matricula'],
                'modelo' => $assoc['modelo'],
                'capacidade de carga' => $assoc['carga'].' kg',
                'velocidade de cruzeiro' => $assoc['velocidade'].' km/h',
                'aeroporto de origem' => $assoc['nome']
            ];
    
            break;
        }
    
        case 'passageiro': {
    
    
    
            break;
        }
    }
}

if ($id && $op && count($array) > 0) {

    echo(json_encode($array));

} else {

    echo('Registro inexistente!');
}


?>