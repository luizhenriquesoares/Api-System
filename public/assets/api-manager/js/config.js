/**
 * Created by geovanny on 26/03/16.
 */

$(document).ready(function()
{

	var selectApis  = $("select[name='apis_id']");
	var selectUsers = $("select[name='users_id[]']");
	var selectRoles = $("select[name='roles_id[]']");

	var optionsSelect2 = {
		width: "100%",
		allowClear: "true",
		tags: "true",
		placeholder : "Escolha"
	};
	selectApis.select2(optionsSelect2);
	selectUsers.select2(optionsSelect2);
	selectRoles.select2(optionsSelect2);

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
			{ "data" : "display_name" },
			{ "data" : "search_limit" },
			{ "data" : "apis.name"},
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
				$(nRow).addClass('alert alert-danger').attr('title', 'Configuração inativa');
			}
		}
	});
});