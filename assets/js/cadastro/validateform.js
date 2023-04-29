const form = document.querySelector(".register-area form");

const inputFirstName = document.querySelector(".input-control #first-name");
const inputLastName = document.querySelector(".input-control #last-name");
const inputDateBirth = document.querySelector(".input-control #date-birth");
const inputGenderr = document.querySelector(".input-control #gender");
const inputCpff = document.querySelector(".input-control #cpf");
// const inputPassport = document.querySelector(".input-control #passport");
const inputEmail = document.querySelector(".input-control #email");
const inputPassword = document.querySelector(".input-control #password");

// Tamanho mínimo de digitos para a senha
const pswMinDigits = 8;

form.addEventListener('submit', (event) => {

    event.preventDefault();

    let check = true;

    if (inputFirstName.value == '') {
        window.alert("Preecha seu primeiro nome");
        return
    }

    if (inputLastName.value == '') {
        window.alert("Preecha seu último nome");
        return
    }

    if (inputDateBirth.value == '') {
        window.alert("Preecha sua data de nascimento");
        return 
    }

    if (inputGenderr.value == "") {
        window.alert("Preecha seu gênero");
        return;
    }

    if (inputCpff.value == "" || !isCpfValid(inputCpff.value)) {
        window.alert("Campo CPF vazio ou inválido");
        return;
    }

    // if (inputPassport.value == '') {
    //     window.alert("Campo passaporte vazio ou inválido");
    //     return
    // }

    if (inputEmail.value == "" || !isEmailValid(inputEmail.value)) {
        window.alert("Campo e-mail vazio ou inválido");
        return;
    }

    if (!isPasswordValid(inputPassword.value, pswMinDigits)) {
        window.alert("Campo senha vazia ou não atende o mínimo de caracteres");
        return;
    }

    form.submit();
})


// Função para validar o e-mail
function isEmailValid(email) {
	// user@dominio.com.br
	const emailRegex = new RegExp(
		/^[a-zA-z0-9._-]+@[a-zA-z0-9._-]+\.[a-zA-Z]{2,}$/
	);

	if (emailRegex.test(email)) {
		return true;
	} else {
		return false;
	}
}

// Função para validar o tamanho da senha, além de validar se ela está preenchida
function isPasswordValid(psw, minDigits) {
    if (psw.length >= minDigits) {
        return true;
    } else {
        return false;
    }
}

// Função para validar o CPF - FORMATO
function isCpfValid(cpf) {
    const cpfRegex = new RegExp(
        /^[0-9]{3}[.-]?[0-9]{3}[.-]?[0-9]{3}[.-]?[0-9]{2}$/
    );

    if (cpfRegex.test(cpf)) {
        return true;
    } else {
        return false;
    }
}