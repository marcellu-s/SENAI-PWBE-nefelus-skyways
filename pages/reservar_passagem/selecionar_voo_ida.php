<?php
session_start();

if (isset($_SESSION['login'])) {
    // OK - Pode entrar chefe!
} else {
    header("location: ../login.php");
}

date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Selecionar voo IDA - Nefelus SkyWays</title>
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/selecionar_voo/modal.css">
    <link rel="stylesheet" href="../../assets/css/selecionar_voo/style.css">
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
                    <a href="./reservar_passagem/reservar_passagem.php" class="text-sm font-semibold leading-6 text-white in-page">Selecionar voo</a>
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
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white in-page">Selecionar voo</a>
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

    <!-- Modal - Detalhes do voo -->
    <div id="fade" class="hide"></div>
    <div id="modal" class="hide">
        <div class="modal-header">
            <h2>Detalhes do voo de ida</h2>
            <i class="bi bi-x-lg" id="close-modal"></i>
        </div>
        <div class="modal-body">
            <div class="duration">
                <span>Duração da viagem - 02:20h</span>
            </div>
            <div class="flight-id">
                <span>NF 1572</span>
            </div>
            <div class="travel-from-and-going-to-wrapper">
                <div class="travel-from-content">
                    <div class="travel-from-title">
                        <span>SAINDO DE</span>
                        <span>DATA</span>
                    </div>
                    <div class="travel-from-info">
                        <span id="travel-from-info-location">São Paulo - Congonhas/CGH</span>
                        <span id="travel-from-info-datetime">21/04 ás 06:05</span>
                    </div>
                </div>
                <div class="going-to-content">
                    <div class="going-to-title">
                        <span>INDO PARA</span>
                        <span>DATA</span>
                    </div>
                    <div class="going-to-info">
                        <span id="going-to-info-location">Salvador - Aer. Inter. de Salvador/SSA</span>
                        <span id="going-to-info-datetime">21/04 ás 08:25</span>
                    </div>
                </div>
            </div>
            <div class="airplane-info">
                <span>Avião: Boing 737-800</span>
            </div>
        </div>
    </div>
    <!-- Fim modal -->

    <main>
        <section class="choose-your-flight">
            <div class="cyf-title">
                <h1>Escolha seu voo de ida</h1>
            </div>


            <form class="cyf-content" action="./registrar_passageiro.php" method="post">
                <input type="hidden" id="adult-passenger" name="adult-passenger" value="<?php echo $_POST['adult-passenger'];?>">
                <input type="hidden" id="child-passenger" name="child-passenger" value="<?php echo $_POST['child-passenger']; ?>">
                <input type="hidden" id="baby-passenger" name="baby-passenger" value="<?php echo $_POST['baby-passenger'];?>">

            <?php

            $trecho = $_POST['trecho'];
            $origem = $_POST['travel-from'];
            $destino = $_POST['going-to'];
            $saida = $_POST['outbound'];
            $retorno = $_POST['return'];

            include_once "../../ops/db.php";

            // ID AEROPORTO ORIGEM
            $query_id = mysqli_query($conn, "SELECT id_aeroporto FROM aeroporto where nome = '$origem'");
            $id_origem = mysqli_fetch_assoc($query_id); 
            $id_origem = $id_origem['id_aeroporto'];

            // ID AEROPORTO DESTINO
            $query_id = mysqli_query($conn, "SELECT id_aeroporto FROM aeroporto where nome = '$destino'");
            $id_destino = mysqli_fetch_assoc($query_id); 
            $id_destino = $id_destino['id_aeroporto'];

            $query_voos = "SELECT voo.*, assento.*,
            origem.nome AS origem_nome, origem.sigla AS sigla_origem,
            destino.nome AS destino_nome, destino.sigla AS sigla_destino,
            aviao.matricula AS matricula
            FROM voo
            JOIN aeroporto AS origem ON voo.origem = origem.id_aeroporto
            JOIN aeroporto AS destino ON voo.destino = destino.id_aeroporto
            INNER JOIN assento ON assento.id_assento = voo.fk_assento
            INNER JOIN aviao ON aviao.id_aviao = voo.aviao
            WHERE origem = $id_origem AND destino = $id_destino AND date(data_ida) = '$saida'";

            $result_voos = mysqli_query($conn, $query_voos);

            while ($row = mysqli_fetch_assoc($result_voos)) {

                $assentos_ocupados = "SELECT COUNT(*) AS qnt_assentos from passagem WHERE fk_voo =". $row['id_voo'];
                $assentos_ocupados = mysqli_fetch_assoc(mysqli_query($conn, $assentos_ocupados));
                $assentos_ocupados = $assentos_ocupados['qnt_assentos'];

                $assentos_restantes = 200 - $assentos_ocupados;

                echo '
                <div class="flights-wrapper">
                    <div class="flight">
                        <input type="radio" name="flight-selected" id="" class="input-flight" value="' . $row['id_voo'] . '">'
                        .( 
                        $trecho == "round-trip"
                        ? 
                        '<input type="hidden" id="trecho" name="trecho" value="'. $trecho .'">'.
                        '<input type="hidden" id="travel-from" name="travel-from" value="'. $origem .'">'.
                        '<input type="hidden" id="going-to" name="going-to" value="'. $destino .'">'.
                        '<input type="hidden" id="outbound" name="outbound" value="'. $saida .'">'.
                        '<input type="hidden" id="return" name="return" value="'. $retorno .'">'
                        : 
                        ""
                        ).
                        '<div class="flight-item-content">
                            <span>ORIGEM</span>
                            <span>' . $row['sigla_origem'] . ' - ' . $row['origem_nome'] . '</span>
                        </div>
                        <div class="flight-item-content">
                            <span>DESTINO</span>
                            <span>' . $row['sigla_destino'] . ' - ' . $row['destino_nome'] . '</span>
                        </div>
                        <div class="flight-item-content">
                            <span>DURAÇÃO</span>
                            <span>' . $row['duracao'] . '</span>
                        </div>
                        <div class="flight-item-content">
                            <span>VOO</span>
                            <span class="open-modal">'. $row['matricula'] .' / ' . ($row['escala'] == 0 ? "DIRETO" : "COM CONEXÃO") . '</span>
                        </div>
                        <div class="flight-item-content">
                            <span>ASSENTOS</span>
                            <span>'. $assentos_restantes .' restantes</span>
                        </div>
                        <div class="flight-item-content">
                            <span>PREÇO INICIAL</span>
                            <span>' . $row['preco_economico'] . '</span>
                        </div>
                    </div>
                </div>';
            }
            
            ?>

                <div class="next-step-btn">
                    <button type="submit">IR PARA DADOS DO PASSAGEIRO</button>
                </div>
            </form>

        </section>
    </main>

    <div class="to-top-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#999" class="bi bi-arrow-up-square"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
        </svg>
    </div>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="../../assets/js/selecionar_voo/formValidation.js"></script>
    <script src="../../assets/js/selecionar_voo/btnToTop.js"></script>
    <script src="../../assets/js/selecionar_voo/ajaxRequestForModalDetails.js"></script>
</body>

</html>
