$(document).ready(function () {

    $('#unit_army_unit').change(function () {
        if($('#select-unit').length > 0){
            $('#select-unit').remove();
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