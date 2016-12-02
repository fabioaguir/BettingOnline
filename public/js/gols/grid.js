// Referência da tabela principal
var table;

// Função para carregar a tabela principal
function loadTable(idPartida) {
    // Criando a grid DataTables
    table = $('#gols-grid').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        iDisplayLength: 20,
        bLengthChange: false,
        bFilter: false,
        bPaginate: false,
        ajax: {
            url: laroute.route('betting.gols.grid', {'idPartida' : idPartida}),
            method: 'POST'
        },
        language: {
            "lengthMenu": "_MENU_",
            "zeroRecords": "Não foram encontrados resultados",
            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "infoFiltered": "(Filtrado de _MAX_ total de registro)",
            "sProcessing":   "Processando...",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
            }
        },
        columns: [
            {data: 'nomeTempo', name: "tempos.nome", orderable: false},
            {data: 'minutos', name: 'gols.minutos'},
            {data: 'data', name: "to_char(partidas.data, 'DD/MM/YYYY')"},
            {data: 'partida', name: "concat(time_casa.nome,' x ',time_fora.nome)", orderable: false},
            {data: 'time', name: 'times.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('.dataTables_filter input').attr('placeholder','Pesquisar...');

    //DOM Manipulation to move datatable elements integrate to panel
    $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls').append("<i class='separator'></i>");
    $('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");

    $('.panel-footer').append($(".dataTable+.row"));
    $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");

    // retorno
    return table;
}

