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
    <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Selecionar assento - Nefelus SkyWays</title>
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- GOOGLE FONTS -->
    <!-- Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- Roboto Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/selecionar_assento/style.css">
    <link rel="stylesheet" href="../../assets/css/selecionar_assento/media.css">
</head>

<?php

include_once "../../ops/db.php";

?>

<body>
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
                    <a href="./reservar_passagem/reservar_passagem.php" class="text-sm font-semibold leading-6 text-white in-page">Registrar passageiro</a>
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
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white in-page">Registrar passageiro</a>
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

    <main>
        <form action="./resumo_compra.php" method="post">
            <section class="color-information-area">
                <div>
                    <ul class="color-legend">
                        <li class="available">Disponível</li>
                        <li class="unavailable">Ocupado</li>
                        <li class="selected">Selecionado</li>
                        <li class="premium">Premium</li>
                    </ul>
                </div>

                <div class="occupant-info">
                    
                    <span id='span-info'>
                    <?php

                    $passageiro_adulto = $_POST['adult-passenger'];
                    $passageiro_crianca = $_POST['child-passenger'];
                    $passageiro_bebe = $_POST['baby-passenger'];

                    $total_assentos = $passageiro_adulto + $passageiro_crianca;

                    $flightId = $_POST['flight-selected'];


                    for($i = 0; $i < $total_assentos; $i++) {
                        $infoPassageiro = array();

                        $infoPassageiro['p_nome'] = $_POST['first-name-passenger-'.$i];
                        $infoPassageiro['s_nome'] = $_POST['last-name-passenger-'.$i];
                        $infoPassageiro['data_nasc'] = $_POST['date-of-birth-passenger-'.$i];
                        $infoPassageiro['genero'] = $_POST['gender-passenger-'.$i];
                        $infoPassageiro['passaporte'] = $_POST['passport-passenger-'.$i];
                        $infoPassageiro['nacionalidade'] = @$_POST['nationality-passenger-'.$i];
                        $infoPassageiro['cpf'] = @$_POST['cpf-passenger-'.$i];
                        $infoPassageiro['sem_cpf'] = @$_POST['no-cpf-passenger-'.$i];
                        

                        $passageiro[$i] = $infoPassageiro;
                    }

                    echo "(0/$total_assentos) - ".$passageiro[0]['p_nome'];
                    
                    ?>
                    </span>

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
                        echo '<input type="hidden" id="no-cpf-passenger-'.$i.'" name="no-cpf-passenger-'.$i.'" value="'.$passageiro[$i]['sem_cpf'].'">';

                        echo '<input type="hidden" id="price-seat-'.$i.'" name="price-seat-'.$i.'" value="">';
                        echo '<input type="hidden" id="seat-'.$i.'" name="seat-'.$i.'" value="">';
                        echo '</div>';
                    }

                    echo '</div>';

                    echo '<input type="hidden" id="flight-selected" name="flight-selected" value="'.$flightId.'">';
                    ?>

                    <input type="hidden" name="" id="passenger-count" value="0">
                    <input type="hidden" id="total-passenger" name="total-passenger" value="<?php echo $total_assentos; ?>">
                    <input type="hidden" id="adult-passenger" name="adult-passenger" value="<?php echo $_POST['adult-passenger']; ?>">
                    <input type="hidden" id="child-passenger" name="child-passenger" value="<?php echo $_POST['child-passenger']; ?>">
                    <input type="hidden" id="baby-passenger" name="baby-passenger" value="<?php echo $_POST['baby-passenger']; ?>">
                </div>
            </section>
        
            <section class="seats-area">
                <div class="seats-wrapper">

                <?php
                $letras = range('A', 'S');

                $id_voo = $_POST['flight-selected'];

                $query_assentos_ocupados = "SELECT * from passagem where fk_voo = $id_voo";
                $query_assentos_ocupados = mysqli_query($conn, $query_assentos_ocupados);

                if ($query_assentos_ocupados) {
                    $assentos_ocupados = mysqli_fetch_all($query_assentos_ocupados, MYSQLI_ASSOC);
                    $rows_count = count($assentos_ocupados);
                
                    if ($rows_count > 0) {
                        $assentos_ocupados = array_column($assentos_ocupados, 'local_assento');
                    }
                }

                for($fileira = 1; $fileira < 4; $fileira++) {

                    switch ($fileira) {
                        case 1:
                            echo '<div class="seats-left">';
                            break;
                        case 2:
                            echo '<div class="seats-mid">';
                            break;
                        case 3:
                            echo '<div class="seats-right">';
                    }

                    foreach ($letras as $letra) {

                        switch ($fileira) {
                            case 1: $start = 1; $stop = 4;
                                break;
                            case 2: $start = 4; $stop = 6;
                                break;
                            case 3: $start = 6; $stop = 9;
                        }

                        $index = array_search($letra, $letras);
                        
                        if ($index < 7) {
                            echo '<div class="seats-row premium">';
                        } else { 
                            echo '<div class="seats-row">';
                        }

                        for($i = $start; $i < $stop; $i++) {
                            if (array_search(($letra.$i), $assentos_ocupados) !== false) {
                                $ocupacao = "unavailable";
                            } else {
                                $ocupacao = "";
                            }
                            echo 
                            '<div id="'.$letra.$i.'" class="seat '.$ocupacao.'">'.$letra.'-'. $i.'</div>';
                        }

                        echo '</div>';
                    }

                    echo '</div>';
                }

                ?>
                    
                </div>
            </section>
        
            <section class="next-step">
                <div class="btn-next-step">
                    <input type="submit" value="IR PARA O RESUMO DA COMPRA">
                </div>
            </section>
        </form>
    
        <!-- MODAL -->
    
        <div id="fade" class="hide"></div>
        <div id="modal" class="hide">
            <div class="modal-header">
                <h2>Detalhes do assento selecionado</h2>
                <i class="bi bi-x-lg" id="close-modal"></i>
            </div>
            <div class="modal-body">
                <div class="info-seat">
                    <span>Ocupante: <span class="seat-occupant">Marcelo Costa</span></span>
                    <span>Assento: <span class="seat-id">Selecione um assento</span></span>
                    <span>Tipo: <span class="seat-type">Selecione um assento</span></span>
                    <span>Preço: <span class="seat-price">Selecione um assento</span></span>
                </div>
                <div class="btn-confirm">
                    <button type="button">Confimar</button>
                </div>
            </div>
        </div>
    
        <!-- FIM MODAL -->
    </main>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="../../assets/js/selecionar_assento/assentoDinamico.js"></script>
    <script src="../../assets/js/selecionar_assento/modal.js"></script>
    <script src="../../assets/js/selecionar_assento/formValidation.js"></script>

    <script src="../../assets/js/mobileMenu.js"></script>

</body>
</html>
