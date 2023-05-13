<?php

$conn = new PDO('mysql:host=localhost;dbname=skywaysbd', 'root', '');

if (isset($_POST['q'])) {
    // Caso seja passado um parâmetro
    $search = $_POST['q'];
    $query = "SELECT * FROM contato WHERE assunto LIKE '%$search%' ORDER BY DATE(data_envio) DESC";

} else {

  // Caso não seja passado um parâmetro
  $query = "SELECT * FROM contato ORDER BY DATE(data_envio) DESC";
}

// Executando a query
$prepare = $conn->prepare($query);
$prepare->execute();

// Resultado a partir da query
$result = $prepare->fetchAll();
$rowCount = $prepare->rowCount(); 

// Determinado o dado e retornando o mesmo
$data = NULL;

if ($rowCount > 0) {

    foreach($result as $row) {
        $data = "<div class='message'>
            <span>Data de envio: $row[data_envio]</span>
            <span>Nome: $row[nome]</span>
            <span>E-mail: $row[email]</span>
            <span>Assunto: $row[assunto]</span>
            <textarea name='message' id='message' cols='60' rows='10' readonly>$row[mensagem]</textarea>
          </div>
        </div>";

        echo($data);
    }

} else {
    
    $data = "Nenhuma mensagem encontrada";

    echo($data);
}

?>
