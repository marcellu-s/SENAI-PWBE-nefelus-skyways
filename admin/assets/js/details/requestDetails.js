function requestAjax(id, op) {

    $.ajax({
        url: '../assets/php/viewDetails.php',
        method: 'GET',
        data: { 
            id: id,
            op: op
        },
        success: function(response){

            try {
                var data = JSON.parse(response);
            } catch (error) {
                window.alert('Não foi possível encontrar este registro!')
                return;
            }

            const dataKeys = Object.keys(data);
            const dataValues = Object.values(data);
            
            const form = document.querySelector('form');

            document.querySelector('.title').textContent = `Detalhes do(a) ${dataValues[0]}`;
            document.querySelector('title').textContent = `Detalhes - ${dataValues[0]}`;

            for (let i = 0; i < dataKeys.length; i++) {

                form.innerHTML += `<div class="input-control">
                                     <label for="${dataKeys[i]}">${dataKeys[i]}</label>
                                     <input type="text" name="${dataKeys[i]}" id="${dataKeys[i]}" value="${dataValues[i]}" readonly>
                                 </div>`;
            }
        }
    });
}

$(document).ready(function() {

    const inputID = document.querySelector('input#id').value;
    const inputOP = document.querySelector('input#op').value;

    requestAjax(inputID, inputOP);
});