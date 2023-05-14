<?php

// Opções de visualização do cliente sobre sua conta

session_start();

include_once "../../../ops/db.php";

$id = $_SESSION['loginID'];

$option = $_GET['option'];

date_default_timezone_set('America/Sao_Paulo');

switch ($option) {
    // Editar perfil
    case 'edit-profile':

        $query = "SELECT * FROM cadastro
        INNER JOIN pessoa
        ON pessoa.id_pessoa = cadastro.fk_pessoa
        WHERE cadastro.id_cadastro = $id";

        $result = $conn->query($query);

        if ($result->num_rows != 1) {

            die();
        }

        $userData = $result->fetch_assoc();

        $addressArray = explode(';', $userData['endereco']);
        $gender = strtoupper($userData['sexo']) == 'H' ? 'Homem' : 'Mulher';

        $template = "<div class='request-edit-profile'>
        <div class='msg'>
            <span>OBS: apenas o que for modificado será alterado!</span>
        </div>
        <form action='../assets/php/editProfileProcess.php' method='POST'>
            <div class='input-control'>
                <label for='first-name'>NOME</label>
                <input type='text' name='first-name' id='first-name' value='$userData[p_nome]'>
            </div>
            <div class='input-control'>
                <label for='last-name'>SOBRENOME</label>
                <input type='text' name='last-name' id='last-name' value='$userData[p_sobrenome]'>
            </div>
            <div class='input-control'>
                <label>DATA DE NASCIMENTO</label>
                <input type='date' value='$userData[data_nasc]' class='no-edit' readonly>
            </div>
            <div class='input-control'>
                <label>GÊNERO</label>
                <select name='gender' id='gender'>
                    <option value='$userData[sexo]' selected>$gender</option>
                    <option value='H'>Homem</option>
                    <option value='M'>Mulher</option>
                </select>
            </div>
            <div class='input-control'>
                <label for='nacionality'>NACIONALIDADE</label>
                <select name='nacionality' id='nacionality'>
                    <option value='$userData[nacionalidade]' selected>$userData[nacionalidade]</option>
                </select>
            </div>
            <div class='input-control'>
                <label for='telephone'>TELEFONE-CELULAR</label>
                <input type='tel' name='telephone' id='telephone' value='$userData[telefone]'>
            </div>
            <div class='input-control'>
                <label for='cep'>CEP</label>
                <input type='text' name='cep' id='cep' value='$addressArray[5]'>
            </div>
            <div class='input-control'>
                <label for='endereco'>ENDERECO</label>
                <input type='text' name='endereco' id='endereco' value='$addressArray[0]' readonly>
            </div>
            <div class='input-control'>
                <label for='bairro'>BAIRRO</label>
                <input type='text' name='bairro' id='bairro' value='$addressArray[1]' readonly>
            </div>
            <div class='input-control'>
                <label for='cidade'>CIDADE</label>
                <input type='text' name='cidade' id='cidade' value='$addressArray[2]' readonly>
            </div>
            <div class='input-control'>
                <label for='uf'>UF</label>
                <input type='text' name='uf' id='uf' value='$addressArray[3]' readonly>
            </div>
            <div class='input-control'>
                <label for='numero'>NÚMERO-RESIDENCIAL</label>
                <input type='text' name='numero' id='numero' value='$addressArray[4]'>
            </div>
            <div class='input-control'>
                <label for='cpf'>CPF</label>
                <input type='text' name='cpf' id='cpf' class='no-edit' value='$userData[cpf]' readonly>
            </div>
            <div class='input-control'>
                <label for='passport'>PASSAPORTE</label>
                <input type='text' name='passport' id='passport' class='no-edit' value='$userData[passaporte]' readonly>
            </div>
            <div class='input-control'>
                <label for='email'>E-MAIL</label>
                <input type='email' name='email' id='email' value='$userData[email]'>
            </div>
            <div class='input-control'>
                <label for='old-password'>SENHA ANTIGA</label>
                <input type='password' name='old-password' id='old-password'>
            </div>
            <div class='input-control'>
                <label for='new-password'>NOVA SENHA</label>
                <input type='password' name='new-password' id='new-password' minlength='8' maxlength='25'>
            </div>
            <div class='input-btn'>
                <button type='submit'>Salvar alterações</button>
            </div>
        </form>
        </div>";
        
        break;
    
    case 'show-travels':

        $today = date('Y-m-d');

        $query = "SELECT origem, destino, data_ida, data_chegada, preco_final FROM voo
        INNER JOIN passagem
        ON passagem.fk_voo = voo.id_voo
        INNER JOIN passageiro
        ON passageiro.id_passageiro = passagem.fk_passageiro
        INNER JOIN cadastro
        ON cadastro.id_cadastro = passageiro.fk_cadastro
        WHERE cadastro.id_cadastro = $id 
        AND 
        passagem.status_passagem = 'paga' 
        AND 
        DATE(data_chegada) < DATE('$today')
        ORDER BY DATE(data_chegada) DESC";

        $result = $conn->query($query);

        if (mysqli_error($conn)) {

            die();
        }

        $theadTr = "
            <tr>
                <th>Origem</th>
                <th>Destino</th>
                <th>Data de ida</th>
                <th>Data de chegada</th>
                <th>Preço</th>
            </tr>";

        $tbodyTr = "";

        while ($assoc = $result->fetch_assoc()) {

            // ----------------------------------------------- //
            // ----------------------------------------------- //
            
            // Query para buscar o aeroporto referente a origem e destino

            $queryAeroportoOrigem = $conn->query("SELECT nome_cidade FROM aeroporto
            INNER JOIN voo 
            ON '$assoc[origem]' = aeroporto.id_aeroporto
            INNER JOIN cidade
            ON cidade.id_cidade = aeroporto.fk_cidade");

            $AeroportoOrigem = $queryAeroportoOrigem->fetch_array()[0];

            $queryAeroportoDestino = $conn->query("SELECT nome_cidade FROM aeroporto
            INNER JOIN voo 
            ON '$assoc[destino]' = aeroporto.id_aeroporto
            INNER JOIN cidade
            ON cidade.id_cidade = aeroporto.fk_cidade");

            $AeroportoDestino = $queryAeroportoDestino->fetch_array()[0];

            // ----------------------------------------------- //
            // ----------------------------------------------- //

            // Trocando o formato da data de AAAA-MM-DD para DD-MM-AAAA

            $dataIdaReplaceFormat = new DateTime($assoc['data_ida']);
            $dataIdaNewFormat = $dataIdaReplaceFormat->format('d-m-Y H:i:s');

            $dataChegadaReplaceFormat = new DateTime(($assoc['data_chegada']));
            $dataChegadaNewFormat = $dataChegadaReplaceFormat->format('d-m-Y H:i:s');

            // ----------------------------------------------- //
            // ----------------------------------------------- //

            // Inserindo os devidos dados para retorno

            $tbodyTr = $tbodyTr."
                <tr>
                    <td>$AeroportoOrigem</td>
                    <td>$AeroportoDestino</td>
                    <td>$dataIdaNewFormat</td>
                    <td>$dataChegadaNewFormat</td>
                    <td>R$ $assoc[preco_final]</td>
                </tr>";
        }

        $template = "
        <div class='request-shows-travels'>
            <table>
                <thead>
                    ".$theadTr."
                </thead>
                <tbody>
                    ".$tbodyTr."
                </tbody>
            </table>
        </div>
        ";

        if ($tbodyTr == '') {

            $template = "Sem registros de viagens";
        }

        break;

    case 'passagens':

        $today = date('Y-m-d');

        $query = "SELECT origem, destino, data_ida, data_chegada, preco_final, status_passagem, id_passagem FROM passagem
        INNER JOIN voo
        ON voo.id_voo = passagem.fk_voo
        INNER JOIN passageiro
        ON passageiro.id_passageiro = passagem.fk_passageiro
        INNER JOIN cadastro
        ON cadastro.id_cadastro = passageiro.fk_cadastro
        WHERE cadastro.id_cadastro = $id
        ORDER BY data_ida";

        $result = $conn->query($query);

        if (mysqli_error($conn)) {

            die();
        }


        $theadTr = "
        <tr>
            <th>Origem</th>
            <th>Destino</th>
            <th>Data de ida</th>
            <th>Data de chegada</th>
            <th>Preço</th>
            <th>Status</th>
            <th>Operações</th>
        </tr>";

        $tbodyTr = "";

        while ($assoc = $result->fetch_assoc()) {

            $select = "---";

            // ----------------------------------------------- //
            // ----------------------------------------------- //

            // Aqui começa uma verificação para determinar se a passagem pode ser paga ou não
            // Dependendo da data de ida entre outras coisas

            if ($assoc['status_passagem'] == 'paga') {

                $resultStatusPassagem = $conn->query("SELECT data_ida FROM voo
                INNER JOIN passagem
                ON passagem.fk_voo = voo.id_voo
                WHERE passagem.id_passagem = $assoc[id_passagem]
                AND DATE(data_ida) > DATE('$today')");

                if ($resultStatusPassagem->num_rows > 0) {

                    $resultStatus = $resultStatusPassagem->fetch_array()[0];

                    $dataIda = date($resultStatus);

                    $today = date("Y-m-d H:i:s");

                    $dataInicio = new DateTime($today);
                    $dataFim = new DateTime($dataIda);

                    $dateInterval = $dataInicio->diff($dataFim);

                    if (($dateInterval->days) >= 1) {
                        
                        // pode cancelar

                        $select = "
                        <select>
                            <option selected>...</option>
                            <option>Cancelar</option>
                        </select>
                        ";

                    } else {

                        // não pode cancela

                        $select = "Tempo de cancelamento expirado";

                    }
                } else {
                    $select = "Realizada";
                }

            } else if ($assoc['status_passagem'] == 'não paga') {

                $resultStatusPassagem = $conn->query("SELECT data_ida FROM voo
                INNER JOIN passagem
                ON passagem.fk_voo = voo.id_voo
                WHERE passagem.id_passagem = $assoc[id_passagem]
                AND DATE(data_ida) > DATE('$today')");

                if ($resultStatusPassagem->num_rows > 0) {

                    $resultStatus = $resultStatusPassagem->fetch_array()[0];

                    $dataIda = date($resultStatus);

                    $today = date("Y-m-d H:i:s");

                    $dataInicio = new DateTime($dataIda);
                    $dataFim = new DateTime($today);

                    $dateInterval = $dataInicio->diff($dataFim);

                    if (($dateInterval->days) >= 1) {
                        
                        // pode cancelar

                        $select = "
                        <select>
                            <option selected>Pagar agora</option>
                            <option>Cancelar</option>
                        </select>
                        ";

                    } else {

                        // não pode cancela

                        $select = "Cancelada por falta de pagamento";

                    }
                } else {

                    $select = "Cancelada por falta de pagamento";
                }

            } else if ($assoc['status_passagem'] == 'cancelada') {

                $select = "---";
            }

            // ----------------------------------------------- //
            // ----------------------------------------------- //
            
            // Query para buscar o aeroporto referente a origem e destino

            $queryAeroportoOrigem = $conn->query("SELECT nome_cidade FROM aeroporto
            INNER JOIN voo 
            ON '$assoc[origem]' = aeroporto.id_aeroporto
            INNER JOIN cidade
            ON cidade.id_cidade = aeroporto.fk_cidade");

            $AeroportoOrigem = $queryAeroportoOrigem->fetch_array()[0];

            $queryAeroportoDestino = $conn->query("SELECT nome_cidade FROM aeroporto
            INNER JOIN voo 
            ON '$assoc[destino]' = aeroporto.id_aeroporto
            INNER JOIN cidade
            ON cidade.id_cidade = aeroporto.fk_cidade");

            $AeroportoDestino = $queryAeroportoDestino->fetch_array()[0];

            // ----------------------------------------------- //
            // ----------------------------------------------- //

            // Trocando o formato da data de AAAA-MM-DD para DD-MM-AAAA

            $dataIdaReplaceFormat = new DateTime($assoc['data_ida']);
            $dataIdaNewFormat = $dataIdaReplaceFormat->format('d-m-Y H:i:s');

            $dataChegadaReplaceFormat = new DateTime(($assoc['data_chegada']));
            $dataChegadaNewFormat = $dataChegadaReplaceFormat->format('d-m-Y H:i:s');

            // ----------------------------------------------- //
            // ----------------------------------------------- //

            $tbodyTr = $tbodyTr."
                <tr>
                    <td>$AeroportoOrigem</td>
                    <td>$AeroportoDestino</td>
                    <td>$dataIdaNewFormat</td>
                    <td>$dataChegadaNewFormat</td>
                    <td>R$ $assoc[preco_final]</td>
                    <td>$assoc[status_passagem]</td>
                    <td>$select</td>
                </tr>";
        }

        $template = "
        <div class='request-shows-travels'>
            <table>
                <thead>
                    ".$theadTr."
                </thead>
                <tbody>
                    ".$tbodyTr."
                </tbody>
            </table>
        </div>
        ";

        break;
    
    default:
        # code...
        break;
}

if ($template != '') {

    echo(json_encode($template));
} else {
    echo('Um erro aconteceu!');
}

?>