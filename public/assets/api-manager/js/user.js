// carregamento dos users e providers via json
dataTable.DataTable({
    "iDisplayLength": 10,
    processing  : true,
    serverSide  : true,
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
        url: BASE + '/manager/'+helper.controller+'/paginate'
    },
    "columns" : [
        { "data" : "fullname" },
        { "data" : "email" },
        { "data" : "roles.display_name"},
        { "data" : "created_at" },
        { "data" : "updated_at" },
        { "data" : "" }
    ],
    columnDefs: actionsData,
    search: true,
    searchable : true,
    orderable: true,
    "fnRowCallback" : function(nRow, aaData, iDisplayIndex)
    {
        if(parseInt(aaData.status) === 0)
        {
            $(nRow).addClass('alert alert-danger').attr('title', 'Usuário inativo');
        }
    }
});


$('#user-tab-trash').one( "click", function (){
    dataTableTrash.DataTable({
        "ajax": BASE + "/manager/trash/user",
        "columns" : [
            { "data" : "id" },
            { "data" : "fullname" },
            { "data" : "email" },
            { "data" : "roles_id"},
            { "data" : "created_at" },
            { "data" : "updated_at" },
            { "data" : "" }
        ],
        "columnDefs": [
            {
                "render": function ( data, type, row )
                {

                    var restoreTrash = 'onclick="restoreRow(\''+row.id+'\')"';
                    var removeDestroy = 'onclick="removeRow(\''+row.id+'\', \'destroy\', this)"';

                    var btns  = '<button class="btn btn-xs btn-success" type="button" '+restoreTrash+' title="Restaurar" route="'+BASE+'/manager/user/'+row.id+'/restore"> <i class="fa fa-refresh"></i></button>';
                    btns += ' <button class="btn btn-xs btn-danger" type="button" '+removeDestroy+' title="Excluir completamente" route="'+BASE+'/manager/user/'+row.id+'/destroy"> <i class="fa fa-remove"></i></button>';

                    return btns;
                },
                "targets": -1
            }
        ]
    });
});

