<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Contato - Nefelus SkyWays</title>
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONTS GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/contato/style.css">
    <link rel="stylesheet" href="../assets/css/contato/media.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
   <!-- HEADER -->
    
   <header>
        <div id="navbar">
            <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="../index.php" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-12 w-auto" src="../assets/img/icons/logo.png" alt="">
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
                    <a href="../index.php" class="text-sm font-semibold leading-6 text-white">Início</a>
                    <a href="../pages/reservar_passagem/reservar_passagem.php" class="text-sm font-semibold leading-6 text-white">Reservar passagem</a>
                    <a href="./ofertas.php" class="text-sm font-semibold leading-6 text-white">Ofertas</a>
                    <a href="./contato.php" class="text-sm font-semibold leading-6 text-white in-page">Contato</a>
                    <?php
                    if (isset($_SESSION['login']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'comum')) {
                        echo("<a href='../admin/pages/main.php' class='text-sm font-semibold leading-6 text-white'>Área de trabalho</a>");
                    } else if (isset($_SESSION['login'])) {
                        echo("<a href='../client/pages/myAccount.php' class='text-sm font-semibold leading-6 text-white'>Meu perfil</a>");
                    }
                    ?>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <?php 
                    if (isset($_SESSION['login'])) {
                        echo("<a href='../assets/php/logoutProcess.php?logout=true' class='text-sm font-semibold leading-6 text-white mr-8'>Deslogar<span aria-hidden='true'>&rarr;</span></a>");
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
                        <a href="../index.php" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-12 w-auto" src="../assets/img/icons/logo.png" alt="">
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
                                <a href="../index.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Início</a>
                                <a href="./reservar_passagem/reservar_passagem.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Registrar passageiro</a>
                                <a href="./ofertas.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Ofertas</a>
                                <a href="./contato.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white in-page">Contato</a>
                                <?php
                                if (isset($_SESSION['login']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'comum')) {
                                    echo("<a href='../admin/pages/main.php' class='-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white'>Área de trabalho</a>");
                                } else if (isset($_SESSION['login'])) {
                                    echo("<a href='../client/pages/myAccount.php' class='-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white'>Meu perfil</a>");
                                }
                                ?>
                            </div>
                            <div class="py-6">
                                <?php 
                                if (isset($_SESSION['login'])) {
                                    echo("<a href='../assets/php/logoutProcess.php?logout=true' class='text-sm font-semibold leading-6 text-white mr-8'>Deslogar<span aria-hidden='true'>&rarr;</span></a>");
                                } else {
                                    echo("<a href='./pages/login.php' class='text-sm font-semibold leading-6 text-white mr-8'>Entrar<span aria-hidden='true'>&rarr;</span></a>");
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN -->

    <main>
        <section class="contact-form">
            <form>
                <div class="input-control">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" placeholder="Seu nome" maxlength="50" >
                </div>
                <div class="input-control">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="Seu E-mail" maxlength="50" >
                </div>
                <div class="input-control">
                    <label for="subject">Assunto</label>
                    <input type="text" name="subject" id="subject" placeholder="Motivo do contato" maxlength="75" >
                </div>
                <div class="input-control">
                    <label for="message">Mensagem</label>
                    <textarea name="message" id="message" cols="30" rows="5" placeholder="Informações adicionais" maxlength="150" ></textarea>
                </div>
                <button type="submit">Enviar</button>
            </form>
        </section>

        <section class="contact-information">
            <h2>Informações de contato</h2>
            <div class="information">
                <p class="information-title">Endereço</p>
                <p class="information-content">Rua, ------------------------</p>
            </div>
            <div class="information">
                <p class="information-title">SAC</p>
                <p class="information-content">0800 0105 560</p>
            </div>
            <div class="information">
                <p class="information-title">E-mail de contato</p>
                <p class="information-content"><a href="mailto:contato@nefeluskyways.com">contato@nefeluskyways.com</a></p>
            </div>
            <div class="information">
                <p class="information-title">Nosso site</p>
                <p class="information-content"><a href="../index.html">https://www.nefelusskyways.com</a></p>
            </div>
        </section>
    </main>

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

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../assets/js/mobileMenu.js"></script>
    <script src="../assets/js/contato/sendContact.js"></script>
</body>
</html>