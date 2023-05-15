<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - Nefelus SkyWays</title>
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/registrar_passageiro/style.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/resumo_compra/style.css">
</head>
<body>
    <!-- HEADER -->
    
    <header>
        <div id="navbar">
            <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="../../index.php" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-12 w-auto" src="../../assets/img/icons/logo.png" alt="">
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white"
                        id="open-menu">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="../../index.php" class="text-sm font-semibold leading-6 text-white">Início</a>
                    <a href="./reservar_passagem/reservar_passagem.php" class="text-sm font-semibold leading-6 text-white in-page">Pagamento</a>
                    <a href="../ofertas.php" class="text-sm font-semibold leading-6 text-white">Ofertas</a>
                    <a href="../contato.php" class="text-sm font-semibold leading-6 text-white">Contato</a>
                    <?php
                    if (isset($_SESSION['login']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'comum')) {
                        echo("<a href='../../admin/pages/main.php' class='text-sm font-semibold leading-6 text-white'>Área de trabalho</a>");
                    } else if (isset($_SESSION['login'])) {
                        echo("<a href='../../client/pages/myAccount.php' class='text-sm font-semibold leading-6 text-white'>Meu perfil</a>");
                    }
                    ?>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <?php 
                    if (isset($_SESSION['login'])) {
                        echo("<a href='../../assets/php/logoutProcess.php?logout=true' class='text-sm font-semibold leading-6 text-white mr-8'>Deslogar<span aria-hidden='true'>&rarr;</span></a>");
                    } else {
                        echo("<a href='../login.php' class='text-sm font-semibold leading-6 text-white mr-8'>Entrar<span aria-hidden='true'>&rarr;</span></a>");
                    }
                    ?>
                </div>
            </nav>
            <!-- Mobile menu, show/hide based on menu open state. -->
            <div class="lg:hidden hidden" role="dialog" aria-modal="true" id="mobile-menu">
                <!-- Background backdrop, show/hide based on slide-over state. -->
                <div class="fixed inset-0 z-10"></div>
                <div
                    class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-mobile-menu px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="../../index.php" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-12 w-auto" src="../../assets/img/icons/logo.png" alt="">
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-white" id="close-menu">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-white">
                            <div class="space-y-2 py-6">
                                <a href="../../index.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Início</a>
                                <a href="../../pages/reservar_passagem/reservar_passagem.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white in-page">Pagamento</a>
                                <a href="../../pages/ofertas.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Ofertas</a>
                                <a href="../../pages/contato.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Contato</a>
                                <?php
                                if (isset($_SESSION['login']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'comum')) {
                                    echo("<a href='../../admin/pages/main.php' class='-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white'>Área de trabalho</a>");
                                } else if (isset($_SESSION['login'])) {
                                    echo("<a href='../../client/pages/myAccount.php' class='-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white'>Meu perfil</a>");
                                }
                                ?>
                            </div>
                            <div class="py-6">
                                <?php 
                                if (isset($_SESSION['login'])) {
                                    echo("<a href='../../assets/php/logoutProcess.php?logout=true' class='text-sm font-semibold leading-6 text-white mr-8'>Deslogar<span aria-hidden='true'>&rarr;</span></a>");
                                } else {
                                    echo("<a href='../login.php' class='text-sm font-semibold leading-6 text-white mr-8'>Entrar<span aria-hidden='true'>&rarr;</span></a>");
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- END -->

    <?php

    include_once "../../ops/db.php";

    $id_voo = $_POST['flight-selected'];
    $id_voo_retorno = $_POST['return-flight-selected'];

    $query_voo = "SELECT voo.*, 
    cidade_origem.nome_cidade AS cidade_origem, 
    origem.nome AS aero_origem, origem.sigla AS sigla_origem,
    cidade_destino.nome_cidade AS cidade_destino,
    destino.nome AS aero_destino, destino.sigla AS sigla_destino,
    assento.preco_economico AS economico, assento.preco_premium AS premium,
    aviao.*
    FROM voo
    JOIN aeroporto AS origem ON voo.origem = origem.id_aeroporto
    JOIN cidade AS cidade_origem ON origem.fk_cidade = cidade_origem.id_cidade
    JOIN aeroporto AS destino ON voo.destino = destino.id_aeroporto
    JOIN cidade AS cidade_destino ON destino.fk_cidade = cidade_destino.id_cidade
    INNER JOIN assento ON assento.id_assento = voo.fk_assento
    INNER JOIN aviao ON aviao.id_aviao = voo.aviao
    WHERE voo.id_voo = $id_voo";

    $query_voo_retorno = "SELECT voo.*, 
    cidade_origem.nome_cidade AS cidade_origem, 
    origem.nome AS aero_origem, origem.sigla AS sigla_origem,
    cidade_destino.nome_cidade AS cidade_destino,
    destino.nome AS aero_destino, destino.sigla AS sigla_destino,
    assento.preco_economico AS economico, assento.preco_premium AS premium,
    aviao.*
    FROM voo
    JOIN aeroporto AS origem ON voo.origem = origem.id_aeroporto
    JOIN cidade AS cidade_origem ON origem.fk_cidade = cidade_origem.id_cidade
    JOIN aeroporto AS destino ON voo.destino = destino.id_aeroporto
    JOIN cidade AS cidade_destino ON destino.fk_cidade = cidade_destino.id_cidade
    INNER JOIN assento ON assento.id_assento = voo.fk_assento
    INNER JOIN aviao ON aviao.id_aviao = voo.aviao
    WHERE voo.id_voo = $id_voo_retorno";

    // QUERY VOOS
    $query_voo = mysqli_query($conn, $query_voo);
    $info_voo = mysqli_fetch_assoc($query_voo);

    $query_voo_retorno = mysqli_query($conn, $query_voo_retorno);
    $info_voo_retorno = mysqli_fetch_assoc($query_voo_retorno);


    // QNT CADA TIPO DE PASSAGEIRO
    $passageiro_adulto = $_POST['adult-passenger'];
    $passageiro_crianca = $_POST['child-passenger'];
    $passageiro_bebe = $_POST['baby-passenger'];

    $total_assentos = $passageiro_adulto + $passageiro_crianca;

    $precoTotal = 0;

    // INFO DOS PASSAGEIROS
    for($i = 0; $i < $total_assentos; $i++) {
        $infoPassageiro = array();

        $infoPassageiro['p_nome'] = $_POST['first-name-passenger-'.$i];
        $infoPassageiro['s_nome'] = $_POST['last-name-passenger-'.$i];
        $infoPassageiro['data_nasc'] = $_POST['date-of-birth-passenger-'.$i];
        $infoPassageiro['genero'] = $_POST['gender-passenger-'.$i];
        $infoPassageiro['passaporte'] = $_POST['passport-passenger-'.$i];
        $infoPassageiro['nacionalidade'] = @$_POST['nationality-passenger-'.$i];
        $infoPassageiro['cpf'] = @$_POST['cpf-passenger-'.$i];
        // $infoPassageiro['sem_cpf'] = @$_POST['no-cpf-passenger-'.$i];

        $infoPassageiro['price_seat_1'] = $_POST['price-seat-1-'.$i];
        $infoPassageiro['price_seat_2'] = $_POST['price-seat-2-'.$i];

        $infoPassageiro['assento_1'] = $_POST['seat-1-'.$i];
        $infoPassageiro['assento_2'] = $_POST['seat-2-'.$i];

        $passageiro[$i] = $infoPassageiro;
    }

    ?>

    <main>
        <section class="purchase-summary-area">
            <div class="purchase-summary-header">
                <h1>Resumo da compra</h1>
            </div>
            <div class="purchase-summary-flight-info">
                
                        <?php
                        
                        // SE O ID DO VOO DE RETORNO EXISTIR, O NUMERO DE VOOS VAI SER 2 (IDA E VOLTA)
                        if (isset($id_voo_retorno)) {
                            $num_voos = 2;
                        } else {
                            $num_voos = 1;
                        }

                        for($voo = 0; $voo < $num_voos; $voo++) {

                            echo '
                            <div class="flight-info-content">
                    <span class="flight-id">'. 'Vôo - '. ($voo == 0 ? $id_voo . " -- Saída" : $id_voo_retorno . " -- Retorno") .' </span>
                    <span class="flight-duration">'. "Duração - ". ($voo == 0 ? $info_voo['duracao'] : $info_voo_retorno['duracao']) .'</span>
                    <div class="flight-location travel-from">
                        <div class="flight-location-header">
                            <span>SAINDO DE </span>
                            <span>DATA</span>
                        </div>
                        <div class="flight-location-content">
                            <span>'. ($voo == 0 ? $info_voo['cidade_origem'] : $info_voo_retorno['cidade_origem']) .'</span>
                            <span>'. ($voo == 0 ? $info_voo['data_ida'] : $info_voo_retorno['data_ida']) .'</span>
                        </div>
                    </div>
                    <div class="flight-location going-to">
                        <div class="flight-location-header">
                            <span>INDO PARA</span>
                            <span>DATA</span>
                        </div>
                        <div class="flight-location-content">
                            <span>'. ($voo == 0 ? $info_voo['cidade_destino'] : $info_voo_retorno['cidade_destino']) .'</span>
                            <span>'. ($voo == 0 ? $info_voo['data_chegada'] : $info_voo_retorno['data_chegada']) .'</span>
                        </div>
                    </div>
                </div>
                <div class="passengers-info-area">
                    <div class="passengers-info-header">
                        <h2>Passageiros</h2>
                    </div>
                    <div class="passengers-wrapper">';

                            for($i = 0; $i < $total_assentos; $i++) {

                                echo '
                                <div class="passenger">
                                    <span><strong>Número do passageiro: '. $i + 1 .'</strong></span>
                                    <span>Nome do passageiro: ' . $passageiro[$i]['p_nome'].' '.$passageiro[$i]['s_nome'] . '</span>
                                    <span><strong>Assento:</strong> '.($voo == 0 ? $passageiro[$i]['assento_1'] : $passageiro[$i]['assento_2']).'</span>
                                    <span><strong>Preço do assento: </strong> '. 
                                    (ord(substr(($voo == 0 ? $passageiro[$i]['assento_1'] : $passageiro[$i]['assento_2']), 0, 1)) - 96 < 104 ? 
                                    ($voo == 0 ? $info_voo['economico'] : $info_voo_retorno['economico'])
                                    :
                                    ($voo == 0 ? $info_voo['premium'] : $info_voo_retorno['premium'])
                                    )
                                    .'</span>
                                    <span><strong>Valor da passagem: (individual): </strong>'.
                                    (ord(substr(($i == 0 ? $passageiro[$i]['assento_1'] : $passageiro[$i]['assento_2']), 0, 1)) - 96 < 104 ? 
                                    ($voo == 0 ? $info_voo['economico'] : $info_voo_retorno['economico'])
                                    :
                                    ($voo == 0 ? $info_voo['premium'] : $info_voo_retorno['premium'])
                                    )
                                    .'</span>
                                </div>';
    
                                $precoTotal += 
                                (ord(substr(($i == 0 ? $passageiro[$i]['assento_1'] : $passageiro[$i]['assento_2']), 0, 1)) - 96 < 104 
                                ? 
                                ($voo == 0 ? $info_voo['economico'] : $info_voo_retorno['economico'])
                                :
                                ($voo == 0 ? $info_voo['premium'] : $info_voo_retorno['premium'])
                                );
                            }
                            echo '<hr>';
                        }
                        
                        ?>
                         
                    </div>
                </div>
                <div class="ticket-full-price-area">
                    <div class="ticket-full-price-header">
                        <h2>Valor total da viagem</h2>
                    </div>
                    <div class="ticket-full-price">
                        <span><?php echo $precoTotal ?></span>
                    </div>
                </div>
                <form method="post" action="../../ops/passagem.php" class="form-payment-area">

                    <?php

                        echo '<div class="info-passageiros">';

                        for($i = 0; $i < $total_assentos; $i++) {

                            echo '<div class="info-passageiro">';
                                echo '<input type="hidden" id="first-name-passenger-'.$i.'" name="first-name-passenger-'.$i.'" value="'.$passageiro[$i]['p_nome'].'">';
                                echo '<input type="hidden" id="last-name-passenger-'.$i.'" name="last-name-passenger-'.$i.'" value="'.$passageiro[$i]['s_nome'].'">';
                                
                                echo '<input type="hidden" id="date-of-birth-passenger-'.$i.'" name="date-of-birth-passenger-'.$i.'" value="'.$passageiro[$i]['data_nasc'].'">';
                                echo '<input type="hidden" id="gender-passenger-'.$i.'" name="gender-passenger-'.$i.'" value="'.$passageiro[$i]['genero'].'">';
                                
                                echo '<input type="hidden" id="passport-passenger-'.$i.'" name="passport-passenger-'.$i.'" value="'.$passageiro[$i]['passaporte'].'">';
                                echo '<input type="hidden" id="nationality-passenger-'.$i.'" name="nationality-passenger-'.$i.'" value="'.$passageiro[$i]['nacionalidade'].'">';
                                
                                echo '<input type="hidden" id="cpf-passenger-'.$i.'" name="cpf-passenger-'.$i.'" value="'.$passageiro[$i]['cpf'].'">';
                                // echo '<input type="hidden" id="no-cpf-passenger-'.$i.'" name="no-cpf-passenger-'.$i.'" value="'.$passageiro[$i]['sem_cpf'].'">';
                                
                                // PREÇO DO ASSENTO 1
                                echo '<input type="hidden" id="price-seat-1-'.$i.'" name="price-seat-1-'.$i.'" value="'.
                                (ord(substr($passageiro[$i]['assento_1'], 0, 1)) - 96 < 104 ? 
                                    ($info_voo['economico'])
                                    :
                                    ($info_voo['premium'])
                                )
                                .'">';

                                // PREÇO DO ASSENTO 2
                                echo '<input type="hidden" id="price-seat-2-'.$i.'" name="price-seat-2-'.$i.'" value="'.
                                (ord(substr($passageiro[$i]['assento_2'], 0, 1)) - 96 < 104 ? 
                                    ($info_voo_retorno['economico'])
                                    :
                                    ($info_voo_retorno['premium'])
                                )
                                .'">';
                                
                                echo '<input type="hidden" id="seat-1-'.$i.'" name="seat-1-'.$i.'" value="'.$passageiro[$i]['assento_1'].'">';
                                echo '<input type="hidden" id="seat-2-'.$i.'" name="seat-2-'.$i.'" value="'.$passageiro[$i]['assento_2'].'">';
                            
                            echo '</div>';
                        }

                        echo '<input type="hidden" id="flight-selected" name="flight-selected" value="'.$id_voo.'">';
                        echo '<input type="hidden" id="return-flight-selected" name="return-flight-selected" value="6">';
                        
                    ?>
                        <input type="hidden" id="total-passenger" name="total-passenger" value="<?php echo $total_assentos; ?>">
                        <input type="hidden" id="adult-passenger" name="adult-passenger" value="<?php echo $_POST['adult-passenger']; ?>">
                        <input type="hidden" id="child-passenger" name="child-passenger" value="<?php echo $_POST['child-passenger']; ?>">
                        <input type="hidden" id="baby-passenger" name="baby-passenger" value="<?php echo $_POST['baby-passenger']; ?>">

                    </div>

                    <div class="form-payment-header">
                        <label for="form-payment">Selecione a forma de pagamento</label>
                    </div>
                    <div class="dropdown-form-payment">
                        <div class="input-with-icon">
                            <input type="text" name="form-payment" id="form-payment" placeholder="Selecione uma opção" required>
                            <img class="input-icon" src="../../assets/img/icons/down-arrow-backup-2-svgrepo-com.svg" alt="">
                        </div>
                        <ul class="dropdown-form-payment-menu">
                            <select name="" class="dropdown-form-payment-menu" id=""></select>
                            <li class="dropdown-item">Cartão de crédito</li>
                            <li class="dropdown-item">Cartão de débito</li>
                            <li class="dropdown-item">PIX</li>
                        </ul>
                    </div>
                    <div class="form-payment-btn">
                        <button type="submit">Finalizar compra</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!-- JavaScript -->
    <script src="../../assets/js/mobileMenu.js"></script>
    <script src="../../assets/js/resumo_compra/dropdown.js"></script>

    <script>

        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {

            const inputPayment = document.querySelector('#form-payment');

            event.preventDefault();

            if (inputPayment.value == '') {

                window.alert('Selecione uma opção de pagamento!');
                return;
            }

            inputPayment.value = inputPayment.value.toLocaleLowerCase();

            form.submit();
        });

    </script>
</body>
</html>
