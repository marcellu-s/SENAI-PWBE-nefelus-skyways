<?php

session_start();

if (!isset($_SESSION['login'])) {
    
    header("location: ../../pages/login.php");
}

if (isset($_SESSION['callback'])) {
    echo($_SESSION['callback']);
    unset($_SESSION['callback']);
}

if (isset($_SESSION['loginID'])) {

    include_once "../../ops/db.php";

    $query = "SELECT * FROM cadastro
    INNER JOIN pessoa
    ON pessoa.id_pessoa = cadastro.fk_pessoa
    WHERE cadastro.id_cadastro = $_SESSION[loginID]";

    $result = $conn->query($query);

    // Se por algum motivo, não encontrar a conta

    if ($result->num_rows != 1) {

        $_SESSION['callback'] = "<script>window.alert('Algo aconteceu e não encontramos sua conta, tente fazer login novamente!')</script>";
        header("location: ../../assets/php/logoutProcess?logout=true");
        die();
    }

    $userData = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Minha conta - Nefelus SkyWays</title>
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONTS GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/edit_profile.css">
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
                    <a href="../../pages/reservar_passagem/reservar_passagem.php" class="text-sm font-semibold leading-6 text-white">Reservar passagem</a>
                    <a href="../../pages/ofertas.php" class="text-sm font-semibold leading-6 text-white">Ofertas</a>
                    <a href="../../pages/contato.php" class="text-sm font-semibold leading-6 text-white">Contato</a>
                    <?php
                    if (isset($_SESSION['login']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'comum')) {
                        echo("<a href='../../admin/pages/main.php' class='text-sm font-semibold leading-6 text-white'>Área de trabalho</a>");
                    } else if (isset($_SESSION['login'])) {
                        echo("<a href='./myAccount.php' class='text-sm font-semibold leading-6 text-white in-page'>Meu perfil</a>");
                    }
                    ?>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <?php 
                    if (isset($_SESSION['login'])) {
                        echo("<a href='../../assets/php/logoutProcess.php?logout=true' class='text-sm font-semibold leading-6 text-white mr-8'>Deslogar<span aria-hidden='true'>&rarr;</span></a>");
                    } else {
                        echo("<a href='../../pages/login.php' class='text-sm font-semibold leading-6 text-white mr-8'>Entrar<span aria-hidden='true'>&rarr;</span></a>");
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
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white in-page">Início</a>
                                <a href="../../pages/reservar_passagem/reservar_passagem.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Reservar passagem</a>
                                <a href="../../pages/ofertas.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Ofertas</a>
                                <a href="../../pages/contato.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Contato</a>
                                <?php
                                if (isset($_SESSION['login']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'comum')) {
                                    echo("<a href='./admin/pages/main.php' class='-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white'>Área de trabalho</a>");
                                } else if (isset($_SESSION['login'])) {
                                    echo("<a href='./myAccount.php' class='-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white'>Meu perfil</a>");
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
    </header>

    <main>
        <section class="profile-header">
            <div class="left">
                <div class="profile-img">
                    <img src="../assets/img/perfil-300x300-4.jpg" alt="">
                </div>
                <div class="profile-information">
                    <ul class="profile-info">
                        <li class="info">Nome: <span class="info-name"><?php echo("$userData[p_nome] "."$userData[p_sobrenome]") ?></span></li>
                        <li class="info">Idade: <span class="info-age hidden"><?php echo($userData['data_nasc']) ?></span></li>
                        <li class="info">Nacionalidade: <span class="info-nacionality hidden"><?php echo($userData['nacionalidade']) ?></span></li>
                    </ul>
                </div>
            </div>
            <div class="right">
                <ul class="options">
                    <li class="option"><button class="edit-profile">Editar perfil</button></li>
                    <li class="option"><button class="show-travels">Ver viagens feitas por mim</button></li>
                    <li class="option"><button class="passagens-pendentes">Passagens pendentes</button></li>
                </ul>
            </div>
        </section>

        <section class="request-option-area">
            
        </section>
    </main>

    <script src="../assets/js/choiceOptionView.js"></script>

    <script>

        // IIFE (Immediately Invoked Function Expression) é uma função em JavaScript que é executada assim que definida.
        
        (function () {
            /**
             * Calcular a idade
             */
            const today = new Date();
            const birthDate = new Date(document.querySelector('.info-age').textContent);
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            document.querySelector('.info-age').textContent = `${age} anos`;
            document.querySelector('.info-age').classList.remove('hidden');
        })();

        (function () {
            /**
             * Definir a nacionalidade
             */
            
            const url = `https://servicodados.ibge.gov.br/api/v1/paises/${document.querySelector('.info-nacionality').textContent}`;

            fetch(url)
            .then((response) => response.json())

            .then((json) => document.querySelector('.info-nacionality').textContent = json[0].nome.abreviado)

            .catch((error) => {
                console.log(error);
                window.alert('Aconteceu um erro na definição da sua nacionalidade!');
            })

            .finally(document.querySelector('.info-nacionality').classList.remove('hidden'));
        })();
    </script>
</body>
</html>