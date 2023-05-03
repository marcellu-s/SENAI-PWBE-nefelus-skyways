const form = document.querySelector('.register-passenger-area form');

function isNameValid(name) {
    /**
     * Verificar se o nome contém apenas letras.
     * @param  {String} name Nome a ser verificado.
     * @return {Boolean} true - inválido || false - válido.
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
     * @return {Boolean} True ou False.
     */

    let today = new Date();
    let dateInput = new Date(date);

    console.log(typeof date);

    if (dateInput > today) {
        // Inválida
        return true;
    } else {
        // Valída
        return false;
    }
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
    const inputRg = document.querySelector('.input-control #rg');
    const inputCpf = document.querySelector('.input-control #cpf');
    const inputNoCpf = document.querySelector('.input-control #no-cpf'); // Checkbox
    const inputEmail = document.querySelector('.input-control #email');
    const inputDdi = document.querySelector('.input-control #ddi');
    const inputTelephone = document.querySelector('.input-control #telephone');

    // Validação individual

    if (inputFirstName.value == '' || !isNameValid(inputFirstName.value)) {
    
        window.alert('PRIMEIRO NOME inválido ou vazio!');
        return;
    }

    if (inputLastName.value == '' || !isNameValid(inputLastName.value)) {

        window.alert('ÚLTIMO NOME inválido ou vazio!');
        return;
    }

    if (inputDateBirth.value == '' || !isDateValid(inputDateBirth.value)) {

        window.alert('DATA DE NASCIMENTO inválida ou vazia!');
        return;
    }

});