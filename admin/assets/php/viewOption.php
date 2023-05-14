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

    $check = NULL;

    switch ($optionParam) {

        case 'avioes': {

            $query = "SELECT matricula, modelo, carga, velocidade, id_aviao FROM aviao LIMIT $qnt_result_pg OFFSET $inicio";

            $result = $conn->query($query);

            $thead = "<tr>
                    <th>Matrícula de registro</th>
                    <th>Modelo</th>
                    <th>Capacidade de carga - kg</th>
                    <th>Velocidade de cruzeiro - km/h</th>
                    <th>Detalhes</th>
                </tr>";

            $tbody = '';

            $countItens = 0;

            while ($assoc = $result->fetch_assoc()) {

                $id = $assoc['id_aviao'];

                $countItens++;

                $tbody = $tbody."<tr>
                    <td>$assoc[matricula]</td>
                    <td>$assoc[modelo]</td>
                    <td>$assoc[carga]</td>
                    <td>$assoc[velocidade]</td>
                    <td><a href='./detalhes.php?id=$id&op=aviao' target='_blank'><i class='bi bi-link'></i></a></td>
                </tr>";
            }

            $check = true;

            break;
        }

        case 'aeroportos': {

            $query = "SELECT sigla, nome, nome_cidade, nome_estado, id_aeroporto FROM aeroporto
            INNER JOIN cidade 
            ON cidade.id_cidade = aeroporto.fk_cidade
            INNER JOIN estado
            ON estado.id_estado = cidade.fk_estado
            LIMIT $qnt_result_pg OFFSET $inicio";

            $result = $conn->query($query);

            $thead = "<tr>
                    <th>IATA</th>
                    <th>Aeroporto</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Detalhes</th>
                </tr>";

            $tbody = '';

            $countItens = 0;

            while ($assoc = $result->fetch_assoc()) {

                $id = $assoc['id_aeroporto'];

                $countItens++;

                $tbody = $tbody."<tr>
                    <td>$assoc[sigla]</td>
                    <td>$assoc[nome]</td>
                    <td>$assoc[nome_cidade]</td>
                    <td>$assoc[nome_estado]</td>
                    <td><a href='./detalhes.php?id=$id&op=aeroporto' target='_blank'><i class='bi bi-link'></i></a></td>
                </tr>";
            }

            $check = true;

            break;
        }

        case 'cadastros': {

            $query = "SELECT p_nome, p_sobrenome, data_nasc, sexo, nacionalidade, email, telefone, id_cadastro FROM cadastro
            INNER JOIN pessoa
            ON pessoa.id_pessoa = cadastro.fk_pessoa
            INNER JOIN funcionario
            WHERE NOT funcionario.fk_cadastro = cadastro.id_cadastro
            LIMIT $qnt_result_pg OFFSET $inicio";

            $result = $conn->query($query);

            $thead = "<tr>
                    <th>Nome</th>
                    <th>Data de nascimento</th>
                    <th>Gênero</th>
                    <th>Nacionalidade</th> 
                    <th>E-mail</th> 
                    <th>Telefone</th> 
                    <th>Detalhes</th>
                </tr>";

            $tbody = '';

            $countItens = 0;

            while ($assoc = $result->fetch_assoc()) {

                $id = $assoc['id_cadastro'];

                $countItens++;

                $name = "$assoc[p_nome] $assoc[p_sobrenome]";
                $gender = strtolower($assoc['sexo']) == 'h' ? 'Homem' : 'Mulher';

                $tbody = $tbody."<tr>
                    <td>$name</td>
                    <td>$assoc[data_nasc]</td>
                    <td>$gender</td>
                    <td>$assoc[nacionalidade]</td>
                    <td>$assoc[email]</td>
                    <td>$assoc[telefone]</td>
                    <td><a href='./detalhes.php?id=$id&op=cadastro' target='_blank'><i class='bi bi-link'></i></a></td>
                </tr>";
            }

            $check = true;

            break;
        }

        case 'passageiros': {

            $query = "SELECT p_nome, p_sobrenome, data_nasc, sexo, nacionalidade, id_passageiro FROM passageiro
            INNER JOIN pessoa
            ON pessoa.id_pessoa = passageiro.fk_pessoa
            LIMIT $qnt_result_pg OFFSET $inicio";

            $result = $conn->query($query);

            $thead = "<tr>
                    <th>Nome</th>
                    <th>Data de nascimento</th>
                    <th>Gênero</th>
                    <th>Nacionalidade</th> 
                    <th>Detalhes</th>
                </tr>";

            $tbody = '';

            $countItens = 0;

            while ($assoc = $result->fetch_assoc()) {

                $id = $assoc['id_passageiro'];

                $countItens++;

                $name = "$assoc[p_nome] $assoc[p_sobrenome]";
                $gender = strtolower($assoc['sexo']) == 'h' ? 'Homem' : 'Mulher';

                $tbody = $tbody."<tr>
                    <td>$name</td>
                    <td>$assoc[data_nasc]</td>
                    <td>$gender</td>
                    <td>$assoc[nacionalidade]</td>
                    <td><a href='./detalhes.php?id=$id&op=passageiro' target='_blank'><i class='bi bi-link'></i></a></td>
                </tr>";
            }

            $check = true;

            break;
        }

        case 'funcionarios': {

            $query = "SELECT p_nome, p_sobrenome, data_nasc, sexo, nacionalidade, email, telefone, funcao, id_funcionario FROM cadastro
            INNER JOIN pessoa
            ON pessoa.id_pessoa = cadastro.fk_pessoa
            INNER JOIN funcionario
            WHERE funcionario.fk_cadastro = cadastro.id_cadastro
            LIMIT $qnt_result_pg OFFSET $inicio";
            
            $result = $conn->query($query);

            $thead = "<tr>
                    <th>Nome</th>
                    <th>Data de nascimento</th>
                    <th>Gênero</th>
                    <th>Nacionalidade</th> 
                    <th>E-mail</th> 
                    <th>Telefone</th> 
                    <th>Função</th> 
                    <th>Detalhes</th>
                </tr>";

            $tbody = '';

            $countItens = 0;

            while ($assoc = $result->fetch_assoc()) {

                $id = $assoc['id_funcionario'];

                $countItens++;

                $name = "$assoc[p_nome] $assoc[p_sobrenome]";
                $gender = strtolower($assoc['sexo']) == 'h' ? 'Homem' : 'Mulher';
                $job = strtolower($assoc['funcao']) == 'admin' ? 'Administrador' : 'Comum';

                $tbody = $tbody."<tr>
                    <td>$name</td>
                    <td>$assoc[data_nasc]</td>
                    <td>$gender</td>
                    <td>$assoc[nacionalidade]</td>
                    <td>$assoc[email]</td>
                    <td>$assoc[telefone]</td>
                    <td>$job</td>
                    <td><a href='./detalhes.php?id=$id&op=funcionario' target='_blank'><i class='bi bi-link'></i></a></td>
                </tr>";
            }

            $check = true;

            break;
        }
    }

    if ($check === true) {

        // Quantidade de pagina
        $quantidade_pg = ceil($countItens / $qnt_result_pg);

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
            $thead,
            $tbody,
            $countItens,
            $linkPaginas
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