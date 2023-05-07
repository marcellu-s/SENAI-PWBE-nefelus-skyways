<?php

include_once "./db.php";

$file = $_POST['file'];
@$opt = $_POST['option'];

if ($file == 'query_estado.js') {

    $query_file = mysqli_query($conn, "SELECT * FROM estado");
    
    $i = 0;
    while ($row = mysqli_fetch_assoc($query_file)) {
        $estados_arr[$i] = array(
            'id_estado' => $row['id_estado'],
            'sigla_estado' => $row['sigla_estado'],
            'nome_estado' => $row['nome_estado']
        );

        $i++;
    }

    $json = json_encode($estados_arr);
    echo $json;

} elseif ($file == 'query_cidade.js') {

    $query_file = mysqli_query($conn, "SELECT * FROM cidade WHERE fk_estado = $opt");
    
    echo "<option value=''>...</option>";
    while ($row = mysqli_fetch_assoc($query_file)) {
        echo "<option value='" . $row['id_cidade'] . "'>" . $row['nome_cidade'] ."</option>";    
    }

} elseif ($file == 'query_aeroporto.js') {

    $query_file = mysqli_query($conn, "SELECT * FROM aeroporto WHERE fk_cidade = $opt");
    
    echo "<option value=''>...</option>";
    while ($row = mysqli_fetch_assoc($query_file)) {
        echo "<option value='" . $row['id_aeroporto'] . "'>" . $row['nome'] ."</option>";    
    }
    
} elseif ($file == 'query_aviao.js') {

    $query_file = mysqli_query($conn, "SELECT * FROM aviao WHERE fk_aeroporto = $opt");
    
    echo "<option value=''>...</option>";
    while ($row = mysqli_fetch_assoc($query_file)) {
        echo "<option value='" . $row['id_aviao'] . "'>" . $row['modelo'] . " -- " . $row['matricula'] . "</option>";
    }

} elseif ($file = './conexao.js') {

    $query_file = mysqli_query($conn, "SELECT * FROM estado");
    
    echo "<option value=''>...</option>";
    while ($row = mysqli_fetch_assoc($query_file)) {
        echo "<option value='" . $row['id_cidade'] . "'>" . $row['nome_cidade'] ."</option>";    
    }

}
