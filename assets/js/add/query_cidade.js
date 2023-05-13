// import { redefinicao } from './conexao.js';

function query_cidade(index, elem){
    var selectedOption = $(elem).val();
    $.ajax({
        url: '../../ops/querry_option.php.php',
        method: 'POST',
        data: { 
            file: 'query_cidade.js',
            option: selectedOption 
        },
        success: function(response){
            $(`.cidade:eq(${index})`).html(response);
        }
    });
}

$(document).ready(function() {
    $(`.estado`).on('change', function() {
        var index = $(this).index('.estado');
        query_cidade(index, this); 
    });
});

