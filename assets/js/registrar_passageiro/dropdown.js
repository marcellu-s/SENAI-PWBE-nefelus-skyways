function dropdownToggle(dropdownParam) {

    dropdownParam.classList.toggle('show');
}

const arrayDropdown = document.querySelectorAll('.input-control .dropdown');

arrayDropdown.forEach((dropdown) => {

    dropdown.addEventListener('click', () => {
        
        dropdownToggle(dropdown);
    });
});

window.addEventListener('click', (event) => {

    if (!event.target.matches('.input-with-icon') && !event.target.matches('.input-icon')) {

        arrayDropdown.forEach((dropdown) => dropdown.classList.remove('show'));
    }
});