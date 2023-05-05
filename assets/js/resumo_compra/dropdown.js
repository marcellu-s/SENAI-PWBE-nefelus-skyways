function dropdownToggle() {

    dropdown.classList.toggle('show');
}

function selectItem(item) {

    inputFormPayment.value = item;
}


const dropdown = document.querySelector('.form-payment-area .dropdown-form-payment');
const dropdownItem = document.querySelectorAll('.dropdown-form-payment-menu li');
const inputFormPayment = document.querySelector('.dropdown-form-payment #form-payment');

dropdown.addEventListener('click', dropdownToggle);

window.addEventListener('click', (event) => {

    if (!event.target.matches('.input-with-icon') && !event.target.matches('.input-icon')) {

        dropdown.classList.remove('show');
    }
});

dropdownItem.forEach((item) => {

    item.addEventListener('click', function() {

        selectItem(this.textContent);
    });
});