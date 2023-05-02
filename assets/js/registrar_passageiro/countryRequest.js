const dropdownNationality = document.querySelector('.input-control .dropdown-nationality .dropdown-menu');

const url = 'https://servicodados.ibge.gov.br/api/v1/paises/{paises}';

function selectDropdownItem() {

    const allDropdownMenuItem = document.querySelectorAll('.dropdown-menu .dropdown-item');

    allDropdownMenuItem.forEach((item) => {

        item.addEventListener('click', (event) => {
    
            // Procurando o elemento input referente ao disparador do evento
    
            let li = event.target.parentElement;
    
            let dropdownMenu = li.parentElement;
    
            let dropdown = dropdownMenu.parentElement;
    
            let inputReference = dropdown.querySelector('input');
    
            inputReference.value = event.target.textContent;
        })
    })
}

function addItem(item) {

    dropdownNationality.appendChild(item);
}

function createElement(data) {

    let li = document.createElement('li');
    li.classList.add('dropdown-item');
    li.textContent = data;

    addItem(li);
}

async function countryRequest() {

    await fetch(url)
            .then((response) => response.json())
            .then((json) => {

                    let prev = '';

                    [...json].forEach(element => {

                    let nome = element.nome.abreviado;

                    if (nome != prev) {

                        prev = nome;
                        createElement(nome);
                    }

                });
            })
            .catch((error) => {
                console.log(error);
            });

    console.log('teste');
    
    selectDropdownItem();
}

countryRequest();