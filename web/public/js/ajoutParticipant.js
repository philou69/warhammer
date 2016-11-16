// On recupere le div contenant le prototype des participants
var $container = $('div#battle_participants');

// On recupere les enfant de $container avec .children() et on  recupere la 26ième lettres pour la passer comme index à la fonction cacheArmee()
$container.children().each(function () {

    var index = this.getAttribute('id').match(/[0-9]{1,2}/);
    // On appelle la fonction cachant les armées étrangères
    console.log(index);
    cacheArmee(index);
})

// On definit le compteur de participant en comptant le nombre d'enfants de container
// car un enfant de container est un participant
var index = $container.children().length;

// On selection le bouton 'rajouter participant' et on ajout un participant au click
$('#ajout_participant').click(function(e){
    // On appelle la fonction ajoutant un participant
    ajoutParticipant($container);

    // Afin d'eviter un "#" trainant dans l'url
    e.preventDefault();
    return false;
});

// La fonction qui ajoute des participants
function ajoutParticipant($container) {

    // On va recuperer le data-prototype du container
    // Puis remplacer les __namee__label par participant +index
    // et les __name__ par index
    var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Participant n°'+(index+1))
            .replace(/__name__/g, index)
        ;

    // On crée un objet jquery contenant le template
    var $prototype = $(template);

    // On ajout un lien de suppresion
    addDeleteLink($prototype);


    // on ajout le prototype au container
    $container.append($prototype);
    // On ajoute la fonction cachant les armées qui n'appartiennent pas au participant
    cacheArmee(index);
    // Enfin, on incremente le compteur
    index ++;
}

// La fonction supprimant le billet
function addDeleteLink($prototype) {
    //Création du lien
    var $deleteLink = $('<a href="#" class="btn btn-danger btn-xs">Supprimer</a>');
    var $divDeleteLink = $('<div class="text-center"></div>');
    $divDeleteLink.append($deleteLink);

    // On ajoute le bouton au prototype
    $prototype.append($divDeleteLink);

    // Ajoute de la suppresion du participant au click
    $deleteLink.click(function(e) {
        $prototype.remove();

        e.preventDefault();
        return false;
    })
}


// Fonction affichant uniquement les armées de l'utilisateur
function cacheArmee(index){
    // on récupere les deux champs select
    var armeeElt = document.getElementById('edit_battle_participants_'+index+'_army');
    var participantElt = document.getElementById('edit_battle_participants_' + index + '_participant')

    // On boucle sur chaques enfants du select armée pour les cachés
    for(var i = 0; i < armeeElt.childNodes.length; i++){
        // On vérifie si un participant a été chooisit
        if(participantElt.value === null ){
            // Le participant n'étant pas choiosit, on cache toutes les armées
            armeeElt.childNodes[i].style.display = 'none';
        }else{
            // Un participant étant sélectionné, on affiche ses armées et masque les autres
            if(armeeElt.childNodes[i].getAttribute("data-participant") == participantElt.value) {
                armeeElt.childNodes[i].style.display = 'inline';
            }else{
                armeeElt.childNodes[i].style.display = 'none';
            }
        }

    }
    // On modifie l'affichage des armées à chaque modification du participant
    document.getElementById('edit_battle_participants_' + index + '_participant').onchange = function () {
        console.log(this.value);
            for(var i = 0; i < armeeElt.childNodes.length; i++){
                if(armeeElt.childNodes[i].getAttribute("data-participant") == this.value) {
                    armeeElt.childNodes[i].style.display = 'inline';
                }else{
                    armeeElt.childNodes[i].style.display = 'none';
                }

            }
    }
}