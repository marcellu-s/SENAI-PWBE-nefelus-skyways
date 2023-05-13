<?php

// Conexão ao banco de dados por PDO
include_once "../../ops/db.php";

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

// Obtendo o resultado como um objeto mysqli_result
$result = $prepare->get_result();

// Determinando o dado e retornando o mesmo
$data = null;

if ($result->num_rows > 0) {

    // Iterando sobre o resultado
    while($row = $result->fetch_assoc()) {
        $data = "<span>" . $row['nome'] . "</span>";
        echo($data);
    }

} else {
    
    $data = "Nenhum aeroporto encontrado.";

    echo($data);
}

?>
