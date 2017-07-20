$(document).ready(function () {
//            variables pour la gestion des figurines
    var $addFigurine = $("#add-figurine");
    var $deleteFigurines = $('.delete-figurine');
    var $containerFigurine = $("#figurines");
    var indexFigurine = $containerFigurine.children().length;

    $addFigurine.on('click', function (event) {
        event.preventDefault();
//                On recupere le contenu du prototype en remplacant __name__label et __name__ par les bonnes valeurs
        var templateFigurine = $containerFigurine.data('prototype')
            .replace(/__name__label__/g, 'Figurine ' + (indexFigurine +1))
            .replace(/__name__figurine__/g, indexFigurine + 1)
            .replace(/__name__/g, indexFigurine);
//                Création du div qui contiendra la nouvelle figurine ainsi que du titre
        var divElt = $('<div></div>');
        divElt.attr('id', 'figurine-' + (indexFigurine +1));
        divElt.attr('class', 'figurine');
        divElt.data('equipements', '#equipements-figurine-' + (indexFigurine +1));
        var h5Elt = $('<h5>Figurine ' + (indexFigurine +1 ) + '<h5>');
        divElt.append(h5Elt);
        divElt.append(templateFigurine);
        var $prototype = $(divElt);
        // Fonction ajoutant le bouton de suppresion
        addDeleteFigurineLink($prototype);
        // Insertion du contenu et incrementation de l'index
        $containerFigurine.append($prototype);
        indexFigurine ++;
    })

    function addDeleteFigurineLink($prototype) {
//                Création d'un bouton de suppression
        var $deleteFigurineLink = $('<a href="#" class="btn btn-danger delete-figurine" data-id="#figurine-' + (indexFigurine +1) + '">Retirer cette figurine</a>')
        // Ajout du bouton au div
        $prototype.append($deleteFigurineLink);
    }

    // Event sur les bouton delete-figurine
    $(document).on('click', '.delete-figurine', function (event) {
        event.preventDefault();
        var $figurineDelette = $($(this).data('id'));
        $figurineDelette.remove();
        return false;
    })


    // On mets un listener sur les add-equipement
    $(document).on('click', '.add-equipement', function(event){
        event.preventDefault();
        //variables pour la gestion des equipements
        var $containerEquipement = $($(this).data('equipements'));
        var indexEquipement = $(this).data('lenght');
        var levelFigurine = $(this).data('index');

        // Recuperation du contenu
        var templateEquipement = $containerEquipement.data('prototype')
            .replace(/__name__label/g, 'Equipement ' + (indexEquipement + 1) + ' de la figurine ')
            .replace(/__name__/g, indexEquipement);

        var divEquipementElt = $('<div></div>');
        divEquipementElt.attr('id', 'equipement-' + ( indexEquipement + 1) +'-figurine-' + levelFigurine );
        divEquipementElt.attr('class', 'equipement');
        var h5EquipementElt = $('<h5>Equipement ' + ( indexEquipement + 1) + ' de la figurine ' + levelFigurine + '</h5>');

        divEquipementElt.append(h5EquipementElt);
        divEquipementElt.append(templateEquipement);

        var $prototype = $(divEquipementElt);
        addDeleteEquipementLink($prototype, levelFigurine, indexEquipement);

        $containerEquipement.append($prototype);
        indexEquipement ++;
        $(this).data('lenght', indexEquipement)
    })

    function addDeleteEquipementLink(prototype, levelFigurine, indexEquipement) {
        var $deleteEquipementLink = $('<a href="#" class="delete-equipement btn btn-danger" data-id="#equipement-' + ( indexEquipement + 1) +'-figurine-' + levelFigurine + '" >Retirer cet equipement</a>');
        prototype.append($deleteEquipementLink);
    }

    $(document).on('click', '.delete-equipement', function (event) {
        event.preventDefault();
        var $equipementDelete = $($(this).data('id'));
        $equipementDelete.remove();
        return false;
    })
})