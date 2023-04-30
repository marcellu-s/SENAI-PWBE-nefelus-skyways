// Função para deixar a primeiro letra maiúscula
function capitalize(txt) {
    const str = txt;

    //split the above string into an array of strings 
    //whenever a blank space is encountered

    const arr = str.split(" ");

    //loop through each element of the array and capitalize the first letter.

    for (var i = 0; i < arr.length; i++) {
        arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);

    }

    const str2 = arr.join(" ");

    return str2;
}

// Input
const inputTravelFrom = document.querySelector('.input-travel-from #travel-from');
const inputGoingTo = document.querySelector('.input-going-to #going-to')

// Area de pesquisa
const arrayInputSearchArea = document.querySelectorAll('.booking-area .input-search-area');

// Eventos para mostrar ou ocultar a area de pesquisa
[inputTravelFrom, inputGoingTo].forEach((input) => {

    input.addEventListener('click', (evento) => {

        let parentElement = evento.target.parentElement;

        let referencesInputSearchArea = parentElement.querySelector('.input-search-area');

        referencesInputSearchArea.classList.toggle('searching');
    
    });
});

// Evento para disparar a função de busca por AJAX
inputTravelFrom.addEventListener('keyup', function() {

    if (inputTravelFrom.value != '') {
        ajaxSearch(inputTravelFrom.value, 'inputTravelFrom');
        selectOption();
    } else {
        ajaxSearch();
        selectOption();
    }
});

inputGoingTo.addEventListener('keyup', function() {

    if (inputGoingTo.value != '') {
        ajaxSearch(inputGoingTo.value, 'inputGoingTo');
        selectOption();
    } else {
        ajaxSearch();
        selectOption();
    }
});

// Função que executa o AJAX
function ajaxSearch(search, inputRefence) {

    function bothInputSearchArea(response) {

        arrayInputSearchArea.forEach((inputSearchArea) => {
            inputSearchArea.innerHTML = response;
        });
    }



    $.ajax({
        method: "POST",
        url: "../../assets/php/showairports.php",
        data: {
            q: search
        },
        async: false,
        success: function( response ) {
            
            if (!search && !inputRefence) {
                bothInputSearchArea(response);
            } else if (inputRefence == 'inputGoingTo') {
                document.querySelector('.input-going-to .input-search-area').innerHTML = response;
            } else if (inputRefence == 'inputTravelFrom') {
                document.querySelector('.input-travel-from .input-search-area').innerHTML = response;
            }
        }
    });
}

function selectOption() {

    let allSpans = document.querySelectorAll('.input-search-area span');

    allSpans.forEach((span) => {

        span.addEventListener('click', (evento) => {

            let searchAreaReference = evento.target.parentElement;
            
            let inputRefence = searchAreaReference.parentElement.querySelector('input');

            inputRefence.value = capitalize(evento.target.textContent);
        });
    });
}

// Executar a função AJAX quando o DOM estiver carregado, para buscar todos os dados
$(document).ready(function() {
    ajaxSearch();
    selectOption();
})