<?php

include "../../ops/db.php";

if (isset($_POST['q'])) {
    // Caso seja passado um parâmetro
    $search = $_POST['q'];
    $query = "SELECT * FROM aeroporto WHERE nome LIKE '%$search%' ORDER BY nome";

} else {
    // Caso não seja passado um parâmetro
    $query = "SELECT * FROM aeroporto ORDER BY nome";
}

// // Executando a query
$result = $conn->query($query);

// // Resultado a partir da query
$resultData = $result->fetch_all();

$rowCount = $result->num_rows;

// Determinado o dado e retornando o mesmo
$data = null;

if ($rowCount > 0) {

    foreach($result as $row) {
        $data = "<span>$row[nome]</span>";

        echo($data);
    }

} else {
    
    $data = "Nenhum aeroporto encontrado.";

    echo($data);
}

?>