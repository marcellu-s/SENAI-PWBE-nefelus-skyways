// Endereço

// Definir os campos que serão analisados/alterados.
const cepInput = document.getElementsByName('cep')[0];
const enderecoInput = document.getElementsByName('endereco')[0];
const bairroInput = document.getElementsByName('bairro')[0];
const cidadeInput = document.getElementsByName('cidade')[0];
const numeroInput = document.getElementsByName('numero')[0];

cepInput.addEventListener('focusout', () => {

    // Garantir que apenas números serão inseridos no campo 'CEP'.
    cepInput.value = cepInput.value.replace(/[^0-9]/g, '');
    
    // Quando 8 números forem inseridos fazer uma requisição para a API 'ViaCEP'.
    if (cepInput.value.length === 8) {
        fetch(`https://viacep.com.br/ws/${cepInput.value}/json/`)
            .then(resposta => resposta.json())
            .then(data => {

                // Caso o CEP não exista, o usuário é avisado.
                if (data.erro) {
                    alert('CEP Inválido');
                    cepInput.value = '';
                } else {

                    // Em caso de sucesso, essas 3 variáveis receberão informações baseadas no CEP.
                    const endereco = `${data.logradouro}`;
                    const bairro = `${data.bairro}`;
                    const cidade = `${data.localidade}/${data.uf}`;

                    // O valor dos campos será substituído pelas variáveis.
                    enderecoInput.value = endereco;
                    bairroInput.value = bairro;
                    cidadeInput.value = cidade;
                };
            });
    };

    // Se o usuário apagar o CEP todos os outros campos serão resetados.
    if (cepInput.value.length < 8) {
        enderecoInput.value = '';
        bairroInput.value = '';
        cidadeInput.value = '';
    };
});

numeroInput.addEventListener('input', () => {

    // Garantir que apenas números serão inseridos no campo 'Nº'.
    numeroInput.value = numeroInput.value.replace(/[^0-9]/g, '');
});

// CPF

// Definir o campo 'CPF'.
const cpfInput = document.getElementsByName('cpf')[0];

cpfInput.addEventListener('focusout', () => {

    // Garantir que apenas números serão inseridos no campo 'CPF'.
    cpfInput.value = cpfInput.value.replace(/[^0-9]/g, '');
    
    // Quando 11 números forem inseridos, executar a função 'validarCPF'.
    if (cpfInput.value.length === 11) {
        if (validarCPF(cpfInput.value) === false) {
            alert('CPF Inválido');
            cpfInput.value = '';
        } else {
            alert('CPF Válidado.')
        };
    };

    
});

function validarCPF(cpf) {
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
};

// RG

const rgInput = document.getElementsByName('rg')[0];

rgInput.addEventListener('focusout', () => {

    rgInput.value = rgInput.value.replace(/[^0-9X]|(?<=x.*)x/gi, '');

    if (rgInput.value.length === 9) {
        const rgAno = prompt('Em que ano seu RG foi emitido?');

        if ((/^\d{4}$/.test(rgAno))) {
            let anoAtual = new Date().getFullYear();
            let anoValidade = anoAtual - 10;
            let anoInput = parseInt(rgAno);
            
            if (anoInput < anoValidade) {
                alert('RG com mais de 10 anos, por favor renove seu RG.');
                rgInput.value = '';
            } else {
                alert('RG Válidado.')
            }
    
        } else {
            alert("O ano digitado é inválido.");
            rgInput.value = '';
        }
    };
});

// Celular

const celularInput = document.getElementsByName('celular')[0];

celularInput.addEventListener('focusout', () => {
    celularInput.value = celularInput.value.replace(/[^0-9]/g, '');

    if (celularInput.value.length === 11) {
        const ddd = `${celularInput.value[0]}${celularInput.value[1]}`
        if (!(ddd >= 11 && ddd <= 67 && celularInput.value[2] === '9')) {
            alert('Celular Inválido');
            celularInput.value = '';
        }
    };
});