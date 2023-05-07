const optView = document.querySelector('#view');
const responseQuerySelection = document.querySelector('.response-query-selection');

optView.addEventListener('change', function() {

    $.ajax({
        method: "GET",
        url: "../assets/php/viewOption.php",
        data: {
            choice: this.value
        },
        async: true,
        success: function( response ) {
    
            let json = JSON.parse(response);

            if (json == null) {
                
                document.querySelector('.dashboard #record-counter').textContent = '----';

                window.alert('Sem registros');
                return;
            }
        
            responseQuerySelection.classList.remove('hide');

            // Trocando o THEAD

            let thead = document.querySelector('table thead');
            let theadTrReference = document.querySelector('table thead tr');

            let theadTr = document.createElement('tr');

            json[0].forEach((data) => {

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


            for (let i = 1; i < json.length; i++) {

                let tbodyTr = document.createElement('tr');

                for (let data = 0; data < json[i].length; data++) {

                    let tbodyTd = document.createElement('td');

                    if ((json[i].length - 2) == data) {
                        tbodyTd.innerHTML = json[i][data];
                    } else if ((json[i].length - 1) == data) {
                        tbodyTd.innerHTML = json[i][data];
                    } else {
                        tbodyTd.textContent = json[i][data];
                    }

                    tbodyTr.appendChild(tbodyTd);
                }

                tbody.appendChild(tbodyTr);

            }

            document.querySelector('.dashboard #record-counter').textContent = (json.length - 1)+' registro(s)';

        }
    });
});