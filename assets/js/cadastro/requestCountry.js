// Requisição aos paises para coloca-los no select de nacionalidade

// URL da API
const url = "https://servicodados.ibge.gov.br/api/v1/paises/{paises}";

// SELECT
const selectNacionality = document.querySelector('.input-control #nationality');

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

fetch(url).then((response) => response.json()).then((json) => {

    let prev = '';
    let prevSigla = '';

    json.forEach((pais) => {

        let nome = pais.nome.abreviado.toLocaleLowerCase();
        let sigla = pais.id['ISO-3166-1-ALPHA-3'];

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