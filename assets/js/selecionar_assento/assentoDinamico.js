var assentosSelecionados = [];
var assento;
const totalAssentos = Number(document.querySelector('#total-passenger').value);
var qntSelecionados = Number(document.querySelector('#passenger-count').value);
var spanInfo = document.querySelector('#span-info');

const flightId = document.querySelector('#flight-selected').value;

$(document).ready(() => {

    console.log(flightId)
    console.log('aaaaaaaa')

    // QUERY PHP QUE RETORNA EM JSON O PREÇO DO TIPO DE ASSENTO
    $.ajax({
        url: "../../assets/php/dados.php",
        method: "POST",
        dataType: "json",
        data: {
            request: 'assento',
            flightID: flightId
        },
        success: function(response) {
            precoAssentos = response;
            return response;
        },
        error: function(xhr, status, error) {
            console.log("Erro ao fazer a requisição: " + error);
        }
    });

    
    $('.seat').click(function() {
        assento = $(this);

        if (!this.classList.contains('unavailable')) {
            if (qntSelecionados < totalAssentos || this.classList.contains('selected')) {
                $(this).toggleClass('selected');
            }
        } else {
            alert('Assento já ocupado.');
        }
    });
    
    $('.btn-confirm').click(() => {
        assentosSelecionados.push(assento.html());
        $(('#seat-' + qntSelecionados)).val(assentosSelecionados[qntSelecionados]);

        if (letterToNumber(assento.html()[0]) < 8) {
            console.log('aaaaaaaccccccccc')
            $(('#price-seat-' + qntSelecionados)).val(precoAssentos.premium);
        } else {
            console.log('aaaaaaabbbbbbbbb')
            $(('#price-seat-' + qntSelecionados)).val(precoAssentos.economico);
        }
        qntSelecionados += 1;
        spanInfo.innerHTML = `(${qntSelecionados}/${totalAssentos} - ${qntSelecionados >= totalAssentos ? 'Todos selecionados' : document.querySelector(('#first-name-passenger-' + qntSelecionados)).value})`;
    });
});

