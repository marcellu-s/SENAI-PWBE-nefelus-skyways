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
    <title>Registrar passageiro - Nefelus SkyWays</title>
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/registrar_passageiro/style.css">
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
                    <a href="../../pages/reservar_passagem/reservar_passagem.html" class="text-sm font-semibold leading-6 text-white in-page">Registrar passageiro</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-white">Ofertas</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-white">Contato</a>
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
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white in-page">Registrar passageiro</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Ofertas</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Contato</a>
                            </div>
                            <div class="py-6">
                                <a href="../../pages/login.html" class="text-sm font-semibold leading-6 text-white">Entrar<span aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="register-passenger-area">
            <div class="register-passenger-header">
                <h1>Preencha os dados do passageiro</h1>
                <span>Dados do adulto</span>
            </div>
            <form action="./selecionar_assento.php" method="post">
                <input type="hidden" name="">
                
                <?php
                
                $passageiro_adulto = $_POST['adult-passenger'];
                $passageiro_crianca = $_POST['child-passenger'];
                $passageiro_bebe = $_POST['baby-passenger'];
                
                $total_passageiros = $passageiro_adulto + $passageiro_bebe + $passageiro_crianca;

                $vooSelecionado = $_POST['flight-selected'];
                
                echo '<input type="hidden" name="adult-passenger" value="'.$passageiro_adulto.'">';
                echo '<input type="hidden" name="child-passenger" value="'.$passageiro_crianca.'">';
                echo '<input type="hidden" name="baby-passenger" value="'.$passageiro_bebe.'">';

                echo '<input type="hidden" id="page-form" name="page-form" value="passageiro">';
                echo '<input type="hidden" id="total_passenger" name="page-form" value="passageiro">';

                echo '<input type="hidden" id="flight-selected" name="flight-selected" value="'.$vooSelecionado.'">';

                for($i = 0; $i < $total_passageiros; $i++) {

                    if ($i < $passageiro_adulto) {
                        $qualidade = 'adult';
                        $qual = 'Adulto';
                        $intervalo1 = new DateInterval('P110Y');
                        $intervalo2 = new DateInterval('P18Y');
                        $intervaloPassaporte = new DateInterval('P10Y');

                    } else {
                        if ($i < $passageiro_adulto + $passageiro_crianca) {
                            $qualidade = 'child';
                            $qual = 'Criança';
                            $intervalo1 = new DateInterval('P18Y');
                            $intervalo2 = new DateInterval('P2Y');
                            $intervaloPassaporte = new DateInterval('P5Y');
                        } else {
                            $qualidade = 'Bebê';
                            $intervalo1 = new DateInterval('P2Y');
                            $intervalo2 = new DateInterval('P0Y');
                            $intervaloPassaporte = new DateInterval('P2Y');
                        }
                    }

                    $hoje = new DateTime();
                    $dataMinima = $hoje->sub($intervalo1);
                    $dataMinima = $dataMinima->format('Y-m-d');

                    $hoje = new DateTime();
                    $dataMaxima = $hoje->sub($intervalo2);
                    $dataMaxima = $dataMaxima->format('Y-m-d');

                    $hoje = new DateTime();
                    $emissaoPassaporte = $hoje->sub($intervaloPassaporte);
                    $emissaoPassaporte = $emissaoPassaporte->format('Y-m-d');

                    echo '<br><h3><strong>Passageiro '. ($i + 1) .' - '. $qual .'</strong><h3><br>

                <input type="hidden" id="passenger-class" name="passenger-class-'.$i.'" value="'.$qualidade.'">

                <div class="input-control">
                    <label for="first-name">PRIMEIRO NOME</label>
                    <input type="text" id="first-name" name="first-name-passenger-'.$i.'" placeholder="Exemplo: João" required>
                </div>
                <div class="input-control">
                    <label for="last-name">ÚLTIMO NOME</label>
                    <input type="text" id="last-name" name="last-name-passenger-'.$i.'" placeholder="Exemplo: Silva" required>
                </div>
                <div class="input-control">
                    <label for="date-of-birth">DATA DE NASCIMENTO</label>
                    <input type="date" id="date-of-birth" min="'. $dataMinima .'" max="'.$dataMaxima.'" name="date-of-birth-passenger-'.$i.'" required>
                </div>
                <div class="input-control">
                    <label for="gender">GÊNERO</label>
                    <div class="dropdown dropdown-gender dropdown-hide">
                        <div class="input-with-icon">
                            <input type="text" id="gender" name="gender-passenger-'.$i.'" placeholder="Escolha uma opção" required>
                            <img src="../../assets/img/icons/down-arrow-backup-2-svgrepo-com.svg" alt="">
                        </div>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item">Mulher</li>
                            <li class="dropdown-item">Homem</li>
                        </ul>
                    </div>
                </div>
                <div class="input-control">
                    <label for="nationality">NACIONALIDADE</label>
                    <div class="dropdown dropdown-nationality dropdown-hide">
                        <div class="input-with-icon">
                            <input type="text" id="nationality" name="nationality-passenger-'.$i.'" placeholder="Brasil" required>
                            <img src="../../assets/img/icons/down-arrow-backup-2-svgrepo-com.svg" alt="">
                        </div>
                        <ul class="dropdown-menu">
                            
                        </ul>
                    </div>
                </div>
                <div class="input-control">
                    <label for="passport">PASSAPORTE</label>
                    <input type="text" id="passport" name="passport-passenger-'.$i.'" placeholder="Digite os números do documento" required>
                    <label for="passport-date-of-issue">DATA DE EMISSÃO</label>
                    <input type="date" id="passport-date-of-issue" min="'. $emissaoPassaporte .'" max="'.date('Y-m-d').'" name="passport-date-of-issue-passenger-'.$i.'" required>
                </div>
                <div class="input-control">
                    <label for="cpf" id="cpf-label">CPF</label>
                    <input type="text" id="cpf" name="cpf-passenger-'.$i.'" placeholder="Digite os números do documento" required>
                    <div class="no-cpf">
                        <input type="checkbox" name="no-cpf-passenger-'.$i.'" id="no-cpf">
                        <label for="no-cpf">Não sou brasileiro e não tenho CPF</label>
                    </div>
                </div>
                <hr>';
                }
                
                ?>
               
                <div class="input-btn">
                    <button type="submit">Próximo passageiro</button>
                </div>
            </form>
        </section>
    </main>

    <!-- JavaScript -->
    <script src="../../assets/js/mobileMenu.js"></script>
    <script src="../../assets/js/registrar_passageiro/dropdown.js"></script>
    <script src="../../assets/js/registrar_passageiro/countryRequest.js"></script>
    <script src="../../assets/js/registrar_passageiro/noCpf.js"></script>
    <script src="../../assets/js/registrar_passageiro/formValidation.js"></script>
</body>
</html>
