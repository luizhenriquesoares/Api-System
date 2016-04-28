/**
 * Created by geovanny on 26/01/16.
 */

/**
 * Ações
 * @type {*[]}
 */
var actionsData = [
    {
        "render": function ( data, type, row )
        {
            var btns                    = "";
            var removeTrash             = 'onclick="removeRow(\''+row.id+'\', \'trash\', this)"';
            var removeDestroy           = 'onclick="removeRow(\''+row.id+'\', \'destroy\', this)"';
            var routeStatus             = BASE + "/manager/"+helper.controller+"/" + row.id + "/status";

                if(parseInt(row.status) === 1)
                {
                    btns += "<a href='javascript:void(0);' route='"+routeStatus+"' rel="+row.status+" class='btn btn-inverse btn-xs statusBtn' " +
                        "title='[Ativo] - Clique para desativar' onclick='checkStatus(this)'>";
                    btns += "<i class='fa fa-check-circle-o'></i></a>";
                }
                else
                {
                    btns += "<a href='javascript:void(0);' route='"+routeStatus+"' rel='"+row.status+"' class='btn btn-inverse btn-xs statusBtn' title='[Inativo] - Clique para ativar' onclick='checkStatus(this)'>";
                    btns += "<i class='fa fa-circle'></i></a>";
                }

                if(helper.properties.show)
                    btns += '<a title="Detalhes" href="'+BASE+'/manager/'+helper.controller+'/'+row.id+'" class="btn btn-success btn-xs"><i class="fa fa-search"></i></a>';

                if(helper.properties.edit)
                    btns += '<a title="Editar" href="'+BASE+'/manager/'+helper.controller+'/'+row.id+'/edit" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>';

                if(helper.controller == 'quotation' && helper.properties.quotation)
                {
                    btns += '<button type="button" onclick="openQuotation('+row.id+')" title="Processos da cotação" class="btn btn-github btn-xs btnQuotationActions">';
                        btns += '<i class="fa fa-check-circle"></i> COTAÇÃO';
                    btns += ' </button>';
                }

                if(!(!helper.properties.trash && !helper.properties.destroy))
                {
                    btns += '<div class="btn-group">' +
                        '<button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">' +
                            '<i class="fa fa-remove"></i> <span class="caret"></span></button><ul class="dropdown-menu" role="menu">' +
                            '<li>' +
                                '<a href="javascript:void(0)" route="'+BASE+'/manager/'+helper.controller+'/'+row.id+'" '+removeDestroy+' class="destroy">' +
                            '<i class="fa fa-remove"></i> COMPLETAMENTE</a>' +
                            '</li>' +
                            '<li>' +
                                '<a href="javascript:void(0);" route="'+BASE+'/manager/'+helper.controller+'/'+row.id+'/trash" '+removeTrash+'><i class="fa fa-trash"></i> LIXEIRA</a>' +
                            '</li>' +
                        '</ul>' +
                        '</div>';
                }

            return btns;

        },
        "targets": -1,
        "orderable" : false
    }
];

/**
 * Data Table Trash
 * @type {Mixed|jQuery|HTMLElement}
 */
var dataTableTrash  = $('#data-table-'+helper.controller+'-trash');

/**
 * Data Table
 * @type {Mixed|jQuery|HTMLElement}
 */
var dataTable       = $('#data-table-'+helper.controller);

/**
 *
 * @type {*|jQuery}
 */
var trashAction = $(".dynamic-html").load('/manager/trash/actions');

/**
 * BaseURL
 * @type {*|jQuery}
 */
var BASE        = $("input[name='BASE']").val();
/**
 * Token
 * @type {*|jQuery}
 * @private
 */
var _token      = $("input[name='_token']").val();

/**
 *
 * @type {{}}
 */
var dataProcessing = {};

$(document).ready(function()
{

    if($("#morris4").length > 0)
    {
        $.ajax({
            url: BASE + '/manager/chart',
            type: "GET",
            dataType: 'json',
            success : function(response)
            {
                Morris.Donut({
                    element: 'morris4',
                    data: response,
                    resize: true,
                    colors: ['#74e4d1', '#44cbb4', '#119d85','#22BAA0'],
                });
            }
        });

    }

    //$('.data-table').DataTable();

    /** REFATORAR */
    $(".data-table-markups").DataTable({
        searching: false,
        paging: false,
        info : false,
        "language": {
            "emptyTable": "Não há dados a serem exibidos."
        }
    });
    /**
     *
     * @type {{thousands: string, decimal: string}}
     */
    var floatMaskOptions = {
        thousands : '',
        decimal : '.'
    };

    /**
     * Máscaras
     * money float
     */
    $(".hasMaskMoney").maskMoney(floatMaskOptions);
    $("input[name='value']").maskMoney(floatMaskOptions);
    $("input[name='atareo']").maskMoney(floatMaskOptions);
    $("input[name='connection']").maskMoney(floatMaskOptions);
    $("input[name='price']").maskMoney({
        thousands: '.',
        decimal : ',',
        precision : 2
    });

    $(".miles").maskMoney({
        thousands: '.',
        decimal : ',',
        precision : 2
    });

    //var modalQuotationActions = $(".modalQuotationActions");



    ///////////////////////

    $(".select2").select2({
        width: 500,
        allowClear: true,
        maximumSelectionSize: 1
    });

    $(".companySelect").select2({
        width: "100%",
        allowClear: false,
        maximumSelectionSize: 1
    });

    var divModalQuotationsFooter = $(".modalQuotationsFooter");

    divModalQuotationsFooter.each(function() {
        $(this).hide();
    });


});

/**
 *  Remove o item
 * @param id
 * @param type
 * @param object
 */
function removeRow(id, type, object)
{
    if(object)
        var object = $(object);

    if(!BASE)
        var BASE = $("#BASE").val();

    var url;
    var confirmation;

    if(type == "trash")
    {
        confirmation = window.confirm("Você deseja enviar este item para lixeira?");
        if(!confirmation)
            return false;

        url = (object) ? object.attr('route') : BASE + '/manager/'+helper.controller+'/' + id + '/trash';

        $.ajax({
            url: url,
            dataType: 'json',
            type: 'GET',
            data : { _token : $("input[name='_token']").val() },
            success: function(response)
            {
                if(response.success)
                {
                    toastr.success(response.msg);

                    if ($.fn.DataTable.isDataTable(dataTableTrash))
                        dataTableTrash.DataTable().ajax.reload();

                    if ($.fn.DataTable.isDataTable(dataTable))
                        dataTable.DataTable().ajax.reload();
                }
                else
                {
                    toastr.error(response.msg);
                }
            }
        });
    }

    if(type == "destroy")
    {
        confirmation = window.confirm("Você deseja excluir completamente este item?");
        if(!confirmation)
            return false;

        url = (object.attr('route')) ? object.attr('route') : BASE + '/manager/'+helper.controller+'/' + id;

        $.ajax({
            url : url,
            dataType: 'json',
            type: 'POST',
            data: { _method : "DELETE", _token : $("input[name='_token']").val() },
            success: function(response)
            {
                if(response.success)
                {
                    toastr.success(response.msg);

                    if ($.fn.DataTable.isDataTable(dataTableTrash))
                        dataTableTrash.DataTable().ajax.reload();

                    if ($.fn.DataTable.isDataTable(dataTable))
                        dataTable.DataTable().ajax.reload();

                }
                else
                {
                    toastr.error(response.msg);
                }
            }
        });
    }
}


function restoreRow(id)
{
    var url = BASE + '/manager/'+helper.controller+'/' + id + '/restore';

    $.ajax({
        url : url,
        dataType: 'json',
        type: 'GET',
        data: { _token : $("input[name='_token']").val() },
        success: function(response)
        {
            if(response.success)
            {
                toastr.success(response.msg);

                if ($.fn.DataTable.isDataTable(dataTableTrash))
                    dataTableTrash.DataTable().ajax.reload();

                if ($.fn.DataTable.isDataTable(dataTable))
                    dataTable.DataTable().ajax.reload();
            }
            else
            {
                toastr.error(response.msg);
            }
        }
    });
}

/**
 * Alterar o status do item
 */
function checkStatus(obj)
{
    var obj     = $(obj);
    var url     = obj.attr('route');
    var status  = parseInt(obj.attr('rel'));

    $.ajax({
        url : url,
        data : { status : status, _token : TOKEN, _method : 'PATCH' },
        type: 'POST',
        dataType: 'json',
        success: function(response)
        {
            var statusBtn = $(".statusBtn");
            if(response.success)
            {
                toastr.success(response.msg);

                // /** Se a datatable estiver instanciada */
                // if ($.fn.DataTable.isDataTable(dataTable))
                //     dataTable.DataTable().ajax.reload();

                if(status === 0)
                {
                    obj.attr('rel', 1);
                    obj.closest('tr').find(statusBtn).removeAttr('title').attr('title', '[Ativo] - Clique para desativar');
                    obj.closest('tr').find(statusBtn).find('i').removeClass('fa fa-circle').addClass('fa fa-check-circle-o');

                    /** Obtém a tr dentro dos parents e remove o alert danger */
                    obj.closest('tr').removeClass('alert alert-danger');
                }
                else
                {
                    obj.attr('rel', 0);
                    obj.closest('tr').find(statusBtn).removeAttr('title').attr('title', '[Inativo] - Clique para ativar');
                    obj.closest('tr').find(statusBtn).find('i').removeClass('fa fa-check-circle-o').addClass('fa fa-circle');

                    /** Obtém a tr dentro dos parents e adiciona o alert danger */
                    obj.closest('tr').addClass('alert alert-danger');
                }

            }
            else
            {
                toastr.error(response.msg);

                if ($.fn.DataTable.isDataTable(dataTable))
                    dataTable.DataTable().ajax.reload();
            }
        }
    });

    return false;
}

function split( val ) {
    return val.split( /,\s*/ );
}
function extractLast( term ) {
    return split( term ).pop();
}