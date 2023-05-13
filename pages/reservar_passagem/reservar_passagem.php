<?php

date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Reservar passagem - Nefelus SkyWays</title>
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/reservar_passagem/style.css">
    <link rel="stylesheet" href="../../assets/css/reservar_passagem/inputsearch.css">
</head>
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
                    <a href="../../pages/reservar_passagem/reservar_passagem.php" class="text-sm font-semibold leading-6 text-white in-page">Reservar passagem</a>
                    <a href="../../pages/ofertas.html" class="text-sm font-semibold leading-6 text-white">Ofertas</a>
                    <a href="../../pages/contato.html" class="text-sm font-semibold leading-6 text-white">Contato</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="../../pages/login.php" class="text-sm font-semibold leading-6 text-white mr-8">Entrar<span aria-hidden="true">&rarr;</span></a>
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
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white in-page">Reservar passagem</a>
                                <a href="../../pages/ofertas.html"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Ofertas</a>
                                <a href="../../pages/contato.html"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Contato</a>
                            </div>
                            <div class="py-6">
                                <a href="../../pages/login.php" class="text-sm font-semibold leading-6 text-white">Entrar<span aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="booking-area">
             <form action="./selecionar_voo.php" method="post"> <!-- Ir para Selecionar voo -->
                <div class="input-control input-trecho">
                    <div class="dropdown">
                        <button class="trigger-button" type="button">
                            <span>TRECHO</span>
                            <span id="input-trecho-selected">Ida e volta</span>
                            <img src="../../assets/img/icons/arrow-top.svg" alt="arrow">
                        </button>
                        <div class="dropdown-content">
                            <ul id="trecho">
                                <li><input type="radio" name="trecho" id="round-trip" value="round-trip" checked><label for="round-trip">Ida e volta</label></li>
                                <li><input type="radio" name="trecho" id="one-way" value="one-way"><label for="one-way">Só ida</label></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="input-control input-cliente">
                    <div class="dropdown">
                        <button class="trigger-button" type="button">
                            <span>CLIENTES</span>
                            <span id="input-cliente-selected">
                                <span id="adult" style="display: inline;">1 Adulto(s)</span>
                                <span id="kid" style="margin: 0 0.5rem; display: none;">1 Criança(s)</span>
                                <span id="baby" style="display: none;">1 Bebê(s)</span>
                            </span>
                            <img src="../../assets/img/icons/arrow-top.svg" alt="arrow">
                        </button>
                        <div class="dropdown-content">
                            <input type="hidden" id="adult-passenger" name="adult-passenger" value="1">
                            <input type="hidden" id="child-passenger" name="child-passenger" value="0">
                            <input type="hidden" id="baby-passenger" name="baby-passenger" value="0">
                            <ul id="cliente">
                                <li>
                                    <i class="bi bi-plus-circle-fill" id="add-adult"></i>
                                    <i class="bi bi-dash-circle-fill" id="remove-adult"></i>
                                    Adulto
                                </li>
                                <li>
                                    <i class="bi bi-plus-circle-fill" id="add-kid"></i>
                                    <i class="bi bi-dash-circle-fill" id="remove-kid"></i>
                                    Criança
                                </li>
                                <li>
                                    <i class="bi bi-plus-circle-fill" id="add-baby"></i>
                                    <i class="bi bi-dash-circle-fill" id="remove-baby"></i>
                                    Bebê
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="input-control input-travel-from">
                    <label for="travel-from">SAINDO DE</label>
                    <input type="text" name="travel-from" id="travel-from" required placeholder="De onde você deseja partir?">
                    <div class="input-search-area">
                    </div>
                </div>
                <div class="input-control input-going-to">
                    <label for="going-to">INDO PARA</label>
                    <input type="text" name="going-to" id="going-to" required placeholder="Para onde você quer ir?">
                    <div class="input-search-area">
                    </div>
                </div>
                <div class="input-control">
                    <label for="outbound">DATA DA VIAGEM DE IDA</label>
                    <input type="date" name="outbound" id="outbound" required min="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="input-control input-return">
                    <label for="return">DATA DA VIAGEM DE VOLTA</label>
                    <input type="date" name="return" id="return" required min="<?php echo date('Y-m-d') ?>">
                </div>
                <button type="submit" class="search-btn">BUSCAR VOOS</button>
            </form>
        </section>
    </main>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="../../assets/js/mobileMenu.js"></script>
    <script src="../../assets/js/index/dropdown.js"></script>
    <script src="../../assets/js/index/formmanipulation.js"></script>
    <script src="../../assets/js/reservar_passagem/inputsearch.js"></script>
</body>
</html>
