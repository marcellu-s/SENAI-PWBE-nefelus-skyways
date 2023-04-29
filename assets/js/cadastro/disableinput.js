// Ao clicar em "Não sou brasileiro e não tenho CPF", desabilitar o input de CPF

const inputNoCpf = document.querySelector(".input-control #no-cpf");
const inputCpf = document.querySelector('.input-control #cpf');
const labelCpf = document.querySelector('.input-control #label-cpf');

inputNoCpf.addEventListener("change", function() {
    
    if (this.checked) {
        inputCpf.required = false;
        inputCpf.disabled = true;

        inputCpf.classList.add("input-cpf-disabled");
        labelCpf.classList.add("input-cpf-disabled");
    } else {
        inputCpf.required = true;
		inputCpf.disabled = false;

        inputCpf.classList.remove("input-cpf-disabled");
        labelCpf.classList.remove("input-cpf-disabled");
    }
});