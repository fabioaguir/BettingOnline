/**
 * Created by Fabio Aguiar on 21/08/2016.
 */
$(document).ready(function(){

    //consulta via select2 times
    $("#time_casa_id").select2({
        placeholder: 'Selecione um time',
        minimumInputLength: 3,
        width: 250,
        ajax: {
            type: 'POST',
            url: laroute.route('betting.util.select2'),
            dataType: 'json',
            delay: 250,
            crossDomain: true,
            data: function (params) {
                return {
                    'search':     params.term, // search term
                    'tableName':  'times',
                    'fieldName':  'nome',
                    'page':       params.page
                };
            },
            processResults: function (data, params) {

                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            }
        }
    });

    //consulta via select2 times
    $("#time_fora_id").select2({
        placeholder: 'Selecione um time',
        minimumInputLength: 3,
        width: 250,
        ajax: {
            type: 'POST',
            url: laroute.route('betting.util.select2'),
            dataType: 'json',
            delay: 250,
            crossDomain: true,
            data: function (params) {
                return {
                    'search':     params.term, // search term
                    'tableName':  'times',
                    'fieldName':  'nome',
                    'page':       params.page
                };
            },
            processResults: function (data, params) {

                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            }
        }
    });
});