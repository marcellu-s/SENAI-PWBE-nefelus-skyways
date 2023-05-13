<?php

include_once "./db.php";

$id_voo = $_POST['flight-selected'];
$id_voo_retorno = $_POST['return-flight-selected'];

$passageiro_adulto = $_POST['adult-passenger'];
$passageiro_crianca = $_POST['child-passenger'];
$passageiro_bebe = $_POST['baby-passenger'];

$id_cadastro; /// MUDAR PARA SESSION DEPOIS DE ATIVAR O SISTEMA DE CONTAS/CADASTRO

$total_assentos = $passageiro_adulto + $passageiro_crianca;
$total_passageiros = $passageiro_adulto + $passageiro_crianca + $passageiro_bebe;

$precoTotal = 0;

// VAI PEGAR SÓ A PRIMEIRA LETRA DO TIPO DE PAGAMENTO: EX: PIX (P), CARTAO DE CREDITO (C), CARTAO DE DEBITO (D)
$tipoPagamento = trim($_POST['form-payment']); // trim: remove os espaços em branco
$tipoPagamento = explode(" ", $tipoPagamento);
$tipoPagamento = substr(($tipoPagamento[count($tipoPagamento) - 1]), 0, 1);
$tipoPagamento = strtoupper($tipoPagamento);

$data_pagamento = date('Y-m-d'); // SE FOR TER A OPCAO DE PAGAMENTO PENDENTE VAI VARIAR AQUI

for($i = 0; $i < $total_passageiros; $i++) {
    $infoPassageiro = array();

    $infoPassageiro['p_nome'] = $_POST['first-name-passenger-'.$i];
    $infoPassageiro['s_nome'] = $_POST['last-name-passenger-'.$i];
    $infoPassageiro['data_nasc'] = $_POST['date-of-birth-passenger-'.$i];
    $infoPassageiro['genero'] = $_POST['gender-passenger-'.$i];
    $infoPassageiro['passaporte'] = $_POST['passport-passenger-'.$i];
    $infoPassageiro['nacionalidade'] = $_POST['nationality-passenger-'.$i];
    $infoPassageiro['cpf'] = $_POST['cpf-passenger-'.$i];

    $infoPassageiro['price_seat_1'] = $_POST['price-seat-1-'.$i];
    $infoPassageiro['price_seat_2'] = $_POST['price-seat-2-'.$i];

    $precoTotal += (int) $infoPassageiro['price_seat_1'];
    $precoTotal += (int) $infoPassageiro['price_seat_2'];

    $infoPassageiro['assento_1'] = $_POST['seat-1-'.$i];
    $infoPassageiro['assento_2'] = $_POST['seat-2-'.$i];

    $passageiro[$i] = $infoPassageiro;
}

$query_pagamento = "INSERT INTO pagamento (id_pagamento, valor_pagamento, tipo, data_pagamento, fk_cadastro) VALUES ";
$query_pagamento .= "(default, $precoTotal, '$tipoPagamento', '$data_pagamento', $id_cadastro)";

if (isset($data_pagamento)) {
    $status_passagem = 'paga';
} else {
    $status_passagem = 'não paga';
}

echo $query_pagamento;

$query_pagamento = mysqli_query($conn, $query_pagamento);
$id_pagamento = mysqli_insert_id($conn);

$query_passagens = "INSERT INTO passagem (id_passagem, preco_final, status_passagem, local_assento, fk_voo, fk_passageiro, fk_pagamento) VALUES";

for($i = 0; $i < $total_passageiros; $i++) {
    
    // VERIFICA SE JÁ POSSUI O CPF CADASTRADO
    $verif_pessoa = "SELECT COUNT(*) AS qnt_cpf_passaporte FROM pessoa where " .
    ((isset($passageiro[$i]['passaporte']) 
    ? 
    " passaporte = '" . $passageiro[$i]['passaporte'] . "'" 
    :
    " cpf = '". $passageiro[$i]['cpf']. "'"
    ));
    echo $verif_pessoa."<br>".'----->';
    $verif_pessoa = mysqli_query($conn, $verif_pessoa);
    
    $verif_pessoa = mysqli_fetch_assoc($verif_pessoa);

    if ($verif_pessoa['qnt_cpf_passaporte'] == 0) {
        $add_pessoa = "INSERT INTO pessoa (id_pessoa, p_nome, p_sobrenome, data_nasc, sexo, nacionalidade, cpf, passaporte) VALUES";
        $add_pessoa .= " (default, '".$passageiro[$i]['p_nome']."', '".$passageiro[$i]['s_nome']."', '".$passageiro[$i]['data_nasc']."',
        '".substr($passageiro[$i]['genero'], 0, 1)."', '".substr($passageiro[$i]['nacionalidade'], 0, 3)."', '".$passageiro[$i]['cpf']."',
        '".$passageiro[$i]['passaporte']."')";

        echo $add_pessoa."<br>";

        $add_pessoa = mysqli_query($conn, $add_pessoa);

        $id_pessoa = mysqli_insert_id($conn);

    } else {
        $query_id_pessoa = mysqli_query($conn, "SELECT id_pessoa FROM pessoa where " .
        (isset($passageiro[$i]['passaporte']) 
        ? 
        " passaporte = '" . $passageiro[$i]['passaporte'] . "'" 
        :
        " cpf = '". $passageiro[$i]['cpf']. "'"
        ));

        $id_pessoa = mysqli_fetch_assoc($query_id_pessoa);
        $id_pessoa = $id_pessoa['id_pessoa'];
    }


    if (isset($id_voo_retorno)) {
        $num_voos = 2;
        $voos[0] = $id_voo;
        $voos[1] = $id_voo_retorno;
    } else {
        $num_voos = 1;
        $voos[0] = $id_voo;
    }
    echo $num_voos."<br>";

    for($voo = 0; $voo < $num_voos; $voo++) {
        $query_passagens .= " (default, ".$passageiro[$i]['price_seat_'.($i + 1)].", '$status_passagem', '".
        $passageiro[$i]['assento_'.($i + 1)]."', $voos[$i], $id_pessoa, $id_pagamento)";
        echo $i."<br>";
        if ($voo != $num_voos - 1) {
            $query_passagens .= ', ';
        } else {
        }
    }
    echo $query_passagens;
}


$result_passagens = mysqli_query($conn, $query_passagens);
