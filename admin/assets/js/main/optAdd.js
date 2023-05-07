// OPÇÃO DE ADICIONAR

function redirect(option) {

    console.log(option);

    if (option == 'aviao') {

        window.location.href = './add_aviao.php';

    } else if (option == 'aeroporto') {

        window.location.href = './add_aeroporto.php';

    } else if (option == 'voo') {
        
        window.location.href = './add_voo.php';

    } else if (option == 'cidade') {
        
        window.location.href = './add_cidade.php';    
    }
}

const select = document.querySelector('#add');

select.addEventListener('change', function() { redirect(this.value) });