<?php

function createTable($optionParam) {

    include_once "../../../ops/db.php";


    // || || || || \\ PAGINAÇÃO // || || || || \\

    // Receber o número da página
    $pagina_atual = filter_input(INPUT_GET, 'pag', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

    // Setar a quantidade de items por pagina
    $qnt_result_pg = 10;

    // Calcular o inicio visualização
    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

    $array = null;

    switch ($optionParam) {

        case 'avioes': {

            $query = "SELECT matricula, modelo, carga, velocidade, id_aviao FROM aviao LIMIT $qnt_result_pg OFFSET $inicio";

            $result = mysqli_query($conn, $query);

            $array = [
                [
                    'Matrícula de registro',
                    'Modelo',
                    'Capacidade de carga - kg',
                    'Velocidade de cruzeiro - km/h',
                    'Detalhes'
                ]
            ];

            while ($row = mysqli_fetch_row($result)) {

                $id = $row[count($row) - 1];

                array_pop($row);

                array_push($row, "<a href='./detalhes.php?id=$id&op=aviao' target='_blank'><i class='bi bi-link'></i></a>");

                array_push($array, $row);
            }

            break;
        }

        case 'aeroportos': {

            $query = "SELECT sigla, nome, nome_cidade, nome_estado, id_aeroporto FROM aeroporto
            INNER JOIN cidade 
            ON cidade.id_cidade = aeroporto.fk_cidade
            INNER JOIN estado
            ON estado.id_estado = cidade.fk_estado
            LIMIT $qnt_result_pg OFFSET $inicio";

            $result = mysqli_query($conn, $query);

            $array = [
                [
                    'IATA',
                    'Aeroporto',
                    'Cidade',
                    'Estado',
                    'Detalhes'
                ]
            ];

            while ($row = mysqli_fetch_row($result)) {

                $id = $row[count($row) - 1];

                array_pop($row);

                array_push($row, "<a href='./detalhes.php?id=$id&op=aeroporto' target='_blank'><i class='bi bi-link'></i></a>");

                array_push($array, $row);
            }

            break;
        }

        case 'cadastros': {

            $query = "SELECT p_nome, p_sobrenome, data_nasc, sexo, nacionalidade, email, telefone, id_cadastro FROM cadastro
            INNER JOIN pessoa
            ON pessoa.id_pessoa = cadastro.fk_pessoa
            INNER JOIN funcionario
            WHERE NOT funcionario.fk_cadastro = cadastro.id_cadastro
            LIMIT $qnt_result_pg OFFSET $inicio";

            $result = mysqli_query($conn, $query);

            $array = [
                [
                    'Nome',
                    'Sobrenome',
                    'Data de nascimento',
                    'Gênero',
                    'Nacionalidade',
                    'E-mail',
                    'Telefone',
                    'Detalhes'
                ]
            ];

            while ($row = mysqli_fetch_row($result)) {

                $id = $row[count($row) - 1];

                array_pop($row);

                array_push($row, "<a href='./detalhes.php?id=$id&op=cadastro' target='_blank'><i class='bi bi-link'></i></a>");

                array_push($array, $row);
            }

            break;
        }

        case 'passageiros': {

            $query = "SELECT p_nome, p_sobrenome, data_nasc, sexo, nacionalidade, id_passageiro FROM passageiro
            INNER JOIN pessoa
            ON pessoa.id_pessoa = passageiro.fk_pessoa
            LIMIT $qnt_result_pg OFFSET $inicio";

            $result = mysqli_query($conn, $query);

            $array = [
                [
                    'Nome',
                    'Sobrenome',
                    'Data de nascimento',
                    'Gênero',
                    'Nacionalidade',
                    'Detalhes'
                ]
            ];

            while ($row = mysqli_fetch_row($result)) {

                $id = $row[count($row) - 1];

                array_pop($row);

                array_push($row, "<a href='./detalhes.php?id=$id&op=passageiro' target='_blank''><i class='bi bi-link'></i></a>");

                array_push($array, $row);
            }

            break;
        }

        case 'funcionarios': {

            $query = "SELECT p_nome, p_sobrenome, data_nasc, sexo, nacionalidade, email, telefone, funcao, id_funcionario FROM cadastro
            INNER JOIN pessoa
            ON pessoa.id_pessoa = cadastro.fk_pessoa
            INNER JOIN funcionario
            WHERE funcionario.fk_cadastro = cadastro.id_cadastro
            LIMIT $qnt_result_pg OFFSET $inicio";

            $result = mysqli_query($conn, $query);

            $array = [
                [
                    'Nome',
                    'Sobrenome',
                    'Data de nascimento',
                    'Gênero',
                    'Nacionalidade',
                    'E-mail',
                    'Telefone',
                    'Função',
                    'Detalhes'
                ]
            ];

            while ($row = mysqli_fetch_row($result)) {

                $id = $row[count($row) - 1];

                array_pop($row);

                array_push($row, "<a href='./detalhes.php?id=$id&op=funcionario' target='_blank'><i class='bi bi-link'></i></a>");

                array_push($array, $row);
            }
        }
    }

    if ($array != NULL) {

        // Quantidade de pagina
        $quantidade_pg = ceil(count($array[0]) / $qnt_result_pg);

        // Limitar os link antes depois
        $max_links = 1;
        $linkPaginas = "<a class='1 $optionParam'><</a> ";

        for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
            if ($pag_ant >= 1) {
                $linkPaginas =  $linkPaginas . "<a class='$pag_ant $optionParam'>$pag_ant</a> ";
            }
        }

        $linkPaginas =  $linkPaginas . "<p class='selecionado'>" . $pagina . "</p>";

        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if ($pag_dep <= $quantidade_pg) {
                $linkPaginas =  $linkPaginas . "<a class='$pag_dep $optionParam'>$pag_dep</a> ";
            }
        }

        $linkPaginas = $linkPaginas . "<a class='$quantidade_pg $optionParam'>></a>";

        $data = [
            json_encode($array),
            json_encode($linkPaginas)
        ];

        return json_encode($data);
    } else {
        return false;
    }
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

} else if ($option == 'funcionarios') {

    echo(createTable($option));
}

?>