<?php

session_start();

if (isset($_SESSION['callback'])) {
    echo($_SESSION['callback']);
    unset($_SESSION['callback']);
}

date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Nefelus SkyWays</title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/index/style.css">
    <link rel="stylesheet" href="./assets/css/index/inputsearch.css">
    <link rel="stylesheet" href="./assets/css/index/media.css">
    <!-- CSS FOOTER -->
    <link rel="stylesheet" href="./assets/css/footer.css">
</head>
<body>
    <!-- HEADER -->
    
    <header>
        <div id="banner-layer">
            <div id="navbar">
                <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
                    <div class="flex lg:flex-1">
                        <a href="./index.php" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-12 w-auto" src="./assets/img/icons/logo.png" alt="">
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
                        <a href="./index.php" class="text-sm font-semibold leading-6 text-white in-page">Início</a>
                        <a href="./pages/reservar_passagem/reservar_passagem.php" class="text-sm font-semibold leading-6 text-white">Reservar passagem</a>
                        <a href="./pages/ofertas.html" class="text-sm font-semibold leading-6 text-white">Ofertas</a>
                        <a href="./pages/contato.html" class="text-sm font-semibold leading-6 text-white">Contato</a>
                        <?php
                        if (isset($_SESSION['login']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'comum')) {
                            echo("<a href='./admin/pages/main.php' class='text-sm font-semibold leading-6 text-white'>Área de trabalho</a>");
                        } else if (isset($_SESSION['login'])) {
                            echo("<a href='./client/pages/myAccount.php' class='text-sm font-semibold leading-6 text-white'>Meu perfil</a>");
                        }
                        ?>
                    </div>
                    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                        <?php 
                        if (isset($_SESSION['login'])) {
                            echo("<a href='./assets/php/logoutProcess.php?logout=true' class='text-sm font-semibold leading-6 text-white mr-8'>Deslogar<span aria-hidden='true'>&rarr;</span></a>");
                        } else {
                            echo("<a href='./pages/login.php' class='text-sm font-semibold leading-6 text-white mr-8'>Entrar<span aria-hidden='true'>&rarr;</span></a>");
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
                            <a href="./index.html" class="-m-1.5 p-1.5">
                                <span class="sr-only">Your Company</span>
                                <img class="h-12 w-auto" src="./assets/img/icons/logo.png" alt="">
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
                                    <a href="./index.php"
                                        class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white in-page">Início</a>
                                    <a href="./pages/reservar_passagem/reservar_passagem.php"
                                        class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Reservar passagem</a>
                                    <a href="./pages/ofertas.html"
                                        class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Ofertas</a>
                                    <a href="./pages/contato.html"
                                        class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Contato</a>
                                    <?php
                                    if (isset($_SESSION['login']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'comum')) {
                                        echo("<a href='./admin/pages/main.php' class='-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white'>Área de trabalho</a>");
                                    } else if (isset($_SESSION['login'])) {
                                        echo("<a href='./client/pages/myAccount.php' class='-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white'>Meu perfil</a>");
                                    }
                                    ?>
                                </div>
                                <div class="py-6">
                                    <?php 
                                    if (isset($_SESSION['login'])) {
                                        echo("<a href='./assets/php/logoutProcess.php?logout=true' class='text-sm font-semibold leading-6 text-white'>Deslogar<span aria-hidden='true'>&rarr;</span></a>");
                                    } else {
                                        echo("<a href='./pages/login.php' class='text-sm font-semibold leading-6 text-white'>Entrar<span aria-hidden='true'>&rarr;</span></a>");
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- HEADLINE -->

            <div class="headline-area">
                <h1>Sua Jornada Começa Aqui</h1>
            </div>

            <!-- FIM HEADLINE -->
        </div>
    </header>

    <!-- END -->

    <!-- MAIN -->

    <main>

        <!-- BOOKING-AREA -->

        <section class="booking-area">
            <form>
                <div class="input-control mobile-hide input-trecho">
                    <div class="dropdown">
                        <button class="trigger-button" type="button">
                            <span>TRECHO</span>
                            <span id="input-trecho-selected">Ida e volta</span>
                            <img src="./assets/img/icons/arrow-top.svg" alt="arrow">
                        </button>
                        <div class="dropdown-content">
                            <ul id="trecho">
                                <li><input type="radio" name="trecho" id="round-trip" value="round-trip" checked><label for="round-trip">Ida e volta</label></li>
                                <li><input type="radio" name="trecho" id="one-way" value="one-way"><label for="one-way">Só ida</label></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="input-control mobile-hide input-cliente">
                    <div class="dropdown">
                        <button class="trigger-button" type="button">
                            <span>CLIENTES</span>
                            <span id="input-cliente-selected">
                                <span id="adult" style="display: inline;">1 Adulto(s)</span>
                                <span id="kid" style="margin: 0 0.5rem; display: none;">1 Criança(s)</span>
                                <span id="baby" style="display: none;">1 Bebê(s)</span>
                            </span>
                            <img src="./assets/img/icons/arrow-top.svg" alt="arrow">
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
                <div class="input-control mobile-hide input-travel-from">
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
                <div class="input-control mobile-hide">
                    <label for="outbound">DATA DA VIAGEM DE IDA</label>
                    <input type="date" name="outbound" id="outbound" min="<?php echo(date('Y-m-d')) ?>" required>
                </div>
                <div class="input-control mobile-hide input-return">
                    <label for="return">DATA DA VIAGEM DE VOLTA</label>
                    <input type="date" name="return" id="return" min="<?php echo(date('Y-m-d')) ?>" required>
                </div>
                <button type="submit" class="search-btn mobile-hide">BUSCAR VOOS</button>
            </form>
        </section>

        <!-- END -->

        <!-- FEATURES-AREA -->
    
        <section class="features-area">
            <h2 class="title">Por que Reservar Conosco</h2>
            <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti a quo inventore provident ducimus sunt, tempora porro iste ea distinctio asperiores accusantium fugit! Quo soluta omnis laborum officia, reiciendis animi!</p>
            <div class="features">
                <div class="feature-item">
                    <img src="./assets/img/icons/ticket.png" alt="ticket">
                    <span class="img-title">Passagens Aéreas Baratas</span>
                    <span class="feature-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, earum, a voluptas alias ex non voluptatibus ab at odio?<span>
                </div>
                <div class="feature-item">
                    <img src="./assets/img/icons/trophy.png" alt="trophy">
                    <span class="img-title">Nós Temos Experiência</span>
                    <span class="feature-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, earum, a voluptas alias ex non voluptatibus ab at odio?<span>
                </div>
                <div class="feature-item">
                    <img src="./assets/img/icons/security.png" alt="security">
                    <span class="img-title">Segurança de Pagamento On-line</span>
                    <span class="feature-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, earum, a voluptas alias ex non voluptatibus ab at odio?<span>
                </div>
            </div>
        </section>

        <!-- END -->

        <!-- OFFERS-AREA -->

        <section class="offers-area">
            <h2 class="title">OFERTAS</h2>
            <p class="description">Garantia de melhor preço</p>
            <div class="offers">
                <div class="offers-item" id="offers-main">
                    <div class="offers-main-content">
                        <div class="offers-img">
                            <img src="./assets/img/card/pexels-casia-charlie-2433467.jpg" alt="">
                        </div>
                        <div class="offers-description">
                            <span class="destiny">Destino para Destino</span>
                            <span class="date">09 mai 2023 - 16 mai 2023</span>
                            <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                        </div>
                        <div class="layer-on-hover">
                            <div class="layer-content">
                                <span class="destiny">Destino para Destino</span>
                                <span class="date">09 mai 2023 - 16 mai 2023</span>
                                <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                                <button class="btn">Saber Mais</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offers-item" id="offers-other1">
                    <div class="offers-main-content">
                        <div class="offers-img">
                            <img src="./assets/img/card/pexels-casia-charlie-2433467.jpg" alt="">
                        </div>
                        <div class="offers-description">
                            <span class="destiny">Destino para Destino</span>
                            <span class="date">09 mai 2023 - 16 mai 2023</span>
                            <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                        </div>
                        <div class="layer-on-hover">
                            <div class="layer-content">
                                <span class="destiny">Destino para Destino</span>
                                <span class="date">09 mai 2023 - 16 mai 2023</span>
                                <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                                <button class="btn">Saber Mais</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offers-item" id="offers-other2">
                    <div class="offers-main-content">
                        <div class="offers-img">
                            <img src="./assets/img/card/pexels-casia-charlie-2433467.jpg" alt="">
                        </div>
                        <div class="offers-description">
                            <span class="destiny">Destino para Destino</span>
                            <span class="date">09 mai 2023 - 16 mai 2023</span>
                            <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                        </div>
                        <div class="layer-on-hover">
                            <div class="layer-content">
                                <span class="destiny">Destino para Destino</span>
                                <span class="date">09 mai 2023 - 16 mai 2023</span>
                                <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                                <button class="btn">Saber Mais</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offers-item" jd="offers-other3">
                    <div class="offers-main-content">
                        <div class="offers-img">
                            <img src="./assets/img/card/pexels-casia-charlie-2433467.jpg" alt="">
                        </div>
                        <div class="offers-description">
                            <span class="destiny">Destino para Destino</span>
                            <span class="date">09 mai 2023 - 16 mai 2023</span>
                            <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                        </div>
                        <div class="layer-on-hover">
                            <div class="layer-content">
                                <span class="destiny">Destino para Destino</span>
                                <span class="date">09 mai 2023 - 16 mai 2023</span>
                                <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                                <button class="btn">Saber Mais</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offers-item" id="offers-other4">
                    <div class="offers-main-content">
                        <div class="offers-img">
                            <img src="./assets/img/card/pexels-casia-charlie-2433467.jpg" alt="">
                        </div>
                        <div class="offers-description">
                            <span class="destiny">Destino para Destino</span>
                            <span class="date">09 mai 2023 - 16 mai 2023</span>
                            <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                        </div>
                        <div class="layer-on-hover">
                            <div class="layer-content">
                                <span class="destiny">Destino para Destino</span>
                                <span class="date">09 mai 2023 - 16 mai 2023</span>
                                <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                                <button class="btn">Saber Mais</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offers-item" id="offers-other4">
                    <div class="offers-main-content">
                        <div class="offers-img">
                            <img src="./assets/img/card/pexels-casia-charlie-2433467.jpg" alt="">
                        </div>
                        <div class="offers-description">
                            <span class="destiny">Destino para Destino</span>
                            <span class="date">09 mai 2023 - 16 mai 2023</span>
                            <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                        </div>
                        <div class="layer-on-hover">
                            <div class="layer-content">
                                <span class="destiny">Destino para Destino</span>
                                <span class="date">09 mai 2023 - 16 mai 2023</span>
                                <span class="price">Economia de<br><strong>R$ 860,00</strong></span>
                                <button class="btn">Saber Mais</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- END -->

        <!-- KNOW-MORE-AREA -->
        
        <section class="know-more-area">
            <div class="layer-backgroud">
                <h2 class="title">Seu Grande Destino</h2>
                <p class="description">
                    Seja recompensado por suas viagens - desbloqueie economias instantâneas
                    de 10% ou mais com uma conta na <strong><a href="#">Nefelus SkyWays!</a></strong>.
                </p>
                <div class="happy-customers know-more-box">
                    <div class="know-more-box-left">
                        <span class="happy-customers-qnta">8590+</span>
                        <span class="happy-customers-txt">Clientes Felizes</span>
                    </div>
                    <div class="know-more-box-right">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
                <div class="happy-customers know-more-box">
                    <div class="know-more-box-left">
                        <span class="happy-customers-qnta">100%</span>
                        <span class="happy-customers-txt">Clientes Satisfeitos</span>
                    </div>
                    <div class="know-more-box-right">
                        <i class="bi bi-globe"></i>
                    </div>
                </div>
                <p class="description">
                    Descubra as últimas ofertas e novidades e começe a planejar o seu destino!
                    <strong><a href="#">Contate-nos!</a></strong>
                </p>
            </div>
        </section>

        <!-- END -->
    </main>

    <!-- END -->

    <!-- FOOTER -->

    <footer id="footer-fluid">
        <div class="footer-content">
            <div class="about-parking">
                <h3 class="footer-title">Sobre a Nefelus SkyWays</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus obcaecati aliquid cupiditate eligendi
                    nobis sit inventore ducimus quis alias esse mollitia eaque dolorum voluptatibus nulla corrupti, minima
                    praesentium porro enim.</p>
            </div>
            <div class="content-details">
                <div class="service">
                    <h3 class="footer-title">Serviços</h3>
                    <ul class="list-content">
                        <li class="list-item"><a href="#">Antecipar voo</a></li>
                        <li class="list-item"><a href="#">Serviço de bordo</a></li>
                        <li class="list-item"><a href="#">Tarifa garantida</a></li>
                        <li class="list-item"><a href="#">Voe junto</a></li>
                    </ul>
                </div>
                <div class="quick-links">
                    <h3 class="footer-title">Links Rápidos</h3>
                    <ul class="list-content">
                        <li class="list-item"><a href="#">Início</a></li>
                        <li class="list-item"><a href="#">Reservar Passagem</a></li>
                        <li class="list-item"><a href="#">Ofertas</a></li>
                        <li class="list-item"><a href="#">Serviços</a></li>
                        <li class="list-item"><a href="#">Contato</a></li>
                    </ul>
                </div>
                <div class="contact-info">
                    <h3 class="footer-title">Informção de Contato</h3>
                    <p class="info-street">Rua Alfredo Blackman, 234</p>
                    <span class="info-phone">+55 9999-9999</span>
                    <span class="info-email">contato@nefelusskyways.com</span>
                </div>
            </div>
            <div class="line-separator"></div>
            <div class="copyright">
                <p>&copy; Copyright 2023 Nefelus SkyWays. All Rights Reserved</p>
            </div>
        </div>
    </footer>

    <!-- END -->

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="./assets/js/index/mobilemenu.js"></script>
    <script src="./assets/js/index/bannerdlideshow.js"></script>
    <script src="./assets/js/index/bookingareamod.js"></script>
    <script src="./assets/js/index/dropdown.js"></script>
    <script src="./assets/js/index/formmanipulation.js"></script>
    <script src="./assets/js/index/inputsearch.js"></script>

    <script>

        // Escurecer a navbar, caso a rolagem da tela tenha ultrapassado 500px
        // senão mantenha o estado original 

        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {
            if (window.scrollY >= 500) {
                navbar.classList.add('gloom');
            } else {
                navbar.classList.remove('gloom');
            }
        })

        $(document).ready(() => {
            if (window.scrollY >= 500) {
                navbar.classList.add('gloom');
            }
        })

    </script>
</body>
</html>