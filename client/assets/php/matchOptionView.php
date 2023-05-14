<?php

// Opções de visualização do cliente sobre sua conta

session_start();

include_once "../../../ops/db.php";

$id = $_SESSION['loginID'];

$option = $_GET['option'];

switch ($option) {

    case 'edit-profile':

        $query = "SELECT * FROM cadastro
        INNER JOIN pessoa
        ON pessoa.id_pessoa = cadastro.fk_pessoa
        WHERE cadastro.id_cadastro = $id";

        $result = $conn->query($query);

        if ($result->num_rows != 0) {

            // ERRO
        }

        $userData = $result->fetch_assoc();

        $addressArray = explode(';', $userData['endereco']);
        $gender = strtoupper($userData['sexo']) == 'H' ? 'Homem' : 'Mulher';

        $template = "<div class='request-edit-profile'>
        <div class='msg'>
            <span>OBS: apenas o que for modificado será alterado!</span>
        </div>
        <form action='../assets/php/editProfileProcess.php' method='POST'>
            <div class='input-control'>
                <label for='first-name'>NOME</label>
                <input type='text' name='first-name' id='first-name' value='$userData[p_nome]'>
            </div>
            <div class='input-control'>
                <label for='last-name'>SOBRENOME</label>
                <input type='text' name='last-name' id='last-name' value='$userData[p_sobrenome]'>
            </div>
            <div class='input-control'>
                <label>DATA DE NASCIMENTO</label>
                <input type='date' value='$userData[data_nasc]' class='no-edit' readonly>
            </div>
            <div class='input-control'>
                <label>GÊNERO</label>
                <select name='gender' id='gender'>
                    <option value='$userData[sexo]' selected>$gender</option>
                    <option value='H'>Homem</option>
                    <option value='M'>Mulher</option>
                </select>
            </div>
            <div class='input-control'>
                <label for='nacionality'>NACIONALIDADE</label>
                <select name='nacionality' id='nacionality'>
                    <option value='$userData[nacionalidade]' selected>$userData[nacionalidade]</option>
                </select>
            </div>
            <div class='input-control'>
                <label for='telephone'>TELEFONE-CELULAR</label>
                <input type='tel' name='telephone' id='telephone' value='$userData[telefone]'>
            </div>
            <div class='input-control'>
                <label for='cep'>CEP</label>
                <input type='text' name='cep' id='cep' value='$addressArray[5]'>
            </div>
            <div class='input-control'>
                <label for='endereco'>ENDERECO</label>
                <input type='text' name='endereco' id='endereco' value='$addressArray[0]' readonly>
            </div>
            <div class='input-control'>
                <label for='bairro'>BAIRRO</label>
                <input type='text' name='bairro' id='bairro' value='$addressArray[1]' readonly>
            </div>
            <div class='input-control'>
                <label for='cidade'>CIDADE</label>
                <input type='text' name='cidade' id='cidade' value='$addressArray[2]' readonly>
            </div>
            <div class='input-control'>
                <label for='uf'>UF</label>
                <input type='text' name='uf' id='uf' value='$addressArray[3]' readonly>
            </div>
            <div class='input-control'>
                <label for='numero'>NÚMERO-RESIDENCIAL</label>
                <input type='text' name='numero' id='numero' value='$addressArray[4]'>
            </div>
            <div class='input-control'>
                <label for='cpf'>CPF</label>
                <input type='text' name='cpf' id='cpf' class='no-edit' value='$userData[cpf]' readonly>
            </div>
            <div class='input-control'>
                <label for='passport'>PASSAPORTE</label>
                <input type='text' name='passport' id='passport' class='no-edit' value='$userData[passaporte]' readonly>
            </div>
            <div class='input-control'>
                <label for='email'>E-MAIL</label>
                <input type='email' name='email' id='email' value='$userData[email]'>
            </div>
            <div class='input-control'>
                <label for='old-password'>SENHA ANTIGA</label>
                <input type='password' name='old-password' id='old-password'>
            </div>
            <div class='input-control'>
                <label for='new-password'>NOVA SENHA</label>
                <input type='password' name='new-password' id='new-password' minlength='8' maxlength='25'>
            </div>
            <div class='input-btn'>
                <button type='submit'>Salvar alterações</button>
            </div>
        </form>
        </div>";
        
        break;
    
    default:
        # code...
        break;
}


echo(json_encode($template));

?>