const closeModalButton = document.querySelector('#close-modal');
const modal = document.querySelector('#modal');
const fade = document.querySelector('#fade');

const toggleModal = () => [modal, fade].forEach((el) => el.classList.toggle('hide'));

[closeModalButton, fade].forEach((el) => el.addEventListener('click', toggleModal));

function updateModalTriggerElements() {
    /**
     * Atualizar elementos ativadores do modal
     */

    const openModal = document.querySelectorAll('.flight .open-modal');

    openModal.forEach((trigger) => {
        trigger.addEventListener('click', (evento) => {

            // Caminho para encontrar o input contendo o ID do voo, para ser feita a requisição ao servidor
            // do conteúdo correto;

            let triggerElement = evento.target;
            let triggerParentElement = triggerElement.parentElement;
            let wrapperFlightElement = triggerParentElement.parentElement;

            // Input[type="hidden"] - Contendo o ID do voo
            let inputIdFlight = wrapperFlightElement.querySelector('.input-flight').value; 
    
            // ajaxRequestForModalDetails(inputIdFlight);
            
            toggleModal();
        });
    });
}

function ajaxRequestForModalDetails(flightId) {
    /**
     * Requisição AJAX dos Detalhes do Modal
     * @param flightId Input[type="hidden"] - Contendo o ID do voo
     */

    // Pegando os elementos que teram troca de valor no modal

    const headerTitle = document.querySelector('.modal-header h2');
    const flightDuration = document.querySelector('.modal-body .duration span');
    const flightIdElement = document.querySelector('.modal-body .flight-id span');
    const travelFromInfoLocation = document.querySelector('.modal-body #travel-from-info-location');
    const travelFromInfoDatetime = document.querySelector('.modal-body #travel-from-info-datetime');
    const goingToInfoLocation = document.querySelector('.modal-body #going-to-info-location');
    const goingToInfoDatetime = document.querySelector('.modal-body #going-to-info-datetime');
    const airplaneInfo = document.querySelector('.modal-body .airplane-info span');

    // ----------------------------------------------------- //

    // Requisição AJAX

    $.ajax({

        async: true,
        method: "POST",
        url: "../../assets/php/dados.php",
        data: {
            flightID: flightId
        },
        success: function( response ) {

            let data = JSON.parse(response);

            headerTitle.textContent = data.title;
            flightDuration.textContent = data.duration;
            flightIdElement.textContent = data.idVoo;
            travelFromInfoLocation.textContent = data.travelFromLocation;
            travelFromInfoDatetime.textContent = data.travelFromDatetime;
            goingToInfoLocation.textContent = data.goingToLocation;
            goingToInfoDatetime.textContent = data.goingToDatetime;
            airplaneInfo.textContent = data.airPlaneInfo;
        }
    });
    
}

// Atualizar elementos ativadores do modal, assim que o DOM carregar pela primeira vez;
$(document).ready(updateModalTriggerElements());