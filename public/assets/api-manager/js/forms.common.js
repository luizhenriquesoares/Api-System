/**
 * Created by Augusto Ferreira on 10/03/2016.
 */


$(document).ready(function()
{
    var BASE = $("input[name='BASE']").val();
    $.getScript(BASE + '/assets/js/libs/inputMask.js', function() {


        var inputs = $('.additionals input, .additionals textarea');
        var additionals = $("input[name='adicionais']");


        if(!additionals.parent().hasClass('checked')){
            inputs.prop('disabled', true);
        }else{
            inputs.prop('disabled', false);
        }

        additionals.click(function(){
            if(!$(this).parent().hasClass('checked')){
                inputs.prop('disabled', true);
            }else{
                inputs.prop('disabled', false);
            }
        });


    });


});