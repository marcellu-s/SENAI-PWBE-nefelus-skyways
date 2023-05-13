function select_estado() {
    opt_estados = `<select name="" class="estado">
    <option value=''>...</option>`;
    for(es = 0; es < estados.length; es++) {
        opt_estados += `<option value='${estados[es].id_estado}'>${estados[es].sigla_estado} - ${estados[es].nome_estado}</option>`;
    }
    opt_estados += `</select>`
    return opt_estados;
}

function select_cidade() {
    return `<select name="" class="cidade">
        <option value=''>...</option>
    </select>`;
}

function select_aeroporto(num_name) {
    return `<select name="local_${parseInt(num_name/2)}" required class="aeroporto">
        <option value=''>...</option>
    </select>`;
}

function criacao_formConexao(form, i) {

    if (form == 2 && i == 0 ) {
        ident = viagens[0];
    } else if (form == qntConexao + 1 && i == 1) {
        ident = viagens[qntConexao];
    } else {  
        ident = 'Ligação ' + (viagens[qntConexao - 1]);
    }

    return  `<div class="pt-form">
                <label for=""><h2 class="part-tittle"></h2></label>
                
                <label for="">Estado: </label>
                ${select_estado()}
        
                <label for="">Cidade: </label>
                ${select_cidade()}
        
                <label for="">Aeroporto: </label>
                ${select_aeroporto()}
            </div>`;
}


function redefinicao(i, redef = false) {
    $(`.part-tittle:eq(${i})`).html( !isNaN(viagens[i]) ? ("Ligação " + viagens[i]) : (viagens[i]));
    
    if (i == 0) { // PRIMEIRO FORM
        $(`.estado:eq(${2})`).replaceWith($('<p class="estado">').html($('.estado:eq(0)').find('option:selected').text()));
        $(`.cidade:eq(${2})`).replaceWith($('<p class="cidade">').html($('.cidade:eq(0)').find('option:selected').text()));
        $(`.aeroporto:eq(${2})`).replaceWith($('<p class="aeroporto">').html($('.aeroporto:eq(0)').find('option:selected').text()));
    } 
    else if (i == viagens.length - 1) { // ULTIMO FORM
        // console.log(viagens)
        $(`.estado:eq(${viagens.length + 1})`).replaceWith($('<p class="estado">').html($('.estado:eq(1)').find('option:selected').text()));
        $(`.cidade:eq(${viagens.length + 1})`).replaceWith($('<p class="cidade">').html($('.cidade:eq(1)').find('option:selected').text()));
        $(`.aeroporto:eq(${viagens.length + 1})`).replaceWith($('<p class="aeroporto">').html($('.aeroporto:eq(1)').find('option:selected').text()));
    }
    else {

        // console.log("--> ",viagens.length)
        // console.log("----> ", i)

        if (i % 2 == 1 && i == viagens.length - 3 && redef == true) {
            // console.log(i)
            console.log('---> ',viagens.length)
            console.log(i)
            $(`.estado:eq(${i + 2})`).replaceWith(select_estado());
            $(`.cidade:eq(${i + 2})`).replaceWith(select_cidade());
            $(`.aeroporto:eq(${i + 2})`).replaceWith(select_aeroporto(i + 2));         
        } else if (i % 2 == 1) {
        } else {
            // console.log(i + 2)
            $(`.estado:eq(${i + 2})`).replaceWith($('<p class="estado">').html($(`.estado:eq(${i + 1})`).find('option:selected').text()));
            $(`.cidade:eq(${i + 2})`).replaceWith($('<p class="cidade">').html($(`.cidade:eq(${i + 1})`).find('option:selected').text()));
            $(`.aeroporto:eq(${i + 2})`).replaceWith($('<p class="aeroporto">').html($(`.aeroporto:eq(${i + 1})`).find('option:selected').text()));
        }
    }

    $('.estado').on('change', function() {
        console.log('aaaaaaaaaaaa')
        var index = $(this).index('.estado');
        query_cidade(index, this); 
        for(i = 0; i < qntConexao*2; i++) {
            redefinicao(i, false);
        }
    });

    $(`.cidade`).on('change', function() { 
        var index = $(this).index('.cidade');
        query_aeroporto(index, this); 
        for(i = 0; i < qntConexao*2; i++) {
            redefinicao(i, false);
        }
    });

    $(`.aeroporto`).on('change', function() { 
        for(i = 0; i < qntConexao*2; i++) {
            redefinicao(i, false);
        }
    });

}

var estados;
var selects;

$(document).ready(function(){

    viagens = ['Origem', 'Destino'];

    $.ajax({
        url: '../../ops/querry_option.php',
        method: 'POST',
        dataType: "json",
        data: { 
            file: 'query_estado.js',
        },
        success: function(response){
            estados = response;
        }
    });


    qntConexao = $('#qnt_conexao').val();

    $('#btn-conexao').on('click', function() {

        if(qntConexao == 0) {

            qntConexao = 2;
            $('#qnt_conexao').val(qntConexao)

            for(form = qntConexao; form < qntConexao*2; form++) {

                var form_conexao = $("<div>", {class: "form-conexao"});
                form_conexao.append("<hr>");
                
                viagens.splice(viagens.length - 1, 0, qntConexao - 1);

                for(i = 0; i < 2; i++) {
                    forms = criacao_formConexao(form, i);
                    form_conexao.append(forms);

                }

                form_conexao.insertBefore("#gambiarra");
            }

        } else if (qntConexao < 4) {

            qntConexao++;

            var form_conexao = $("<div>", {class: "form-conexao"});
            form_conexao.append("<hr>");

            for (x = 0; x < 2; x++) {
                viagens.splice(viagens.length - 1, 0, qntConexao - 1);
            }
            
            for(i = 0; i < 2; i++) {
                forms = criacao_formConexao(qntConexao, i);
                form_conexao.append(forms);
            }

            form_conexao.insertBefore("#gambiarra");
            $("#qnt_conexao").val(Number($("#qnt_conexao").val()) + 1);

        } else {
            alert('Não é possível adcionar mais conexões.')
        }

        for(i = 0; i < qntConexao*2; i++) {
            redefinicao(i, true);
        }
        
    })

    $('#btn-conexao-del').on('click', function() {

        if (qntConexao > 2) {
            $(`.form-conexao:eq(${$(`.form-conexao`).length - 1})`).remove();
            
            qntConexao -= 1;
            $('#qnt_conexao').val(qntConexao);
        } else {
            for (i = 1; i > qntConexao - 3; i--) {
                console.log(i)
                $(`.form-conexao:eq(${i})`).remove();
            }
            qntConexao = 0;
            $('#qnt_conexao').val(qntConexao);
        }
        viagens.splice(viagens.length - 3, 2);
        // console.log(viagens);
        for(i = 0; i < qntConexao*2; i++) {
                redefinicao(i);
        }
    });
});
