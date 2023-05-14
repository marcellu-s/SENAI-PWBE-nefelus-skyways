const optView = document.querySelector('#view');
const responseQuerySelection = document.querySelector('.response-query-selection');

function getLink() {
    
    try {

        var links = document.querySelectorAll('.links-wrapper a');

        links.forEach((link) => {

            link.addEventListener('click', (event) => {

                event.preventDefault();
    
                let linkTarget = link.className;

                linkTarget = linkTarget.split(' ');

                ajaxRequest(linkTarget[1], linkTarget[0]);

            });
        });
        
    } catch (error) {
        console.log(error);
    }
}


function ajaxRequest(escolha, pagina='') {

    $.ajax({
        async: true,
        method: "GET",
        url: "../assets/php/viewOption.php",
        data: {
            choice: escolha,
            pag: pagina
        },
        success: function( response ) {

            if (response == '' ) {
                window.alert('Sem registros');
                return;
            }

            const json = JSON.parse(response);

            document.querySelector('.response-query-selection thead').innerHTML = json[0];
            document.querySelector('.response-query-selection tbody').innerHTML = json[1];

            document.querySelector('.response-query-selection').classList.remove('hide');

            document.querySelector('.dashboard #record-counter').textContent = json[2]+' registro(s)';

            document.querySelector('.pagination .links-wrapper').innerHTML = json[3];

            getLink();

        }
    });
}

optView.addEventListener('change', function() {

    ajaxRequest(this.value)
});