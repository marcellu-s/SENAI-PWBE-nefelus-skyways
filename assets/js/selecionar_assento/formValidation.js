const form = document.querySelector('main form');

$(document).ready(() => {
    form.addEventListener('submit', (event) => {
        
        event.preventDefault();

        if (assentosSelecionados.length == totalAssentos) {
            form.submit();
        } else {
            alert('Nem todos os lugares foram selecionados.');
        }
    });
});