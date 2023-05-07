<?php

include_once "./db.php";

// $objeto = $_POST['objeto'];
// $op = $_POST['op'];
$objeto = 'avioes';

if ($objeto == 'avioes') {
    
    $query_avioes = mysqli_query($conn, "SELECT * FROM aviao LIMIT 10");
    $i = 0;

    while ($row = mysqli_fetch_assoc($query_avioes)) {

        $query_aeroporto = mysqli_fetch_assoc(mysqli_query($conn, "SELECT aeroporto.nome, estado.sigla_estado 
        FROM aeroporto 
        INNER JOIN cidade ON cidade.id_cidade = aeroporto.fk_cidade
        INNER JOIN estado ON estado.id_estado = cidade.fk_estado
        WHERE aeroporto.id_aeroporto = " . $row['fk_aeroporto'])); 

        $avioes[$i] = array(


            'modelo' => $row['modelo'],
            'matricula' => $row['matricula'],
            'carga' => $row['carga'],
            'aeroporto' => $query_aeroporto['nome'],
            'estado' => $query_aeroporto['sigla_estado']
        );

        $i++;
    }
    $json = json_encode($avioes);
    echo $json;
}