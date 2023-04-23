// Input-control - TRECHO

const spanTrechoSelected = document.querySelector('.input-trecho #input-trecho-selected');
const inputRadio = document.querySelectorAll('.input-trecho input[type="radio"]');
let txt = '';

const inputReturn = document.querySelector('.booking-area .input-return');
const inputRelatd = inputReturn.querySelector('input');

inputRadio.forEach((el) => {
    el.addEventListener('change', (e) => {
        if (e.target.value == 'round-trip') {
            txt = 'Ida e volta';
            inputRelatd.required = true;
            inputReturn.classList.remove('occult');
        } else {
            txt = 'Só ida';
            inputRelatd.required = false;
            inputReturn.classList.add('occult');
        }

        spanTrechoSelected.textContent = txt;
    })
})

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

// Input-control - CLIENTE

let countAdult = 1;
let countKid = 0;
let countBaby = 0;
let countGeneral = 1;

const addAdult = document.querySelector('.input-cliente #add-adult');
const addKid = document.querySelector('.input-cliente #add-kid');
const addBaby = document.querySelector('.input-cliente #add-baby');

const removeAdult = document.querySelector('.input-cliente #remove-adult');
const removeKid = document.querySelector('.input-cliente #remove-kid');
const removeBaby = document.querySelector('.input-cliente #remove-baby');

const inputAdultPassenger = document.querySelector('.input-cliente #adult-passenger');
const inputChildPassenger = document.querySelector('.input-cliente #child-passenger');
const inputBabyPassenger = document.querySelector('.input-cliente #baby-passenger');



addAdult.addEventListener('click', () => {

    if (countGeneral < 9) {

        countAdult++;
        countGeneral++;
        
        const spanClientAdult = document.querySelector('#input-cliente-selected #adult');

        spanClientAdult.textContent = `${countAdult} Adulto(s)`;
        spanClientAdult.style.display = 'inline';
        inputAdultPassenger.value = countAdult;

    }
});

addKid.addEventListener('click', () => {

    if (countGeneral < 9) {

        countKid++;
        countGeneral++;

        const spanClientKid = document.querySelector('#input-cliente-selected #kid');

        spanClientKid.style.display = 'inline';
        spanClientKid.textContent = `${countKid} Criança(s)`;
        inputChildPassenger.value = countKid;
    }
});

addBaby.addEventListener('click', () => {

    if (countGeneral < 9) {

        countBaby++;
        countGeneral++; 

        const spanClientBaby = document.querySelector('#input-cliente-selected #baby');

        spanClientBaby.style.display = 'inline';
        spanClientBaby.textContent = `${countBaby} Bebê(s)`;
        inputBabyPassenger.value = countBaby;
    }
});

removeAdult.addEventListener('click', () => {

    if (countAdult > 0) {
        countAdult--;
        countGeneral--;
    }

    const spanClientAdult = document.querySelector('#input-cliente-selected #adult');

    if (countAdult > 0) {
        spanClientAdult.textContent = `${countAdult} Adulto(s)`;
    } else {
        spanClientAdult.style.display = 'none';
    }

    inputAdultPassenger.value = countAdult;
})

removeKid.addEventListener('click', () => {

    if (countKid > 0) {
        countKid--;
        countGeneral--;
    }

    const spanClientKid = document.querySelector('#input-cliente-selected #kid');

    if (countKid > 0) {
        spanClientKid.textContent = `${countKid} Criança(s)`;
    } else {
        spanClientKid.style.display = 'none';
    }

    inputChildPassenger.value = countKid;
})

removeBaby.addEventListener('click', () => {

    if (countBaby > 0) {
        countBaby--;
        countGeneral--;
    }

    const spanClientBaby = document.querySelector('#input-cliente-selected #baby');

    if (countBaby > 0) {
        spanClientBaby.textContent = `${countBaby} Bebê(s)`;
    } else {
        spanClientBaby.style.display = 'none';
    }

    inputBabyPassenger.value = countBaby;
})