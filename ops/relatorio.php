<?php

include_once "../../ops/db.php";

$objeto = $_POST['objeto'];

if ($objeto == 'voo') {
    $datetime_min = $_POST['date_min'] ." ". $_POST['time_min'];
    $datetime_max = $_POST['date_max'] ." ". $_POST['time_max'];

    $query_voo_datetime = "SELECT * FROM voo WHERE data_ida > '$datetime_min' AND data_ida < '$datetime_max'";

    @$id_aeroport = $_POST['aeroporto'];
    if (isset($aeroport)) {
        $query_voo_datetime .= " AND origem = $id_aeroport";
    }

    $result_query = mysqli_query($conn, $query_voo);

    echo mysqli_num_rows($result_query); // NUMERO DE VOOS ENCONTRADOS ENTRE AS DATAS DA QUERY
}

elseif ($objeto == 'pessoa') {

    $option = $_POST['op'];
    switch ($option) {
        case 'name':
            $name = explode(" ", $_POST['name']);
            $f_name = $name[0];
            $l_name = $name[count($name) - 1];
            
            $query_person = "SELECT * FROM pessoa WHERE p_nome = '$f_name' AND p_sobrenome = '$l_name'";
            break;
        case 'cpf':
            $cpf = $_POST['cpf'];

            $query_person = "SELECT * FROM pessoa WHERE cpf = '$cpf'";
            break;
        case 'passport':
            $passport = $_POST['passport'];

            $query_person = "SELECT * FROM pessoa WHERE passaporte = '$passaporte'";
    }

    $result_query = mysqli_query($conn, $query_person);
}

elseif ($objeto == "passagem") {
    $date_min = $_POST['date_min'];
    $date_max = $_POST['date_max'];

    $query_passagem_date = "SELECT * from passagem
    INNER JOIN pagamento
    ON fk_pagamento = id_pagamento
    WHERE data_pagamento > $date_min AND data_pagamento < $date_max";

    $result_query = mysqli_query($conn, $query_passagem_date);

    echo mysqli_num_rows($result_query); // NUMERO DE PAGAMENTOS ENCONTRADOS ENTRE AS DATAS
}