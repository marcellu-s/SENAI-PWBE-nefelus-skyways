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

            let json = JSON.parse(response);

            let jsonMainData = JSON.parse(json[0]);
            let jsonPagination = JSON.parse(json[1]);

            let linskWrapper = document.querySelector('.links-wrapper');

            linskWrapper.innerHTML = '';

            responseQuerySelection.classList.remove('hide');

            // Trocando o THEAD

            let thead = document.querySelector('table thead');
            let theadTrReference = document.querySelector('table thead tr');

            let theadTr = document.createElement('tr');

            jsonMainData[0].forEach((data) => {

                let th = document.createElement('th');
                th.textContent = data;
                theadTr.appendChild(th);
            });

            thead.replaceChild(theadTr, theadTrReference);

            // TROCANDO O TBODY

            let tbody = document.querySelector('table tbody');
            let arrayTrTbody = document.querySelectorAll('table tbody tr');

            // LIMPANDO O TBODY

            arrayTrTbody.forEach((tr) => {

                tbody.removeChild(tr);
            });

            // ADICIONANDO NOVOS TR


            for (let i = 1; i < jsonMainData.length; i++) {

                let tbodyTr = document.createElement('tr');

                for (let data = 0; data < jsonMainData[i].length; data++) {

                    let tbodyTd = document.createElement('td');

                    if ((jsonMainData[i].length - 1) == data) {
                        tbodyTd.innerHTML = jsonMainData[i][data];
                    } else {
                        tbodyTd.textContent = jsonMainData[i][data];
                    }

                    tbodyTr.appendChild(tbodyTd);
                }

                tbody.appendChild(tbodyTr);

            }

            document.querySelector('.dashboard #record-counter').textContent = (jsonMainData.length - 1)+' registro(s)';

            linskWrapper.innerHTML += jsonPagination;

            // jsonPagination.forEach((link) => {

            //     linskWrapper.innerHTML += link;
            // });

            getLink();

        }
    });
}

optView.addEventListener('change', function() {

    ajaxRequest(this.value)
});