<?php

    session_start();

    if (isset($_SESSION['callback'])) {
        echo($_SESSION['callback']);
        unset($_SESSION['callback']);
    }

    include_once "../../ops/db.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Adicionar aeroporto</title>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- FONTS GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/adicionar/style.css">
</head>
<body>
    <header>
        <div class="back-page">
            <a href="../pages/main.html"><i class="bi bi-folder-symlink-fill"></i> - Voltar</a>
        </div>
    </header>
    <main>
        <section class="register-passenger-area">
            <div class="register-passenger-header">
                <h1>Adicionar funcionário</h1>
            </div>
            <form action="../assets/php/addEmployee.php" method="post">
                <div class="input-control">
                    <label for="nome">NOME</label>
                    <input type="text" name="nome" id="nome" placeholder="João" required>
                </div>
                <div class="input-control">
                    <label for="sobrenome">SOBRENOME</label>
                    <input type="text" name="sobrenome" id="sobrenome" placeholder="Silva" required>
                </div>
                <div class="input-control">
                    <label for="nascimento">DATA DE NASCIMENTO</label>
                    <input type="date" max="<?php echo(date('Y-m-d')); ?>" name="nascimento" id="nascimento">
                </div>
                <div class="input-control">
                    <label for="gender">GÊNERO</label>
                    <select name="gender" id="gender" required>
                        <option value="" selected disabled>Selecione uma opção</option>
                        <option value="h">Homem</option>
                        <option value="m">Mulher</option>
                    </select>
                </div>
                <div class="input-control">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" id="cep" placeholder="04757000" required>
                </div>
                <div class="input-control">
                    <label for="endereco">ENDEREÇO</label>
                    <input type="text" name="endereco" id="endereco" placeholder="..." readonly>
                </div>
                <div class="input-control">
                    <label for="bairro">BAIRRO</label>
                    <input type="text" name="bairro" id="bairro" placeholder="..." readonly>
                </div>
                <div class="input-control">
                    <label for="cidade">CIDADE</label>
                    <input type="text" name="cidade" id="cidade" placeholder="..." readonly>
                </div>
                <div class="input-control">
                    <label for="numero">NÚMERO RESIDÊNCIAL</label>
                    <input type="text" name="numero" id="numero" placeholder="379" required>
                </div>
                <div class="input-control">
                    <label for="rg">RG</label>
                    <input type="text" name="rg" id="rg" placeholder="04757-000" required>
                </div>
                <div class="input-control">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" placeholder="12345678910" required>
                </div>
                <div class="input-control">
                    <label for="celular">TELEFONE-CELULAR</label>
                    <input type="tel" name="celular" id="celular" placeholder="11912345678" required>
                </div>
                <div class="input-control">
                    <label for="email">E-MAIL</label>
                    <input type="email" name="email" id="email" placeholder="Informe um e-mail válido" required>
                </div>
                <div class="input-control">
                    <label for="senha">SENHA</label>
                    <input type="password" name="senha" id="senha" placeholder="Digite uma senha" required>
                </div>
                <div class="input-control">
                    <label for="job">FUNÇÃO</label>
                    <select name="job" id="job" required>
                        <option value="" selected disabled>Selecione uma opção</option>
                        <option value="admin">Administrador</option>
                        <option value="comum">Funcionário</option>
                    </select>
                </div>
                <div class="input-btn">
                    <button type="submit">Adicionar</button>
                </div>
            </form>
        </section>
    </main>

    <script src="../assets/js/cadastro/validate.js"></script>
</body>
</html>