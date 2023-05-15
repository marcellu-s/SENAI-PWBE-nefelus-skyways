const form = document.querySelector('.register-passenger-area form');

function isNameValid(name) {
    /**
     * Verificar se o nome contém apenas letras.
     * @param  {String} name Nome a ser verificado.
     * @return {Boolean} true - válido || false - inválido.
     */

    let pattern = /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/;

    return name.match(pattern);

    // if (name.match(pattern)) {

    //     // Força apenas o primeiro nome ser enviado
    //     inputFirstName.value = name.split(' ')[0];

    //     return true;
    // }
}

function isDateValid(date) {
    /**
     * Verificar se o nome contém apenas letras.
     * @param  {String} date Data a ser verificada (DD/MM/AAAA).
     * @return {Boolean} true - válido || false - inválido.
     */

    let today = new Date();
    let dateInput = new Date(date);


    if (dateInput > today) {
        // Inválida
        return false;
    } else {
        // Valída
        return true;
    }
}

function isPassportValid(passport) {
    /**
     * Verificar se o passporte contém um formato válido. AB123456.
     * @param  {String} passport Númro do passaporte a ser verificado.
     * @return {Boolean} true - válido || false - inválido.
     */

    let pattern = /^[A-Za-z]{2}[0-9]{6}$/gm;

    if (passport.match(pattern)) {
        return true;
    }

    return false;
}

function isDateIssueValid(dateIssue) {
    /**
     * Valida se a data de emissão do documento é válida. OBS: funçao é utilizada para validar a data de emissão
     * do RG e passaporte, generalizando sua validade como sendo de 10 anos, após a data de emissão.
     * @param  {String} dateIssue Data de emissão do documento.
     * @return {Boolean} true - válido || false - inválido.
     */

    let today = new Date();
    let dateIssueCheck = new Date(dateIssue);

    // Verifica se a data de emissão foi antes do ano atual
    if (dateIssueCheck < today) {
        // Verifica se a data de emissão somada com os 10 anos de validade é menor que o ano atual
        // Se sim, é por que passou da validade, caso contrátrio o documento é válido
        // OBS: se a validade vence no mesmo ano que o ano atual, o documento é válido, neste caso, seria necessário
        // verificar o mês e o dia, para uma melhor e correta validação.
        if (dateIssueCheck.getFullYear() + 10 < today.getFullYear()) {

            return false;
        }

        return true;
    }

    return false;
}

function isCpfValid(cpf) {
    /**
     * Valida o formato do CPF, e substitui os caracteres que não são digitos.
     * @param  {String} cpf Númro do cpf a ser verificado.
     * @return {Boolean} true - válido || false - inválido.
     */

    let inputCpf = document.querySelector('.input-control #cpf');

    let pattern = /^(\d{3})[.-]?(\d{3})[.-]?(\d{3})[.-]?(\d{2})$/gm;

    if (cpf.match(pattern)) {

        cpf = cpf.replace(pattern, "$1$2$3$4");
        inputCpf.value = cpf;
        
        if (!(cpf.split('').every(char => char === cpf[0]))) {
            let num = 0;
            let pesos = [11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 0];
            for (let i = 0; i < 10; i++) {
                num += parseInt(cpf[i]) * pesos[i+1];
            };
    
            let resto = num % 11;
            num = 0;
            dig1 = (resto === 0 || resto === 1) ? 0 : 11 - resto;
    
            for (let i = 0; i < 11; i++) {
                num += parseInt(cpf[i]) * pesos[i];
            };
    
            resto = num % 11;
            dig2 = (resto === 0 || resto === 1) ? 0 : 11 - resto;
    
            return (dig1 === parseInt(cpf[9]) && dig2 == parseInt(cpf[10])) ? true : false;
    
        } else {
            return false;
        };
    }

    return false;
}

function isEmailValid(email) {
    /**
     * Valida o formato do E-MAIL, aceitando apenas you@example.com.br
     * @param  {String} email Email a ser verificado.
     * @return {Boolean} true - válido || false - inválido.
     */

    let pattern = /^[a-zA-z0-9._-]+@[a-zA-z0-9._-]+\.[a-zA-Z]{2,}$/gm;

    if (email.match(pattern)) {
        return true;
    }

    return false;
}


function isTelephoneValid(telephone) {
    /**
     * Valida o formato do telefone
     * @param  {String} telephone Telefone a ser verificado.
     * @return {Boolean} true - válido || false - inválido.
     */

    let inputTelephone = document.querySelector('.input-control #telephone');

    telephone = telephone.replace(/\s/g, '');

    let pattern = /^\(?(?:[14689][1-9]|2[12478]|3[1234578]|5[1345]|7[134579])\)? ?(?:[2-8]|9[1-9])[0-9]{3}\-?[0-9]{4}$/gm;

    if (telephone.match(pattern)) {

        inputTelephone.value = telephone.replace(/^\((\d{2})\)(\d{5})(\d{4})$/gm, "$1$2$3");

        return true;
    }

    return false;

}

var check = false;

async function queryExistingData(email, cpf='') {

    $.ajax({
        async: false,
        method: "POST",
        url: "../assets/php/adminCheckExistingData.php",
        data: {
            'cpf': cpf,
            'email': email
        },
        success: function( response ) {

            if (response != '') {

                window.alert(response);

                check = false;

            } else {

                check = true;
            }
        }
    });
}

form.addEventListener('submit', (event) => {

    event.preventDefault();

    // Elementos input

    const inputFirstName = document.querySelector('.input-control #first-name');
    const inputLastName = document.querySelector('.input-control #last-name');
    const inputDateBirth = document.querySelector('.input-control #date-of-birth');
    const inputGender = document.querySelector('.input-control #gender');
    const inputCep = document.querySelector('.input-control #cep');
    const inputNumero = document.querySelector('.input-control #numero');
    const inputCpf = document.querySelector('.input-control #cpf');
    const inputEmail = document.querySelector('.input-control #email');
    const inputTelephone = document.querySelector('.input-control #telephone');
    const inputPsw = document.querySelector('.input-control #password');
    const inputConfirmPsw = document.querySelector('.input-control #confirm-password');
    const inputJob = document.querySelector('.input-control #job');

    // Validação individual

    if (inputFirstName.value == '' || !isNameValid(inputFirstName.value)) {

        window.alert('Campo PRIMEIRO NOME inválido ou vazio!');
        return;
    }

    if (inputLastName.value == '' || !isNameValid(inputLastName.value)) {

        window.alert('Campo ÚLTIMO NOME inválido ou vazio!');
        return;
    }

    if (inputDateBirth.value == '' || !isDateValid(inputDateBirth.value)) {

        window.alert('Campo DATA DE NASCIMENTO inválida ou vazia!');
        return;
    }

    let today = new Date();
    let inputDate = new Date(inputDateBirth.value);

    if ((today.getFullYear() - inputDate.getFullYear()) < 16) {

        window.alert(`A idade minima para cadastro é de 16 anos, você tem ${today.getFullYear() - inputDate.getFullYear()}`);
        return;
    }

    if (inputGender.value == '') {

        window.alert('Campo GÊNERO vazio!');
        return;
    }

    if (inputTelephone.value == '' || !isTelephoneValid(inputTelephone.value)) {

        window.alert('Campo TELEFONE CELULAR inválido ou vazio!');
        return;
    }

    if (inputCep.value == '') {

        window.alert('Campo CEP vazio!');
        return;
    }

    if (inputNumero.value == '') {

        window.alert('Campo NÚMERO vazio!');
        return;
    }


    if ((inputCpf.value == '' || !isCpfValid(inputCpf.value)) && !inputNoCpf) {

        window.alert('Campo CPF inválido ou vazio!');
        return;
    }

    if (inputEmail.value == '' || !isEmailValid(inputEmail.value)) {

        window.alert('Campo E-MAIL inválido ou vazio!');
        return;
    }

    if (inputPsw.value == '') {

        window.alert('Campo SENHA vazio!');
        return;
    } 

    if (inputPsw.value.length < 8) {

        window.alert('Sua senha deve ter no minimo 8 caracteres!');
        return;
    }

    if (inputConfirmPsw == '') {

        window.alert('Campo CONFIRMAR SENHA vazio!');
        return;
    }

    if (inputConfirmPsw.value.length < 8) {

        window.alert('As senhas não coincidem!');
        return;
    }

    if (inputPsw.value != inputConfirmPsw.value) {

        window.alert('As senhas não coincidem!');
        return;
    }

    if (inputJob.value == '') {

        window.alert('Selecione uma função!');
        return;
    }

    queryExistingData(inputEmail.value, inputCpf.value)

    if (!check) {
        return;
    }

    // Envia o formulário se tudo estiver válido.
    form.submit();
});