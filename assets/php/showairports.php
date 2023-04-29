<?php

// Conexão ao banco de dados por PDO
$conn = new PDO('mysql:host=localhost;dbname=ajax', 'root', 'SQL04df478fpk8');

if (isset($_POST['q'])) {
    // Caso seja passado um parâmetro
    $search = $_POST['q'];
    $query = "SELECT * FROM aeroporto WHERE nome LIKE '%$search%' ORDER BY nome";

} else {
    // Caso não seja passado um parâmetro
    $query = "SELECT * FROM aeroporto ORDER BY nome";
}

// Executando a query
$prepare = $conn->prepare($query);
$prepare->execute();

// Resultado a partir da query
$result = $prepare->fetchAll();
$rowCount = $prepare->rowCount(); 

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