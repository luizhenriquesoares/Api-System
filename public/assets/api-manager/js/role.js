/**
 * Created by geovanny on 26/02/16.
 */

$(document).ready(function() {

    /**
     * Formulário de registro de gurpo/permissões
     * @route RoleController@store
     * @type {Mixed|jQuery|HTMLElement}
     */
    var formRole = $("#form-role");

    /**
     * Div
     * @type {Mixed|jQuery|HTMLElement}
     */
    var divFormRole = $(".form-save-role");

    /**
     * Options
     * @type {{dataType: string, success: options.success}}
     */
    var options = {
        dataType: 'json',
        success : function(response)
        {
            if(response.success)
            {
                toastr.success(response.msg);
                formRole.find('.checks').each(function() {
                    $(this).prop('checked', false);
                });
                //formRole.find('input[type="text"]').val('');
                //$('input:checkbox').removeAttr('checked');
            }
            else
            {
                toastr.error(response.msg);
            }
        }
    };

    formRole.submit(function()
    {

        $(this).ajaxSubmit(options);

        return false;
    });

    $(".checks").each(function() {

        $(this).click(function()
        {
            var name = $(this).attr('name');
            var hiddens = $(".check-hidden");
            var input = "<input type='hidden' name='"+name+"' id='"+name+"Hidden' value='0'>";
            var objInput = $("#" + name + "Hidden");


            if(!$(this).prop('checked'))
            {
                hiddens.append(input);

                if($(this).attr('name') == 'create')
                    $("#store").val(0);

                if($(this).attr('name') == 'edit')
                    $("#update").val(0);
            }
            else
            {
                if($(this).attr('name') == 'create')
                    $("#store").val(1);

                if($(this).attr('name') == 'edit')
                    $("#update").val(1);
            }

            if($(this).prop('checked') && objInput.length > 0)
            {
                objInput.remove();
            }
        });

    });

    $.getScript(BASE + '/assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.js', function()
    {
        $(".tagged").tagsinput();
    });

    /**
     *
     * Tabela Específicas das Regras
     *
     * @type {Mixed|jQuery|HTMLElement}
     */
    var tableSpecificRules = $("#table-especific-rules");

    $("input[name='active']").click(function()
    {
        tableSpecificRules.toggle(function()
        {
            if($(this).is(':visible'))
            {
                $(this).find('.tagged').each(function()
                {
                    $(this).removeAttr('disabled');
                });
            }
            else
            {
                $(this).find('.tagged').each(function()
                {
                    $(this).attr('disabled', true);
                });
            }
        });
    });



});