$(document).ready(function () {
    //variables pour la gestion des equipements
    var $containerEquipement = $('#equipements');
    var indexEquipement = $containerEquipement.children().length;
    var $addEquipement = $('#add-equipement');

    // On mets un listener sur les add-equipement
    $addEquipement.on('click', function(event){
        event.preventDefault();
        // Recuperation du contenu
        var templateEquipement = $containerEquipement.data('prototype')
            .replace(/__name__label/g, 'Equipement ' + (indexEquipement + 1) + ' de la figurine ')
            .replace(/__name__/g, indexEquipement);

        var divEquipementElt = $('<div></div>');
        divEquipementElt.attr('id', 'equipement-' + ( indexEquipement + 1));
        divEquipementElt.attr('class', 'equipement');
        var h5EquipementElt = $('<h5>Equipement ' + ( indexEquipement + 1) + '</h5>');

        divEquipementElt.append(h5EquipementElt);
        divEquipementElt.append(templateEquipement);

        var $prototype = $(divEquipementElt);
        addDeleteEquipementLink($prototype);

        $containerEquipement.append($prototype);
        indexEquipement ++;
    })

    function addDeleteEquipementLink($prototype) {
        var $deleteEquipementLink = $('<a href="#" class="delete-equipement btn btn-danger" data-id="#equipement-' + ( indexEquipement + 1)  + '" >Retirer cet equipement</a>');

        $prototype.append($deleteEquipementLink);
    }


    $(".delete-equipement").on('click', function(event){
        event.preventDefault()
        var $equipementDiv = $($(this).data('id'));
        $equipementDiv.remove();
    })
})