function postData(url = "", data = {}) {
    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        success: function(response){
            
            let data = JSON.parse(response);

            window.alert(data.msg);

            document.querySelector('.input-control #name').value = "";
            document.querySelector(".input-control #email").value = "";
            document.querySelector(".input-control #subject").value = "";
            document.querySelector(".input-control #message").value  ="";
        }
    });
}

const form = document.querySelector('.contact-form form');

form.addEventListener('submit', (event) => {

    event.preventDefault();

    const nameI = document.querySelector('.input-control #name'),
    emailI = document.querySelector('.input-control #email'),
    subjectI = document.querySelector('.input-control #subject'),
    messageI = document.querySelector('.input-control #message');

    if (nameI.value == '' || !nameI.value.match(/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/)) {

        window.alert('Campo NOME inválido ou vazio!');
        return;
    }

    if (emailI.value == '' || !emailI.value.match(/^[a-zA-z0-9._-]+@[a-zA-z0-9._-]+\.[a-zA-Z]{2,}$/gm)) {

        window.alert('Campo E-MAIL inválido ou vazio!');
        return;
    }

    if (subjectI.value == '') {

        window.alert('Campo ASSUNTO vazio!');
        return;
    }

    if (messageI.value == '') {

        window.alert('Campo MENSAGEM vazio!');
        return;
    }

    postData(
        "../assets/php/processContact.php",
        { 
            name: nameI.value,
            email: emailI.value,
            subject: subjectI.value,
            message: messageI.value
        });
});