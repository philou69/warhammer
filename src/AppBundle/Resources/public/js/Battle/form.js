$(document).ready(function () {
    var $contentForm = $("#content-form");
    var $showForm = $("#show-form");
    var $hideForm = $('#hide-form');
    var $status = $('#participant_presence');
    var $army = $('#participant_army');

    // Event pour afficher/masquer le formulaire
    $showForm.on('click', function (event) {
        event.preventDefault();
        $contentForm.removeAttr('hidden');
        $(this).attr('disabled', 'disabled');
    });

    $hideForm.on('click', function(event){
       event.preventDefault();
       $contentForm.attr('hidden', 'hidden');
       $showForm.removeAttr('hidden');
    });


    // Event pour activer le champ army si "participerez au combat" est activer.
    $status.on('change', function () {
        console.log($status.find(':selected').text());
        console.log($status.find(':selected').val());
        if($(this).find(':selected').text() === "participerez au combat"){
           $army.removeAttr('disabled');
        }else{
            $army.attr('disabled', 'disabled');
            $army.val('');
        }
    })
})
