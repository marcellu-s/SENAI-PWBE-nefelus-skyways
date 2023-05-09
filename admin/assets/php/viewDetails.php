<?php

include_once "../../../ops/db.php";

$id = isset($_GET['id']) ? $_GET['id'] : false; // Identificador
$op = isset($_GET['op']) ? $_GET['op'] : false; // Opção de detalhes - Aeroporto, avião, passageiro ou cadastro.

// Array que será convertido em JSON
// armazena os dados a serem enviados para o FRONT
$array = [];

// Verifica se existe uma opção
if ($op) {

    // De acordo com a opção é realiada uma query referente ao match
    switch ($op) {

        case 'aeroporto': {
    
            $query = "SELECT * FROM aeroporto
            INNER JOIN cidade
            ON cidade.id_cidade = aeroporto.fk_cidade
            INNER JOIN estado
            ON estado.id_estado = cidade.fk_estado
            WHERE aeroporto.id_aeroporto = '$id'";
    
            $result = mysqli_query($conn, $query);
    
            $assoc = mysqli_fetch_assoc($result);
    
            $array = [
                'iata' => $assoc['sigla'],
                'nome' => $assoc['nome'],
                'cidade' => $assoc['nome_cidade'],
                'estado' => $assoc['nome_estado'],
                'latitude' => $assoc['latitude'],
                'longitude' => $assoc['longitude']
            ];
        
            break;
        }
    
        case 'aviao': {
    
            $query = "SELECT * FROM aviao
            INNER JOIN aeroporto
            ON aeroporto.id_aeroporto = aviao.fk_aeroporto
            WHERE aviao.id_aviao = '$id'";
    
            $result = mysqli_query($conn, $query);
    
            $assoc = mysqli_fetch_assoc($result);
    
            $array = [
                'matrícula da aeronave' => $assoc['matricula'],
                'modelo' => $assoc['modelo'],
                'capacidade de carga' => $assoc['carga'].' kg',
                'velocidade de cruzeiro' => $assoc['velocidade'].' km/h',
                'aeroporto de origem' => $assoc['nome']
            ];
    
            break;
        }
    
        case 'passageiro': {
    
            $query = "SELECT * FROM passageiro
            INNER JOIN pessoa
            ON pessoa.id_pessoa = passageiro.fk_pessoa
            WHERE passageiro.id_passageiro = '$id'";
    
            $result = mysqli_query($conn, $query);
    
            $assoc = mysqli_fetch_assoc($result);

            $name = join(' ', [$assoc['p_nome'], $assoc['p_sobrenome']]);

            switch (strtoupper($assoc['sexo'])) {
                case 'M': {
                    $gender = 'Mulher';
                    break;
                }
                case 'H': {
                    $gender = 'Homem';
                }
            }
    
            $array = [
                'nome' => $name,
                'endereço' => $assoc['endereco'],
                'data de nascimento' => $assoc['data_nasc'],
                'gênero' => $gender,
                'nacionalidade' => $assoc['nacionalidade'],
                'cpf' => $assoc['cpf'],
                'passaporte' => $assoc['passaporte'],
            ];

            $query2 = "SELECT * FROM passagem
            INNER JOIN passageiro
            ON passageiro.id_passageiro = passagem.fk_passageiro
            WHERE passageiro.id_passageiro = '$id'";

            $result2 = mysqli_query($conn, $query2);

            $array2 = [];

            if (mysqli_affected_rows($conn)) {

                $assoc2 = mysqli_fetch_assoc($result2);

                $array2 = [
                    "passagem $assoc2[id_passagem]" => $assoc2['status_passagem']
                ];

            }

            if (count($array2) > 0) {
                $array = array_merge($array, $array2);
            }

            break;
        }

        case 'cadastro': {

            $query = "SELECT * FROM cadastro
            INNER JOIN pessoa
            ON pessoa.id_pessoa = cadastro.fk_pessoa
            WHERE cadastro.id_cadastro = '$id'";

            $result = mysqli_query($conn, $query);

            if (mysqli_affected_rows($conn)) {

                $assoc = mysqli_fetch_assoc($result);

                $name = join(' ', [$assoc['p_nome'], $assoc['p_sobrenome']]);

                switch (strtoupper($assoc['sexo'])) {
                    case 'M': {
                        $gender = 'Mulher';
                        break;
                    }
                    case 'H': {
                        $gender = 'Homem';
                    }
                }

                $array = [
                    'nome' => $name,
                    'endereço' => $assoc['endereco'],
                    'data de nascimento' => $assoc['data_nasc'],
                    'gênero' => $gender,
                    'nacionalidade' => $assoc['nacionalidade'],
                    'cpf' => $assoc['cpf'],
                    'passaporte' => $assoc['passaporte'],
                    'email' => $assoc['email'],
                    'telefone' => $assoc['telefone'],
                    'email' => $assoc['email'],
                ];
            }
        }

        case 'funcionario': {

            $query = "SELECT * FROM funcionario
            INNER JOIN pessoa
            ON pessoa.id_pessoa = funcionario.fk_pessoa
            INNER JOIN cadastro
            ON cadastro.id_cadastro = funcionario.fk_cadastro
            WHERE funcionario.id_funcionario = '$id'";

            $result = mysqli_query($conn, $query);

            if (mysqli_affected_rows($conn)) {

                $assoc = mysqli_fetch_assoc($result);

                $name = join(' ', [$assoc['p_nome'], $assoc['p_sobrenome']]);

                switch (strtoupper($assoc['sexo'])) {
                    case 'M': {
                        $gender = 'Mulher';
                        break;
                    }
                    case 'H': {
                        $gender = 'Homem';
                    }
                }

                switch (strtoupper($assoc['funcao'])) {
                    case 'ADMIN': {
                        $role = 'Administrador';
                        break;
                    }
                    case 'COMUM': {
                        $role = 'Funcionário';
                        break;
                    }
                }

                $array = [
                    'nome' => $name,
                    'função' => $role,
                    'endereço' => $assoc['endereco'],
                    'data de nascimento' => $assoc['data_nasc'],
                    'gênero' => $gender,
                    'nacionalidade' => $assoc['nacionalidade'],
                    'cpf' => $assoc['cpf'],
                    'passaporte' => $assoc['passaporte'],
                    'email' => $assoc['email'],
                    'telefone' => $assoc['telefone'],
                    'email' => $assoc['email'],
                ];
            }
        }
    }
}

// Caso tudo esteja correto e tenha sido retornado algum dado da query, é enviado um JSON

if ($id && $op && count($array) > 0) {

    echo(json_encode($array));

} else {

    // Caso não, será disparado no FRONT da requisição uma mensagem "sem registro";

    echo('Registro inexistente!');
}


?>