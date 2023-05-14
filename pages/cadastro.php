<?php 
    session_start();

    date_default_timezone_set('America/Sao_Paulo'); 

    if (isset($_SESSION['callback'])) {
        echo($_SESSION['callback']);
        unset($_SESSION['callback']);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/icons/favicon.ico" type="image/x-icon">
    <title>Cadastrar-se - Nefelus SkyWays</title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/cadastro/style.css">
</head>
<body>
    <main>
        <section class="register-passenger-area" style="margin-top: 0;">
            <div class="register-passenger-header">
                <a href="../index.php"><img src="../assets/img/icons/logo.png" alt="" srcset=""></a>
                <h1>Cadastrar-se</h1>
            </div>
            <form action="../assets/php/addCad.php" method="POST">
                <div class="input-control">
                    <label for="first-name">PRIMEIRO NOME</label>
                    <input type="text" id="first-name" name="first-name" placeholder="Exemplo: João" required>
                </div>
                <div class="input-control">
                    <label for="last-name">ÚLTIMO NOME</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Exemplo: Silva" required>
                </div>
                <div class="input-control">
                    <label for="date-of-birth">DATA DE NASCIMENTO</label>
                    <input type="date" id="date-of-birth" name="date-of-birth" max="<?php echo(date('Y-m-d')); ?>" required>
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
                    <label for="nationality">NACIONALIDADE</label>
                    <select name="nationality" id="nationality" required>
                        <option value="" selected disabled>Selecione uma opção</option>
                    </select>
                </div>
                <div class="input-control">
                    <label for="telephone">TELEFONE CELULAR</label>
                    <input type="tel" id="telephone" name="telephone" placeholder="DDD + Número do celular" required>
                </div>
                <div class="input-control">
                    <label for="cep">CEP</label>
                    <input type="text" id="cep" name="cep" placeholder="Informe seu CEP" required>
                </div>
                <div class="input-control">
                    <label for="endereco">ENDEREÇO</label>
                    <input type="text" id="endereco" name="endereco" readonly >
                </div>
                <div class="input-control">
                    <label for="bairro">BAIRRO</label>
                    <input type="text" id="bairro" name="bairro" readonly>
                </div>
                <div class="input-control">
                    <label for="cidade">CIDADE</label>
                    <input type="text" id="cidade" name="cidade" readonly >
                </div>
                <div class="input-control">
                    <label for="uf">UF</label>
                    <input type="text" id="uf" name="uf" readonly>
                </div>
                <div class="input-control">
                    <label for="numero">NÚMERO</label>
                    <input type="number" id="numero" name="numero" placeholder="Número da casa" required>
                </div> 
                <div class="input-control">
                    <label for="passport">PASSAPORTE</label>
                    <input type="text" id="passport" name="passport" placeholder="Digite os números do documento" required>
                    <label for="passport-date-of-issue">DATA DE EMISSÃO</label>
                    <input type="date" id="passport-date-of-issue" name="passport-date-of-issue" max="<?php echo(date('Y-m-d')); ?>" required>
                </div>
                <div class="input-control">
                    <label for="cpf" id="cpf-label">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="Digite os números do documento" required>
                    <div class="no-cpf">
                        <input type="checkbox" name="no-cpf" id="no-cpf">
                        <label for="no-cpf">Não sou brasileiro e não tenho CPF</label>
                    </div>
                </div>
                <div class="input-control">
                    <label for="email">E-MAIL</label>
                    <input type="email" id="email" name="email" placeholder="Digite um e-mail válido" required>
                </div>
                <div class="input-control">
                    <label for="password">SENHA</label>
                    <input type="password" id="password" name="password" minlength="8" maxlength="25" placeholder="Mínimo de 8 caracteres" required>
                </div>
                <div class="input-control">
                    <label for="confirm-password">CONFIRMAR SENHA<span class="span-confirm-psw"> => SENHAS DIFERENTES!</span></label>
                    <input type="password" id="confirm-password" name="confirm-password" minlength="8" maxlength="25" placeholder="Insira a senha digitada acima" required>
                    
                </div>
                <div class="input-btn">
                    <button type="submit">Cadastrar-se</button>
                </div>
            </form>
        </section>
    </main>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="../assets/js/cadastro/requestCountry.js"></script>
    <script src="../assets/js/registrar_passageiro/noCpf.js"></script>
    <script src="../assets/js/cadastro/validateform.js"></script>
    <script src="../assets/js/cadastro/requestViaCep.js"></script>
</body>
</html>