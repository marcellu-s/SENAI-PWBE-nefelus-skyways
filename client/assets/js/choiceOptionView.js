// Request de paises para o SELECT de nacionalidade

function requestCountry() {

    const selectNacionality = document.querySelector('.input-control #nacionality');

    function createElement(content, sigla) {
        /**
         * Criar elementos para colocalos no SELECT de nacionalidade
         * @param content conteudo do elemento (nome do pais)
         */
    
        let option = document.createElement('option');
        option.setAttribute('value', sigla);
        option.textContent = content;
        selectNacionality.appendChild(option);
    }

    const url = `https://servicodados.ibge.gov.br/api/v1/paises/{}`;

    fetch(url).then((response) => response.json()).then((json) => {

        let prev = '';
        let prevSigla = '';
    
        json.forEach((pais) => {
    
            let nome = pais.nome.abreviado.toLocaleLowerCase();
            let sigla = pais.id['ISO-3166-1-ALPHA-2'];
    
            if (nome != prev && sigla != prevSigla) {
    
                createElement(nome, sigla);
            }
    
            prev = nome;
            prevSigla = sigla;
        });
    }).catch((error) => {
        window.alert('Encontramos um erro! Tente recarregar a página!');
        console.log(error);
    });
}

// Validar o formulario de edição, caso selecionado

function validateEditProfileForm() {

    const form = document.querySelector('.request-edit-profile form');

    form.addEventListener('submit', (event) => {

        event.preventDefault();

        const inputFirstName = document.querySelector('.input-control #first-name');
        const inputLastName = document.querySelector('.input-control #last-name');
        const inputGender = document.querySelector('.input-control #gender');
        const inputNationality = document.querySelector('.input-control #nacionality');
        const inputCep = document.querySelector('.input-control #cep');
        const inputNumero = document.querySelector('.input-control #numero');
        const inputEmail = document.querySelector('.input-control #email');
        const inputTelephone = document.querySelector('.input-control #telephone');
        const inputOldPsw = document.querySelector('.input-control #old-password');
        const inputNewPsw = document.querySelector('.input-control #new-password');

        if (
            inputFirstName.value == '' ||
            inputLastName.value == '' ||
            inputGender.value == '' ||
            inputNationality.value == '' ||
            inputCep.value == '' ||
            inputNumero.value == '' ||
            inputEmail.value == '' ||
            inputTelephone.value == ''
        ) {

            window.alert('Nenhum campo pode estar vazio, exeto os de troca de senha!');
            return;
        }

        form.submit();
    });
}

// Eventos para a opção de visualização do cliente sobre a conta

document.querySelector('.edit-profile').onclick = () => {

    fetch('../assets/php/matchOptionView.php?option=edit-profile')
    .then((response) => response.json())

    .then((json) => {
        document.querySelector('.request-option-area').innerHTML = json

        requestCountry();

        validateEditProfileForm();
    })

    .catch((error) => console.log(error));
};