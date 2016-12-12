// On récupere tous les liens de l'accordeon
var aElts = document.querySelectorAll('.menu-drop');

aElts.forEach(function (aElt) {
    // On ajoute un listener
    aElt.addEventListener('click', function (e) {
        // On recupere la valeur de data-cible pour récuperer le div correspondant
        var id = aElt.getAttribute('data-cible');
        var divElt = document.getElementById(id);
        // on verifie si le div contient la class 'in', puis on retire le chevron et on ajoute un nouveau chevron
        if(divElt.classList.contains('in')){
            var chevronElt = aElt.querySelector('.chevron');
            chevronElt.classList.remove('glyphicon-chevron-up');
            chevronElt.classList.add('glyphicon-chevron-down');
        }
        if(divElt.classList.contains('in') ==  false){
            var chevronElt = aElt.querySelector('.chevron');
            chevronElt.classList.add('glyphicon-chevron-up');
            chevronElt.classList.remove('glyphicon-chevron-down');
        }
    })

})