const allDropdowns = document.querySelectorAll('.input-control .dropdown');

document.addEventListener('mousedown', (event) => {

    allDropdowns.forEach((dropdown) => {

        if (dropdown.contains(event.target)) {

            dropdown.classList.remove('dropdown-hide');

            dropdown.querySelector('img').classList.add('img-rotate');
        } else {
            
            dropdown.classList.add('dropdown-hide');
            
            dropdown.querySelector('img').classList.remove('img-rotate');
        }
    });
});