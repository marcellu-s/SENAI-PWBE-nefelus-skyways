// Função de operações de cancelamento e pagar agora - PASSAGENS
function payment() {

    let selectPayment = document.querySelector('#payment');

    if (selectPayment == undefined) {

        return;
    }

    // function payNow() {

    //     fetch('../assets/php/paymentOptions.php?option=pay-now')
    //     .then((response) => console.log(response))
    //     .catch((error) => console.log(error));
    // }

    selectPayment.addEventListener('change', function() {

        if (this.value == 'cancel') {

            let th = document.createElement('th');  
            th.textContent = 'Método de pagamento';

            let td = document.createElement('td');
            td.innerHTML = `
            <select id='method-payment' name='method-payment'>
                <option value='' selected disabled>Selecione a forma de pagamento</option>
                <option value='c'>Cartão de crédito</option>
                <option value='d'>Cartão de débito</option>
                <option value='p'>PIX</option>
            </select>`;

            document.querySelector('thead tr').appendChild(th);
            document.querySelector('t')

            console.log('para cancelar');

        } else if (this.value == 'pay-now') {

            console.log('pagar agora');
        }
    })
}

// API viaCEP

function requestViaCEP() {

    document.querySelector('.input-control #cep').addEventListener('change', function() {

        let cep = this.value.replace(/[^0-9]/g, '');

        if (cep == '' || cep.length < 8) {

            window.alert('CEP inválido!');
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then((response) => response.json())

        .then((json) => {

            document.querySelector('.input-control #cep').value = cep;
            document.querySelector('.input-control #endereco').value = json.logradouro;
            document.querySelector('.input-control #bairro').value = json.bairro;
            document.querySelector('.input-control #cidade').value = json.localidade;
            document.querySelector('.input-control #uf').value = json.uf;
        })

        .catch((error) => {
            window.alert('ERRO na requisição da API! Tente novamente!');
            console.log(error);
        });

    });
}

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

        if (json != '') {

            document.querySelector('.request-option-area').innerHTML = json

            requestCountry();

            validateEditProfileForm();

            requestViaCEP();
        }
    })

    .catch((error) => {
        console.log(error);
        window.alert('Aconteceu um erro! Recarregue a página e tente novamente');
    });
};

document.querySelector('.show-travels').onclick = () => {

    fetch('../assets/php/matchOptionView.php?option=show-travels')
    .then((response) => response.json())

    .then((json) => {

        document.querySelector('.request-option-area').innerHTML = json
    })

    .catch((error) => {
        console.log(error);
        window.alert('Aconteceu um erro! Recarregue a página e tente novamente');
    })
}

document.querySelector('.passagens').onclick = () => {

    fetch('../assets/php/matchOptionView.php?option=passagens')
    .then((response) => response.json())

    .then((json) => {

        document.querySelector('.request-option-area').innerHTML = json;

        // payment();
    })

    .catch((error) => {
        console.log(error);
        window.alert('Aconteceu um erro! Recarregue a página e tente novamente');
    });
}