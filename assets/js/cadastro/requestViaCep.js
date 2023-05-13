const inputCep = document.querySelector('.input-control #cep');
const inputEndereco = document.querySelector('.input-control #endereco');
const inputBairro = document.querySelector('.input-control #bairro');
const inputCidade = document.querySelector('.input-control #cidade');
const inputUf = document.querySelector('.input-control #uf');

inputCep.addEventListener('change', () => {

    // Garantir que apenas números serão inseridos no campo 'CEP'.
    inputCep.value = inputCep.value.replace(/[^0-9]/g, '');
    
    // Quando 8 números forem inseridos fazer uma requisição para a API 'ViaCEP'.
    if (inputCep.value.length === 8) {

        fetch(`https://viacep.com.br/ws/${inputCep.value}/json/`)
            .then(resposta => resposta.json())
            .then(data => {

                // Caso o CEP não exista, o usuário é avisado.
                if (data.erro) {
                    alert('CEP Inválido');
                    inputCep.value = '';
                } else {

                    // Em caso de sucesso, essas 3 variáveis receberão informações baseadas no CEP.
                    const endereco = `${data.logradouro}`;
                    const bairro = `${data.bairro}`;
                    const cidade = `${data.localidade}`;
                    const uf = `${data.uf}`;

                    // O valor dos campos será substituído pelas variáveis.
                    inputEndereco.value = endereco;
                    inputBairro.value = bairro;
                    inputCidade.value = cidade;
                    inputUf.value = uf;
                };
            });
    } else {

        window.alert('Um CEP válido é composto por 8 dígitos')
    }

    // Se o usuário apagar o CEP todos os outros campos serão resetados.
    if (inputCep.value.length < 8) {
        inputEndereco.value = '';
        inputBairro.value = '';
        inputCidade.value = '';
        inputUf.value = '';
    };
});