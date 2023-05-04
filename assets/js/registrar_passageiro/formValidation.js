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

function isRgValid(rg) {
    /**
     * Valida o formato do RG, e substitui os caracteres que não são digitos.
     * @param  {String} rg Númro do rg a ser verificado.
     * @return {Boolean} true - válido || false - inválido.
     */

    let inputRg = document.querySelector('.input-control #rg');

    let pattern = /^(\d{2})[.-]?(\d{3})[.-]?(\d{3})[.-]?([\dxX]{1})/gm;

    if (rg.match(pattern)) {

        rg = rg.replace(pattern, "$1$2$3$4");
        inputRg.value = rg;
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
        return true;
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

function isDDIValid(ddi) {
    /**
     * Valida o formato do DDI e substitui os caracteres para isso, Brasil +55, ficar assim, +55
     * @param  {String} ddi DDI a ser verificado.
     * @return {Boolean} true - válido || false - inválido.
     */

    let inputDdi = document.querySelector('.input-control #ddi');

    ddi = ddi.replace(/\s/g, '');

    let pattern = /^([A-Za-z]{1,})([+]\d{1,3})$/gm;

    if (ddi.match(pattern)) {

        ddi = ddi.replace(pattern, "$2");
        inputDdi.value = ddi;
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

function isAllDatesValid(dateBirth, passportDateIssue, rgDateIssue) {
    /**
     * Valida se as datas de emissão do passaporte e RG são maiores que a data de nascimento
     * @param  {String} dateBirth Data de nascimento.
     * @param  {String} passportDateIssue Data de emissão do passaporte.
     * @param  {String} rgDateIssue Data de emissão do RG.
     * @return {Boolean} true - válido || false - inválido.
     */

    let checkDateBirth = new Date(dateBirth);
    let checkPassportDateIssue = new Date(passportDateIssue);
    let checkRgDateIssue = new Date(rgDateIssue);

    debugger;

    if ((checkPassportDateIssue <= checkDateBirth) || (checkRgDateIssue <= checkDateBirth)) {

        return false;
    }

    return true;

}

form.addEventListener('submit', (event) => {

    event.preventDefault();

    // Elementos input

    const inputFirstName = document.querySelector('.input-control #first-name');
    const inputLastName = document.querySelector('.input-control #last-name');
    const inputDateBirth = document.querySelector('.input-control #date-of-birth');
    const inputGender = document.querySelector('.input-control #gender');
    const inputNationality = document.querySelector('.input-control #nationality');
    const inputPassport = document.querySelector('.input-control #passport');
    const inputPassportDateIssue = document.querySelector('.input-control #passport-date-of-issue');
    const inputRg = document.querySelector('.input-control #rg');
    const inputRgDateIssue = document.querySelector('.input-control #rg-date-of-issue');
    const inputCpf = document.querySelector('.input-control #cpf');
    const inputNoCpf = document.querySelector('.input-control #no-cpf').checked; // Checkbox
    const inputEmail = document.querySelector('.input-control #email');
    const inputDdi = document.querySelector('.input-control #ddi');
    const inputTelephone = document.querySelector('.input-control #telephone');

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

    if (inputGender.value == '') {

        window.alert('Campo GÊNERO vazio!');
        return;
    }

    if (inputNationality.value == '') {

        window.alert('Campo NACIONALIDADE vazio!');
        return;
    }

    if (inputPassport.value == '' || !isPassportValid(inputPassport.value)) {

        window.alert('Campo PASSAPORTE inválido ou vazio!');
        return;
    }

    if (inputPassportDateIssue.value == '' || !isDateIssueValid(inputPassportDateIssue.value)) {

        window.alert('Campo DATA DE EMISSÃO do PASSAPORTE inválido ou vazio! OBS: O passaporte é válido durante 10 anos, após sua emissão');
        return;
    }

    if (inputRg.value == '' || !isRgValid(inputRg.value)) {

        window.alert('Campo RG inválido ou vazio!');
        return;
    }

    if (inputRgDateIssue.value == '' || !isDateIssueValid(inputRgDateIssue.value)) {

        window.alert('Campo DATA DE EMISSÃO do RG inválido ou vazio! OBS: O RG é válido durante 10 anos, após a emissão');
    }

    if ((inputCpf.value == '' || !isCpfValid(inputCpf.value)) && !inputNoCpf) {

        window.alert('Campo CPF inválido ou vazio!');
        return;
    }

    if (inputEmail.value == '' || !isEmailValid(inputEmail.value)) {

        window.alert('Campo E-MAIL inválido ou vazio!');
        return;
    }

    if (inputDdi.value == '' || !isDDIValid(inputDdi.value)) {

        window.alert('Campo DDI inválido ou vazio!');
    }

    if (inputTelephone.value == '' || !isTelephoneValid(inputTelephone.value)) {

        window.alert('Campo TELEFONE CELULAR inválido ou vazio!');
        return;
    }

    if (!isAllDatesValid(inputDateBirth.value, inputPassportDateIssue.value, inputRgDateIssue.value)) {

        window.alert('As datas de emissão de documentos não podem ser menores que a de seu nascimento!');
        return;
    }

    // Envia o formulário se tudo estiver válido.
    // form.submit();
});