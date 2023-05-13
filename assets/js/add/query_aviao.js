$(document).ready(function(){
    $('.aeroporto:eq(0)').on('change', function() { 
        var selectedOption = $(this).val();
        $.ajax({
            url: '../../ops/querry_option.php.php',
            method: 'POST',
            data: { 
                file: 'query_aviao.js',
                option: selectedOption 
            },
            success: function(response){
                $(`#aviao`).html(response);
            }
        }); 
    });
});
