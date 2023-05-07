<?php

function createTable($optionParam) {

    include_once "../../../ops/db.php";

    $array = null;

    switch ($optionParam) {

        case 'avioes': {

            $query = "SELECT matricula, modelo, carga, velocidade, id_aviao FROM aviao";

            $result = mysqli_query($conn, $query);

            $array = [
                [
                    'Matrícula de registro',
                    'Modelo',
                    'Capacidade de carga - kg',
                    'Velocidade de cruzeiro - km/h',
                    'Editar',
                    'Remover'
                ]
            ];

            while ($row = mysqli_fetch_row($result)) {

                $id = $row[count($row) - 1];

                array_pop($row);

                array_push($row, "<a href='$id'><i class='bi bi-pen'></i></a>", "<a href='$id'><i class='bi bi-x-lg'></i></a>");

                array_push($array, $row);
            }

            break;
        }

        case 'aeroportos': {

            $query = "SELECT sigla, nome, nome_cidade, nome_estado, id_aeroporto FROM aeroporto
            INNER JOIN cidade 
            ON cidade.id_cidade = aeroporto.fk_cidade
            INNER JOIN estado
            ON estado.id_estado = cidade.fk_estado";

            $result = mysqli_query($conn, $query);

            $array = [
                [
                    'IATA',
                    'Aeroporto',
                    'Cidade',
                    'Estado',
                    'Editar',
                    'Remover'
                ]
            ];

            while ($row = mysqli_fetch_row($result)) {

                $id = $row[count($row) - 1];

                array_pop($row);

                array_push($row, "<a href='$id'><i class='bi bi-pen'></i></a>", "<a href='$id'><i class='bi bi-x-lg'></i></a>");

                array_push($array, $row);
            }

            break;
        }

        case 'cadastros': {

            $query = "SELECT p_nome, email, telefone, cpf, id_cadastro FROM cadastro
            INNER JOIN pessoa
            ON pessoa.id_pessoa = cadastro.fk_pessoa";

            $result = mysqli_query($conn, $query);

            $array = [
                [
                    'Nome',
                    'E-mail',
                    'Telefone',
                    'CPF',
                    'Detalhes'
                ]
            ];

            while ($row = mysqli_fetch_row($result)) {

                $id = $row[count($row) - 1];

                array_pop($row);

                array_push($row, "<a href='$id'><i class='bi bi-link'></i></a>");

                array_push($array, $row);
            }

            break;
        }

        case 'testpassageiros': {

            break;
        }
    }

    return json_encode($array);
}


$option = $_GET['choice'];

if ($option == 'avioes') {

    echo(createTable($option));    

} else if ($option == 'aeroportos') {

    echo(createTable($option));      

} else if ($option == 'cadastros') {

    echo(createTable($option));       

} else if ($option == 'passageiros') {

    echo(createTable($option));      
}

?>