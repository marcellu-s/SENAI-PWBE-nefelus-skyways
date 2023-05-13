function jsonAvioes() {
    $.ajax({
        url: '../ops/json_querys.php',
        method: 'POST',
        dataType: "json",
        data: {
            objeto: 'avioes',
        },

        success: function(response) {
            json = response;
        }
    });
}

$(document).ready(() => {
    $('#tabela-avioes').on('click', () => {
        jsonAvioes();

        thead = `
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Matrícula</th>
                <th>Carga</th>
                <th>Aeroporto</th>
                <th>Estado</th>
            </tr>
        </thead>`

        $('thead:eq(0)').html(thead);
    });
});