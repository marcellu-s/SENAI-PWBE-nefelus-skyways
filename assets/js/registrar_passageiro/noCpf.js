const inputCPF = document.querySelector('.input-control #cpf');
const labelCPF = document.querySelector('.input-control #cpf-label');
const inputCheckboxNoCPF = document.querySelector('.input-control #no-cpf');

inputCheckboxNoCPF.addEventListener('change', (event) => {
    
    if (event.target.checked) {

        inputCPF.style.opacity = 0.5;
        labelCPF.style.opacity = 0.5;

        inputCPF.value = '';
        inputCPF.required = false;
        inputCPF.disabled = true;
    } else {

        inputCPF.style.opacity = 1;
        labelCPF.style.opacity = 1;

        inputCPF.disabled = false;
        inputCPF.required = true;
    }
})