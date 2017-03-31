$(document).ready(function () {

    $('#figurine_army_figurine').change(function () {
        if($('#select-figurine').length > 0){
            $('#select-figurine').remove();
        }
        hideEquipements();
        if($('div[data-' + $(this).val()).length > 0){
            $.each($('div[data-' + $(this).val()), function () {
                $(this).show();
            } )
        }else{
            $('#no-equipement').show();
        }


    })
})

function hideEquipements() {
    $.each($('.equipements'),function () {
        $(this).children('label').children('input').prop('checked', false);
        $(this).hide();
    })
}