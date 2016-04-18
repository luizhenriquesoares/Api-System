/**
 * Created by geovannylcoutinho on 17/03/16.
 */

/**
 * Modal da cotação
 * @type {Mixed|jQuery|HTMLElement}
 */
var modalQuotation = $(".modalQuotationActions");

/**
 * Id da cotação - Input Hidden
 * @type {Mixed|jQuery|HTMLElement}
 */
var quotationId = $("input[name='quotation_id']");

/**
 * Div com os botões da cotações
 * @type {Mixed|jQuery|HTMLElement}
 */
var btnsQuotation = $(".btnsQuotation");

/**
 * Constante com a classe do botão de iniciar ordem de passagem
 * @type {string}
 */
const START_TICKET_ORDER = 'START_TICKET_ORDER';

/**
 *  Constante com a classe do botão de efetuar cobrança
 * @type {string}
 */
const MONEY_COLLECTION = 'MONEY_COLLECTION';

/**
 * Botão de faturar
 * @type {string}
 */
const INVOICE = 'INVOICE';

$(document).ready(function()
{
    dataTable.DataTable({
        "iDisplayLength": 10,
        "bDeferRender" : false,
        "searchable" : true,
        processing  : true,
        serverSide  : true,
        search : true,
        "language": {
            "emptyTable": "Não há dados a serem exibidos.",
            "processing": "Processando...",
            "info": "Exibindo página _PAGE_ de _PAGES_",
            "paginate" :
            {
                "previous" : "Retornar",
                "next"     : "Avançar"
            },
            "search" : "Pesquisa"
        },
        ajax: {
            url: BASE + '/manager/'+helper.controller+'/paginate',
        },
        "columns" : [
            { "data" : "id" },
            { "data" : "" },
            { "data" : "" },
            { "data" : "" },
            { "data" : "" },
            { "data" : "" },
            { "data" : "" },
            { "data" : "created_at" },
            { "data" : "status" },
            { "data" : "" }
        ],
        "columnDefs":
        [
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
            },
            {
                "render" : function(data, type, row)
                {
                    if(row.ops !== null)
                        return row.ops.title;
                    else
                        return "Não há OP para esta cotação";
                },
                "targets" : 0,
                "orderable": true

            },
            {
                "render" : function(data, type, row)
                {
                    if(row.hasOwnProperty('searchs_users') && row.searchs_users.length > 0)
                    {
                        if(row.searchs_users[0].agency_title !== null)
                            return row.searchs_users[0].agency_title;
                        else
                            return "<span title='Usuário não pertence a uma agência'>--</span>";
                    }
                },
                "targets": 1,
                "orderable": true
            },
            //{
            //    "render" : function(data , type, row)
            //    {
            //        if(row.hasOwnProperty('searchs_users') &&  (row.searchs_users.length > 0 && row.searchs_users[0].fullname !== null))
            //            return row.searchs_users[0].fullname;
            //        else
            //            return "";
            //    },
            //    "name" : "users.fullname",
            //    "targets" : 2,
            //    "orderable": true,
            //    "searchable" : true
            //},
            {
                "render" : function(data, type, row)
                {
                    if(row.hasOwnProperty('searchs_users') &&  row.searchs_users.length > 0)
                    {
                        var html = "<ul>";
                        $.each(row.searchs_users, function(i, passenger) {
                            if(passenger !== null)
                                html += "<li>" + passenger.passenger_name + "</li>";
                            else
                                html += "--";
                        });
                        html += "</ul>";

                        return html;
                    }
                    else
                        return "";
                },
                "targets" : 2,
                "orderable" : false
            },
            {
                "render" : function(data, type, row)
                {
                    if(row.hasOwnProperty('searchs_users') &&  row.searchs_users.length > 0)
                        return row.searchs_users[0].origin;
                    else
                        return "";
                },
                "targets" : 3,
                "orderable" : false
            },
            {
                "render" : function(data, type, row)
                {
                    if(row.hasOwnProperty('searchs_users') &&  row.searchs_users.length > 0)
                        return row.searchs_users[0].destination;
                    else
                        return "";
                },
                "targets" : 4,
                "orderable" : false
            },
            {
                "render" : function(data, type, row)
                {
                    if(row.hasOwnProperty('ops') && row.ops !== null)
                    {
                        return "R$ " + parseFloat(row.ops.final_price).toFixed(2);
                    }
                    else
                    {
                        return "--";
                    }
                },
                "name" : "ops.final_price",
                "targets" : 5,
                "orderable": true
            },
            {
                "render" : function( data, type, row)
                {
                    if(row.miles.length > 0)
                    {
                        var html = "<ul>";
                        $.each(row.miles, function(i, mile)
                        {
                            if(mile.miles > 0)
                                html += "<li>" + mile.type_mile + ": " + mile.miles + "</li>";
                        });
                        html += "</ul>";

                        return html;
                    }
                },
                "targets" : 6,
                "orderable": false
            },
            {
                "render" : function( data, type, row)
                {
                    return row.created_at;
                },
                "targets" : 8,
                "orderable": true
            },
            {
                "render" : function(data, type, row)
                {
                    /**
                     * Status da Ordem de Passagem
                     * @type {number}
                     */
                    var statusOp = -1;

                    if(row.ops === null || row.ops.length === 0)
                    {
                        return "Aguardando geração de op";
                    }
                    else
                    {
                        statusOp  = parseInt(row.ops.status);
                    }

                    if(statusOp === OP_ATIVA)
                        return '<label class="label label-xs label-success" aria-hidden="true" title="Ativo">Ativo</label>';

                    if(statusOp === OP_AGUARDANDO_PAGAMENTO)
                        return '<label class="label label-xs label-warning" title="Aguardando Pagamento"><strong>Pagamento</strong></label>';

                    if(statusOp === OP_ANALISE)
                        return '<label class="label label-xs label-default" title="Em análise"><strong>Em análise</strong></label>';

                    if(statusOp === OP_FATURADA)
                        return '<label class="label label-xs label-success" title="Faturada"><strong>Faturada</strong></label>';

                    if(statusOp === OP_CANCELADA)
                        return '<label class="label label-xs label-danger" title="Cancelada"><strong>Cancelada</strong></label>';

                },
                "targets" : 7
            }
        ]
    });

    /** Ao exibir modal */
    modalQuotation.on('show.bs.modal', function(e)
    {
        btnsQuotation.find('a').each(function(index, object)
        {

            /** Se o botão for de iniciar ordem de pasasgem */
            if($(object).attr('rel') === START_TICKET_ORDER)
            {
                hasOp(quotationId.val(), OP_ATIVA, function(response)
                {
                    if(response.data === null)
                    {
                        $(object).removeClass('disabled');
                    }
                    else
                    {
                        $(object).addClass('disabled');
                    }
                }, 'hasOps');
            }

            /** Se o botão for de enviar cobrança */
            if($(object).attr('rel') === MONEY_COLLECTION)
            {
                hasOp(quotationId.val(), OP_AGUARDANDO_PAGAMENTO, function(response)
                {
                    if(response.data === null)
                    {
                        $(object).addClass('disabled');
                    }
                    else
                    {
                        $(object).removeClass('disabled');
                    }
                });
            }

            /** Se o botão for de faturar */
            if($(object).attr('rel') === INVOICE)
            {
                hasOp(quotationId.val(), OP_AGUARDANDO_PAGAMENTO, function(response)
                {
                    if(response.data === null)
                    {
                        $(object).addClass('disabled');
                    }
                    else
                    {
                        $(object).removeClass('disabled');
                    }
                });

                hasOp(quotationId.val(), OP_ANALISE, function(response)
                {
                    if(response.data === null)
                    {
                        $(object).addClass('disabled');
                    }
                    else
                    {
                        $(object).removeClass('disabled');
                    }
                });
            }
        });
    });

    var btnQuotationActions     = $(".btnQuotationActions");
    var AjaxViews               = $(".AjaxViews");


    /**
     * Botão INICIAR ORDEM DE PASSAGEM Modal AÇÕES DA COTAÇÃO
     * @type {Mixed|jQuery|HTMLElement}
     */
    var btnStartTicketOrder = $(".btnStartTicketOrder");

    /**
     * Botão enviar cobrança
     * @type {Mixed|jQuery|HTMLElement}
     */
    var btnMoneyCollection = $(".btnMoneyCollection");

    /**
     * Botão de faturar
     * @type {Mixed|jQuery|HTMLElement}
     */
    var btnInvoice  = $(".btnInvoice");

    /** Para cada botão de iniciar op criado */
    btnStartTicketOrder.each(function()
    {
        $(this).click(function()
        {
            /**
             * Referência para o click
             * @type {*|jQuery}
             */
            var href = BASE + '/manager/quotation/startTicketOrder/' + quotationId.val();

            AjaxViews.toggle(function() {
                $(this).empty().load(href);
            });

            return false;
        });

    });

    btnMoneyCollection.each(function() {

        $(this).click(function() {

            /**
             * Referência para o click
             * @type {*|jQuery}
             */
            var href = BASE + '/manager/quotation/moneycollection/' + quotationId.val();

            $.get(href, function(response)
            {
                var classCss;

                if(response.success)
                {
                    toastr.success(response.msg);
                    $(".btnsQuotation a").each(function() {

                        if ($(this).attr('class').indexOf('btnMoneyCollection')) {
                            classCss = $(this).attr('class') + " disabled";
                            $(this).attr('class', classCss);
                        }

                        btnInvoice = $(this).parent().find('.btnInvoice');
                        classCss = btnInvoice.attr('class').replace("disabled", "");
                        btnInvoice.attr('class', classCss);

                    });
                }
                else
                {
                    toastr.error(response.msg);
                }

            });

            return false;

        });

    });

    btnInvoice.each(function() {

        $(this).click(function()
        {
            /**
             * Referência para o click
             * @type {*|jQuery}
             */
            var href = BASE + '/manager/quotation/invoice/' + quotationId.val();

            AjaxViews.toggle(function() {
                $(this).empty().load(href);
            });

            return false;
        });

    });
});

/**
 * Query Scope
 * @param quotationId
 * @param status
 * @param handle
 */
function hasOp(quotationId, status, handle, scope)
{
    scope = (scope === undefined || scope === null) ? 'hasOpsStatus' : scope;

    $.ajax({
        url: BASE + '/manager/quotation/scope',
        data : { scope: scope, quotation_id : quotationId, status: status, _token : TOKEN },
        type: 'POST',
        dataType: 'json',
        cache: false,
        async: true,
        success: function(response)
        {
            if(response.success)
            {
                handle(response);
            }
            else
            {
                toastr.error(response.msg);
            }
        }
    });
}

/**
 *
 * @param id
 */
function openQuotation(id)
{
    quotationId.val(id);
    modalQuotation.modal();
}

