const form = document.querySelector('.choose-your-flight form');
const inputsForm = document.querySelectorAll('form input');

form.addEventListener('submit', (evento) => {

    evento.preventDefault();

    let inputsChecked = Array.from(inputsForm).filter((input) => {
    
        return input.checked;
    });

    if (inputsChecked.length > 1 || inputsChecked.length < 1) {

        window.alert('Selecione apenas um para continuar!');
        return
    }

    console.log('pode passar');
});