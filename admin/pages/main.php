<?php

session_start();

if (isset($_SESSION['login']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'comum')) {
    // OK - Pode entrar chefe!
} else {
    header("location: ../../pages/login.php");
}

if (isset($_SESSION['callback'])) {
    echo($_SESSION['callback']);
    unset($_SESSION['callback']);
}

include_once "../../ops/db.php";

$result = $conn->query("SELECT p_nome, p_sobrenome FROM pessoa INNER JOIN cadastro ON cadastro.fk_pessoa = pessoa.id_pessoa WHERE id_cadastro = $_SESSION[loginID]");
$name = $result->fetch_array();
$name = "$name[0] $name[1]";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Área de trabalho - Nefelus SkyWays</title>
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../admin/assets/css/main/style.css">
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
                    <a href="../../pages/reservar_passagem/reservar_passagem.php" class="text-sm font-semibold leading-6 text-white">Reservar passagem</a>
                    <a href="../../pages/ofertas.php" class="text-sm font-semibold leading-6 text-white">Ofertas</a>
                    <a href="../../pages/contato.php" class="text-sm font-semibold leading-6 text-white">Contato</a>
                    <a href="./main.php" class="text-sm font-semibold leading-6 text-white in-page">Área de trabalho</a>
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
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Início</a>
                                <a href="../../pages/reservar_passagem/reservar_passagem.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Reservar passagem</a>
                                <a href="../../pages/ofertas.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Ofertas</a>
                                <a href="../../pages/contato.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white">Contato</a>
                                <a href="./main.php"
                                    class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-white in-page">Área de trabalho</a>
                            </div>
                            <div class="py-6">
                                <?php 
                                if (isset($_SESSION['login'])) {
                                    echo("<a href='../../assets/php/logoutProcess.php?logout=true' class='text-sm font-semibold leading-6 text-white'>Deslogar<span aria-hidden='true'>&rarr;</span></a>");
                                } else {
                                    echo("<a href='../../pages/login.php' class='text-sm font-semibold leading-6 text-white'>Entrar<span aria-hidden='true'>&rarr;</span></a>");
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
        <div class="actual-account-login">
            <p>Bem vindo, <span><?php echo($name); ?></span></p>
        </div>

        <div class="dashboard">
            <div class="dashboard-display total-flights">
                <span id="record-counter">----</span>
                <select id="view">
                    <option value="" selected disabled>Visualizar</option>
                    <option value="aeroportos">Aeroportos</option>
                    <option value="avioes">Aviões</option>
                    <option value="passageiros">Passageiros</option>
                    <option value="cadastros">Cadastros</option>
                    <?php if ($_SESSION['login'] == 'admin') { echo("<option value='funcionarios'>Funcionários</option>"); } ?>
                </select>
            </div>
            <div class="dashboard-display">
                <span>Adicionar</span>
                <select id="add">
                    <option value="" selected disabled>---</option>
                    <option value="voo">Voo</option>
                    <option value="aviao">Avião</option>
                    <option value="aeroporto">Aeroporto</option>
                    <option value="cidade">Cidade</option>
                    <?php if ($_SESSION['login'] == 'admin') { echo("<option value='funcionario'>Funcionário</option>"); } ?>
                </select>
            </div>
            <div class="dashboard-display">
                <span>Ir para relatório</span>
                <a href="#"><i class="bi bi-link"></i></a>
            </div>
            <div class="dashboard-display">
                <span>Comentários</span>
                <a href="./mail.php"><i class="bi bi-link"></i></a>
            </div>
        </div>
        
        <div class="response-query-selection">
            <table>
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="pagination">
            <div class="links-wrapper">
            </div>
        </div>
    </main>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="../../assets/js/mobileMenu.js"></script>
    <script src="../assets/js/main/optAdd.js"></script>
    <script src="../assets/js/main/optView.js"></script>
</body>
</html>