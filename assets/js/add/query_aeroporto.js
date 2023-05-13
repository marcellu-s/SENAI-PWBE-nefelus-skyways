function query_aeroporto(index, elem){
    var selectedOption = $(elem).val();
    $.ajax({
        url: '../../ops/querry_option.php.php',
        method: 'POST',
        data: { 
            file: 'query_aeroporto.js',
            option: selectedOption 
        },
        success: function(response){
            $(`.aeroporto:eq(${index})`).html(response);
        }
    });
}

$(document).ready(function(){
    $(`.cidade`).on('change', function() { 
        var index = $(this).index('.cidade');
        query_aeroporto(index, this); 
    });
});
