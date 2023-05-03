const dropdownNationality = document.querySelector('.input-control .dropdown-nationality .dropdown-menu');
const dropdownDDI = document.querySelector('.input-control .dropdown-ddi .dropdown-menu');

const url = "https://api-paises.pages.dev/paises.json";

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

function addItem(itemDDI, itemNationality) {

    dropdownNationality.appendChild(itemNationality);
    dropdownDDI.appendChild(itemDDI);
}

function createElement(dataDDI, dataNationality) {

    let liDDI = document.createElement('li');
    liDDI.classList.add('dropdown-item');
    liDDI.textContent = dataDDI;

    let liNationality = document.createElement('li');
    liNationality.classList.add('dropdown-item');
    liNationality.textContent = dataNationality;

    addItem(liDDI, liNationality);
}

async function countryRequest() {

    await fetch(url)
        .then((response) => response.json())
        .then((json) => {

            for (let i = 0; i < 236; i++) {

                let name = json[i].pais;

                let ddi = json[i].ddi;

                createElement(`${name} +${ddi}`, name);
            }
        })
        .catch((error) => console.log(error));

    // Essa função apenas executará, quando o código acima ser finalizado; 
    selectDropdownItem();
}

document.onload = countryRequest();